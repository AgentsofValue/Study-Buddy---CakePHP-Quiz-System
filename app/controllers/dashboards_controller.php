<?php
class DashboardsController extends AppController {
	var $name = 'Dashboards';
	var $uses = array('Question', 'Users', 'Quizzes', 'QuestionQuiz');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $layout = 'admin';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow(array('admin_home'));
		
		$viewlogo = $this->Option->getOption('viewlogo');
		$site_title = $this->Option->getOption('site_title');
		$header_title = $this->Option->getOption('title');
		$taglines = $this->Option->getOption('taglines');
		
		$this->set(compact('viewlogo', 'site_title', 'header_title', 'taglines'));
	}
	
	function admin_home() {}
	
	function admin_configurations() {
		parent::loadModel('Option');
		
		$stitle = $this->Option->getOption('site_title');
		$title = $this->Option->getOption('title');
		$taglines = $this->Option->getOption('taglines');
		$viewlogo = $this->Option->getOption('viewlogo');
		$themes = $this->Option->getOption('theme');
		
		if(!empty($this->data)) {
			if($title !== false && $title == null) {
				//do save
				$this->Option->setOption('title', $this->data['Option']['title']);
			} else {
				//do update
				$this->Option->setOption('title', $this->data['Option']['title'], false);
			}
			
			if($stitle !== false && $stitle == null) {
				//do save
				$this->Option->setOption('site_title', $this->data['Option']['stitle']);
			} else {
				//do update
				$this->Option->setOption('site_title', $this->data['Option']['stitle'], false);
			}
			
			$taglines_val = array(
				$this->data['Option'][0]['description'],
				$this->data['Option'][1]['description'],
				$this->data['Option'][2]['description'],
				$this->data['Option'][3]['description']
			);
			if($taglines !== false && $taglines == null) {
				//do save
				$this->Option->setOption('taglines', $taglines_val);
			} else {
				//do update
				$this->Option->setOption('taglines', $taglines_val, false);
			}
			
			if($viewlogo !== false && $viewlogo == null) {
				//do save
				$this->Option->setOption('viewlogo', $this->data['Option']['viewlogo']);
			} else {
				//do update
				$this->Option->setOption('viewlogo', $this->data['Option']['viewlogo'], false);
			}
			
			if($themes !== false && $themes == null) {
				//do save
				$this->Option->setOption('theme', $this->data['Option']['theme']);
			} else {
				//do update
				$this->Option->setOption('theme', $this->data['Option']['theme'], false);
			}
			
			$this->Session->setFlash(__('Options Save!', true));
			$this->redirect($this->referer());
		}
		$this->set(compact('title', 'stitle', 'taglines', 'viewlogo', 'themes'));
	}
	
	function admin_add() {
		if(!empty($this->data)) {
			$choice_empty = false;
			foreach($this->data['Choice'] as $choice) {
				if(empty($choice)){
					$choice_empty = true;
				}
			}
			
			if(!empty($this->data['Question']['topic_id']) && !empty($this->data['Question']['text']) && $choice_empty == false) {
				if($this->Question->save($this->data['Question'])){
					$question_id = $this->Question->getInsertID();
					foreach($this->data['Choice'] as $choice){
						$choices['Choice'] = array( 'id'=>'','question_id'=>$question_id, 'text'=>$choice );
						$this->Question->Choice->save($choices);
					}
				}
				$this->Session->setFlash('Choose the correct answer/s.', true);
				$this->redirect(array('action'=>'admin_choose_correct', $question_id));
			}
			else{
				$this->Session->setFlash('Please fill up all fields', true);
			}
		}
		$topics = $this->Question->Topic->select();
		$this->set('topics', $topics);
	}
	
	function admin_add_topic() {
		if(!empty($this->data)) {
			if($this->Question->Topic->save($this->data['Topic'])) {
				$this->Session->setFlash('Topic was added.', true);
				$this->redirect(array('action'=>'admin_home'));
			} else {
				$this->Session->setFlash('Should enter a topic title and an integer for number of items.', true);
			}
		}
	}
	
	function admin_view_all_topics() {
		$topics = $this->Question->Topic->get_all();
		$this->set('topics', $topics);
	}
	
	function admin_choose_correct($question_id=0) {
		if(!empty($this->data)) {
			$this->Question->Choice->set_correct_answer($this->data['Choice']['id']);
			$this->Session->setFlash('Question was added!', true);
			$this->redirect(array('action'=>'admin_home'));
		} else {
			$question = $this->Question->get_question_text($question_id);
			$this->set('question', $question['Question']['text']);	
			$choices = $this->Question->Choice->get_choices($question_id);
			$this->set('choices', $choices);	
		}
	}
	
	function admin_edit($question_id=0) {
	
		if (!$question_id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid question', true));
			$this->redirect(array('action' => 'admin_view_all'));
		}
		
		if (!empty($this->data)) {
			$question_id = $this->data['Question']['id'];
			
			//UPDATE TOPIC
			$this->Question->update_topic($this->data['New']['topic_id'], $question_id);
			
			//UPDATE QUESTION TEXT
			$this->Question->update_question_text($this->data['Question']['text'], $question_id);
			
			//UPDATE CHOICES
			foreach($this->data['Choice'] as $id=>$choice) {
				$this->Question->Choice->update_choice($choice, $id);
			}
			$this->Session->setFlash('You can choose new correct answers if needed.', true);
			$this->redirect(array('action' => 'admin_edit_correct_answers', $question_id));
		}
		
		if (empty($this->data)) {
			//GET QUESTION
			$questions = $this->Question->get_question_text($question_id);
			$this->data['Question']['text'] = $questions['Question']['text'];
			$i=1;
			$counter = $this->Question->Choice->count_choices($questions['Question']['id']);
			$this->set('counter', $counter);
			$choices_id = array();
			foreach($questions['Choice'] as $choice) {
				$this->data['Choice'][$choice['id']] = $choice['text'];
				$choices_id[$i] = $choice['id'];
				$i++;
			}
			$this->set('choices_id', $choices_id);
			
			//CORRECT ANSWERS DROPDOWN
			$selected = $this->Question->Choice->get_chosen_answers($question_id);
			$this->set('selected', $selected);
			
			//TOPIC DROPDOWN
			$topics = $this->Question->Topic->select();
			$this->set('topics', $topics);
			
			//FOR DROPDOWN DEFAULT
			$this->set('topic', $questions['Question']['topic_id']);
			
			//QUESTION ID
			$this->set('question_id', $questions['Question']['id']);
		}
	}
	
	function admin_edit_correct_answers($question_id=0){
		if (!$question_id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid question', true));
			$this->redirect(array('action' => 'admin_view_all'));
		}
		
		if (!empty($this->data)) {
			$question_id = $this->data['Question']['id'];
			
			//UPDATE CORRECT ANSWER
			$current_correct = $this->Question->Choice->get_current_correct($question_id); 
			
			$this->Question->Choice->update_into_wrong($current_correct);
			$this->Question->Choice->set_correct_answer($this->data['New']['correct']);
			
			$this->Session->setFlash('The question was succesfully edited.', true);
			$this->redirect(array('action' => 'admin_view_one', $question_id));
		}
		
		if (empty($this->data)) {
			//GET QUESTION
			$questions = $this->Question->get_question_text($question_id);
			$this->data['Question']['text'] = $questions['Question']['text'];
			
			//CHOICES FOR CHECKBOX
			$choices = $this->Question->Choice->get_choices($question_id);
			$this->set('choices', $choices);
			
			//CORRECT ANSWERS
			$selected = $this->Question->Choice->get_chosen_answers($question_id);
			$this->set('selected', $selected);
			
			//QUESTION ID
			$this->set('question_id', $questions['Question']['id']);
		}
	}
	
	function admin_edit_topic($topic_id=0) {
	
		if (!$topic_id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid topic', true));
			$this->redirect(array('action' => 'admin_view_all_topics'));
		}
		
		if (!empty($this->data)) {
			$topic_id = $this->data['Topic']['id'];
			
			//UPDATE TOPIC
			$this->Question->Topic->update_topic($this->data, $topic_id);
			
			$this->Session->setFlash('Topic has been updated.', true);
			$this->redirect(array('action' => 'admin_view_one_topic', $topic_id));
		}
		
		if (empty($this->data)) {
			//GET QUESTION
			$topic = $this->Question->Topic->get_one_topic($topic_id);
			$this->set('topic', $topic);
		}
	}
	
	function admin_view_all() {
		$questions = $this->Question->get_all();
		$this->set('questions', $questions);
	}
	
	function admin_view_one($question_id) {
		$question = $this->Question->get_question_text($question_id);
		$question_number = $this->Question->admin_question_number($question_id);
		$total_questions = $this->Question->find('count');
		
		$this->set('question_id', $question_id);
		$this->set('topic', $question['Topic']['title']);
		$this->set('question', $question['Question']['text']);
		$this->set('choices', $question['Choice']);
		$this->set('question_id', $question['Question']['id']);
		$this->set('question_number', $question_number);
		$this->set('total_questions', $total_questions);
	}
	
	function admin_view_one_topic($topic_id=0) {
		$topic = $this->Question->Topic->get_one_topic($topic_id);
		$this->set('topic', $topic);
		$this->set('topic_id', $topic_id);
	}
	
	function admin_delete($question_id=0) {
		if (!$question_id) {
			$this->Session->setFlash(__('Invalid id for question', true));
			$this->redirect(array('action'=>'admin_view_all'));
		}
		
		if ($this->Question->delete($question_id)) {
			$choices = $this->Question->Choice->get_choices($question_id);
			
			
			foreach($choices as $id=>$choice){
				$this->Question->Choice->delete($id);
			}
			$this->Session->setFlash(__('Question deleted', true));
			$this->redirect(array('action'=>'admin_view_all'));
		}
	}
	
	function admin_delete_topic($topic_id=0){
		if (!$topic_id) {
			$this->Session->setFlash(__('Invalid id for topic', true));
			$this->redirect(array('action'=>'admin_view_all_topics'));
		}
		if ($this->Question->Topic->delete($topic_id)) {
			
			$this->Session->setFlash(__('Topic deleted', true));
			$this->redirect(array('action'=>'admin_view_all_topics'));
		}
	}
	
	function admin_previous($question_id=null){
		$admin_neighbor = $this->Question->admin_neighbors($question_id);
		$previous = $admin_neighbor['prev']['Question']['id']	;
	
		if($previous){
			$this->redirect(array('action' => 'admin_view_one', $previous));
			
		}
		else{
			$this->Session->setFlash('No previous question.', true);
			$this->redirect(array('action' => 'admin_view_one', $question_id ));
		}
	}
	
	function admin_next($question_id=null){	
		$admin_neighbor = $this->Question->admin_neighbors($question_id);
		$next = $admin_neighbor['next']['Question']['id']	;
	
		if($next){
			$this->redirect(array('action' => 'admin_view_one', $next));
			
		}
		else{
			$this->Session->setFlash('No next question.', true);
			$this->redirect(array('action' => 'admin_view_one', $question_id ));
		}
	}
	
	function admin_reports() { /* handles the parent view of summary reports */ }
	
	function reports_result() {
		$this->layout = '';
		
		$page = 1;
		$limit = 3;
		
		if(isset($this->params['url']['p']))
			$page = $this->params['url']['p'];
		
		$order = array('datetime DESC');
		$quiz_users = $this->Quizzes->find('all', array(
			'page' => $page,
			'limit' => $limit,
			'order' => $order
		));
		
		$nextresults = $this->Quizzes->find('all', array(
			'page' => $page + 1,
			'limit' => $limit,
			'order' => $order
		));
		
		$report_results = array();
		
		foreach($quiz_users as $key => $data) {
			$no_of_correct = 0;
			$no_of_wrong = 0;
			
			$quiz_id = $data['Quizzes']['id'];
			
			$user_answers = $this->Question->get_user_answers($quiz_id);
			$total_numbers = $this->Question->total_number_of_answers($quiz_id);
			
			foreach($user_answers as $answers) {
				foreach($answers['Answer'] as $ans) {
					$correctness = $this->Question->Choice->get_correctness($ans['answer']);
					
					if($correctness == 1) {
						$no_of_correct += 1;
					} else {
						$no_of_wrong += 1;
					}
				}
			}
			
			$report_results[$key]['quiz_id'] = $quiz_id;
			$report_results[$key]['user_name'] = $data['Quizzes']['user_name'];
			// $report_results[$key]['code'] = $data['Quizzes']['code'];
			$report_results[$key]['total_questions'] = $this->Question->get_total_items($quiz_id);
			$report_results[$key]['no_of_correct'] = $no_of_correct;
			$report_results[$key]['no_of_wrong'] = $no_of_wrong;
			$report_results[$key]['no_left_blank'] = $this->Question->count_marked($quiz_id);
			$report_results[$key]['total_score'] = round(($no_of_correct / $total_numbers) * 100, 2);
			// debug($user_answers);
		}
		
		$this->set(compact('report_results', 'page', 'nextresults'));
		
	}
	
	function admin_reports_review($quiz_id) {
		$quiz_user = $this->Quizzes->findById($quiz_id);
		
		$questions = $this->Question->review_questions($quiz_id);
		// debug($questions);
		
		$review_result = array();
		
		foreach($questions as $key => $question) {
			$question_id = $question['QuestionQuiz']['question_id'];
			
			$question_data = $this->Question->get_question_text($question_id);
			$answer = $this->Question->QuestionQuiz->Answer->get_answers($question['QuestionQuiz']['id']);
			
			$selected = null;
			if(!empty($answer)) {
				foreach($answer as $ans) {
					$selected = $this->Question->Choice->findById($ans);
				}
			}
			
			$review_result[$key]['question_id'] = $question_id;
			$review_result[$key]['question_text'] = $question_data['Question']['text'];
			$review_result[$key]['answer'] = ($selected != null) ? $selected['Choice']['text'] : 'No Answer';
			$review_result[$key]['correct_answer'] = $question_data['CorrectAnswer'][0]['text'];
			
			if($review_result[$key]['answer'] != $review_result[$key]['correct_answer']) {
				$review_result[$key]['is_correct'] = 0;
				$review_result[$key]['marked_string'] = "X";
			} else {
				$review_result[$key]['is_correct'] = 1;
				$review_result[$key]['marked_string'] = "&#8730;";
			}
			$review_result[$key]['is_marked'] = $question['QuestionQuiz']['is_marked'];;
		}
		
		$this->set('review_result', $review_result);
	}
}
<?php
class DashboardsController extends AppController {
	var $name = 'Dashboards';
	var $uses = array('Question', 'Users');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $layout = 'admin';
	
	function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow(array('admin_home'));
	}
	
	function admin_home() {}
	
	function admin_configurations() {
		parent::loadModel('Option');
		
		$stitle = $this->Option->getOption('site_title');
		$title = $this->Option->getOption('title');
		$taglines = $this->Option->getOption('taglines');
		$viewlogo = $this->Option->getOption('viewlogo');
		
		if(!empty($this->data)) {
			if(empty($title)) {
				//do save
				$this->Option->setOption('title', $this->data['Option']['title']);
			} else {
				//do update
				$this->Option->setOption('title', $this->data['Option']['title'], false);
			}
			
			if(empty($stitle)) {
				//do save
				$this->Option->setOption('site_title', $this->data['Option']['stitle']);
			} else {
				//do update
				$this->Option->setOption('site_title', $this->data['Option']['stitle'], false);
			}
			
			$taglines_val = array(
				$this->data['Option'][0]['description'],
				$this->data['Option'][1]['description'],
				$this->data['Option'][3]['description'],
				$this->data['Option'][2]['description']
			);
			if(empty($taglines)) {
				//do save
				$this->Option->setOption('taglines', $taglines_val);
			} else {
				//do update
				$this->Option->setOption('taglines', $taglines_val, false);
			}
			
			if(empty($viewlogo)) {
				//do save
				$this->Option->setOption('viewlogo', $this->data['Option']['viewlogo']);
			} else {
				//do update
				$this->Option->setOption('viewlogo', $this->data['Option']['viewlogo'], false);
			}
			
			$this->Session->setFlash(__('Options Save!', true));
			$this->redirect($this->referer());
		}
		$this->set(compact('title', 'stitle', 'taglines', 'viewlogo'));
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
}
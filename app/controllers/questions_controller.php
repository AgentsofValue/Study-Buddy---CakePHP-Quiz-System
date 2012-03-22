<?php
class QuestionsController extends AppController {

	var $name = 'Questions';
	var $helpers = array('Html', 'Form', 'Javascript');

	function admin_home(){
	
	
	}
	
	
	function admin_add(){
		if(!empty($this->data)){
			$choice_empty = false;
			foreach($this->data['Choice'] as $choice){
				
				if(empty($choice)){
					$choice_empty = true;
				}
			}
			
			if(!empty($this->data['Question']['topic_id']) && !empty($this->data['Question']['text']) && $choice_empty == false){
				
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
	
	function admin_add_topic(){
		
		if(!empty($this->data)){

			if($this->Question->Topic->save($this->data['Topic'])){
				$this->Session->setFlash('Topic was added.', true);
				$this->redirect(array('action'=>'admin_home'));
			}
			else{
				$this->Session->setFlash('Should enter a topic title and an integer for number of items.', true);
			}
			
		}
		
	}
	
	function admin_view_all_topics(){
		$topics = $this->Question->Topic->get_all();
		$this->set('topics', $topics);
	}
	

	
	function admin_choose_correct($question_id=0){
	
		if(!empty($this->data)){
	
			$this->Question->Choice->set_correct_answer($this->data['Choice']['id']);
			$this->Session->setFlash('Question was added!', true);
			$this->redirect(array('action'=>'admin_home'));
		}
		else{
			
			$question = $this->Question->get_question_text($question_id);
			$this->set('question', $question['Question']['text']);	
			$choices = $this->Question->Choice->get_choices($question_id);
			$this->set('choices', $choices);	
		}

		
	
	}
	
	function admin_edit($question_id=0){
	
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
			foreach($this->data['Choice'] as $id=>$choice){
			
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
			foreach($questions['Choice'] as $choice){
				
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
	
	function admin_edit_topic($topic_id=0){
	
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
	
	function admin_view_all(){
		$questions = $this->Question->get_all();
		$this->set('questions', $questions);
		
	}
	
	function admin_view_one($question_id){
		
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
	
	function admin_view_one_topic($topic_id=0){
		
		$topic = $this->Question->Topic->get_one_topic($topic_id);
		$this->set('topic', $topic);
		$this->set('topic_id', $topic_id);
		
	
	}
	
	function admin_delete($question_id=0){
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
	
	
	function generate_questions(){
		$quiz_id = $this->Session->read('quiz_id'); // <<-- load the session
		$this->Question->generate_questions($quiz_id);
		$this->redirect(array('action'=>'startQuiz'));
		
	}
	
	function startQuiz(){
		
	}
	
	function display($question_quiz_id=0, $from_review=0, $last_paused=0){
	
		if($this->Session->check('quiz_id')){
			$quiz_id = $this->Session->read('quiz_id'); // <<-- load the session	
		
			if($this->Session->check('start_time')){
				$start_time = $this->Session->read('start_time'); // <<-- load the session
		
		
			}
			else{
		
			
				$mtime = microtime();
				$mtime = explode( " ", $mtime );
				$start_time = $mtime[1] + $mtime[0];
				$this->Session->write('start_time', $start_time);			
				$start_time = $this->Session->read('start_time'); // <<-- load the session
			}
		
			
				$question = $this->Question->get_question($quiz_id, $question_quiz_id);
			
				$counter_answers = $this->Question->count_answers($question['Question']['id']);
			
				$this->set('quiz_id', $quiz_id);
				$this->set('question', $question);
				$this->set('last_paused', $last_paused);
				
		
				
				//GET ELAPSE TIME
				$elapse = get_elapse_time($start_time); /*********/
				$this->set('elapse', $elapse); /*********/
		
				//GET REMAINING TIME TO BE DISPLAYED
				$used_time = $this->Question->Quiz->calculate_used_time($quiz_id);
				$remaining_time = $this->Question->Quiz->calculate_remaining_time($quiz_id, $used_time);
				$this->set('remaining_time', $remaining_time); /*********/
				
				//GET STATUS OF QUIZ, FINISHED OR NOT
				$finished = $this->Question->Quiz->check_if_finished($quiz_id);
				//IF THERE IS MORE TIME AND QUESTIONS, DISPLAY.. ELSE, GO TO RESULTS
				if(!empty($question) && $remaining_time>0 && $finished==false){
					//GET THE USER'S ANSWER OF THE QUESTION AND MARK THE RADIOBUTTON IF ALREADY ANSWERED
					$answer = $this->Question->QuestionQuiz->Answer->get_answers($question['QuestionQuiz']['id']);
					
				
					if($counter_answers==1){
						$type = 'radio';
						$selected = 0;
						foreach($answer as $ans){
							$selected = $ans;
						}
						$attributes = array('default'=> $selected, 'legend'=>false);
						$this->set('attributes', $attributes);
					}
					elseif ($counter_answers>=2){
						$type = 'check';
						$selected = $answer;
						$this->set('selected', $selected);
						//count answered and minus to counter_answers for checkbox disabling
						$count_answered = $this->Question->QuestionQuiz->Answer->count_answered($question['QuestionQuiz']['id']);
						$limit = $counter_answers-$count_answered;
						$this->set('limit', $limit);
					}
					$this->set('type', $type);
					$this->set('counter_answers', $counter_answers);
				

	
					
				
					$choices = array();
					foreach	($question['Choice'] as $choice){
						
						$choices[$choice['id']] = $choice['text'];
					
					
					}
				
					
					$this->set('choices', $choices);

				
					//CHECK OF CHECKBOX IS MARKED
					if($question['QuestionQuiz']['is_marked']==1){
						$marked = true;
					}
					else{
						$marked = false;
					}
					$this->set('marked', $marked);
					
					//GET QUESTION NUMBER
					$number = $this->Question->get_question_number($quiz_id, $question['QuestionQuiz']['order']);
					$this->set('number', $number);
					//GET TOTAL ITEMS
					$total_items = $this->Question->get_total_items($quiz_id);
					$this->set('total_items', $total_items);
					
					//Check if only being reviewed
					$review = isset($this->params['named']['review']) ? $this->params['named']['review'] : 1;
					
					$this->set('from_review', $from_review);
					$this->set('review', $review);
					
					//for dropdown
					$all_questions = $this->Question->review_questions($quiz_id);
					$this->set('data', $all_questions);
					
				}
				else{
					
					$this->redirect("/questions/show_results/true");
				}
			
			
		
		}
		else{
			$this->Session->setFlash('Session timeout. Enter the code sent to your email to continue the quiz.', true);
			$this->redirect("/quizzes/resume");
		}
	}
	
	function submit(){
	
		if($this->Session->check('quiz_id')){

			$quiz_id = $this->Session->read('quiz_id'); // <<-- load the start time session
			if($this->Session->check('start_time')){
				$start_time = $this->Session->read('start_time'); // <<-- load the session
		
		
			}
			else{
		
				$mtime = microtime();
				$mtime = explode( " ", $mtime );
				$start_time = $mtime[1] + $mtime[0];
				$this->Session->write('start_time', $start_time);			
				$start_time = $this->Session->read('start_time'); // <<-- load the session
			}
		
			$elapse = get_elapse_time($start_time);
			$value = $this->Question->Quiz->update_logs($elapse, $start_time, $quiz_id);
			$question_quiz_id = $this->data['Submit']['question_quiz_id'];
			$marked = $this->Question->check_if_marked($question_quiz_id);

			
			if (!empty($this->data['Submit']['answer'])) {
				//save answer!
				$this->Question->submit($this->data, $this->data['Submit']['type']);
				//IF FROM REVIEW PAGE, REDIRECT TO REVIEW PAGE
				if($this->data['Submit']['from_review'] == 1){
					$this->redirect("/questions/review/{$this->data['Submit']['last_paused']}/0/review:{$this->data['Submit']['review']}");
				}
				else{
					$this->redirect(array('action'=>"/next/{$question_quiz_id}/{$this->data['Submit']['from_review']}/review:{$this->data['Submit']['review']}"));
				}
			
			}
			else if($marked==1){ // if marked, can be submitted though answer is empty
				if($this->data['Submit']['from_review'] == 1){
					$this->redirect("/questions/review/{$this->data['Submit']['last_paused']}/0/review:{$this->data['Submit']['review']}");
				}
				else{
					
					$this->redirect(array('action'=>"/next/{$question_quiz_id}/{$this->data['Submit']['from_review']}/review:{$this->data['Submit']['review']}"));
				}
			}
			
			else{
				$this->Session->setFlash('Can not proceed to next item without answering or marking it.', true);
				$this->redirect(array('action'=>"/display/{$question_quiz_id}/{$this->data['Submit']['from_review']}/review:{$this->data['Submit']['review']}"));
				
			}
		
		}
		else{
			$this->Session->setFlash('Session timeout. Enter the code sent to your email to continue the quiz.', true);
			$this->redirect("/quizzes/resume");
		}
		
		
		
	}
	
	
	
	
	function previous($quiz_question_id=NULL, $from_review){
		
		if($this->Session->check('quiz_id')){
		
			$quiz_id = $this->Session->read('quiz_id'); // <<-- load the start time session
			if($this->Session->check('start_time')){
				$start_time = $this->Session->read('start_time'); // <<-- load the session
		
		
			}
			else{
		
			
				$mtime = microtime();
				$mtime = explode( " ", $mtime );
				$start_time = $mtime[1] + $mtime[0];
				$this->Session->write('start_time', $start_time);			
				$start_time = $this->Session->read('start_time'); // <<-- load the session
			}
			$elapse = get_elapse_time($start_time);
			$value = $this->Question->Quiz->update_logs($elapse, $start_time, $quiz_id);
			$review = $this->params['named']['review'];
			if($review==1){
				$neighbor_data = $this->Question->get_neighbors($quiz_question_id, $quiz_id);
				$previous = $neighbor_data['prev']['QuestionQuiz']['id'];
			}
			else if($review==2){
				$neighbor_data = $this->Question->get_neighbors_marked($quiz_question_id, $quiz_id);
				$previous = $neighbor_data['prev']['QuestionQuiz']['id'];
			}
			
			
	
			if($previous){
				
				$this->redirect(array('action'=>"/display/{$previous}/{$from_review}/review:{$review}"));
			}
			else{
				$this->Session->setFlash('No previous question.', true);
				
				$this->redirect(array('action'=>"/display/{$quiz_question_id}/{$from_review}/review:{$review}"));
			}
		}	
		else{
			$this->Session->setFlash('Session timeout. Enter the code sent to your email to continue the quiz.', true);
			$this->redirect("/quizzes/resume");
		}

	}
	
	function next($quiz_question_id=NULL, $from_review=0){
	
		if($this->Session->check('quiz_id')){
		
			$quiz_id = $this->Session->read('quiz_id'); // <<-- load the start time session
			if($this->Session->check('start_time')){
				$start_time = $this->Session->read('start_time'); // <<-- load the session
		
		
			}
			else{
		
			
				$mtime = microtime();
				$mtime = explode( " ", $mtime );
				$start_time = $mtime[1] + $mtime[0];
				$this->Session->write('start_time', $start_time);			
				$start_time = $this->Session->read('start_time'); // <<-- load the session
			}
			$elapse = get_elapse_time($start_time);
			$value = $this->Question->Quiz->update_logs($elapse, $start_time, $quiz_id);
			$review = $this->params['named']['review'];
			
			if($review==1){
				$neighbor_data = $this->Question->get_neighbors($quiz_question_id, $quiz_id);
				$next = $neighbor_data['next']['QuestionQuiz']['id'];
			}
			else if($review==2){
				$neighbor_data = $this->Question->get_neighbors_marked($quiz_question_id, $quiz_id);
				$next = $neighbor_data['next']['QuestionQuiz']['id'];
			}
					
			
	
			if($next){
				
				$this->redirect(array('action'=>"/display/{$next}/{$from_review}/review:{$review}"));
			}
			else{ 
				$counter_marked = $this->Question->count_marked($quiz_id);
				if($counter_marked==0){
				
					$used_time = $this->Question->Quiz->calculate_used_time($quiz_id);
					$remaining_time = $this->Question->Quiz->calculate_remaining_time($quiz_id, $used_time);
					
					if($remaining_time <= 0){
						$this->redirect("/questions/times_up/1");
					}
					else{
						
						$this->redirect("/questions/review/review:0");
					}
					
				}
				else{
					$this->redirect(array('action' => 'more_time' ));
				}
			
			
			}
		}
		else{
			$this->Session->setFlash('Session timeout. Enter the code sent to your email to continue the quiz.', true);
			$this->redirect("/quizzes/resume");
		}
	}
	
	function mark($question_quiz_id, $mark = 0){
			
			
			$this->Question->update_is_marked($question_quiz_id, $mark);
			exit;
		
	}
	
	function get_marked(){
		if($this->Session->check('quiz_id')){
			$quiz_id = $this->Session->read('quiz_id'); // <<-- load the start time session
			$marked_question = $this->Question->get_marked($quiz_id);
			$this->redirect("/questions/display/{$marked_question}/review:2");
		}
		else{
			$this->Session->setFlash('Session timeout. Enter the code sent to your email to continue the quiz.', true);
			$this->redirect("/quizzes/resume");
		}
	}
	
	
	
	function show_results($finished=false){
		
		if($this->Session->check('quiz_id')){
			$quiz_id = $this->Session->read('quiz_id'); // <<-- load the session	
		
			$used_time = $this->Question->Quiz->calculate_used_time($quiz_id);
			$remaining_time = $this->Question->Quiz->calculate_remaining_time($quiz_id, $used_time);
	
			if( $finished || $remaining_time<=0){
	
			
				$details = $this->Question->Quiz->findByQuizID($quiz_id);
				$this->set('user_name', $details['Quiz']['user_name']);
				$this->set('user_email', $details['Quiz']['user_email']);
		
				
				//$date_completed =  date(' F d, Y  [l] - h:i:s a');
				$date_completed =  date("l dS \of F Y h:i A", time() );

				$this->set('date_completed', $date_completed);
			
				$total_items = $this->Question->get_total_items($quiz_id);
				$user_answers = $this->Question->get_user_answers($quiz_id);
			
				$score = $this->get_result($user_answers);
				$this->set('score', $score);
			
				//using the array score, find the percentage for each topic
				$all_topics = $this->Question->Topic->get_all();

				$percent = array();
				foreach($all_topics as $topic){
					$topic_items = $this->Question->number_of_items_by_topic($topic['Topic']['id'], $quiz_id);
					if($topic['Topic']['items'] > 0){
						foreach($score['topic'] as $key=>$topic_score){
							
							if($topic['Topic']['id']==$key){
							
								$percent[$topic['Topic']['id']]['score'] = ($topic_score/$topic_items)*100;
								$percent[$topic['Topic']['id']]['title'] = $topic['Topic']['title'];
								break;
							}
							else{
								$percent[$topic['Topic']['id']]['score'] = 0;
								$percent[$topic['Topic']['id']]['title'] = $topic['Topic']['title'];
							}

						}
					}
					
				}
				$this->set('percent', $percent);
			
				//i BY topic, get id and name then get percentage
				//debug($quiz_id);
				//debug($score['topic']);
				//foreach($score['topic'] as $key=>$topic){
					//$get_topic = $this->Question->Topic->get_items($key);
				//	debug($get_topic);
				//	$topic[$key['percentage']] = $topic/$get_topic['Topic']['items'];
				//	$topic[$key['name']] = $get_topic['Topic']['title'];
				//}
			
			
				$items_answered = $this->Question->count_answered($quiz_id);
				$this->set('items_answered', $items_answered);
				$this->set('total_items', $total_items);
			
				//MARK QUIZ FINISHED SO THAT USER CAN NOT GO BACK TO DISPLAY USING URL
				$this->Question->Quiz->mark_quiz_finished($quiz_id);
			
			}
		
			else{
				// add code to redirect if there are questions left
				$this->redirect(array('action' => 'display'));
			
			}
		}
		else{
			$this->Session->setFlash('Session timeout. Enter the code sent to your email to continue the quiz.', true);
			$this->redirect("/quizzes/resume");
		
		}
		
	
	}
	
	function times_up($zero_time=0){
		if($zero_time==0){
			$this->redirect(array('action' => 'display'));
		}
	
	}
	
	function review($question_quiz_id=0, $from_review=0){
		
		if($this->Session->check('quiz_id')){
			$quiz_id = $this->Session->read('quiz_id'); // <<-- load the session	
			
			if($this->Session->check('start_time')){
				$start_time = $this->Session->read('start_time'); // <<-- load the start time session
				$elapse = get_elapse_time($start_time);
				$value = $this->Question->Quiz->update_logs($elapse, $start_time, $quiz_id);
				$this->Session->delete('start_time');
			}
			
			$used_time = $this->Question->Quiz->calculate_used_time($quiz_id);
			$remaining_time = $this->Question->Quiz->calculate_remaining_time($quiz_id, $used_time);
			$time_hr = intval($remaining_time/3600);
			$time_min = intval(($remaining_time%3600)/60);
			$time_sec = $remaining_time%60;
			$time = $time_hr.":".$time_min.":".$time_sec;
			$this->set('remaining_time', $time);
			
			$all_questions = $this->Question->review_questions($quiz_id);
			$count_data = count($all_questions);
			$this->set('question_quiz_id', $question_quiz_id);
			$this->set('data', $all_questions);
			$this->set('count_data', $count_data);
			
			$counter_unanswered_marked = $this->Question->count_unanswered_marked($quiz_id);
			$this->set('counter_unanswered_marked', $counter_unanswered_marked);
		
			$review = $this->params['named']['review'];
			$this->set('review', $review);
			$this->set('from_review', $from_review);
			
		
			
		}
		else{
			$this->Session->setFlash('Session timeout. Enter the code sent to your email to continue the quiz.', true);
			$this->redirect("/quizzes/resume");
		}
	
	}
	
	function get_result($user_answers=NULL){
		if($this->Session->check('quiz_id')){
			$quiz_id = $this->Session->read('quiz_id'); // <<-- load the session	
			$correct=0;
		
			$topic = array();
			foreach($user_answers as $user){
				
				foreach($user['Answer'] as $ans){
					$correctness = $this->Question->Choice->get_correctness($ans['answer']);
					if (!(array_key_exists($user['Question']['topic_id'], $topic))) {
						$topic[$user['Question']['topic_id']] = 0;
					}
					if($correctness == 1){
					
						$topic[$user['Question']['topic_id']] = $topic[$user['Question']['topic_id']] + 1;
						
						$correct += $user['Question']['difficulty'];
					}
				}
			}
		 
		 
			$total_numbers = $this->Question->total_number_of_answers($quiz_id);
			
			$score['topic'] = $topic;
			$score['percentage'] = ($correct/$total_numbers)*100;
			
			if($score['percentage'] >= 80){
				$score['status'] = 'passed';
			}
			else{
				$score['status'] = 'failed';
			}
		
			return $score;
		}
		else{
			$this->Session->setFlash('Session timeout. Enter the code sent to your email to continue the quiz.', true);
			$this->redirect("/quizzes/resume");
		
		}
	}
	
	function load($code=NULL){
		
		
		
		
	
		
			$unanswered_unmarked =0;
			$unanswered_marked =0;
			$answered_unmarked =0;
			$answered_marked =0;
			$results = $this->Question->QuestionQuiz->Quiz->findByCode($code);
			
			if ($results){
				$datetime = date('Y-m-d H:i:s'); 
				$time_passed = (strtotime($datetime)- strtotime($results['Quiz']['datetime']));
				$days_passed = $time_passed/86400; //86400 is for 60*60*24 (seconds*minutes*hours)
				
				if($days_passed<5){
					$questions = $results['Question'];
					
					foreach($questions as $item){
						if($item['QuestionQuiz']['answered'] == 0 && $item['QuestionQuiz']['is_marked'] == 0){
							$unanswered_unmarked += 1;
						}
						else if($item['QuestionQuiz']['answered'] == 0 && $item['QuestionQuiz']['is_marked'] == 1){
							$unanswered_marked += 1;
						}
						else if($item['QuestionQuiz']['answered'] != 0 && $item['QuestionQuiz']['is_marked'] == 0){
							$answered_unmarked += 1;
						}
						else if($item['QuestionQuiz']['answered'] != 0 && $item['QuestionQuiz']['is_marked'] == 1){
							$answered_marked += 1;
						}
						
					}
					$this->set('unanswered_unmarked', $unanswered_unmarked);
					$this->set('unanswered_marked', $unanswered_marked);
					$this->set('answered_unmarked', $answered_unmarked);
					$this->set('answered_marked', $answered_marked);
				
					$this->set('user', $results['Quiz']['user_name']);
					$this->Session->write('quiz_id', $results['Quiz']['id']);
					$quiz_id = $this->Session->read('quiz_id'); // <<-- load the session	
			
					//to check if there is still unanswered or marked questions
					$counter_unanswered_marked = $this->Question->count_unanswered_marked($quiz_id);
					$this->set('counter_unanswered_marked', $counter_unanswered_marked);
					
					//to check if result has already been given. hence, redirecto to result
					$finished = $this->Question->Quiz->check_if_finished($quiz_id);
					$this->set('finished', $finished);
					
					//get remaining time, if there is still time, dont redirect to show results
					$used_time = $this->Question->Quiz->calculate_used_time($quiz_id);
					$remaining_time = $this->Question->Quiz->calculate_remaining_time($quiz_id, $used_time);
					$time_hr = intval($remaining_time/3600);
					$time_min = intval(($remaining_time%3600)/60);
					$time_sec = $remaining_time%60;
					$time = $time_hr.":".$time_min.":".$time_sec;
					$this->set('remaining_time', $remaining_time);
					$this->set('time', $time);
					
					//kulang for review 0,1,2 display.
					
					$counter_marked = $this->Question->count_marked($quiz_id);
					$this->set('marked', $counter_marked);
					
					$counter_unanswered = $this->Question->count_unanswered_unmarked($quiz_id);
					$this->set('unanswered', $counter_unanswered);		
				}
				else{
					$this->Session->setFlash('Account was already deactivated after 5 days.', true);
					$this->redirect("/quizzes/home");	
				}
			
			}else{
				$this->Session->setFlash('The quiz did not exist. You can register here.', true);
				$this->redirect("/quizzes/register");			
			}
		
		
	
	}
	
	function more_time(){
		if($this->Session->check('quiz_id')){
			$quiz_id = $this->Session->read('quiz_id'); // <<-- load the session	
		
			$used_time = $this->Question->Quiz->calculate_used_time($quiz_id);
			$remaining_time = $this->Question->Quiz->calculate_remaining_time($quiz_id, $used_time);
			$time_hr = intval($remaining_time/3600);
			$time_min = intval(($remaining_time%3600)/60);
			$time_sec = $remaining_time%60;
			$time = $time_hr.":".$time_min.":".$time_sec;
			$this->set('remaining_time', $time);
		
			$counter_marked = $this->Question->count_marked($quiz_id);
			$this->set('marked', $counter_marked);
		}
		else{
			$this->Session->setFlash('Session timeout. Enter the code sent to your email to continue the quiz.', true);
			$this->redirect("/quizzes/resume");
		}
	}
	
	/*function show_marked(){
		if($this->Session->check('quiz_id')){
			$quiz_id = $this->Session->read('quiz_id'); // <<-- load the session	
			$counter_marked = $this->Question->count_marked($quiz_id);
		
			if($counter_marked == 0){
				$this->redirect(array('action' => 'show_results', true));
			}
			else{
			
				$all_questions = $this->Question->get_marked($quiz_id);
				$this->set('data', $all_questions);
			}
	
		}
		else{
			$this->Session->setFlash('Session timeout. Enter the code sent to your email to continue the quiz.', true);
			$this->redirect("/quizzes/resume");
		}
	}*/
	
}
?>
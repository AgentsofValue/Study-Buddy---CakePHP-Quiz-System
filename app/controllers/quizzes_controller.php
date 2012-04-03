<?php
class QuizzesController extends AppController {

	var $name = 'Quizzes';
	var $components = array('SwiftMailer');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('*');
		
		// parent::loadModel('Option');
		$viewlogo = $this->Option->getOption('viewlogo');
		$site_title = $this->Option->getOption('site_title');
		$header_title = $this->Option->getOption('title');
		$taglines = $this->Option->getOption('taglines');
		
		$this->set(compact('viewlogo', 'site_title', 'header_title', 'taglines'));
	}

	
	function register(){
		

		if(!empty($this->data)){
				
				$randomString = $this->random_string();
				$this->data['Quiz']['code'] = $randomString;
				
				if($this->Quiz->save($this->data)){
					$quizID = $this->Quiz->getInsertID();
					$this->Session->write('quiz_id', $quizID);
					$this->Quiz->update_code($quizID);
					$user = $this->Quiz->read(null,$quizID);
					@$this->send_email($user['Quiz']['user_email'], $user['Quiz']['code']);
					
					
					$this->Session->setFlash("You can start the quiz!");
					$this->redirect(array('controller'=>'questions','action'=>'generate_questions'));
				}
				else{
					$this->Session->setFlash("A user name and a valid email address is required.");
					
				}
				
		}


	}
	

	/*************SEPTEMBER 5******************/
	function time(){
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
			
			$value = $this->Quiz->update_logs($elapse, $start_time, $quiz_id);
			
			/*********/
			echo $elapse; // display ONLY the value, no debug, no echo should be on this function other than this
			exit;
	
	}
	
	/*************SEPTEMBER 8******************/
	function pause($question_quiz_id=0, $from_review=0,$last_paused=0){
		if($this->Session->check('quiz_id')){
			$quiz_id = $this->Session->read('quiz_id'); // <<-- load the start time session
		
			if($this->Session->check('start_time')){
				$start_time = $this->Session->read('start_time'); // <<-- load the start time session
				$elapse = get_elapse_time($start_time);
				$value = $this->Quiz->update_logs($elapse, $start_time, $quiz_id);
				$this->Session->delete('start_time');
			}
		
			//used to get the remaining time
			$used_time = $this->Quiz->calculate_used_time($quiz_id);
			$remaining_time = $this->Quiz->calculate_remaining_time($quiz_id, $used_time);
			$time_hr = intval($remaining_time/3600);
			$time_min = intval(($remaining_time%3600)/60);
			$time_sec = $remaining_time%60;
			$time = $time_hr.":".$time_min.":".$time_sec;
		
			$review = $this->params['named']['review'];
			$this->set('review', $review);
			// used to get the status of the questions
			$results = $this->Quiz->findByQuizID($quiz_id);
			
			$questions = $results['Question'];
			$unanswered_unmarked = 0;
			$unanswered_marked = 0;
			$answered_unmarked = 0;
			$answered_marked = 0;
			foreach($questions as $item){
				 if($item['QuestionQuiz']['answered'] == 0 && $item['QuestionQuiz']['is_marked'] == 1){
					$unanswered_marked += 1;
				}
				else if($item['QuestionQuiz']['answered'] != 0 && $item['QuestionQuiz']['is_marked'] == 0){
					$answered_unmarked += 1;
				}
				else if($item['QuestionQuiz']['answered'] != 0 && $item['QuestionQuiz']['is_marked'] == 1){
					$answered_marked += 1;
				}
				
			}
			$this->set('question_quiz_id', $question_quiz_id);
			$this->set('answered_unmarked', $answered_unmarked);
			$this->set('answered_marked', $answered_marked);
			$this->set('unanswered_unmarked', $unanswered_unmarked);
			$this->set('unanswered_marked', $unanswered_marked);
			$this->set('time', $time);
			$this->set('from_review', $from_review);
			$this->set('last_paused', $last_paused);
		}
		else{
			$this->Session->setFlash('Session timeout. Enter the code sent to your email to continue the quiz.', true);
			$this->redirect("/quizzes/resume");
		
		}
	}
	
	function resume(){
	
		if(!empty($this->data)){

			$this->redirect(array('controller'=>'questions', 'action'=>'load', $this->data['Quiz']['code']));
	
		}
	
	
	
	}
	
	
	function take_again(){
		
		if($this->Session->check('quiz_id')){
				
			
			$old_quiz = $this->Session->read('quiz_id'); // <<-- load the start time session
			$user_details = $this->Quiz->findByQuizID($old_quiz);
			$this->Session->delete('quiz_id');
			
			//$this->redirect(array('action'=>'load', $this->data['Quiz']['code']));
			$this->data['Quiz']['user_name']=$user_details['Quiz']['user_name'];
			$this->data['Quiz']['user_email']=$user_details['Quiz']['user_email'];
			$this->data['Quiz']['datetime']= date('Y-m-d H:i:s');
			$this->data['Quiz']['allotted_time']= 5400 ;
			$randomString = $this->random_string();
			$this->data['Quiz']['code'] = $randomString;
			
			if($this->Quiz->save($this->data)){
				$quizID = $this->Quiz->getInsertID();
				$this->Session->write('quiz_id', $quizID);
				$new_quiz = $this->Session->read('quiz_id'); // <<-- load the start time session
				$this->Quiz->update_code($new_quiz);
				$this->Quiz->copy_quiz($old_quiz, $new_quiz);
				$user = $this->Quiz->read(null,$new_quiz);
				@$this->send_email($user['Quiz']['user_email'], $user['Quiz']['code']);
				
					
				$this->Session->setFlash("You can take the quiz again!");
				$this->redirect("/questions/startQuiz");
			}
				
		}
		else{
			$this->Session->setFlash('Session timeout.', true);
			$this->redirect("/pages/home");
		
		}
	
	}
	
	function random_string(){
		$length = 10;
		$characters = ('0123456789abcdefghijklmnopqrstuvwxyz');
		$randomString = '';  
	
		for ($p = 0; $p < $length; $p++) {
				$randomString .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		
		return $randomString;
	
	}
	
	function send_email($email, $new_code){
		$this->SwiftMailer->smtpType = 'tls';
        $this->SwiftMailer->smtpHost = 'smtp.gmail.com';
        $this->SwiftMailer->smtpPort = 465;
        $this->SwiftMailer->smtpUsername = 'no-reply-quiz@eversun.ph';
        $this->SwiftMailer->smtpPassword = 'quizscript11';

        $this->SwiftMailer->sendAs = 'html';
        $this->SwiftMailer->from = 'no-reply-quiz@eversun.ph';
        $this->SwiftMailer->fromName = 'Eversun Software Philippines Corp.';
        $this->SwiftMailer->to = $email;
        //set variables to template as usual
        $this->set('message', $new_code);
        
        try {
            if(!$this->SwiftMailer->send('im_excited', 'Quiz Script')) {
                $this->log("Error sending email");
            }
        }
        catch(Exception $e) {
              $this->log("Failed to send email: ".$e->getMessage());
        }
	
	
	}
	
	function home(){
		
	}
}


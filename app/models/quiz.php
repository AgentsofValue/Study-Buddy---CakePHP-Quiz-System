<?php
class Quiz extends AppModel {
	var $name = 'Quiz';
	var $validate = array(
		'user_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_email' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'email' => array(
				'rule' => array('email'),
				'message' => '',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Question' => array(
			'className' => 'Question',
			'joinTable' => 'question_quizzes',
			'foreignKey' => 'quiz_id',
			'associationForeignKey' => 'question_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
	var $hasMany = array(
		'Log' => array(
			'className' => 'Log',
			'foreignKey' => 'quiz_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			
		)
	);
	
	
	
	function findByCode($code){
		$conditions = array('Quiz.code'=>$code);
		$user = $this->find('first', compact('conditions'));
		
		return $user;
	}
	
	function update_code($quiz_id){
	
		$this->updateAll(array('Quiz.code' => 'CONCAT(Quiz.code,"", Quiz.id)'), array('Quiz.id'=>$quiz_id));
		
	}
	
	/*************NEW CODES******************/
	
	function update_logs($elapse, $start_time, $quiz_id){
		$start_time = round($start_time, 2);
		
		$conds = array(
				'AND' => array(
					array('Log.quiz_id'=>$quiz_id), 
					array('Log.time'=>$start_time)
				)
		);
		
		$count_logs = $this->Log->find('count', array('conditions'=>$conds));
		
		if($count_logs!=0){
			$this->Log->updateAll(array('Log.consumed'=>$elapse), array('Log.quiz_id'=>$quiz_id, 'Log.time'=>$start_time));
		}
		else{
			$data_log['Log'] = array('time'=>$start_time, 'quiz_id'=>$quiz_id, 'consumed'=>$elapse);
			$this->Log->save($data_log);
		}
	}
	
	function calculate_used_time($quiz_id){
		$results = $this->Log->find('all', array('conditions'=>array('Log.quiz_id'=>$quiz_id)));
		$used_time = 0;
		foreach($results as $row){
			$used_time += $row['Log']['consumed'] ;
		
		}
		
		return $used_time;
	}
	
	function calculate_remaining_time($quiz_id, $used_time){
		$this->unbindModel( array('hasMany' => array('Log'), 'hasAndBelongsToMany' => array('Question')) );
		$results = $this->find('first', array('conditions'=>array('Quiz.id'=>$quiz_id)));
	
		$remaining_time = $results['Quiz']['allotted_time'] - $used_time;
		return $remaining_time;
	}
	
	function findByQuizID($quiz_id){
		$this->unbindModel( array('hasMany' => array('Log')) );
		$conditions = array('Quiz.id'=>$quiz_id);
		$user = $this->find('first', compact('conditions'));
		
		return $user;
	}
	
	function copy_quiz($old_quiz, $new_quiz){
		$old_question_quiz = $this->QuestionQuiz->find('all', array('conditions'=>array('QuestionQuiz.quiz_id'=>$old_quiz) ) );
		
		
		foreach($old_question_quiz as $old){
			
			$data['QuestionQuiz'] = array( 'id'=>'','question_id'=>$old['QuestionQuiz']['question_id'], 'quiz_id'=>$new_quiz, 'order'=>$old['QuestionQuiz']['order']);
			$this->QuestionQuiz->save($data);
		}
	
	}
	
	function check_if_finished($quiz_id){
		$quiz = $this->read(null, $quiz_id);
		
		if($quiz['Quiz']['is_finished'] == 1){
			return true;
		}
		else{
			return false;
		}
	}
	
	function mark_quiz_finished($quiz_id){
		$this->updateAll(array('Quiz.is_finished'=>true), array('Quiz.id'=>$quiz_id));
	}
	

	
	
	

}

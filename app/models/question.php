<?php
class Question extends AppModel {
	var $name = 'Question';
	var $validate = array(
		'text' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Question text must not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Topic' => array(
			'className' => 'Topic',
			'foreignKey' => 'topic_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	var $hasAndBelongsToMany = array(
		'Quiz' => array(
			'className' => 'Quiz',
			'joinTable' => 'question_quiz',
			'foreignKey' => 'question_id',
			'associationForeignKey' => 'quiz_id',
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
		'Choice' => array(
			'className' => 'Choice',
			'foreignKey' => 'question_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'RAND()',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'QuestionQuiz' => array(
			'className' => 'QuestionQuiz',
			'foreignKey' => 'question_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CorrectAnswer' => array(
            'className'    => 'Choice',
            'conditions'   => array('CorrectAnswer.isCorrect' => 1),
            'dependent'    => false
        )
	);

	
	
	//added functions
	
	function generate_questions($quizID=NULL){
		
		//choosing topic randomly
		$this->recursive = 1;
		$this->Topic->unbindModel( array('hasMany' => array('Question')) );
		$results = $this->Topic->find('all', array('order'=>'RAND()'));

		foreach( $results as $topic )
		{ 
			//$items = $this->Topic->TopicGroup->find('all', array('conditions'=>array('TopicGroup.topic_id'=>$key) ) );
			//finding questions randomly
			//$questions = $this->find('list', array('conditions'=>array('Question.topic_id'=>$key),'order'=>'RAND()','limit'=>$items[0]['TopicGroup']['items']));
			$questions = $this->find('list', array('conditions'=>array('Question.topic_id'=>$topic['Topic']['id']),'order'=>'RAND()','limit'=>$topic['Topic']['items']));
			
		
			//for each question on the chosen topic, save to database table question_quiz
			foreach($questions as $qid)
			{
				$dataQQ['QuestionQuiz'] = array( 'id'=>'','question_id'=>$qid, 'quiz_id'=>$quizID );
				$this->QuestionQuiz->save($dataQQ);
			}			
		}
		
		//giving random values to order field
		$result = $this->QuestionQuiz->updateAll(array('QuestionQuiz.order'=>'1000000*RAND()'), array('QuestionQuiz.quiz_id'=>$quizID));
		
		
		
		
		
	}
	
	function get_question($quiz_id, $question_quiz_id=0){
		
		if ($question_quiz_id==0){
			
           $question_quiz_id = $this->first_question($quiz_id);
		   if($question_quiz_id==0){
					return;
			}
			
		}
		
		// get question, questionquiz and quiz data
		$question_quiz = $this->QuestionQuiz->read(null, $question_quiz_id);
		
		
		//get question, choice, topic, questionquiz data
		$this->recursive = 1;
		$this->unbindModel( array('hasMany' => array('QuestionQuiz'), 'hasAndBelongsToMany' => array('Quiz')));
		$question = $this->read(null, $question_quiz['QuestionQuiz']['question_id']);
		//$question['QuestionQuiz']['id'] = $question_quiz['QuestionQuiz']['id'];
		//$question['QuestionQuiz']['is_marked'] = $question_quiz['QuestionQuiz']['is_marked'];
		$question['QuestionQuiz'] = $question_quiz['QuestionQuiz'];

		return $question;
	}
	
	function first_question($quizID, $unskipped=TRUE){
		$conditions = array('QuestionQuiz.quiz_id'=>$quizID, 'QuestionQuiz.answered=0 AND QuestionQuiz.is_marked=0');
		$question_quiz= $this->QuestionQuiz->find('first', array('conditions'=>$conditions, 'order'=>array('QuestionQuiz.order'=>'ASC')));
		
		return $question_quiz['QuestionQuiz']['id'];
	
	}
	
	
	/*function first_question($quizID, $unskipped=TRUE){
		
		
		if($unskipped){
			//display first
			$question_quiz= $this->QuestionQuiz->find('first', array('conditions'=>array('QuestionQuiz.quiz_id'=>$quizID, 'QuestionQuiz.answered'=>0), 'order'=>array('QuestionQuiz.order'=>'ASC')));
		
		}
		else{
			//display first unanswered
			$question_quiz= $this->QuestionQuiz->find('first', array(
				'conditions'=>
					array('QuestionQuiz.quiz_id'=>$quizID, 
					array('QuestionQuiz.answered'=>0), 
						
					), 
				'order'=>array('QuestionQuiz.order'=>'ASC')
			));
			
		}
		
		return $question_quiz['QuestionQuiz']['id'];
	
	}
	*/
	
	function submit($data, $type){
			
		$this->QuestionQuiz->updateAll(array('QuestionQuiz.answered'=>1), array('QuestionQuiz.id'=>$data['Submit']['question_quiz_id']));
		$this->QuestionQuiz->Answer->deleteAll(array('Answer.question_quiz_id'=>$data['Submit']['question_quiz_id']));

		if($type=='radio'){
			$dataAnswer['Answer'] = array( 'id'=>'','answer'=>$data['Submit']['answer'], 'question_quiz_id'=>$data['Submit']['question_quiz_id']);
			$this->QuestionQuiz->Answer->save($dataAnswer);
		}
		else{
			foreach($data['Submit']['answer'] as $answer){
				$dataAnswer['Answer'] = array( 'id'=>'','answer'=>$answer, 'question_quiz_id'=>$data['Submit']['question_quiz_id']);
				$this->QuestionQuiz->Answer->save($dataAnswer);
		
			}
		}
		
		//$this->QuestionQuiz->Answer->updateAll(array('Answer.answer'=>$data['Submit']['answer']));
		//$this->QuestionQuiz->updateAll(array('QuestionQuiz.answered'=>$data['Submit']['answer'], 'QuestionQuiz.is_marked'=>$data['Submit']['is_marked']), array('QuestionQuiz.id'=>$data['Submit']['question_quiz_id']));
	}
	
	
	
	function get_neighbors($quiz_question_id=NULL, $quiz_id=0){
		$order = $this->QuestionQuiz->read(null,$quiz_question_id);
			
		$neighbors = $this->QuestionQuiz->find('neighbors', array('field'=>'order', 'value' => $order['QuestionQuiz']['order'],'conditions'=>array('QuestionQuiz.quiz_id'=>$quiz_id), 'order'=>array('QuestionQuiz.order'=>'ASC')));
			
	
		return $neighbors;
	}
	
	function get_neighbors_marked($quiz_question_id, $quiz_id){
	
		$order = $this->QuestionQuiz->read(null,$quiz_question_id);
			
		$neighbors = $this->QuestionQuiz->find('neighbors', array('field'=>'order', 'value' => $order['QuestionQuiz']['order'],'conditions'=>array('QuestionQuiz.quiz_id'=>$quiz_id, 'QuestionQuiz.is_marked'=>1), 'order'=>array('QuestionQuiz.order'=>'ASC')));
			
	
		return $neighbors;
	}
	
	
	
	function get_user_answers($quiz_id=0){

		$this->QuestionQuiz->recursive = 1;		
		
		$this->QuestionQuiz->Question->unbindModel(
			array(
				'hasMany' => array('Choice', 'QuestionQuiz')
				)
			);
		$this->QuestionQuiz->unbindModel(
			array(
				'belongsTo' => array('Quiz')
				)
			);
	
		$conditions = array('QuestionQuiz.quiz_id'=>$quiz_id);
		$order = array('QuestionQuiz.order'=>'ASC');
		$results = $this->QuestionQuiz->find('all', compact('conditions', 'order'));
		
		

		return $results; // I think this is what you need


	}
	

	function update_is_marked($question_quiz_id, $is_marked){
		
			$this->QuestionQuiz->updateAll(array('QuestionQuiz.is_marked'=>$is_marked), array('QuestionQuiz.id'=>$question_quiz_id));
		
		
	}
	
	function get_question_number($quiz_id, $order){
		return $this->QuestionQuiz->find('count', array('conditions'=>"QuestionQuiz.order <=$order AND QuestionQuiz.quiz_id=$quiz_id"));
	}
	
	function get_total_items($quiz_id){
		return $this->QuestionQuiz->find('count', array('conditions'=>"QuestionQuiz.quiz_id=$quiz_id"));
	}
	
	function get_marked($quiz_id=0){

		
		$conditions = array('QuestionQuiz.quiz_id'=>$quiz_id, 'QuestionQuiz.is_marked'=>1);
		$order = array('QuestionQuiz.order'=>'ASC');
		$results = $this->QuestionQuiz->find('first', compact('conditions', 'order'));

		return $results['QuestionQuiz']['id'];


	}
	
	function check_if_marked($question_quiz_id=0){
		
		$results = $this->QuestionQuiz->find('first', array('conditions'=>"QuestionQuiz.id=$question_quiz_id", 'fields'=>'QuestionQuiz.is_marked'));
		return $results['QuestionQuiz']['is_marked'];
	}
	
	function count_marked($quiz_id){
		return $this->QuestionQuiz->find('count', array('conditions'=>"QuestionQuiz.quiz_id=$quiz_id AND QuestionQuiz.is_marked=1"));
	}
	
	function count_answered($quiz_id){
		return $this->QuestionQuiz->find('count', array('conditions'=>"QuestionQuiz.quiz_id=$quiz_id AND QuestionQuiz.answered!=0"));
	}
	
	function count_unanswered_unmarked($quiz_id){
		$conditions = array (
			"QuestionQuiz.quiz_id" => $quiz_id,
			"AND" => array (
				"QuestionQuiz.answered" =>0,
				"QuestionQuiz.is_marked" => 0
			)
		);
		return $this->QuestionQuiz->find('count', array('conditions'=>$conditions));
	}
	
	function count_unanswered_marked($quiz_id){
		//$conditions = array('QuestionQuiz.quiz_id=$quiz_id AND QuestionQuiz.answered=0 OR QuestionQuiz.is_marked=1');
		$conditions = array (
			"QuestionQuiz.quiz_id" => $quiz_id,
			"OR" => array (
				"QuestionQuiz.answered" =>0,
				"QuestionQuiz.is_marked" => 1
			)
		);

		return $this->QuestionQuiz->find('count', array('conditions'=>$conditions));
	}
	
	function review_questions($quiz_id){
	
		$this->QuestionQuiz->recursive = 1;		
		
		$this->QuestionQuiz->Question->unbindModel(
			array(
				'hasMany' => array('Choice', 'QuestionQuiz')
				)
			);
		$this->QuestionQuiz->unbindModel(
			array(
				'belongsTo' => array('Quiz', 'Question', 'Answer')
				)
			);
	
		
		$conditions = array('QuestionQuiz.quiz_id'=>$quiz_id);
		$order = array('QuestionQuiz.order'=>'ASC');
		$results = $this->QuestionQuiz->find('all', compact('conditions', 'order'));

		return $results;
	}
	
	function count_answers($question_id){
		return $this->Choice->find('count', array('conditions'=>"Choice.isCorrect =1 AND Choice.question_id=$question_id"));
	}
	
	function total_number_of_answers($quiz_id){
		$question_quiz = $this->QuestionQuiz->find('list', array('fields'=>'question_id', 'conditions'=>"QuestionQuiz.quiz_id=$quiz_id"));
		$total_numbers = 0;
		foreach($question_quiz as $qq){
			$count = $this->Choice->find('count', array('conditions'=>"Choice.question_id=$qq AND Choice.isCorrect=1"));
			$total_numbers = $total_numbers+$count;
		}
		return $total_numbers;
	}
	
	function number_of_items_by_topic($topic_id=0, $quiz_id=0){
		$question_quiz = $this->QuestionQuiz->find('list', array('fields'=>'question_id', 'conditions'=>"QuestionQuiz.quiz_id=$quiz_id"));
		$questions = $this->find('list', array('fields'=>'id', 'conditions'=>"Question.topic_id=$topic_id"));
		$topic_items = 0;
		foreach($questions as $question){
			if(in_array($question, $question_quiz)){
				$count = $this->Choice->find('count', array('conditions'=>"Choice.question_id=$question AND Choice.isCorrect=1"));
				$topic_items = $topic_items + $count;
			}
		}
		
		return $topic_items;
	}
	
	
	//**********************************************************
	//FOR ADMINS
	function get_question_text($question_id){
		$this->recursive = 1;
		$this->unbindModel( array('hasAndBelongsToMany' => array('Quiz'), 'hasMany'=>array('QuestionQuiz',)) );
		return $this->find('first', array('conditions'=>"Question.id=$question_id"));
	
	}
	
	function get_all(){
		$this->recursive = 1;
		$this->unbindModel( array('belongsTo' => array('Topic'), 'hasAndBelongsToMany' => array('Quiz'), 'hasMany'=>array('QuestionQuiz', 'Choice')) );
		return $this->find('all');
	
	}
	
	function update_topic($topic_id, $question_id){
		$this->updateAll(array('Question.topic_id'=>$topic_id), array('Question.id'=>$question_id));
	
	}
	
	function update_question_text($question_text, $question_id){
		$this->query("UPDATE questions SET text = '$question_text' WHERE id = $question_id");
		
	}
	
	function admin_neighbors($question_id=NULL){
	
		return $this->find('neighbors', array('field'=>'id', 'value' => $question_id));
	
	}
	
	function admin_question_number($question_id){
		return $this->find('count', array('conditions'=>"Question.id <=$question_id"));
	}
	

	
	
	
}
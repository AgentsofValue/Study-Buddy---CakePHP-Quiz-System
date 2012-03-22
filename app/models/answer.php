<?php
class Answer extends AppModel {
	var $name = 'Answer';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'QuestionQuiz' => array(
			'className' => 'QuestionQuiz',
			'foreignKey' => 'question_quiz_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
	);
	
	
	function get_answers($question_quiz_id){
		return $this->find('list', array('fields'=>'Answer.answer', 'conditions'=>"Answer.question_quiz_id=$question_quiz_id"));
	}
	
	function count_answered($question_quiz_id){
		return $this->find('count', array('conditions'=>"Answer.question_quiz_id=$question_quiz_id"));
	}

}

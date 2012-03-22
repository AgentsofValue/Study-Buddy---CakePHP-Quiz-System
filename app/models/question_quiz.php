<?php
class QuestionQuiz extends AppModel {
	var $name = 'QuestionQuiz';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Quiz' => array(
			'className' => 'Quiz',
			'foreignKey' => 'quiz_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	
	var $hasMany = array(
		'Answer' => array(
			'className' => 'Answer',
			'foreignKey' => 'question_quiz_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

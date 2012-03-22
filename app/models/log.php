<?php
class Log extends AppModel {
	var $name = 'Log';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Quiz' => array(
			'className' => 'Quiz',
			'foreignKey' => 'quiz_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

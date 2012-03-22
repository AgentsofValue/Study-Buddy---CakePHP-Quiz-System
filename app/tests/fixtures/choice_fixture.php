<?php
/* Choice Fixture generated on: 2011-08-18 15:52:48 : 1313682768 */
class ChoiceFixture extends CakeTestFixture {
	var $name = 'Choice';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'text' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 150, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'question_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'isCorrect' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'text' => 'Lorem ipsum dolor sit amet',
			'question_id' => 1,
			'isCorrect' => 1
		),
	);
}

<?php
/* Question Fixture generated on: 2011-08-18 16:05:02 : 1313683502 */
class QuestionFixture extends CakeTestFixture {
	var $name = 'Question';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'topic_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'text' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'difficulty' => array('type' => 'integer', 'null' => false, 'default' => '5'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'topic_id' => 1,
			'text' => 'Lorem ipsum dolor sit amet',
			'difficulty' => 1
		),
	);
}

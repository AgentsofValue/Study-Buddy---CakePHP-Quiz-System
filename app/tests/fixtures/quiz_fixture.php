<?php
/* Quiz Fixture generated on: 2011-08-18 15:59:16 : 1313683156 */
class QuizFixture extends CakeTestFixture {
	var $name = 'Quiz';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'user_email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'code' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 25, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'datetime' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'notes' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'user_name' => 'Lorem ipsum dolor sit a',
			'user_email' => 'Lorem ipsum dolor sit a',
			'code' => 'Lorem ipsum dolor sit a',
			'datetime' => '2011-08-18 15:59:16',
			'notes' => 'Lorem ipsum dolor sit amet'
		),
	);
}

<?php
/* Log Fixture generated on: 2011-09-05 04:42:46 : 1315190566 */
class LogFixture extends CakeTestFixture {
	var $name = 'Log';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'quiz_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'time' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '15,2'),
		'consumed' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'quiz_id' => 1,
			'time' => 1,
			'consumed' => 1
		),
	);
}

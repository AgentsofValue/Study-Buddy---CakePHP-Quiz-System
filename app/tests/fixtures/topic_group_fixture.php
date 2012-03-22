<?php
/* TopicGroup Fixture generated on: 2011-08-18 16:06:58 : 1313683618 */
class TopicGroupFixture extends CakeTestFixture {
	var $name = 'TopicGroup';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'topic_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'items' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'topic_id' => 1,
			'group_id' => 1,
			'items' => 1
		),
	);
}

<?php
/* TopicGroup Test cases generated on: 2011-08-18 16:06:58 : 1313683618*/
App::import('Model', 'TopicGroup');

class TopicGroupTestCase extends CakeTestCase {
	var $fixtures = array('app.topic_group', 'app.topic', 'app.question', 'app.choice', 'app.question_quiz', 'app.quiz', 'app.group');

	function startTest() {
		$this->TopicGroup =& ClassRegistry::init('TopicGroup');
	}

	function endTest() {
		unset($this->TopicGroup);
		ClassRegistry::flush();
	}

}

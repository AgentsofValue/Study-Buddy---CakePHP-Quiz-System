<?php
/* Group Test cases generated on: 2011-08-18 16:09:27 : 1313683767*/
App::import('Model', 'Group');

class GroupTestCase extends CakeTestCase {
	var $fixtures = array('app.group', 'app.topic', 'app.question', 'app.choice', 'app.question_quiz', 'app.quiz', 'app.topic_group');

	function startTest() {
		$this->Group =& ClassRegistry::init('Group');
	}

	function endTest() {
		unset($this->Group);
		ClassRegistry::flush();
	}

}

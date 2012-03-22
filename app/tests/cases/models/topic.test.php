<?php
/* Topic Test cases generated on: 2011-08-18 16:06:14 : 1313683574*/
App::import('Model', 'Topic');

class TopicTestCase extends CakeTestCase {
	var $fixtures = array('app.topic', 'app.question', 'app.choice', 'app.question_quiz', 'app.quiz', 'app.topic_group');

	function startTest() {
		$this->Topic =& ClassRegistry::init('Topic');
	}

	function endTest() {
		unset($this->Topic);
		ClassRegistry::flush();
	}

}

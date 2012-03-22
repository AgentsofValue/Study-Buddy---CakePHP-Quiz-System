<?php
/* Log Test cases generated on: 2011-09-05 04:42:46 : 1315190566*/
App::import('Model', 'Log');

class LogTestCase extends CakeTestCase {
	var $fixtures = array('app.log', 'app.quiz', 'app.question', 'app.topic', 'app.topic_group', 'app.group', 'app.choice', 'app.question_quiz');

	function startTest() {
		$this->Log =& ClassRegistry::init('Log');
	}

	function endTest() {
		unset($this->Log);
		ClassRegistry::flush();
	}

}

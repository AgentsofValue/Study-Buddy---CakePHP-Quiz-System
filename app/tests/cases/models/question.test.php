<?php
/* Question Test cases generated on: 2011-08-18 16:05:03 : 1313683503*/
App::import('Model', 'Question');

class QuestionTestCase extends CakeTestCase {
	var $fixtures = array('app.question', 'app.topic', 'app.choice', 'app.question_quiz', 'app.quiz');

	function startTest() {
		$this->Question =& ClassRegistry::init('Question');
	}

	function endTest() {
		unset($this->Question);
		ClassRegistry::flush();
	}

}

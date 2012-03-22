<?php
/* Quiz Test cases generated on: 2011-08-18 15:59:16 : 1313683156*/
App::import('Model', 'Quiz');

class QuizTestCase extends CakeTestCase {
	var $fixtures = array('app.quiz', 'app.question', 'app.question_quiz');

	function startTest() {
		$this->Quiz =& ClassRegistry::init('Quiz');
	}

	function endTest() {
		unset($this->Quiz);
		ClassRegistry::flush();
	}

}

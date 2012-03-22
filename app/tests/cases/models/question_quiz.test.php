<?php
/* QuestionQuiz Test cases generated on: 2011-08-18 16:02:19 : 1313683339*/
App::import('Model', 'QuestionQuiz');

class QuestionQuizTestCase extends CakeTestCase {
	var $fixtures = array('app.question_quiz', 'app.question', 'app.quiz');

	function startTest() {
		$this->QuestionQuiz =& ClassRegistry::init('QuestionQuiz');
	}

	function endTest() {
		unset($this->QuestionQuiz);
		ClassRegistry::flush();
	}

}

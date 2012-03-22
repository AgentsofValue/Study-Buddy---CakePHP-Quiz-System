<?php
/* QuestionQuizzes Test cases generated on: 2011-08-18 16:03:46 : 1313683426*/
App::import('Controller', 'QuestionQuizzes');

class TestQuestionQuizzesController extends QuestionQuizzesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class QuestionQuizzesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.question_quiz', 'app.question', 'app.quiz');

	function startTest() {
		$this->QuestionQuizzes =& new TestQuestionQuizzesController();
		$this->QuestionQuizzes->constructClasses();
	}

	function endTest() {
		unset($this->QuestionQuizzes);
		ClassRegistry::flush();
	}

}

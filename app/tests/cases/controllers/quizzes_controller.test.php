<?php
/* Quizzes Test cases generated on: 2011-08-18 16:01:38 : 1313683298*/
App::import('Controller', 'Quizzes');

class TestQuizzesController extends QuizzesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class QuizzesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.quiz', 'app.question', 'app.question_quiz');

	function startTest() {
		$this->Quizzes =& new TestQuizzesController();
		$this->Quizzes->constructClasses();
	}

	function endTest() {
		unset($this->Quizzes);
		ClassRegistry::flush();
	}

}

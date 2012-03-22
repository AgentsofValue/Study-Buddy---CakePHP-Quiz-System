<?php
/* Questions Test cases generated on: 2011-08-18 16:05:28 : 1313683528*/
App::import('Controller', 'Questions');

class TestQuestionsController extends QuestionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class QuestionsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.question', 'app.topic', 'app.choice', 'app.question_quiz', 'app.quiz');

	function startTest() {
		$this->Questions =& new TestQuestionsController();
		$this->Questions->constructClasses();
	}

	function endTest() {
		unset($this->Questions);
		ClassRegistry::flush();
	}

}

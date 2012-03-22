<?php
/* Logs Test cases generated on: 2011-09-05 04:43:12 : 1315190592*/
App::import('Controller', 'Logs');

class TestLogsController extends LogsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class LogsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.log', 'app.quiz', 'app.question', 'app.topic', 'app.topic_group', 'app.group', 'app.choice', 'app.question_quiz');

	function startTest() {
		$this->Logs =& new TestLogsController();
		$this->Logs->constructClasses();
	}

	function endTest() {
		unset($this->Logs);
		ClassRegistry::flush();
	}

}

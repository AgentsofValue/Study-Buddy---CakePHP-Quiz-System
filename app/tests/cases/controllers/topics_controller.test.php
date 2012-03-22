<?php
/* Topics Test cases generated on: 2011-08-18 16:06:27 : 1313683587*/
App::import('Controller', 'Topics');

class TestTopicsController extends TopicsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TopicsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.topic', 'app.question', 'app.choice', 'app.question_quiz', 'app.quiz', 'app.topic_group');

	function startTest() {
		$this->Topics =& new TestTopicsController();
		$this->Topics->constructClasses();
	}

	function endTest() {
		unset($this->Topics);
		ClassRegistry::flush();
	}

}

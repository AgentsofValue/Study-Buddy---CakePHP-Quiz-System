<?php
/* TopicGroups Test cases generated on: 2011-08-18 16:08:18 : 1313683698*/
App::import('Controller', 'TopicGroups');

class TestTopicGroupsController extends TopicGroupsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TopicGroupsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.topic_group', 'app.topic', 'app.question', 'app.choice', 'app.question_quiz', 'app.quiz', 'app.group');

	function startTest() {
		$this->TopicGroups =& new TestTopicGroupsController();
		$this->TopicGroups->constructClasses();
	}

	function endTest() {
		unset($this->TopicGroups);
		ClassRegistry::flush();
	}

}

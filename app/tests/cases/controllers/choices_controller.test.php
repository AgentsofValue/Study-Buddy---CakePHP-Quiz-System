<?php
/* Choices Test cases generated on: 2011-08-18 15:53:04 : 1313682784*/
App::import('Controller', 'Choices');

class TestChoicesController extends ChoicesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ChoicesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.choice', 'app.question');

	function startTest() {
		$this->Choices =& new TestChoicesController();
		$this->Choices->constructClasses();
	}

	function endTest() {
		unset($this->Choices);
		ClassRegistry::flush();
	}

}

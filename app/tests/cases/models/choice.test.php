<?php
/* Choice Test cases generated on: 2011-08-18 15:52:48 : 1313682768*/
App::import('Model', 'Choice');

class ChoiceTestCase extends CakeTestCase {
	var $fixtures = array('app.choice', 'app.question');

	function startTest() {
		$this->Choice =& ClassRegistry::init('Choice');
	}

	function endTest() {
		unset($this->Choice);
		ClassRegistry::flush();
	}

}

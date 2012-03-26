<?php

class InstallController extends AppController {

	var $name = 'Install';
	var $uses = array();
	
	var $useDbConfig = 'default';
	var $tblPrefix = null;
	var $dbVersion = '1.0';
	
	function beforeFilter() {
		$this->Auth->allow('*');
		
		if($this->action == 'account') {
			parent::loadModel('User');
			$this->Auth->authenticate = $this->User;
		}
	}
	
	function index() {
		// If connection is unavailable redirect to error page.
		if(!$this->_isDbConnected()) {
			$this->redirect(array('action' => 'config_error'));
		}
		
		// If tables are already been installed in the database, redirect to admin dashboard.
		if($this->_isInstalled()) {
			$this->redirect(array('admin' => true, 'controller' => 'dashboards', 'action' => 'admin_home'));
		}
		
		$config = $this->_getConfigInfo();
		
		$this->set(compact('config'));
	}
	
	function config_error() {
		// If connection is available redirect installation page.
		if($this->_isDbConnected()) {
			$this->redirect(array('action' => '/'));
		}
	}
	
	function account() {
		$count = $this->User->find('count');
			
		if($this->_isInstalled() && $count > 0) {
			$this->redirect(array('admin' => true, 'controller' => 'dashboards', 'action' => 'admin_home'));
		}
		
		if(!empty($this->data)) {
			$this->User->create();
			
			// set the user date registered.
			$this->data['User']['date_registered'] = date('Y-m-d H:i:s');
			
			if($this->User->save($this->data)) {
				$this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'admin_login'));
			} else {
				$this->Session->setFlash(__('Failed to save user account', true));
			}
		}
	}
	
	function installDbTable() {
		$this->tblPrefix = $this->_getTablePrefix();
		
		$drop = array(
			"answers" => "DROP TABLE IF EXISTS " . $this->tblPrefix . "answers",
			"choices" => "DROP TABLE IF EXISTS " . $this->tblPrefix . "choices",
			"groups" => "DROP TABLE IF EXISTS " . $this->tblPrefix . "groups",
			"logs" => "DROP TABLE IF EXISTS " . $this->tblPrefix . "logs",
			"options" => "DROP TABLE IF EXISTS " . $this->tblPrefix . "options",
			"question_quizzes" => "DROP TABLE IF EXISTS " . $this->tblPrefix . "question_quizzes",
			"questions" => "DROP TABLE IF EXISTS " . $this->tblPrefix . "questions",
			"quizzes" => "DROP TABLE IF EXISTS " . $this->tblPrefix . "quizzes",
			"topic_groups" => "DROP TABLE IF EXISTS " . $this->tblPrefix . "topic_groups",
			"topics" => "DROP TABLE IF EXISTS " . $this->tblPrefix . "topics",
			"users" => "DROP TABLE IF EXISTS " . $this->tblPrefix . "users"
		);
		
		$create = array(
			"answers" => "CREATE TABLE " . $this->tblPrefix . "answers (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `answer` int(11) NOT NULL,
						  `question_quiz_id` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB",
			"choices" => "CREATE TABLE " . $this->tblPrefix . "choices (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `text` varchar(255) COLLATE latin1_general_ci NOT NULL,
						  `question_id` int(11) NOT NULL,
						  `isCorrect` tinyint(1) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM",
			"groups" => "CREATE TABLE " . $this->tblPrefix . "groups (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `name` varchar(150) COLLATE latin1_general_ci NOT NULL,
						  `default` tinyint(1) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM",
			"logs" => "CREATE TABLE " . $this->tblPrefix . "logs (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `quiz_id` int(11) NOT NULL,
						  `time` double(15,2) NOT NULL,
						  `consumed` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB",
			"options" => "CREATE TABLE " . $this->tblPrefix . "options (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `name` varchar(25) DEFAULT NULL,
						  `value` varchar(255) DEFAULT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM",
			"question_quizzes" => "CREATE TABLE " . $this->tblPrefix . "question_quizzes (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `question_id` int(11) NOT NULL,
						  `quiz_id` int(11) NOT NULL,
						  `answered` int(11) NOT NULL,
						  `order` int(11) NOT NULL,
						  `is_marked` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM",
			"questions" => "CREATE TABLE " . $this->tblPrefix . "questions (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `topic_id` int(11) NOT NULL,
						  `text` varchar(255) COLLATE latin1_general_ci NOT NULL,
						  `difficulty` int(11) NOT NULL DEFAULT '1',
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM",
			"quizzes" => "CREATE TABLE " . $this->tblPrefix . "quizzes (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `user_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
						  `user_email` varchar(50) COLLATE latin1_general_ci NOT NULL,
						  `code` varchar(30) COLLATE latin1_general_ci NOT NULL,
						  `datetime` datetime NOT NULL,
						  `notes` varchar(255) COLLATE latin1_general_ci NOT NULL,
						  `allotted_time` double NOT NULL,
						  `is_finished` tinyint(1) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM",
			"topic_groups" => "CREATE TABLE " . $this->tblPrefix . "topic_groups (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `topic_id` int(11) NOT NULL,
						  `group_id` int(11) NOT NULL,
						  `items` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM",
			"topics" => "CREATE TABLE " . $this->tblPrefix . "topics (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `title` varchar(100) COLLATE latin1_general_ci NOT NULL,
						  `items` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM",
			"users" => "CREATE TABLE " . $this->tblPrefix . "users (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `username` varchar(45) DEFAULT NULL,
						  `password` varchar(45) DEFAULT NULL,
						  `is_active` tinyint(1) DEFAULT '1',
						  `date_registered` datetime DEFAULT NULL,
						  `last_login` datetime NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM",
		);
		
		$this->_createTable($create, $drop, true);
		$this->redirect(array('action' => 'account'));
	}
	
	function _isInstalled() {
		$installed = false;
		
		if($this->_getOption('tbl_installed') == 'true') {
			$installed = true;
		}
		
		return $installed;
	}
	
	function _isTableExists($table) {
		$db = ConnectionManager::getDataSource($this->useDbConfig);
		
		$exists = false;
		
		if(!empty($db->config['prefix']) && $this->tblPrefix === null) {
			$this->tblPrefix = $db->config['prefix'];
		}
		
		$queryString = "SHOW TABLES LIKE '" . $this->tblPrefix . $table ."'";
		$result = $db->query($queryString);
		
		if(!empty($result) && $result !== null) {
			$exists = true;
		}
		
		// debug($result);
		
		return $exists;
	}
	
	function _getTablePrefix() {
		$db = ConnectionManager::getDataSource($this->useDbConfig);
		
		if(!empty($db->config['prefix']) && $this->tblPrefix === null) {
			$this->tblPrefix = $db->config['prefix'];
		}
		
		return $this->tblPrefix;
	}
	
	function _getConfigInfo() {
		$db = ConnectionManager::getDataSource($this->useDbConfig);
		return $db->config;
	}
	
	function _isDbConnected() {
		$db = ConnectionManager::getInstance();
		@$connected = $db->getDataSource($this->useDbConfig);
		
		if(!$connected->isConnected()) {
			return false;
		} else {
			return true;
		}
	}
	
	function _createTable($query, $dquery = null, $drop = false) {
		$db = ConnectionManager::getDataSource($this->useDbConfig);
		
		if(is_array($query)) {
			foreach($query as $key => $value) {
				if($drop === true) {
					$db->query($dquery[$key]);
				}
				$db->query($value);
			}
		} else {
			if($drop === true) {
				$db->query($dquery);
			}
			$db->query($query);
		}
		
		if(!empty($db->config['prefix']) && $this->tblPrefix === null) {
			$this->tblPrefix = $db->config['prefix'];
		}
		
		$query = "INSERT INTO " . $this->tblPrefix . "options VALUES
				(1, 'tbl_installed', 'true'),
				(2, 'installed_ver', ".$this->dbVersion.");";
		$db->query($query);
	}
	
	function _getOption($name) {
		$value = null;
		
		if($this->_isTableExists('options')) {
			parent::loadModel('Options');
			
			$options = $this->Options->findByName($name);
			$value = $options['Options']['value'];
		}
		
		return $value;
	}
}
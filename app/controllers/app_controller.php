<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
 
App::import('Model', 'ConnectionManager', false);

class AppController extends Controller {
	var $components = array('Auth', 'Session');
	
	var $view = 'Theme';
	
	function beforeFilter() {
		parent::loadModel('Option');
		
		//$this->Auth->allow('*');
		$this->Auth->loginError = 'Invalid combination of username and password!';
		$this->Auth->loginRedirect = array('controller' => 'dashboards', 'action' => 'admin_home');
		$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'admin_login');
		$this->Auth->loginAction = array('admin' => true, 'controller' => 'users', 'action' => 'admin_login');
		
		$is_logged_in = $this->_isLoggedIn();
		$username = $this->_getUsername();
		
		// Load Theme
		$this->theme = $this->Option->getOption('theme');
		
		$viewlogo = $this->Option->getOption('viewlogo');
		$site_title = $this->Option->getOption('site_title');
		$header_title = $this->Option->getOption('title');
		$taglines = $this->Option->getOption('taglines');
		
		$this->set(compact('is_logged_in', 'username', 'viewlogo', 'site_title', 'header_title', 'taglines'));
	}
	
	function _isLoggedIn() {
		if($this->Auth->user()) {
			return true;
		}
		return false;
	}
	
	function _getUserName() {
		$username = null;
		if($this->Auth->user()) {
			$username = $this->Auth->user('username');
		}
		return $username;
	}
}

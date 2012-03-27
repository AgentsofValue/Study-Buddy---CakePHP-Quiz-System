<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $layout = 'admin';
	
	function beforeFilter() {
		parent::beforeFilter();
		
		$this->Auth->allow(array('admin_login'));
		$this->Auth->autoRedirect = false;
		
		if($this->action == 'admin_add' || $this->action == 'admin_edit') {
			$this->Auth->authenticate = $this->User;
		}
	}
	
	function admin_add() {
		if(!empty($this->data)) {
			$this->User->create();
			
			// set the user date registered.
			$this->data['User']['date_registered'] = date('Y-m-d H:i:s');
			
			if($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'admin_view'));
			} else {
				$this->Session->setFlash(__('Failed to register new user', true));
			}
		}
	}
	
	function admin_edit($id = null) {
		if(empty($id) && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user id!', true));
			$this->redirect(array('action' => 'admin_view'));
		} else {
			if(!empty($this->data)) {
				$this->User->id = $id;
				if($this->User->save($this->data)) {
					$this->Session->setFlash(__('The user has been updated!', true));
					$this->redirect(array('action' => 'admin_view'));
				} else {
					$this->Session->setFlash(__('The user could not be updated!', true));
				}
			}
			$user = $this->User->find('first', array('conditions' => array('id' => $id)));
			$this->set('user', $user);
		}
	}
	
	function admin_delete($id = null) {
		if($id == 0) {
			$this->Session->setFlash(__('Invalid user id!', true));
			$this->redirect(array('action' => 'admin_view'));
		} else {
			if($this->User->delete($id)) {
				$this->Session->setFlash(__('Successfully deleted user!', true));
			} else {
				$this->Session->setFlash(__('Could not deleted user!', true));
			}
			$this->redirect(array('action' => 'admin_view'));
		}
	}
	
	function admin_view() {
		$users = $this->User->find('all');
		$this->set('users', $users);
	}
	
	function admin_login() {
		$this->layout = 'login';
		
		if(!empty($this->data) && $this->Auth->user()) {
			$this->User->id = $this->Auth->user('id');
			$this->User->saveField('last_login', date('Y-m-d H:i:s'));
			$this->redirect($this->Auth->redirect());
		}
	}
	
	function admin_logout() {
		$this->redirect($this->Auth->logout());
	}
}

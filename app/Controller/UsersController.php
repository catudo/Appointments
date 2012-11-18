<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'Users';

	var $components = array('Acl', 'User');

	/**
	 * Default helper
	 *
	 * @var array
	 */
	public $helpers = array('Html', 'Session');

	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	public $uses = array();

	public function beforeFilter() {
		//$this->Auth->allow('*');
		$this -> Auth -> allow('login', 'logout', 'initDb');
	}

	public function index() {
		

		$documentTypeModel = ClassRegistry::init('DocumentTypes');
		$documentTypeList = $documentTypeModel -> find("all");
		$documents = array();
		foreach ($documentTypeList as $documentType) {
			$documents[$documentType['DocumentTypes']['id']] = $documentType['DocumentTypes']['name'];
		}
		
		$loggedUser =  $this->Session->read('Auth.User');
		$this -> set('group', $loggedUser['group_id']);
		$this -> set('options', $documents);

	}

	public function login() {
		$this -> layout = 'loginTemplate';

		if ($this -> request -> is('post')) {
			if ($this -> Auth -> login()) {
				$userModel = ClassRegistry::init("User");
				$user = $userModel -> findById($this -> Auth -> user("id"));
				$entryDocumentType = $this -> data['User']['document_type'];
				$userDocumentType = $user['User']['document_type_id'];
				if ($entryDocumentType != $userDocumentType) {
					$this -> Session -> setFlash(__('incorrect login'));
					$this -> redirect($this -> Auth -> logout());
					
				} 
				if($user['User']['status_id']!=1){
					
					$this -> Session -> setFlash(__('This user is not active'));
					$this -> redirect($this -> Auth -> logout());
						
				}
				else{
					
					switch ($user['User']['group_id']) {
						case 1:
						$this -> redirect(array('controller' => 'pages', 'action' => 'display'));
						break;
						case 2:
						$this -> redirect(array('controller' => 'doctor', 'action' => 'index'));
						case 3:
						$this -> redirect(array('controller' => 'patient', 'action' => 'create_index'));	
						default:
						break;
					}
					
				}
					
			} else {
				$this -> Session -> setFlash(__('users.incorrectPassword'));
			}
		}

		$documentTypesModel = ClassRegistry::init("DocumentTypes");

		$documentTypes = $documentTypesModel -> find('all');

		$options = array();
		foreach ($documentTypes as $value) {
			$options[$value['DocumentTypes']['id']] = $value['DocumentTypes']['name'];
		}

		$this -> set('options', $options);

	}

	public function save() {
		$userModel = ClassRegistry::init('User');

		if ($userModel -> save($this -> data)) {
			return new CakeResponse( array('body' => json_encode(array("id" => $userModel -> id)), 'type' => 'json'));
		} else {
			$userModel -> set($this -> data);
			$errorshash = $userModel -> invalidFields();

			$errors = array();

			foreach ($errorshash as $key => $value) {
				array_push($errors, $value[0]);
			}

			return new CakeResponse( array('body' => json_encode(array("errors" => $errors)), 'type' => 'json'));

		}

	}

	public function listUsers() {
		$finalPost = $this -> User -> listUser(3);
		
		return new CakeResponse(array (
			'body' => json_encode($finalPost),
			'type' => 'json'
		));
	}

	public function edit() {
		$userModel = ClassRegistry::init('User');
		$user = $userModel -> findById($this -> data['userId']);
		$userPost = $user['User'];
		unset($userPost['password']);
		unset($userPost['cami_id']);
		unset($userPost['status_id ']);
		return new CakeResponse( array('body' => json_encode($userPost), 'type' => 'json'));
	}
	
	
	public function changeStatus(){
		 $this -> User -> changeStatus($this -> data['userId']);
		 
		 
		 
		return new CakeResponse(array (
			'body' => json_encode(array('userId'=>$this -> data['userId'])),
			'type' => 'json'
		));

		
	}
	
	public function logout(){
		$this -> redirect($this -> Auth -> logout());
		
	}
	
	



}

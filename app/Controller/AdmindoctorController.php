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
class AdmindoctorController extends AppController {

	/**
	 * Controller name
	 *
	 * @var string
	 */
	

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
			if($documentType['DocumentTypes']['name']!='TI')
			$documents[$documentType['DocumentTypes']['id']] = $documentType['DocumentTypes']['name'];
		}
		
		$specialitiesModel = ClassRegistry::init('Speciality');
		
		$specialitiesInstances = $specialitiesModel->find("all");
		
		$specialities = array();
		
		foreach ($specialitiesInstances as  $value) {
			$specialities[$value['Speciality']['id']] = $value['Speciality']['name'];		
		}
		
		$this -> set('options', $documents);
		$this -> set('specialities', $specialities);
		
		$camisModel = ClassRegistry::init('Cami');
		
		$camisInstances = $camisModel->find("all");
		
		$camis = array();
		
		foreach ($camisInstances as  $value) {
			$camis[$value['Cami']['id']] = $value['Cami']['name'];		
		}
		
	
		
		$this -> set('options', $documents);
		$this -> set('specialities', $specialities);
		$this -> set('camis', $camis);		
		
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
		$finalPost = $this -> User -> listUser(2);
		
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

	public function logout() {
		$this -> redirect($this -> Auth -> logout());
	}

}

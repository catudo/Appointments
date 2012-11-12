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

var $components =array('Acl');

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

	public function beforeFilter(){
		//$this->Auth->allow('*');
		$this->Auth->allow('login', 'logout','initDb');
	}

public function index(){

	$groupModel = ClassRegistry :: init('Group');
	$groupsInstaces = $groupModel->find("all");
	$groups = array();
	foreach ( $groupsInstaces as $group ) {
       $groups[$group ['Group']['id']] = $group['Group']['name'];
	}
	$status = array(1=>__("default.active"),0=>__("default.inactive") );

	$this->set('groups', $groups);
	$this->set('status', $status );



}


public function login() {
	 $this->layout = 'loginTemplate';
	 
    if ($this->request->is('post')) {
        if ($this->Auth->login()) {
        	$userModel = ClassRegistry::init("User");
			$user = $userModel->findById($this->Auth->user("id"));
			
			$entryDocumentType = $this->data['User']['document_type'];
			$userDocumentType = $user['User']['document_type_id'];
			
			if($entryDocumentType!=$userDocumentType){
					
				$this->Session->setFlash(__('incorrect login'));
				$this->redirect($this->Auth->logout());
			}else
			$this->redirect(array('controller' => 'pages', 'action' => 'display'));
        } else {
            $this->Session->setFlash(__('users.incorrectPassword'));
        }
    }
	
	$documentTypesModel = ClassRegistry::init("DocumentTypes");
	
	$documentTypes = $documentTypesModel->find('all');
	
	$options = array();
	foreach ($documentTypes as  $value) {
		$options[$value['DocumentTypes']['id']] =$value['DocumentTypes']['name'];	
	}
	
    $this->set('options',$options);

}


public function save(){
	$userModel = ClassRegistry :: init('User');
	if($userModel->save($this->data)){
		return new CakeResponse(array (
					'body' => json_encode(array("id"=>$userModel->id))
				));
	}else{
		$userModel->set($this->data);
		$errors = $userModel->invalidFields();
				return new CakeResponse(array (
					'body' => json_encode(array (
						"errors" => $errors
					)),
					'contentType' => 'application/json'
				));
	}


}

public function listUsers(){
	$this->layout = 'ajax';
	$userModel = ClassRegistry :: init('User');
	$userInSession = $this->Auth->user('id');
	$users = $userModel->find('all',array("conditions"=>
			array( "NOT" =>
				array ("User.id" => $userInSession))));

	$postlist = array ();
	foreach($users as $user ){
		$tuple = array ();
		$userId = $user['User']['id'];

		array_push($tuple,$user['User']['name'], $user['User']['username'],$user['Group']['name'] ,($user['User']['status_id']==1)?__("Active"):__("Inactive"),"<a class='edit' userId='$userId' href='#''>".__("default.edit")."</a>" );
		array_push($postlist, $tuple);
	}
	
	$columns = array (
			array (
				'sTitle' => __('names')
			),
			array (
				'sTitle' => __("username")
			),
			array (
				'sTitle' => __('user.group')
			),
			array (
				'sTitle' => __("default.status")
			),array (
				'sTitle' => ""
			)
			);

		$finalPost = array (
			'aaData' => $postlist,
			'aoColumns' => $columns,
			'sDom' => 'HrtF',
			'sScrollY'=>'200px'

		);
		return new CakeResponse(array (
			'body' => json_encode($finalPost),
			'contentType' => 'application/json'
		));
		

	


	}


public function edit(){
		$userModel = ClassRegistry :: init('User');
		$user = $userModel->findById($this->data['userId']);
		$userPost = array('id'=>$this->data['userId'],'name'=>$user['User']['name'], 'username'=> $user['User']['username'],'group_id'=>$user['User']['group_id'], 'status_id'=>$user['User']['status_id']);
		return new CakeResponse(array (
			'body' => json_encode($userPost),
			'contentType' => 'application/json'
		));
}

public function logout() {
  $this->redirect($this->Auth->logout());
}


}

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
class CamiController extends AppController {

	/**
	 * Controller name
	 *
	 * @var string
	 */

	//var $components = array('Acl', 'CVA');

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
		//	$this -> Auth -> allow('login', 'logout', 'initDb');
	}

	public function index() {
		$departamentModel = ClassRegistry::init("Departament");

		$departamentsInstances = $departamentModel -> find('all');

		$departaments = array();

		foreach ($departamentsInstances as $departament) {
			$cities = $departament['City'];
			foreach ($cities as $city) {
				$departaments[$departament['Departament']['name']][$city['id'] ] =  $city['name'];	
			}
		}
		
	
		$this -> set('departaments', $departaments);

	}

	public function save() {
		$camiModel = ClassRegistry::init('Cami');

		if ($camiModel -> save($this -> data)) {
			return new CakeResponse( array('body' => json_encode(array("id" => $camiModel -> id)), 'type' => 'json'));
		} else {
			$camiModel -> set($this -> data);
			$errorshash = $camiModel -> invalidFields();

			$errors = array();

			foreach ($errorshash as $key => $value) {
				array_push($errors, $value[0]);
			}

			return new CakeResponse( array('body' => json_encode(array("errors" => $errors)), 'type' => 'json'));

		}

	}

	public function listCami() {
			$camiModel = ClassRegistry :: init('Cami');
	$camis = $camiModel ->find('all');

	$postlist = array ();
	foreach($camis as $cami){
		$tuple = array ();
		
		$id = $cami['Cami']['id'];
		array_push($tuple,$cami['Cami']['name'],$cami['Cami']['address'],$cami['Cami']['phone'],$cami['City']['name'],"<a class='edit' id='$id' href='#''>".__("edit")."</a>" );
		array_push($postlist, $tuple);
	}
	
	$columns = array (
			array (
				'sTitle' => __('Name')
			),
			array (
				'sTitle' => __("Address")
			),
			array (
				'sTitle' => __('Phone')
			),array (
				'sTitle' => "City"
			),
			array (
				'sTitle' => ""
			)
			);

		$finalPost = array (
			'aaData' => $postlist,
			'aoColumns' => $columns,
			'sDom' => 'HrtF',
			'sScrollY'=>'200px'

		);
		
		
		return new CakeResponse( array('body' => json_encode($finalPost), 'type' => 'json'));
		

	}

	public function edit() {
		$camiModel = ClassRegistry::init('Cami');
		$user = $camiModel -> findById($this -> data['id']);
		$camiPost = $user['Cami'];
			return new CakeResponse( array('body' => json_encode($camiPost ), 'type' => 'json'));
	}

	public function logout() {
		$this -> redirect($this -> Auth -> logout());
	}

}

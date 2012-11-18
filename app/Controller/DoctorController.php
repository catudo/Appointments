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
class DoctorController extends AppController {

	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'Doctor';

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
		$loggedUser =  $this->Session->read('Auth.User');
		$this -> set('group', $loggedUser['group_id']);

	}
	
	public function main() {
		$loggedUser =  $this->Session->read('Auth.User');
		$this -> set('group', $loggedUser['group_id']);

	}
	
	
	public function list_appointment_response_doctor(){
		
		
		$loggedUser =  $this->Session->read('Auth.User');
		$joins = array(
		 		array(
					'table'=>'Users',
					'alias'=>'User',
					'foreignKey'=>false,
					'type'=>'inner',
					'conditions'=>array(
					'User.id = Appointment.users_id'
					)
				),
		 		array(
					'table'=>'Users',
					'alias'=>'Doctor',
					'foreignKey'=>false,
					'type'=>'inner',
					'conditions'=>array(
					'Doctor.id = Appointment.doctor_id'
					)
				),
				array(
					'table'=>'Specialities',
					'alias'=>'Speciality',
					'foreignKey'=>false,
					'type'=>'inner',
					'conditions'=>array(
					'Doctor.speciality_id = Speciality.id'
					)
				),
				array(
					'table'=>'Schedules',
					'alias'=>'Schedule',
					'foreignKey'=>false,
					'type'=>'inner',
					'conditions'=>array(
					'Schedule.id = Appointment.schedule_id'
					)
				)
				
			);
		
		$fields = array("User.*", "Schedule.*","Appointment.*");
		
		$appointments =  ClassRegistry::init('Appointment')->find("all",array('conditions'=>array('Appointment.doctor_id'=>$loggedUser['id']),'joins'=>$joins,'fields'=>$fields));
		
		$data = array();
		foreach ($appointments as $appointment) {
			$tuple = array();
			$tuple[] = $appointment['User']['first_name']." ".$appointment['User']['last_name'];
			$tuple[] = $appointment['Appointment']['date'];
			$entryHour = ($appointment['Schedule']['entry_hour']<10)?"0".$appointment['Schedule']['entry_hour']:$appointment['Schedule']['entry_hour'];
			$entryminute = ( $appointment['Schedule']['entry_minute']<10)?"0". $appointment['Schedule']['entry_minute']: $appointment['Schedule']['entry_minute'];
			$tuple[] = "$entryHour:$entryminute";
			$appointmentId = $appointment['Appointment']['id'];
			//$tuple[] = "<a class='cancel' appointmentId='$appointmentId' href='#''>Cancel Appointment</a>" ;
			$data[] = $tuple;		
		}
		
			$columns[] = array('sTitle' => "Pacient");
			$columns[] = array('sTitle' => "Date");
			$columns[] = array('sTitle' => "Hour");
			
		
		$finalPost = array (
			'aaData' => $data,
			'aoColumns' => $columns,
			'sDom' => 'HrtF',
			'sScrollY'=>'150px'

		);
		return new CakeResponse( array('body' => json_encode($finalPost ), 'type' => 'json'));
		
	} 
	
	

	

}

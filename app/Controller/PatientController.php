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
class PatientController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	

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
	}

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */

 	public function create_index(){
 		 
		$departamentModel = ClassRegistry::init("Departament");

		$departamentsInstances = $departamentModel -> find('all');

		$departaments = array('0'=>'');

		foreach ($departamentsInstances as $departament) {
			$cities = $departament['City'];
			foreach ($cities as $city) {
				$departaments[$departament['Departament']['name']][$city['id'] ] =  $city['name'];	
			}
		}
		
		$loggedUser =  $this->Session->read('Auth.User');
		$this -> set('group', $loggedUser['group_id']);
		$this -> set('departaments', $departaments);

 	}
	
	public function save(){
		
		
	}
	
	
	public function appointment_results(){
		
		
	}
	
	public function list_appointments(){
		$loggedUser =  $this->Session->read('Auth.User');
		$this -> set('group', $loggedUser['group_id']);
		 
		
	}
	
	
	public function change_password(){
	
	}
	
	
	
	
	public function delete_appointment(){
		
	}
	
	
	public function get_information(){
		$this -> layout = 'ajax';
		$model = $this -> data['model'];
		$options = array();
		$label = '';
		$tagId = '';
		switch ($model) {
			case 'city_id':
				$tagId = 'cami_id';
				$camiModel = ClassRegistry::init('Cami');
				$camis = $camiModel->find("all", array("conditions"=> array('city_id'=> $this -> data['value'])));
				
				if(sizeof($camis)>0){
			
						$options[0]='';
					foreach ($camis as $cami) {
						$options[$cami['Cami']['id']] = $cami['Cami']['name']; 
					}
					$label = 'Select the Cami where you want your appointment';	
				}
				
				else
				$label = 'There are not Camis close to the selected localitation';
				
				break;
			case 'cami_id':
				
				
				
				$tagId = 'speciality_id';
				$camiId = $this -> data['value'];
				
				$userModel = ClassRegistry::init('User');
			
				$joins = array(
		 		array(
					'table'=>'Specialities',
					'alias'=>'Speciality',
					'foreignKey'=>false,
					'type'=>'inner',
					'conditions'=>array(
					'Speciality.id = User.speciality_id'
					)
				)
			);
			
				$label = 'Select the Cami where you want your appointment';	
			$fields = array("distinct(Speciality.id)", "Speciality.name" );
				
			$specialities = $userModel->find("all", array('conditions'=>array('cami_id'=>$camiId), 'joins'=>$joins, 'fields'=>$fields));	
			
			if(sizeof($specialities>0)){
						$options[0]='';
					foreach ($specialities as $speciality) {
						$options[$speciality['Speciality']['id']] = $speciality['Speciality']['name']; 
					}
					$label = 'Select a Speciality ';	
			}else{
				$label = 'there are not Specialities in the selected Cami';
			}
				
				break;
			case 'speciality_id':
			$tagId = 'doctor_id';
				$userModel = ClassRegistry::init('User');
				$doctors = $userModel->find("all",array('conditions'=> array('speciality_id'=>$this -> data['value'])));
				
				if(sizeof($doctors)!=0){
				$options[0]='';
				foreach ($doctors as  $doctor) {
					$options[$doctor['User']['id']] = $doctor['User']['first_name']." ".$doctor['User']['last_name']; 
				}
				$label = 'Select a doctor of your preference';
				
				}else{
				$label = 'There are not doctors avaliable to this speciality';		
				}
				break;
				
		 	case 'doctor_id':
			
			$userId = $this -> data['value'];
			$date = $this -> data['date'];
		 	$finalPost =  $this->list_schedule($userId,$date);
			 
			return new CakeResponse( array('body' => json_encode($finalPost ), 'type' => 'json'));
				
			break;
				
				
		}
		
		$this->set("options",$options);
		$this->set("label",$label);
		$this->set("tagId",$tagId);
		
	}
	
	private function list_schedule($userId,$date){
		
		$weekday = date('N', strtotime($date));
		$scheduleModel = ClassRegistry::init('Schedule');
		
		
		$userM = ClassRegistry::init('User');
		
		$user = $userM->findById($userId);
		
		$surgery = $user['User']['surgery'];
		
		$appointmentModel = ClassRegistry::init('Appointment');
		
		$appointments = $appointmentModel->find("all", array('conditions'=>array('doctor_id'=>$userId, 'date'=>$date)));
		
		$scheduleDated = array();
		
		foreach ($appointments as $appointment) {
			$scheduleDated[] =  $appointment['Appointment']['schedule_id'];
		}
		
		
		$schedules = $scheduleModel->find("all",array('conditions'=>array('user_id'=>$userId,'week_day'=>$weekday  ),  
			'order'=>array(
				'week_day ASC', 'entry_hour ASC','entry_minute ASC', 'exit_hour ASC','exit_minute ASC' 
		)));
			
	
		$postlist = array ();
		
		
		
		foreach ($schedules as $schedule) {
			
			$tuple = array();
			//$tuple[] = "<input type='radio' name='schedule_id' value='".$schedule['Schedule']['id']."/>";
			/*
			$radio ='
			<label class="radio">
			<div class="radio" id="uniform-optionsRadios1">
			<span class="">
			<input type="radio" checked="" value="'.$schedule['Schedule']['id'].'" id="optionsRadios1" name="schedule_id" style="opacity: 0;"></span></div>
			'.$surgery.'
			</label>
			';
			 * 
			 * 
			 */
			 
			 
			 $radio = '<input type="radio" name="schedule_id" >'.$surgery;				  
			$tuple[]= $radio;
			
			$entryHour = ($schedule['Schedule']['entry_hour']<10)?"0".$schedule['Schedule']['entry_hour']:$schedule['Schedule']['entry_hour'];
			$entryminute = ( $schedule['Schedule']['entry_minute']<10)?"0". $schedule['Schedule']['entry_minute']: $schedule['Schedule']['entry_minute'];
			
			$tuple[] = "$entryHour:$entryminute";
			
			
			if(!in_array($schedule['Schedule']['id'], $schedule))
			$postlist[]= $tuple;
						
		}
		
			$columns[] = array('sTitle' => "Surgery");
			$columns[] = array('sTitle' => "Hour");
			
		
	
		$finalPost = array (
			'aaData' => $postlist,
			'aoColumns' => $columns,
			'sDom' => 'HrtF',
			'sScrollY'=>'150px'

		);
		
		return $finalPost;
	
			
		
		
		
		
	}
	
	
 
 
 
 
 
}

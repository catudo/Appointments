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
class SchedulesController extends AppController {


/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function index() {
	 $days = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');	
		
		$hours = array();
		
		for ($i=0; $i < 24; $i++) { 
			$hours[$i]= ($i<10)?"0$i":$i; 
		}
		
		$minutes = array();
		
		for ($i=0; $i <= 59; $i++) { 
			$minutes[$i]= ($i<10)?"0$i":$i; 
		}
		
		
		$doctorInstance = ClassRegistry::init("User");
		
		$doctorsModels = $doctorInstance->find("all",array('conditions'=>array('group_id'=>2)));	
		
		$doctors=array();
		$doctors[0] = "";
		foreach ($doctorsModels  as $doctor) {
		
			$doctors[$doctor['User']['id']] = $doctor['User']['first_name']."  ".$doctor['User']['last_name'];
		
		}
		$loggedUser =  $this->Session->read('Auth.User');
		$this -> set('group', $loggedUser['group_id']);
		$this -> set('doctors', $doctors);
		$this -> set('hours', $hours);
		$this -> set('minutes', $minutes);
		$this -> set('days', $days);
		unset($doctors[0]);
		$this -> set('doctorList', $doctors);
		
		
		
	}
	
	
	public function save(){
		
		$scheduleModel = ClassRegistry::init('Schedule');

		if ($scheduleModel -> save($this -> data)) {
			return new CakeResponse( array('body' => json_encode(array("id" => $scheduleModel -> id)), 'type' => 'json'));
		} else {
			$scheduleModel -> set($this -> data);
			$errorshash = $scheduleModel -> invalidFields();
			$errors = array();
			foreach ($errorshash as $key => $value) {
				array_push($errors, $value[0]);
			}
			return new CakeResponse( array('body' => json_encode(array("errors" => $errors)), 'type' => 'json'));

		}
		
	}
	
	public function delete(){
		$id = $this -> data['id'];
		$scheduleModel = ClassRegistry::init('Schedule');
		$scheduleModel->delete($id);
		return new CakeResponse( array('body' => json_encode(array("id" => $id)), 'type' => 'json'));
		
	}
	
	public function edit(){
		$id = $this -> data['userId'];
		$scheduleModel = ClassRegistry::init('Schedule');
		$schedule = $scheduleModel->findById($id);
		return new CakeResponse( array('body' => json_encode($schedule['Schedule']), 'type' => 'json'));		
	}
	
	public function listSchedules(){
		$days = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');	
			
		$id = $this -> data['user_id'];
		
		$scheduleModel = ClassRegistry::init('Schedule');
		$schedules = $scheduleModel->find("all",array('conditions'=>array('user_id'=>$id),  
			'order'=>array(
				'week_day ASC', 'entry_hour ASC','entry_minute ASC', 'exit_hour ASC','exit_minute ASC' 
			) ));
		$postlist = array ();
		
		//print_r( sizeof($schedules));
		
		foreach ($schedules as $schedule) {
			
			$tuple = array();
			
			$tuple[] = $days[$schedule['Schedule']['week_day']];
			
			$entryHour = ($schedule['Schedule']['entry_hour']<10)?"0".$schedule['Schedule']['entry_hour']:$schedule['Schedule']['entry_hour'];
			$entryminute = ( $schedule['Schedule']['entry_minute']<10)?"0". $schedule['Schedule']['entry_minute']: $schedule['Schedule']['entry_minute'];
			
			$exitHour = ( $schedule['Schedule']['exit_hour']<10)?"0". $schedule['Schedule']['exit_hour']: $schedule['Schedule']['exit_hour'];
			$exitMinute = ( $schedule['Schedule']['exit_minute']<10)?"0".$schedule['Schedule']['exit_minute']: $schedule['Schedule']['exit_minute'];
			
			$tuple[] = "$entryHour:$entryminute";
			$tuple[] = "$exitHour:$exitMinute";
			
			$tuple[] = "<a class='edit' userId='".$schedule['Schedule']['id']."' href='#''>".__("edit")."</a>" ;
			$tuple[] = "<a class='delete' userId='".$schedule['Schedule']['id']."' href='#''>".__("delete")."</a>" ;
			$postlist[]= $tuple;
						
		}
		
		
		
			$columns[] = array('sTitle' => 'day');
			$columns[] = array('sTitle' => "Entry hour");
			$columns[] = array('sTitle' => "Exit hour");
			$columns[] = array('sTitle' => "");
			$columns[] = array('sTitle' => "");
		
		
	
		$finalPost = array (
			'aaData' => $postlist,
			'aoColumns' => $columns,
			'sDom' => 'HrtF',
			'sScrollY'=>'150px'

		);
		
		
	
			
		return new CakeResponse( array('body' => json_encode($finalPost ), 'type' => 'json'));
		
	}
	
	
}

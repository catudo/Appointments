<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * Language Model
 *
 */
class Schedule extends AppModel {
	
	 public $validate = array(
        'week_day' => array(
           'intervalRule' => array(
                'rule' =>'intervalRule',
                'message'  => 'schedule interval is wrong'
            )
        )   
    );
	
	
	
	public function intervalRule($check){
		$userId = $this -> data['Schedule']['user_id'];
		$weekDay = $this -> data['Schedule']['week_day'];
		
		$entryHour = $this -> data['Schedule']['entry_hour'];
		$entryMinute = $this -> data['Schedule']['entry_hour'];
		
		$exitHour = $this -> data['Schedule']['exit_hour'];
		$exitMinute = $this -> data['Schedule']['exit_minute'];
		
		if($entryHour>$exitHour){
			return false;
			
		}
		
		
		$schedules = $this->find("all",array('conditions'=>array('user_id'=>$userId, 'week_day'=>$weekDay)));
		
		$entryParam = $entryHour*$entryMinute;
		$exitParam = $exitHour*$exitMinute;
		if(sizeof($schedules)==0){
			return true;
		}else{
			$daysValues = array();
			foreach ($schedules as $schedule) {
				$entryFactor = $schedule['Schedule']['entry_hour']*$schedule['Schedule']['entry_minute'];
				$exitFactor = $schedule['Schedule']['exit_hour']*$schedule['Schedule']['exit_minute'];
				if($entryParam>=$entryFactor && $entryParam<= $exitFactor){
					return false;
				}else if($exitParam>= $entryFactor && $exitParam<=$exitFactor){
					return false;
				}
			}
			
		}
		
		return true;
		
	}
	
	

}

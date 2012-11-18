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
		$entryMinute = $this -> data['Schedule']['entry_minute'];
		
		$exitHour = $this -> data['Schedule']['exit_hour'];
		$exitMinute = $this -> data['Schedule']['exit_minute'];
		
		$entryParam = ($entryHour*3600)+($entryMinute*60);
		$exitParam = ($exitHour*3600)+($exitMinute*60);
		
		if($entryParam>=$exitParam){
			return false;
			
		}
		
		$schedules = $this->find("all",array('conditions'=>array('user_id'=>$userId, 'week_day'=>$weekDay)));
		
		
		if(sizeof($schedules)==0){
			return true;
		}else{
			$daysValues = array();
			foreach ($schedules as $schedule) {
				if($schedule['Schedule']['id']!=$this -> data['Schedule']['id']){	
				$entryFactor = ($schedule['Schedule']['entry_hour']*3600)+($schedule['Schedule']['entry_minute']*60);
				$exitFactor = ($schedule['Schedule']['exit_hour']*3600)+($schedule['Schedule']['exit_minute']*60);
				
				if($entryParam>=$entryFactor && $entryParam<= $exitFactor){
					return false;
				}else if($exitParam>= $entryFactor && $exitParam<=$exitFactor){
					return false;
				}
			}
		}
			
		}
		
		return true;
		
	}



	
	

}

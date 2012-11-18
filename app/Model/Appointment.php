<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Language Model
 *
 */
class Appointment extends AppModel {
	public $validate = array(
        'schedule_id' => array(
           
			'notEmpty' => array(
                'rule' =>'notEmpty',
                'message'  => 'select and option'
            )
        )
        		
		
    );


}


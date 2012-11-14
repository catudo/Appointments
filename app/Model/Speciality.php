<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Language Model
 *
 */
class Speciality extends AppModel {

	public $name = 'Speciality';
		
	 public $validate = array(
        'name' => array(
           
			'notEmpty' => array(
                'rule' =>'notEmpty',
                'message'  => 'name is required'
            ),
			
			
			'isUnique' => array(
                'rule'     => 'isUnique',
                'message'  => 'name must be unique'
            )
        ),
    	
    );
	
	var $hasMany = array('User' => array('className' => 'User', 'foreignKey' => 'speciality_id'));

}

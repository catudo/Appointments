<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Language Model
 *
 */
class Departament extends AppModel {

	public $name = 'departament';
	var $hasMany = array('City' => array('className' => 'City', 'foreignKey' => 'departament_id'));
	
	
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
	

}

<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Language Model
 *
 */
class City extends AppModel {

	public $name = 'city';
	
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
	
	
	
	var $belongsTo = array('Departament' => array('className' => 'Departament', 'foreignKey' => 'departament_id'));
	var $hasMany = array('Cami' => array('className' => 'Cami', 'foreignKey' => 'city_id'));
}

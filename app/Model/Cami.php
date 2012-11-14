<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Language Model
 *
 */
class Cami extends AppModel {

	public $name = 'Cami';
	
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
        'address' => array(
           
			'notEmpty' => array(
                'rule' =>'notEmpty',
                'message'  => 'address is required'
            ),
			
			
			'isUnique' => array(
                'rule'     => 'isUnique',
                'message'  => 'address must be unique'
            )
        )
		
				
		
    );
	
	
	
	var $belongsTo = array('City' => array('className' => 'City', 'foreignKey' => 'city_id'));

}

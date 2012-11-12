<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Language Model
 *
 */
class Group extends AppModel {
	
	public $name = 'group';
	public $validate = array(
            'name' => array(
               'rule'    => 'isUnique',
        		'message' => "user.username.unique.contraint"
            )
            
        );
    
	public $actsAs = array('Acl' => array('type' => 'requester'));

    public function parentNode() {
        return null;
    }

}

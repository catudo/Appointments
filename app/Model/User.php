<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * Language Model
 *
 */
class User extends AppModel {

	public $name = 'user';

	var $belongsTo = array('Group' => array('foreignKey' => 'group_id'));
	
	

	public $actsAs = array('Acl' => array('type' => 'requester'));
	
	 public $validate = array(
        'document' => array(
           
			'notEmpty' => array(
                'rule' =>'notEmpty',
                'message'  => 'document is required'
            ),
			
			
			'isUnique' => array(
                'rule'     => 'isUnique',
                'message'  => 'document must be unique'
            )
        ),
        'last_name' => array(
           
			'notEmpty' => array(
                'rule' =>'notEmpty',
                'message'  => 'last name is required'
            )
        )
		,
        'first_name' => array(
           
			
			'notEmpty' => array(
                'rule' =>'notEmpty',
                'message'  => 'first name is required'
            )
        ),
		
        'address' => array(
            
			
			'notEmpty' => array(
                'rule' =>'notEmpty',
                'message'  => 'address is required'
            ),
            
        ),
		'phone' => array(
            
			'notEmpty' => array(
                'rule' =>'notEmpty',
                'message'  => 'phone is required'
            ),
            
        ),
        'password' => array(
           'notEmpty' => array(
                'rule' =>'notEmpty',
                'message'  => 'password is required',
                'on' =>'create'
            ),
            'equalString' => array(
                'rule' =>'equalString',
                'message'  => 'password and second password must be equals',
                'on' =>'create'
            )
            
        )  
    );
	
	
	

	public function parentNode() {
		if (!$this -> id && empty($this -> data)) {
			return null;
		}
		if (isset($this -> data['User']['group_id'])) {
			$groupId = $this -> data['User']['group_id'];
		} else {
			$groupId = $this -> field('group_id');
		}
		if (!$groupId) {
			return null;
		} else {
			return array('Group' => array('id' => $groupId));
		}
	}

	public function beforeSave($options = array()) {
		$this -> data['User']['secondPassword'] = AuthComponent::password($this -> data['User']['secondPassword']);
		if (!array_key_exists('id', $this -> data) || $this -> data['id'] == null || $this -> data['id'] == ''){
			$this -> data['User']['status_id'] = 1;
			$this -> data['User']['password'] = AuthComponent::password($this -> data['User']['password']);
		}else {
			if (array_key_exists('password', $this -> data) ) {
				$this -> data['User']['password'] = AuthComponent::password($this -> data['password']);
			} else {
				$user = $this -> findById($this -> data['id']);
				$this -> data['password'] = $user['User']['password'];
			}
		}
		return true;
	}



    public function equalString($check) {
        	
			
       if (!array_key_exists('id', $this -> data['User']) || $this -> data['User']['id'] == null || $this -> data['User']['id'] == ''){
        	
			if($this ->data['User']['password'] ==$this ->data['User']['secondPassword'])
        		return true ;
			else
				return false;	
		}else{
			
			if (array_key_exists('password', $this -> data) && $this -> data['secondPassword']  ){
				if($this ->data['User']['password'] ==$this ->data['User']['secondPassword'])
        		return true ;
			else
				return false;
			}
		}
		
		
    }

}

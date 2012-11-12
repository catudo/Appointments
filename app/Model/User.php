<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * Language Model
 *
 */
class User extends AppModel {
	
	public $name = 'user';
   
 	var $belongsTo = array('Group' => array('foreignKey'=> 'group_id'));    
   
   
    public $actsAs = array('Acl' => array('type' => 'requester'));
       public $validate = array(
            'document' => array(
               'rule'    => 'isUnique',
        		'message' => "user.username.unique.contraint"
            )
            
        );
    

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    }
	
	
	public function beforeSave($options = array()) {
		
		if(!array_key_exists('id', $this->data['User'])||$this->data['User']['id']==null || $this->data['User']['id']=='')
        $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        else{
        	if (array_key_exists('password', $this->data['User'])){
        		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        	}else{
        		$user = $this->findById($this->data['User']['id']);
        		$this->data['User']['password']  = $user['User']['password'];
        	}
        }
        return true;
    }
    
}

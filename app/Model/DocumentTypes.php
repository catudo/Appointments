<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Language Model
 *
 */
class DocumentTypes extends AppModel {
	
	public $name = 'document_type';
	
	public $validate = array(
            'name' => array(
               'rule'    => 'isUnique',
        		'message' => "repeated Document type"
            )
            
        );
		

}

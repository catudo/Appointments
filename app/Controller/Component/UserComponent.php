<?php

App::uses('Component', 'Controller');
class UserComponent extends Component {
    
	
	
	public function listUser($groupId){
		
		
	$this->layout = 'ajax';
	$userModel = ClassRegistry :: init('User');
	$users = $userModel->find('all',array("conditions"=>
			array( 'group_id'=>$groupId)));

	$postlist = array ();
	foreach($users as $user ){
		$tuple = array ();
		$userId = $user['User']['id'];

		array_push($tuple,$user['User']['document'],$user['User']['first_name'].$user['User']['last_name'], ($user['User']['status_id']==1)?__("Active"):__("Inactive"),"<a class='edit' userId='$userId' href='#''>".__("edit")."</a>" );
		array_push($postlist, $tuple);
	}
	
	$columns = array (
			array (
				'sTitle' => __('document')
			),
			array (
				'sTitle' => __("names")
			),
			array (
				'sTitle' => __('status')
			),array (
				'sTitle' => ""
			)
			);

		$finalPost = array (
			'aaData' => $postlist,
			'aoColumns' => $columns,
			'sDom' => 'HrtF',
			'sScrollY'=>'150px'

		);
		
		
		return $finalPost;
		
	}


}


?>
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

		array_push($tuple,$user['User']['document'],$user['User']['first_name']." ".$user['User']['last_name']);
		$status = ($user['User']['status_id']==1)?__("Active"):__("Inactive");
		$tuple[]=   "<a class='status' userId='$userId' href='#''>".$status."</a>"    ;
		
		$camiModel = ClassRegistry :: init('Cami');
		$specialityModel = ClassRegistry :: init('Speciality');
		
		
		if($groupId==2){
			$cami=	$camiModel ->findById($user['User']['cami_id']);
			$tuple[]= $cami['Cami']['name'];
			$speciality=$specialityModel ->findById($user['User']['speciality_id']);
			$tuple[]=$speciality['Speciality']['name'];
		}
		
		$tuple[]="<a class='edit' userId='$userId' href='#''>".__("edit")."</a>" ;
		
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
			)
		);
		
		
		
		if($groupId==2){
			$columns[] = array ('sTitle' => 'Cami');
			$columns[] = array ('sTitle' => 'Speciality');	
			
		}
		
		$columns[] = array ('sTitle' => '');
		

		$finalPost = array (
			'aaData' => $postlist,
			'aoColumns' => $columns,
			'sDom' => 'HrtF',
			'sScrollY'=>'150px'

		);
		
		
		return $finalPost;
		
	}


	public function changeStatus($userId){
		$userModel = ClassRegistry::init('User');
		$user = $userModel->findById($userId);
		$status = ($user['User']['status_id']==0)?1:0;
		$userModel->updateAll(array('User.status_id'=>$status),array('User.id'=>$userId));
		return $user;  
	}


}


?>
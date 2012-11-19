<?php
App::uses('Controller', 'Controller');
App::uses('AppController', 'Controller');
App::uses('ComponentCollection', 'Controller');
App::uses('AclComponent', 'Controller/Component');
App::uses('DbAcl', 'Model');
class InstallerShell extends Shell {
	public $uses = array('User','Group','Acos','PrimaryKey','DocumentTypes', 'Departament','Speciality','DocumentType');
	public $Acl;
	public $args;
	public $dataSource = 'default';
	public $rootNode = 'controllers';
	public $_clean = false;
	public function startup() {
		parent::startup();
		$collection = new ComponentCollection();
		$this->Acl = new AclComponent($collection);
		$controller = new AppController();
		$this->Acl->startup($controller);
		$this->Aco = $this->Acl->Aco;
	}
	function main() {
		$this->_clean = true;
		$this->aco_update();
		$this->install_document_types();
		$this->install_users_and_groups();
		$this->install_cities();
		$this->install_especialities();
	}
	
	
	function install_especialities(){
		$specialities = array("Medicina General", "Odontologia", "Radioterapia","Enfermeria" );
		
		foreach ($specialities as  $value) {
			$this->Speciality->save(array('name'=>$value));
			$this->Speciality->create();
		}
		
		
	}
	
	
	function install_document_types(){
		$CC = array (
			'name' => 'CC'
		);
		
		$this->DocumentTypes->save($CC);
		$this->DocumentTypes->create();
		
		
		$TI = array (
			'name' => 'TI'
		);
		
		$this->DocumentTypes->save($TI);
		$this->DocumentTypes->create();
		
	}
	
	
	public function install_cities(){
		$departaments = array(
		array('name'=>'Cundinamarca', 'City'=>array(array('name'=>'Bogota'),array('name'=>'Fomeque'))),
		array('name'=>'Antioquia', 'City'=>array(array('name'=>'medellin'),array('name'=>'Pitalito')))
		
		);
		
		foreach ($departaments as $departament) {
			$this->Departament->saveAll($departament);
			$this->Departament->create();
		}
		
	}
	
	
	function install_users_and_groups() {
		$superAdminGroup = array (
			'name' => 'SUPER_ADMIN'
		);
		
		$this->Group->save($superAdminGroup);
		$superAdminUser = array (
			'name' => 'admin',
			'document' => 'admin',
			'password' => 'test',
			'secondPassword' => 'test',
			'group_id' => $this->Group->id,
			'status_id' => 1,
			'document_type_id'=>1
		);
		
		$this->Group->create();
		
		$doctor = array (
			'name' => 'DOCTOR'
		);
		
		
		$this->Group->create();
		$this->Group->save($doctor);
		
		$patient = array (
			'name' => 'PATIENT'
		);
		
		$this->Group->create();
		
		$this->Group->save($patient);
		
		//$this->User->create();
		$this->User->save($superAdminUser);
		
		
		$this->out('Users and Groups Installed'); 
		$this->update_aros_acos();
		$this->out('Aros acos Updated'); 
	}
	function update_aros_acos(){
			
		$group =  $this->Group;
		$groupInstance = $this->Group->findByName("SUPER_ADMIN");  
		$group->id = $groupInstance['Group']['id'];
		$this->Acl->allow($group, 'controllers');
		$adminGroup = $this->Group;
		
		////////////////////////
		
		$patientInstance = $this->Group->findByName("PATIENT");  
		
		//$patientInstance->id =  $patientInstance['Group']['id'];
		$this->Acl->deny($patientInstance, 'controllers');
		$acoses = $this->Acos->find('all',array("conditions"=>array(  array ("alias" => 'Patient'),'parent_id'=>1)));
		foreach ( $acoses as $key=>$value) {
			$this->Acl->allow($patientInstance, $value['Acos']['alias']);
		}
		$this->Acl->allow($patientInstance, "logout");
		
		
		$this->Acl->allow($patientInstance, "display");
		/////////////////////////
		
		$doctorInstance = $this->Group->findByName("DOCTOR");  
		$doctorGroup->id =  $doctorInstance['Group']['id'];
		$this->Acl->deny($doctorInstance, 'controllers');
		$acoses = $this->Acos->find('all',array("conditions"=>array( array ("alias" => 'Doctor'),'parent_id'=>1)));
		foreach ( $acoses as $key=>$value) {
			$this->Acl->allow($doctorInstance, $value['Acos']['alias']);
		}
		$this->Acl->allow($doctorInstance, "logout");
		
			
	}

	function aco_update() {
		$root = $this->_checkNode($this->rootNode, $this->rootNode, null);
		$controllers = $this->getControllerList();
		$this->_updateControllers($root, $controllers);

		$plugins = CakePlugin::loaded();
		foreach ($plugins as $plugin) {
			$controllers = $this->getControllerList($plugin);

			$path = $this->rootNode . '/' . $plugin;
			$pluginRoot = $this->_checkNode($path, $plugin, $root['Aco']['id']);
			$this->_updateControllers($pluginRoot, $controllers, $plugin);
		}
		$this->out(__('<success>Aco Update Complete</success>'));
		return true;
	}
	function _updateControllers($root, $controllers, $plugin = null) {
		$dotPlugin = $pluginPath = $plugin;
		if ($plugin) {
			$dotPlugin .= '.';
			$pluginPath .= '/';
		}
		$appIndex = array_search($plugin . 'AppController', $controllers);
		if ($appIndex !== false) {
			App::uses($plugin . 'AppController', $dotPlugin . 'Controller');
			unset($controllers[$appIndex]);
		}
		// look at each controller
		foreach ($controllers as $controller) {
			App::uses($controller, $dotPlugin . 'Controller');
			$controllerName = preg_replace('/Controller$/', '', $controller);

			$path = $this->rootNode . '/' . $pluginPath . $controllerName;
			$controllerNode = $this->_checkNode($path, $controllerName, $root['Aco']['id']);
			$this->_checkMethods($controller, $controllerName, $controllerNode, $pluginPath);
		}
		if ($this->_clean) {
			if (!$plugin) {
				$controllers = array_merge($controllers, App::objects('plugin', null, false));
			}
			$controllerFlip = array_flip($controllers);

			$this->Aco->id = $root['Aco']['id'];
			$controllerNodes = $this->Aco->children(null, true);
			foreach ($controllerNodes as $ctrlNode) {
				$alias = $ctrlNode['Aco']['alias'];
				$name = $alias . 'Controller';
				if (!isset($controllerFlip[$name]) && !isset($controllerFlip[$alias])) {
					if ($this->Aco->delete($ctrlNode['Aco']['id'])) {
						$this->out(__(
							'Deleted %s and all children',
							$this->rootNode . '/' . $ctrlNode['Aco']['alias']
						), 1, Shell::VERBOSE);
					}
				}
			}
		}
	}
	function getControllerList($plugin = null) {
		if (!$plugin) {
			$controllers = App::objects('Controller', null, false);
		} else {
			$controllers = App::objects($plugin . '.Controller', null, false);
		}
		return $controllers;
	}
	function _checkNode($path, $alias, $parentId = null) {
		$node = $this->Aco->node($path);
		if (!$node) {
			$this->Aco->create(array('parent_id' => $parentId, 'model' => null, 'alias' => $alias));
			$node = $this->Aco->save();
			$node['Aco']['id'] = $this->Aco->id;
			$this->out(__('Created Aco node: %s', $path), 1, Shell::VERBOSE);
		} else {
			$node = $node[0];
		}
		return $node;
	}

	function _checkMethods($className, $controllerName, $node, $pluginPath = false) {
		$baseMethods = get_class_methods('Controller');
		$actions = get_class_methods($className);
		if($className =='VersionsController'){
			$this->out($className  );
			
			$this->out(gettype($actions));
			}
		$methods = array_diff($actions, $baseMethods);
		
		foreach ($methods as $action) {
			if (strpos($action, '_', 0) === 0) {
				continue;
			}
			$path = $this->rootNode . '/' . $pluginPath . $controllerName . '/' . $action;
			$this->_checkNode($path, $action, $node['Aco']['id']);
		}

		if ($this->_clean) {
			$actionNodes = $this->Aco->children($node['Aco']['id']);
			$methodFlip = array_flip($methods);
			foreach ($actionNodes as $action) {
				if (!isset($methodFlip[$action['Aco']['alias']])) {
					$this->Aco->id = $action['Aco']['id'];
					if ($this->Aco->delete()) {
						$path = $this->rootNode . '/' . $controllerName . '/' . $action['Aco']['alias'];
						$this->out(__('Deleted Aco node %s', $path), 1, Shell::VERBOSE);
					}
				}
			}
		}
		return true;
	}

	public function getOptionParser() {
		return parent::getOptionParser()
			->description(__("Better manage, and easily synchronize you application's ACO tree"))
			->addSubcommand('aco_update', array(
				'help' => __('Add new ACOs for new controllers and actions. Does not remove nodes from the ACO table.')
			))->addSubcommand('aco_sync', array(
				'help' => __('Perform a full sync on the ACO table.' .
					'Will create new ACOs or missing controllers and actions.' .
					'Will also remove orphaned entries that no longer have a matching controller/action')
			))->addSubcommand('verify', array(
				'help' => __('Verify the tree structure of either your Aco or Aro Trees'),
				'parser' => array(
					'arguments' => array(
						'type' => array(
							'required' => true,
							'help' => __('The type of tree to verify'),
							'choices' => array('aco', 'aro')
						)
					)
				)
			))->addSubcommand('recover', array(
				'help' => __('Recover a corrupted Tree'),
				'parser' => array(
					'arguments' => array(
						'type' => array(
							'required' => true,
							'help' => __('The type of tree to recover'),
							'choices' => array('aco', 'aro')
						)
					)
				)
			));
	}

	function verify() {
		$type = Inflector::camelize($this->args[0]);
		$return = $this->Acl->{$type}->verify();
		if ($return === true) {
			$this->out(__('Tree is valid and strong'));
		} else {
			$this->err(print_r($return, true));
			return false;
		}
	}

	function recover() {
		$type = Inflector::camelize($this->args[0]);
		$return = $this->Acl->{$type}->recover();
		if ($return === true) {
			$this->out(__('Tree has been recovered, or tree did not need recovery.'));
		} else {
			$this->err(__('<error>Tree recovery failed.</error>'));
			return false;
		}
	}

}
?>

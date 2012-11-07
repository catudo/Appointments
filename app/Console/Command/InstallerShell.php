<?php
App::uses('Controller', 'Controller');
App::uses('Controller', 'AppController');
App::uses('ComponentCollection', 'Controller');
App::uses('AclComponent', 'Controller/Component');
App::uses('DbAcl', 'Model');
class InstallerShell extends Shell {
	public $uses = array('User','Group','Acos','PrimaryKey');
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
		$this->install_users_and_groups();
		$this->_install_sqllite_primary_keys();
	}
	
	function _install_sqllite_primary_keys(){
		/*
		INSERT INTO "Z_PRIMARYKEY" VALUES (1, 'WIIAsset', 0, 158);
INSERT INTO "Z_PRIMARYKEY" VALUES (2, 'WIIBackground', 0, 158);
INSERT INTO "Z_PRIMARYKEY" VALUES (3, 'WIICaption', 0, 0);
INSERT INTO "Z_PRIMARYKEY" VALUES (4, 'WIIDistribution', 0, 2);
INSERT INTO "Z_PRIMARYKEY" VALUES (5, 'WIIExhibition', 0, 8);
INSERT INTO "Z_PRIMARYKEY" VALUES (6, 'WIIExhibitionName', 0, 16);
INSERT INTO "Z_PRIMARYKEY" VALUES (7, 'WIIFrame', 0, 1);
INSERT INTO "Z_PRIMARYKEY" VALUES (8, 'WIIGallery', 0, 0);
INSERT INTO "Z_PRIMARYKEY" VALUES (9, 'WIIKeyWord', 0, 316);
INSERT INTO "Z_PRIMARYKEY" VALUES (10, 'WIILanguages', 0, 2);
INSERT INTO "Z_PRIMARYKEY" VALUES (11, 'WIIStage', 0, 158);
INSERT INTO "Z_PRIMARYKEY" VALUES (12, 'WIIUser', 0, 0);
INSERT INTO "Z_PRIMARYKEY" VALUES (13, 'WIIUserAdvance', 0, 0);
INSERT INTO "Z_PRIMARYKEY" VALUES (14, 'WIIUserConfiguration', 0, 0);
INSERT INTO "Z_PRIMARYKEY" VALUES (15, 'WIIUserExhibitionAdvance', 0, 0);
		*/
		
		$tuples =array(
			array('Z_ENT'=>1, 'Z_NAME'=>'WIIAsset' ),
			array('Z_ENT'=>2, 'Z_NAME'=>'WIIBackground' ),
			array('Z_ENT'=>3, 'Z_NAME'=>'WIICaption' ),
			array('Z_ENT'=>4, 'Z_NAME'=>'WIIDistribution' ),
			array('Z_ENT'=>5, 'Z_NAME'=>'WIIExhibition' ),
			array('Z_ENT'=>6, 'Z_NAME'=>'WIIExhibitionName' ),
			array('Z_ENT'=>7, 'Z_NAME'=>'WIIFrame' ),
			array('Z_ENT'=>8, 'Z_NAME'=>'WIIGallery' ),
			array('Z_ENT'=>9, 'Z_NAME'=>'WIIKeyWord' ),
			array('Z_ENT'=>10, 'Z_NAME'=>'WIILanguages' ),
			array('Z_ENT'=>11, 'Z_NAME'=>'WIIStage' ),
			array('Z_ENT'=>12, 'Z_NAME'=>'WIIUser' ),
			array('Z_ENT'=>13, 'Z_NAME'=>'WIIUserAdvance' ),
			array('Z_ENT'=>14, 'Z_NAME'=>'WIIUserConfiguration' ),
			array('Z_ENT'=>15, 'Z_NAME'=>'WIIUserExhibitionAdvance'),
			array('Z_ENT'=>16, 'Z_NAME'=>'WIIGalleryName'),
			array('Z_ENT'=>18, 'Z_NAME'=>'WIIVersion'),
			array('Z_ENT'=>19, 'Z_NAME'=>'WIIAchievement')
		
		);
		
		foreach ( $tuples as $value ) {
       $this->PrimaryKey->save($value );
       	$this->PrimaryKey->create();
		}
		
		$this->out("sqllite variables installed");
		
		
		
		
	}
	
	function install_users_and_groups() {
		$superAdminGroup = array (
			'name' => 'SUPER_ADMIN'
		);
		
		$this->Group->save($superAdminGroup);
		$superAdminUser = array (
			'name' => 'admin',
			'username' => 'admin',
			'password' => 'test',
			'group_id' => $this->Group->id,
			'status_id' => 1
		);
		
		$this->Group->create();
		
		$AdminGroup = array (
			'name' => 'ADMIN'
		);
		
		$this->Group->save($AdminGroup);
		
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
		$groupInstance = $this->Group->findByName("ADMIN");  
		$adminGroup->id =  $groupInstance['Group']['id'];
		$this->Acl->deny($adminGroup, 'controllers');
		$this->Acl->deny($adminGroup, 'Users');
		$acoses = $this->Acos->find('all',array("conditions"=>array( "NOT" => array ("alias" => 'Users'),'parent_id'=>1)));
		foreach ( $acoses as $key=>$value) {
			$this->Acl->allow($adminGroup, $value['Acos']['alias']);
		}
			
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

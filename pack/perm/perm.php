<?php
class perm{
	private $_config;
	public function perm($config){
		global $smarty, $db;
		if(!is_array($config))
		return false;
		$this->_config = $config;
		if(isset($this->_config['maintenance']) && $this->_config['maintenance']){
			if(isset($this->_config['maintenance_message']))
			$smarty->assign('MESSAGE', $this->_config['maintenance_message']);
			showTemplate('maintenance', 'perm');
			exit;
		}
	}
	public function checkperm($packname){
		global $smarty, $db;
		if(!isset($this->_config['usual']))
		$usual = 'denie';
		else
		$usual = $this->_config['usual'];
		//Berechtigungen laden
		$perm = $db->query("SELECT `level`, `pack` FROM `perm` WHERE `pack` = '" . $db->escape($packname) . "'");
		$perm = $perm->FetchRow();
		var_dump($perm);
		//Falls nicht anderes verfügbar usual verwenden
		switch($usual){
			case 'denie':
				$smarty->assign('MODUL', $packname);
				showTemplate('permission', 'perm');
				exit;
				break;
			case 'allow':
				break;
			default:
				$smarty->assign('MODUL', $packname);
				showTemplate('permission', 'perm');
				exit;
				break;
		}
		return true;
	}
}
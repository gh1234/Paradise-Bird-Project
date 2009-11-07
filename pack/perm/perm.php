<?php
class perm{
	private $config;
	public function perm($packname, $config, $id = true){
		global $smarty;
		if(!is_array($config))
			return false;
		$this->config = $config;
		if(isset($this->config['maintenance']) && $this->config['maintenance']){
			if(isset($this->config['maintenance_message']))
				$smarty->assign('MESSAGE', $this->config['maintenance_message']);
			showTemplate('maintenance', 'perm');
			exit;
		}
	}
}
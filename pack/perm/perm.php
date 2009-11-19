<?php
/*
 * This file is part of Paradise-Bird-Project.

 * Paradise-Bird-Project is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * Paradise-Bird-Project is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with Paradise-Bird-Project.  If not, see <http://www.gnu.org/licenses/>.
 */
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
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
		global $smarty, $db, $pm, $user;
		if(!is_array($config))
		return false;
		$this->_config = $config;
		if(isset($this->_config['maintenance']) && $this->_config['maintenance'] && !$this->getPerm('NO_MAINTENANCE')){
			if(isset($this->_config['maintenance_message']))
			$smarty->assign('MESSAGE', $this->_config['maintenance_message']);
			showTemplate('maintenance', 'perm');
			echo $pm->getTpl();
			exit;
		}
	}
	public function checkperm($packname, $perm = array()){
		global $smarty, $db, $user, $pm;
		if(!isset($this->_config['usual']))
		$usual = 'denie';
		else
		$usual = $this->_config['usual'];
		switch($usual){
			case 'denie':
				$smarty->assign('MODUL', $packname);
				showTemplate('permission', 'perm');
				echo $pm->getTpl();
				exit;
				break;
			case 'allow':
				break;
			default:
				$smarty->assign('MODUL', $packname);
				showTemplate('permission', 'perm');
				echo $pm->getTpl();
				exit;
				break;
		}
		return true;
	}
	public function getPerm($permName){
		global $db, $user;
		$permUserId = $user->getCurrentId();
		if($permUserId === false){
			if(isset($this->_config['usual'])){
				if($this->_config['usual'] == 'allow'){
					return true;
				}
				return false;
			}
			return false;
		}
		$permUser = $this->_getUserPermInf($permUserId, $permName);
		$permGroup = $this->_getGroupPermInf($permUserId, $permName, false);
		if($permUser === -2 && $permGroup === -2){
			if(isset($this->_config['usual'])){
				if($this->_config['usual'] == 'allow'){
					return true;
				}
				return false;
			}
			return false;
		}
		$permAll = $this->_joinPerm($permUser, $permGroup);
		return $permAll;
	}
	/**
	 * Gets permissions for a single user
	 * @param int $userId
	 * @param string $permName
	 * @return int 1=allowed 0=not allowed -1=denied -2=not found
	 */
	private function _getUserPermInf($userId, $permName){
		global $db;
		$perm = $db->Execute("SELECT `value` FROM `perm` WHERE `type` = '1' AND `bind_id` = '".$userId."' AND `name` = '".$db->escape($permName)."'");
		if(isset($perm->fields[0]))
		return $perm->fields[0];
		return -2;
	}
	/**
	 * Gets permissions for a group
	 * @param int $groupId User or group id (see $isGroupId)
	 * @param string $permName
	 * @param bool $isGroupId converts userid to groupid on false
	 * @return int 1=allowed 0=not allowed -1=denied -2=not found
	 */
	private function _getGroupPermInf($groupId, $permName, $isGroupId){
		global $db;
		if(!$isGroupId){
			$group = $db->Execute("SELECT `group` FROM `user` WHERE `id` = '".$groupId."'");
			if(isset($group->fields[0]))
				$groupId = $group->fields[0];
			else
				return -2;
		}
		$perm = $db->Execute("SELECT `value` FROM `perm` WHERE `type` = '2' AND `bind_id` = '".$groupId."' AND `name` = '".$db->escape($permName)."'");
		if(isset($perm->fields[0]))
		return $perm->fields[0];
		return -2;
	}
	/**
	 * Joins two perm values
	 * @param int $perm1
	 * @param int $perm2
	 * @return bool true=granted false=denied
	 */
	private function _joinPerm($perm1, $perm2){
		if($perm1 == -1 || $perm2 == -1)
			return false;
		if($perm1 == 1 || $perm2 == 1)
			return true;
		return false;
	}
}
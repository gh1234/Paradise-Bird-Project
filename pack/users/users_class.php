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
session_start();
class users{
	private $_config;
	private $_userInformation = array();
	public function users($config){
		$this->_config = $config;
		if(!isset($_SESSION['user'])){
			$this->loginGuest();
			return false;
		} else {
			$this->_userInformation = $_SESSION['user'];
		}
	}
	public function login($username, $password, $allowRestricted = false){
		global $db;
		if(!$allowRestricted){
			if(isset($this->_config['restricted']) && in_array($username, $this->_config['restricted']))
				return -1;
		}
		//So... einloggen das heißt mächtig rumsalzen:
		$user = $db->query("SELECT * FROM `user` WHERE `username` = '" . $db->escape($username) . "'");
		if(!$user)
			return -1;
		$data = $user->FetchRow();
		if(!$data){
			return -1;
		}
		if(!compareSaltString($data['password'], $password, $data['password_salt'])){
			return -2;
		}
		$_SESSION['user'] = $data;
		$this->users($this->_config);
		return true;
	}
	public function logout(){
		unset($_SESSION['user']);
	}
	public function loginGuest($language){
		$this->login('guest', 'guest', true);
		
		$this->users($this->_config);
	}
}
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
/**
 * Users class
 * @author Jonas Schwabe
 * TODO: A lot of features
 */
class users{
	/**
	 * Config from packagemanager
	 * @var array
	 */
	private $_config;
	/**
	 * Userinfo, also saved in the session
	 * @var array
	 */
	private $_userInformation = array();
	/**
	 * Saves settings in class
	 * @param array $config
	 * @param bool $guest if there is no user logged in, log in a guest
	 * @return bool
	 */
	public function users($config, $guest = true){
		$this->_config = $config;
		if(!isset($_SESSION['user'])){
			if($guest)
			$this->loginGuest('default');
			return false;
		} else {
			$this->_userInformation = $_SESSION['user'];
		}
	}
	/**
	 * Logs a user in
	 * @param string $username
	 * @param string $password
	 * @param bool $allowRestricted
	 * @return bool, int on failure
	 */
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
		$this->users($this->_config, false);
		return true;
	}
	/**
	 * Kills the session
	 * @return bool
	 */
	public function logout(){
		unset($_SESSION['user']);
		return true;
	}
	/**
	 * Creates a new account
	 * @param string $username
	 * @param string $password
	 * @param array $specialArr More information key=db-column values=value
	 * @param string $language
	 * @return bool, int on failure
	 */
	public function create_user($username, $password, $specialArr = array(), $language = 'default'){
		global $db;
		if($language == 'default'){
			$language = $this->_config['defaultlang'];
		}
		//TODO check if language exists
		if($this->userExists($username))
			return -1;
		$pwsalt = genSalt($password);
		$names = '`username`, `password`, `password_salt`';
		$values = "'".$db->escape($username)."', '".$pwsalt[0]."', '".$pwsalt[1]."'";
		$result = $db->query("INSERT INTO `user` (".$names.") VALUES (".$values.")");
		if(!$db->Affected_Rows())
			return -2;
		return true;
	}
	/**
	 * Checks if a user exists
	 * @param string $username
	 * @return bool
	 */
	public function userExists($username){
		global $db;
		$user = $db->query("SELECT `username` FROM `user` WHERE `username` = '".$db->escape($username)."'");
		if($user->NumRows())
			return true;
		return false;
	}
	/**
	 * Trace guests within logging them in
	 * @param string $language Userlanguage
	 * @return bool, int on failure
	 */
	public function loginGuest($language = 'default'){
		if($language == 'default'){
			$language = $this->_config['defaultlang'];
		}
		$this->logout();
		return $this->login('guest', 'guest', true);
	}
	public function updateUserdata($userid, $data){
		
	}
	/**
	 * Gets userid useing the username
	 * @param string $username
	 * @return int, bool on failure
	 */
	public function getIdFromName($username){
		global $db;
		$user = $db->query("SELECT `id` FROM `user` WHERE `username` = '".$db->escape($username)."'");
		$user = $user->FetchRow();
		if(isset($user[0]))
			return $user[0]*1;
		return false;
	}
}
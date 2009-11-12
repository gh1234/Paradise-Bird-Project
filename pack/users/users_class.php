<?php
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
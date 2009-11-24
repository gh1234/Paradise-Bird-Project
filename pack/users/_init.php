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
include("users_class.php");
include("users_functions.php");
global $user;
$user = new users($config);
if(isset($_GET['users_action']))
	$action = $_GET['users_action'];
else
	$action = 'main';
switch($action){
	case 'login':
		$result = $user->login($_POST['users_username'], $_POST['users_password']);
		if($result < 1){
			$pm->showPackError('login_incorrect', 'users', 403, true);
			exit;
		}
		if($result == true){
			$pm->showPackError('login_done', 'users', 200, true, 'index.php');
			exit;
		}
		break;
	case 'logout':
		if($user->logout()){
			$pm->showPackError('logout_done', 'users', 200, true, 'index.php');
			exit;
		} else {
			$pm->showPackError('logout_failed', 'users');
			exit;
		}
		break;
	default:
		break;
}
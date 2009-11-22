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
global $pm, $user;
if($user->isLoggedIn()){
	$pm->show_pack_error('already_logged_in', 'users_login', 200, true, 'index.php');
	exit;
}

if(isset($_GET['users_action']))
	$action = $_GET['users_action'];
else
	$action = 'main';
switch($action){
	case 'main':
		showTemplate('login', 'users_login');
		break;
	default:
		$pm->show_error('UNKNOWN_ACTION');
		exit;
}
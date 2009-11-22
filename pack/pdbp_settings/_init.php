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
global $pm;
$packs = $pm->listPackagesInstalled();
if(isset($_GET['pdbp_settings_action']))
	$action = $_GET['pdbp_settings_action'];
else
	$action = 'main';
switch($action){
	case 'main':
		foreach ($packs as $value => $pack){
			if(!$pm->cfgExists($value))
			continue;
			echo '<p>' . $pack['real_name'] . '</p>';
		}
		break;
	default:
		$pm->showError('UNKNOWN_ACTION');
		break;
}
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
error_reporting(E_ALL);
require_once("pm/include/pm.class.php");
global $pm;
$pm = new pm();
if(isset($_GET['p']))
if(!$pm->open_index($_GET['p']))
$pm->show_error('404', 404);
//$pm->install_pack('adodb', 'adodb.zip', false);
//$pm->backup(false);
//$pm->remove_pack('hello_world', true, true);
//$pm->revert_changes(1);
if(isset($_GET['action']) && $_GET['action'] == 'save' && isset($_GET['package'])){
	$return = $pm->save_form($_GET['package']);
}
//$pm->generate_cfg_form('users');
//echo $pm->get_debug_code();
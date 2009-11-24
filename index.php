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
if(isset($_GET['p'])){
	if(!$pm->openIndex($_GET['p']))
		$pm->showError('404', 404);
} else {
	if(!$pm->openIndex('index'))
		$pm->showError('404', 404);
}
echo $pm->getTpl();
//if(isset($_GET['action']) && $_GET['action'] == 'save' && isset($_GET['package'])){
//	$return = $pm->saveForm($_GET['package']);
//}
//$pm->cfgFormOut(false, 'index');
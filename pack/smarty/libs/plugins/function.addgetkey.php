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
function smarty_function_addgetkey($params, &$smarty){
	$currentURL = preg_replace("!^.*/(.*?)!", "$1", $_SERVER['REQUEST_URI']);
	if(!isset($params['value']) || !isset($params['key']))
		return $currentURL;
	if(isset($params['url']))
		$currentURL = $params['url'];
	if(preg_match("!\?.*$!", $currentURL)){
		$currentURL .= '&' . $params['key'] .'='. $params['value'];
	} else {
		$currentURL .= '?' . $params['key'] .'='. $params['value'];
	}
	return htmlspecialchars($currentURL);
}
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
function label_check_intreg($var, $data){
	if(!isset($var))
		return 'false';
	return true;
}
function label_gen_form($name, $var, $data, $pm, $package, $class = 1){
	if(isset($data['extra'][0])){
		if($data['extra'][0] == 'false')
			$show = true;
		else{
			if($var)
				$show = true;
			else
				$show = false;
		}
	} else 
		$show = true;
	if($show){
		$return  = "\n" . '  <tr class="c' . $class . '">';
		$return .= "\n" . '   <td>';
		$return .= "\n" . '   </td>';
		$return .= "\n" . '   <td>';
		$return .= "\n" . '    <p class="tab">';
		$return .= "\n" . '     <input type="hidden" name="' . $name . '" value="true" />';
		$return .= "\n" . '     ' . $pm->parse_pack_lang_const('LAB_' . $name, $package) . '';
		$return .= "\n" . '    </p>';
		$return .= "\n" . '   </td>';
		$return .= "\n" . '  </tr>';
		return $return;
	}
	$class--;
	return '';
}
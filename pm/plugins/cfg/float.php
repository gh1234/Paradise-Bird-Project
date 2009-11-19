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
function float_check_intreg($var, $data){
	$var = floatval($var);
	if(!is_float($var))
	return false;
	if(isset($data['extra']) && is_array($data['extra'])){
		if(isset($data['extra'][0]) && is_float($data['extra'][0]) && $data['extra'][0] < $var) //Bei int minimale Zahl pruefen
		return false;
		if(isset($data['extra'][1]) && is_float($data['extra'][1]) && $data['extra'][1] > $var) //Bei int maximale Zahl pruefen
		return false;
	}
	return $var;
}
function float_gen_form($name, $var, $data, $pm, $package, $class = 1){
	if(!isset($data['extra'][0]))
	$data['extra'][0] = "'false'";
	if(!isset($data['extra'][1]))
	$data['extra'][1] = "'false'";
	$extra = ' onkeyup="checkfloat('. $data['extra'][0] .', ' . $data['extra'][1] . ', this)"';
	$info = ' <i>('. $pm->parse_lang_const('FLOAT');
	$info .= ($data['extra'][0])?' '. $pm->parse_lang_const('HIGHER') . ': ' . $data['extra'][0]:'';
	$info .= ($data['extra'][1])?' '. $pm->parse_lang_const('LOWER') . ': ' . $data['extra'][1]:'';
	$info .=')</i>';
	$return  = "\n" . '  <tr class="c' . $class . '">';
	$return .= "\n" . '   <td>';
	$return .= "\n" . '    <p class="tab">';
	$return .= "\n" . '     <label>' . $pm->parse_pack_lang_const('LAB_' . $name, $package) . $info . ': </label>';
	$return .= "\n" . '    </p>';
	$return .= "\n" . '   </td>';
	$return .= "\n" . '   <td>';
	$return .= "\n" . '    <p class="tab">';
	$return .= "\n" . '     <input name="' . $name . '" id="' . $name . '" type="text" value="' . $var . '"' . $extra . ' />';
	$return .= "\n" . '    </p>';
	$return .= "\n" . '   </td>';
	$return .= "\n" . '  </tr>';
	return $return;
}
function float_gen_js($pm){
	if(defined('FLOAT_DEFINED_JS'))
	return;
	define('FLOAT_DEFINED_JS', true);
	return '
<script type="text/javascript">
 <!--
 function checkfloat(min, max, element){
  var val = element.value;
  val = val.replace(/,/,".");
  if(!/^[\-]{0,1}([0-9]*|[0-9]*?[\.][0-9]*)$/.test(val))
   element.style.background = "red";
  else if(min != "false" && val < min)
   element.style.background = "red";
  else if(max != "false" && val > max)
   element.style.background = "red";
  else
   element.style.background = 0;
 }
 //-->
</script>
';
}
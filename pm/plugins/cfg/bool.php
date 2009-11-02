<?php
function bool_check_intreg($var, $data){
	if($var != 1 && $var != 0)
	return false;
	if($var)
		return true;
	return false;
}
function bool_gen_form($name, $var, $data, $pm, $package, $class = 1){
	(isset($var) && $var)?$extra = ' checked="true"':$extra = '';
	$return  = "\n" . '  <tr class="c' . $class . '">';
	$return .= "\n" . '   <td>';
	$return .= "\n" . '    <p class="tab">';
	$return .= "\n" . '     <label>' . $pm->parse_pack_lang_const('LAB_' . $name, $package) . ': </label>';
	$return .= "\n" . '    </p>';
	$return .= "\n" . '   </td>';
	$return .= "\n" . '   <td>';
	$return .= "\n" . '    <p class="tab">';
	$return .= "\n" . '     <input name="' . $name . '" id="' . $name . '" type="checkbox"' . $extra . ' />';
	$return .= "\n" . '    </p>';
	$return .= "\n" . '   </td>';
	$return .= "\n" . '  </tr>';
	return $return;
}
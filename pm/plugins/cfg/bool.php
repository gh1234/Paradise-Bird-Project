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
	return "\n" . '  <tr class="c' . $class . '"><td><p class="tab"><label>' . $pm->parse_pack_lang_const('LAB_' . $name, $package) . ': </label></p></td><td><p class="tab"><input name="' . $name . '" id="' . $name . '" type="checkbox"' . $extra . '></p></td></tr>';
}
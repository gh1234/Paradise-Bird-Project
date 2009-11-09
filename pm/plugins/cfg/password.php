<?php
function password_check_intreg($var, $data){
	if(!is_string($var))
	return false;
	if(isset($data['extra']) && is_int($data['extra'])){
		if(strlen($var) > $data['extra']) //Bei string maximale Zeichenzahl pruefen
		return false;
	}
	return $var;
}
function password_gen_form($name, $var, $data, $pm, $package, $class = 1){
	(isset($data['extra']) && intval($data['extra']))?$extra = ' maxlength="' . $data['extra'] . '"':$extra = '';
	$return  = "\n" . '  <tr class="c' . $class . '">';
	$return .= "\n" . '   <td>';
	$return .= "\n" . '    <p class="tab">';
	$return .= "\n" . '     <label>' . $pm->parse_pack_lang_const('LAB_' . $name, $package) . ': </label>';
	$return .= "\n" . '    </p>';
	$return .= "\n" . '   </td>';
	$return .= "\n" . '   <td>';
	$return .= "\n" . '    <p class="tab">';
	$return .= "\n" . '     <input name="' . $name . '" id="' . $name . '" type="password" value="' . $var . '"' . $extra . ' />';
	$return .= "\n" . '    </p>';
	$return .= "\n" . '   </td>';
	$return .= "\n" . '  </tr>';
	return $return;
}
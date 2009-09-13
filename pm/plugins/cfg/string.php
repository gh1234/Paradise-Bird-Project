<?php
function string_check_intreg($var, $data){
	if(!is_string($var))
		return false;
	if(isset($data['extra']) && is_int($data['extra'])){
		if(strlen($var) > $data['extra']) //Bei string maximale Zeichenzahl pruefen
		return false;
	}
	return $var;
}
function string_gen_form($name, $var, $data, $pm, $package, $class = 1){
	(isset($data['extra']) && intval($data['extra']))?$extra = ' maxlength=' . $data['extra']:$extra = '';
	(isset($data['extra']) && intval($data['extra']))?$info = $pm->parse_lang_const('MAX_CHAR') . ' ' . $data['extra']:$info = '';
	return "\n" . '  <tr class="c' . $class . '"><td><p class="tab"><label>' . $pm->parse_pack_lang_const('LAB_' . $name, $package) . ' <i>(' . $pm->parse_lang_const('STRING') . $info . ')</i>: </label></p></td><td><p class="tab"><input name="' . $name . '" id="' . $name . '" type="text" value="' . $var . '"' . $extra . '></p></td></tr>';
}
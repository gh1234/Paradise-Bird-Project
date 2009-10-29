<?php
function submit_check_intreg($var, $data){
	return true;
}
function submit_gen_form($name, $var, $data, $pm, $package, $class = 1){
	$return  = "\n" . '  <tr class="c' . $class . '">';
	$return .= "\n" . '   <td>';
	$return .= "\n" . '   </td>';
	$return .= "\n" . '   <td>';
	$return .= "\n" . '    <p class="tab">';
	$return .= "\n" . '     <input type="submit" name="' . $name . '" value="' . $pm->parse_pack_lang_const('LAB_' . $name, $package) . '" />';
	if(isset($data['extra']) && $data['extra'] == 'true')
	$return .= "\n" . '     <input type="reset" name="' . $name . '" value="' . $pm->parse_lang_const('RESET') . '" />';
	$return .= "\n" . '    </p>';
	$return .= "\n" . '   </td>';
	$return .= "\n" . '  </tr>';
	return $return;
}
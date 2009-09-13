<?php
function select_check_intreg($var, $data){
	if(isset($data['extra']) && is_array($data['extra']))
	foreach($data['extra'] as $key => $dat){
		$data['extra'][$key] = preg_replace("!\|.*?$!", '', $dat);
	}
	if(isset($data['extra']) && is_array($data['extra']) && !in_array($var, $data['extra']))
	return false;
	return $var;
}
function select_gen_form($name, $var, $data, $pm, $package, $class = 1){
	$info = ' <i>('. $pm->parse_lang_const('SELECT') . ')</i>';
	$return = "\n" . '  <tr class="c' . $class . '">';
	$return .= "\n" . '   <td>';
	$return .= "\n" . '    <p class="tab">';
	$return .= "\n" . '     <label>' . $pm->parse_pack_lang_const('LAB_' . $name, $package) . $info . ': </label>';
	$return .= "\n" . '    </p>';
	$return .= "\n" . '   </td>';
	$return .= "\n" . '   <td>';
	$return .= "\n" . '    <select name="'.$name.'" id="'.$name.'">';
	if(isset($data['extra']) && is_array($data['extra'])){
		foreach($data['extra'] as $value){
			$extra = '';
			$value = explode('|', $value);
			if($value[0] == $var)
				$extra = ' selected="selected"';
			$return .= "\n" . '     <option value="'.$value[0].'"'.$extra.'>' . $value[1] . '</option>';
		}
	}
	$return .= "\n" . '    </select>';
	$return .= "\n" . '   </td>';
	$return .= "\n" . '  </tr>';
	return $return;
}
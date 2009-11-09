<?php
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
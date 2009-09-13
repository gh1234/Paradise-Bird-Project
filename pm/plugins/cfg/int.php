<?php
function int_check_intreg($var, $data){
	$var = intval($var);
	if(!is_int($var))
	return false;
	if(isset($data['extra']) && is_array($data['extra'])){
		if(isset($data['extra'][0]) && is_int($data['extra'][0]) && $data['extra'][0] < $var) //Bei int minimale Zahl pruefen
		return false;
		if(isset($data['extra'][1]) && is_int($data['extra'][1]) && $data['extra'][1] > $var) //Bei int maximale Zahl pruefen
		return false;
	}
	return $var;
}
function int_gen_form($name, $var, $data, $pm, $package, $class = 1){
	if(!isset($data['extra'][0]))
	 $data['extra'][0] = "'false'";
	if(!isset($data['extra'][1]))
	 $data['extra'][1] = "'false'";
	$extra = ' onkeyup="checkint('. $data['extra'][0] .', ' . $data['extra'][1] . ', this)"';
	$info = ' <i>('. $pm->parse_lang_const('INT');
	$info .= ($data['extra'][0])?' '. $pm->parse_lang_const('HIGHER') . ': ' . $data['extra'][0]:'';
	$info .= ($data['extra'][1])?' '. $pm->parse_lang_const('LOWER') . ': ' . $data['extra'][1]:'';
	$info .=')</i>';
	return "\n" . '  <tr class="c' . $class . '"><td><p class="tab"><label>' . $pm->parse_pack_lang_const('LAB_' . $name, $package) . $info . ': </label></p></td><td><p class="tab"><input name="' . $name . '" id="' . $name . '" type="text" value="' . $var . '"' . $extra . '></p></td></tr>';
}
function int_gen_js($pm){
	if(defined('FLOAT_DEFINED_JS'))
		return;
	define('FLOAT_DEFINED_JS', true);
	return '
<script type="text/javascript">
	<!--
		function checkint(min, max, element){
			var val = element.value;
			val = val.replace(/,/,".");
			if(!/^([\-0-9])*$/.test(val))
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
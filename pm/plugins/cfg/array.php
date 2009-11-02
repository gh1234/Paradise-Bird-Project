<?php
function array_check_intreg($var, $data){
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
function array_gen_form($name, $var, $data, $pm, $package, $class = 1){
	if(!isset($data['extra'][0]))
	 $data['extra'][0] = "'false'";
	else if($data['extra'][0] != false)
		$data['extra'][0] = "'true'";
	$info = ' <i>('. $pm->parse_lang_const('ARRAY');
	$info .=')</i>';
	$return  = "\n" . '  <tr class="c' . $class . '">';
	$return .= "\n" . '   <td>';
	$return .= "\n" . '    <p class="tab">';
	$return .= "\n" . '     <label>' . $pm->parse_pack_lang_const('LAB_' . $name, $package) . $info . ': </label>';
	$return .= "\n" . '    </p>';
	$return .= "\n" . '   </td>';
	$return .= "\n" . '   <td>';
	$return .= "\n" . '    <p class="tab" id="arrayelements_'.$name.'">';
	$return .= "\n" . '     <a href="javascript:addArrayElement(\'' . $name . '\', \'start\')">+</a>';
	$return .= "\n" . '     <br /><input name="' . $name . '[0]" id="' . $name . '0" type="text" value="' . $var . '" /><a href="javascript:addArrayElement(\'' . $name . '\', 0)">+</a>';
	$return .= "\n" . '    </p>';
	$return .= "\n" . '   </td>';
	$return .= "\n" . '  </tr>';
	return $return;
}
function array_gen_js($pm){
	if(defined('ARRAY_DEFINED_JS'))
		return;
	define('ARRAY_DEFINED_JS', true);
	return '
<script type="text/javascript">
 <!--
 function addArrayElement(name, elementid){
  if(elementid != "start"){
	  element = document.getElementById(name + elementid)
	  if(element == undefined)
	   return false;
  }
  arraycontainer = document.getElementById("arrayelements_"+name);
  if(arraycontainer == undefined)
   return false;
  if(elementid == "start"){
   arraycontainer.innerHTML = arraycontainer.innerHTML.replace("<a href=\"javascript:addArrayElement(\'"+name+"\', \'start\')\">+</a>", "");
   arraycontainer.innerHTML = "<a href=\"javascript:addArrayElement(\'"+name+"\', \'start\')\">+</a><br /><input name=\"\' +name+ \'[0]\" id=\"\' +name+ \'0\" type=\"text\" value=\"nope\" /><a href=\"javascript:addArrayElement(\'" + name + "\', 0)\">+</a>" + arraycontainer.innerHTML;
  }
 }
 //-->
</script>
';
}
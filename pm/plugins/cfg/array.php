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
function array_check_intreg($var, $data){
	if(!is_array($var))
	return false;
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
	if(is_array($var)) {
		$i = 0;
		foreach($var as $item){
			$return .= "\n" . '     <br /><input name="' . $name . '[' . $i . ']" id="' . $name . $i . '" type="text" value="' . $item . '" /><a href="javascript:addArrayElement(\'' . $name . '\', '.$i.')">+</a><a href="javascript:removeArrayElement(\'' . $name . '\', '.$i.')">-</a>';
			$i++;
		}
	}
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
 function countArray(name){
  var i = 0;
  oldelement = document.getElementById(name+i);
  while(oldelement != undefined){
   i++;
   oldelement = document.getElementById(name+i);
  }
  return i-1;
 }
 function addArrayElement(name, elementid){
  if(elementid != "start"){
   element = document.getElementById(name + elementid);
   if(element == undefined)
   return false;
  }
  arraycontainer = document.getElementById("arrayelements_"+name);
  if(arraycontainer == undefined)
   return false;
  if(elementid == "start"){
   var i = countArray(name)+1;
   //Alte values setzen
   var oldvalues = new Array();
   for(var c = 0; c < i; c++){
    element = document.getElementById(name+c);
    oldvalues[c] = element.value;
   }
   arraycontainer.innerHTML = arraycontainer.innerHTML.replace("<a href=\"javascript:addArrayElement(\'"+name+"\', \'start\')\">+</a>", "");
   arraycontainer.innerHTML = "<a href=\"javascript:addArrayElement(\'"+name+"\', \'start\')\">+</a><br /><input name=\"" +name+ "["+i+"]\" id=\"" +name+ i +"\" type=\"text\" value=\"nope\" /><a href=\"javascript:addArrayElement(\'" + name + "\', " + i + ")\">+</a><a href=\"javascript:removeArrayElement(\'" + name + "\', " + i + ")\">-</a>" + arraycontainer.innerHTML;
   for(var c = 0; c < oldvalues.length; c++){
    document.getElementById(name+c).value = oldvalues[c];
   }
  } else {
   var i = countArray(name)+1;
   //Save old values
   var oldvalues = new Array();
   for(var c = 0; c < i; c++){
    element = document.getElementById(name+c);
    oldvalues[c] = element.value;
   }
   //copy from the back of the line
   var len = oldvalues.length;
   for(var i = len -1; i >= elementid; i--){
    oldvalues[i+1] = oldvalues[i];
   }
   oldvalues[elementid] = "";
   //OK, now apply on Screen!
   arraycontainer.innerHTML = "<a href=\"javascript:addArrayElement(\'"+name+"\', \'start\')\">+</a>";
   for(var i = oldvalues.length -1; i>=0; i--){
    arraycontainer.innerHTML = arraycontainer.innerHTML + "<br /><input name=\"" +name+ "["+i+"]\" id=\"" +name+ i +"\" type=\"text\" value=\""+oldvalues[i]+"\" /><a href=\"javascript:addArrayElement(\'" + name + "\', " + i + ")\">+</a><a href=\"javascript:removeArrayElement(\'" + name + "\', " + i + ")\">-</a>";
   }
  }
 }
 function removeArrayElement(name, elementid){
  var i = countArray(name)+1;
  var oldvalues = new Array();
  for(var c = 0; c < i; c++){
   element = document.getElementById(name+c);
   oldvalues[c] = element.value;
  }
  delete oldvalues[elementid];
  //OK, now apply on Screen!
  var arraycontainer = document.getElementById("arrayelements_"+name);
  arraycontainer.innerHTML = "<a href=\"javascript:addArrayElement(\'"+name+"\', \'start\')\">+</a>";
  var i = oldvalues.length-1;
  for(var c = oldvalues.length-1; c>=0; c--){
   if(oldvalues[c] == undefined)
    continue;
   i--;
   arraycontainer.innerHTML = arraycontainer.innerHTML + "<br /><input name=\"" +name+ "["+i+"]\" id=\"" +name+ i +"\" type=\"text\" value=\""+oldvalues[c]+"\" /><a href=\"javascript:addArrayElement(\'" + name + "\', " + i + ")\">+</a><a href=\"javascript:removeArrayElement(\'" + name + "\', " + i + ")\">-</a>";
  }
 }
 //-->
</script>
';
}
<?php
function select_check_intreg($var, $data){
	if(isset($data['extra']) && is_array($data['extra']) && !in_array($var, $data['extra']))
	return false;
	return $var;
}
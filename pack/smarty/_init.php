<?php
function getDynamicTeplatePath($pack){
	if(dirname(dirname(__FILE__)) . '/'  . $pack) {
		if(is_dir(dirname(dirname(__FILE__)) . '/' . $pack . '/_template'))
		return dirname(dirname(__FILE__)) . '/' . $pack . '/_template';
		return false;
	} else {
		die("There was a fatal Error in the template system. Please report this to a Paradise Bird Project staff, if you didn't know the reason this occuped.");
	}
}
function showTemplate($template_name, $pack){
	global $smarty, $pm;
	$smarty->template_dir = getDynamicTeplatePath($pack);
	if(!$smarty->template_dir || !file_exists($smarty->template_dir . '/' . $template_name . '.tpl'))
	die("Template was not found.");
	$const = $pm->list_pack_lang_const($pack);
	if($const){
		foreach($const as $id => $item){
			$const['L_'.$id] = $item;
			unset($const[$id]);
		}
		$smarty->assign($const);
	}
	$smarty->display($template_name . '.tpl');
}
require_once("libs/Smarty.class.php");
global $smarty;
$smarty = new Smarty();
$smarty->template_dir = '';
$smarty->compile_dir = $modpath.'templates_c';
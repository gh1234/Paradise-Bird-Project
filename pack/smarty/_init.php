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
	$smarty->assign('TPL_DIR', $smarty->template_dir);
	$smarty->display($template_name . '.tpl');
}
require_once("libs/Smarty.class.php");
global $smarty;
$smarty = new Smarty();
$smarty->template_dir = '';
$smarty->compile_dir = $modpath.'templates_c';
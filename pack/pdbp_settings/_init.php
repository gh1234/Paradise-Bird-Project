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
global $pm, $smarty, $perm;
function smartyAddPack(){
	global $pm, $smarty;
	$packs = $pm->listPackagesInstalled();
	$packs_list = array();
		foreach ($packs as $value => $pack){
			if(!$pm->cfgExists($value))
			continue;
			$packs_list[] = array($value, $pack['real_name']);
		}
		$smarty->assign("packs", $packs_list);
		if(isset($_GET['pack'])){
			if(!isset($packs[$_GET['pack']])){
				$pm->showPackError('pack_not_exists', 'pdbp_settings', true);
				exit;
			}
			$smarty->assign("packname", $packs[$_GET['pack']]['real_name']);
			$smarty->assign("pack_edit", $_GET['pack']);
		}
}

//$perm->checkperm('pdbp_settings');

if(isset($_GET['pdbp_settings_action']))
	$action = $_GET['pdbp_settings_action'];
else
	$action = 'main';
switch($action){
	case 'main':
		smartyAddPack();
		$smarty->assign('content', $pm->parsePackLangConst('index', 'pdbp_settings'));
		showTemplate('main', 'pdbp_settings');
		break;
	case 'showsettings':
		if(!isset($_GET['pack'])){
			$pm->showPackError('no_pack_selected', 'pdbp_settings', 200, true);
			exit;
		}
		smartyAddPack();
		$form = $pm->generateCfgForm($_GET['pack']);
		$smarty->assign('content', $form[1]);
		$smarty->assign('js', $form[0]);
		$smarty->assign('cfgform', true);
		showTemplate('main', 'pdbp_settings');
		break;
	case 'save':
		if(!isset($_GET['pack'])){
			$pm->showPackError('no_pack_selected', 'pdbp_settings', 200, true);
			exit;
		}
		$return = $pm->saveForm($_GET['pack']);
		if($return){
			$pm->showPackError('saved', 'pdbp_settings', 200, true);
			exit;
		} else {
			$pm->showPackError('save_failed', 'pdbp_settings', 200, true);
			exit;
		}
		break;
	default:
		$pm->showError('UNKNOWN_ACTION');
		break;
}
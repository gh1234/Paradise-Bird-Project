<?php
error_reporting(E_ALL);
require_once("pm/include/pm.class.php");
global $pm;
$pm = new pm();
if(isset($_GET['p']))
	if(!$pm->open_index($_GET['p']))
		$pm->show_error('404', 404);
//$pm->install_pack('adodb', 'adodb.zip', false);
//$pm->backup(false);
//$pm->remove_pack('hello_world', true, true);
//$pm->revert_changes(1);
if(isset($_GET['action']) && $_GET['action'] == 'save' && isset($_GET['package'])){
	$return = $pm->save_form($_GET['package']);
}
//$pm->generate_cfg_form('header');
echo $pm->get_debug_code();
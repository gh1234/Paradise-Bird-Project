<?php
error_reporting(E_ALL);
require_once("pm/include/pm.class.php");
$pm = new pm();
if(isset($_GET['p']))
	if(!$pm->open_index($_GET['p']))
		$pm->show_error('404', 404);
$pm->install_pack('hello_world', 'test_hello_world.zip', false);
echo $pm->get_debug_code();

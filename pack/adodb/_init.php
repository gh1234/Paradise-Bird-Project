<?php
$package = 'adodb';
if(!$config || !$config['host'] || !$config['dbtype'] || !$config['user'] || !$config['password']){
	$this->show_pack_error('NO_CONFIG', $package);
}
require_once('adodb.inc.php');
global $db;
$db = ADONewConnection($config['dbtype']);
if(!@$db->Connect($config['host'], $config['user'], $config['password'])){
	$this->show_pack_error('CONNECTION_FAILED', $package);
	echo mysql_error();
}
?>
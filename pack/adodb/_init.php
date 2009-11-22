<?php
$package = 'adodb';
if(!$config || !$config['host'] || !$config['dbtype'] || !$config['user'] || !$config['password']){
	$this->showPackError('NO_CONFIG', $package);
}
require_once('adodb.inc.php');
global $db;
$db = ADONewConnection($config['dbtype']);
if(!@$db->Connect($config['host'], $config['user'], $config['password'])){
	$this->showPackError('CONNECTION_FAILED', $package);
}
if(!@$db->SelectDB($config['database'])){
	$this->showPackError('CONNECTION_FAILED', $package);
}
$db->SetCharSet("utf8");
?>
<?php
$permcfg = $config;
include("perm.php");
global $perm;
$perm = new perm(1, $config);
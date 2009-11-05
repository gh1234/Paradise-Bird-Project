<?php
require_once("libs/Smarty.class.php");
global $smarty;
$smarty = new Smarty();
$smarty->template_dir = '';
$smarty->compile_dir = $modpath.'templates_c';
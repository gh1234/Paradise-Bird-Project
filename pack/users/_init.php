<?php
include("users_class.php");
include("users_functions.php");
var_dump(genSalt("test"));
$salt = genSalt("test");
var_dump(compareSaltString($salt[0], 'test', $salt[1]));
$user = new users($config);
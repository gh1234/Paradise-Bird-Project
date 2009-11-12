<?php
include("users_class.php");
include("users_functions.php");
$salt = genSalt("test");
compareSaltString($salt[0], 'test', $salt[1]);
$user = new users($config);
var_dump($user->login("gh1234", "test"));
<!-- 
This file is part of Paradise-Bird-Project.

Paradise-Bird-Project is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Paradise-Bird-Project is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Paradise-Bird-Project.  If not, see <http://www.gnu.org/licenses/>.
 -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->parseLangConst('CFG_EDIT') . $pack; ?></title>
<style type="text/css">
<!--
table.cfgform {
	width: 100%;
}

p.tab {
	height: auto;
}

tr.c1 {
	background-color: #CCCCCC;
}

tr.c2 {
	background-color: #A0C0C0;
}

input {
	background: transparent;
}

select {
	background: transparent;
}
-->
</style>
<?php
echo $js;
?>
</head>
<body>
<form method="post" action="?action=save&amp;package=<?php echo $pack; ?>">
<?php echo $form; ?>
</form>
</body>
</html>

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
<title>{$L_login}</title>
<!--{literal}-->
<style type="text/css">
<!--
body {
	background-color: #292829;
}
body,td,th {
	color: #333;
	font-family: Arial, Helvetica, sans-serif;
}
#error {
	position: absolute;
	left: 50%;
	top: 100px;
	width:862px;
	z-index:1;
	background-color: #CCC;
	font-size: 14px;
	padding: 30px;
	margin-left: -450px;
}
h1 {
	font-size: 20px;
	font-family: Arial, Helvetica, sans-serif;
	text-align: center;
}
#header {
	width:856px;
	height:208px;
	z-index:2;
	background-image: url(pack/users_login/_template/header.png);
	background-repeat: no-repeat;
	margin-left: 2px;
	border:1px solid black;
}
.CollapsiblePanel {
	margin: 0px;
	padding: 0px;
}
.CollapsiblePanelTab {
	font: bold 0.7em sans-serif;
	background-color: #DDD;
	margin: 0px;
	padding: 7px;
	cursor: pointer;
	-moz-user-select: none;
	-khtml-user-select: none;
	color: #CCC;
}
.CollapsiblePanelContent {
	margin: 0px;
	padding: 0px;
	color: #BBB;
	font-size: 14px;
	background-color:#BBB
}
.CollapsiblePanelTab a {
	color: black;
	text-decoration: none;
}
.CollapsiblePanelOpen .CollapsiblePanelTab {
	background-color: #333;
	color: #CCC;
}
.CollapsiblePanelClosed .CollapsiblePanelTab {
 background-color: #333
}
.CollapsiblePanelTabHover,  .CollapsiblePanelOpen .CollapsiblePanelTabHover {
	background-color: #333;
}
.CollapsiblePanelFocused .CollapsiblePanelTab {
	background-color: #333;
}
fieldset{
 float-left: -1px;
 border-color: black;
 border-style: dotted;
}
-->
</style>
<!--{/literal}-->
</head>

<body>
<div id="error">
 <div id="header"> <h1>{$L_login}</h1></div>
  <form action="{addgetkey key='users_action' value='login'}" method="post">
  <fieldset>
   <table width="100%"><tr><td><label>{$L_username}: </label><input type="text" id="users_username" name="users_username" tabindex="1" /></td><td><label>{$L_password}: </label><input type="password" name="users_password" tabindex="2" /></td><td><input type="submit" name="users_login" value="{$L_login}" /></td></tr></table>
  </fieldset>
  </form>
</div>
</body>
</html>
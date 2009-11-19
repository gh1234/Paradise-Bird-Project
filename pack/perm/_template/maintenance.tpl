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
<title>{$L_TITLE}</title>
{literal}
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
	top: 50%;
	width:634px;
	z-index:1;
	background-color: #CCC;
	margin-top: -140px;
	margin-left: -352px;
	font-size: 14px;
	padding: 30px;
}
h1 {
	font-size: 16px;
	font-family: Arial, Helvetica, sans-serif;
	text-align: center;
}
#warning {
	width:64px;
	height:64px;
	z-index:2;
	float: left;
	background-image: url(pm/include/tpl/warning-64x64.png);
	background-repeat: no-repeat;
	margin-top: 13px;
	margin-right: 20px;
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

-->
</style>
{/literal}
</head>

<body>
<div id="error">
 <div id="warning"></div>
 {$L_MAINTENANCE}
 <p>{$MESSAGE}</p>
</div>
</body>
</html>
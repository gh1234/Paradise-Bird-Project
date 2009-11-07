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
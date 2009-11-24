<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$L_title}{if $packname != ''} - {$packname}{/if}</title><link href="pack/pdbp_settings/_template/style.css" rel="stylesheet" type="text/css" />
{$js}
</head>

<body>

<div id="container">
 <div id="header"></div>
 <div id="toolbar"></div>
 <div id="content_container">

  <div id="navigation_container">
    <div class="block">
 	  <div class="block_title">
        <div class="block_title_content">{$L_modules}</div>
      </div>
	  <div class="block_content">
		<ul class="block_navigation">
		{foreach item=pack from=$packs}
 		 <li class="block_navigation_list"><a href="?p=pdbp_settings&amp;pdbp_settings_action=showsettings&amp;pack={$pack.0}" class="block_navigation_link">{$pack.1}</a></li>
 		{/foreach}
        </ul>
     </div>
	</div>
        <div class="block">
 	  <div class="block_title">
        <div class="block_title_content">{$L_action}</div>

      </div>
	  <div class="block_content">
		<ul class="block_navigation">
 		<li class="block_navigation_list"><a class="block_navigation_link" href="?p=users&amp;users_action=logout">{$L_logout}</a></li>
        </ul>

     </div>
	</div>
  </div>
  <div class="content">
  <div class="content_block">
 	  <div class="content_block_title">
	  <div class="content_block_title_content">{$L_title}{if $packname != ''} - {$packname}{/if}</div>
      </div>
  <div class="content_block_content">
  {if $cfgform == true}
<form action="?p=pdbp_settings&amp;pdbp_settings_action=save&amp;pack={$pack_edit}" method="post">
{$content}
{else}
<p>{$content}</p>
{/if}
{if $cfgform == true}
</form>
{/if}
</div>
</div>
</div>
</div>
</div>
</body>
</html>
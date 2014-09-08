<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php if(($ts['site']['page_title'])  !=  ""): ?><?php echo ($ts['site']['page_title']); ?> <?php if(($ts['app']['app_alias'])  !=  ""): ?>- <?php echo ($ts['app']['app_alias']); ?>&nbsp;<?php endif; ?>- <?php echo ($ts['site']['site_name']); ?> <?php if(($ts['site']['site_slogan'])  !=  ""): ?>- <?php echo ($ts['site']['site_slogan']); ?><?php endif; ?>
<?php else: ?>
    <?php echo ($ts['site']['site_name']); ?> <?php if(($ts['site']['site_slogan'])  !=  ""): ?>- <?php echo ($ts['site']['site_slogan']); ?><?php endif; ?><?php endif; ?>
</title>
<meta name="keywords" content="<?php echo ($ts['site']['site_header_keywords']); ?>" />
<meta name="description" content="<?php echo ($ts['site']['site_header_description']); ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<?php $app_name = strtolower(APP_NAME);
$mod_name = strtolower(MODULE_NAME);
$act_name = strtolower(ACTION_NAME);
$url_param = $app_name.'/'.$mod_name.'/'.$act_name; ?>
</head>
<body>

<div class="Prompt">
  <div class="Prompt_top"></div>
  <div class="Prompt_con">
    <dl>
      <dt></dt>
      <dd style="float:none; text-align:center;">
        <h2 style="font-size:100px; line-height:120%; color:#999">404</h2>
        <p class="cGray2">对不起，没有找到相应的页面，请确认您输入的地址是否正确！</p>
      </dd>
    </dl>
    <div class="c"></div>
  </div>
  <div class="Prompt_btm"></div>
</div>
<div class="cl"></div>
<div class="mb30">
</div>
</body>
</html>
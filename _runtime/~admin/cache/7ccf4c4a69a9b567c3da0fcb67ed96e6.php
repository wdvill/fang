<?php if (!defined('THINK_PATH')) exit();?><?php if($isAdmin != '1'){ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

<?php }else { ?>
<body>
<link href="__THEME__/main.css" rel="stylesheet" type="text/css" />
<?php } ?>
<script>
function Jump(){
    window.location.href = '<?php echo ($jumpUrl); ?>';
}
document.onload = setTimeout("Jump()" , <?php echo ($waitSecond); ?>* 1000);
//document.onload = setTimeout("Jump()" , 0);
</script>
<link href="<?php echo ($publicCss); ?>" rel="stylesheet" type="text/css">
<base target="_self" />

<?php if(($status)  ==  "1"): ?><div class="Prompt">
  <div class="Prompt_top"></div>
  <div class="Prompt_con">
    <dl>
      <dt>提示信息</dt>
      <dd><span class="Prompt_ok"></span></dd>
      <dd>
        <h2><?php echo ($message); ?></h2>
        <?php if(isset($closeWin)): ?><p>系统将在 <span style="color:blue;font-weight:bold"><?php echo ($waitSecond); ?></span> 秒后自动关闭，如果不想等待,直接点击 <A HREF="<?php echo ($jumpUrl); ?>">这里</A> 关闭</p><?php endif; ?>
        <?php if(!isset($closeWin)): ?><p>系统将在 <span style="color:blue;font-weight:bold"><?php echo ($waitSecond); ?></span> 秒后自动跳转,如果不想等待,直接点击 <A HREF="<?php echo ($jumpUrl); ?>">这里</A> 跳转<br/>
            或者 <a href="__ROOT__/">返回首页</a></p><?php endif; ?>
      </dd>
    </dl>
    <div class="c"></div>
    </div>
    <div class="Prompt_btm"></div>
  </div><?php endif; ?>
<?php if(($status)  ==  "2"): ?><div class="Prompt">
    <div class="Prompt_top"></div>
  <div class="Prompt_con">
    <dl>
      <dt>提示信息</dt>
      <dd><span class="Prompt_x"></span></dd>
      <dd>
      <h2 style="color:red"><?php echo ($message); ?></h2>
        <?php if(isset($closeWin)): ?><p>系统将在 <span style="color:blue;font-weight:bold"><?php echo ($waitSecond); ?></span> 秒后自动关闭，如果不想等待,直接点击 <A HREF="<?php echo ($jumpUrl); ?>">这里</A> 关闭</p><?php endif; ?>
      <?php if(!isset($closeWin)): ?><p>系统将在 <span style="color:blue;font-weight:bold"><?php echo ($waitSecond); ?></span> 秒后自动跳转,如果不想等待,直接点击 <A HREF="<?php echo ($jumpUrl); ?>">这里</A> 跳转<br/>
          或者 <a href="__ROOT__/">返回首页</a></p><?php endif; ?>
      </dd>
    </dl>
    <div class="c"></div>
    </div>
    <div class="Prompt_btm"></div>
  </div><?php endif; ?>
<?php if($isAdmin != '1'){ ?>
    <div class="cl"></div>
<div class="mb30">
</div>
</body>
</html>
<?php }else { ?>
    </body>
<?php } ?>
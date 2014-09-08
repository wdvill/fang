<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($ts['site']['site_name']); ?>管理后台</title>
<script type="text/javascript">
	var _UID_ = "<?php echo ($uid); ?>";
	var _ROOT_  = '__ROOT__';
	var _THEME_ = '__THEME__';
	var _PUBLIC_ = '__PUBLIC__';	
</script>
<link href="__PUBLIC__/admin/style.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/js/tbox/box.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/tbox/box.js"></script>

</head>
<body>
<div class="so_main">
  <div class="page_tit"><?php if(($type)  ==  "edit"): ?>编辑用户<?php else: ?>添加用户<?php endif; ?></div>
  
  <?php if(($type)  ==  "add"): ?><form method="post" action="<?php echo U('admin/User/doAddUser');?>">
  <?php else: ?>
  <form method="post" action="<?php echo U('admin/User/doEditUser');?>">
  	<input type="hidden" name="uid" value="<?php echo ($uid); ?>" /><?php endif; ?>
  
  <div class="form2">
    <dl class="lineD">
      <dt>Email：</dt>
      <dd>
        <input name="email" id="email" type="text" value="<?php echo ($email); ?>"><font color="red">(必填)</font>
        <p>用户进行登录的帐号</p>
    </dl>
	
    <dl class="lineD">
      <dt>密码：</dt>
      <dd>
        <input name="password" id="password" type="text"><font color="red">(必填)</font>
        <p>用户进行登录的密码</p>
    </dl>

	
    <dl class="lineD">
      <dt>昵称：</dt>
      <dd>
        <input name="uname" id="uname" type="text" value="<?php echo ($uname); ?>"><font color="red">(必填)</font>
        <p>2-10位个中英文、数字、下划线和中划线组成</p>
    </dl>
    
    
    <dl class="lineD">
      <dt>性别：</dt>
      <dd>
        <label><input name="sex" type="radio" value="1" <?php if(($sex)  ==  "1"): ?>checked<?php endif; ?>>男</label>
        <label><input name="sex" type="radio" value="0" <?php if(($sex)  !=  "1"): ?>checked<?php endif; ?>>女</label>
    </dl>	
	<dl class="lineD">
      <dt>是否激活：</dt>
      <dd>
        <label><input name="is_active" type="radio" value="1" <?php if(($is_active)  ==  "1"): ?>checked="checked"<?php endif; ?>>是</label>
        <label><input name="is_active" type="radio" value="0" <?php if(($is_active)  !=  "1"): ?>checked="checked"<?php endif; ?>>否</label>
    </dl>
    <?php if ( $_SESSION['isadminman'] == 1) { ?>
	<dl>
      <dt>用户组：</dt>
      <dd>
        <?php if($type=='add'){ ?>
        <?php echo W('SelectUserGroup');?>
        <?php }else { ?>
        <?php echo W('SelectUserGroup', array('uid'=>$uid));?>
        <?php } ?>
      </dd>
    </dl>
	<?php } ?>
    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
  </div>
  </form>
</div>
</body>
</html>
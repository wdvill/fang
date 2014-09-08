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
<script>
function fold(index) {
  	$('#app_'+index).slideToggle('fast');
}
</script>
<div id="container" class="so_main">
    <div class="page_tit">欢迎使用<?php echo ($ts['site']['site_name']); ?></div>
    <div class="form2">
        <h4>提示：点击标题可以折叠栏目</h4>
        <?php $id = 0; ?>
        <?php if(is_array($statistics)): ?><?php $i = 0;?><?php $__LIST__ = $statistics?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$channel): ?><?php ++$i;?><?php $mod = ($i % 2 )?><?php $index = $id++; ?>
            <h3 onclick="fold('<?php echo ($index); ?>');"><?php echo ($key); ?></h3>
            <div id="app_<?php echo ($index); ?>">
            <?php if(is_array($channel)): ?><?php $i = 0;?><?php $__LIST__ = $channel?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$vo): ?><?php ++$i;?><?php $mod = ($i % 2 )?><dl><dt><strong><?php echo ($key); ?>：</strong></dt><dd><?php echo ($vo); ?></dd></dl><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
            </div><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
    </div>
</div>
</body>
</html>
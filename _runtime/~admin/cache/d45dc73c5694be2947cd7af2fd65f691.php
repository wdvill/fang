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

<!-- 编辑器样式文件 -->
<link href="__PUBLIC__/js/editor/editor/theme/base-min.css" rel="stylesheet"/>
<!--[if lt IE 8]>
<link href="__PUBLIC__/js/editor/editor/theme/cool/editor-pkg-sprite-min.css" rel="stylesheet"/>
<![endif]-->
<!--[if gte IE 8]><!-->
<link href="__PUBLIC__/js/editor/editor/theme/cool/editor-pkg-min-datauri.css" rel="stylesheet"/>
<!--<![endif]-->

<?php
// 读取附件大小的配置
$_editor_system_default = model('Xdata')->lget('attach');
$_editor_size_limit = empty($_editor_system_default['attach_max_size']) ? 2 : $_editor_system_default['attach_max_size']; // 默认2M
$_editor_size_limit = floatval($_editor_size_limit) * 1000; // K
?>

<!-- 引入编辑器相关的JS文件 -->
<script src="__PUBLIC__/js/editor/kissy-min.js"></script>
<script src="__PUBLIC__/js/editor/uibase-min.js"></script>
<script src="__PUBLIC__/js/editor/dd-min.js"></script>
<script src="__PUBLIC__/js/editor/component-min.js"></script>
<script src="__PUBLIC__/js/editor/overlay-min.js"></script>
<script src="__PUBLIC__/js/editor/editor/editor-all-pkg-min.js?t=20101223a"></script>
<script src="__PUBLIC__/js/editor/editor/biz/ext/editor-plugin-pkg-min.js?t=20101223a"></script>
<script>
function loadEditor(textareaId) {
    KISSY.use('editor', function() {
        var KE = KISSY.Editor;
        var EDITER_UPLOAD = "<?php echo U('home/Attach/kissy');?>";
       
        //编辑器内弹窗 z-index 底限，防止互相覆盖
        KE.Config.baseZIndex = 10000;

        var cfg = {
            attachForm:true,
            baseZIndex:10000,
            focus:true,
            pluginConfig: {
                "image":{
                    upload:{
                        serverUrl:EDITER_UPLOAD,
                        surfix:"png,jpg,jpeg,gif,bmp",
                        sizeLimit:"<?php echo ($_editor_size_limit); ?>" // K
                    }
                },
                "flash":{
                    defaultWidth:"300",
                    defaultHeight:"300"
                },
                "resize":{
                    direction:["y"]
                }
            }
        };

        KE("#"+textareaId, cfg).use(
            "preview,separator," +
            "undo,separator," +
            "removeformat,font,format,color,table,separator," +
            "list,indent,justify,separator," +
            "link,image,flash,xiami-music,smiley,separator," +
            "maximize");
    });
}

function getEditorWordCount() {
	var count = 0;
	
	return count;
}

var KE = KISSY.Editor;
</script>
<script>
var check_form = false;
function checkform(o){
	var title = document.getElementById("title").value;
	var fromsite = document.getElementById("fromsite").value;
	var fid = document.getElementById("fid").value;
	var sort_id = document.getElementById("sort_id").value;
	
	if( title == ''){
		alert('请填写标题！');
		document.getElementById("title").focus();
		return false;
	} else if (title.length < 2){
		alert('标题长度太短');
		document.getElementById("title").focus();
		return false;
	} else if (title.length > 50){
	    alert('标题长度太长');
		document.getElementById("title").focus();
	    return false;
	}
	
	if( fromsite == ''){
		alert('请填写新闻来源！');
		document.getElementById("fromsite").focus();
		return false;
	} else if (fromsite.length < 2){
		alert('新闻来源长度太短');
		document.getElementById("fromsite").focus();
		return false;
	} else if (fromsite.length > 15){
	    alert('新闻来源长度太长');
		document.getElementById("fromsite").focus();
	    return false;
	}
	
	if(fid != '' && fid != 0 && isNaN(fid)){
		alert("专题id不是数字"); 
		document.getElementById("fid").focus();
		return false;
	}
	if(sort_id != '' && sort_id != 0 && isNaN(sort_id)){
		alert("排序id不是数字"); 
		document.getElementById("sort_id").focus();
		return false;
	}

	
	document.getElementById("newsform").submit();

}

function titlelen(inputobj){
	var obj;
	obj=document.getElementById("titlelen");
	obj.innerHTML=inputobj.value.length;
}

function introlen(inputobj){
	var obj;
	obj=document.getElementById("introlen");
	obj.innerHTML=inputobj.value.length;
}

</script>
<div class="so_main">
  <div id="editTpl_div">
  	<div class="page_tit"><?php if(($type)  ==  "edit"): ?>编辑<?php else: ?>添加<?php endif; ?>新闻</div>
	
	<div class="form2">
	<form method="post" id='newsform' action="<?php echo U('admin/Content/doEditInfo');?>"  enctype="multipart/form-data"  onsubmit="return checkform(this);">
	<?php if(($type)  ==  "edit"): ?><input type="hidden" name="info_id" value="<?php echo ($info_id); ?>"><?php endif; ?>
    <dl class="lineD">
      <dt>项目名称：</dt>
      <dd>
        <input name="title" id='title' type="text" size="55" value="<?php echo ($title); ?>" onKeyup="javascript:titlelen(this);" > (必填，已输入字符数：<font color='red' bold><label id='titlelen'></label></font>)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>价格：</dt>
      <dd>
        <input name="price" id='price' type="text" size="55" value="<?php echo ($price); ?>"> 元/平(必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>优惠信息：</dt>
      <dd>
        <input name="benefit_info" id='benefit_info' type="text" size="55" value="<?php echo ($benefit_info); ?>">
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>剩余套数：</dt>
      <dd>
        <input name="remaining_house" id='remaining_house' type="text" size="55" value="<?php echo ($remaining_house); ?>"> 套
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>开盘信息：</dt>
      <dd>
        <input name="opening_info" id='opening_info' type="text" size="55" value="<?php echo ($opening_info); ?>">
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>开盘时间：</dt>
      <dd>
        <input name="opening_time" id='opening_time' type="text" size="55" value="<?php echo ($opening_time); ?>">
	  </dd>
    </dl>
    
    <dl class="lineD">
      <dt>面积：</dt>
      <dd>
        <input name="total_area" id='total_area' type="text" size="55" value="<?php echo ($total_area); ?>">
	  </dd>
    </dl>
    
    <dl class="lineD">
      <dt>楼层：</dt>
      <dd>
        <input name="floor" id='floor' type="text" size="55" value="<?php echo ($floor); ?>">
	  </dd>
    </dl>
    
    <dl class="lineD">
      <dt>区域：</dt>
      <dd>
      	<select name="area" id='area'>
        	<?php foreach($areas as $_key=>$_value){
        			if ($area == $_key){
        				echo "<option value='".$_key."' selected>".$_value."</option>";
        			} else {
        				echo "<option value='".$_key."'>".$_value."</option>";
        			}
        		} ?>
		</select> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>详细地址：</dt>
      <dd>
        <input name="location" id='location' type="text" size="55" value="<?php echo ($location); ?>">
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>交通位置：</dt>
      <dd>
      	<select name="traffic_position" id='traffic_position'>
      		<option value='0'>请选择</option>
        	<?php foreach($traffic_positions as $_key=>$_value){
        			if ($traffic_position == $_key){
        				echo "<option value='".$_key."' selected>".$_value."</option>";
        			} else {
        				echo "<option value='".$_key."'>".$_value."</option>";
        			}
        		} ?>
		</select>
	  </dd>
    </dl>
    
    <dl class="lineD">
      <dt>图片：</dt>
      <dd>
        <input name="cover" type="file" style="width:300px; height:20px; border:1px solid #CCC;" />(选填，格式最好为640*360的宽图)
        <?php if (strlen($cover)>0) { ?>
        <br/><img src="__UPLOAD__/<?php echo ($cover); ?>" style="height:180px; border:1px solid #CCC;"/>
        <?php } ?>
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>视频：</dt>
      <dd>
        <input name="smallcover" type="file" style="width:300px; height:20px; border:1px solid #CCC;" />(必填，格式最好为120*90的宽图)
        <?php if (strlen($smallcover)>0) { ?>
        <br/><img src="__UPLOAD__/<?php echo ($smallcover); ?>" style="height:90px; border:1px solid #CCC;"/>
        <?php } ?>
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>入住时间：</dt>
      <dd>
        <input name="movedate" id='movedate' type="text" size="25" value="<?php echo ($movedate); ?>"> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>物业类别：</dt>
      <dd>
        <select name="property_type" id='property_type'>
        	<?php foreach($property_types as $_key=>$_value){
        			if ($property_type == $_key){
        				echo "<option value='".$_key."' selected>".$_value."</option>";
        			} else {
        				echo "<option value='".$_key."'>".$_value."</option>";
        			}
        		} ?>
		</select> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>物业：</dt>
      <dd>
        <input name="property_company" id='property_company' type="text" size="25" value="<?php echo ($property_company); ?>"> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>物业费：</dt>
      <dd>
        <input name="property_charges" id='property_charges' type="text" size="25" value="<?php echo ($property_charges); ?>"> 元(必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>停车场：</dt>
      <dd>
        <input name="parking" id='parking' type="text" size="25" value="<?php echo ($parking); ?>"> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>建筑类型：</dt>
      <dd>
        <select name="building_type" id='building_type'>
        	<?php foreach($building_types as $_key=>$_value){
        			if ($building_type == $_key){
        				echo "<option value='".$_key."' selected>".$_value."</option>";
        			} else {
        				echo "<option value='".$_key."'>".$_value."</option>";
        			}
        		} ?>
		</select> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>建筑类型：</dt>
      <dd>
        <select name="building_structure" id='building_structure'>
        	<option value='0'>请选择</option>
        	<?php foreach($building_structures as $_key=>$_value){
        			if ($building_structure == $_key){
        				echo "<option value='".$_key."' selected>".$_value."</option>";
        			} else {
        				echo "<option value='".$_key."'>".$_value."</option>";
        			}
        		} ?>
		</select> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>产权：</dt>
      <dd>
        <input name="property_rights" id='property_rights' type="text" size="25" value="<?php echo ($property_rights); ?>"> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>产权年限：</dt>
      <dd>
        <input name="property_rights_years" id='property_rights_years' type="text" size="25" value="<?php echo ($property_rights_years); ?>"> 年(必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>双气：</dt>
      <dd>
        <input name="double_gas" id='double_gas' type="text" size="25" value="<?php echo ($double_gas); ?>"> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>装修状况：</dt>
      <dd>
      	<select name="decoration" id="decoration">
        	<option value='0'>请选择</option>
        	<?php foreach($decorations as $_key=>$_value){
        			if ($decoration == $_key){
        				echo "<option value='".$_key."' selected>".$_value."</option>";
        			} else {
        				echo "<option value='".$_key."'>".$_value."</option>";
        			}
        		} ?>
		</select>
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>住户：</dt>
      <dd>
        <input name="household" id='household' type="text" size="25" value="<?php echo ($household); ?>"> 户(必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>绿化率：</dt>
      <dd>
        <input name="greening_rate" id='greening_rate' type="text" size="25" value="<?php echo ($greening_rate); ?>"> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>开发商：</dt>
      <dd>
        <input name="property_developers" id='property_developers' type="text" size="25" value="<?php echo ($property_developers); ?>"> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>预售许可：</dt>
      <dd>
        <input name="sale_permit" id='sale_permit' type="text" size="25" value="<?php echo ($sale_permit); ?>"> (必填)
	  </dd>
    </dl>
	<dl class="lineD">
      <dt>户型：</dt>
      <dd>
        <input name="house_type" id='house_type' type="text" size="25" value="<?php echo ($house_type); ?>"> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>交通：</dt>
      <dd>
        <input name="traffic" id='traffic' type="text" size="25" value="<?php echo ($traffic); ?>"> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>周边小学：</dt>
      <dd>
        <input name="school" id='school' type="text" size="25" value="<?php echo ($school); ?>" readonly="readonly">
        <input value="选择学校" type="button" id="select_school"/> (必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>标签：</dt>
      <dd>
        <input name="tag" id='tag' type="text" size="50" value="<?php echo ($tag); ?>"> 格式 期房:大产权:有地铁:设施   中间以:分隔(必填)
	  </dd>
    </dl>
    <dl class="lineD">
      <dt>状态：</dt>
      <dd>
        <input type="radio" name="status" value="0" <?php if(($status)  ==  "0"): ?>checked<?php endif; ?>>未审核
		<input type="radio" name="status" value="1" <?php if(($status)  ==  "1"): ?>checked<?php endif; ?>>已审核
	  </dd>
    </dl>
    <dl class="">
      <dt>详细内容：</dt>
      <dd>
      	<textarea name="content" id="content" style="width:550px;height:200px"><?php echo ($content); ?></textarea>
	  </dd>
    </dl>
	
    <div class="page_btm">
      <input type="hidden" name="infotype" value="<?php echo ($infotype); ?>" />
      <input type="submit" class="btn_b" value="确定" />
    </div>
	</form>
  </div>
  </div>
</div>
<div id="v4_dialog_4" class="py-pop" style="position: fixed; z-index: 5000; top: 50px; left: 20%; height: auto; width: 660px; display: none;" tabindex="0">
	<div class="py-pop-inner">
		<div class="pop-hd" id="v4_dialog_4_header" style="">
			<h3>选择学校</h3>
		</div>
		<div class="pop-bd">
			<iframe class="school_select_iframe" frameborder="0" scrolling="no" width="100%" height="370px" src="/adminsite/Content/selectschpage/"></iframe>
		</div>
		
	</div>
	<a id="v4_dialog_4_close" title="关闭对话框" href="#" class="close" style="" onclick="return false;" tabindex="0">
		<p class="icon i-pop-close"></p>
	</a>
</div>
<script>
$(document).ready(function(){
	loadEditor("content");
});

$("#select_school").click(function(event) {
	var x = event.clientX + document.body.scrollLeft; 
    var y = event.clientY + document.body.scrollTop;
    //$("#v4_dialog_4").css('left', x);  
    //$("#v4_dialog_4").css('top', y);
    dialog_open();
})
function dialog_open() {
	$("#v4_dialog_4").show();
}
function dialog_close() {
	$("#v4_dialog_4").hide();
}
function input_school(school) {
	$("#school").val(school);
}
$("#v4_dialog_4_close").click(function() {
	dialog_close();
})
</script>
<style>
.py-pop-inner, .py-pop .pop-inner {
	background: #fff;
	border: 1px solid #8A8A8A;
	border-bottom-color: #6D6D6D;
	-webkit-box-shadow: 0 2px 8px 1px rgba(0,0,0,.35);
	-moz-box-shadow: 0 2px 8px 1px rgba(0,0,0,.35);
	-khtml-box-shadow: 0 2px 8px 1px rgba(0,0,0,.35);
	-ms-box-shadow: 0 2px 8px 1px rgba(0,0,0,.35);
	box-shadow: 0 2px 8px 1px rgba(0,0,0,.35);
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	-ms-border-radius: 3px;
	border-radius: 3px;
	position: relative;
	z-index: 2;
	_display: inline;
	_width: auto;
}
.py-pop .pop-hd {
	min-height: 30px;
	background: #f5f5f5;
	border-bottom: 1px solid #e5e5e5;
	position: relative;
	_height: 30px;
	-webkit-border-radius: 3px 3px 0 0;
	-moz-border-radius: 3px 3px 0 0;
	border-radius: 3px 3px 0 0;
}
.py-pop .pop-bd {
	font-size: 12px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}
.py-pop .pop-hd h3 {
	float: left;
	font-size: 14px;
	white-space: nowrap;
	margin-right: 5px;
	_margin-right: 3px;
	line-height: 30px;
	padding-left: 10px;
}
.py-pop .pop-hd:before, .py-pop .pop-hd:after {
	content: '';
	display: table;
}
.py-pop .pop-hd:after {
	clear: both;
}
.py-pop .pop-hd:before, .py-pop .pop-hd:after {
	content: '';
	display: table;
}
.py-pop .close {
	position: absolute;
	font-size: 0;
	padding: 10px 10px 11px;
	-webkit-text-size-adjust: none;
	right: 0;
	top: 0;
	z-index: 10;
}
.option-base {
	width: 638px;
	height: 22px;
}
.option-base, .option-index {
	padding: 12px 10px;
	border-bottom: 1px solid #e0e4e9;
}
.option-base .sel-edubg, .option-base .sel_industry, .option-base label {
	float: left;
}
.option-base select {
	margin-right: 6px;
}
select {
	border-color: #BDBFC1!important;
}
select, .area {
	font-size: 12px;
	padding: 2px 3px;
	background-repeat: repeat-x;
}
* {
	margin: 0;
	padding: 0;
}
.pop-select {
	line-height: 1.5;
}
</style>
</body>
</html>
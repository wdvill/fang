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
function change_area(select) {
	if(isNaN(select)) {
		area_id = select.value
	} else {
		area_id = select
	}
	$.get("/adminsite/Content/area_schools/", { area_id: area_id},
		function(data){
	    	$("#_schoolList").html(data);
		}
	);
}
</script>
<div class="pop-select mod-select-sch">
	<div class="option-base">
		<p class="sel-edubg">学校所在地：
			<select id="school_area" style="width:105px;" onchange="change_area(this)">
				<?php foreach($school_areas as $_key=>$_value){
	        			echo "<option value='".$_key."'>".$_value."</option>";
	        		} ?>
			</select>
		</p>
	</div>
	<div id="_abcList" class="option-index" style="display:none;"></div>
	<div id="_schoolList">
		请选择区域
	</div>
</div>
<script type="text/javascript">
change_area(3);

$("#_schoolList a").click(function(event){
	event.preventDefault();
	eval($(this).attr('href'))
});
function choose_school(school_id, school_title) {
	parent.input_school(school_title);
	parent.dialog_close();
	return false;
}
</script>
<style>
.pop-select {
	line-height: 1.5;
}

.option-base {
	width: 638px;
	height: 22px;
}

.option-base .sel-edubg, .option-base .sel_industry, .option-base label {
	float: left;
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

.option-list {
	padding: 15px 18px;
	height: 240px;
	overflow: auto;
}

.option-list ul {
overflow: hidden;
}
ul, ol {
list-style-type: none;
}
ul, ol {
list-style-type: none;
}

.option-list li {
	float: left;
	display: inline;
	width: 200px;
	line-height: 23px;
	white-space: nowrap;
	text-overflow: ellipsis;
	-o-text-overflow: ellipsis;
	overflow: hidden;
	height: 23px;
}

.pop-select .option-list li i {
	font: 12px/1.5 simsun;
	color: #999;
}

.pop-select a {
	text-decoration: none;
}
a {
	text-decoration: none;
	color: #0967B0;
}
</style>
</body>
</html>
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
  
  <div class="page_tit"><?php echo ($title); ?>管理</div>
  <div class="Toolbar_inbox">
	<form method="get" action="<?php echo U('admin/Content/info');?>"  enctype="multipart/form-data">
        <b>&nbsp;&nbsp;是否审核：</b>
            <select id="status" name="status" >
            <?php if(isset($_GET['status']) && $_GET['status'] == '1'){ ?>
                    <option value="0">否</option>
                    <option value="1" selected>是</option>
                    <option value="-1">全部</option>
                <?php }else if(isset($_GET['status']) && $_GET['status'] == '0'){ ?>
                    <option value="0" selected>否</option>
                    <option value="1">是</option>
                    <option value="-1">全部</option>
                <?php }else{ ?>
                    <option value="0">否</option>
                    <option value="1">是</option>
                    <option value="-1" selected>全部</option>
                <?php } ?>
            </select>

        <b>&nbsp;&nbsp;区域：</b>
            <select name="area" id='area'>
            	<option value="0">不限</option>
        	<?php foreach($areas as $_key=>$_value){
        			if ($_GET['area'] == $_key){
        				echo "<option value='".$_key."' selected>".$_value."</option>";
        			} else {
        				echo "<option value='".$_key."'>".$_value."</option>";
        			}
        		} ?>
		</select>
		
		<b>&nbsp;&nbsp;物业类型：</b>
		<select name="property_type" id='property_type'>
			<option value="0">不限</option>
        	<?php foreach($property_types as $_key=>$_value){
        			if ($_GET['property_type'] == $_key){
        				echo "<option value='".$_key."' selected>".$_value."</option>";
        			} else {
        				echo "<option value='".$_key."'>".$_value."</option>";
        			}
        		} ?>
		</select>
		
		<b>&nbsp;&nbsp;单价：</b>
		<select name="price" id='price'>
			<option value="0">不限</option>
        	<?php foreach($search_prices as $_key=>$_value){
        			if ($_GET['price'] == $_key){
        				echo "<option value='".$_key."' selected>".$_value."</option>";
        			} else {
        				echo "<option value='".$_key."'>".$_value."</option>";
        			}
        		} ?>
		</select>
        <!-- 
        <b>&nbsp;&nbsp;是否推荐：</b>
            <select id="recommend" name="recommend">
            <?php if(isset($_GET['recommend']) && $_GET['recommend'] == '2'){ ?>
                    <option value="0">未推荐</option>
                    <option value="1" >首页</option>
                    <option value="2" selected>新闻频道</option>
                    <option value="-1">全部</option>
                <?php }else if(isset($_GET['recommend']) && $_GET['recommend'] == '1'){ ?>
                    <option value="0">未推荐</option>
                    <option value="1" selected>首页</option>
                    <option value="2" >新闻频道</option>
                    <option value="-1">全部</option>
                <?php }else if(isset($_GET['recommend']) && $_GET['recommend'] == '0'){ ?>
                    <option value="0" selected>未推荐</option>
                    <option value="1" >首页</option>
                    <option value="2" >新闻频道</option>
                    <option value="-1">全部</option>
                <?php }else { ?>
                    <option value="0">未推荐</option>
                    <option value="1" >首页</option>
                    <option value="2" >新闻频道</option>
                    <option value="-1" selected>全部</option>
                <?php } ?>
            </select>
         -->
    <b>&nbsp;&nbsp;二级用户：</b><input type="text" id="uid_admin" name="uid_admin" size="6" value="<?php echo isset($_GET['uid_admin'])?$_GET['uid_admin']:'' ?>"/>
  	<b>&nbsp;&nbsp;项目名称：</b><input type="text" id="title" name="title" size="6" value="<?php echo isset($_GET['title'])?$_GET['title']:'' ?>"/>
    <input type="submit" class="btn_b" value="确定" />
	</form>
  </div>
  <div class="list">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">项目名称</th>
    <th class="line_l">物业类型</th>
    <th class="line_l">建筑类别</th>
    <th class="line_l">装修</th>
    <th class="line_l">均价(万)</th>
    <th class="line_l">区域</th>
    <th class="line_l">时间</th>
    <th class="line_l">审核/推荐状态</th>
    <th class="line_l">发布单位</th>
    <th class="line_l">操作</th>
  </tr>
  <?php if(is_array($info['data'])): ?><?php $i = 0;?><?php $__LIST__ = $info['data']?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$vo): ?><?php ++$i;?><?php $mod = ($i % 2 )?><tr overstyle='on' id="<?php echo ($vo["info_id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["info_id"]); ?>"></td>
        <td><?php echo ($vo["info_id"]); ?></td>
        <td><a href="<?php echo U('home/info/detail',array('ind'=>$vo['info_id']));?>" target="_blank"><?php echo msubstr($vo['title'],0,15); ?></a></td>
        <td><?php echo $property_types[$vo['property_type']]; ?></td>
        <td><?php echo $building_types[$vo['building_type']]; ?></td>
        <td><?php echo $decorations[$vo['decoration']]; ?></td>
        <td><?php echo ($vo["price"]); ?></td>
        <td><?php echo ($vo["area"]); ?></td>
        <td><?php echo (date("Y-m-d H:i",$vo["ctime"])); ?></td>
        <td><?php if(($vo["status"])  ==  "1"): ?>已审核<?php else: ?>未审核<?php endif; ?></td>
        <!-- <td><?php echo (getUserName($vo["uid"])); ?></td>  -->
        <td><?php echo (getUserName($vo["uid_admin"])); ?></td>
        <td>
			<a href="<?php echo U('admin/Content/editInfo',array('id'=>$vo['info_id']));?>">修改</a>
			<a href="javascript:void(0);" onclick="deleteInfo('<?php echo ($vo["info_id"]); ?>')">删除</a>
		</td>
      </tr><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
  </table>
  </div>
  <div class="Toolbar_inbox">
	<a href="<?php echo U('admin/Content/addInfo', array('infotype'=>$infotype));?>" class="btn_a""><span>添加<?php echo ($title); ?></span></a>
    <a href="javascript:void(0);" class="btn_a" onclick="deleteInfo();"><span>删除<?php echo ($title); ?></span></a>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($info["html"]); ?>
  </div>
</div>

<script>
    //鼠标移动表格效果
    $(document).ready(function(){
        $("tr[overstyle='on']").hover(
          function () {
            $(this).addClass("bg_hover");
          },
          function () {
            $(this).removeClass("bg_hover");
          }
        );
    });
    
    function checkon(o){
        if( o.checked == true ){
            $(o).parents('tr').addClass('bg_on') ;
        }else{
            $(o).parents('tr').removeClass('bg_on') ;
        }
    }
    
    function checkAll(o){
        if( o.checked == true ){
            $('input[name="checkbox"]').attr('checked','true');
            $('tr[overstyle="on"]').addClass("bg_on");
        }else{
            $('input[name="checkbox"]').removeAttr('checked');
            $('tr[overstyle="on"]').removeClass("bg_on");
        }
    }

    //获取已选择用户的ID数组
    function getChecked() {
        var ids = new Array();
        $.each($('table input:checked'), function(i, n){
            ids.push( $(n).val() );
        });
        return ids;
    }
    
    function deleteInfo(ids) {
    	var length = 0;
    	if(ids) {
    		length = 1;
    	}else {
    		ids    = getChecked();
    		length = ids[0] == 0 ? ids.length - 1 : ids.length;
            ids    = ids.toString();
    	}
    	if(ids=='') {
    		ui.error('请先选择一条新闻');
    		return ;
    	}
    	if(confirm('您将删除'+length+'条记录，删除后无法恢复，确定继续？')) {
    		$.post("<?php echo U('admin/Content/doDeleteInfo');?>",{ids:ids},function(res){
    			if(res=='1') {
    				ui.success('删除成功');
    				removeItem(ids);
    			}else {
    				ui.error('删除失败');
    			}
    		});
    	}
    }
    
    function removeItem(ids) {
    	ids = ids.split(',');
        for(i = 0; i < ids.length; i++) {
            $('#'+ids[i]).remove();
        }
    }
</script>
</body>
</html>
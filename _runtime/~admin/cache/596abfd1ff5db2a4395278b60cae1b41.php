<?php if (!defined('THINK_PATH')) exit();?><dl style="margin:10px 10px 5px; height:22px" class="clear">
  <dt class="left alR " style="width:70px;">用户组：</dt><dd class="left alL"><input type="text" id="title" value="<?php echo ($user_group['title']); ?>"></dd>
  </dl>
  <dl style="margin:10px 10px 5px; height:22px" class="clear">
  <dt class="left alR " style="width:70px;"> 图标：</dt><dd class="left alL"><input type="text" id="icon" value="<?php echo ($user_group['icon']); ?>">
    <?php if($user_group['icon']){ ?>
    <img class="alM" src="__THEME__/images/<?php echo ($user_group['icon']); ?>">
    <?php } ?>
  </dd>
  </dl>
  <dl style="margin:10px 10px 5px; height:22px" class="clear">
  <dt class="left alR" style="width:70px;">图标路径：</dt>
  <dd class="left alL">根目录/public/themes/<?php echo ($ts['site']['site_theme']); ?>/images</dd>
</dl>
<div style="background:#F8F8F8; border-top:1px solid #E6E6E6; padding:5px;" class="alR">
  <?php if (isset($user_group)) { ?>
  <input type="button" class="btn_b" onclick="editUserGrop()" value="确定" />
  <?php }else { ?>
  <input type="button" class="btn_b" onclick="addUserGrop()" value="确定" />
  <?php } ?>
  <input type="button" class="btn_w" onclick="cancel()" value="取消" />
</div>
<script type="text/javascript">
var themePath = "__THEME__/images/";
//添加用户组
function addUserGrop() {
	var icon	= $('#icon').val();
	var title	= $('#title').val();
	
	if(title=='') {
        ui.error('请输入用户组名称');
        return ;
    }

	//判断是否有重名
	$.post("<?php echo U('admin/User/isUserGroupExist');?>", {title:title}, function(res){
		if(res == '1') {
			if( !confirm("该用户组名称已存在，是否继续？") ) {
				return false;
			}
		}
		//提交修改
		$.post("<?php echo U('admin/User/doAddUserGroup');?>", {title:title,icon:icon}, function(res){
			if (res == '0') {
				ui.error('保存失败');
            }else if (res == '-1') {
            	ui.error('用户组名已存在');
			}else {
				var new_group_html = '';
				new_group_html += '<tr id="group_'+res+'" overstyle="on">';
				new_group_html += '<td><input type="checkbox" value="'+res+'" onclick="checkon(this)" id="checkbox2" name="checkbox"></td>';
				new_group_html += '<td>'+res+'</td>';
				new_group_html += '<td><div style="float: left;">'+title+'</div></td>';
				new_group_html += '<td><?php echo date("Y-m-d H:i"); ?></td>';
				new_group_html += '<td><a href="javascript:void(0);" onclick="del('+res+');">删除</a></td>';
				new_group_html += '</tr>';
				$('#user_group_list').append(new_group_html);
				ui.success('添加成功');
				ui.box.close();
			}
		});
	});
}

//编辑用户组
function editUserGrop() {
	var title	= $('#title').val();
	var icon	= $('#icon').val();
	var gid		= "<?php echo ($user_group['user_group_id']); ?>";
	
	if(title=='') {
        ui.error('请输入用户组名称');
        return ;
    }
	
	//判断名称是否有变化
	/*if(title == "<?php echo ($user_group['title']); ?>") {
		ui.success('名称无变化，未提交修改');
		ui.box.close();
		return false;
	}*/

	//判断是否有重名
	$.post("<?php echo U('admin/User/isUserGroupExist');?>", {gid:gid, title:title}, function(res){
		if(res == '1') {
			if( !confirm("该用户组名称已存在，是否继续？") ) {
				return false;
			}
		}
		//提交修改
		$.post("<?php echo U('admin/User/doEditUserGroup');?>", {gid:gid, title:title,icon:icon}, function(res){
			if (res == '0') {
				ui.error('保存失败');
			}else if (res == '-1') {
				ui.error('用户组名已存在');
			}else {
				$('#user_group_name_'+gid).html(title);
				$('#user_group_icon_'+gid).html('<img src="'+themePath+icon+'">');
				ui.success('保存成功');
				ui.box.close();
			}
		});
	});
}

function cancel() {
	ui.box.close();
}
</script>
$(document).ready(function(){
	$("input[name='k']").focus(function(){
		var k = $(this).val().trim();
		if(k=='搜索您感兴趣的项目...' || k=='请输入您要搜索的关键字...'){
			$(this).val('');
		}
		return false;
	});
	
	$("input[name='k']").blur(function(){
		var k = $(this).val().trim();
		if(k==''){
			$(this).val('搜索您感兴趣的项目...');
		}
		return false;
	});
	
	var joingroup_check = false;
	$(".joinin-group").live('click',function(){
		if(joingroup_check) return false;
		
		var selected = $(this);
		var id = selected.attr("id");
		
		if(selected.hasClass("joined")){
			if(!confirm("确认去掉收藏该项目？")) return false;
			
			joingroup_check = true;
			$.post(U('home/project/quitCollectProject'),{pro_id:id},function(txt){
				joingroup_check = false;
				if(txt==1){
					selected.removeClass("joined");
					selected.addClass("join");
					selected.html('<img src="'+_THEME_+'/images/jrqz.jpg" />');
				}else{
					alert("去掉收藏该项目失败！");
				}
			});
		}else{
			joingroup_check = true;
			$.post(U('home/project/add_fav'),{gid:id},function(txt){
				joingroup_check = false;
				if(txt>0){
					selected.removeClass("join");
					selected.addClass("joined");
					selected.html('<img src="'+_THEME_+'/images/tcqz.jpg" />');
				}else{
					alert("收藏该项目失败！");
				}
			});
		}
		return false;
	});
});

function editGroup(id){
	window.location.href = U('home/project/edit',['gid='+id]);
}

function deleteGroup(id){
	if(!confirm("确定删除该项目？删除后无法恢复，请谨慎操作！")) return false;
	
	$.post(U("group/group/delGroup"),{gid:id},function(txt){
		if(txt){
			alert("删除项目成功！");
			window.location.href = U('home/project/index');
		}else{
			alert("删除项目失败！");
		}
	});
}

function searchGroup(o){
	var k = $(o).find("input[name='k']").val().trim();
	if(k=='' || k=='搜索您感兴趣的项目...' || k=='请输入您要搜索的关键字...'){
		$(o).find("input[name='k']").val('请输入您要搜索的关键字...');
		return false;
	}
	
	$(o).submit();
	return false;
}

function saveGroupNotify(o){	
	var gid = o.gid.value;
	var notify = $(o).find("input[name='notify']:checked").val();
	
	$.post(U("group/group/savenotify"),{gid:gid,notify:notify},function(txt){
		if(txt){
			alert("保存成功！");
		}else{
			alert("保存失败！");
		}
	});
	
	return false;
}
$(document).ready(function(){
	$("input[name='k']").focus(function(){
		var k = $(this).val().trim();
		if(k=='搜索您感兴趣的博客...' || k=='请输入您要搜索的关键字...'){
			$(this).val('');
		}
		return false;
	});
	
	$("input[name='k']").blur(function(){
		var k = $(this).val().trim();
		if(k==''){
			$(this).val('搜索您感兴趣的博客...');
		}
		return false;
	});
	
	var joingroup_check = false;
	$(".joinin-group").live('click',function(){
		if(joingroup_check) return false;
		
		var selected = $(this);
		var id = selected.attr("id");
		return false;
	});
});

function editGroup(id){
	window.location.href = U('home/project/edit',['gid='+id]);
}

function deleteGroup(id){
	if(!confirm("确定删除该博客？删除后无法恢复，请谨慎操作！")) return false;
	
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
	if(k=='' || k=='搜索您感兴趣的博客...' || k=='请输入您要搜索的关键字...'){
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

var checktranspond = false;
function transpond(id){
	if(checktranspond == true || parseInt(id)<=0) return false;
	
	checktranspond = true;
	$.post(U('home/blog/transpond'),{id:id},function(txt){
		checktranspond = false;
		if(txt){
			alert('转发至微博成功！');
			window.location.href = txt;
		}else{
			alert('转发失败或您已经转发过此博客！');
		}
	});
	return false;
}
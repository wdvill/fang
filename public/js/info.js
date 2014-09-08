$(document).ready(function(){
	$("input[name='k']").focus(function(){
		var k = $(this).val().trim();
		if(k=='搜索您感兴趣的资讯...' || k=='请输入您要搜索的关键字...'){
			$(this).val('');
		}
		return false;
	});
	
	$("input[name='k']").blur(function(){
		var k = $(this).val().trim();
		if(k==''){
			$(this).val('搜索您感兴趣的资讯...');
		}
		return false;
	});
	
	var save_category_check = false;
	$("#save_category").live('click',function(){
		if(save_category_check) return false;
		
		var title = $("input[name='cate_name']").val().trim();
		var ids = getChecked();
		
		if (title == ''){
			alert("请填写分组标题！");
			return false;
		}
		if (ids <= 0){
			alert("请选择分组好友！");
			return false;
		}
		
		var type = getQueryString('tp');
		var group_id = 0;
		if(type=='edit'){
			group_id = getQueryString('gp');
			if(parseInt(group_id)<=0) return false;
		}
		
		save_category_check = true;
		$.post(U('home/friend/saveCate'),{ids:ids.toString(),title:title,group_id:group_id}, function(txt){
			save_category_check = false;
			if(txt){
				window.location.href = U('home/friend/cateinfo',['gp='+txt]);
			}else{
				alert("操作失败！");
			}
		});
		
		return false;
	});
});

function searchInfo(o){
	var k = $(o).find("input[name='k']").val().trim();
	if(k=='' || k=='搜索您感兴趣的资讯...' || k=='请输入您要搜索的关键字...'){
		$(o).find("input[name='k']").val('请输入您要搜索的关键字...');
		return false;
	}
	
	$(o).submit();
	return false;
}

var checktranspond = false;
function transpondInfo(id){
	if(checktranspond == true || parseInt(id)<=0) return false;
	
	checktranspond = true;
	$.post(U('home/info/transpond'),{id:id},function(txt){
		checktranspond = false;
		if(txt){
			alert('转发至微博成功！');
			window.location.href = txt;
		}else{
			alert('转发失败或您已经转发过此信息！');
		}
	});
	return false;
}
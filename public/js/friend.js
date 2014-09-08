$(document).ready(function(){
	$("input[name='k']").focus(function(){
		var k = $(this).val().trim();
		if(k=='按姓名/职位/公司搜索' || k=='请输入搜索的关键字'){
			$(this).val('');
		}
		return false;
	});
	
	$("input[name='k']").blur(function(){
		var k = $(this).val().trim();
		if(k==''){
			$(this).val('按姓名/职位/公司搜索');
		}
		return false;
	});
	
	$("input[name='email']").focus(function(){
		var k = $(this).val().trim();
		if(k=='输入对方邮件地址'){
			$(this).val('');
		}
		return false;
	});
	
	$("input[name='email']").blur(function(){
		var k = $(this).val().trim();
		if(k==''){
			$(this).val('输入对方邮件地址');
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
	
	var card_submit_check = false;
	$("#card_form").live("submit",function(){
		if(card_submit_check) return false;
		$("span.wrong_message").remove();
		
		var _this = $(this);
		var email = _this.find("input[name='email']").val().trim();
		var emailcheck = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
		
		if(_this.find("input[name='name']").val().trim()==''){
			$(".submit_card").prepend("<span class='wrong_message'>请填写姓名！</span>");
			return false;
		}
		if(email=='' || email.search(emailcheck)==-1){
			$(".submit_card").prepend("<span class='wrong_message'>请填写正确的邮箱地址！</span>");
			return false;
		}
		if(_this.find("input[name='company']").val().trim()==''){
			$(".submit_card").prepend("<span class='wrong_message'>请填写公司名称！</span>");
			return false;
		}
		if(_this.find("input[name='position']").val().trim()==''){
			$(".submit_card").prepend("<span class='wrong_message'>请填写职位名称！</span>");
			return false;
		}
		
		$("span.wrong_message").remove();
		$("#loading").show();
		card_submit_check = true;
		var options = {
			success:function(txt){
				card_submit_check = false;
				$("#loading").hide();
				if(txt==-1){
					$(".submit_card").prepend("<span class='wrong_message'>请填写姓名！</span>");
				}else if(txt==-2){
					$(".submit_card").prepend("<span class='wrong_message'>请填写正确的邮箱地址！</span>");
				}else if(txt==-3){
					$(".submit_card").prepend("<span class='wrong_message'>请填写公司名称！</span>");
				}else if(txt==-4){
					$(".submit_card").prepend("<span class='wrong_message'>请填写职位名称！</span>");
				}else if(txt==-5){
					$(".submit_card").prepend("<span class='wrong_message'>该名片已存在，您无法发送邀请！</span>");
				}else if(txt==1){
					alert("邀请发送成功！");
					window.location.href=U('home/friend/card');
				}else{
					alert("邀请发送失败，请稍后再试！");
				}
			}
		};
		_this.ajaxSubmit(options);
		
		return false;
	});
});

function searchFriend(o){
	var k = $(o).find("input[name='k']").val().trim();
	if(k=='' || k=='按姓名/职位/公司搜索' || k=='请输入搜索的关键字'){
		$(o).find("input[name='k']").val('请输入搜索的关键字');
		return false;
	}
	
	$(o).submit();
	return false;
}

function deleteCategory(id){
	if(id <= 0 || !confirm("确认删除该分组？")) return false;
	
	$.post(U('home/friend/deleteCate'),{id:id},function(txt){
		if(txt==1){
			alert("删除成功！");
			$("div.cate_"+id).slideUp('fast');
		}else{
			alert("删除失败！");
		}
	});
}

function deleteCateInfo(id){
	if(id <= 0 || !confirm("确认删除该分组？")) return false;
	
	$.post(U('home/friend/deleteCate'),{id:id},function(txt){
		if(txt==1){
			alert("删除成功！");
			window.location.href = U('home/friend/category');
		}else{
			alert("删除失败！");
		}
	});
}

function acceptFriend(id){
	if(!confirm('确认接受该好友请求？')) return false;
	
	$.post(U("home/friend/addFriend"),{id:id},function(txt){
		if(txt){
			alert("添加好友成功！");
			$("div.inbox_"+id).remove();
		}else{
			alert('操作失败，请稍后重试！');
		}
	});
	return false;
}

function refuseFriend(id){
	if(!confirm('确认拒绝该好友请求？')) return false;
	
	$.post(U("home/friend/refuseFriend"),{id:id},function(txt){
		if(txt){
			alert("操作成功！");
			$("div.inbox_"+id).remove();
		}else{
			alert('操作失败，请稍后重试！');
		}
	});
	return false;
}

//快速邀请好友
function quickInvite(o){
	var _this = $(o);
	var email = _this.find("input[name='email']").val().trim();
	var emailcheck = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;

	if(email=='' || email.search(emailcheck)==-1){
		alert('请输入正确的邮箱地址！');
		return false;
	}
	
	var options = {
		success:function(txt){
			card_submit_check = false;
			$("#loading").hide();
			if(txt==-1){
				alert("请输入正确的邮箱地址！");
			}else if(txt==-2){
				alert("该邮箱已被使用！");
			}else if(txt==1){
				alert("邀请发送成功！");
			}else{
				alert("邀请发送失败，请稍后再试！");
			}
		}
	};
	_this.ajaxSubmit(options);
	
	return false;
}

function checkAll(o){
	if( !o || o.checked == true ) {
		$('input[type="checkbox"]').attr('checked',true);
	}else if ( o.checked == false ) {
		$('input[type="checkbox"]').removeAttr('checked');
	}
}

//获取已选择用户的ID数组
function getChecked() {
	var ids = new Array();
	$.each($('@input:checked'), function(i, n){
		if($(n).val()>0) ids.push( $(n).val() );
	});
	return ids;
}
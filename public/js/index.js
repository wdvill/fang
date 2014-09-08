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
		$('input[type="checkbox"]').attr('checked','true');
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
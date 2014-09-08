$(document).ready(function(){
	var followcheck = false;
	$(".following").live('click',function(){
		if(_MID_<=0){
			require_login();
			return false;
		}
		if(followcheck) return false;
		
		var selected = $(this);
		var fd = selected.attr('fd');
		var type = '';
		if(selected.hasClass('follow')){
			type = 'follow';
		}else if(selected.hasClass('unfollow')){
			type = 'unfollow';
		}
		
		followcheck = true;
		$.post(U("home/space/doFollow"),{fd:fd,type:type},function(txt){
			followcheck = false;
			if(txt==11 || txt==12 || txt==13 || txt==1){
				if(type=='follow'){
					selected.removeClass("follow").addClass("unfollow");
					selected.html("取消关注");
				}else{
					selected.removeClass("unfollow").addClass("follow");
					selected.html("加关注");
				}
			}else{
				alert('操作失败，请稍后重试！');
			}
		});
	});
	
	var friendcheck = false;
	$(".friend").live('click',function(){
		if(_MID_<=0){
			require_login();
			return false;
		}
		if(friendcheck) return false;
		
		var selected = $(this);
		var fu = selected.attr('fu');
		var type = '';
		if(selected.hasClass('delete')){
			type = 'delete';
			if(!confirm('确认删除该好友？')) return false;
		}else if(selected.hasClass('add')){
			type = 'add';
		}
		
		friendcheck = true;
		$.post(U("home/space/doFriend"),{fu:fu,type:type},function(txt){
			friendcheck = false;
			if(txt){
				if(type=='add'){
					if(txt=='02'){
						selected.removeClass("add").addClass("delete");
						selected.html("删除好友");
					}else{
						selected.removeClass("friend add");
						selected.html("好友已请求");
					}
				}else{
					selected.removeClass("delete").addClass("add");
					selected.html("加为好友");
				}
			}else{
				alert('操作失败，请稍后重试！');
			}
		});
	});
	
	var acceptfriendcheck = false;
	$(".accept-friend").live('click',function(){
		if(_MID_<=0){
			require_login();
			return false;
		}
		if(acceptfriendcheck) return false;
		if(!confirm('确认接受该好友请求？')) return false;
		var selected = $(this);
		var fu = selected.attr('fu');
		
		acceptfriendcheck = true;
		$.post(U("home/space/addFriend"),{fu:fu},function(txt){
			acceptfriendcheck = false;
			if(txt){
				selected.removeClass("accept-friend").addClass("friend delete");
				selected.html("删除好友");
			}else{
				alert('操作失败，请稍后重试！');
			}
		});
	});
	
	var connectcheck = false;
	$(".addconnect").live('click',function(){
		if(_MID_<=0){
			require_login();
			return false;
		}
		
		var selected = $(this);
		if(connectcheck) return false;

		var fu = selected.attr('fu');
		
		connectcheck = true;
		$.post(U("home/space/doFriend"),{fu:fu},function(txt){
			connectcheck = false;
			if(txt){
				alert('名片递交成功！');
			}else{
				alert('操作失败，请稍后重试！');
			}
		});
		return false;
	});
});
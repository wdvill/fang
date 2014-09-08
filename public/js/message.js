//鼠标移动表格效果
$(document).ready(function(){
	$("li[overstyle='on']").hover(
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
		$(o).parents('li').addClass('bg_on') ;
	}else{
		$(o).parents('li').removeClass('bg_on') ;
	}
}

function checkAll(o){
	if( !o || o.checked == true ) {
		$('input[type="checkbox"]').attr('checked','true');
		$('ul[overstyle="on"]').addClass("bg_on");
	}else if ( o.checked == false ) {
		$('input[type="checkbox"]').removeAttr('checked');
		$('ul[overstyle="on"]').removeClass("bg_on");
	}
}

//获取已选择用户的ID数组
function getChecked() {
	var ids = new Array();
	$.each($('div input:checked'), function(i, n){
		ids.push( $(n).val() );
	});
	return ids;
}



function setIsUnread() {
	var ids = getChecked();
	if (ids == '') return false;
	
	$.post(U('home/Message/doSetIsUnread'), {ids:ids.toString()}, function(res){
		if (res == '1') {
			for(i = 0; i < ids.length; i++) {
				$('#message_'+ids[i]).removeClass('bg_warning');
			}
		}else {
			alert('操作失败！');
		}
	});
}

function setIsRead() {
	var ids = getChecked();
	if (ids == '') return false;
	
	$.post(U('home/Message/doSetIsRead'), {ids:ids.toString()}, function(res){
		if (res == '1') {
			for(i = 0; i < ids.length; i++) {
				$('#message_'+ids[i]).addClass('bg_warning');
			}
		}else{
			alert('操作失败！');
		}
	});
}

function delMessage(ids) {
	ids = ids ? ids : getChecked();
	ids = ids.toString();
	if (ids == '') return false;
	if(!confirm("确认删除选中的消息？")) return false;
	$.post(U('home/Message/doDelete'), {ids:ids}, function(res){
		if (res == '1') {
			ids = ids.split(',');
			for(i = 0; i < ids.length; i++) {
				$('#message_'+ids[i]).remove();
			}
		}else {
			alert('删除失败！');
		}
	});
}

function delMessageById(ids) {
	ids = ids ? ids : getChecked();
	ids = ids.toString();
	if (ids == '') return false;
	$.post(U('home/Message/doDelete'), {ids:ids}, function(res){
		if (res == '1') {
			ids = ids.split(',');
			for(i = 0; i < ids.length; i++) {
				$('#message_'+ids[i]).remove();
			}
		}else {
			alert('删除失败！');
		}
	});
}

function deleteMessage(ids) {
	ids = ids ? ids : getChecked();
	ids = ids.toString();
	if (ids == '') return false;
	if(!confirm("确认彻底删除选中的消息？")) return false;
	$.post(U('home/Message/doDelete'), {type:'compelete',ids:ids}, function(res){
		if (res == '1') {
			ids = ids.split(',');
			for(i = 0; i < ids.length; i++) {
				$('#message_'+ids[i]).remove();
			}
		}else {
			alert('删除失败！');
		}
	});
}

function deleleMessageById(ids) {
	ids = ids ? ids : getChecked();
	ids = ids.toString();
	if (ids == '') return false;
	$.post(U('home/Message/doDelete'), {type:'compelete',ids:ids}, function(res){
		if (res == '1') {
			ids = ids.split(',');
			for(i = 0; i < ids.length; i++) {
				$('#message_'+ids[i]).remove();
			}
		}else {
			alert('删除失败！');
		}
	});
}

function recoverMessage(ids) {
	ids = ids ? ids : getChecked();
	ids = ids.toString();
	if (ids == '') return false;
	$.post(U('home/Message/doRecover'), {ids:ids}, function(res){
		if (res == '1') {
			ids = ids.split(',');
			for(i = 0; i < ids.length; i++) {
				$('#message_'+ids[i]).remove();
			}
		}else {
			alert('删除失败！');
		}
	});
}

function replyMessage(id){
	if($(".reply."+id).css('display')=='block'){
		$(".reply."+id).hide();
	}else{
		$(".reply."+id).show();
	}
	return false;
}

function doReply(id) {
	var reply_content = $(".reply."+id).find("input[name='reply_content']").val().trim();
	var message_id    = id;
	$.post(U('home/Message/doReply'), {message_id:message_id,reply_content:reply_content}, function(res){
		if(res == '1') {
			$("input[name='reply_content']").val('');
			alert('回复成功！');
		}else{
			alert('回复失败！');
		}
	});
}

function acceptFriend(uid,o){
	if(!confirm('确认接受该好友请求？')) return false;
	var selected = $(o);
	
	$.post(U("home/space/addFriend"),{fu:uid},function(txt){
		if(txt){
			alert("添加好友成功！");
		}else{
			alert('操作失败，请稍后重试！');
		}
	});
}
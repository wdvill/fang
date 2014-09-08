$(document).ready(function(){
	$("input[name='k']").focus(function(){
		var k = $(this).val().trim();
		if(k=='搜索您感兴趣的事...' || k=='请输入您要搜索的关键字...'){
			$(this).val('');
		}
		return false;
	});
	
	$("input[name='k']").blur(function(){
		var k = $(this).val().trim();
		if(k==''){
			$(this).val('搜索您感兴趣的事...');
		}
		return false;
	});
	
	var joinact_check = false;
	$(".joinin-act").live('click',function(){
		if(joinact_check) return false;
		
		var selected = $(this);
		var id = selected.attr("id");
		
		if(selected.hasClass("joined")){
			if(!confirm("确认退出该活动？")) return false;
			
			joinact_check = true;
			$.post(U('event/Index/doDelAction'),{id:id,action:'joinIn'},function(txt){
				joinact_check = false;
				if(txt==1){
					selected.removeClass("joined");
					selected.addClass("join");
					selected.html('<img src="'+_THEME_+'/images/jrhd.jpg" />');
				}else{
					alert("退出活动失败！");
				}
			});
		}else{
			joingroup_check = true;
			$.post(U('event/Index/doAction'),{id:id,action:'joinIn'},function(txt){
				joinact_check = false;
				if(txt=='profile'){
					alert('请先完善您的个人资料和头像');
					window.location.href = U('home/account/profile');
				}else if(txt=='verify'){
					selected.removeClass("join");
					selected.removeClass("joinin-act");
					selected.css('font-size','16px');
					selected.html('<b>等待审核...</b>');
				}else if(txt==1){
					selected.removeClass("join");
					selected.addClass("joined");
					selected.html('<img src="'+_THEME_+'/images/tchd.jpg" />');
				}else{
					alert("加入活动失败！");
				}
			});
		}
		return false;
	});
});

function deleteEvent(id){
	if(!confirm("确定删除该活动？删除后无法恢复，请谨慎操作！")) return false;
	
	$.post(U("event/index/doDeleteEvent"),{id:id},function(txt){
		if(txt){
			alert("删除活动成功！");
			window.location.href = U('event/index');
		}else{
			alert("删除活动失败！");
		}
	});
}

function searchEvent(o){
	var k = $(o).find("input[name='k']").val().trim();
	if(k=='' || k=='搜索您感兴趣的事...' || k=='请输入您要搜索的关键字...'){
		$(o).find("input[name='k']").val('请输入您要搜索的关键字...');
		return false;
	}
	
	$(o).submit();
	return false;
}

function verifyUser(id,uid){
	if(!id || !uid) return false;
	
	$.post(U('event/index/verifyuser'),{id:id,uid:uid},function(txt){
		if(txt){
			$(".verify_list_c_"+uid).slideUp('fast');
			$(".member_list").prepend(txt);
		}else{
			alert("操作失败！");
		}
	});
	return false;
}

function removeMember(id,uid){
	if(!id || !uid) return false;
	
	$.post(U('event/index/deletemember'),{id:id,uid:uid},function(txt){
		if(txt==1){
			$(".member_list_c_"+uid).slideUp('fast');
		}else{
			alert("操作失败！");
		}
	});
	return false;
}

function EventAction( id,allow,action ){
  $.post( U('event/Index/doAction'),{id:id,allow:allow,action:action},function( text ){
      if( text == 1 ){
        if( allow == 1 ){
        	ui.success( '您的申请已经成功提交，该活动需要发起人审核，请耐心等待...' );
        }else{
        	ui.success( '操作成功' );
        }
    	if( action == 'joinIn' ){
    		if( allow == 1 ){
    			$('.list_joinIn_'+id).html('<a href="javascript:EventDelAction( '+id+','+allow+',\'joinIn\' )">取消申请</a>');
    			$('.detail_joinIn_'+id).html(
    					'<span class="cGreen lh35">已提交申请,等待审核中,'+
    					'<button class="btn_w" style="margin-right:5px;" onclick="javascript:EventDelAction( '+id+','+allow+',\'joinIn\' )">取消申请</button>'
    			);
    		}else{
    			$('.list_joinIn_'+id).html('<a href="javascript:EventDelAction( '+id+',null,\'joinIn\' )">取消参加</a>');
    			$('.detail_joinIn_'+id).html('<button class="btn_w" style="margin-right:5px;" onclick="javascript:EventDelAction( '+id+',null,\'joinIn\' )">取消参加</button>');
    		}
    	}else if( action == 'attention' ){
    		$('.list_attention_'+id).html('<a href="javascript:EventDelAction( '+id+',null,\'attention\')">取消关注</a>');
    		$('.detail_attention_'+id).html('<button class="btn_w" style="margin-right:5px;" onclick="javascript:EventDelAction( '+id+',null,\'attention\')">取消关注</button>');
    	}
      }else if( text == -2 ){
        if( allow == 1 ){
            ui.error( '已经提交申请，请不要重复申请' );
        }else{
            ui.error( '操作已经执行，请不要重复操作' );
        }
      }else if( text == -1 ){
    	  ui.error( '这个活动已不存在，即将刷新本页面' );
          location.reload();
      }else if( text == 0 ){
    	  ui.error( '操作失败,请稍后再试' );
      }else{
    	  ui.error( '未知错误' );
      }
  });
}

function EventDelAction( id,allow,action ){
  $.post( U('event/Index/doDelAction'),{id:id,allow:allow,action:action},function( text ){
      if( text == 1 ){
        if( allow == 1 ){
        	ui.success( '撤销申请成功' );
        }else{
        	ui.success( '操作成功' );
        }
    	if( action == 'joinIn' ){
    		$('.list_joinIn_'+id).html(
    				'<a href="javascript:EventAction( '+id+','+allow+',\'joinIn\' )">我要参加</a>'+
    				'<span class="list_attention_'+id+'">'+
    				'<a href="javascript:EventAction( '+id+',null,\'attention\')">我要关注</a>'+
                    '</span>'
    		);
    		$('.detail_joinIn_'+id).html(
    				'<button class="btn_b" style="margin-right:5px;" onclick="javascript:EventAction( '+id+','+allow+',\'joinIn\' )">我要参加</button>'+
    				'<span class="detail_attention_'+id+'">'+
    				'<button class="btn_b" style="margin-right:5px;" onclick="javascript:EventAction( '+id+',null,\'attention\')">我要关注</button>'+
                    '</span>'
    		);
    	}else if( action == 'attention' ){
        	$('.list_attention_'+id).html('<a href="javascript:EventAction( '+id+',null,\'attention\')">我要关注</a>');
        	$('.detail_attention_'+id).html('<button class="btn_b" style="margin-right:5px;" onclick="javascript:EventAction( '+id+',null,\'attention\')">我要关注</button>');
    	}
      }else if( text == -2 ){
    	  ui.error( '您没有对本活动进行过操作' );
    	  location.reload();
      }else if( text == -1 ){
    	  ui.error( '这个活动已不存在，即将刷新本页面' );
    	  location.reload();
      }else if( text == 0 ){
    	  ui.error( '操作失败,请稍后再试' );
      }else{
    	  ui.error( '未知错误' );
      }
  });
}

function agree( id,eventId,uid ){
  $.post( U('event/Index/doAgreeAction'),{id:id,eventId:eventId,uid:uid},function( text ){
      if( text == 1 ){
    	  ui.success( '操作成功' );
        location.reload();
      }else if( text == -3 ){
    	  ui.error( '未知错误' );
      }else if( text == -2 ){
    	  ui.error( '您没有对本活动进行过操作' );
        location.reload();
      }else if( text == -1 ){
    	  ui.error( '这个活动已不存在，即将刷新本页面' );
        location.reload();
      }else if( text == 0 ){
    	  ui.error( '操作失败,请稍后再试' );
      }else{
    	  ui.error( '未知错误' );
      }
  });
}

function adminDelAction( id,uid,action,opts ){
  $.post( U('event/Index/doAdminAction'),{eventId:id,uid:uid,action:action,admin:'user',opts:opts},function( text ){
      if( text == 1 ){
    	  ui.success( '操作成功' );
        location.reload();
      }else if( text == -3 ){
    	  ui.error( '未知错误' );
      }else if( text == -2 ){
    	  ui.error( '您没有对本活动进行过操作' );
        location.reload();
      }else if( text == -1 ){
    	  ui.error( '这个活动已不存在，即将刷新本页面' );
        location.reload();
      }else if( text == 0 ){
    	  ui.error( '操作失败,请稍后再试' );
      }else{
    	  ui.error( '未知错误' );
      }
  });

}

function endEvent( id ){
	if(confirm('是否提前结束此活动?')){
		$.post( U('event/Index/doEndAction'),{id:id},function( text ){
            if( text == 1 ){
              ui.success('提前结束活动成功');
              $('#event_satus_' + id).html('活动结束');//活动列表
              $('#event_satus').html('此活动已经结束,报名时间已到');//活动详细页
              $('#event_edit_button').html('');//活动详细页
            }else if( text == -1 ){
              ui.error( '非法访问' );
            }else if( text == 0 ){
              ui.error( '结束活动失败。请稍后再试' );
            }else{
              ui.error( '未知错误' );
            }
        });
	}
}

function delEvent(eventId,jump){
    var jump = jump==true?true:false;
	if(confirm('确认删除此活动?')){
		$.post( U('event/Index/doDeleteEvent'),{id:eventId},function( text ){
            if( text == 1 ){
              ui.success('删除活动成功');
              if(jump == true){
            	  window.location.href=U('event/Index/personal');
              }else{
            	  $('#event_'+eventId).remove();
              }
            }else if( text == 0 ){
              ui.error( '删除活动失败！' );
            }else{
              ui.error( '未知错误，请稍后再试' );
            }
        });
	}
}

function check(o){
  var title      = $( '#title' ).val();
  //var limitCount = $( '#limitCount' ).val();
  var explain    = $( '#explain' ).val();
  var stime      = $( '#sTime' ).val();
  var etime      = $( '#eTime' ).val();
  var cover      = $( '#cover' ).val();

  if( title.length<4 ) {alert( '标题必须大于4个字符' ); return false;}
  //if ( limitCount.test( '/^d+$/' ) ){alert( '人数只允许数字类型' ) return false}
  if( explain.length<10 ){alert( '描述不得小于10个字符' );return false;}
  if( !stime ) {alert( '请填写开始时间' );return false;}
  if( !etime ) {alert( '请填写结束时间' );return false;}
  if( !cover ) {alert( '请上传海报' );return false;}
  
  var options = {
	  success: function(txt) {
		  if(txt==-1){
			  alert("结束时间不得早于开始时间！");
		  }else if(txt==-2){
			  alert("开始时间不得早于当前时间！");
		  }else if(txt){
			alert("活动发布成功！");
			window.location.href = txt;  
		  }else{
			alert("活动发布失败，请稍后重试！");  
		  }
	  }
  };
  $(o).ajaxSubmit( options );
  
  return false;
}

function checkEdit(o){
  var title      = $( '#title' ).val();
  //var limitCount = $( '#limitCount' ).val();
  var explain    = $( '#explain' ).val();
  var stime      = $( '#sTime' ).val();
  var etime      = $( '#eTime' ).val();
  var cover      = $( '#cover' ).val();

  if( title.length<4 ) {alert( '标题必须大于4个字符' ); return false;}
  //if ( limitCount.test( '/^d+$/' ) ){alert( '人数只允许数字类型' ) return false}
  if( explain.length<10 ){alert( '描述不得小于10个字符' );return false;}
  if( !stime ) {alert( '请填写开始时间' );return false;}
  if( !etime ) {alert( '请填写结束时间' );return false;}
  //if( !cover ) {alert( '请上传海报' );return false;}
  
  var options = {
	  success: function(txt) {
		  if(txt==-1){
			  alert("结束时间不得早于开始时间！");
		  }else if(txt==-2){
			  alert("请填写活动时间！");
		  }else if(txt){
			alert("活动修改成功！");
			window.location.href = txt;  
		  }else{
			alert("活动修改失败，请稍后重试！");  
		  }
	  }
  };
  $(o).ajaxSubmit( options );
  
  return false;
}
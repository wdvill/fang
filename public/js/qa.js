$(document).ready(function(){
	$("input[name='k']").focus(function(){
		var k = $(this).val().trim();
		if(k=='搜索您感兴趣的问题...' || k=='请输入您要搜索的关键字...'){
			$(this).val('');
		}
		return false;
	});
	
	$("input[name='k']").blur(function(){
		var k = $(this).val().trim();
		if(k==''){
			$(this).val('搜索您感兴趣的问题...');
		}
		return false;
	});
	
	$(":checkbox[name='ques_private']").live('click',function(){
		if($(this).attr('checked')==true){
			$('#private_question').show();
		}else{
			$('#private_question').hide();
		}
	});
	
	$("#ques_email").live('click',function(){
		$("#ques_friend_detail").hide();
		$("#ques_friend").css('color','');
		$("#ques_email_detail").show();
		$(this).css('color','#F00');
		$('#ques_friend_detail').find('input[type="checkbox"]').removeAttr('checked');
	});
	
	$("#ques_friend").live('click',function(){
		$("#ques_email_detail").hide();
		$("#ques_email").css('color','');
		$("#ques_friend_detail").show();
		$(this).css('color','#F00');
		$('textarea[name="qemail"]').val('');
		if($('#get_all_friend').html().trim() == ''){
			$.post(U('home/qa/getfriend'),{},function(txt){
				if(txt){
					$('#get_all_friend').html(txt);
				}
			});
		}
	});
	
	var check_ques_pub = false;
	$("#question_publish").live('click',function(txt){
		if(check_ques_pub) return false;
		$(".weibo_status").remove();
		
		var param= {};
		var target = getQuestionTarget();
		if(target){
			param['target'] = target;
		}else{
			$("#publish_question").append('<div class="weibo_status">请选择提问目标！</div>');
			return false;
		}
		var content = $("#publish_question").find("textarea[name='content']").val().trim();
		if(content == '' || content == '我要提问...'){
			$("#publish_question").append('<div class="weibo_status">提问内容不能为空！</div>');
			return false;
		}
		param['content'] = content;
		
		check_ques_pub = true;
		$.post(U('home/qa/ask'),param,function(txt){
			check_ques_pub = false;
			if(txt>0){
				$("#publish_question").append('<div class="weibo_status">提问发布成功！</div>');
				setTimeout(function(){window.location.href = '/profile/qa/';},500);
			}else if(txt==-1){
				$("#publish_question").append('<div class="weibo_status">请选择提问目标！</div>');
			}else if(txt==-2){
				$("#publish_question").append('<div class="weibo_status">提问内容不能为空！</div>');
			}else{
				$("#publish_question").append('<div class="weibo_status">提问发布失败！</div>');
			}
		});
		
		return false;
	});
	
	$(".collecting").live('click',function(){
		var selected = $(this);
		var qd = selected.attr('qd');
		if(selected.hasClass("collect")){
			var type = 'collect';
			$.post(U('home/qa/collect'),{qd:qd,type:type},function(txt){
				if(txt){
					selected.removeClass('collect').addClass('collected');
					selected.html('已收藏');
				}else{
					alert('收藏失败！');
				}
			});
		}else{
			var type = 'uncollect';
			$.post(U('home/qa/collect'),{qd:qd,type:type},function(txt){
				if(txt){
					selected.removeClass('collected').addClass('collect');
					selected.html('收藏');
				}else{
					alert('取消收藏失败！');
				}
			});
		}
	});

});

var qa = {};
qa = {
};

function searchQuestion(o){
	var k = $(o).find("input[name='k']").val().trim();
	if(k=='' || k=='搜索您感兴趣的问题...' || k=='请输入您要搜索的关键字...'){
		$(o).find("input[name='k']").val('请输入您要搜索的关键字...');
		return false;
	}
	
	$(o).submit();
	return false;
}

var checkanswer = false;
function checkAnswer(form){
	if(checkanswer) return false;
	
	$(form).find('.error-message').html('');
	
	var content = $.trim(form.content.value);
	if(content == ''){
		$(form).find('.error-message').html('说点什么吧！');
		return false;
	}
	
	checkanswer = true;
	var options = {
		success:function(txt){
			checkanswer = false;
			txt = eval('('+txt+')');
			if(txt.code==1){
				$(form).find("textarea[name='content']").val('');
				$("#answer_list_"+form.qd.value).prepend(txt.html);
			}else{
				$(form).find('.error-message').html(txt.msg);
			}
		}
	};
	
	$(form).ajaxSubmit(options);
	return false;
}

var checkreplyanswer = false;
function checkReplyAnswer(form){
	if(checkreplyanswer) return false;
	
	$(form).find('.error-message').html('');
	
	var content = $.trim(form.content.value);
	if(content == ''){
		$(form).find('.error-message').html('说点什么吧！');
		return false;
	}
	
	checkreplyanswer = true;
	var options = {
		success:function(txt){
			checkreplyanswer = false;
			txt = eval('('+txt+')');
			if(txt.code==1){
				$(form).find("textarea[name='content']").val('');
				$(form).before(txt.html);
				$(form).remove();
			}else{
				$(form).find('.error-message').html(txt.msg);
			}
		}
	};
	
	$(form).ajaxSubmit(options);
	return false;
}

function getQuestionAnswer(id){
	if(!id) return false;
	var showanswer = $(".showanswer_"+id);
	var ispublic = showanswer.find("input[name='public']");
	var subanswer = showanswer.find("input[type='submit']");
	
	if(showanswer.css('display')=='block'){
		if(ispublic.val()=='1'){
			showanswer.hide();
			resetAnswerForm(id);
			$("answer_list_"+id).html('');
		}else{
			ispublic.val('1');
			subanswer.val('回答');
		}
	}else{
		showanswer.show();
		ispublic.val('1');
		subanswer.val('回答');
		$.post(U('home/qa/loadanswer'),{id:id},function(txt){
			if(txt){
				$("#answer_list_"+id).html(txt);
			}
		});
	}

}

function getPrivateAnswer(id){
	if(!id) return false;
	var showanswer = $(".showanswer_"+id);
	var ispublic = showanswer.find("input[name='public']");
	var subanswer = showanswer.find("input[type='submit']");
	if(showanswer.css('display')=='block'){
		if(ispublic.val()==1){
			ispublic.val('0');
			subanswer.val('私密回答');
		}else{
			showanswer.hide();
			resetAnswerForm(id);
			$("answer_list_"+id).html('');
		}
	}else{
		showanswer.show();
		ispublic.val('0');
		subanswer.val('私密回答');
		$.post(U('home/qa/loadanswer'),{id:id},function(txt){
			if(txt){
				$("#answer_list_"+id).html(txt);
			}
		});
	}

}

function resetAnswerForm(id){
	var showanswer = $(".showanswer_"+id);
	showanswer.find("input[name='sd']").val('');
	showanswer.find("textarea[name='content']").val('');
}

function getQuestionTarget(){
	var private = $(":checkbox[name='ques_private']").attr('checked');
	var public = $(":checkbox[name='ques_public']").attr('checked');
	var res = {};
	if(private == true || public == true){
		if(private == true){
			var to = '';
			var type = '';
			if($('textarea[name="qemail"]').val().trim() != ''){
				to = $('textarea[name="qemail"]').val();
				type = 'email';
			}else{
				to = getCheckedFriend().toString();
				type = 'friend';
			}
			
			res['private'] = to ? 1:0;
			res['to'] = to;
			res['type'] = type;
		}
		if(public == true){
			res['public'] = 1;
		}
		
		if(res['public']==1 || res['private']==1)
			return res;
	}else{
		return false;
	}
}

function deleteQuestion(id){
	if(!id) return false;
	
	$.post(U('home/qa/deletequestion'),{id:id},function(txt){
		if(txt){
			$(".question_list_"+id).fadeOut();
		}
	});
}

function deleteAnswer(id){
	if(!id) return false;
	
	$.post(U('home/qa/deleteanswer'),{id:id},function(txt){
		if(txt){
			$("#answer_list_c_"+id).fadeOut();
			$(".cl."+id).fadeOut();
		}
	});
}

function deleteReplyAnswer(id){
	if(!id) return false;
	
	$.post(U('home/qa/deleteanswer'),{id:id},function(txt){
		if(txt){
			$("#reply_list_"+id).remove();
		}
	});
}

function replyAnswer(id,qd){
	if($("#reply_answer_"+id).length > 0){
		$("#reply_answer_"+id).remove();
	}else{
		$.post(U('home/qa/getreplytpl'),{sd:id,qd:qd},function(txt){
			if(txt){
				$('#answer_list_c_'+id).append(txt);
			}
		});
	}
}

function removeReply(o){
	$(o).parent('form').remove();
}

function checkAllFriend(o){
	if( !o || o.checked == true ) {
		$('#get_all_friend').find('input[type="checkbox"]').attr('checked',true);
	}else if ( o.checked == false ) {
		$('#get_all_friend').find('input[type="checkbox"]').removeAttr('checked');
	}
}

function getCheckedFriend() {
	var ids = new Array();
	$.each($('#ques_friend_detail').find('@input:checked'), function(i, n){
		if($(n).val()>0) ids.push( $(n).val() );
	});
	return ids;
}
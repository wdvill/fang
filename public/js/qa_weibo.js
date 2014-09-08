$(document).ready(function(){
	
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
});

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
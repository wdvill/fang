function callback(fun,argum){
	fun(argum);
}

// 删除类型框
function delTypeBox(){
	$('input[name="publish_type"]').val( 0 );
	$('.talkPop').remove();
}

$(document).ready(function(){
	  // 评论切换
	  $("a[rel='comment']").live('click',function(){
	      var id = $(this).attr('minid');
	      var $comment_list = $("#comment_list_"+id);
		  if( $comment_list.html() == '' ){
			  $comment_list.html('<div class="feed_quote feed_wb" style="text-align:center"><img src="'+ _THEME_+'/images/icon_waiting.gif" width="15"></div>');
			$.post( U("weibo/Index/loadcomment"),{id:id},function(txt){
				$comment_list.html( txt ) ;
			});
		  }else{
			  $comment_list.html('');
		  }
	  });


	// 发布评论
	$("form[rel='miniblog_comment']").live("submit", function(){
		var _this = $(this);
		var callbackfun = _this.attr('callback');
		var _comment_content = _this.find("textarea[name='comment_content']");
		if( _comment_content.val()=='' ){
			//ui.error('内容不能为空');
			return false;
		}
		_this.find("input[type='submit']").val( '评论中...').attr('disabled','true') ;
		var options = {
		    success: function(txt) {
				txt = eval('('+txt+')');
				_this.find("input[type='submit']").val( '确定');
			       _this.find("input[type='submit']").removeAttr('disabled') ;
				   _comment_content.val('');
				if(callbackfun){
					callback(eval(callbackfun),txt);
				}else{
					_comment_content.css('height','22px');
				   $(".cl.publish_end").after(txt.html);
				   //更新评论数
				   $("a[rel='comment'][minid='"+txt.data['weibo_id']+"']").html("评论("+txt.data['comment']+")");
				 //  _this.find("textarea[name='comment_content']").focus();
				   
				}
		    }
		};
		_this.ajaxSubmit( options );
	    return false;
	});
	
	$("#search_weibo_form").live('submit',function(){
		var k = $(this).find("input[name='k']").val().trim();
		if(k=='' || k=='搜索微博...'){
			return false;
		}
		
		$(this).submit();
		
		return false;
	});
});

//同步设置
function selectSync(o){
	if( o.checked ){
		$(o).removeAttr('checked');
		$.get( U('weibo/Operate/beforeSync') ,{type:$(o).val()},function(txt){
			if(txt=='1'){
				$(o).attr('checked','true');
			}else{
				if(!confirm("您还没绑定新浪微博，确定绑定？")) return false;
				window.open(U("weibo/Operate/bind",['type=sina']));
				//ui.box.show(txt,{title:'绑定帐号'});
			}
		});		
	}else{
		$(o).attr('checked',true);
		$.post( U('weibo/operate/unbind') ,{value:$(o).val()},function(txt){
			$(o).removeAttr('checked');
		});	
	} 
}

weibo = function(){
	
}

weibo.prototype = {
	//初始化微博发布
	init:function(option){
		var __THEME__ = "<?php echo __THEME__;?>";
		var Interval;
		$("#publish_type_content_before").html("<span>添加：</span><a href=\"javascript:void(0)\" target_set=\"content_publish\" onclick=\"ui.emotions(this)\" class=\"a52\"><img class=\"icon_add_face_d\" src=\""+__THEME__+"/images/zw_img.gif\" />表情</a> <a href=\"javascript:void(0)\" onclick=\"addtheme()\" class=\"a52\"><img class=\"icon_add_topic_d\" src=\""+__THEME__+"/images/zw_img.gif\" />话题</a> <a href=\"javascript:void(0)\" onclick=\"weibo.plugin.image.click(140)\" class=\"a52\"><img class=\"icon_add_img_d\" src=\""+__THEME__+"/images/zw_img.gif\" />图片</a> <a href=\"javascript:void(0)\" onclick=\"weibo.plugin.video.click(180)\" class=\"a52\"><img class=\"icon_add_video_d\" src=\""+__THEME__+"/images/zw_img.gif\" />视频</a> <a href=\"javascript:void(0)\" onclick=\"weibo.plugin.music.click(230)\" class=\"a52\"><img class=\"icon_add_music_d\" src=\""+__THEME__+"/images/zw_img.gif\" />音乐</a>");
		
		$("#content_publish").focus(function(){
			if($(this).val().trim()=='我想说...'){
				$(this).val('');
			}
		});
		
		$("#content_publish").blur(function(){
			if($(this).val().trim()==''){
				$(this).val('我想说...');
			}
		});
		
		$("#content_publish").keypress(function(event){
			var key = event.keyCode?event.keyCode:event.which?event.which:event.charCode;
	        if (key == 27) {
	        	clearInterval(Interval);
	        }
			weibo.checkInputLength(this,1400);
		}).blur(function(){
			clearInterval(Interval);
			weibo.checkInputLength(this,1400);
		}).focus(function(){
			//微博字数监控
			clearInterval(Interval);
		    Interval = setInterval(function(){
		    	weibo.checkInputLength('#content_publish',1400);
			},300);
		});
		weibo.checkInputLength('#content_publish',1400);
		shortcut('ctrl+return',	function(){weibo.do_publish();clearInterval(Interval);},{'target':'miniblog_publish'});
	},
	//发布前的检测
	before_publish:function(){
		$(".weibo_status").remove();
		if($.trim($('#content_publish').val())=='' || $.trim($('#content_publish').val())=='我想说...'){
            $("#publish_type_content_before").after("<div class='weibo_status'>内容不能为空！</div>");	
			return false;
		}
		
		if($("#sina_sync").attr("checked")==true){
			$("input[name='sync[]']").val($("#sina_sync").val().trim());
		}
		$("#publish_type_content_before").after("<div class='weibo_status'>微博发布中...</div>");
		return true;
	},
	//发布操作
	do_publish:function(){
		if( weibo.before_publish() ){
			weibo.textareaStatus('sending');
			var options = {
			    success: function(txt) {
			      if(txt){
			    	   weibo.after_publish(txt);
			      }else{
	                  $("#publish_type_content_before").after("<div class='weibo_status'>微博发布失败！</div>");
			      }
				}
			};		
			$('#miniblog_publish').ajaxSubmit( options );
		    return false;
		}
		
		return false;
	},
	//发布后的处理
	after_publish:function(txt){
		if(txt==0) {
			ui.success('您发布的微博含有敏感词，请等待审核！');
		}else{
			delTypeBox();
		    $("#feed_list").prepend( txt ).slideDown('slow');
		    var sina_sync = $('#sina_sync').attr('checked');
		    $('#miniblog_publish').clearForm();
		    if(sina_sync){
		    	$('#sina_sync').attr('checked', true);
		    }
		    weibo.upCount('weibo');
			$(".weibo_status").remove();
			$("#publish_type_content_before").after("<div class='weibo_status'>微博发布成功！</div>");
			setTimeout("weibo.redirect('/weibo/mine/')",500);
		    weibo.checkInputLength('#content_publish',1400);
		}
	},
	//页面跳转
	redirect:function(txt){
		window.location.href = txt;
	},
	//发布按钮状态
	textareaStatus:function(type){
		var obj = $('#publish_handle');
		if(type=='on'){
			obj.removeAttr('disabled').attr('class','btn_big hand');
		}else{
			obj.attr('disabled','true').attr('class','btn_big_disable hand');
		}
	},
	//删除一条微博
	deleted:function(weibo_id){
		$.post(U("weibo/Operate/delete"),{id:weibo_id},function(txt){
			if( txt ){
				$("#list_li_"+weibo_id).slideUp('fast');
				$(".cl."+weibo_id).hide();
				$(".border6.mb20."+weibo_id).hide();
				weibo.downCount('weibo');
			}else{
				alert('删除失败');
			}
		});
	},
	//收藏
	favorite:function(id,o){
		$.post( U("weibo/Operate/stow") ,{id:id},function(txt){
			if( txt ){
				$(o).wrap('<span id=content_'+id+'></span>');
				$('#content_'+id).html('已收藏');
			}else{
				alert('收藏失败');
			}
		});
	},
	//取消收藏
	unFavorite:function(id,o){
		$.post( U("weibo/Operate/unstow") ,{id:id},function(txt){
			if(txt){
				$(o).html('收藏');
				$(o).removeAttr('onclick');
				$(o).bind('click',function(){
					$.post( U("weibo/Operate/stow") ,{id:id},function(txt){
						if( txt ){
							$(o).wrap('<span id=content_'+id+'></span>');
							$('#content_'+id).html('已收藏');
						}else{
							alert('收藏失败');
						}
					});
				});
			}else{
				alert('取消失败');
			}
		});
		
		return false;
	},
	//转发
	transpond:function(id,upcontent){
		upcontent = ( upcontent == undefined ) ? 1 : 0;
		ui.box.load( U("weibo/operate/transpond",["id="+id,"upcontent="+upcontent] ),{title:'转发',closeable:true});
	},
	//关注话题
	followTopic:function(name){
		$.post(U('weibo/operate/followtopic'),{name:name},function(txt){
			txt = eval( '(' + txt + ')' );
			if(txt.code==12){
				$('#followTopic').html('<a href="javascript:void(0)" onclick="weibo.unfollowTopic(\''+txt.topicId+'\',\''+name+'\')">取消该话题</a>');
			}
		});
	},
	unfollowTopic:function(id,name){
		$.post(U('weibo/operate/unfollowtopic'),{topicId:id},function(txt){
			if(txt=='01'){
				$('#followTopic').html('<a href="javascript:void(0)" onclick="weibo.followTopic(\''+name+'\')">关注该话题</a>');
			}
		});	
	},
	quickpublish:function(text){
		$.post(U('weibo/operate/quickpublish'),{text:text},function(txt){
			ui.box.show(txt,{title:'说几句',closeable:true});
		});
	},
	//更新计数器
	upCount:function(type){
		if(type=='weibo'){
			$("#miniblog_count").html( parseInt($('#miniblog_count').html())+1 );
		}
	},
	downCount:function(type){
		if(type=='weibo'){
			$("#miniblog_count").html( parseInt($('#miniblog_count').html())-1 );
		}
	},
	//检查字数输入
	checkInputLength:function(obj,num){
		var len = getLength($(obj).val(), true);
		var wordNumObj = $('.wordNum');
		
		if(len==0){
			wordNumObj.css('color','').html('你还可以输入<strong id="strconunt">'+ (num-len) + '</strong>字');
			weibo.textareaStatus('off');
		}else if( len > num ){
			wordNumObj.css('color','red').html('已超出<strong id="strconunt">'+ (len-num) +'</strong>字');
			weibo.textareaStatus('off');
		}else if( len <= num ){
			wordNumObj.css('color','').html('你还可以输入<strong id="strconunt">'+ (num-len) + '</strong>字');
			weibo.textareaStatus('on');
		}
	},
	publish_type_box:function(type_num,content,mg_left){
		var __THEME__ = "<?php echo __THEME__;?>";
		var html = '<div class="talkPop"><div  style="position: relative; height: 7px; line-height: 3px;">'
		     + '<img class="talkPop_arrow" style="margin-left:'+ mg_left +'px;position:absolute;" src="'+__THEME__+'/images/zw_img.gif" /></div>'
             + '<div class="talkPop_box">'
			 + '<div class="close" id="weibo_close_handle"><a href="javascript:void(0)" class="del" onclick=" delTypeBox()" > </a></div>'
			 + '<div id="publish_type_content">'+content+'</div>'
			 + '</div></div>';
		$('input[name="publish_type"]').val( type_num );
		$('div.talkPop').remove();
		$("#publish_type_content_before").after( html );
	}
}

/**
weibo.prototype.plugin = function(name, fn) {
    this.prototype[name] = fn;  
    return this;  
}
**/
weibo = new weibo();

weibo.plugin = {};

function addtheme(){
	var text = '#请在这里输入自定义话题#';
	var   patt   =   new   RegExp(text,"g");  
	var content_publish = $('#content_publish');
	var result;
	
	if(content_publish.val().trim() == '我想说...'){
		content_publish.val(text);
	}else if( content_publish.val().search(patt) == '-1' ){
		content_publish.val( content_publish.val() + text);
	}
	
	var textArea = document.getElementById('content_publish');
	
	result = patt.exec( content_publish.val() );
	
	var end = patt.lastIndex-1 ;
	var start = patt.lastIndex - text.length +1;
	
	if (document.selection) { //IE
		 var rng = textArea.createTextRange();
		 rng.collapse(true);
		 rng.moveEnd("character",end)
		 rng.moveStart("character",start)
		 rng.select();
	}else if (textArea.selectionStart || (textArea.selectionStart == '0')) { // Mozilla/Netscape…
        textArea.selectionStart = start;
        textArea.selectionEnd = end;
    }
    textArea.focus();
	weibo.checkInputLength('#content_publish',1400);
	return ;
}

function focusWeiboSearch(o,type){
	var k = $(o).val().trim();
	if(type=='blur'){
		if(k==''){
			$(o).val('搜索微博...');
			return false;
		}
	}else{
		if(k=='搜索微博...'){
			$(o).val('');
			return false;
		}
	}
}
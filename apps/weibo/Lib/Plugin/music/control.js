jQuery.extend(weibo.plugin, {
	music:function(element, options){
	   
	    
	}
});


jQuery.extend(weibo.plugin.music, {
	html:'<div id="music_input">请输入歌曲链接地址：<div><input name="publish_type_data" type="text" style="width: 235px"   class="text  mr5"  value="" /><input type="button" class="btn_b" onclick="weibo.plugin.music.add_music()" value="添加"></div></div><div style="display:none" id="music_add_complete">添加完成</div>',
	click:function(options){
	   weibo.publish_type_box(4,this.html,options)
	},
	add_music:function(){
		var video_url = $("input[name='publish_type_data']").val();
		var point = video_url.lastIndexOf(".");
		var type = video_url.substr(point);
		if( type.toLowerCase() != '.mp3'){
			alert('只能发布以mp3结尾的音乐');
			return false;
		}
		$.post( U('weibo/plugins/before_publish'),{url:video_url,plugin_id:4},function(txt){
			txt = eval('('+txt+')');
			if(txt.boolen){
				$('#music_input').hide();
				$('#music_add_complete').show();
				if($("#content_publish").val() == '我想说...'){
					$("#content_publish").val( txt.data + ' ');
				}else{
					$("#content_publish").val( $("#content_publish").val( ) + ' ' + txt.data + ' ');
				}
				weibo.checkInputLength('#content_publish',140);
				$('div .talkPop').hide();
			}else{
				alert(txt.message);
			}
		})
	}
});
//字符串长度-中文和全角符号为1，英文、数字和半角为0.5
var getLength = function(str, shortUrl) {
	if (true == shortUrl) {
		return Math.ceil(str.replace(/((news|telnet|nttp|file|http|ftp|https):\/\/){1}(([-A-Za-z0-9]+(\.[-A-Za-z0-9]+)*(\.[-A-Za-z]{2,5}))|([0-9]{1,3}(\.[0-9]{1,3}){3}))(:[0-9]*)?(\/[-A-Za-z0-9_\$\.\+\!\*\(\),;:@&=\?\/~\#\%]*)*/ig, 'http://goo.gl/fkKB ')
							.replace(/^\s+|\s+$/ig,'').replace(/[^\x00-\xff]/ig,'xx').length/2);
	} else {
		return Math.ceil(str.replace(/^\s+|\s+$/ig,'').replace(/[^\x00-\xff]/ig,'xx').length/2);
	}
};
var subStr = function (str, len) {
    if(!str) { return ''; }
        len = len > 0 ? len*2 : 280;
    var count = 0,	//计数：中文2字节，英文1字节
        temp = '';  //临时字符串
    for (var i = 0;i < str.length;i ++) {
    	if (str.charCodeAt(i) > 255) {
        	count += 2;
        } else {
        	count ++;
        }
        //如果增加计数后长度大于限定长度，就直接返回临时字符串
        if(count > len) { return temp; }
        //将当前内容加到临时字符串
         temp += str.charAt(i);
    }
    return str;
};

function addFavorite(url,title) {
	var ua = navigator.userAgent.toLowerCase();
	if(ua.indexOf("msie 8")>-1){
		external.AddToFavoritesBar(url,title,'');//IE8
	}else{
		try {
			window.external.addFavorite(url, title);
		} catch(e) {
			try {
			
				window.sidebar.addPanel(title, url, "");//firefox
			
			} catch(e) {
				
				alert("请使用快捷键 Ctrl+D 进行添加！");
			}
		}
	}
	return false;
}

String.prototype.escape_html = function() {
  return this.replace(/&/g, "&amp;")
             .replace(/</g, "&lt;")
             .replace(/>/g, "&gt;")
             .replace(/"/g, "&quot;");
};
String.prototype.trim = function() {
  return this.replace(/^\s+|\s+$/g,"");
};

String.prototype.startsWith = function(str){
    return (this.indexOf(str) === 0);
}

String.prototype.is_int =function (){ 
  if((parseFloat(this) == parseInt(this)) && !isNaN(this)){
      return true;
  } else { 
      return false;
  } 
}

//获取url参数值
function getQueryString(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) return unescape(r[2]); 
	return ;
}

function require_login(){
  window.location.href = U('home/public/login');
  return false;
}

$(document).ready(function(){
	var submit_suggest_check = false;
	$("#submit_suggestion").live('click',function(){
		if(submit_suggest_check) return false;
		
		var form = $("#transpondForm");
		var title = form.find("input[name='title']").val().trim();
		var content = form.find("textarea[name='content']").val().trim();
		if(title=='' || content==''){
			alert('标题和内容不能为空！');
			return false;
		}
		submit_suggest_check = true;
		$.post(U('home/user/dosuggest'),{title:title,content:content},function(txt){
			submit_suggest_check = false;
			if(txt==1){
				alert('意见提交成功！');
				ui.box.close();
			}else if(txt==-1){
				alert('标题和内容不能为空！');
			}else{
				alert('意见提交失败！');
			}
		});
		return false;
	});
});

function showSelection(type,o){
	$(o).parent("div.wid70.rtit2_1").find("a").each(function(){
		$(".publish.default").hide();
		$(this).css("color","");
		$(".publish").hide();
	});
	
	$(o).css("color","#F00");
	$(".publish."+type).show();
	
	return false;
}

function showQuestion(){
	$(".publish.default").hide();
	$(".publish.question").show();
	
	return false;
}

function onFocus(t,o){
	var k = $(o).val().trim();
	if(k==t){
		$(o).val('');
	}
	return false;
}

function onBlur(t,o){
	var k = $(o).val().trim();
	if(k==''){
		$(o).val(t);
	}
	return false;
}
function addSuggestion(){
	ui.box.load(U("home/user/suggest"),{title:'意见或建议',closeable:true});	
}
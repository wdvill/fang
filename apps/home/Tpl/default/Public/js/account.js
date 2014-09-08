$(document).ready(function(){
	var up_pic_width =50;
	var up_pic_height =50;
		
	var profile_submit_check = false;
	$("#profile_form").live("submit",function(){
		if(profile_submit_check) return false;
		$("span.wrong_message").remove();
		
		var _this = $(this);
		var email = _this.find("input[name='email']").val().trim();
		var emailcheck = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
		
		if(_this.find("input[name='name']").val().trim()==''){
			$(".submit_profile").prepend("<span class='wrong_message'>请填写您的姓名！</span>");
			return false;
		}
		if(email=='' || email.search(emailcheck)==-1){
			$(".submit_profile").prepend("<span class='wrong_message'>请填写正确的邮箱地址！</span>");
			return false;
		}
		if(_this.find("input[name='company']").val().trim()==''){
			$(".submit_profile").prepend("<span class='wrong_message'>请填写您的公司！</span>");
			return false;
		}
		if(_this.find("input[name='position']").val().trim()==''){
			$(".submit_profile").prepend("<span class='wrong_message'>请填写您的职位！</span>");
			return false;
		}
		if(_this.find("input[name='industry']").val().trim()==''){
			$(".submit_profile").prepend("<span class='wrong_message'>请填写您所在的行业！</span>");
			return false;
		}
		if(_this.find("input[name='domain']").val().trim()==''){
			$(".submit_profile").prepend("<span class='wrong_message'>请填写您的名片链接！</span>");
			return false;
		}
		profile_submit_check = true;
		var options = {
			success:function(txt){
				profile_submit_check = false;
				
				if(txt==-1){
					$(".submit_profile").prepend("<span class='wrong_message'>请填写您的姓名！</span>");
				}else if(txt==-2){
					$(".submit_profile").prepend("<span class='wrong_message'>该姓名已被使用！</span>");
				}else if(txt==-3){
					$(".submit_profile").prepend("<span class='wrong_message'>@引称已被使用！</span>");
				}else if(txt==-4){
					$(".submit_profile").prepend("<span class='wrong_message'>请填写正确的邮箱地址！</span>");
				}else if(txt==-5){
					$(".submit_profile").prepend("<span class='wrong_message'>该邮箱已被使用！</span>");
				}else if(txt==-6){
					$(".submit_profile").prepend("<span class='wrong_message'>请填写您的公司！</span>");
				}else if(txt==-7){
					$(".submit_profile").prepend("<span class='wrong_message'>请填写您的职位！</span>");
				}else if(txt==-8){
					$(".submit_profile").prepend("<span class='wrong_message'>请填写您所在的行业！</span>");
				}else if(txt==-9){
					$(".submit_profile").prepend("<span class='wrong_message'>请填写您的名片链接！</span>");
				}else if(txt==-10){
					$(".submit_profile").prepend("<span class='wrong_message'>该名片链接已被使用！</span>");
				}else if(txt==-11){
					$(".submit_profile").prepend("<span class='wrong_message'>手机号码或手机验证码不合法！</span>");
				}else if(txt==-12){
					$(".submit_profile").prepend("<span class='wrong_message'>手机号码已被注册！</span>");
				}else if(txt==1){
					alert("信息保存成功！");
					window.location.href=U('home/account/profile');
				}else{
					alert("信息保存失败，请稍后再试！");
				}
			}
		};
		_this.ajaxSubmit(options);
		
		return false;
	});
	
	var work_submit_check = false;
	$("#work_form").live("submit",function(){
		if(work_submit_check) return false;
		$("span.wrong_message").remove();
		
		var _this = $(this);
		var company = _this.find("input[name='company']").val().trim();
		var position = _this.find("input[name='position']").val().trim();
		var intro = _this.find("textarea[name='intro']").val().trim();
		
		if(company=='' || position=='' || intro==''){
			$(".submit_work").append("<span class='wrong_message'>工作经历信息尚未完善！</span>");
			return false;
		}
		
		work_submit_check = true;
		var options = {
			success:function(txt){
				work_submit_check = false;
				
				if(txt>0){
					alert("工作经历保存成功！");
					window.location.href=U('home/account/work');
				}else if(txt==-1){
					alert("该工作经历已经存在！");
				}else{
					alert("工作经历保存失败，请稍后再试！");
				}
			}
		};
		_this.ajaxSubmit(options);
		
		return false;
	});
	
	var edu_submit_check = false;
	$("#edu_form").live("submit",function(){
		if(edu_submit_check) return false;
		$("span.wrong_message").remove();
		
		var _this = $(this);
		var school = _this.find("input[name='school']").val().trim();
		var subject = _this.find("input[name='subject']").val().trim();
		var intro = _this.find("textarea[name='intro']").val().trim();
		if(school=='' || subject=='' || intro==''){
			$(".submit_edu").append("<span class='wrong_message'>教育经历信息尚未完善！</span>");
			return false;
		}
		
		edu_submit_check = true;
		var options = {
			success:function(txt){
				edu_submit_check = false;
				
				if(txt>0){
					alert("教育经历保存成功！");
					window.location.href=U('home/account/edu');
				}else if(txt==-1){
					alert("该教育经历已经存在！");
				}else{
					alert("教育经历保存失败，请稍后再试！");
				}
			}
		};
		_this.ajaxSubmit(options);
		
		return false;
	});
	
	var security_submit_check = false;
	$("#security_form").live("submit",function(){
		if(security_submit_check) return false;
		$("span.wrong_message").remove();
		
		var _this = $(this);
		
		var password 	 	= _this.find('input[name=old_pwd]').val().trim();
		var newpassword  	= _this.find('input[name=pwd]').val().trim();
		var confirmpassword = _this.find('input[name=confirmpwd]').val().trim();
		
		if(password.length>0 && (password.length<6 || newpassword.length<6 || confirmpassword.length<6 || password.length>16 || newpassword.length>16 || confirmpassword.length>16) ){
		  $(".submit_security").append("<span class='wrong_message'>密码长度为6-16位！</span>");
		  return false;
		}	
		
		if(newpassword != confirmpassword){
		  $(".submit_security").append("<span class='wrong_message'>两次输入的密码不相同！</span>");
		  return false;
		}
		
		security_submit_check = true;
		var options = {
			success:function(txt){
				security_submit_check = false;
				
				if(txt>0){
					alert("安全信息保存成功！");
					window.location.href=U('home/account/security');
				}else if(txt==-1){
					alert("原始密码输入错误！");
				}else if(txt==-2){
					alert("新密码输入不合法，6-16位，并且两次输入的密码必须相同！");
				}else if(txt==-3){
					return false;
				}else{
					alert("安全信息保存失败，请稍后再试！");
				}
			}
		};
		_this.ajaxSubmit(options);
		
		return false;
	});
	
	//用户头像上传
	var stopUploadPic = 0;
	$('#uploadAvatar').live('click',function(event){
		stopUploadPic = 0;
		
		var allowext = ['jpg','jpeg','gif','png'];
		var ext = /\.[^\.]+$/.exec( $("#upload_avatar").val() );
		ext = ext.toString().replace('.','');
		if( jQuery.inArray( ext.toLowerCase() , allowext )==-1 ){
			alert('只允许上传jpg、jpeg、gif、png格式的图片');
			return false;
		}
		
		$('#loading_avatar').show();
		
		var uploadurl = U('home/Account/uploadAvatar');
		var fileval = $('#upload_avatar').attr('value');
		if (fileval.length>0){
			$.ajaxFileUpload( { 
				url:uploadurl,
				secureuri:false,
				fileElementId:'upload_avatar',
				dataType: 'text',
				success: function (txt) 
				{
					if(stopUploadPic==1){
						return false;
					}
					handlepic(txt);
				},
				error:function(txt){
					$('#loading_avatar').hide();
				}
			});
		}
		return false;
	});
	
	if($('#avatar_preview').attr('src')){
		$('#avatar_preview').imgAreaSelect({ 
			x1: 0, 
			y1: 0,
			x2: 150, 
			y2: 150, 
			handles: true,
			onInit:preview,
			onSelectEnd:onSelectEnd,
			aspectRatio: '1:1',
			instance: true,
			parent:$('#photo')
		});
	}
	
	//保存用户头像
	$('#save_avatar').live('click',function(){
		var picurl = $('#avatar_data').val();
		/*if(picurl==''){
			alert("您还没有上传头像图片！");
			return false;
		}*/
		var params = {};
		var picsaveurl = U('home/Account/saveAvatar');
		params['picurl'] = picurl;
		params['x1'] = $('input[name="x1"]').val();
		params['y1'] = $('input[name="y1"]').val();
		params['x2'] = $('input[name="x2"]').val();
		params['y2'] = $('input[name="y2"]').val();
		params['w'] = $('input[name="w"]').val();
		params['h'] = $('input[name="h"]').val();
		
		$.post(picsaveurl,params,function(txt){
			if (txt == '1') {
				alert("头像保存成功");
				window.location.href = U('home/account/avatar');
			} else {
				alert('很抱歉！头像保存失败！');
			}
		});
		return false;
	});
	
	//用户绑定
	$(".bind_action").each(function(){
		$(this).click(function(){
			var type = $(this).attr("tp");
			var typech = $(this).attr("tpch");
			var selected = $(this); 
			if(selected.hasClass("bind")){
				window.location.href = U('home/Account/bindplatform',['type='+type]);
			}else if(selected.hasClass("delbind")){
				if(!confirm('确认解除绑定'+typech+'？')){
					return false;
				}
				$.post(U('home/Account/delbind'),{type:type},function(txt){
					if(txt==1){
						selected.addClass("bind");
						selected.html("开始绑定");
					}else{
						alert("解除绑定失败，请稍后再试！");
					}
				});
			}
			return false;
		});
	});
	
	var phoneverifycheck = false;
	$("#getphoneverify").click(function(){
		if(phoneverifycheck) return false;
		
		var selected = $(this);
		if(selected.hasClass("phone-verified")) return false;
		
		var phone = $("input[name='cellphone']").val().trim();
		var numbercheck = /[^0-9]/; // allow numbers
		if (numbercheck.test(phone) || phone.length != 11){
			alert("请正确填写手机号码！");
			return false;
		}
		
		phoneverifycheck = true;
		
		var param = {};
		param['phone'] = phone;
		
		$.post(U("home/account/sendPhoneVerify"),param,function(txt){
			phoneverifycheck = false;
			if(txt == 1){
				selected.addClass("phone-verified");
				selected.html("获取验证码(300)");
				setInterval("countTime()",1000);
				setTimeout("phoneVerifyVal()",300000);
				alert('密码发送成功，请尽快获取。密码的时效性为10分钟！（可能会有延迟，请耐心等候！）');
			}else if(txt=='used'){
				alert('手机号码已被注册！');
			}else if(txt==-3){
				alert('上次发送的密码还未过时。请勿重新发送！');
			}else if(txt==-2){
				alert('手机号码不合法或已被注册！');
			}else if(txt==-1){
				alert('操作过于频繁，请5分钟后再试！');
			}else{
				alert('发送失败，请稍后重试！');
			}
		});
	});
});

function countTime(){
	var time = parseInt($("#getphoneverify").html().replace('获取验证码(','').replace(')',''));
	if(time > 1){
		$("#getphoneverify").html('获取验证码('+(time-1)+')');
	}else{
		$("#getphoneverify").html('获取验证码(1)');
	}
}

function phoneVerifyVal(){
	$("#getphoneverify").removeClass("phone-verified");
	$("#getphoneverify").html("获取验证码");
}

function checkDomain(){
	var domain = $("input[name='domain']").val().trim();
	if(domain=='') return false;
	$.post(U('home/account/checkdomain'),{domain:domain},function(txt){
		if(txt==1){
			alert("该链接可用！");
		}else if(txt==-1){
			alert("您当前正使用该链接！");
		}else{
			alert("该链接已被使用！");
		}
	});
}

function handlepic1(txt){
	txt = eval('('+txt+')');
	if(txt.status=='1'){
		var tmpDate = new Date(); 
		$("#avatar_preview").attr('src',txt.data['image']+'?t='+ tmpDate.getTime());
		$("#avatar_data").attr('value',txt.data['picurl']);
	}else{
		alert(txt.message);
	}
	
	$('#loading_avatar').hide();
}

function cancelAvatar(){
	$("input[name=avatar]").val("");
	//$("#avatar_data").val("");
	$("#avatar_preview").attr('src',$("#curr_avatar").val());
	return false;
}

function handlepic(txt){
	txt = eval('('+txt+')');
	
	if(txt.status=='1'){
		var tmpDate = new Date(); 
		set_UP_W_H(txt.data['picwidth'],txt.data['picheight']);
		var defautlv = ( txt.data['picwidth'] > txt.data['picheight']) ?txt.data['picheight']:txt.data['picwidth'];
		//$("#photo").html("<img id='photo_img' style='max-width:200px;' src="+txt.data['image']+'?t='+ tmpDate.getTime()+">");
		//$("input[name=picurl]").attr('value',txt.data['picurl']);
		$("#avatar_preview").attr('src',txt.data['image']+'?t='+ tmpDate.getTime());
		$("#avatar_data").attr('value',txt.data['picurl']);
		
		$('#avatar_preview').imgAreaSelect({ 
			x1: 0, 
			y1: 0,
			x2: 150, 
			y2: 150, 
			handles: true,
			onInit:preview,
			onSelectEnd:onSelectEnd,
			aspectRatio: '1:1',
			instance: true,
			parent:$('#photo')
		});
	}else{
		alert(txt.message);
	}
	$('#loading_avatar').hide();
}	

function set_UP_W_H(w,h){
	up_pic_width = w;
	up_pic_height = h;
}	
	
function onSelectEnd(img,selection){
	$('input[name=x1]').val(selection.x1 || 0);
	$('input[name=y1]').val(selection.y1 || 0);
	$('input[name=x2]').val(selection.x2 || 0);
	$('input[name=y2]').val(selection.y2 || 0); 
	$('input[name=w]').val(selection.width || 0); 
	$('input[name=h]').val(selection.height || 0); 
}
	
function preview(img, selection) {
	onSelectEnd(img,selection);
	var big_scaleX = 150 / (selection.width || 1);
	var big_scaleY = 150 / (selection.height || 1);
	
	$('#photo_big').css({
		width: Math.round(big_scaleX * up_pic_width) + 'px',
		height: Math.round(big_scaleY * up_pic_height) + 'px',
		marginLeft: '-' + Math.round(big_scaleX * selection.x1) + 'px',
		marginTop: '-' + Math.round(big_scaleY * selection.y1) + 'px'
	});
}

function addOrCancelWork(){
	var form = $("#work_form");
	form.find("input").val("");
	form.find("select").val("");
	form.find("select[name='area_province']").val(1);
	form.find("select[name='area_city']").val(2);
	form.find("textarea").val("");
	return false;
}

//编辑教育经历
function editWork(id){
	if(!id) return false;
	$.post(U('home/account/getprofile'),{id:id},function(txt){
		if(txt){
			txt = eval('('+txt+')');
			var form = $("#work_form");
			form.find("select[name='start']").val(txt['data']['start']);
			form.find("select[name='end']").val(txt['data']['end']);
			form.find("input[name='company']").val(txt['data']['company']);
			form.find("input[name='website']").val(txt['data']['website']);
			form.find("select[name='industry']").val(txt['data']['industry']);
			form.find("select[name='property']").val(txt['data']['property']);
			form.find("select[name='scale']").val(txt['data']['scale']);
			form.find("input[name='position']").val(txt['data']['position']);
			form.find("div.work_location").html('<select name="area_province"><option>省/直辖市</option></select> <select name="area_city"><option value=0>不限</option></select>');
			ui.getarea1('area','',txt['data']['province'],txt['data']['city']);
			form.find("textarea[name='intro']").val(txt['data']['intro']);
			form.find("input[name='addoredit']").val('edit');
			form.find("input[name='pd']").val(txt['id']);
		}
	});
	return false;
}

//删除工作经历
function deleteWork(id){
	if(!id) return false;
	if(!confirm("确认删除该工作经历？")) return false;
	
	$.post(U('home/account/deleteprofile'),{id:id},function(txt){
		if(txt){
			$("div.worklist_"+id).slideUp('fast');
		}
	});
	return false;
}

function addOrCancelEdu(){
	var form = $("#edu_form");
	form.find("input").val("");
	form.find("select").val("");
	form.find("select[name='area_province']").val(1);
	form.find("select[name='area_city']").val(2);
	form.find("textarea").val("");
	return false;
}

//编辑教育经历
function editEdu(id){
	if(!id) return false;
	$.post(U('home/account/getprofile'),{id:id},function(txt){
		if(txt){
			txt = eval('('+txt+')');
			var form = $("#edu_form");
			form.find("select[name='start']").val(txt['data']['start']);
			form.find("select[name='end']").val(txt['data']['end']);
			form.find("div.edu_location").html('<select name="area_province"><option>省/直辖市</option></select> <select name="area_city"><option value=0>不限</option></select>');
			ui.getarea1('area','',txt['data']['province'],txt['data']['city']);
			//form.find("select[name='area_province']").val(txt['data']['province']);
			//form.find("select[name='area_city']").val(txt['data']['city']);
			form.find("input[name='school']").val(txt['data']['school']);
			form.find("input[name='subject']").val(txt['data']['subject']);
			form.find("textarea[name='intro']").val(txt['data']['intro']);
			form.find("input[name='addoredit']").val('edit');
			form.find("input[name='pd']").val(txt['id']);
		}
	});
	return false;
}

//删除教育经历
function deleteEdu(id){
	if(!id) return false;
	if(!confirm("确认删除该教育经历？")) return false;
	
	$.post(U('home/account/deleteprofile'),{id:id},function(txt){
		if(txt){
			$("div.edulist_"+id).slideUp('fast');
		}
	});
	return false;
}

//获取年份列表
function getYearList(begin,choose){
	var nowdate = new Date();
	var now = nowdate.getFullYear();
	var beginYear = now;
	var html = '';
	for(var i=beginYear;i>=(beginYear-30);i--){
		if(choose==i){
			html+= '<option value='+i+' selected="selected">'+i+'</option>';
		}else{
			html+= '<option value='+i+'>'+i+'</option>';
		}
	}
	return html;
}

//获取年份列表
function getUserYearList(begin,choose){
	var nowdate = new Date();
	var now = nowdate.getFullYear();
	var beginYear = now;
	var html = '';
	for(var i=beginYear;i>=(beginYear-60);i--){
		if(choose==i){
			html+= '<option value='+i+' selected="selected">'+i+'</option>';
		}else{
			html+= '<option value='+i+'>'+i+'</option>';
		}
	}
	return html;
}

//获取月份列表
function getMonthList(begin,choose){
	var html = '';
	for(var i=1;i<=12;i++){
		if(choose==i){
			html+= '<option value='+i+' selected="selected">'+i+'</option>';
		}else{
			html+= '<option value='+i+'>'+i+'</option>';
		}
	}
	return html;
}

//获取天数列表
function getDayList(begin,choose){
	var html = '';
	for(var i=1;i<=31;i++){
		if(choose==i){
			html+= '<option value='+i+' selected="selected">'+i+'</option>';
		}else{
			html+= '<option value='+i+'>'+i+'</option>';
		}
	}
	return html;
}
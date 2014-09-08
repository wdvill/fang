$(document).ready(function(){
	var phoneverifycheck = false;
	$("#getphoneverify").click(function(){
		if(phoneverifycheck) return false;
		
		var selected = $(this);
		if(selected.hasClass("phone-verified")) return false;
		
		var phone = $("input[name='phone']").val().trim();
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
				selected.html("获取验证码（300）");
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
	var time = parseInt($("#getphoneverify").html().replace('获取验证码（','').replace('）',''));
	if(time > 1){
		$("#getphoneverify").html('获取验证码（'+(time-1)+'）');
	}else{
		$("#getphoneverify").html('获取验证码（1）');
	}
}

function phoneVerifyVal(){
	$("#getphoneverify").removeClass("phone-verified");
	$("#getphoneverify").html("获取验证码");
}

function savePhone(o){
	var form = $(o);
	
	if(form.find("input[name='phone']").val().trim()=='' || form.find("input[name='phoneverify']").val().trim()==''){
		alert("手机号码和验证码不能为空！");
		return false;
	}
	var options = {
		success:function(txt){
			if(txt==1){
				alert("验证成功！");
				ui.box.close();
			}else if(txt==-1){
				alert("手机号码或验证码不合法！");
			}else if(txt==-2){
				alert("手机号码已被注册！");
			}else{
				alert("验证失败！");
			}
		}	
	}
	
	form.ajaxSubmit(options);
	return false;
}

//群组创建时的手机验证并保存
function savePhone1(o){
	var form = $(o);
	
	if(form.find("input[name='phone']").val().trim()=='' || form.find("input[name='phoneverify']").val().trim()==''){
		alert("手机号码和验证码不能为空！");
		return false;
	}
	var options = {
		success:function(txt){
			if(txt==1){
				alert("验证成功！");
				window.location.href=U("group/index/add");
			}else if(txt==-1){
				alert("手机号码或验证码不合法！");
			}else if(txt==-2){
				alert("手机号码已被注册！");
			}else{
				alert("验证失败！");
			}
		}	
	}
	
	form.ajaxSubmit(options);
	return false;
}

//活动创建时的手机验证并保存
function savePhoneEvent(o){
	var form = $(o);
	
	if(form.find("input[name='phone']").val().trim()=='' || form.find("input[name='phoneverify']").val().trim()==''){
		alert("手机号码和验证码不能为空！");
		return false;
	}
	var options = {
		success:function(txt){
			if(txt==1){
				alert("验证成功！");
				window.location.href=U("event/index/addEvent");
			}else if(txt==-1){
				alert("手机号码或验证码不合法！");
			}else if(txt==-2){
				alert("手机号码已被注册！");
			}else{
				alert("验证失败！");
			}
		}	
	}
	
	form.ajaxSubmit(options);
	return false;
}
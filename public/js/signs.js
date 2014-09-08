$(document).ready(function(){
	var login_check = false;
	$("form#login_form").live('submit',function(){
		if(login_check) return false;
		
		var _this = $(this);
		var error_message = $(".error-message");
		var username = _this.find("input[name='email']");
		var password = _this.find("input[name='password']");
		
		if( username.val()=='' ){
			error_message.html('<img src="'+_THEME_+'/images/warning.png" />用户名不能为空');
			return false;
		}else if(password.val() == ''){
			error_message.html('<img src="'+_THEME_+'/images/warning.png" />密码不能为空');
			return false;
		}
		error_message.html('');
		login_check = true;
		
		var options = {
		    success: function(txt) {
				login_check = false;
				if(txt == '-1'){
					error_message.html('<img src="'+_THEME_+'/images/warning.png" />用户名错误！');
				}else if(txt == '-2'){
					error_message.html('<img src="'+_THEME_+'/images/warning.png" />密码错误！');
				}else if(txt == '-3'){
					error_message.html('<img src="'+_THEME_+'/images/warning.png" />验证码错误！');
				}else if(txt){
					window.location.href = txt;
				}else{
					error_message.html('<img src="'+_THEME_+'/images/warning.png" />用户名或密码错误！');
				} 
		    } 
		};		
		_this.ajaxSubmit( options );
	    return false;
	});
	
	var register_check = false;
	$('#register_submit').live('click',function(){
		if(register_check) return false;
		
		var form = $("div.signs-register");
		var name = form.find('#name').val().trim();
		var email = form.find('#email').val().trim();
		var passwd = form.find('#user_password').val().trim();
		var cellphone = form.find('#cellphone').val().trim();
		var selectedRow = $(this);
		var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
		var numbercheck = /[^0-9]/; // allow letters, numbers
		$(".register-error").html('');
		if(name.length <=0){
			$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />名字不能为空！');
		    return false;
		}
		if(email.search(emailRegEx) == -1){
			$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邮箱不合法！');
			return false;
		}
		if(passwd.length <6 || passwd.length >16){
			$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />密码长度6-16位！');
			return false;
		}
		if(cellphone.length > 0 && (cellphone.length != 11 || email.search(numbercheck) == -1)){
			$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />手机号码不合法！');
			return false;
		}
		var param = {};
		param['email']=email;
		param['name']=name;
		param['password']=passwd;
		param['cellphone']=cellphone;
		
		register_check = true;
		
		$.post(U('home/Public/doRegister'),param,function(txt){
			register_check = false;
			
			txt = eval('('+txt+')');
			if(txt.nea==1){
				window.location.href = txt.url;
			}else{
				if (txt == 1) {
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />申请成功，等待审核中。！');
				} else if (txt == -1) {
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邮箱不合法！');
				} else if (txt == -2){
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邮箱已被使用！');
				} else if (txt == -3){
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />密码长度6-16位！');
				} else if (txt == -4){
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />手机号码不合法！');
				} else if (txt == -5){
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />申请成功，等待审核中。');
				} else if(txt){
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />'+txt+'！');	
				}else{
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />注册失败，请稍后重试！');
				}
			}
		});
		return false;
	});
	
	var register_invite_check = false;
	$('#register_invite_submit').live('click',function(){
		if(register_invite_check) return false;
		
		var form = $("div.signs-invite-register");
		var name = form.find('#name').val().trim();
		var email = form.find('#email').val().trim();
		var passwd = form.find('#user_password').val().trim();
		var cellphone = form.find('#cellphone').val().trim();
		var invitecode = form.find('#invitecode').val().trim();
		var selectedRow = $(this);
		var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
		var numbercheck = /[^0-9]/; // allow letters, numbers
		$(".register-error").html('');
		if(name.length <=0){
			$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />名字不能为空！');
		    return false;
		}
		if(email.search(emailRegEx) == -1){
			$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邮箱不合法！');
			return false;
		}
		if(passwd.length <6 || passwd.length >16){
			$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />密码长度6-16位！');
			return false;
		}
		if(cellphone.length > 0 && (cellphone.length != 11 || email.search(numbercheck) == -1)){
			$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />手机号码不合法！');
			return false;
		}
		if(invitecode.length <= 0){
			$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邀请码不能为空！');
			return false;
		}
		var param = {};
		param['email']=email;
		param['name']=name;
		param['password']=passwd;
		param['cellphone']=cellphone;
		param['invitecode']=invitecode;
		
		register_invite_check = true;
		
		$.post(U('home/Public/doRegisterInvite'),param,function(txt){
			register_invite_check = false;
			txt = eval('('+txt+')');
			if(txt.nea==1){
				window.location.href = txt.url;
			}else{
				if (txt == 1) {
					window.location.href = U('home/User/index');
				} else if (txt == -1) {
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邮箱不合法！');
				} else if (txt == -2){
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邮箱已被使用！');
				} else if (txt == -3){
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />密码长度6-16位！');
				} else if (txt == -4){
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />手机号码不合法！');
				} else if (txt == -5){
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邀请码不正确！');
				} else if(txt){
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />'+txt+'！');	
				}else{
					$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />注册失败，请稍后重试！');
				}
			}
		});
		return false;
	});
});
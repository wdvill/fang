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
		var company = form.find('#company').val().trim();
		var position = form.find('#position').val().trim();
		var email = form.find('#email').val().trim();
		var passwd = form.find('#user_password').val().trim();
		var confirmpasswd = form.find('#user_confirmpassword').val().trim();
		var invite = form.find("input[name='invite']").val().trim();
		var selectedRow = $(this);
		var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
		var numbercheck = /[^0-9]/; // allow letters, numbers
		
		
		
		var param = {};
		param['email']=email;
		param['name']=name;
		param['company']=company;
		param['position']=position;
		param['password']=passwd;
		param['confirmpassword']=confirmpasswd;
		param['invite'] = invite;
		
		register_check = true;
		
		$.post(U('home/Public/doRegister'),param,function(txt){
			register_check = false;
			if (txt == 1) {
				window.location.href = U('home/User/index');
			} else if (txt == -1) {
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邮箱不合法！');
			} else if (txt == -2){
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邮箱已被使用！');
			} else if (txt == -3){
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />密码长度6-16位，且两次输入的密码要相同！');
			} else if (txt == -4){
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />申请成功，等待审核中。请注意查看您的邮箱！');
			} else if(txt){
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />'+txt+'！');	
			}else{
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />注册失败，请稍后重试！');
			}
		});
		return false;
	});
	
	var phoneverifycheck = false;
	$("#getphoneverify").click(function(){
		if(phoneverifycheck) return false;
		
		var selected = $(this);
		if(selected.hasClass("phone-verified")) return false;
		
		var phone = $("#phone").val().trim();
		var numbercheck = /[^0-9]/; // allow numbers
		
		if (numbercheck.test(phone) || phone.length != 11){
			alert("请正确填写手机号码！");
			return false;
		}
		
		phoneverifycheck = true;
		
		var param = {};
		param['phone'] = phone;
		
		$.post(U("home/Public/sendPhoneVerify"),param,function(txt){
			phoneverifycheck = false;
			if(txt == 1){
				selected.addClass("phone-verified");
				selected.attr("value","获取密码（300）");
				setInterval("countTime()",1000);
				setTimeout("phoneVerifyVal()",300000);
				alert('密码发送成功，请尽快获取。密码的时效性为10分钟！（可能会有延迟，请耐心等候！）');
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
	var time = parseInt($("#getphoneverify").attr('value').replace('获取密码（','').replace('）',''));
	if(time > 1){
		$("#getphoneverify").attr('value','获取密码（'+(time-1)+'）');
	}else{
		$("#getphoneverify").attr('value','获取密码（1）');
	}
}

function phoneVerifyVal(){
	$("#getphoneverify").removeClass("phone-verified");
	$("#getphoneverify").attr("value","获取密码");
}

function changeverify(){
    var date = new Date();
    var ttime = date.getTime();
    var url = U('home/Public/verify');
    $('#verifyimg').attr('src',url+'&'+ttime);
}
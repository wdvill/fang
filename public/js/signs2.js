$(document).ready(function(){਍ऀ瘀愀爀 氀漀最椀渀开挀栀攀挀欀 㴀 昀愀氀猀攀㬀ഀഀ
	$("form#login_form").live('submit',function(){਍ऀऀ椀昀⠀氀漀最椀渀开挀栀攀挀欀⤀ 爀攀琀甀爀渀 昀愀氀猀攀㬀ഀഀ
		਍ऀऀ瘀愀爀 开琀栀椀猀 㴀 ␀⠀琀栀椀猀⤀㬀ഀഀ
		var error_message = $(".error-message");਍ऀऀ瘀愀爀 甀猀攀爀渀愀洀攀 㴀 开琀栀椀猀⸀昀椀渀搀⠀∀椀渀瀀甀琀嬀渀愀洀攀㴀✀攀洀愀椀氀✀崀∀⤀㬀ഀഀ
		var password = _this.find("input[name='password']");਍ऀऀഀഀ
		if( username.val()=='' ){਍ऀऀऀ攀爀爀漀爀开洀攀猀猀愀最攀⸀栀琀洀氀⠀✀㰀椀洀最 猀爀挀㴀∀✀⬀开吀䠀䔀䴀䔀开⬀✀⼀椀洀愀最攀猀⼀眀愀爀渀椀渀最⸀瀀渀最∀ ⼀㸀⠀㝵ൢൔ﵎㪀穎❺⤀㬀ഀഀ
			return false;਍ऀऀ紀攀氀猀攀 椀昀⠀瀀愀猀猀眀漀爀搀⸀瘀愀氀⠀⤀ 㴀㴀 ✀✀⤀笀ഀഀ
			error_message.html('<img src="'+_THEME_+'/images/warning.png" />密码不能为空');਍ऀऀऀ爀攀琀甀爀渀 昀愀氀猀攀㬀ഀഀ
		}਍ऀऀ攀爀爀漀爀开洀攀猀猀愀最攀⸀栀琀洀氀⠀✀✀⤀㬀ഀഀ
		login_check = true;਍ऀऀഀഀ
		var options = {਍ऀऀ    猀甀挀挀攀猀猀㨀 昀甀渀挀琀椀漀渀⠀琀砀琀⤀ 笀ഀഀ
				login_check = false;਍ऀऀऀऀ椀昀⠀琀砀琀 㴀㴀 ✀ⴀ㄀✀⤀笀ഀഀ
					error_message.html('<img src="'+_THEME_+'/images/warning.png" />用户名错误！');਍ऀऀऀऀ紀攀氀猀攀 椀昀⠀琀砀琀 㴀㴀 ✀ⴀ㈀✀⤀笀ഀഀ
					error_message.html('<img src="'+_THEME_+'/images/warning.png" />密码错误！');਍ऀऀऀऀ紀攀氀猀攀 椀昀⠀琀砀琀 㴀㴀 ✀ⴀ㌀✀⤀笀ഀഀ
					error_message.html('<img src="'+_THEME_+'/images/warning.png" />验证码错误！');਍ऀऀऀऀ紀攀氀猀攀 椀昀⠀琀砀琀⤀笀ഀഀ
					window.location.href = txt;਍ऀऀऀऀ紀攀氀猀攀笀ഀഀ
					error_message.html('<img src="'+_THEME_+'/images/warning.png" />用户名或密码错误！');਍ऀऀऀऀ紀 ഀഀ
		    } ਍ऀऀ紀㬀ऀऀഀഀ
		_this.ajaxSubmit( options );਍ऀ    爀攀琀甀爀渀 昀愀氀猀攀㬀ഀഀ
	});਍ऀഀഀ
	var register_check = false;਍ऀ␀⠀✀⌀爀攀最椀猀琀攀爀开猀甀戀洀椀琀✀⤀⸀氀椀瘀攀⠀✀挀氀椀挀欀✀Ⰰ昀甀渀挀琀椀漀渀⠀⤀笀ഀഀ
		if(register_check) return false;਍ऀऀഀഀ
		var form = $("div.signs-register");਍ऀऀ瘀愀爀 渀愀洀攀 㴀 昀漀爀洀⸀昀椀渀搀⠀✀⌀渀愀洀攀✀⤀⸀瘀愀氀⠀⤀⸀琀爀椀洀⠀⤀㬀ഀഀ
		var email = form.find('#email').val().trim();਍ऀऀ瘀愀爀 瀀愀猀猀眀搀 㴀 昀漀爀洀⸀昀椀渀搀⠀✀⌀甀猀攀爀开瀀愀猀猀眀漀爀搀✀⤀⸀瘀愀氀⠀⤀⸀琀爀椀洀⠀⤀㬀ഀഀ
		var cellphone = form.find('#cellphone').val().trim();਍ऀऀ瘀愀爀 猀攀氀攀挀琀攀搀刀漀眀 㴀 ␀⠀琀栀椀猀⤀㬀ഀഀ
		var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;਍ऀऀ瘀愀爀 渀甀洀戀攀爀挀栀攀挀欀 㴀 ⼀嬀帀　ⴀ㤀崀⼀㬀 ⼀⼀ 愀氀氀漀眀 氀攀琀琀攀爀猀Ⰰ 渀甀洀戀攀爀猀ഀഀ
		$(".register-error").html('');਍ऀऀ椀昀⠀渀愀洀攀⸀氀攀渀最琀栀 㰀㴀　⤀笀ഀഀ
			$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />名字不能为空！');਍ऀऀ    爀攀琀甀爀渀 昀愀氀猀攀㬀ഀഀ
		}਍ऀऀ椀昀⠀攀洀愀椀氀⸀猀攀愀爀挀栀⠀攀洀愀椀氀刀攀最䔀砀⤀ 㴀㴀 ⴀ㄀⤀笀ഀഀ
			$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邮箱不合法！');਍ऀऀऀ爀攀琀甀爀渀 昀愀氀猀攀㬀ഀഀ
		}਍ऀऀ椀昀⠀瀀愀猀猀眀搀⸀氀攀渀最琀栀 㰀㘀 簀簀 瀀愀猀猀眀搀⸀氀攀渀最琀栀 㸀㄀㘀⤀笀ഀഀ
			$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />密码长度6-16位！');਍ऀऀऀ爀攀琀甀爀渀 昀愀氀猀攀㬀ഀഀ
		}਍ऀऀ椀昀⠀挀攀氀氀瀀栀漀渀攀⸀氀攀渀最琀栀 ℀㴀 ㄀㄀ 簀簀 攀洀愀椀氀⸀猀攀愀爀挀栀⠀渀甀洀戀攀爀挀栀攀挀欀⤀ 㴀㴀 ⴀ㄀⤀笀ഀഀ
			$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />手机号码不合法！');਍ऀऀऀ爀攀琀甀爀渀 昀愀氀猀攀㬀ഀഀ
		}਍ऀऀ瘀愀爀 瀀愀爀愀洀 㴀 笀紀㬀ഀഀ
		param['email']=email;਍ऀऀ瀀愀爀愀洀嬀✀渀愀洀攀✀崀㴀渀愀洀攀㬀ഀഀ
		param['password']=passwd;਍ऀऀ瀀愀爀愀洀嬀✀挀攀氀氀瀀栀漀渀攀✀崀㴀挀攀氀氀瀀栀漀渀攀㬀ഀഀ
		਍ऀऀ爀攀最椀猀琀攀爀开挀栀攀挀欀 㴀 琀爀甀攀㬀ഀഀ
		਍ऀऀ␀⸀瀀漀猀琀⠀唀⠀✀栀漀洀攀⼀倀甀戀氀椀挀⼀搀漀刀攀最椀猀琀攀爀✀⤀Ⰰ瀀愀爀愀洀Ⰰ昀甀渀挀琀椀漀渀⠀琀砀琀⤀笀ഀഀ
			register_check = false;਍ऀऀऀ椀昀 ⠀琀砀琀 㴀㴀 ㄀⤀ 笀ഀഀ
				window.location.href = U('home/User/index');਍ऀऀऀ紀 攀氀猀攀 椀昀 ⠀琀砀琀 㴀㴀 ⴀ㄀⤀ 笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邮箱不合法！');਍ऀऀऀ紀 攀氀猀攀 椀昀 ⠀琀砀琀 㴀㴀 ⴀ㈀⤀笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邮箱已被使用！');਍ऀऀऀ紀 攀氀猀攀 椀昀 ⠀琀砀琀 㴀㴀 ⴀ㌀⤀笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />密码长度6-16位！');਍ऀऀऀ紀 攀氀猀攀 椀昀 ⠀琀砀琀 㴀㴀 ⴀ㐀⤀笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />手机号码不合法！');਍ऀऀऀ紀 攀氀猀攀 椀昀 ⠀琀砀琀 㴀㴀 ⴀ㔀⤀笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />申请成功，等待审核中。请注意查看您的邮箱！');਍ऀऀऀ紀 攀氀猀攀 椀昀⠀琀砀琀⤀笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />'+txt+'！');	਍ऀऀऀ紀攀氀猀攀笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />注册失败，请稍后重试！');਍ऀऀऀ紀ഀഀ
		});਍ऀऀ爀攀琀甀爀渀 昀愀氀猀攀㬀ഀഀ
	});਍ऀഀഀ
	var register_invite_check = false;਍ऀ␀⠀✀⌀爀攀最椀猀琀攀爀开椀渀瘀椀琀攀开猀甀戀洀椀琀✀⤀⸀氀椀瘀攀⠀✀挀氀椀挀欀✀Ⰰ昀甀渀挀琀椀漀渀⠀⤀笀ഀഀ
		if(register_invite_check) return false;਍ऀऀഀഀ
		var form = $("div.signs-invite-register");਍ऀऀ瘀愀爀 渀愀洀攀 㴀 昀漀爀洀⸀昀椀渀搀⠀✀⌀渀愀洀攀✀⤀⸀瘀愀氀⠀⤀⸀琀爀椀洀⠀⤀㬀ഀഀ
		var email = form.find('#email').val().trim();਍ऀऀ瘀愀爀 瀀愀猀猀眀搀 㴀 昀漀爀洀⸀昀椀渀搀⠀✀⌀甀猀攀爀开瀀愀猀猀眀漀爀搀✀⤀⸀瘀愀氀⠀⤀⸀琀爀椀洀⠀⤀㬀ഀഀ
		var cellphone = form.find('#cellphone').val().trim();਍ऀऀ瘀愀爀 椀渀瘀椀琀攀挀漀搀攀 㴀 昀漀爀洀⸀昀椀渀搀⠀✀⌀椀渀瘀椀琀攀挀漀搀攀✀⤀⸀瘀愀氀⠀⤀⸀琀爀椀洀⠀⤀㬀ഀഀ
		var selectedRow = $(this);਍ऀऀ瘀愀爀 攀洀愀椀氀刀攀最䔀砀 㴀 ⼀帀嬀䄀ⴀ娀　ⴀ㤀⸀开─⬀ⴀ崀⬀䀀嬀䄀ⴀ娀　ⴀ㤀⸀ⴀ崀⬀尀⸀嬀䄀ⴀ娀崀笀㈀Ⰰ㐀紀␀⼀椀㬀ഀഀ
		var numbercheck = /[^0-9]/; // allow letters, numbers਍ऀऀ␀⠀∀⸀爀攀最椀猀琀攀爀ⴀ攀爀爀漀爀∀⤀⸀栀琀洀氀⠀✀✀⤀㬀ഀഀ
		if(name.length <=0){਍ऀऀऀ␀⠀∀⸀爀攀最椀猀琀攀爀ⴀ攀爀爀漀爀∀⤀⸀栀琀洀氀⠀✀㰀椀洀最 猀爀挀㴀∀✀⬀开吀䠀䔀䴀䔀开⬀✀⼀椀洀愀最攀猀⼀眀愀爀渀椀渀最⸀瀀渀最∀ ⼀㸀ഀ坔൛﵎㪀穎ź⟿⤀㬀ഀഀ
		    return false;਍ऀऀ紀ഀഀ
		if(email.search(emailRegEx) == -1){਍ऀऀऀ␀⠀∀⸀爀攀最椀猀琀攀爀ⴀ攀爀爀漀爀∀⤀⸀栀琀洀氀⠀✀㰀椀洀最 猀爀挀㴀∀✀⬀开吀䠀䔀䴀䔀开⬀✀⼀椀洀愀最攀猀⼀眀愀爀渀椀渀最⸀瀀渀最∀ ⼀㸀글놐ൻࡎ핔Ŭ⟿⤀㬀ഀഀ
			return false;਍ऀऀ紀ഀഀ
		if(passwd.length <6 || passwd.length >16){਍ऀऀऀ␀⠀∀⸀爀攀最椀猀琀攀爀ⴀ攀爀爀漀爀∀⤀⸀栀琀洀氀⠀✀㰀椀洀最 猀爀挀㴀∀✀⬀开吀䠀䔀䴀䔀开⬀✀⼀椀洀愀最攀猀⼀眀愀爀渀椀渀最⸀瀀渀最∀ ⼀㸀였ś罸ꚕ㙞ⴀ㄀㘀䴀ŏ⟿⤀㬀ഀഀ
			return false;਍ऀऀ紀ഀഀ
		if(cellphone.length != 11 || email.search(numbercheck) == -1){਍ऀऀऀ␀⠀∀⸀爀攀最椀猀琀攀爀ⴀ攀爀爀漀爀∀⤀⸀栀琀洀氀⠀✀㰀椀洀最 猀爀挀㴀∀✀⬀开吀䠀䔀䴀䔀开⬀✀⼀椀洀愀最攀猀⼀眀愀爀渀椀渀最⸀瀀渀最∀ ⼀㸀䬀㩢œ൸ࡎ핔Ŭ⟿⤀㬀ഀഀ
			return false;਍ऀऀ紀ഀഀ
		if(invitecode.length <= 0){਍ऀऀऀ␀⠀∀⸀爀攀最椀猀琀攀爀ⴀ攀爀爀漀爀∀⤀⸀栀琀洀氀⠀✀㰀椀洀最 猀爀挀㴀∀✀⬀开吀䠀䔀䴀䔀开⬀✀⼀椀洀愀最攀猀⼀眀愀爀渀椀渀最⸀瀀渀最∀ ⼀㸀耀Ƌ൸﵎㪀穎ź⟿⤀㬀ഀഀ
			return false;਍ऀऀ紀ഀഀ
		var param = {};਍ऀऀ瀀愀爀愀洀嬀✀攀洀愀椀氀✀崀㴀攀洀愀椀氀㬀ഀഀ
		param['name']=name;਍ऀऀ瀀愀爀愀洀嬀✀瀀愀猀猀眀漀爀搀✀崀㴀瀀愀猀猀眀搀㬀ഀഀ
		param['cellphone']=cellphone;਍ऀऀ瀀愀爀愀洀嬀✀椀渀瘀椀琀攀挀漀搀攀✀崀㴀椀渀瘀椀琀攀挀漀搀攀㬀ഀഀ
		਍ऀऀ爀攀最椀猀琀攀爀开椀渀瘀椀琀攀开挀栀攀挀欀 㴀 琀爀甀攀㬀ഀഀ
		਍ऀऀ␀⸀瀀漀猀琀⠀唀⠀✀栀漀洀攀⼀倀甀戀氀椀挀⼀搀漀刀攀最椀猀琀攀爀䤀渀瘀椀琀攀✀⤀Ⰰ瀀愀爀愀洀Ⰰ昀甀渀挀琀椀漀渀⠀琀砀琀⤀笀ഀഀ
			register_invite_check = false;਍ऀऀऀ椀昀 ⠀琀砀琀 㴀㴀 ㄀⤀ 笀ഀഀ
				window.location.href = U('home/User/index');਍ऀऀऀ紀 攀氀猀攀 椀昀 ⠀琀砀琀 㴀㴀 ⴀ㄀⤀ 笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邮箱不合法！');਍ऀऀऀ紀 攀氀猀攀 椀昀 ⠀琀砀琀 㴀㴀 ⴀ㈀⤀笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邮箱已被使用！');਍ऀऀऀ紀 攀氀猀攀 椀昀 ⠀琀砀琀 㴀㴀 ⴀ㌀⤀笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />密码长度6-16位！');਍ऀऀऀ紀 攀氀猀攀 椀昀 ⠀琀砀琀 㴀㴀 ⴀ㐀⤀笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />手机号码不合法！');਍ऀऀऀ紀 攀氀猀攀 椀昀 ⠀琀砀琀 㴀㴀 ⴀ㔀⤀笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />邀请码不正确！');਍ऀऀऀ紀 攀氀猀攀 椀昀⠀琀砀琀⤀笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />'+txt+'！');	਍ऀऀऀ紀攀氀猀攀笀ഀഀ
				$(".register-error").html('<img src="'+_THEME_+'/images/warning.png" />注册失败，请稍后重试！');਍ऀऀऀ紀ഀഀ
		});਍ऀऀ爀攀琀甀爀渀 昀愀氀猀攀㬀ഀഀ
	});਍紀⤀㬀�
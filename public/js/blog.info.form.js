var blog_info = function(){};
blog_info.prototype = {
	$input_tags:'',
	init:function()
	{
		this.$input_tags = $('input[name="title"]');
	},
	check_form:function(v_form)
	{
		if (getLength(v_form.title.value) == 0) {
			alert("博客标题不能为空");
			v_form.title.focus();
			return false;
		} else if (getLength(v_form.title.value) > 50) {
			alert("博客标题不能超过50个字");
			v_form.title.focus();
			return false;
		}
		/*else if (getLength(v_form.content.value) < 2) {
			alert("博客内容不能少于6个字");
			v_form.content.focus();
			return false;
		}*/
		
		 var options = {
			  success: function(txt) {
				  if(txt==-1){
					  alert("标题不能为空且不得超过50个字！");
				  }else if(txt==-2){
					  alert("内容不得少于6个字！");
				  }else if(txt){
					alert("操作成功！");
					window.location.href = txt;  
				  }else{
					alert("操作失败，请稍后重试！");  
				  }
			  }
		  };
		  $(v_form).ajaxSubmit( options );
		  
		  return false;
	},
};
blog_info = new blog_info();
blog_info.init();

function checkForm(o){
	var form = $(o);
	if(form.find("#title").val().trim()=='' || getLength(form.find("#title").val().trim())>50){
		alert("博客标题不能为空，且50字以内！");
		return false;
	}
	
	return true;
}
project_info = function(){};
project_info.prototype = {
	$input_tags:'',
	init:function()
	{
		this.$input_tags = $('input[name="title"]');
	},
	check_form:function(v_form)
	{
		if (getLength(v_form.title.value) == 0) {
			alert("名称不能为空");
			v_form.title.focus();
			return false;
		} else if (getLength(v_form.title.value) > 50) {
			alert("名称不能超过50个字");
			v_form.title.focus();
			return false;
		} else if (v_form.cate_id.value <= 0) {
			alert("请选择分类");
			v_form.cate_id.focus();
			return false;
		} else if (getLength(v_form.intro.value) < 10) {
			alert("简介不能少于10个汉字");
			v_form.intro.focus();
			return false;
		}
		var options = {
			success: function(txt) {
				if(txt==-1){
					alert("标题不能为空且不得超过50个字！");
				}else if(txt==-2){
					alert("请选择分类！");
				}else if(txt==-3){
					alert("简介不得少于10个字！");
				}else if(txt){
					alert("项目发布成功！");
					window.location.href = txt;
				}else{
				  alert("添加失败，请稍后重试！");  
				}
			}
		 };
		 $(v_form).ajaxSubmit( options );
		  
		 return false;
	},
	check_edit_form:function(v_form)
	{
		if (getLength(v_form.title.value) == 0) {
			alert("群组名称不能为空");
			v_form.title.focus();
			return false;
		} else if (getLength(v_form.title.value) > 50) {
			alert("群组名称不能超过50个字");
			v_form.title.focus();
			return false;
		} else if (v_form.cate_id.value <= 0) {
			alert("请选择分类");
			v_form.cate_id.focus();
			return false;
		} else if (getLength(v_form.intro.value) < 10) {
			alert("简介不能少于10个字");
			v_form.intro.focus();
			return false;
		}
		
		 var options = {
			  success: function(txt) {
				  if(txt==-2){
					  alert("标题不能为空且不得超过50个字！");
				  }else if(txt==-3){
					  alert("请选择分类！");
				  }else if(txt==-4){
					  alert("简介不得少于10个字！");
				  }else if(txt==-6){
					  alert("您没有该操作权限！");
				  }else if(txt){
					  alert("修改成功！");
					  window.location.href = txt;
				  }else{
					alert("修改失败，请稍后重试！");  
				  }
			  }
		  };
		  $(v_form).ajaxSubmit( options );
		  
		  return false;
	}
};
project_info = new project_info();
project_info.init();
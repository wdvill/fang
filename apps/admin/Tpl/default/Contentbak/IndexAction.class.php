<?php 
class IndexAction extends AdministratorAction {
    //后台框架页
    public function index() {
    	$this->assign('channel', $this->_getChannel());
    	$this->assign('menu',    $this->_getMenu());
        $this->display();
    }
    
    //后台首页
    public function main() {
    	echo '<h2>这里是后台首页</h2>';
    	$this->display();
    }
    
    protected function _getChannel() {
    	return array(
    		'index'			=>	'首页',
    		'global'		=>	'网站设置',
    		'content'		=>	'内容管理',
    		'user'			=>	'用户管理',
    	);
    }
    
    protected function _getMenu() {
    	$menu = array();
    	//注意顺序！！
    	
    	$apps_menu = array();
    	$apps_menu['微博'] = U('weibo/Admin/index');
    	
    	$apps = model('App')->getAdminApp('app_name,app_alias,admin_entry');
    	foreach ($apps as $v) {
    		$apps_menu[$v['app_alias']] = U($v['app_name'].'/'.$v['admin_entry']);
    	}
		
    	// 后台管理首页
    	$menu['index'] 		=   array(
    		'首页'			=>	array(
    			'信息统计'	=>	U('admin/Home/statistics'),
    			'评论管理'	=>	U('admin/Content/comment'),
    			'用户管理'	=>	U('admin/User/user'),
    			'微博管理'	=>	U('weibo/Admin/weibolist'),
				'资讯管理'	=>	U('admin/Content/info'),
    			'活动管理'	=>	U('event/Admin/eventlist'),
    			'群组管理'	=>	U('group/Admin/manage'),
    			'博客管理'	=>	U('admin/Content/blog'),
				'广告管理'	=>	U('admin/Content/ads'),
    			'缓存更新'	=>	SITE_URL . '/cleancache.php?all',
    		),
    	);
    	
    	//全局
    	$menu['global'] 	=   array(
    		'网站设置'		=>  array(
    			'全局配置'	=>	U('admin/Global/siteopt'),
    			//'注册配置'	=>	U('admin/Global/register'),
    			'邮件配置'	=>	U('admin/Global/email'),
    			'附件配置'	=>	U('admin/Global/attachConfig'),
    			'审核配置'	=>	U('admin/Global/audit'),
    			//'平台配置'	=>	U('admin/Global/platform'),
    		),
    	);
    	
    	//内容
    	$menu['content'] 	=   array(
    		'内容管理'		=>  array(
				'资讯管理'	=>	U('admin/Content/info'),
				'项目管理'	=>	U('admin/Content/project'),
				'问答管理'	=>	U('admin/Content/question'),
    			'博客管理'	=>	U('admin/Content/blog'),
				'广告管理'	=>	U('admin/Content/ads'),
    			'附件管理'	=>	U('admin/Content/attach'),
    			'评论管理'	=>	U('admin/Content/comment'),
    			'短消息管理'=>	U('admin/Content/message'),
    			'动态管理'	=>	U('admin/Content/feed'),
    			//'举报管理'	=>	U('admin/Content/denounce'),
    		),
    	);
    	
    	//用户
    	$menu['user']		=	array(
    		'用户'			=>	array(
    			'用户管理'	=>	U('admin/User/user'),
    			'用户组管理'	=>	U('admin/User/userGroup'),
    			//'消息群发'	=>	U('admin/User/message'),
    		),
    	);
  	
    	return $menu;
    }
}
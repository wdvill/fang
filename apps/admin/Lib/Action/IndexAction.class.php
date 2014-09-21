<?php 
class IndexAction extends AdministratorAction {
    //后台框架页
    private $isnews = 0;
    private $ismagazine = 0;
    private $isadminman = 0;
    private $issecondadmin = 0;
    private $isaudit = 0;
    
    public function index() {
    	$_SESSION['isadminman'] = 0;
    	$_SESSION['issecondadmin'] = 0;
    	$_SESSION['isaudit'] = 0;
    	$map = " uid=".$this->mid;
		$data = M('user_group_link')->where($map)->findAll();
		if ($data){
			foreach ($data as $v){
				$catearr[$v['uid'].','.$v['user_group_id']] = $v['user_gorup_link_id'];	
			}
		} else {
			echo "no result";
		}
    	//echo '  mid='.$this->mid.'<br/>';
    	//print_r($catearr);
    	if ((count($catearr) == 1) && array_key_exists($this->mid.",1",$catearr)){
    		$this->isadminman = 1;
			$_SESSION['isadminman'] = 1;
    	}
    	if ((count($catearr) == 1) && array_key_exists($this->mid.",12",$catearr)){
    		$this->issecondadmin = 1;
    		$_SESSION['issecondadmin'] = 1;
    	}
    	
    	if (array_key_exists($this->mid.",23",$catearr)){
    		$this->isnews = 1;
    	}
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
    	//$group_id = $_SESSION['group_uid'];
    	//print_r($group_id);    	
    	if ($this->isadminman){
    		return array(
	    		'index'			=>	'首页',
	    		'global'		=>	'网站设置',
	    		'content'		=>	'内容管理',
	    		'user'			=>	'用户管理',
    		);
    	} else if ($this->issecondadmin) {
    		return array(
    			'index'			=>	'首页',
    			'content'		=>	'内容管理',
    			'user'			=>	'用户管理',
    		);
    	} else if ($this->isnews==1){
    		return array(
	    		'index'			=>	'首页',
	    		'content'		=>	'内容管理',
    		);
    	} else {
    		//echo "isnews=".$this->isnews.",ismagazine=".$this->ismagazine.",isaudit=".$this->isaudit;
    		redirect( U('home/Public/adminlogin') );    //add by lzf 2013.3.8
    	}
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
    	if ($this->isadminman){
    	$menu['index'] 		=   array(
    		'首页'			=>	array(
    			'信息统计'	=>	U('admin/Home/statistics'),
    			//'反馈管理'	=>	U('admin/Content/suggestion'),
    			'用户管理'	=>	U('admin/User/user'),
				'一手房管理'	=>	U('admin/Content/info'),
    			'二手房管理'	=>	U('admin/Content/info', array('infotype'=>2)),
    			'图片专题管理'	=>	U('admin/Content/picture'),
    			'缓存更新'	=>	SITE_URL . '/cleancache.php?all',
    		),
    	);
    	} else if($this->issecondadmin) {
    		$menu['index'] 		=   array(
    				'首页'			=>	array(
    						'信息统计'	=>	U('admin/Home/statistics'),
    						//'反馈管理'	=>	U('admin/Content/suggestion'),
    						'一手房管理'	=>	U('admin/Content/info', array('infotype'=>1)),
    						'二手房管理'	=>	U('admin/Content/info', array('infotype'=>2)),
    						'出租房管理'	=>	U('admin/Content/info', array('infotype'=>3)),
    						'用户管理'	=>	U('admin/User/user'),
    				),
    		);
    	} else if ($this->isnews==1){
    	$menu['index'] 		=   array(
    		'首页'			=>	array(
    			'信息统计'	=>	U('admin/Home/statistics'),
				'一手房管理'	=>	U('admin/Content/info', array('infotype'=>1)),
    			//'二手房管理'	=>	U('admin/Content/info', array('infotype'=>2)),
    			//'出租房管理'	=>	U('admin/Content/info', array('infotype'=>3)),
    			'个人信息'	=>	U('admin/User/profile'),
    		),
    	);
    	} 
    	
    	//全局
    	if ($this->isadminman){
    	$menu['global'] 	=   array(
    		'网站设置'		=>  array(
    			'信息统计'	=>	U('admin/Home/statistics'),
    			'装修状况管理'	=>	U('admin/Global/decoration'),
    			'区域管理'	=>	'/index.php?app=admin&mod=Config&act=area#',
    			//'反馈管理'	=>	U('admin/Content/suggestion'),
    			'全局配置'	=>	U('admin/Global/siteopt'),
				//'帮助配置'	=>	U('admin/Global/document'),
				'操作日志'	=>	U('admin/Content/adminLog'),
    			//'缓存更新'	=>	SITE_URL . '/cleancache.php?all',
    		),
    	);
    	} 
    	
    	//内容
    	$menu['content'] 	=   array(
    		'内容管理'		=>  array(
				'一手房管理'	=>	U('admin/Content/info', array('infotype'=>1)),
    			'二手房管理'	=>	U('admin/Content/info', array('infotype'=>2)),
    			'出租房管理'	=>	U('admin/Content/info', array('infotype'=>3)),
    			'优惠申请管理'	=>	U('admin/Content/preferential'),
    			'用户挑错管理'	=>	U('admin/Content/faults'),
//     			'图片专题管理'	=>	U('admin/Content/picture'),
//     			'餐厅管理'	=>	U('admin/Content/restaurant'),
//     			'餐厅特色榜单'	=>	U('admin/Content/ptopic', array('type'=>7)),
//     			'玩乐场所管理'	=>	U('admin/Content/playplace'),
//     			'旅游专题管理'	=>	U('admin/Content/ptopic', array('type'=>8)),
    		),
    	);
    	
    	//用户
    	if ($this->isadminman){
    	$menu['user']		=	array(
    		'用户'			=>	array(
    			'用户管理'	=>	U('admin/User/user'),
    			'用户组管理'	=>	U('admin/User/userGroup'),
    		),
    	);
    	} elseif ( $this->issecondadmin) {
    		$menu['user']		=	array(
    				'用户'			=>	array(
    						'用户管理'	=>	U('admin/User/user'),
    				),
    		);
    	}

    	return $menu;
    }
}
<?php 
class SquareAction extends Action
{
	public function _initialize()
	{
		// 验证是否允许匿名访问微博广场
		if ($this->mid <= 0 && intval(model('Xdata')->get('siteopt:site_anonymous_square')) <= 0) {
			redirect(U('home'));
		}

		if (in_array(ACTION_NAME, array('index','hot_topics','star','app'))) {
			$this->assign('square_config', model('Xdata')->lget('square'));
			$this->assign('apps_list', model('App')->getAllApp('app_name,app_alias,status'));
		}
	}

    //广场 首页
    public function index(){
    	// 今日看点
    	$res = model('Xdata')->lget('weibo');
    	$data['aboutkey']        = $res['todaytopic'];
    	$data['aboutkey_id']	 = M('weibo_topic')->getField('topic_id',"name='{$data['aboutkey']}'");
    	$data['aboutkey_follow'] = getFollowState($this->mid,array('name'=>$data['aboutkey']),1);
    	
    	$user_model       = D('User', 'home');
    	$user_count_model = model('UserCount');
    	
    	// 今日看点相关的用户
    	$data['userlist'] = M('weibo')->where("transpond_id=0 AND isdel=0 AND content LIKE '%".$data['aboutkey']."%'")->limit(10)->order('ctime DESC')->findAll();
    	$uids = getSubByKey($data['userlist'], 'uid');
    	if (!in_array($this->mid, $uid))
    		$uid = array_merge($this->mid);
    	$user_model->setUserObjectCache($uids);
    	$user_count_model->setUserFollowingCount($uids);
    	$user_count_model->setUserFollowerCount($uids);
    	unset($uids);
		foreach ($data['userlist'] as $key => $value) {
			$data['userlist'][$key]['userinfo']  = $user_model->getUserByIdentifier($value['uid']);
			$data['userlist'][$key]['following'] = $user_count_model->getUserFollowingCount($value['uid']);
			$data['userlist'][$key]['follower']  = $user_count_model->getUserFollowerCount($value['uid']);
			//$data['userlist'][$key]['followState']  = getFollowState( $this->mid , $value['uid'] );
		}

		// 关注的话题
        $data['followTopic'] =  D('Follow','weibo')->getTopicList($this->mid);
        
		// 搜索热词
		if (count($data['hotTopic'])>3) {
			$data['hotkeys'] = $this->_getRandomSubArray($data['hotTopic'],3);
		}else {
			$data['hotkeys'] = $data['hotTopic'];
		}

		// 活跃用户
		global $ts;
		$huNumPerRow = $ts['site']['site_theme']=='weibo'?3:4;
		$hotUserNum  = $huNumPerRow*10;
    	$time_range = model('Xdata')->get('square:hotuser');
    	if(!is_numeric($time_range) || $time_range<1)$time_range = 1;
		$today       = mktime(0,0,0,date("m"),date("d"),date("Y"));
		$yesterday   = $today-$time_range*24*3600;
		$db_prefix  = C('DB_PREFIX');
    	$hotUser = M()->query("SELECT uid,count(weibo_id) as weibo_num FROM {$db_prefix}weibo where ctime>{$yesterday} AND ctime<{$today} AND isdel=0 GROUP BY uid ORDER BY weibo_num DESC LIMIT {$hotUserNum}");
    	if($hotUser){
	    	$data['hotUserSlide'] = count($hotUser)>$huNumPerRow?1:0;
	    	$uids = getSubByKey($hotUser, 'uid');
	    	$user_model->setUserObjectCache($uids);
	    	$user_count_model->setUserFollowerCount($uids);
	    	unset($uids);
	    	foreach ($hotUser as $key=>$value) {
	    		$hotUserRow = ceil(($key+1)/$huNumPerRow);
		    	$data['hotUser'][$hotUserRow][$key] = $user_model->getUserByIdentifier($value['uid']);
		    	$data['hotUser'][$hotUserRow][$key]['follower'] = $user_count_model->getUserFollowerCount($value['uid']);
	    	}
    	}else{
    		$data['hotUser'] = '';
    	}

    	//名人推荐：是否具有名人
    	$star = D('weibo_star')->find();
    	if ($star)
    		$data['star_list'] = 1;

		//粉丝与关注情况
		$data['followInfo'] = array(
			'following' => $user_count_model->getUserFollowingCount($this->mid),
			'follower'  => $user_count_model->getUserFollowerCount($this->mid)
		);

		// 粉丝榜
    	$data['topfollow'] = D('Follow', 'weibo')->getTopFollowerUser();
    	$uids = getSubByKey($data['topfollow'], 'uid');
    	$user_model->setUserObjectCache($uids);

    	$this->assign($data);
    	$this->setTitle('微博广场');
    	$this->display();
    }	

    //广场-名人推荐
    public function index_star() {
		$star_list = D('Star','weibo')->getAllStart();
    	if (count($star_list) > 6) {
			$star_list = $this->_getRandomSubArray($star_list,6);
		}
		
    	if ($star_list) {
    		/*
    		 * 缓存用户数据
    		 */
    		$uids = getSubByKey($star_list, 'uid');
			D('User', 'home')->setUserObjectCache($uids);
			
	    	$this->assign('star_list',$star_list);
	    	$this->display();
    	}
    }

    //广场-首页的微博列表
	public function index_weibo(){
		$data['type'] = $_GET['type']?$_GET['type']:'index';
		$map = '';
    	switch ($data['type']) {
    		case 'transpond':
    			$time_range = model('Xdata')->get('square:comment');
    			if(!is_numeric($time_range) || $time_range<1)$time_range = 7;
				$now        = time();
				$yesterday  = mktime(0,0,0,date("m"),date("d"),date("Y"))-$time_range*24*3600;
				$map = " ctime>{$yesterday} AND ctime<{$now} ";
    			$order = 'transpond DESC';
    			break;
    		case 'comment':
    			$time_range = model('Xdata')->get('square:comment');
    			if(!is_numeric($time_range) || $time_range<1)$time_range = 7;
				$now        = time();
				$yesterday  = mktime(0,0,0,date("m"),date("d"),date("Y"))-$time_range*24*3600;
				$map = " ctime>{$yesterday} AND ctime<{$now} ";
    			$order = 'comment DESC';
    			break;
    		default:
    			$order = 'weibo_id DESC';
    			break;
    	}
    	$data['list'] = D('Operate','weibo')->doSearchTopic($map,$order,$this->mid);

    	if($data['list']){
	    	$this->assign($data);
	    	$this->display();
    	}else{
    		echo -1;
    	}
	}

    public function hot_topics(){
    	//热门话题榜
        $data['hotTopic'] =  D('Topic','weibo')->getHot();
		//热门话题推荐
		$re_topic_num = 3;
		if(count($data['hotTopic'])>$re_topic_num){
			for($i=0;$i<$re_topic_num;$i++){
				$data['re_hot_topic'][$i] = $data['hotTopic'][$i];
			}
		}else{
			$data['re_hot_topic'] = $data['hotTopic'];
		}

		$uids = array();
		foreach($data['re_hot_topic'] as &$rh) {			
			$rh['data'] = D('Operate','weibo')->where("content LIKE '%".addslashes($rh['name'])."%' AND isdel=0")->order('weibo_id DESC')->limit(3)->findAll();
			$uids = array_merge($uids, getSubByKey($rh['data'], 'uid'));
			$rh['follow'] = getFollowState($this->mid,$rh,1);
			if(is_array($rh['data'])){
				$weibo_ids = getSubByKey($rh['data'], 'weibo_id');
				foreach($rh['data'] as &$v){
					$v['is_favorited'] = isfavorited($v['weibo_id'], $this->mid, $weibo_ids);
	    			$v = D('Operate','weibo')->getOne('',$v);
	    		}
			}
		}

		D('User','home')->setUserObjectCache($uids);

		$this->assign($data);
		$this->setTitle('热门话题');
    	$this->display();
    }

    public function star(){
		$starDao = D('Star','weibo');
		$data['group_list'] = $starDao->getAllGroupList();
		$data['user_list']  = $starDao->getStarsByGroup('');

		$this->assign($data);
		$this->setTitle('名人堂');
    	$this->display();
    }

    // 应用展示
    public function app()
    {
    	$app_show = t($_GET['app_show']);
    	if (!model('App')->isAppNameActive($app_show) || !model('Xdata')->get("square:{$app_show}")) {
    		$this->error('404');
    	}
		ob_start ();
		ob_implicit_flush ( 0 );
        $this->assign('app_show', $app_show);
		$this->assign(D(ucfirst($app_show) . 'Square', $app_show)->square());
		$this->display(SITE_PATH . '/apps/' . $app_show . '/Tpl/default/' . ucfirst($app_show) . 'Square/square.html');
		$content = ob_get_clean ();
		$this->assign('content', $content);
		$this->display();
    }

	/**
	 * 随机获取数组的单元
	 * 
	 * @param array $source_array 原数组
	 * @param int   $numOfRequst  要获取的单元数量
	 * @return array
	 */
	protected function _getRandomSubArray($source_array, $numOfRequst = 1) {
		$res		= array();
		$random_id	= array_rand($source_array, $numOfRequst);
		foreach($random_id as $v) {
			$res[]	= $source_array[$v];
		}
		return $res;
	}
}
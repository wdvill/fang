<?php
class UserAction extends Action {
	
	function _initialize() {
		//$data ['followTopic'] = D ( 'Follow', 'weibo' )->getTopicList ( $this->mid );
		//$this->assign ( $data );
	}
	
	//个人首页
	function index() {
		//获取当前登录用户基本信息
		$data['userinfo'] = getUserInfo($this->mid);
		//获取首页资讯分类
		$data['cate_name'] = D("Info")->getInfoCateListByCate();
		//获取首页资讯
		$data['info'] = D("Info")->getHomeInfoList(4);
		//获取首页广告
		$data['ads'] = D("Ads")->getHomeADList();
		//获取热门活动
		$data['hot_event'] = D("Apps")->getHotList();
		//获取热门群组
		$data['hot_group'] = D("Group","group")->getHotList(5);
		//获取我的群组
		$data['my_group'] = D("Group","group")->myjoingroup($this->mid,0,5);
		//获取当前在线用户
		$data['online'] = D("User")->getOnlineUser($this->mid);
		//获取最近加入的用户
		$data['recent_join'] = D("User")->getRecentJoinUser($this->mid);
		//获取用户动态
		$data['feed'] = X ('Feed')->getFeed($this->mid);
		//判断用户是否绑定
		$data['login_bind'] = D("User")->checkPlatformBind($this->mid);
		//print_r($data['feed']);
		$this->assign ( $data );
		//$this->setTitle ( '我的首页' );
		$this->display ();
	}
	
	//邀请
	function invite(){
		//获取我的邀请链接
		$data['invite_url'] = model("Invite")->getInviteUrl($this->mid);
		$this->assign($data);
		$this->display();
	}
	
	//意见与建议
	function suggest(){
		$this->display();
	}
	
	//添加意见与建议
	function dosuggest(){
		$title = t($_POST['title']);
		$content = t($_POST['content']);
		if(empty($title) || empty($content)){
			echo -1;
			exit;
		}
		
		$data['uid'] = $this->mid;
		$data['title'] = $title;
		$data['content'] = $content;
		$data['ctime'] = time();
		if(M('suggestion')->add($data)){
			echo 1;
		}
		exit;
	}
	
	//提到我的
	public function atme(){
		model ( 'UserCount' )->setZero ( $this->mid, 'atme' );
		$data ['list'] = D ( 'Operate', 'weibo' )->getAtme ( $this->mid );
		// 同步的设置
		$bind = M ( 'login' )->where ( 'uid=' . $this->mid )->findAll ();
		foreach ( $bind as $v ) {
			$data ['login_bind'] [$v ['type']] = $v ['is_sync'];
		}
		
		$this->assign ( $data );
		$this->setTitle ( '@我的微博' );
		$this->display ( 'index' );
	}
	
	//我的收藏
	function collection() {
		$data ['list'] = D ( 'Operate', 'weibo' )->getCollection ( $this->mid );
		
		// 同步的设置
		$bind = M ( 'login' )->where ( 'uid=' . $this->mid )->findAll ();
		foreach ( $bind as $v ) {
			$data ['login_bind'] [$v ['type']] = $v ['is_sync'];
		}
		
		$this->assign ( $data );
		$this->setTitle ( '我的收藏' );
		$this->display ( 'index' );
	}
	
	//评论列表
	function comments() {
		$data ['type'] = ($_GET ['type'] == 'send') ? 'send' : 'receive';
		$data ['from_app'] = ($_GET ['from_app'] == 'other') ? 'other' : 'weibo';
		
		// 优先展示微博，优先展示有未读from_app
		if (model ( 'UserCount' )->getUnreadCount ( $this->mid, 'comment' ) <= 0 && model ( 'GlobalComment' )->getUnreadCount ( $this->mid ) > 0)
			$data ['from_app'] = 'other';
		
		if ($data ['from_app'] == 'weibo') {
			$data ['type'] == 'receive' && model ( 'UserCount' )->setZero ( $this->mid, 'comment' );
			
			//$data['person'] = (in_array( $_GET['person'] , array('all','follow','other')) )?$_GET['person']:'all';
			$data ['person'] = 'all';
			$data ['list'] = D ( 'Comment', 'weibo' )->getCommentList ( $data ['type'], $data ['person'], $this->mid );
		} else {
			$dao = model ( 'GlobalComment' );
			$data ['type'] == 'receive' && $dao->setUnreadCountToZero ( $this->mid );
			
			$data ['person'] = 'all';
			$data ['list'] = $dao->getCommentList ( $data ['type'], $this->mid );
			
			/*
    		 * 缓存评论发表者, 被回复的用户, 
    		 */
			$ids = getSubBeKeyArray ( $data ['list'] ['data'], 'appuid,uid,to_uid' );
			D ( 'User', 'home' )->setUserObjectCache ( array_unique ( array_merge ( $ids ['appuid'], $ids ['uid'], $ids ['to_uid'] ) ) );
			
			foreach ( $data ['list'] ['data'] as $k => $v )
				$data ['list'] ['data'] [$k] ['data'] = unserialize ( $v ['data'] );
		}
		
		$this->assign ( 'userCount', X ( 'Notify' )->getCount ( $this->mid ) );
		
		$this->assign ( $data );
		$this->setTitle ( $data ['type'] == 'receive' ? '收到的评论' : '发出的评论' );
		$this->display ();
	}
	
	private function __getSearchKey() {
		$key = '';
		// 为使搜索条件在分页时也有效，将搜索条件记录到SESSION中
		if (isset ( $_REQUEST ['k'] ) && ! empty ( $_REQUEST ['k'] )) {
			if ($_GET ['k']) {
				$key = html_entity_decode ( urldecode ( $_GET ['k'] ), ENT_QUOTES );
			} elseif ($_POST ['k']) {
				$key = $_POST ['k'];
			}
			// 关键字不能超过30个字符
			if (mb_strlen ( $key, 'UTF8' ) > 30)
				$key = mb_substr ( $key, 0, 30, 'UTF8' );
			$_SESSION ['home_user_search_key'] = serialize ( $key );
		
		} else if (is_numeric ( $_GET [C ( 'VAR_PAGE' )] )) {
			$key = unserialize ( $_SESSION ['home_user_search_key'] );
		
		} else {
			//unset($_SESSION['home_user_search_key']);
		}
		
		return trim ( $key );
	}
	
	private function __checkSearchPopedom() {
		if ($this->mid <= 0 && intval ( model ( 'Xdata' )->get ( 'siteopt:site_anonymous_search' ) ) <= 0)
			redirect ( U ( 'home/index' ) );
	}

	// 专题页
	public function topics()
	{
		//$this->__checkSearchPopedom ();
		$data['search_key'] = $this->__getSearchKey ();
		// 专题信息
		if (false == $data['topics'] = D('Topics', 'weibo')->getTopics($data['search_key'], $_GET['id'], $_GET['domain'], 1)) {
			if (null == $data['search_key']) {
				handleErrorByJs("该话题不存在！");
			}
			$data['topics']['name'] = t($data['search_key']);
		}
		$data['search_key'] = $data['search_key'] ? $data['search_key'] : html_entity_decode($data['topics']['name'], ENT_QUOTES);
		$data['search_key_id'] = $data['topics']['topic_id'] ? $data['topics']['topic_id'] : D('Topic', 'weibo')->getTopicId($data['search_key']);

		$data['followState'] = D ('Follow', 'weibo')->getTopicState ($this->mid, $data['search_key']);
		// 其他关注该话题的人
		$data['other_following'] = D('Follow', 'weibo')->field('uid')
									->where("uid<>{$this->mid} AND fid={$data['search_key_id']} AND type=1")
									->limit(9)->findAll();
		// 微博列表
		$data['type'] = h ( $_GET ['type'] );
		$data['list'] = D ( 'Operate', 'weibo' )->doSearch ( "#{$data['topics']['name']}#", $data ['type'] );
		$data['list']['count'] = D ( 'Operate', 'weibo' )->where("content LIKE '%#{$data['topics']['name']}#%' AND isdel=0")->count();

		//$this->setTitle ( $data ['search_key'] . ' - 话题' );
		$data['search_key'] = h(t($data['search_key']));
		$this->assign ( $data );
		$this->display();
	}

	// 查找话题
	public function search() {
		$this->__checkSearchPopedom ();
		$data ['search_key'] = $this->__getSearchKey ();
		$data ['followState'] = D ( 'Follow', 'weibo' )->getTopicState ( $this->mid, $data ['search_key'] );
		$data ['type'] = t ( $_REQUEST ['type'] );
		$data ['list'] = D ( 'Operate', 'weibo' )->doSearch ( $data ['search_key'], $data ['type'] );
		$data ['followTopic'] = D ( 'Follow', 'weibo' )->getTopicList ( $this->mid );
		$data ['search_key_id'] = D ( 'Topic', 'weibo' )->getTopicId ( $data ['search_key'] );
		$data ['search_key'] = h ( t ( $data ['search_key'] ) );
		$this->assign ( $data );
		$this->setTitle ( '搜微博' );
		$this->display ();
	}
	
	//查找用户
	public function searchuser() {
		//$this->__checkSearchPopedom ();
		$data ['search_key'] = $this->__getSearchKey ();
		$data ['list'] = D ( 'Follow', 'weibo' )->doSearchUser ( $data ['search_key'] );
		$data ['followTopic'] = D ( 'Follow', 'weibo' )->getTopicList ( $this->mid );
		$data ['search_key'] = h ( t ( $data ['search_key'] ) );
		$this->assign ( $data );
		$this->setTitle ( '搜人' );
		$this->display ();
	}

	//查找我关注的
	public function searchTips()
	{
		$key = str_replace('_', '\_', h ( $_GET ['key'] ));
		$db_prefix  =  C('DB_PREFIX');
		//$list = M ( 'user' )->field('uname')->where ( "uname LIKE '%{$key}%'" )->order ( "LOCATE('{$key}', uname) ASC" )->limit ( 10 )->findAll();
		$list = M('')->field('u.*')->field('u.uname')
					 ->table("{$db_prefix}follow AS f LEFT JOIN {$db_prefix}user AS u ON f.uid={$this->mid} AND f.fid=u.uid")
					 ->where("u.uname LIKE '%{$key}%'")
					 ->order ( "LOCATE('{$key}', u.uname) ASC" )
					 ->limit ( 10 )->findAll();
		if ($list) {
			exit ( json_encode ( $list ) );
		} else {
			echo '';
		}
	}
	
	//查找Tag
	public function searchtag() {
		$this->__checkSearchPopedom ();
		$data ['search_key'] = $this->__getSearchKey ();
		$data ['list'] = D ( 'UserTag' )->doSearchTag ( $data ['search_key'] );
		$data ['followTopic'] = D ( 'Follow', 'weibo' )->getTopicList ( $this->mid );
		$data ['search_key'] = h ( t ( $data ['search_key'] ) );
		$this->assign ( $data );
		$this->setTitle ( '搜标签' );
		$this->display ();
	}

	function findfriend() {
		$type_array = array ('followers', 'hot', 'understanding', 'newjoin' );
		$data ['type'] = in_array ( $_GET ['type'], $type_array ) ? $_GET ['type'] : 'newjoin';
		$user_model = D ( 'User', 'home' );
		
		$db_prefix = C ( 'DB_PREFIX' );
		switch ($data ['type']) {
			case 'followers' :
				$data ['list'] = D ( 'Follow', 'weibo' )->getTopFollowerUser ();
				$uids = getSubByKey ( $data ['list'], 'uid' );
				
				$user_model = D ( 'User', 'home' );
				$user_count_model = model ( 'UserCount' );
				$user_model->setUserObjectCache ( $uids );
				$user_count_model->setUserFollowerCount ( $uids );
				foreach ( $data ['list'] as $key => $value ) {
					$data ['list'] [$key] = $user_model->getUserByIdentifier ( $value ['uid'] );
					$data ['list'] [$key] ['follower'] = $user_count_model->getUserFollowerCount ( $value ['uid'] );
				}
				break;
			
			case 'hot' :
				$data ['list'] = M ()->query ( "SELECT uid,count(weibo_id) as weibo_num FROM {$db_prefix}weibo GROUP BY uid ORDER by weibo_num DESC LIMIT 10" );
				$uids = getSubByKey ( $data ['list'], 'uid' );
				
				$user_model = D ( 'User', 'home' );
				$user_count_model = model ( 'UserCount' );
				$user_model->setUserObjectCache ( $uids );
				$user_count_model->setUserFollowerCount ( $uids );
				foreach ( $data ['list'] as $key => $value ) {
					$data ['list'] [$key] = $user_model->getUserByIdentifier ( $value ['uid'] );
					$data ['list'] [$key] ['follower'] = $user_count_model->getUserFollowerCount ( $value ['uid'] );
					$data ['list'] [$key] ['weibo_num'] = $value ['weibo_num'];
				}
				break;
			
			case 'understanding' :
				$data ['list'] = model ( 'Friend' )->getRelatedUser ( $this->mid, $max = 10 );
				$uids = getSubByKey ( $data ['list'], 'uid' );
				
				$user_model = D ( 'User', 'home' );
				$user_count_model = model ( 'UserCount' );
				$user_model->setUserObjectCache ( $uids );
				$user_count_model->setUserFollowerCount ( $uids );
				foreach ( $data ['list'] as $key => $value ) {
					$data ['list'] [$key] = $user_model->getUserByIdentifier ( $value ['uid'] );
					$data ['list'] [$key] ['follower'] = $user_count_model->getUserFollowerCount ( $value ['uid'] );
				}
				break;
			
			case 'newjoin' :
				$data ['list'] = M ( "user" )->where ( "is_active=1 AND is_init=1 AND (uid<{$this->mid} OR uid>{$this->mid})" )->order ( 'uid DESC' )->field ( '`uid`,`uname`,`domain`,`location`,`ctime`' )->limit ( 10 )->findAll ();
				D ( 'User', 'home' )->setUserObjectCache ( $data ['list'] );
				$dao = model ( 'UserCount' );
				$dao->setUserFollowerCount ( getSubByKey ( $data ['list'], 'uid' ) );
				foreach ( $data ['list'] as $key => $value )
					$data ['list'] [$key] ['follower'] = $dao->getUserFollowerCount ( $value ['uid'] );
				break;
		}
		
		// 粉丝榜
		$data ['topfollow'] = D ( 'Follow', 'weibo' )->getTopFollowerUser ();
		D ( 'User', 'home' )->setUserObjectCache ( getSubByKey ( $data ['topfollow'], 'uid' ) );
		
		$this->assign ( $data );
		$this->setTitle ( '找人' );
		$this->display ();
	}
	
	//表情
	function emotions() {
		exit ( json_encode ( model ( 'Expression' )->getAllExpression () ) );
	}
	
	//获取统计数据
	function countNew() {
		exit ( json_encode ( X ( 'Notify' )->getCount ( $this->mid ) ) );
	}
	
	// 删除动态
	public function doDeleteMini() {
		echo X ( 'Feed' )->deleteOneFeed ( $this->mid, intval ( $_POST ['id'] ) ) ? '1' : '0';
	}
	
	public function closeAnnouncement() {
		$announcement_ctime = model ( 'Xdata' )->getField ( 'mtime', '`list`="announcement"' );
		$announcement_ctime = strtotime ( $announcement_ctime );
		cookie ( "announcement_closed_{$this->mid}", $announcement_ctime );
	}
}
?>
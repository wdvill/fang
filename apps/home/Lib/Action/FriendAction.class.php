<?php
/*
人脉相关
*/
class FriendAction extends Action {
	private $require_authorization;
	private $friend;
	
	public function _initialize() {
		$this->require_authorization = false;
		$this->friend = model("Friend");
		
		//获取递出和收到的名片数量
		$inbox_count = $this->friend->getFriendRequestCount($this->mid,'inbox');
		$outbox_count = $this->friend->getFriendRequestCount($this->mid,'outbox');
		$this->assign('inbox_count',$inbox_count);
		$this->assign('outbox_count',$outbox_count);
		
	}
	
	public function index() {
		$user = D("User");
		//获取热门推荐用户
		$data['hot'] = $user->getRecommendUser($this->mid,2);
		//获取可能认识的人
		$data['related'] = $this->friend->getRelatedUser($this->mid,100);
		//获取最新加入的用户
		$data['recent'] = $user->getRecentJoinUser($this->mid,10);
		$this->assign($data);
		$this->display();
	}
	
	//录入名片
	public function record() {
		
		$this->assign($data);
		$this->display();
	}
	
	//保存名片信息并发送
	function saveRecord(){
		echo $this->friend->saveRecordCard($this->mid,$_POST);
	}
	
	//一度人脉
	public function connect(){
		$data['connect'] = $this->friend->getFriendList($this->mid);
		
		$this->assign($data);
		$this->display();
	}
	
	//更多人脉
	public function connect_more(){
		$data['connect_more'] = $this->friend->getRelatedFriend($this->mid);
		
		$this->assign($data);
		$this->display();
	}
	
	//人脉分类
	public function category(){
		$type = $_REQUEST['tp'];
		if($type=='create'){
			//获取用户全部好友
			$data['friend'] = $this->friend->getFriendList($this->mid,null,'','friend_id DESC',false);
			
			$this->assign('type',$type);
			$this->assign($data);
			$this->display('create');
		}elseif($type=='edit'){
			if(!is_numeric($_REQUEST['gp']) || !$data['group'] = $this->friend->getGroupInfo($_REQUEST['gp'],$this->mid)){
				handleErrorByJs("该分组不存在！",U('home/friend/category'));
			}
			//获取用户全部好友
			$data['friend'] = $this->friend->getFriendList($this->mid,null,'','friend_id DESC',false);
			
			$this->assign('type',$type);
			$this->assign($data);
			$this->display('create');
		}else{
			$data['group'] = $this->friend->getGroupList($this->mid);
			$data['group_count'] = count($data['group']);
			
			$this->assign($data);
			$this->display();
		}
	}
	
	//添加/编辑分类
	function saveCate(){
		echo $this->friend->saveFriendGroup($this->mid,$_POST);
	}
	
	//删除分类
	function deleteCate(){
		if($this->friend->deleteFriendGroup($this->mid,$_POST['id'])){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	//人脉分组信息
	function cateinfo(){
		if(!is_numeric($_REQUEST['gp']) || !$data['group'] = $this->friend->getGroupInfo($_REQUEST['gp'],$this->mid)){
			handleErrorByJs("该分组不存在！",U('home/friend/category'));
		}
		
		$this->assign($data);
		$this->display();
	}
	
	//我的粉丝
	public function fan() {
		$data['fan'] = D("Follow","weibo")->getList($this->mid,'follower');
		
		$this->assign($data);
		$this->display();
	}
	
	//收到的名片
	public function inbox() {
		$data['request'] = $this->friend->getFriendRequestList($this->mid);
		$this->assign($data);
		$this->display();
	}
	
	//递出的名片
	public function outbox() {
		$data['request'] = $this->friend->getFriendRequestList($this->mid,20,'outbox');
		$this->assign($data);
		$this->display();
	}
	
	//搜索人脉
	public function search() {
		$search_key = $this->_getSearchKey();
		if(!empty($search_key)){
			$map = "uname LIKE '%".$search_key."%' OR position LIKE '%".$search_key."%' OR company LIKE '%".$search_key."%'";
			$data['list'] = D("User")->getUserByMap($map,'uid,uname,position,company',20,'uid DESC');
		}
		$this->assign($data);
		$this->display();
	}
	
	//添加(发送好友请求)/删除好友
	function doFriend(){
		$type = $_POST['type']=='delete' ? 'delete':'add';
		$friend_uid = $_POST['fu'];
		
		if($type=='delete'){
			echo $this->friend->deleteFriend($this->mid,$friend_uid);
		}elseif($type=='add'){
			echo $this->friend->sendFriendRequest($this->mid,$friend_uid);
		}
	}
	
	//接收好友请求并添加好友
	function addFriend(){
		echo $this->friend->addFriend($_POST['id']);
	}
	
	//拒绝好友请求
	function refuseFriend(){
		echo $this->friend->refuseFriend($_POST['id']);
	}
	
	//快速邀请
	function doInvite(){
		echo model("Invite")->sendInviteEmail($this->mid,$_POST['email']);
	}
	
	public function selectFriendGroup() {
		$groups = $this->friend->getGroupList($this->mid);
		
		$this->assign('groups', $groups);
		$this->assign('fuid', intval($_GET['fuid']));
		$this->assign('require_authorization', $this->require_authorization ? 1 : 0);
		$this->display();
	}
	
	protected function _getSearchKey($key_name = 'k'){
		$key = '';
		// 为使搜索条件在分页时也有效，将搜索条件记录到SESSION中
		$request_key = trim($_REQUEST[$key_name]);
		if ( isset($request_key) && !empty($request_key) ) {
			if($_GET[$key_name]){
				$key = html_entity_decode( urldecode($_GET[$key_name]) ,ENT_QUOTES);
			}elseif($_POST[$key_name]){
				$key = $_POST[$key_name];
			}
			// 关键字不能超过30个字符
			if ( mb_strlen($key, 'UTF8') > 30 )
				$key = mb_substr($key, 0, 30, 'UTF8');
			$_SESSION['friend_search_' . $key_name] = serialize( $key );
		}else if ( is_numeric($_GET[C('VAR_PAGE')]) ) {
			$key = unserialize( $_SESSION['friend_search_' . $key_name] );
		}			
		$this->assign('search_key', h(t($key)));
		return trim($key);
	}
}
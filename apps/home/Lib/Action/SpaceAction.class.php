<?php
/**
 * 个人空间
 */ 
class SpaceAction extends Action{

	function _initialize(){
		if(!empty($_GET['uid'])){
			if( is_string($_GET['uid']) ){
				$domainuser = M('user')->where("domain='".h($_GET['uid'])."'")->find();
				if($domainuser){
					$this->uid = $domainuser['uid'];
				}
			}elseif(is_numeric($_GET['uid'])){
				$this->uid = intval($_GET['uid']);
			}else{
				$this->uid = $this->mid;
			}
	    }else{
			$this->uid = $this->mid;
		}
		
		$userinfo = getUserInfo(h($this->uid),'',$this->mid);
		if($userinfo) {
			$this->uid = $userinfo['uid'];
			$this->assign('uid',$this->uid);
			$this->assign('userinfo',$userinfo);
			
			$this->getSpaceCount($this->uid);
		}else{
			//$this->error('用户不存在');
			handleErrorByJs("该用户不存在！",U("home/index"));
		}
	}

	private function getSpaceCount($uid){
		$data['space_count']['weibo'] = model('UserCount')->getUserWeiboCount($uid);
		$data['space_count']['qa']    = model('UserCount')->getUserQaCount($uid);
		$data['space_count']['group'] = model('UserCount')->getUserGroupCount($uid);
		$data['space_count']['event'] = model('UserCount')->getUserEventCount($uid);
		$data['space_count']['blog']  = model('UserCount')->getUserBlogCount($uid);
		$data['is_friend'] = model('Friend')->isFriend($this->mid,$uid);
		$this->assign($data);
	}

    //用户个人主页（包括基本信息和详细资料预览）
    public function index(){
		//个人简介
		$pUserProfile = D('UserProfile');
    	$pUserProfile->uid = $this->uid;
		$intro = $pUserProfile->getUserProfileByModule('intro');
		$data['intro'] = $intro[0]['data'];
		//获取用户工作经历
		$data['work'] = $pUserProfile->getUserProfileByModule('work');
		//获取用户教育经历
		$data['edu'] = $pUserProfile->getUserProfileByModule('edu');
		//用户相关群组
		$data['group'] = D("Apps")->getUserGroup($this->uid);

		if($this->mid > 0 && $this->uid != $this->mid){
	        // 记录访问时间
	        M('user_visited')->setField('ctime', time(), "uid={$this->mid} AND fid={$this->uid}")
	        || M('user_visited')->add(array('uid'=>$this->mid, 'fid'=>$this->uid, 'ctime'=>time()));
			// 空间被访问积分
			//X('Credit')->setUserCredit($this->uid,'space_visited');
		}
		
        $this->assign($data);
    	$this->display();
    }
	
    //微博
    function weibo(){
    	$data ['list'] = D('Operate','weibo')->getSpaceList($this->uid);
		
	    $this->setTitle(getUserName($this->uid).'的微博');
		$this->assign($data);
    	$this->display();
    }
	
	//问答
	function qa(){
		//获取问答列表
		$data['list'] = D("Question")->getQuestionListByUid($this->uid);
		//print_r($data['list']);
		$this->assign($data);
		$this->display();
	}
	
	//群组
	function group(){
		$data['group'] = D("Apps")->getUserGroup($this->uid,10,true);
		$this->assign($data);
		$this->display();
	}
	
	//博客
	function blog(){
		$data3 = M('blog_category')->order('`id` ASC')->findAll();  
		foreach ($data3 as $v){
			$catearr[$v['id']] = $v['name'];	
		}
		$this->assign('blog_category', $catearr);
		$data['blog'] = M("blog")->where(array('uid'=>$this->uid))->order('`id` DESC')->findPage(20);
		//print_r($data['blog']);
		$this->assign($data);
		$this->display();
	}
	
	//活动
	function event(){
		//与我相关的活动
		$map_event = "uid={$this->uid} AND (action='joinIn' OR action='admin') AND status=1";
		$eventIds  = M("event_user")->field('eventId')->where($map_event)->findAll();
		foreach($eventIds as $v){
			$in_arr[] = $v['eventId'];
		}
		$map['id'] = array('in',$in_arr);
		$data['event'] = D("Apps")->getEventList($this->uid,$map,$limit);
		
		$this->assign($data);
		$this->display();
	}
	
    //关注
    function follow(){
    	$data['type'] = 'following';
    	
		if($data['type'] == 'following'){
    		//关注分组列表
	    	$data['gid']  = is_numeric($_GET['gid'])?$_GET['gid']:'all';
	    	$group_list = D('FollowGroup','weibo')->getGroupList($this->uid);
	    	//调整分组列表
	    	if(!empty($group_list)){
		    	$group_count = count($group_list);
		    	for($i=0;$i<$group_count;$i++){
		    		if($group_list[$i]['follow_group_id'] != $data['gid']){
		    			$group_list[$i]['title'] = (strlen($group_list[$i]['title'])+mb_strlen($group_list[$i]['title'],'UTF8'))/2>8?getShort($group_list[$i]['title'],3).'...':$group_list[$i]['title'];
		    		}
		    		if($i<2){
		    			$data['group_list_1'][] = $group_list[$i];
		    		}else{
		    			if($group_list[$i]['follow_group_id'] == $data['gid']){
		    				$data['group_list_1'][2]  = $group_list[$i];
		    				continue;
		    			}
		    			$data['group_list_2'][] = $group_list[$i];
		    		}
		    	}
		    	if(empty($data['group_list_1'][2]) && !empty($data['group_list_2'][0])){
		    		$data['group_list_1'][2] = $data['group_list_2'][0];
		    		unset($data['group_list_2'][0]);
		    	}
	    	}
    	}
		
    	//关注列表
    	$data['list'] = D('Follow','weibo')->getList($this->uid,$data['type'],0,$data['gid']);
		
    	$this->assign($data);
    	$this->setTitle(getUserName($this->uid).'的关注');
    	$this->display();
    }
	
	//粉丝
	function fan(){
		$data['type'] = 'follower';

    	//粉丝列表
    	$data['list'] = D('Follow','weibo')->getList($this->uid,$data['type']);
		
    	$this->assign($data);
    	$this->setTitle(getUserName($this->uid).'的粉丝');
    	$this->display();
	}
	
	//添加/取消关注
	function doFollow(){
		$type = $_POST['type']=='unfollow' ? 'unfollow':'follow';
		$fid = $_POST['fd'];
		
		if($type=='unfollow'){
			echo D("Follow","weibo")->unfollow($this->mid,$fid);
		}elseif($type=='follow'){
			echo D("Follow","weibo")->dofollow($this->mid,$fid);
		}
	}
	
	//添加/删除好友
	function doFriend(){
		$type = $_POST['type']=='delete' ? 'delete':'add';
		$friend_uid = $_POST['fu'];
		
		if($type=='delete'){
			echo model('Friend')->deleteFriend($this->mid,$friend_uid);
		}elseif($type=='add'){
			echo model('Friend')->sendFriendRequest($this->mid,$friend_uid);
		}
	}
	
	//接收好友请求并添加好友
	function addFriend(){
		$friend_uid = $_POST['fu'];
		$res = M("friend")->where("uid={$friend_uid} AND friend_uid={$this->mid}")->field("friend_id")->find();
		echo model('Friend')->addFriend($res['friend_id']);
	}
}
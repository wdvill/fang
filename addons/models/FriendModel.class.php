<?php
/**
 * 好友模型
 * 
 */
class FriendModel extends Model {
	protected $tableName = 'friend';
	protected $default_group_name = '未分组';

	/**
	 * 查询好友表
	 * 
	 * @param array|string $map   查询条件
	 * @param string       $field 默认*
	 * @param int          $limit 默认空
	 * @param string       $order 默认空
	 * @param boolean      $is_find_page 是否分页,默认true
	 * @return array
	 */
	public function getFriedByMap($map,$field='*',$limit=20,$order='friend_id DESC',$is_find_page=false){
		if ($is_find_page){
			return $this->where($map)->field($field)->order($order)->findPage($limit);
		}else {
			return $this->where($map)->field($field)->order($order)->limit($limit)->findAll();
		}
	}

	/**
	 * 获取好友列表
	 * 
	 * @param int $uid 				用户ID
	 * @param int $friend_group_id  好友分组ID 默认null则不分组查找
	 * @param int $limit 			默认20
	 * @param string $order 		默认 以好友名字升序，好友ID升序
	 * @return array
	 */
	public function getFriendList($uid, $friend_group_id = null, $limit = 20, $order = 'friend_id DESC',$is_page = true) {
		if ( !isset($friend_group_id) ) {
			if($is_page){
				$res = $this->where("(`uid`={$uid} OR `friend_uid`={$uid}) AND `status`=1")->order($order)->findPage($limit);
			}else{
				$res['data'] = $this->where("(`uid`={$uid} OR `friend_uid`={$uid}) AND `status`=1")->order($order)->limit($limit)->findAll();
			}
			
			foreach($res['data'] as $k=>$v){
				if($v['uid']!=$uid){
					$v['friend_uid'] = $v['uid'];
				}
				$fids[] = $v['friend_uid'];
			}
			
			$user = M("user")->where("uid IN (".implode(',',$fids).")")->field("uid,uname,company,position")->findAll();
			$res['data'] = $user;
			return $res;
		}else{
			return M('friend_group_link')->where("`uid`=$uid AND `friend_group_id`=$friend_group_id AND `status`=1")
										 ->order($order)
										 ->findPage($limit);
		}
	}
	
	//更多人脉（好友的好友）
	function getRelatedFriend($uid,$limit=20,$order='friend_id DESC'){
		//获取好友id
		$res = $this->where("(`uid`={$uid} OR `friend_uid`={$uid}) AND `status`=1")->field("uid,friend_uid")->order("friend_uid DESC")->findAll();
		foreach($res as $k=>$v){
			if($v['friend_uid']!=$uid){
				$v['uid'] = $v['friend_uid'];
			}
			$friend_uids[] = $v['uid'];
		}
		unset($res);
		//获取好友的好友列表
		$fids = implode(',',$friend_uids);
		$res = $this->where("(uid IN (".$fids.") AND friend_uid NOT IN (".$fids.") AND friend_uid != {$uid}) AND `status`=1")->order($order)->field("friend_uid")->findPage($limit);
			foreach($res['data'] as $k=>$v){
				$uids[] = $v['friend_uid'];
			}
			
			$user = M("user")->where("uid IN (".implode(',',$uids).")")->field("uid,uname,company,position")->findAll();
			$res['data'] = $user;
			return $res;
	}
	
	//好友请求列表
	function getFriendRequestList($uid,$limit=20,$type='inbox'){
		$type = $type ? $type:'inbox';
		if($type=='inbox'){
			$res = $this->where("friend_uid={$uid} AND status=0")->field("uid,friend_id")->order("friend_id DESC")->findPage($limit);
			foreach($res['data'] as $k=>$v){
				$v['user'] = getUserBaseInfo($v['uid']);
				$res['data'][$k] = $v;
			}
		}else{
			$res = $this->where("uid={$uid} AND status=0")->field("friend_uid,friend_id")->order("friend_id DESC")->findPage($limit);
			foreach($res['data'] as $k=>$v){
				$v['uid'] = $v['friend_uid'];
				$v['user'] = getUserBaseInfo($v['friend_uid']);
				$res['data'][$k] = $v;
			}
		}
		
		return $res;
	}
	
	//获取好友请求数量（递出的名片和收到的名片）
	function getFriendRequestCount($uid,$type='inbox'){
		if($type=='inbox'){
			return $this->where("friend_uid={$uid} AND status=0")->count();
		}
		if($type=='outbox'){
			return $this->where("uid={$uid} AND status=0")->count();
		}
	}
	
	//发送添加好友请求
	function sendFriendRequest($mid,$uid){
		if(!$uid || !$mid || ($uid==$mid)) return ;
		
		if($this->where("uid={$mid} AND friend_uid={$uid}")->count()){
			return '01';
		}elseif($this->where("friend_uid={$mid} AND uid={$uid} AND status=0")->count()){
			if($this->setField("status",1,"friend_uid={$mid} AND uid={$uid}")){
				return '02';
			}
		}
		$data['friend_uid'] = $uid;
		$data['uid'] = $mid;
		$data['status'] = 0;
		$data['ctime'] = time();
		
		if($friend_id = $this->add($data)){
			//添加请求记录到信箱
			/*$mess_data['to'] = $uid;
			$mess_data['is_lastest'] = 1;
			$mess_data['type'] = 'friend';
			model("Message")->postMessage($mess_data,$mid);*/
			//设置自动关注
			D("Follow","weibo")->dofollow($mid,$uid);
			return $friend_id;
		}
	}
	
	//添加好友(接受好友请求)
	function addFriend($friend_ids){
		if(!$friend_ids) return ;
		
		$friend_ids = is_array($friend_ids) ? implode(',',$friend_ids):$friend_ids;
		
		$data['status'] = 1;
		$data['ctime'] = time();
		
		if($this->where("friend_id IN (".$friend_ids.")")->save($data)){
			//设置自动关注
			$res = M('friend')->where("friend_id IN (".$friend_ids.") AND status=1")->field('uid,friend_uid')->findAll();
			foreach($res as $k=>$v){
				D("Follow","weibo")->dofollow($v['friend_uid'],$v['uid']);
				//添加动态
				X('Feed')->put('friend_add', array('friend_id'=>$v['friend_uid']), $v['uid']);
			}
			return 1;
		}
	}
	
	//直接将用户加为好友
	function addUserFriend($uid,$friend_uid){
		$res = $this->where("(uid={$uid} AND friend_uid={$friend_uid}) OR (friend_uid={$uid} AND uid={$friend_uid})")->find();
		if($res){
			if($res['status']==1){
				return true;
			}else{
				return $this->serField("status",1,"friend_id=".$res['friend_id']);
			}
		}else{
			$data['uid'] = $uid;
			$data['friend_uid'] = $friend_uid;
			$data['status'] = 1;
			$data['ctime'] = time();
			return $this->add($data);
		}
	}
	
	//拒绝好友(拒绝好友请求)
	function refuseFriend($friend_ids){
		if(!$friend_ids) return ;
		
		$friend_ids = is_array($friend_ids) ? implode(',',$friend_ids):$friend_ids;
		
		if($this->where("friend_id IN (".$friend_ids.")")->delete()){
			return 1;
		}
	}
	
	//删除好友
	function deleteFriend($mid,$uid){
		if(!$uid || !$mid || ($uid==$mid)) return ;
		
		return $this->where("(uid={$uid} AND friend_uid={$mid}) OR (uid={$mid} AND friend_uid={$uid})")->delete();
	}
	
	//判断双方好友状态(1:互为好友,2:mid已发送好友请求,3:uid已发送好友请求,0:双方不是好友，并且尚无好友请求)
	function isFriend($mid,$uid){
		if($uid==$mid) return 1;
		$res = $this->where("(uid={$uid} AND friend_uid={$mid}) OR (uid={$mid} AND friend_uid={$uid})")->find();
		if($res['status']==1){
			return 1;
		}elseif($res['uid']==$mid){
			return 2;
		}elseif($res['uid']==$uid){
			return 3;
		}else{
			return 0;
		}
	}
	
	//判断是否互为好友
	public function isFriends($uid, $friend_uid) {
		return $this->where("`uid`=$uid AND `friend_uid`=$friend_uid AND `status`=1")->find();
	}
	
	/**
	 * 获取给定用户的所有好友分组
	 * 
	 * @param int     $uid
	 * @param boolean $show_count 统计好友数量
	 * @return array
	 */
	public function getGroupList($uid, $show_count = true) {
		$res = M('friend_group')->where("uid=".$uid)->order('friend_group_id DESC')->findAll();
		
		if ($show_count && $res) {
			$group_count = count($res);
			
			$sql = 'SELECT count(friend_uid) AS count, friend_group_id FROM ' . C('DB_PREFIX') . 'friend_group_link 
					WHERE `uid` = ' . $uid . ' AND `status` = 1 GROUP BY friend_group_id';
			$tmp = $this->query($sql);
			//格式化统计数据
			foreach ($tmp as $v) {
				$count[$v['friend_group_id']] = $v['count'];
			}
			
			foreach ($res as $k => $v){
				$res[$k]['count'] = intval($count[$v['friend_group_id']]);
			}
			//未分组的
			/*if ($count[0] > 0 ) {
				$res[] = array('friend_group_id'=>0,'title'=>$this->default_group_name,'count'=>$count[0]);
			}*/
		}
		
		return $res;
	}
	
	//获取好友分组信息
	function getGroupInfo($group_id,$uid){
		$res = M('friend_group')->where("friend_group_id={$group_id} AND uid=".$uid)->find();
		if(!$res) return;
		
		//获取该分组的好友信息
		$friend = M("friend_group_link")->where("friend_group_id={$group_id} AND uid={$uid} AND status=1")->field("friend_uid")->findAll();
		$res['friend'] = getSubByKey($friend,'friend_uid');
		$res['count'] = count($res['friend']);
		
		return $res;
	}
	
	//保存好友分组信息
	function saveFriendGroup($uid,$data){
		if(!$uid || !trim($data['title']) || !$data['ids']) return ;
		//编辑
		if($data['group_id']){
			$res = M("friend_group")->where("uid={$uid} AND friend_group_id=".$data['group_id'])->find();
			if($res['title'] != trim($data['title'])){
				if(!M("friend_group")->setField("title",trim($data['title']),"friend_group_id=".$data['group_id'])) 
					return ;
			}
			//获取该分组的好友信息
			$friend = M("friend_group_link")->where("friend_group_id=".$data['group_id']." AND uid={$uid} AND status=1")->field("friend_uid")->findAll();
			$old_friend = getSubByKey($friend,'friend_uid');
		//添加
		}else{
			$res = M("friend_group")->where("uid={$uid} AND title='".trim($data['title'])."'")->find();
			if(!$res){
				$add_data['uid'] = $uid;
				$add_data['title'] = trim($data['title']);
				$group_id = M("friend_group")->add($add_data);
				if($group_id){
					$data['group_id'] = $group_id;
				}else{
					return ;
				}
			}else{
				$data['group_id'] = $res['friend_group_id'];
			}
		}
		
		//将用户添加至分组中
		$friend_ids = is_array($data['ids']) ? $data['ids']:explode(',',$data['ids']);
		if($old_friend){
			$save_friend = array_diff($friend_ids,$old_friend);
			$delete_friend = array_diff($old_friend,$friend_ids);
			//删除旧的
			M("friend_group_link")->where("uid={$uid} AND friend_group_id=".$data['group_id']." AND friend_uid IN (".implode(',',$delete_friend).")")->delete();
		}else{
			$save_friend = $friend_ids;
		}
		//保存新的
		$fdata['uid'] = $uid;
		$fdata['friend_group_id'] = $data['group_id'];
		foreach($save_friend as $v){
			$fdata['friend_uid'] = $v;
			M("friend_group_link")->add($fdata);
		}
		
		return $data['group_id'];
	}
	
	//删除好友分组
	function deleteFriendGroup($uid,$group_id){
		if(!$uid || !$group_id) return ;
		$map['uid'] = $uid;
		$map['friend_group_id'] = $group_id;
		return M("friend_group")->where($map)->delete() && M("friend_group_link")->where($map)->delete();
	}
	
	/**
	 * 获取给定用户的给定好友所在的分组
	 * 
	 * @param int $uid
	 * @param int $friend_uid
	 * @return array
	 */
	public function getGroupOfFriend($uid, $friend_uid) {
		$friend_uid = !is_array($friend_uid) ? $friend_uid : implode(',', $friend_uid);
		$db_prefix	= C('DB_PREFIX');
		$field 		= "l.friend_uid AS friend_uid, g.friend_group_id AS friend_group_id, g.title AS title";
		$join 		= "INNER JOIN {$db_prefix}friend_group_link AS l ON g.friend_group_id = l.friend_group_id";
		$where 		= "l.uid = $uid AND l.friend_uid IN ( $friend_uid ) AND l.status = 1";
		$res = $this->table("{$db_prefix}friend_group AS g")->field($field)->join($join)->where($where)->findAll();
		
		//格式化输出
		foreach ($res as $v) {
			$group[$v['friend_uid']][] = $v;
		}
		return $group;
	}

	/**
	 * 可能认识的人 (可能认识的人 = 有相同tag的用户 || 所在城市相同的用户 || 好友的好友 || 我的粉丝 || 随机推荐)
	 * 
	 * 注意: 因为头像信息未保存数据库, 所以当开启"隐藏无头像的用户"时, 结果集数量可能小于$max
	 * 
	 * @param int 	  $uid 		  用户ID
	 * @param int 	  $max 		  获取的最大人数
	 * @param boolean $do_shuffle 是否随机次序 (默认:true)
	 * @return boolean|array 用户ID的数组
	 */
	public function getRelatedUser($uid, $max = 100, $do_shuffle = true)
	{
		if (($uid = intval($uid)) <= 0)
			return false;
		
		// 权重设置
		$config = model('Xdata')->lget('related_user');
		$tag_weight      = isset($config['tag_weight'])      ? intval($config['tag_weight'])      : 4; // 拥有相同Tag
    	$city_weight     = isset($config['city_weight'])     ? intval($config['city_weight'])     : 3; // 设置的城市相同
    	$friend_weight   = isset($config['friend_weight'])   ? intval($config['friend_weight'])   : 2; // 好友的好友
    	$follower_weight = isset($config['follower_weight']) ? intval($config['follower_weight']) : 1; // 我的粉丝
		$total_weight    = $tag_weight + $city_weight + $friend_weight + $follower_weight;
		
		// 是否隐藏无头像的用户
		$hide_no_avatar  = $config['hide_no_avatar'];
		
		// 权重对应的数量
		$tag_count 		 = intval($tag_weight      / $total_weight * $max);
		$city_count 	 = intval($city_weight     / $total_weight * $max);
		$friend_count    = intval($friend_weight   / $total_weight * $max);
		$follower_count  = intval($follower_weight / $total_weight * $max);
		
		$related_uids = array();
		
		// 按Tag
		if ($tag_count > 0) {
			$tag_uids      = $this->_getRelatedUserFromTag($uid, $related_uids, $tag_count);
			$related_uids  = array_merge($related_uids, $tag_uids);
		}
		
		// 按设置的城市
		if ($city_count > 0) {
			$limit         = $city_count + ($tag_count - count($related_uids));
			$city_uids     = $this->_getRelatedUserFromCity($uid, $related_uids, $limit);
			$related_uids  = array_merge($related_uids, $city_uids);
		}
		
		// 按好友的好友
		if ($friend_count > 0) {
			$limit 		   = $friend_count + ($tag_count + $city_count - count($related_uids));
			$friend_uids   = $this->_getRelatedUserFromFriend($uid, $related_uids, $limit);
			$related_uids  = array_merge($related_uids, $friend_uids);
		}
		
		// 按粉丝
		if ($follower_count > 0) {
			$limit 		   = $follower_count + ($tag_count + $city_count + $friend_count - count($related_uids));
			$follower_uids = $this->_getRelatedUserFromFollower($uid, $related_uids, $limit);
			$related_uids  = array_merge($related_uids, $follower_uids);
		}
		
		// 随机推荐
		$limit         = $max - count($related_uids);
		$random_uids   = $this->_getRandomRelatedUser($uid, $related_uids, $limit);
		$related_uids  = array_merge($related_uids, $random_uids);
		
		// 按"好友的好友"推荐时, 可能会产生重复用户
		//$related_uids  = array_unique($related_uids);
		
		// 添加推荐原因
		/*foreach ($related_uids as $k => $v) {
			if ($hide_no_avatar && !hasUserFace($v)) {
				unset($related_uids[$k]);
				continue ;
			}
			
			if (in_array($v, $tag_uids))
				$related_uids[$k] = array('uid' => $v, 'reason' => 'Tag相同');
			else if (in_array($v, $city_uids))
				$related_uids[$k] = array('uid' => $v, 'reason' => '城市相同');
			else if (in_array($v, $friend_uids))
				$related_uids[$k] = array('uid' => $v, 'reason' => '好友的好友');
			else if (in_array($v, $follower_uids))
				$related_uids[$k] = array('uid' => $v, 'reason' => '您的粉丝');
			else if (in_array($v, $random_uids))
				$related_uids[$k] = array('uid' => $v, 'reason' => '随机推荐');
		}*/
		
		if ($do_shuffle)
			shuffle($related_uids);
		
		return $related_uids;
	}
	
	/**
	 * 根据Tag推荐用户
	 * 
	 * @param int   $uid		  当前用户ID
	 * @param array $related_uids 已推荐用户的uid数组
	 * @param int   $limit        推荐的人数
	 * @return array 被推荐用户的uid数组
	 */
	protected function _getRelatedUserFromTag($uid, $related_uids, $limit = 20)
	{
		if ($limit <= 0)
			return array();
			
		$model    = D('UserTag', 'home');
		$tag_list = $model->getUserTagList($uid);
		$tag_ids  = getSubByKey($tag_list, 'tag_id');
		$tag_ids  = implode(',', $tag_ids);
		$now_uids = implode(',', array_merge($related_uids, array($uid)));
		$now_following = D('Follow' ,'weibo')->getNowFollowingSql($uid);
		$sql = "SELECT `a.uid` AS `uid` FROM {$this->tablePrefix}user_tag AS a LEFT JOIN {$this->tablePrefix}user AS b WHERE `a.uid` NOT IN ( {$now_following} )  AND `a.uid` NOT IN ( {$now_uids} ) AND `a.tag_id` IN ( {$tag_ids} ) AND b.is_avatar=1 LIMIT {$limit}";
		
		if ($res = $model->query($sql))
			return getSubByKey($res, 'uid');
		else
			return array();
	}
	
	/**
	 * 根据用户设置的城市推荐用户. 如果当前用户没有设置城市, 则返回空数组
	 * 
	 * @param int   $uid		  当前用户ID
	 * @param array $related_uids 已推荐用户的uid数组
	 * @param int   $limit        推荐的人数
	 * @return array 被推荐用户的uid数组
	 */
	protected function _getRelatedUserFromCity($uid, $related_uids, $limit = 20)
	{
		if ($limit <= 0)
			return array();
			
		$model = D('User', 'home');
		$user  = $model->getUserByIdentifier($uid, 'uid');
		if (empty($user['location']))
			return array();
		
		$now_following = D('Follow' ,'weibo')->getNowFollowingSql($uid);
		$now_uids 	   = implode(',', array_merge($related_uids, array($uid)));
		
		$map['uid']		  = array('exp', " NOT IN ( {$now_following} ) AND `uid` NOT IN ( {$now_uids} )");
		$map['location']  = $user['location'];
		$map['is_avatar'] = 1;
		$map['is_active'] = '1';
		$map['is_init']   = '1';
		if ($res = $model->where($map)->field('uid')->limit($limit)->findAll())
			return getSubByKey($res, 'uid');
		else
			return array();
	}
	
	/**
	 * 根据"好友的好友"推荐用户
	 * 
	 * @param int   $uid		  当前用户ID
	 * @param array $related_uids 已推荐用户的uid数组
	 * @param int   $limit        推荐的人数
	 * @return array 被推荐用户的uid数组
	 * @todo 还需要优化效率 (用户总数8000: 粉丝和关注各7000+时, 执行时间约500ms; 粉丝和互粉各2000+时, 执行时间约3ms)
	 */
	protected function _getRelatedUserFromFriend($uid, $related_uids, $limit = 20)
	{
		if ($limit <= 0)
			return array();
			
		$now_following = D('Follow' ,'weibo')->getNowFollowingSql($uid);
		$now_uids 	   = implode(',', array_merge($related_uids, array($uid)));
		// DISTINCT在大数据量时对性能影响太大, 所以不加
		$sql = "SELECT `a.fid` AS `fid` FROM {$this->tablePrefix}follow AS a LEFT JOIN {$this->tablePrefix}user AS b" .
			   "WHERE `a.fid` NOT IN ( {$now_following} ) AND `a.fid` NOT IN ( {$now_uids} ) AND `a.uid` IN ( {$now_following} ) AND `a.type` = '0' AND b.is_avatar=1 " .
			   "LIMIT {$limit}";
		
		if ($res = M()->query($sql))
			return getSubByKey($res, 'fid');
		else
			return array();
	}
	
	/**
	 * 根据粉丝推荐用户
	 * 
	 * @param int   $uid		  当前用户ID
	 * @param array $related_uids 已推荐用户的uid数组
	 * @param int   $limit        推荐的人数
	 * @return array 被推荐用户的uid数组
	 */
	protected function _getRelatedUserFromFollower($uid, $related_uids, $limit = 20)
	{
		if ($limit <= 0)
			return array();
			
		$now_following = D('Follow' ,'weibo')->getNowFollowingSql($uid);
		$now_uids 	   = implode(',', array_merge($related_uids, array($uid)));
		$sql = "SELECT `a.uid` AS `uid` FROM {$this->tablePrefix}follow WHERE AS a LEFT JOIN {$this->tablePrefix}user AS b" .
			   "`a.fid` = {$uid} AND `a.uid` NOT IN ( {$now_following} ) AND `a.uid` NOT IN ( {$now_uids} ) AND b.is_avatar=1 " .
			   "LIMIT {$limit}";
		
		if ($res = M()->query($sql))
			return getSubByKey($res, 'uid');
		else
			return array();
	}

	/**
	 * 随机推荐用户
	 * 
	 * @param int   $uid		  当前用户ID
	 * @param array $related_uids 已推荐用户的uid数组
	 * @param int   $limit        推荐的人数
	 * @return array 被推荐用户的uid数组
	 */
	protected function _getRandomRelatedUser($uid, $related_uids, $limit = 20)
	{
		if ($limit <= 0)
			return array();
			
		$now_following = D('Follow' ,'weibo')->getNowFollowingSql($uid);
		$now_uids 	   = implode(',', array_merge($related_uids, array($uid)));
		$sql = "SELECT `uid` FROM {$this->tablePrefix}user WHERE " .
			   "`uid` NOT IN ( {$now_following} ) AND `uid` NOT IN ( {$now_uids} ) AND `is_avatar`=1 " .
			   "LIMIT {$limit}";
		
		if ($res = M()->query($sql))
			return getSubByKey($res, 'uid');
		else
			return array();
	}
	
	//邀请好友并保存名片信息
	function saveRecordCard($uid,$post){
		if(!trim($post['name'])){
			return -1;
		}
		
		if(!isValidEmail(trim($_POST['email']))){
			return -2;
		}
		if(!trim($post['company'])){
			return -3;
		}
		if(!trim($post['position'])){
			return -4;
		}
		if(M('user')->where("email='".trim($post['email'])."'")->find()){
			return -5;
		}
		
	    $data['uname']    = trim($post['name']);
	    $data['sex']      = intval($post['sex']);
		$data['company']  = trim($post['company']);
		$data['position'] = trim($post['position']);
		$data['email']    = trim($post['email']);
		$data['cellphone']= trim($post['cellphone']);
		$data['telephone']= trim($post['telephone']);
		$data['ctime']    = time();
	    if($friend_uid = M('user')->add($data)){
			//保存备注
			$rdata['uid'] = $uid;
			$rdata['friend_uid'] = $friend_uid;
			$rdata['remark'] = $post['remark'];
			M("friend_remark")->add($rdata);
			//发送邮件邀请
			$body = model("Invite")->getInviteTpl($uid,$post['invite'],$post['email']);
			$email_sent = service('Mail')->send_email($post['email'], getUserName($uid)."邀请您加入知行网",$body);
			if($email_sent){
				return 1;
			}
		}
	}
}
?>
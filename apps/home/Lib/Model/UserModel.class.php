<?php
class UserModel extends Model {
	protected	$tableName	=	'user';
    var $uid;
    
	/**
	 * 根据查询条件查询用户
	 * 
	 * @param array|string $map          查询条件
	 * @param string       $field		   字段
	 * @param int 		   $limit		   限制条数
	 * @param string 	   $order		   结果排序
	 * @param boolean 	   $is_find_page 是否分页
	 * @return array
	 */
	public function getUserByMap($map = array(), $field = '*', $limit = '', $order = '', $is_find_page = true) {
		if ($is_find_page){
			return $this->where($map)->field($field)->order($order)->findPage($limit);
		}else{
			return $this->where($map)->field($field)->order($order)->limit($limit)->findAll();
		}
	}
	
	/**
	 * 获取用户列表
	 * 
	 * @param array|string $map             查询条件
	 * @param boolean	   $show_dept		是否显示部门信息
	 * @param boolean 	   $show_user_group 是否显示用户组
	 * @param string       $field		           字段
	 * @param string 	   $order		           结果排序
	 * @param int 		   $limit		 	限制条数
	 * @return array
	 */
    public function getUserList($map = '', $show_dept = false, $show_user_group = false, $field = '*', $order = 'uid DESC', $limit = 30) {
    	$res  = $this->where($map)->field($field)->order($order)->findPage($limit);
    	$uids = getSubByKey($res['data'], 'uid');
    	
    	//部门信息
    	if ($show_dept) {
    	}
    	
    	//用户组
    	if ($show_user_group) {
    		$temp_user_group = model('UserGroup')->getUserGroupByUid($uids);

    		//转换成array($uid => $user_group)的格式
    		$user_group = array();
    		foreach($temp_user_group as $v) {
    			$user_group[$v['uid']][] = $v;
    		}
    		unset($temp_user_group);
    		
    		//将用户组信息添加至结果集
    		foreach($res['data'] as $k => $v) {
				$res['data'][$k]['user_group'] = isset($user_group[$v['uid']]) ? $user_group[$v['uid']] : array();
    		}
    	}
    	return $res;
    }

    /**
     * 删除用户
     * 
     * @param array|string $uids
     * @return boolean
     */
    public function deleteUser($uids){
    	//防止误删
    	$uids = is_array($uids) ? $uids : explode(',', $uids);
    	foreach($uids as $k => $v) {
    		if (!is_numeric($v) || $v == $GLOBALS['ts']['user']['uid']) {
    			unset($uids[$k]);
    		}
    	}
    	if ( empty($uids) ) return false;

    	$map['uid'] = array('in', $uids);
    	$map['admin_level'] = 0;
    	//user
    	$res = M('user')->where($map)->delete();
    	//user_group_link
    	//user_group_popedom
    	//user_popedom
    	unset($map['admin_level']);
		if ($res) {
			service('Comment')->where($map)->delete();
			M('credit_user')->where($map)->delete();
			M('feed')->where($map)->delete();
			M('invitecode')->where($map)->delete();
			M('login')->where($map)->delete();
			M('login_record')->where($map)->delete();
			model('Message')->where(array('from_uid'=>array('IN',$uids),'to_uid'=>array('IN',$uids)))->delete();
			M('notify')->where(array('from'=>array('IN',$uids),'receive'=>array('IN',$uids)))->delete();
			M('ucenter_user_link')->where($map)->delete();
			M('user_app')->where($map)->delete();
			M('user_blacklist')->where($map)->delete();
			M('user_count')->where($map)->delete();
			M('user_department')->where($map)->delete();
			M('user_group_link')->where($map)->delete();
			M('user_medal')->where($map)->delete();
			M('user_online')->where($map)->delete();
			M('user_privacy')->where($map)->delete();
			M('user_profile')->where($map)->delete();
			M('user_tag')->where($map)->delete();
			M('user_verified')->where($map)->delete();
			D('Weibo', 'weibo')->where($map)->delete();
			D('Atme', 'weibo')->where($map)->delete();
			D('Comment', 'weibo')->where($map)->delete();
			D('Favorite', 'weibo')->where($map)->delete();
			D('Follow', 'weibo')->where(array('uid'=>array('IN',$uids),'fid'=>array('IN',$uids)))->delete();
			D('FollowGroup', 'weibo')->where($map)->delete();
			M('follow_group_link')->where($map)->delete();
			D('Star', 'weibo')->where($map)->delete();
		}

    	return $res;
    }

    /**
     * 更新操作
     * 
     * @param string $type 操作
     * @return boolean
     */
	function upDate($type){
	    return $this->$type();
	}

	/**
	 * 更新基本信息
	 * 
	 * @return array 
	 */
	function upbase(){
		$nickname = t($_POST['name']);
		if(!$nickname){
			return -1;
		}
		if( M('user')->where("uname='{$nickname}' AND uid!={$this->uid}")->find() ){
			return -2;
		}
		if(!isValidEmail($_POST['email'])){
			return -4;
		}
		if(M('user')->where("email='".$_POST['email']."' AND uid!={$this->uid}")->find()){
			return -5;
		}
		if(!$_POST['company']){
			return -6;
		}
		if(!$_POST['position']){
			return -7;
		}
		if(!$_POST['industry']){
			return -8;
		}
		if(!$_POST['domain']){
			return -9;
		}
		if(M('user')->where("domain='".$_POST['domain']."' AND uid!={$this->uid}")->find()){
			return -10;
		}
		if($_POST['cellphone'] && $_POST['phoneverify']){
			if( intval(time()-$_SESSION['pverify_time'])>600 || $_POST['cellphone'] != $_SESSION['pverify_phone'] || $_POST['phoneverify'] != $_SESSION['pverify_num'] ){
				return -11;
			}
			if(model('Phone')->isPhoneUsed($this->uid,$_POST['cellphone'])){
				return -12;
			}
			$data['cellphone']   = $_POST['cellphone'];
		}
	    $data['province'] = intval( $_POST['area_province'] );
	    $data['uname']    = $nickname;
	    $data['city']     = intval( $_POST['area_city'] );
	    $data['location'] =  getLocation($data['province'],$data['city']);
	    $data['sex']      = intval($_POST['sex']);
		$data['company']     = $_POST['company'];
		$data['position']    = $_POST['position'];
		$data['industry']    = $_POST['industry'];
		$data['telephone']   = $_POST['telephone'];
		$data['domain']      = $_POST['domain'];
		$data['email']       = $_POST['email'];
		$data['ctime']       = time();
	    if(M('user')->where("uid={$this->uid}")->data($data)->save()){
	    	$_SESSION['userInfo'] = D('User', 'home')->find($this->uid);
			unset($_SESSION['pverify_time']);
			unset($_SESSION['pverify_num']);
			unset($_SESSION['pverify_phone']);
			return 1;
		}
	}
	
	//基本信息验证
	function check($uid){
		$userinfo = M('User')->where("uid={$uid} AND is_active=1")->field('uid,uname,email,company,position,industry')->find();
		foreach($userinfo as $v){
			if(empty($v)){
				return false;
			}
		}
		return true;
	}
	
	/**
	 * 获取用户基本信息字段
	 * 
	 * @param string $module 字段类别,contact联系的字段、inro基本介绍的字段
	 * @return array
	 */
	protected function data_field($module = ''){
        $list = $this->table(C('DB_PREFIX').'user_set')->where("status=1")->findall();
        foreach ($list as $value){
            $data[$value['module']][$value['fieldkey']] = $value['fieldname'];
        }
	    return ($module)?$data[$module]:$data;
	}
	
	/**
	 * 根据标示符(uid或uname或email或domain)获取用户信息
	 * 
	 * 首先检查缓存(缓存ID: user_用户uid / user_用户uname), 然后查询数据库(并设置缓存).
	 * 
	 * @param string|int $identifier      标示符内容
	 * @param string     $identifier_type 标示符类型. (uid, uname, email, domain之一)
	 */
	public function getUserByIdentifier($identifier, $identifier_type = 'uid')
	{
		if ($identifier_type == 'uid' && !is_numeric($identifier))
			return false;
		else if (!in_array($identifier_type, array('uid','uname','email','domain')))
			return false;
		else if (($identifier_type == 'uid' || $identifier_type == 'uname') && ($user = object_cache_get("user_{$identifier}")) !== false)
			return $user;
		
		$map = array();
		$map['is_init']   = 1;
		$map['is_active'] = 1;
		if ($identifier_type == 'uid')
			$map['uid'] = intval($identifier);
		else
			$map[$identifier_type] = t($identifier);
		
		if ($user = $this->where($map)->find()) {
			object_cache_set("user_{$user['uid']}",   $user);
			object_cache_set("user_{$user['uname']}", $user);
		} else if ($identifier_type == 'uid' || $identifier_type == 'uname') {
			object_cache_set("user_{$identifier}", array());
		}
		return $user;
	}
	
	/**
	 * 获取推荐用户
	 * 
	 * @param int $uid 用户ID
	 */
	public function getRecommendUser($mid,$limit=6){
		$res = M('user')->where("uid!={$mid} AND recommend=1 AND is_avatar=1 AND is_active=1")->order('uid ASC')->field('uid,uname,company,position')->limit($limit)->findAll();
		
		foreach($res as $k=>$v){
			$v['url'] = getUserUrl($v['uid']);
			$v['face'] = getUserFace($v['uid']);
			$res[$k] = $v;
		}
		
		return $res;
	}
	
	/**
	 * 获取当前在线用户
	 * 
	 * @param int $uid 用户ID
	 */
	public function getOnlineUser($mid,$limit=6,$time=1800){
		$time = time()-$time;
		$prefix = C("DB_PREFIX");
		$res = M('')->table("{$prefix}user_online AS a LEFT JOIN {$prefix}user AS b ON a.uid=b.uid")->where("a.ctime>={$time} AND a.uid!={$mid} AND b.is_avatar=1")->order('a.ctime DESC')->field('a.uid AS uid,b.uname AS uname')->limit($limit)->findAll();
		if(!$res) return ;
		
		foreach($res as $k=>$v){
			$v['url'] = getUserUrl($v['uid']);
			$v['face'] = getUserFace($v['uid']);
			$res[$k] = $v;
		}
		
		return $res;
	}
	
	/**
	 * 获取最近加入的用户
	 * 
	 * @param int $uid 用户ID
	 */
	public function getRecentJoinUser($mid,$limit=6){
		$time = time()-$time;
		$res = M('user')->where("uid!={$mid} AND is_avatar=1 AND is_active=1")->order('ctime DESC')->field('uid,uname,company,position')->limit($limit)->findAll();
		
		foreach($res as $k=>$v){
			$v['url'] = getUserUrl($v['uid']);
			$v['face'] = getUserFace($v['uid']);
			$res[$k] = $v;
		}
		
		return $res;
	}
	
	//判断用户是否绑定外部平台
	function checkPlatformBind($uid,$type='sina'){
		$bind = M ('login')->where("uid={$uid}")->findAll ();
		foreach ( $bind as $v ) {
			$return[$v['type']] = $v['is_sync'];
		}
		
		return $return;
	}
	
	/**
     * 缓存用户列表
     * 
     * 缓存key的格式为: user_用户uid 和 user_用户昵称
     * 
     * @param array $user_list 用户ID列表, 或者用户详情列表. 如果为用户ID列表时, 本方法会首先获取用户详情列表, 然后缓存.
     * @return boolean true:缓存成功 false:缓存失败
     */
	public function setUserObjectCache($user_list)
	{
		if (!is_array($user_list))
			return false;
		if (!is_array($user_list[0]) && !is_numeric($user_list[0]))
			return false;
			
		if (is_numeric($user_list[0])){
			$map['uid']       = array('in', $user_list);
			$map['is_active'] = 1;
			$map['is_init']   = 1;
			$user_list = $this->where($map)->field('`uid`,`uname`,`domain`,`location`,`ctime`')->findAll();
		}
		
		foreach ($user_list as $v) {
			object_cache_set("user_{$v['uid']}",   $v);
			object_cache_set("user_{$v['uname']}", $v);
		}
			
		return true;
	}
}
<?php
/**
 * 通行证服务
 * 
 * @author lzf
 */
class PassportService extends Service
{

	/**
	 * 验证用户是否已登录
	 * 
	 * 按照session -> cookie的顺序检查是否登陆
	 * 
	 * @return boolean 登陆成功是返回true, 否则返回false
	 */
	public function isLogged()
	{
		// 验证本地系统登录
		if (intval($_SESSION['mid']) > 0)
			return true;
		else if ($uid = $this->getCookieUid())
			return $this->loginLocal($uid);
		else {
		unset($_SESSION['mid']);
		unset($_SESSION['uname']);
		unset($_SESSION['userInfo']);

		// 注销cookie
		cookie('LOGGED_USER', NULL);
		cookie('ZhiXingASUR', NULL);

		// 注销管理员
		unset($_SESSION['ThinkSNSAdmin']);
				//$_SESSION['mid'] = 1;     // add by lzf in 2012.10.23
				//return ture;
				//redirect( U('home/Public/adminlogin') );
				return false;   //add by lzf in 2013.3.8

		}

	}		
		

	/**
	 * 根据标示符(email或uid)和未加密的密码获取本地用户 (密码为null时不参与验证)
	 * 
	 * @param string         $identifier 标示符内容 (为数字时:标示符类型为uid, 其他:标示符类型为email)
	 * @param string|boolean $password   未加密的密码
	 * @return array|boolean 成功获取用户数据时返回用户信息数组, 否则返回false
	 */
	public function getLocalUser($identifier, $password = null)
	{
		if (empty($identifier))
			return false;
		
		$identifier_type = is_numeric($identifier) ? 'uid' : 'email';
		$user = D('User', 'home')->getUserByIdentifier($identifier, $identifier_type);
		if (!$user)
			return false;
		else if ($password && md5($password) != $user['password'])
			return false;
		else
			return $user;
	}

	/**
	 * 使用本地账号登陆 (密码为null时不参与验证)
	 * 
	 * @param string         $email
	 * @param string|boolean $password
	 * @return boolean
	 */
	public function loginLocal($identifier, $password = null, $is_remember_me = false)
	{
		$user = $this->getLocalUser($identifier, $password);
		
		return $user ? $this->registerLogin($user, $is_remember_me) : false;
	}
	
	/**
	 * 注册用户的登陆状态 (即: 注册cookie + 注册session + 记录登陆信息)
	 * 
	 * @param array   $user          
	 * @param boolean $is_remeber_me 
	 */
	public function registerLogin(array $user, $is_remeber_me = false)
	{
		if (empty($user))
			return false;
		
		$_SESSION['mid']	= $user['uid'];
		$_SESSION['uname']	= $user['uname'];
		
		if (!$this->getCookieUid()) {
			$expire = $is_remeber_me ? (3600*24*365) : '';
			cookie('LOGGED_USER', base64_encode("thinksns.{$user['uid']}"), $expire);
			
			// 登陆积分
			X('Credit')->setUserCredit($uid, 'user_login');
		}
		
		$this->recordLogin($user['uid']);
		
		return true;
	}
	
	/**
	 * 注销本地登录
	 */
	public function logoutLocal()
	{
		// 注销session
		unset($_SESSION['mid']);
		unset($_SESSION['uname']);
		unset($_SESSION['userInfo']);

		// 注销cookie
		cookie('LOGGED_USER', NULL);
		cookie('ZhiXingASUR', NULL);

		// 注销管理员
		unset($_SESSION['ThinkSNSAdmin']);
	}
	
	/**
	 * 获取cookie中记录的用户ID
	 */
	public function getCookieUid()
	{
		static $cookie_uid = null;
		if (isset($cookie_uid))
			return $cookie_uid;
			
		$cookie = t(cookie('LOGGED_USER'));
		$cookie = explode('.', base64_decode($cookie));
		$cookie_uid = ($cookie[0] !== 'thinksns') ? false : $cookie[1];
		return $cookie_uid;
	}
	
	/**
	 * 检查是否登陆后台
	 */
	public function isLoggedAdmin()
	{
		if($_SESSION['ThinkSNSAdmin'] == '1'){
			return true;
		}else{
			$cookie = t(cookie('ZhiXingASUR'));
			$cookie = explode('.', base64_decode($cookie));
			if($cookie[0] == 'zhixing'){
				if($cookie[2] == md5($cookie[1].'.zhixingadmin')){
					if (!($user = $this->getLocalUser($cookie[1]))) {
						return false;
					}
					if(!service('SystemPopedom')->hasPopedom($cookie[1],'admin/Index/index',false)){
						return false;
					}
					
					$_SESSION['ThinkSNSAdmin'] = '1';
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}
	
	/**
	 * 登陆后台
	 * 
	 * @param int    $uid      用户ID,不能和email同时为空
	 * @param string $email    用户Email,不能和用户ID同时为空
	 * @param string $password 未加密的密码,不能为空
	 * @return boolean
	 */
	public function loginAdmin($identifier, $password)
	{
		if (empty($identifier) || empty($password))
			return false;
		
		if (!($user = $this->getLocalUser($identifier, $password))) {
			unset($_SESSION['ThinkSNSAdmin']);
			return false;
		}
		
		// 检查是否拥有admin/Index/index权限
		if ( service('SystemPopedom')->hasPopedom($user['uid'], 'admin/Index/index', false) ) {
			cookie("ZhiXingASUR",base64_encode('zhixing.'.$user['uid'].'.'.md5($user['uid'].'.zhixingadmin')),(3600*24*365));
			$_SESSION['ThinkSNSAdmin']	= 1;
			$_SESSION['mid']			= $user['uid'];
			$_SESSION['uname']			= $user['uname'];

			//登录记录
			$this->recordLogin($user['uid']);
			return true;
		} else {
			unset($_SESSION['ThinkSNSAdmin']);
			return false;
		}
	}
	
	/**
	 * 记录(更新)登录信息
	 * 
	 * @param int $uid 用户ID
	 */
	public function recordLogin($uid)
	{
		$data['uid']	= $uid;
		$data['ip']		= get_client_ip();
		$data['place']	= convert_ip($data['ip']);
		$data['ctime']	= time();
		M('login_record')->add($data);
	}
	
	/**
	 * 判断用户是否在线（半小时为限）
	 * 
	 * @param int $uid 用户ID
	 */
	public function checkOnline($uids){
		$online = M("user_online")->where("uid={$uid}")->find();
		
		if(!$online){
			return false;
		}else{
			if(time()-$online['ctime']<=1800){
				return true;
			}else{
				return false;
			}
		}
	}
	
	/**
	 * 更新用户在线时间
	 * 
	 * @param int $uid 用户ID
	 */
	public function setOnline($uid){
		if(M("user_online")->where("uid={$uid}")->field("id")->find()){
			$data['ctime']	= time();
			M('user_online')->setField('ctime',time(),"uid={$uid}");
		}else{
			$data['uid']	= $uid;
			$data['ctime']	= time();
			M('user_online')->add($data);
		}
	}
	
	/* 后台管理相关方法 */
	
	// 运行服务，系统服务自动运行
	public function run(){
		return;
	}
}
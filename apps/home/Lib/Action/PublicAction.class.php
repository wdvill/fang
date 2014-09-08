<?php
class PublicAction extends Action{

	public function _initialize() {
		
	}

	public function adminlogin() {
		if ( service('Passport')->isLoggedAdmin() ) {
			redirect(U('admin/Index/index'));
		}

		$this->display();
	}

	public function doAdminLogin() {
		// 检查验证码
		$_SESSION['admin_login'] = '';
		if ( md5($_POST['verify']) != $_SESSION['verify'] ) {
			$_SESSION['admin_login'] = '验证码错误';
			$this->error('验证码错误');
		}

		// 数据检查
		if ( empty($_POST['password']) ) {
			$_SESSION['admin_login'] = '密码不能为空';
			$this->error('密码不能为空');
		}
		if ( isset($_POST['email']) && ! isValidEmail($_POST['email']) ) {
			$_SESSION['admin_login'] = 'email格式错误';
			$this->error('email格式错误');
		}

		// 检查帐号/密码
		$is_logged = false;
		if (isset($_POST['email'])) {
			$is_logged = service('Passport')->loginAdmin($_POST['email'], $_POST['password']);
		}else if ( $this->mid > 0 ) {
			$is_logged = service('Passport')->loginAdmin($this->mid, $_POST['password']);
		}else {
			$_SESSION['admin_login'] = '参数错误';
			$this->error('参数错误');
		}

		// 提示消息不显示头部
		$this->assign('isAdmin','1');

		if ($is_logged) {
			$this->assign('jumpUrl', U('admin/Index/index'));
			$this->success('登陆成功');
		}else {
			$this->assign('jumpUrl', U('home/Public/adminlogin'));
			$_SESSION['admin_login'] = '用户名/密码错误，请确认您的输入正确！';
			$this->error('登陆失败');
		}
	}
	
	public function login()
	{
		if (service('Passport')->isLogged())
			U('home/user/index','',true);
			
		unset($_SESSION['sina'], $_SESSION['key'], $_SESSION['douban'], $_SESSION['qq'],$_SESSION['open_platform_type']);

		//验证码
		$opt_verify = model('Xdata')->lget('siteopt');
		$opt_verify = $opt_verify['site_verify'];
		$opt_verify = in_array('login', $opt_verify);
		if ($opt_verify){
			$this->assign('register_verify_on', 1);
		}
		
		//获取推荐用户
		$data['recommend']  = D('Follow', 'weibo')->getTopFollowerUser();
		
		// 第三方平台
		/*$platform_options = model('Xdata')->lget('platform');
		$platforms = array();
		if (!empty($platform_options['sina_wb_akey']) && !empty($platform_options['sina_wb_skey']))
			$platforms[] = 'sina';
		if (!empty($platform_options['qq_key']) && !empty($platform_options['qq_secret']))
			$platforms[] = 'qq';
		if (!empty($platform_options['douban_key']) && !empty($platform_options['douban_secret']))
			$platforms[] = 'douban';
		$this->assign('platforms', $platforms);*/
		
		$this->assign($data);
		//$this->assign('regInfo',model('Xdata')->lget('register'));
		$this->setTitle('用户登陆');
		$this->display();
	}
	
	public function doLogin() {
		// 检查验证码
		$opt_verify = model('Xdata')->lget('siteopt');
		$opt_verify = $opt_verify['site_verify'];
		$opt_verify = in_array('login', $opt_verify);

		if ($opt_verify && md5($_POST['verify'])!=$_SESSION['verify']) {
			//$this->error('验证码错误');
			echo -3;
			exit;
		}
		
		$username =	$_POST['email'];
		$password =	$_POST['password'];

		if(!isValidEmail($username)){
			//邮箱不合法
			echo -1;
			exit;
		}
		
		if(!$password || strlen($password)<6 || strlen($password)>16){
			//密码6-16位
			echo -2;
			exit;
		}
		
		$user = service('Passport')->getLocalUser($username,$password);

		if($user) {
			//检查是否激活
			/*if ($user['is_active'] == 0) {
				redirect(U('home/public/login',array('t'=>'unactive','email'=>$username,'uid'=>$user['uid'])));
				exit;
			}*/

			service('Passport')->registerLogin($user, intval($_POST['remember']) === 1);

			if ( $_SESSION['refer_url'] != '' ) {
				//跳转至登录前输入的url
				$refer_url	=	$_SESSION['refer_url'];
				unset($_SESSION['refer_url']);
			}else {
				$refer_url = U('home/user/index');
			}
			//$this->assign('jumpUrl',$refer_url);
			//$this->success($username.' 登录成功'. ( (UC_SYNC && $uc_user[0])?uc_user_synlogin($uc_user[0]):'' ));
			exit($refer_url);
		}else {
			echo '';
			exit;
			//$this->error('登录失败');
		}
	}
	
	//第三方登录页面显示
	function tryOtherLogin(){
		if ( !in_array($_GET['type'], array('sina', 'douban', 'qq')) ) {
			$this->error('参数错误');
		}
		include_once(SITE_PATH . "/addons/plugins/login/{$_GET['type']}.class.php");
        $platform = new $_GET['type']();
        redirect($platform->getUrl());
	}

	// 腾讯回调地址
	public function qqcallback() {
		include_once( SITE_PATH . '/addons/plugins/login/qq.class.php' );
        $qq = new qq();
        $qq->checkUser();
        redirect(U('home/Public/otherlogin'));
	}

	//外站帐号登陆
	public function otherlogin(){
		if ( !in_array($_SESSION['open_platform_type'], array('sina', 'douban', 'qq')) ) {
			$this->error('授权失败');
		}

		$type = $_SESSION['open_platform_type'];
		include_once( SITE_PATH."/addons/plugins/login/{$type}.class.php" );
		$platform = new $type();
		$userinfo = $platform->userInfo();
		// 检查是否成功获取用户信息
		if ( empty($userinfo['id']) || empty($userinfo['uname']) ) {
			$this->assign('jumpUrl', SITE_URL);
			$this->error('获取用户信息失败');
		}
		if ( $info = M('login')->where("`type_uid`='".$userinfo['id']."' AND type='{$type}'")->find() ) {
			$user = M('user')->where("uid=".$info['uid'])->find();
			if (empty($user)) {
				// 未在本站找到用户信息, 删除用户站外信息,让用户重新登陆
				M('login')->where("type_uid=".$userinfo['id']." AND type='{$type}'")->delete();
			}else {
				if ( $info['oauth_token'] == '' ) {
					$syncdata['login_id']        	= $info['login_id'];
					$syncdata['oauth_token']        = $_SESSION[$type]['access_token']['oauth_token'];
					$syncdata['oauth_token_secret'] = $_SESSION[$type]['access_token']['oauth_token_secret'];
					M('login')->save($syncdata);
				}

				service('Passport')->registerLogin($user);
				
				redirect(U('home/User/index'));
			}
		}
		$this->assign('user',$userinfo);
		$this->assign('type',$type);
		$this->setTitle('第三方账号登陆');
		$this->display();
	}

	// 激活外站登陆
	public function initotherlogin(){
		if ( ! in_array($_POST['type'], array('douban','sina', 'qq')) ) {
			$this->error('参数错误');
		}


		if( !isLegalUsername( t($_POST['uname']) ) ){
			$this->error('昵称格式不正确');
		}

		$haveName = M('User')->where( "`uname`='".t($_POST['uname'])."'")->find();
		if( is_array( $haveName ) && sizeof($haveName)>0 ){
			$this->error('昵称已被使用');
		}

		$type = $_POST['type'];
		include_once( SITE_PATH."/addons/plugins/login/{$type}.class.php" );
		$platform = new $type();
		$userinfo = $platform->userInfo();
		
		// 检查是否成功获取用户信息
		if ( empty($userinfo['id']) || empty($userinfo['uname']) ) {
			$this->assign('jumpUrl', SITE_URL);
			$this->error('获取用户信息失败');
		}

		// 检查是否已加入本站
		$map['type_uid'] = $userinfo['id'];
		$map['type']     = $type;
		if ( ($local_uid = M('login')->where($map)->getField('uid')) && (M('user')->where('uid='.$local_uid)->find()) ) {
			$this->assign('jumpUrl', SITE_URL);
			$this->success('您已经加入本站');
		}
		// 初使化用户信息, 激活帐号
		$data['uname']        = t($_POST['uname'])?t($_POST['uname']):$userinfo['uname'];
		$data['province']     = intval($userinfo['province']);
		$data['city']         = intval($userinfo['city']);
		$data['location']     = $userinfo['location'];
		$data['sex']          = intval($userinfo['sex']);
		$data['is_active']    = 1;
		$data['is_init']      = 1;
		$data['ctime']      = time();
		$data['is_synchronizing']  = ($type == 'sina') ? '1' : '0'; // 是否同步新浪微博. 目前仅能同步新浪微博

		if ( $id = M('user')->add($data) ) {
			// 记录至同步登陆表
			$syncdata['uid']                = $id;
			$syncdata['type_uid']           = $userinfo['id'];
			$syncdata['type']               = $type;
			$syncdata['oauth_token']        = $_SESSION[$type]['access_token']['oauth_token'];
			$syncdata['oauth_token_secret'] = $_SESSION[$type]['access_token']['oauth_token_secret'];
			M('login')->add($syncdata);

			// 转换头像
			if ($_POST['type'] != 'qq') { // 暂且不转换QQ头像: QQ头像的转换很慢, 且会拖慢apache
				D('Avatar')->saveAvatar($id,$userinfo['userface']);
			}

			// 将用户添加到myop_userlog，以使漫游应用能获取到用户信息
			$userlog = array(
				'uid'		=> $id,
				'action'	=> 'add',
				'type'		=> '0',
				'dateline'	=> time(),
			);
			M('myop_userlog')->add($userlog);

			service('Passport')->loginLocal($id);
			
			$this->registerRelation($id);

			redirect( U('home/Public/followuser') );
		}else{
			$this->error('同步帐号发生错误');
		}
	}

	public function bindaccount() {
		if ( ! in_array($_POST['type'], array('douban','sina','qq')) ) {
			$this->error('参数错误');
		}

		$psd  = ($_POST['passwd']) ? $_POST['passwd'] : true;
		$type = $_POST['type'];

		if ( $user = service('Passport')->getLocalUser($_POST['email'], $psd) ) {
			include_once( SITE_PATH."/addons/plugins/login/{$type}.class.php" );
			$platform = new $type();
			$userinfo = $platform->userInfo();

			// 检查是否成功获取用户信息
			if ( empty($userinfo['id']) || empty($userinfo['uname']) ) {
				$this->assign('jumpUrl', SITE_URL);
				$this->error('获取用户信息失败');
			}

			// 检查是否已加入本站
			$map['type_uid'] = $userinfo['id'];
			$map['type']     = $type;
			if ( ($local_uid = M('login')->where($map)->getField('uid')) && (M('user')->where('uid='.$local_uid)->find()) ) {
				$this->assign('jumpUrl', SITE_URL);
				$this->success('您已经加入本站');
			}

			$syncdata['uid']      = $user['uid'];
			$syncdata['type_uid'] = $userinfo['id'];
			$syncdata['type']     = $type;
			if ( M('login')->add($syncdata) ) {
				service('Passport')->registerLogin($user);
				
				$this->assign('jumpUrl', U('home/User/index'));
				$this->success('绑定成功');
				
			}else {
				$this->assign('jumpUrl', SITE_URL);
				$this->error('绑定失败');
			}
		}else {
			$this->error('帐号输入有误');
		}
	}

	//
	public function callback(){
		include_once( SITE_PATH.'/addons/plugins/login/sina.class.php' );
		$sina = new sina();
		$sina->checkUser();
		redirect(U('home/public/otherlogin'));
	}

	public function doubanCallback() {
		if ( !isset($_GET['oauth_token']) ) {
			$this->error('Error: No oauth_token detected.');
			exit;
		}
		require_once SITE_PATH . '/addons/plugins/login/douban.class.php';
		$douban = new douban();
		if ( $douban->checkUser($_GET['oauth_token']) ) {
			redirect(U('home/Public/otherlogin'));
		}else {
			$this->assign('jumpUrl', SITE_URL);
			$this->error('验证失败');
		}
	}

	public function logout() {
		service('Passport')->logoutLocal();
		U('home/public/login','',true);
		//$this->assign('jumpUrl',U('home/index'));
		//$this->success('成功退出'. ( (UC_SYNC)?uc_user_synlogout():'' ) );
	}

	public function logoutAdmin() {
		service('Passport')->logoutLocal();
		U('home/Public/adminlogin','',true);
	}
	
	private function __getInviteInfo($invite_code)
	{
		$res = null;
		$invite_option = model('Invite')->getSet();
		switch (strtolower($invite_option['invite_set'])) {
			case 'close':
				$res = null;
				break;
			case 'common':
				$res = D('User', 'home')->getUserByIdentifier($invite_code, 'uid');
				break;
			case 'invitecode':
				$res = model('Invite')->checkInviteCode($invite_code);
				if (!$res)
					$res = null;
				break;
		}
		
		return $res;
	}

	public function register()
	{
		if (service('Passport')->isLogged())
			U('home/user/index','',true);
		
		if(!empty($_GET['invite'])){
			$type = 'register_invite';
			//邀请码
			$data['invite'] = model("Invite")->checkInviteCode($_GET['invite']);
			if($data['invite']) $data['invitecode'] = $_GET['invite'];
		}else{
			$data['list'] = D("Ads")->getADList($type=4,$limit=5);
			$type = '';
		}
		
		//获取滚动广告
		//$data['list'] = D("info")->getRegisterAds(5);
		
		$this->assign($data);
		//$this->setTitle('注册');
		$this->display($type);
	}

	public function doRegister()
	{

		// 参数合法性检查
		$required_field = array(
			'email'		=> '邮箱',
			'name'  => '姓名',
			'password'	=> '密码',
			//'cellphone'	=> '手机号码',
			//'confirmpassword'=> '密码',
			//'company'=> '公司/单位名称',
			//'position'=> '职位',
		);
		foreach ($required_field as $k => $v)
			if (empty($_POST[$k])){
				echo $v . '不可为空';
				exit;
			}
		
		if (!$this->isValidEmail($_POST['email'])){
			echo -1;
			exit;
		}
		if(!$invite_info || empty($invite_info['email'])){
			if (!$this->isEmailAvailable($_POST['email'])){
				echo -2;
				exit;
			}
		}
		if (strlen($_POST['password']) < 6 || strlen($_POST['password']) > 16){
			echo -3;
			exit;
		}
		if (!empty($_POST['cellphone']) && !model("Phone")->checkPhoneNumber($_POST['cellphone'])){
			echo -4;
			exit;
		}
		// 是否需要Email激活
		$need_email_activate = intval(model('Xdata')->get('register:register_email_activate'));

		// 注册
		$data['email']     = $_POST['email'];
		$data['password']  = md5($_POST['password']);
		$data['uname']	   = t($_POST['name']);
		//$data['company']   = t($_POST['company']);
		//$data['position']  = t($_POST['position']);
		$data['cellphone']  = $_POST['cellphone'];
		$data['is_active'] = 0;
		$data['is_init']   = $need_email_activate ? 0:1;
		$data['ctime']	   = time();
		if (!($uid = D('User', 'home')->add($data))){
			echo 0;
			exit;
		}
		
		//分配邀请码
		sendinvite($uid);
		
		if($need_email_activate == 1) { // 邮件激活
			//$this->activate($uid, $_POST['email']);
			$return['nea'] = 1;
			$return['url'] = U('home/public/activate',array('u'=>$uid,'em'=>$_POST['email']));
			echo json_encode($return);
			exit;
		}else{
			if($data['is_active']==0){
				echo -5;
				exit;
			}
			// 置为已登陆
			service('Passport')->loginLocal($uid);   //申请注册情况下不能直接置为已登录
			
			$this->registerRelation($uid);
			
			// 缓存邀请信息, 供完善个人资料后使用
			//$_SESSION["invite_info_{$uid}"] = $invite_info;

			echo 1;
		}
	}
	
	//带邀请码的注册
	public function doRegisterInvite()
	{
		// 验证码
		/*$verify_option = model('Xdata')->get('siteopt:site_verify');
		if (in_array('register', $verify_option) && md5($_POST['verify']) != $_SESSION['verify'])
			$this->error('验证码错误');*/
		
		// 邀请码
		$invite_code = h($_POST['invitecode']);
		$invite_info = $this->__getInviteInfo($invite_code);
		if(!$invite_info){
			echo -5;
			exit;
		}
			
		// 参数合法性检查
		$required_field = array(
			'email'		=> '邮箱',
			'name'  => '姓名',
			'password'	=> '密码',
			//'cellphone'	=> '手机号码',
			'invitecode'	=> '邀请码',
			//'confirmpassword'=> '密码',
			//'company'=> '公司/单位名称',
			//'position'=> '职位',
		);
		foreach ($required_field as $k => $v)
			if (empty($_POST[$k])){
				echo $v . '不可为空';
				exit;
			}
		
		if (!$this->isValidEmail($_POST['email'])){
			echo -1;
			exit;
		}
		if(!$invite_info || empty($invite_info['email'])){
			if (!$this->isEmailAvailable($_POST['email'])){
				echo -2;
				exit;
			}
		}
		if (strlen($_POST['password']) < 6 || strlen($_POST['password']) > 16){
			echo -3;
			exit;
		}
		if (!empty($_POST['cellphone']) && !model("Phone")->checkPhoneNumber($_POST['cellphone'])){
			echo -4;
			exit;
		}
		// 是否需要Email激活
		$need_email_activate = intval(model('Xdata')->get('register:register_email_activate'));

		// 注册
		$data['email']     = $_POST['email'];
		$data['password']  = md5($_POST['password']);
		$data['uname']	   = t($_POST['name']);
		//$data['company']   = t($_POST['company']);
		//$data['position']  = t($_POST['position']);
		$data['cellphone']  = $_POST['cellphone'];
		$data['is_active'] = 1;
		$data['is_init']   = $need_email_activate ? 0 : 1;
		$data['ctime']	   = time();
		if(!empty($invite_info['email'])){
			if(!D("User","home")->where("uid={$invite_info['invite_uid']}")->save($data)){
				echo 0;
				exit;
			}
			$uid = $invite_info["invite_uid"];
		}else{
			if (!($uid = D('User', 'home')->add($data))){
				echo 0;
				exit;
			}
		}
		
		//分配邀请码
		sendinvite($uid);
		
		if($need_email_activate == 1) { // 邮件激活
			//$this->activate($uid, $_POST['email'], $invite_code);
			$return['nea'] = 1;
			$return['url'] = U('home/public/activate',array('u'=>$uid,'em'=>$_POST['email'],'invite'=>$invite_code));
			echo json_encode($return);
			exit;
		}else{
			// 置为已登陆
			service('Passport')->loginLocal($uid);
			
			$this->registerRelation($uid, $invite_info);
			
			// 缓存邀请信息, 供完善个人资料后使用
			//$_SESSION["invite_info_{$uid}"] = $invite_info;

			echo 1;
		}
	}
	
	// 完善个人资料
	public function userinfo()
	{
		if (!$this->mid)
			redirect(U('home/Public/login'));
			
		// 已初始化的用户, 不允许在此修改资料
		global $ts;
		if ($this->mid && $ts['user']['is_init'])
			redirect(U('home/User/index'));
		
		if ($_POST) {
			$user_info = D('User', 'home')->getUserByIdentifier($this->mid, 'uid');
			if (!$user_info['uname']) {
				if (!$this->isValidNickName($_POST['nickname']))
					$this->error('昵称格式不正确或已被使用');
				else
					$data['uname'] = $_POST['nickname'];
			}

			$data['sex']   	  = intval($_POST['sex']);
			$data['province'] = intval($_POST['area_province']);
			$data['city']     = intval($_POST['area_city']);
			$data['location'] = getLocation($data['province'], $data['city']);
			$data['is_init']  = 1;
			M('user')->where("uid={$this->mid}")->data($data)->save();
			
			// 关联操作
			$this->registerRelation($this->mid, $_SESSION["invite_info_{$this->mid}"]);
			unset($_SESSION["invite_info_{$this->mid}"]);

			redirect(U('home/Public/followuser'));
		} else {
			$user_info = D('User', 'home')->getUserByIdentifier($this->mid, 'uid');
			$this->assign('nickname', $user_info['uname']);
			$this->setTitle('完善个人资料');
			$this->display();
		}
	}

	//使用邀请码注册
	public function inviteRegister() {
		if ( ! $invite = service('Validation')->getValidation() ) {
			$this->error('邀请码错误');
		}

		if ( "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] != $invite['target_url'] ) {
			$this->error('URL错误');
		}
		$this->assign('invite', $invite);
		
		$invite['data']			= unserialize($invite['data']);
		$map['tpl_record_id']	= $invite['data']['tpl_record_id'];
		$tpl_record 			= model('Template')->getTemplateRecordByMap($map, '', 1);
		$tpl_record 			= $tpl_record['data'][0]['data'];
		$this->assign('template', $tpl_record);

		//邀请人的好友
		$friend = model('Friend')->getFriendList($invite['from_uid'], null, 9);
		$this->assign($friend);
		
		$this->display('invite');
	}

	public function resendEmail() {
		$invite = service('Validation')->getValidation();
		$this->activate(intval($_GET['uid']), $_GET['email'], $invite, 1);
	}
	
	
	public function sendpwd(){
		$this->display();
	}
	
	public function dosendpwd() {
		$_POST["email"]	= t($_POST["email"]);
		if ( !$this->isValidEmail($_POST['email']) )
			handleErrorByJs('邮箱格式错误！');
		
		$user =	M("user")->where('`email`="' . $_POST['email'] . '"')->find();
		
        if(!$user) {
        	handleErrorByJs('该邮箱不存在！');
        }else {
            $code = base64_encode( $user["uid"] . "." . md5($user["uid"] . '+' . $user["password"]) );
            $url  = U('home/Public/repwd', array('code'=>$code));
            $body = $this->getPwdEmailTpl($user,$url);
			
			global $ts;
			$email_sent = service('Mail')->send_email($user['email'], "重置{$ts['site']['site_name']}密码", $body);
			
            if ($email_sent) {
				handleErrorByJs('已把密码发送到你的邮箱'.$user['email'].'中，请注意查收！',SITE_URL);
            }else {
				handleErrorByJs('很抱歉，邮件发送失败，请稍后重试！');
            }
		}
	}
	
	/*
	**通过手机重置密码
	*/
	//发送手机密码
	function checkphone(){
		$return['code'] = 0;
		
		//验证手机号码
		if(preg_match('/^[1-9]+[0-9]{10}/',$_POST['phone']) <= 0){
			$return['msg'] = '手机号码不合法！';
			echo json_encode($return);
			exit;
		}
		//验证手机号码是否已被注册
		$check = M("user")->where("cellphone='".$_POST['phone']."'")->count();
		if(!$check){
			$return['msg'] = '手机号码尚未注册！';
			echo json_encode($return);
			exit;
		}
		
		//发送手机密码
		$res = model('Phone')->sendPhoneVerify($_POST['phone']);
		if($res == 1){
			$return['code'] = 1;
		}elseif($res == -1){
			$return['msg'] = '操作过于频繁，请5分钟后再试！';
		}elseif($res == -2){
			$return['msg'] = '手机号码不合法，请重新输入！';
		}elseif($res == -3){
			$return['msg'] = '上次发送的密码还未过时。请勿重新发送！';
		}else{
			$return['msg'] = '发送失败，请稍后重试！';
		}
		
		echo json_encode($return);
		exit;
	}
	
	//通过手机验证码充值密码
	public function dorepwdphone(){
		$return['code'] = 0;
		
		//验证手机号码
		if(preg_match('/^[1-9]+[0-9]{10}/',$_POST['phone']) <= 0){
			$return['msg'] = '手机号码不合法！';
			echo json_encode($return);
			exit;
		}
		//验证手机号码是否已被注册
		$check = M("user")->where("cellphone='".$_POST['phone']."'")->field('uid')->find();
		if(!$check){
			$return['msg'] = '手机号码尚未注册！';
			echo json_encode($return);
			exit;
		}
		//验证手机验证码
		if($_POST['phone'] != $_SESSION['pverify_phone'] || $_POST['phoneverify'] != $_SESSION['pverify_num'] || intval(time()-$_SESSION['pverify_time']) > 600){
			$return['msg'] = '手机验证码错误或已过期！';
			echo json_encode($return);
			exit;
		}
		//验证密码
		if(strlen($_POST["password"])<6 || strlen($_POST["password"])>16 || $_POST["password"] != $_POST["repassword"]) {
			$return['msg'] = '密码6-16位，且两次输入的密码必须相同！';
			echo json_encode($return);
			exit;
        }
        
		$user['password'] = md5($_POST['password']);
		$res = M('user')->where('uid='.$check['uid'])->save($user);
		if ($res) {
			$return['code'] = 1;
			$return['msg'] = '密码重置成功！';
			$return['url'] = U('home/public/login');
		}else {
			$return['msg'] = '很抱歉，密码重置失败，请稍后重试！';
		}
		
		echo json_encode($return);
		exit;
	}
	
	public function repwd() {
		$code = explode('.', base64_decode($_GET['code']));
        $user = M('user')->where('`uid`=' . $code[0])->find();
        
        if ( $code[1] == md5($code[0].'+'.$user["password"]) ) {
	        $this->assign('email',$user["email"]);
	        $this->assign('code', $_GET['code']);
	        $this->display();
        }else {
        	handleErrorByJs('很抱歉，链接错误！');
        }
	}
	
	public function dorepwd(){
		
		if(strlen($_POST["password"])<6 || strlen($_POST["password"])>16 || $_POST["password"] != $_POST["repassword"]) {
			handleErrorByJs('密码6-16位，且两次输入的密码必须相同！');
        }
        
		$code = explode('.', base64_decode($_POST['code']));
        $user = M('user')->where('`uid`=' . $code[0])->find();
        
        if ( $code[1] == md5($code[0] . '+' . $user["password"]) ) {
	        $user['password'] = md5($_POST['password']);
	        $res = M('user')->save($user);
	        if ($res) {
	        	handleErrorByJs('重置密码成功！',U('home/Public/login'));
	        }else {
				handleErrorByJs('很抱歉，密码重置失败，请稍后重试！');
	        }
        }else {
			handleErrorByJs('很抱歉，密码重置失败，请稍后重试！');
        }
	}
	
	public function doModifyEmail() {
    	if ( !$validation = service('Validation')->getValidation() ) {
    		$this->error('验证码错误');
    	}
    	if ( "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] != $validation['target_url'] ) {
    		$this->error('URL错误');
		}
    	
    	$validation['data'] = unserialize($validation['data']);
    	$map['uid']			= $validation['from_uid'];
    	$map['email']		= $validation['data']['oldemail'];
		if ( M('user')->where($map)->setField('email', $validation['data']['email']) ) {
			service('Validation')->unsetValidation();
			service('Passport')->logoutLocal();
			$this->assign('jumpUrl', SITE_URL);
			$this->success('激活新Email成功，请重新登录');
		}else {
			$this->error('抱歉: 激活新Email失败');
		}
    }
	
	//检查Email地址是否合法
	public function isValidEmail($email) {
		if(UC_SYNC){
			$res = uc_user_checkemail($email);
			if($res == -4){
				return false;
			}else{
				return true;
			}
		}else{
			return preg_match("/[_a-zA-Z\d\-\.]+@[_a-zA-Z\d\-]+(\.[_a-zA-Z\d\-]+)+$/i", $email) !== 0;
		}
	}

	//检查Email是否可用
	public function isEmailAvailable($email = null) {
		$return_type = empty($email) ? 'ajax' 		   : 'return';
		$email		 = empty($email) ? $_POST['email'] : $email;

		$res = M('user')->where('`email`="'.$email.'"')->find();
		if(UC_SYNC){
			$uc_res = uc_user_checkemail($email);
			if($uc_res == -5 || $uc_res == -6){
				$res = true;
			}
		}

		if ( !$res ) {
			if ($return_type === 'ajax') echo 'success';
			else return true;
		}else {
			if ($return_type === 'ajax') echo '邮箱已被占用';
			else return false;
		}
	}
	
	//检查昵称是否符合规则，且是否为唯一
	
	public function isValidNickName($name)
	{
		$return_type  = empty($name)  ? 'ajax' 		   			: 'return';
		$name		  = empty($name)  ? t($_POST['nickname']) 	: $name;

		if (UC_SYNC) {
			$uc_res = uc_user_checkname($name);
			if($uc_res == -1 || !isLegalUsername($name)){
				if ($return_type === 'ajax') { echo '3-10位的中英文、数字、下划线、中划线';return; }
				else return false;
			}
		} else if (!isLegalUsername($name)) {
			if ($return_type === 'ajax') { echo '2-10位的中英文、数字、下划线、中划线';return; }
			else return false;
		}

		if ($this->mid) {
			$res = M('user')->where("uname='{$name}' AND uid<>{$this->mid}")->count();
			$nickname = M('user')->getField('uname',"uid={$this->mid}");
			if (UC_SYNC && ($uc_res == -2 || $uc_res == -3) && $nickname != $name) {
				$res = 1;
			}
		} else {
			$res = M('user')->where("uname='{$name}'")->count();
			if(UC_SYNC && ($uc_res == -2 || $uc_res == -3)){
				$res = 1;
			}
		}

		if ( !$res ) {
			if ($return_type === 'ajax') echo 'success';
			else return true;
		}else {
			if ($return_type === 'ajax') echo '此用户名已被使用';
			else return false;
		}
	}
	
	//检查是否真实姓名。支持ajax和return
	public function isValidRealName($name = null, $opt_register = null) {
		$return_type  = empty($name) 		 ? 'ajax' 							: 'return';
		$name		  = empty($name) 		 ? t($_POST['uname']) 				: $name;
		$opt_register = empty($opt_register) ? model('Xdata')->lget('register') : $opt_register;
		
		if ($opt_register['register_realname_check'] == 1) {
			$lastname = explode(',', $opt_register['register_lastname']);
			$res = in_array( substr($name, 0, 3), $lastname ) || in_array( substr($name, 0, 6), $lastname );
		}else {
			$res = true;
		}
		
		if ($res) {
			if ($return_type === 'ajax') echo 'success';
			else return true;
		}else {
			if ($return_type === 'ajax') echo 'fail';
			else return false;
		}
	}
	
	// 注册的关联操作
    public function registerRelation($uid, $invite_info = null)
    {
    	if (($uid = intval($uid)) <= 0)
    		return;

    	$dao = D('Follow','weibo');
    	
    	// 使用邀请码时, 建立与邀请人的关系
    	if ($invite_info['uid']) {
    		// 互相关注
    		D('Follow', 'weibo')->dofollow($uid, $invite_info['uid']);
			D('Follow', 'weibo')->dofollow($invite_info['uid'], $uid);
			
			//互相添加为好友
			model("Friend")->addUserFriend($uid,$invite_info['uid']);
			// 添加邀请记录
			model('InviteRecord')->addRecord($invite_info['uid'], $uid);
			//邀请人积分操作
			X('Credit')->setUserCredit($invite_info['uid'], 'invite_friend');
    	}
		
        // 默认关注的好友
		$auto_freind = model('Xdata')->lget('register');
		$auto_freind['register_auto_friend'] = explode(',', $auto_freind['register_auto_friend']);
		foreach($auto_freind['register_auto_friend'] as $v) {
			if (($v = intval($v)) <= 0)
				continue ;
			$dao->dofollow($v, $uid);
			$dao->dofollow($uid, $v);
		}
        
		// 开通个人空间
		$data['uid'] = $uid;
		model('Space')->add($data);

		//注册成功 初始积分
		X('Credit')->setUserCredit($uid,'init_default');
	}
	
	public function verify() {
        require_once(SITE_PATH.'/addons/libs/Image.class.php');
        require_once(SITE_PATH.'/addons/libs/String.class.php');
    	Image::buildImageVerify();
	}
	
    //上传图片
    public function uploadpic(){
    	if( $_FILES['pic'] ){
    		//执行上传操作
    		$savePath =  $this->getSaveTempPath();
    		$filename = md5( time().'teste' ).'.'.substr($_FILES['pic']['name'],strpos($_FILES['pic']['name'],'.')+1);
	    	if(@copy($_FILES['pic']['tmp_name'], $savePath.'/'.$filename) || @move_uploaded_file($_FILES['pic']['tmp_name'], $savePath.'/'.$filename)) 
	        {
	        	$result['boolen']    = 1;
	        	$result['type_data'] = 'temp/'.$filename;
	        	$result['picurl']    = __UPLOAD__.'/temp/'.$filename;
	        } else {
	        	$result['boolen']    = 0;
	        	$result['message']   = '上传失败';
	        }
    	}else{
        	$result['boolen']    = 0;
        	$result['message']   = '上传失败';
    	}
    	
    	exit( json_encode( $result ) );
    }
    
    //上传临时文件
	public function getSaveTempPath(){
        $savePath = SITE_PATH.'/data/uploads/temp';
        if( !file_exists( $savePath ) ) mk_dir( $savePath  );
        return $savePath;
    }
    
    // 地区管理
    public function getArea() {
    	echo json_encode(model('Area')->getAreaTree());
    }
    
	/**  文章  **/
	public function document() {
		$list	= array();
		$detail = array();
		$res    = M('document')->where('`is_active`=1')->order('`display_order` ASC,`document_id` ASC')->findAll();

		// 获取content为url且在页脚显示的文章
		global $ts;
		$ids_has_url = array();
		foreach($ts['footer_document'] as $v)
			if( !empty($v['url']) )
				$ids_has_url[] = $v['document_id'];

		$_GET['id'] = intval($_GET['id']);

		foreach($res as $v) {
			// 不显示content为url且在页脚显示的文章
			if ( in_array($v['document_id'], $ids_has_url) )
				continue ;

			$list[] = array('document_id'=>$v['document_id'], 'title'=>$v['title']);

			// 当指定ID，且该ID存在，且该文章的内容不是url时，显示指定的文章。否则显示第一篇
			if ( $v['document_id'] == $_GET['id'] || empty($detail) ) {
				$v['content'] = htmlspecialchars_decode($v['content']);
				$detail = $v;
			}
		}
		unset($res);

		$this->assign('detail', $detail);
		$this->assign('list', $list);
		$this->display();
	}
	
	public function toWap() {
		$_SESSION['wap_to_normal'] = '0';
		cookie('wap_to_normal', '0', 3600*24*365);
		U('wap', '', true);
	}
	
	public function fetchNew()
	{
		$map['weibo_id']	 = array('gt', intval($_POST['since_id']));
		$map['transpond_id'] = 0;
		$map['type']		 = 0;
		$res = D('Weibo', 'weibo')->where($map)->order('weibo_id DESC')->find();
		if ($res) {
			$res['uname'] = getUserSpace($res['uid'], '', '_blank', '{uname}');
			$res['user_pic']	  = getUserSpace($res['uid'], '', '_blank', '{uavatar=m}');
			$res['friendly_date'] = friendlyDate($res['ctime']);
			echo json_encode($res);
		} else {
			echo 0;
		}
	}
	
	public function error404() {
		$this->display('404');
	}
}

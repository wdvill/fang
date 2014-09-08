<?php 
/**
 * IndexAction
 * 活动
 */
class IndexAction extends Action{
	private $appName;
    private $event;

    /**
     * __initialize
     * 初始化
     * @access public
     * @return void
     */ 
    public function _initialize(){
		//应用名称
		global $ts;
		$this->appName = $ts['app']['app_alias'];
        //设置活动的数据处理层
        $this->event = D('Event');
		//读取推荐列表
        $recommend_list = $this->event->getHotList();
        $this->assign('recommend_list',$recommend_list);
        // 活动分类
        $cate = D( 'EventType' )->getType();
        $this->assign('category',$cate);
    }

    /**
     * index
     * 首页
     * @access public
     * @return void
     */
    public function index(){
		
		/*//我参与的活动
		$map_join['action'] = 'joinIn';
		$map_join['status'] = 1;
		$map_join['uid']    = $this->uid;
		$eventIds  = D('EventUser')->field('eventId')->where($map_join)->findAll();
		foreach($eventIds as $v) {
			$in_arr[] = $v['eventId'];
		}
		$map['id'] = array('in',$in_arr);
		$data['join_event']  = $this->event->getEventList($map,'id DESC',$this->mid);
		
		//热门活动
        $data['hot_event'] = $this->event->getHotList();
		*/
		//最新活动
		$data['list'] = $this->event->getEventList('','cTime DESC',$this->mid);
		
		$this->assign($data);
        $this->display();
    }

    /**
     * listevent
     * 列表页
     * @access public
     * @return void
     */
    public function listevent() {
    	$type = $_GET['type'];
    	if ($type == 'myevent'){
			//我参与的活动
			$map_join['action'] = 'joinIn';
			$map_join['status'] = 1;
			$map_join['uid']    = $this->uid;
			$eventIds  = D('EventUser')->field('eventId')->where($map_join)->findAll();
			foreach($eventIds as $v) {
				$in_arr[] = $v['eventId'];
			}
			$map['id'] = array('in',$in_arr);
			$data  = $this->event->getEventList($map,'id DESC',$this->mid);
			$typetitle = "我参与的活动";
		} else if ($type == 'mypublish'){
			$map['uid'] = $this->mid;
			$data = $this->event->getEventList($map,'cTime DESC',$this->mid);
		} else if ($type == 'hotevent'){
			//热门活动
        	$data['data'] = $this->event->getHotList();
        	$typetitle = "热门活动";
		} else if ($type == 'newevent'){
			//最新活动
			$data = $this->event->getEventList('','cTime DESC',$this->mid);
			$typetitle = "最新活动";
        }
		
		$this->assign($data);
		$this->assign('typetitle',$typetitle);
        $this->display($type);
    }

    /**
     * personal
     * 个人列表
     * @access public
     * @return void
     */
    public function personal() {
    	if ($this->uid == $this->mid)
    		$name = '我';
    	else
    		$name = getUserName($this->uid);
    	
        switch( $_GET['action'] ) {
            case 'join':    //参与的
                $map_join['action'] = 'joinIn';
                $map_join['status'] = 1;
                $map_join['uid']    = $this->uid;
                $eventIds  = D('EventUser')->field('eventId')->where($map_join)->findAll();
                foreach($eventIds as $v) {
                    $in_arr[] = $v['eventId'];
                }
                $map['id'] = array('in',$in_arr);
                $this->setTitle("{$name}参与的{$this->appName}");
                break;
            case 'att':   //关注的
                $map_att['action'] = 'attention';
                $map_att['status'] = 1;
                $map_att['uid']    = $this->uid;
                $eventIds  = D('EventUser')->field('eventId')->where($map_att)->findAll();
                foreach($eventIds as $v) {
                    $in_arr[] = $v['eventId'];
                }
                $map['id'] = array('in',$in_arr);
                $this->setTitle("{$name}关注的{$this->appName}");
                break;
         	default:      //发起的
                $map['uid'] = $this->uid;
                $this->setTitle("{$name}发起的{$this->appName}");
        }
        $result  = $this->event->getEventList($map,'id DESC',$this->mid);
        $this->assign($result);
        $this->assign('name', $name);
        $this->display();
    }
	
	//搜索活动
	function search(){
		$key = $this->__getSearchKey();
		if($key){
			$map = "title LIKE '%".$key."%'";
			$data['list']  = $this->event->getEventList($map,'id DESC',$this->mid);
		}
		$this->assign($data);
        $this->display();
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
			$_SESSION ['event_search_key'] = serialize ( $key );
		
		} else if (is_numeric ( $_GET [C ( 'VAR_PAGE' )] )) {
			$key = unserialize ( $_SESSION ['event_search_key'] );
		
		} else {
			//unset($_SESSION['event_search_key']);
		}
		
		return trim ( $key );
	}
	
    /**
     * addEvent
     * 发起活动
     * @access public
     * @return void
     */
    public function addEvent() {
		//判断是否需要资料完整
		if(!D('UserProfile','home')->isUserProfile($this->mid)){
			handleErrorByJs('请先完善您的个人资料和头像！',U('home/account/profile'));
		}
		//判断用户是否有权限创建活动
		/*if(!model("Phone")->isCheckPhone($this->mid)){
			$this->display("phonecheck");
			exit;
		}*/
        $this->_createLimit($this->mid);

        $typeDao = D( 'EventType' );
        $this->assign('type',$typeDao->getType());
        //$this->setTitle('发起' . $this->appName);
        $this->display();
    }
	/**
     * _creatLimit
     * 条件限制判断
     * @access public
     * @return void
     */
    private function _createLimit($uid){
		$config = getConfig();

		if(!$config['canCreate']){
			handleErrorByJs('禁止发起'.$this->appName,U('event/index'));
		}
    	if($config['credit']){
			$userCredit = X('Credit')->getUserCredit($uid);
    		if($userCredit[$config['credit_type']]['credit']<$config['credit']){
    			handleErrorByJs($userCredit[$config['credit_type']]['alias'].'小于'.$config['credit'].'，不允许发起'.$this->appName,U('event/index'));
    		}
    	}
    	if( $timeLimit = $config['limittime'] ){
    	   $regTime = M('user')->getField('ctime',"uid={$uid}");
    	   $difference = (time()-$regTime)/3600;

    	   if($difference<$timeLimit){
    	       //handleErrorByJs('账户创建时间小于'.$timeLimit.'小时，不允许发起'.$this->appName,U('event/index'));
    	   }
    	}
    }
    /**
     * doAddEvent
     * 添加活动
     * @access public
     * @return void
     */
    public function doAddEvent() {
        $this->_createLimit($this->mid);

        $map['title']      = t($_POST['title']);
        $map['address']    = t($_POST['address']);
        //$map['limitCount'] = intval(t( $_POST['limitCount'] ));
        //$map['type']       = intval($_POST['type']);
        $map['explain']    = t($_POST['explain'],true);
        //$map['contact']    = t($_POST['contact']);
        //$map['deadline']   = $this->_paramDate( $_POST['deadline'] );
        $map['sTime']      = $this->_paramDate($_POST['sTime']);
        $map['eTime']      = $this->_paramDate($_POST['eTime']);
        $map['uid']        = $this->mid;
        //$map['name']       = getUserName($this->mid);

        if( $map['sTime'] > $map['eTime'] ) {
            //$this->error( "结束时间不得早于开始时间" );
			echo -1;
			exit;
        }
		if( $map['sTime'] < mktime(0, 0, 0, date('M'), date('D'), date('Y')) ) {
            //$this->error( "开始时间不得早于当前时间" );
			echo -2;
			exit;
        }

        //处理省份，市，区
        //list( $opts['province'],$opts['city'],$opts['area'] ) = explode(" ",$_POST['city']);

        //得到上传的图片
        $config     =   getConfig();
 		$options['userId']		=	$this->mid;
		$options['max_size']    =   $config['photo_max_size'];
		$options['allow_exts']	=	$config['photo_file_ext'];
        $cover	=	X('Xattach')->upload('event',$options);

        //处理选项
        $opts['cost']        = intval( $_POST['cost'] );
        $opts['costExplain'] = t( $_POST['costExplain'] );
        $friend              = isset( $_POST['friend'] )?1:0;
        $allow               = isset( $_POST['allow'] )?1:0;
        $opts['opts']        = array( 'friend'=>$friend,'allow'=>$allow );
        if( $addId = $this->event->doAddEvent( $map,$opts,$cover )) {
            X('Credit')->setUserCredit($this->mid,'add_event');
			//$this->assign('jumpUrl',U('/Index/eventDetail',array('id'=>$addId,'uid'=>$this->mid)));
            //$this->success($this->appName.'添加成功');
			echo U('/Index/eventDetail',array('id'=>$addId,'uid'=>$this->mid));
        }else{
			//$this->error($this->appName.'添加失败');
			echo 0;
		}
    }

    /**
     * doAction
     * 参与活动
     * @access public
     * @return void
     */
    public function doAction() {
        $data['id']   = intval( $_POST['id'] );
        $data['uid']  = $this->mid;
        $allow        = intval( $_POST['allow'] );
        $data['action'] = t( $_POST['action'] );
        $this->event->setMid( $this->mid );
        //检测id和uid是否为0
        if( false == $this->checkUrl( $data ) ) {
            echo -4;
            return;
        }
		//获取活动信息
		$res = M('event')->where("id=".$data['id'])->field("need_verify,need_profile")->find();
		if($res){
			if($res['need_profile']==1 && !D('UserProfile','home')->isUserProfile($this->mid)){
				echo 'profile';
				exit;
			}
			if($res['need_verify']==1){
				$data['action'] = 'verify';
			}
		}else{
			echo 0;
			exit;
		}
		
        echo trim($this->event->doAddUser( $data,$allow ));

    }

    /**
     * doAction
     * 取消参加
     * @access public
     * @return void
     */
    public function doDelAction() {
        $data['id']     = intval( $_POST['id'] );
        $data['uid']    = $this->mid;
        $allow          = intval( $_POST['allow'] );
        $data['action'] = t( $_POST['action'] );
        //检测id和uid是否为0
        if( false == $this->checkUrl( $data ) ) {
            echo -4;
            return;
        }
        echo trim($this->event->doDelUser( $data ));

    }
	
	//审批用户
	function verifyuser() {
		$id = intval($_POST['id']);
		$uid = intval($_POST['uid']);
		if(!$id || !$uid) return ;
		//获取活动信息
		$res = M('event')->where("id={$id}")->field("uid")->find();
		if($this->mid!=$res['uid']){
			echo 0;
		}else{
			if(D('EventUser')->verifyUserToEvent($uid,$id)){
				echo $this->verifyUserTpl($uid,$id);
			}
		}
	}
	
	//审批用户--模板
	function verifyUserTpl($uid,$id){
		$userinfo = getUserBaseInfo($uid);
		$return = '<div class="mb5 hei45 member_list_c_'.$uid.'">
					  <div class="l wid8 tc"><img src="'.$userinfo['face'].'" width="45" height="45" /></div>
					  <div class="l wid75 qz_t4"><b><a href="'.$userinfo['url'].'">'.$userinfo['uname'].'</a></b> '.$userinfo['position'].'<label>'.$userinfo['company'].'</label></div>
					  <div class="r wid15"><a href="javascript:void();" style="color:#2e5194;" onclick="ui.confirm(this,\'确定将其移出活动？\');" callback="removeMember('.$id.','.$uid.');">移出活动</a>
					  </div>
					</div>
					<div class="cl"></div>';
		
		return $return;
	}
	
	//删除活动成员
	function deletemember() {
		$id = intval($_POST['id']);
		$uid = intval($_POST['uid']);
		if(!$id || !$uid) return ;
		//获取活动信息
		$res = M('event')->where("id={$id}")->field("uid")->find();
		if($this->mid!=$res['uid']){
			echo 0;
		}else{
			echo D('EventUser')->deleteMember($uid,$id);
		}
	}
	
    /**
     * eventDetail
     * 活动详细页
     * @access public
     * @return void
     */
    public function eventDetail() {
        $id   = intval($_GET['id']);
		if(!$id){
			if(!$_GET['code']){
				handleErrorByJs("错误的访问页面，请检查链接！",U('event/index'));
			}else{
				$code = base64_decode($_GET['code']);
				$code = explode('-',$code);
				if(md5($code[0].'-'.$code[1].'-yhact') == $code[2]){
					$id = $code[0];
					$invite_uid = $code[1];
				}else{
					handleErrorByJs("错误的访问页面，请检查链接！",U('event/index'));
				}
			}
		}
		
        $this->event->setMid( $this->mid );
        if($result = $this->event->getEventContent($id)){
			//print_r($result);
        	//获取成员数
	        $member = D('EventUser')->getEventUserList($result['id'],10);
            $this->assign('eventmember',$member);
			$this->assign($result);
            //$this->setTitle($result['title']);
            $this->display();
        }else {
            handleErrorByJs("该活动不存在或已被删除！",U('event/index'));
        }
    }

    /**
     * member
     * 活动成员
     * @access public
     * @return void
     */
    public function member() {
        $id   = intval( $_GET['id'] );
        //检测id是否为0
        if(!$id) {
            handleErrorByJs("错误的访问页面，请检查链接",U('event/index'));
        }

        $this->event->setMid( $this->mid );
        if($result = $this->event->getEventContent($id)){
        	//获取成员数
	        $member = D('EventUser')->getEventUserList($result['id'],10);
            $this->assign('eventmember',$member);
			
			//获取成员列表
			$memberlist = D('EventUser')->getEventUserList($result['id'],30,true);
			$this->assign('memberlist',$memberlist);
			
			if($this->mid == $result['uid']){
				$verifylist = D('EventUser')->getVerifyUserList($result['id'],30,true);
				$this->assign('verifylist',$verifylist);
			}
			
			$this->assign($result);
            //$this->setTitle($result['title']);
            $this->display();
        }else {
            handleErrorByJs("错误的访问页面，请检查链接",U('event/index'));
        }
    }
	
	/**
     * 邀请页面
     */
    public function invite() {
        $id   = intval( $_GET['id'] );
        //检测id是否为0
        if(!$id) {
            handleErrorByJs("错误的访问页面，请检查链接",U('event/index'));
        }

        $this->event->setMid( $this->mid );
        if(!$result = $this->event->getEventContent($id)){
			handleErrorByJs("错误的访问页面，请检查链接",U('event/index'));
        }
		
		//获取成员数
		$member = D('EventUser')->getEventUserList($result['id'],10);
		$this->assign('eventmember',$member);
		
		//获取邀请链接
		$code = base64_encode($id.'-'.$this->mid.'-'.md5($id.'-'.$this->mid.'-yhact'));
		$result['invite_url'] = U('event/index/eventDetail',array("code"=>$code));
		
		$this->assign($result);
		//$this->setTitle($result['title']);
		$this->display();
		
    }
	
    /**
     * edit
     * 编辑活动
     * @access public
     * @return void
     */
    public function edit() {
        $id = intval( $_GET['id'] );
        $uid = $this->event->where( 'id='.$id )->getField( 'uid' );
        if( $uid != $this->mid ) {
			handleErrorByJs('您没有权限编辑此活动！',$this->event->getEventUrl('/index/eventDetail',array('id'=>$id)));
        }

        $typeDao = D( 'EventType' );
        $this->event->setMid( $this->mid );
        if($result = $this->event->getEventContent( $id,$uid )) {
			//print_r($result);
            $this->assign( $result );
            $this->display('edit');
        }else {
            handleErrorByJs('该活动不存在或已被删除！',$this->event->getEventUrl('/index/eventDetail',array('id'=>$id)));
        }

    }

    /**
     * doEditEvent
     * 修改活动
     * @access public
     * @return void
     */
    public function doEditEvent() {
        $id['id'] = intval( $_POST['id'] );
        $id['optsId'] = intval( $_POST['optsId'] );
        $map['title']      = t($_POST['title']);
        $map['address']    = t($_POST['address']);
        $map['limitCount'] = intval(t( $_POST['limitCount'] ));
        $map['type']       = intval($_POST['type']);
        $map['explain']    = t($_POST['explain'],true);
        $map['contact']    = t($_POST['contact']);
        //$map['deadline']   = $deadline = $this->_paramDate( $_POST['deadline'] );
        $map['sTime']      = $stime = $this->_paramDate($_POST['sTime']);
        $map['eTime']      = $etime = $this->_paramDate($_POST['eTime']);
        $old_cover['status']  = true;
        $old_cover['info'][0]['id'] = intval( $_POST['old_cover'] );

        if( $stime > $etime ){
            echo -1;
            exit;
        }
        if( !$stime || !$etime ) {
            echo -2;
            exit;
        }

        //处理省份，市，区
        list( $opts['province'],$opts['city'],$opts['area'] ) = explode( " ",$_POST['city']);;

        //得到上传的图片
        $config     =   getConfig();
 		$options['userId']		=	$this->mid;
		$options['max_size']    =   $config['photo_max_size'];
		$options['allow_exts']	=	$config['photo_file_ext'];
        $cover = $_FILES['cover']['size']>0?X('Xattach')->upload('event',$options):$old_cover;

        //处理选项
        $opts['cost']        = intval( $_POST['cost'] );
		$opts['rTime']       = time();
        $opts['costExplain'] = t( $_POST['costExplain'] );
        $friend              = isset( $_POST['friend'] )?1:0;
        $allow               = isset( $_POST['allow'] )?1:0;
        $opts['opts']        = array( 'friend'=>$friend,'allow'=>$allow );
        if($this->event->doEditEvent( $map,$opts,$cover,$id )){
        	echo $this->event->getEventUrl('/index/eventDetail',array('id'=>$id['id']));
		}
    }

    /**
     * doEndAction
     * 结束活动
     * @access public
     * @return void
     */
    public function doEndAction() {
        $id = $_POST['id'];
        $this->event->setMid( $this->mid );
        echo $this->event->doEditData( time(),$id );
    }

    /**
     * doAgreeAction
     * 同意申请
     * @access public
     * @return void
     */
    public function doAgreeAction() {
        $data['id']      = intval( $_POST['id'] );
        $data['eventId'] = intval( $_POST['eventId'] );
        $data['uid']     = intval( $_POST['uid'] );

        //检查操作权限
        if( $this->mid != D('Event')->getField('uid',"id={$data['eventId']}") ){
            echo  -4;
            return;
        }

        //检测id和uid是否为0
        if( false == $this->checkUrl( $data ) ) {
            echo -4;
            return;
        }
        echo trim($this->event->doArgeeUser( $data));
    }

    /**
     * doAdminAction
     * 删除成员
     * @access public
     * @return void
     */
    public function doAdminAction() {
        $admin          = t( $_POST['admin'] );
        $data['uid']    = intval( $_POST['uid'] );      //被操作的用户
        $data['id']     = intval( $_POST['eventId'] );  //被操作的活动
        $data['action'] = t( $_POST['action'] );    //被操作的用户的动作

        //检查操作权限
        if( $this->mid != D('Event')->getField('uid',"id={$data['id']}") ){
        	echo  -4;
        	return;
        }

        //检查链接合法性
        if( !$this->checkUrl( $data ) ) {
            echo -4;
            return;
        }
        switch ( $admin ) {
            case 'user':   //成员管理
                echo $this->event->doDelUser( $data );
                return;
                break;
            default:
        //TODO 更多的操作
        }

    }

	/**
	 * doDeleteEvent 
	 * 删除活动
	 * @access public
	 * @return void
	 */
	public function doDeleteEvent(){
		$eventid['id']  = intval($_POST['id']);    //要删除的id.
		$eventid['uid'] = $this->mid;
		$result         = $this->event->doDeleteEvent($eventid);
		if( false != $result){
			echo 1;
		}else{
			echo 0;
		}
	}

    /**
     * _paramDate
     * 解析日期
     * @param mixed $date
     * @access private
     * @return void
     */
    private function _paramDate( $date ) {
        $date_list = explode( ' ',$date );
        list( $year,$month,$day ) = explode( '-',$date_list[0] );
        list( $hour,$minute,$second ) = explode( ':',$date_list[1] );
        return mktime( $hour,$minute,$second,$month,$day,$year );
    }

    /**
     * checkUrl
     * 检查url参数是否合法
     * @param array $data
     * @access public
     * @return void
     */
    public function checkUrl(array $data ) {
        $count1 = count( $data );
        $count2 = count( array_filter( $data ));
        if( $count2 < $count1 ) {
            return false;
        }else {
            return true;
        }
    }

    /**
     * upload
     * 上传图片
     * @access public
     * @return void
     */
    /*public function upload() {
        $eventId = intval($_GET['eventId']);
        //检查空
        if( empty($eventId) || 0 === $eventId ) {
            $this->error( '没有传入' );
        }

        //检查是否有有这个活动
        if( false === $event = $this->event->where( 'id='.$eventId )->field( 'id,title,uid' )->find() ) {
            $this->error( '没有您请求的页面，请检查链接' );
        }

        //检查是否访问者有权限上传图片
        $action = $this->event->hasMember( $this->mid,$eventId );

        switch ( getConfig( 'membel' ) ) {
            case 0:
                ('attention' == $action['action'] || false == $action || 1 != $action['status']) && $this->error( "只允许{$this->appName}参与者上传照片" );
                break;
            case 1;
                ('admin' != $action['action'] || false == $action) && $this->error( "只允许{$this->appName}创建者者上传照片" );
                break;
            default:
                $this->error( '错误的配置信息' );
        }
        $this->assign( $event );

        $this->display();

    }*/

    /**
     * upload
     * flash上传图片
     * @access public
     * @return void
     */
    /*public function flash() {
        $eventId = intval($_GET['eventId']);
        //检查空
        if( empty($eventId) || 0 === $eventId ) {
            $this->error( '没有传入' );
        }

        //检查是否有有这个活动
        if( false === $event = $this->event->where( 'id='.$eventId )->field( 'id,title,uid' )->find() ) {
            $this->error( '没有您请求的页面，请检查链接' );
        }

        //检查是否访问者有权限上传图片
        $action = $this->event->hasMember( $this->mid,$eventId );

        switch ( getConfig( 'membel' ) ) {
            case 0:
                ('attention' == $action['action'] || false == $action || 1 != $action['status']) && $this->error( "只允许{$this->appName}参与者上传照片" );
                break;
            case 1;
                ('admin' != $action['action'] || false == $action) && $this->error( "只允许{$this->appName}创建者者上传照片" );
                break;
            default:
                $this->error( '错误的配置信息' );
        }
        $this->assign( $event );

        $this->display();
    }*/

    /**
     * upload_muti_pic
     * 普通上传图片
     * @access public
     * @return void
     */
    /*public function upload_muti_pic(  ) {
    //上传图片
        $cover = $this->api->attach_upload( 'event_photo' );

        $dao   = D( 'EventPhoto' );
        $dao->setMid( $this->mid );

        $data  = array();
        //存储图片
        if( true === $cover['status'] &&
            $result = $dao->addPhoto( $cover['info'] ,              //相册信息
            intval( $_POST['eventId'] ),  //活动Id
            $this->my_name)                        //用户信息
        ) {
            $this->success( '添加成功' );
        }else {
            $cover['status']?$this->error( '添加失败' ):$this->error( $cover['info'] );
        }

    }*/

    /**
     * upload_single_pic
     * 执行单照片上传
     * @access public
     * @return void
     */
   /*public function upload_single_pic() {
    //上传图片
        $photos = $this->api->attach_upload( 'event_photo' );
        $dao   = D( 'EventPhoto' );
        $dao->setMid( $this->mid );

        if($photos['status']  &&
            $result = $dao->addPhoto( $photos['info'] ,              //相册信息
            1,//intval( $_POST['eventId'] ),  //活动Id
            $this->my_name)                        //用户信息)
        ) {
            echo "Flash requires that we output something or it won't fire the uploadSuccess event";
        }else {
            echo "There was a problem with the upload";
            exit(0);
        }
    }*/

    /**
     * photos
     * 相册列表
     * @access public
     * @return void
     */
    /*public function photos() {
        $id = t($_GET['id']);
        $uid = t($_GET['uid']);
        //检查合法性
        if (false === $this->checkUrl( array( $id,$uid ) ))
            $this->error( "错误的地址，请检查链接" );
        //检查是否有这个活动
        if( false === $result = $this->event->where( 'id='.$id.' AND uid='.$uid )->find() ) {
            $this->error( "没有您提交的{$this->appName}" );
        }
        //获得相片
        $photos = D( 'EventPhoto' )->where( 'eventId = '.$id )->order('id DESC')->findPage(20);
        //组装链接地址
        foreach( $photos['data'] as &$value ) {
            $value['path']  = sprintf( '%s/thumb.php?&w=130&h=87&url=%s%s%s',SITE_URL,UPLOAD_URL,$value['filepath'],$value['filename'] );
        }
        $this->assign( $result );
        $this->assign( $photos );
        $this->display();

    }*/


    //显示一张照片
    /*public function photo() {

        $id		=	intval($_REQUEST['id']);
        $aid	=	intval($_REQUEST['aid']);
        $uid	=	intval($_REQUEST['uid']);
        $eventId = intval( $_REQUEST['eid'] );

        //$type	=	t($_REQUEST['type']);	//照片来源类型，来自某相册，还是其它的

        //判断来源类型
        //if(!empty($type) && !in_array($type,array('album','mAll','fAll'))){
        //$this->error('错误的链接！');
        //}
        //$this->assign('type',$type);

        //获取照片信息
        $photo	=	D('EventPhoto')->where(" id='$id' AND eventId='$eventId' ")->find();
        $this->assign('photo',$photo);
        //验证照片信息是否正确
        if(!$photo) {
            $this->error('照片不存在或已被删除！');
        }

        //获取所有照片数据
        $photos	=	D('EventPhoto')->where( " eventId = '$eventId'" )->findAll();
        $this->assign('photos',$photos);


        //获取活动信息
        $event = D( 'Event' )->where( "id = '$eventId'" )->find();
        $event['cover'] = $temp_cover?UPLOAD_URL.$temp_cover:C( 'TS_URL' ).'/public/theme_default/images/hdpic1.gif';

        $this->assign( $event );


        //获取上一页 下一页 和 预览图
        if($photos) {
            foreach($photos as $v) {
                $photoIds[]	=	intval($v['id']);
            }
            $photoCount	=	count($photoIds);

            //颠倒数组，取索引
            $pindex		=	array_flip($photoIds);

            //当前位置索引
            $now_index	=	$pindex[$id];

            //上一张
            $pre_index	=	$now_index-1;
            if( $now_index <= 0 ) {
                $pre_index	=	$photoCount-1;
            }
            $pre_photo	=	$photos[$pre_index];

            //下一张
            $next_index	=	$now_index+1;
            if( $now_index >= $photoCount-1 ) {
                $next_index	=	0;
            }
            $next_photo	=	$photos[$next_index];

            //预览图的位置索引
            $start_index	=	$now_index - 2;
            if( ($photoCount+1-$now_index)<2) {
                $start_index	=	($photoCount+1-5);
            }
            if($start_index<0) {
                $start_index	=	0;
            }

            //取出预览图列表 最多5个
            $preview_photos	=	array_slice($photos,$start_index,5);
        }else {
            $this->error('照片列表数据错误！');
        }

        $this->assign('photoCount',$photoCount);
        $this->assign('now',$now_index+1);
        $this->assign('pre',$pre_photo);
        $this->assign('next',$next_photo);
        $this->assign('previews',$preview_photos);

        unset($pindex);
        unset($photos);
        unset($album);
        unset($preview_photos);
        $this->display();
    }*/

    /*public function editPhoto() {
        $id   = intval( $_POST['id'] );
        $name = t($_POST['name']);
        if( D( 'EventPhoto' )->editName( $id,$name ) ) {
            echo 1;
        }else {
            echo 0;
        }
    }*/
}

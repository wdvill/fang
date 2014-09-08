<?php 
class IndexAction extends Action{
    
	function init(){
		//echo './Public/miniblog.js';
	}
    
	function index(){
		$key = $this->__getSearchKey();
		if($key){
			$data ['list'] = D('Operate')->doSearchWeibo($key);
		}else{
			// 关注的分组列表
			$data ['gid'] = is_numeric ( $_GET ['gid'] ) ? $_GET ['gid'] : 'all';
			$group_list = D ( 'FollowGroup', 'weibo' )->getGroupList ( $this->uid );
			if (! empty ( $group_list )) { // 关注分组
				$group_count = count ( $group_list );
				for($i = 0; $i < $group_count; $i ++) {
					if ($group_list [$i] ['follow_group_id'] != $data ['gid']) {
						$group_list [$i] ['title'] = (strlen ( $group_list [$i] ['title'] ) + mb_strlen ( $group_list [$i] ['title'], 'UTF8' )) / 2 > 8 ? getShort ( $group_list [$i] ['title'], 3 ) . '...' : $group_list [$i] ['title'];
					}
					if ($i < 2) {
						$data ['group_list_1'] [] = $group_list [$i];
					} else {
						if ($group_list [$i] ['follow_group_id'] == $data ['gid']) {
							$data ['group_list_1'] [2] = $group_list [$i];
							continue;
						}
						$data ['group_list_2'] [] = $group_list [$i];
					}
				}
				if (empty ( $data ['group_list_1'] [2] ) && ! empty ( $data ['group_list_2'] [0] )) {
					$data ['group_list_1'] [2] = $data ['group_list_2'] [0];
					unset ( $data ['group_list_2'] [0] );
				}
			}
			
			$data ['list'] = D('Operate')->getHomeList ( $this->mid, $strType, '', 20, $data ['gid'] );
			
			// 最新一条微博的Id (countNew时使用)
			if (is_numeric ( $data ['gid'] )) {
				$lastWeibo = D ( 'Operate', 'weibo' )->getHomeList ( $this->mid, $strType, '', 1, '' );
				$data ['lastId'] = $lastWeibo ['data'] [0] ['id'];
			} else {
				$data ['lastId'] = $data ['list'] ['data'] [0] ['id'];
			}
		}
		
		$this->assign( $data );
        $this->display();
	}
    
	//我发布的
	function mine(){
		$data ['list'] = D('Operate')->getSpaceList($this->mid);
		
		//判断用户是否绑定
		$data['login_bind'] = D("User","home")->checkPlatformBind($this->mid);
		
		$this->assign( $data );
        $this->display();
	}
	
	//我评论的
	function mycomment(){
		$data ['list'] = D('Operate')->getMyCommentList($this->mid);
		//print_r($data ['list']);
		$this->assign( $data );
        $this->display();
	}
	
	//我关注的
	function myfollow(){
		$data ['list'] = D('Operate')->getMyFollowList($this->mid);
		//print_r($data ['list']);
		$this->assign( $data );
        $this->display();
	}
	
	//我收藏的
	function mycollect(){
		$data ['list'] = D('Operate')->getCollection($this->mid);
		//print_r($data ['list']);
		$this->assign( $data );
        $this->display();
	}
	
	//群组里的
	function mygroup(){
		$data ['list'] = D('Operate')->getMyGroupList($this->mid);
		//print_r($data ['list']);
		$this->assign( $data );
        $this->display();
	}
	
	//@我的
	function atme(){
		$data ['list'] = D('Operate')->getAtme($this->mid);
		//print_r($data ['list']);
		$this->assign( $data );
        $this->display();
	}
    //加载评论
    function loadcomment(){
        $intMinId = intval( $_POST['id'] );
        $data['weibo_id'] = $intMinId;
        $data['quick_reply'] = intval($_POST['quick_reply']);
        $data['quick_reply_uname'] = t($_POST['quick_reply_uname']);
        $data['quick_reply_comment_id'] = intval($_POST['quick_reply_comment_id']);
        $data['callback'] = t($_POST['callback']);
        $data['data']  = D('Operate')->where('weibo_id='.$intMinId)->find();
        $data['privacy'] = D('UserPrivacy','home')->getPrivacy($this->mid,$data['data']['uid']);
        $data['randtime'] = ($data['quick_reply_comment_id'])?$data['quick_reply_comment_id']:$data['data']['weibo_id'] ;
        if(!$data['quick_reply']) $data['list']['data'] =  D('Comment')->getComment($intMinId);
        $this->assign( $data );
        $this->display();
    }
    
    //加载更多的
    function loadmore(){
    	$data['type'] = $_POST['type'];
    	$data['gid']  = $_POST['gid'];
    	$data['list'] = D('Operate')->getHomeList($this->mid,$data['type'],$_POST['since'],$_POST['limit'],$data['gid']);
    	$this->assign($data);
    	$this->display();
    }
    
    function loadnew(){
    	// 每120秒刷新一次!
    	if ( !lockSubmit('120') ) {
    		exit('<TSAJAX>');
    	}
    	$data['showfeed'] = intval($_REQUEST['showfeed']);
    	$data['list'] = D('Operate')->loadNew($this->mid,$_POST['since'],$_POST['limit'],$data['showfeed']);
    	$this->assign($data);
    	
    	// NO unlockSubmit(); !!!
    	
    	$this->display('loadmore');
    }
    
    //查看最新的
    function countnew(){
    	$data['showfeed'] = intval($_REQUEST['showfeed']);
    	$data['lastId'] = intval($_POST['lastId']);
    	$list = D('Operate')->countNew($this->mid,$data['lastId'],$data['showfeed']);
    	$data['since'] = $list[0]['weibo_id'];
    	$data['limit'] = count($list);
    	$this->assign($data);
    	$this->display();
    }
    
    //@xxx
    function searchuser(){
    	$name = t($_REQUEST['n']);
    	$list = M('user')->where("uname LIKE '{$name}%'")->field('uid,uname')->findall();
    	exit( json_encode($list));
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
			$_SESSION ['weibo_search_key'] = serialize ( $key );
		
		} else if (is_numeric ( $_GET [C ( 'VAR_PAGE' )] )) {
			$key = unserialize ( $_SESSION ['weibo_search_key'] );
		
		} else {
			//unset($_SESSION['weibo_search_key']);
		}
		
		return trim ( $key );
	}
}
?>
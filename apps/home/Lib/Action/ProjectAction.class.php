<?php
/*
项目操作类
*/
class ProjectAction extends Action {
	
	private $pro_id = 0;
	
	public function _initialize() {
		if($_GET['pro_id']){
			$this->pro_id = $_GET['pro_id'];
		} elseif ($_POST['pro_id']){
			$this->pro_id = $_POST['pro_id'];
		}else{
			$this->pro_id = $this->pro_id;
		}
	}
	
	//所有的项目列表
	public function index() {
		//得到项目分类和资金规模
		$data = M('project')->where( array( 'status'=>1))->order('`pro_id` DESC')->findPage(5);
		$this->assign('data', $data);
		$data3 = M('project_cate')->order('`cate_id` ASC')->findAll();  
		foreach ($data3 as $v){
			$catearr[$v['cate_id']] = $v['name'];	
		}
		$this->assign('project_cate', $catearr);
		$data4 = M('project_capital')->order('`cap_id` ASC')->findAll();  
		foreach ($data4 as $v){
			$catearr4[$v['cap_id']] = $v['name'];	
		}
		$this->assign('project_capital', $catearr4);

		$new_project = $this->new_project();
		$hot_project = $this->hot_project();
		$this->assign('new_project',$new_project);
		$this->assign('hot_project',$hot_project);
		$this->assign('data', $data);
		$this->display();
	}
	
	//自己发布的项目
	public function my_project() {
		//得到项目分类和资金规模
		$uid = $this->mid;
		$data = M('project')->where( array( 'uid'=>intval($uid)))->order('`pro_id` DESC')->findPage(5);
		$this->assign('data', $data);
		$data3 = M('project_cate')->order('`cate_id` ASC')->findAll();  
		foreach ($data3 as $v){
			$catearr[$v['cate_id']] = $v['name'];	
		}
		$this->assign('project_cate', $catearr);
		$data4 = M('project_capital')->order('`cap_id` ASC')->findAll();  
		foreach ($data4 as $v){
			$catearr4[$v['cap_id']] = $v['name'];	
		}
		$this->assign('project_capital', $catearr4);

		$new_project = $this->new_project();
		$hot_project = $this->hot_project();
		$this->assign('new_project',$new_project);
		$this->assign('hot_project',$hot_project);
		$this->assign('data', $data);
		$this->display();
	}
	
	//收藏的项目
	public function fav_project() {
		//得到项目分类和资金规模
		$uid = $this->mid;
		$data1 = M('project_collect')->where( array( 'uid'=>intval($uid),'status'=>1))->order('`id` DESC')->findAll();
		foreach ($data1 as $v){
			$proids = $proids.$v['pro_id'].",";	
		}
		$proids = substr($proids,0,-1);
		$data = M('project')->where( 'pro_id in ('.$proids.')')->order('`pro_id` DESC')->findPage(5);
		$this->assign('data', $data);
		$data3 = M('project_cate')->order('`cate_id` ASC')->findAll();  
		foreach ($data3 as $v){
			$catearr[$v['cate_id']] = $v['name'];	
		}
		$this->assign('project_cate', $catearr);
		$data4 = M('project_capital')->order('`cap_id` ASC')->findAll();  
		foreach ($data4 as $v){
			$catearr4[$v['cap_id']] = $v['name'];	
		}
		$this->assign('project_capital', $catearr4);

		$new_project = $this->new_project();
		$hot_project = $this->hot_project();
		$this->assign('new_project',$new_project);
		$this->assign('hot_project',$hot_project);
		$this->assign('data', $data);
		$this->display();
	}
	
	//添加项目界面
	public function post_project() {
		//得到项目分类和资金规模
		$data3 = M('project_cate')->order('`cate_id` ASC')->findAll();  
		$this->assign('project_cate', $data3);
		$data4 = M('project_capital')->order('`cap_id` ASC')->findAll();  
		$this->assign('project_capital', $data4);


		$new_project = $this->new_project();
		$hot_project = $this->hot_project();
		$this->assign('new_project',$new_project);
		$this->assign('hot_project',$hot_project);
		$this->display();
	}
	
	//修改项目界面
	public function modiproject() {
		//得到项目分类和资金规模
		$data3 = M('project_cate')->order('`cate_id` ASC')->findAll();  
		$this->assign('project_cate', $data3);
		$data4 = M('project_capital')->order('`cap_id` ASC')->findAll();  
		$this->assign('project_capital', $data4);

		$data = M('project')->where( array( 'pro_id'=>intval($this->pro_id)))->find();
		$data['intro'] = htmlspecialchars_decode($data['intro']);
		$this->assign('data', $data);

		$new_project = $this->new_project();
		$hot_project = $this->hot_project();
		$this->assign('new_project',$new_project);
		$this->assign('hot_project',$hot_project);
		$this->display();
	}
	
	//修改项目
	public function modi_project() {
		$project['cap_id'] = $_POST['cap_id'];
		$project['cate_id'] = $_POST['cate_id'];
		$project['title'] = $_POST['title'];
		$project['intro'] = t($_POST['intro'],true);
		$project['uid'] = $this->mid;
		$project['ctime'] = time();
		$project['pro_id'] = $this->pro_id;
		if (strlen($project['title'])==0){
		    //handleErrorByJs('项目标题不能为空！',U('home/project/post_project'));
			echo -1;
			exit;
		}
		if (!intval($project['cate_id'])){
			echo -2;
			exit;
		}
		if (strlen($project['intro'])==0){
		    //handleErrorByJs('项目描述不能为空！',U('home/project/post_project'));
			echo -3;
			exit;
		}
		// 项目海报
		$options['userId']		=	$this->mid;
		$options['max_size']    =   8*1024*1024;  //8MB
		$options['allow_exts']	=	'jpg,gif,png,jpeg,bmp';
		$info	=	X('Xattach')->upload('project_logo',$options);
		if($info['status']) {
			$project['instruction'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];
		}else{
			$project['instruction'] = '';
		}
		
		if(!M('project')->where("pro_id={$this->pro_id} AND uid={$this->mid}")->count()){
			echo -4;
			exit;
		}
		$res = M('project')->save($project);
		//echo "title=".$_POST['title'].",cap_id=".$_POST['cate_id'].",intro=".$_POST['intro'];
		if ($res){
			echo U('home/project/my_project');
		}else {
			echo 0;
		}
		
	}
	
	//添加项目
	public function add_project() {
		$project['cap_id'] = $_POST['cap_id'];
		$project['cate_id'] = $_POST['cate_id'];
		$project['title'] = $_POST['title'];
		$project['intro'] = t($_POST['intro'],true);
		if (strlen($project['title'])==0){
		    //handleErrorByJs('项目标题不能为空！',U('home/project/post_project'));
			echo -1;
			exit;
		}
		if (!intval($project['cate_id'])){
			echo -2;
			exit;
		}
		if (strlen($project['intro'])==0){
		    //handleErrorByJs('项目描述不能为空！',U('home/project/post_project'));
			echo -3;
			exit;
		}
		$project['uid'] = $this->mid;
		$project['ctime'] = time();
		//项目海报
		$options['userId']		=	$this->mid;
		$options['max_size']    =   8*1024*1024;  //2MB
		$options['allow_exts']	=	'jpg,gif,png,jpeg,bmp';
		$info	=	X('Xattach')->upload('project_logo',$options);
		if($info['status']) {
			$project['instruction'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];
		}else{
			$project['instruction'] = '';
		}

		$pro_id = M('project')->add($project);
		//echo "title=".$_POST['title'].",cap_id=".$_POST['cate_id'].",intro=".$_POST['intro'];
		if ($pro_id){
			//$this->assign('jumpUrl', U('home/project/my_project'));
			//$this->success('保存成功');
			// 积分操作
			X('Credit')->setUserCredit($this->mid, 'add_project');
			
			echo U('home/project/my_project');
		}else {
			//$this->assign('jumpUrl', U('home/project/post_project'));
			//$this->success('保存失败');
			echo 0;
		}
		
	}
	
	//项目详情
	public function project_detail() {
		
		$data = M('project')->where( array( 'pro_id'=>intval($this->pro_id)))->order('`pro_id` DESC')->find();
		$data['browsecount'] = intval($data['browsecount'])+1;
		$data['intro'] = htmlspecialchars_decode($data['intro']);
		$this->assign('data', $data);
		
		//更新访问次数
		$_POST['browsecount'] = intval($data['browsecount']);
		$_POST['pro_id'] = $this->pro_id;
		$res = M('project')->save($_POST);
		
		//得到项目分类和资金规模
		$uid = $this->mid;
		$user = getUserBaseInfo($uid);
		$this->assign('user', $user);
		$uid = $data['uid'];
		$user2 = getUserBaseInfo($uid);
		$this->assign('create_user', $user2);
		$data3 = M('project_cate')->order('`cate_id` ASC')->findAll();  
		foreach ($data3 as $v){
			$catearr[$v['cate_id']] = $v['name'];	
		}
		$this->assign('project_cate', $catearr);
		$data4 = M('project_capital')->order('`cap_id` ASC')->findAll();  
		foreach ($data4 as $v){
			$catearr4[$v['cap_id']] = $v['name'];	
		}
		$comment = $this->project_comment();
		
		//判断是否已经收藏
		$data5 = M('project_collect')->where( array( 'pro_id'=>intval($this->pro_id),'uid'=>intval($this->mid)))->find();
		if ($data5){
			$this->assign("iscollect",$data5['id']);
		} else {
			$this->assign("iscollect",'0');
		}
		
		$this->assign("comment",$comment);
		$this->assign('project_capital', $catearr4);
		$this->assign('user',$user);

		$this->display();
	}
	
	//项目评论
	public function project_comment() {
		$data1 = M('project_comment')->where( array( 'pro_id'=>intval($this->pro_id)))->order('`id` DESC')->findAll();
		foreach ($data1 as $v){
			$comment2[$v['id']]['content'] = htmlspecialchars_decode($v['content']);	
			$comment2[$v['id']]['ctime'] = $v['ctime'];
			$uid = $v['uid'];
			$user = getUserBaseInfo($uid);
			if ($user){
				$comment2[$v['id']]['username'] = $user['uname'];
				$comment2[$v['id']]['userface'] = $user['face'];
				$comment2[$v['id']]['datetime'] = $user['ctime'];
				$comment2[$v['id']]['userurl'] = $user['url'];
			} else {
				$comment2[$v['id']]['username'] = '用户已删除';
				$comment2[$v['id']]['userface'] = getUserFace(0,'s');
				$comment2[$v['id']]['userurl'] = '';
			}
			$total = $total + 1;
		}
		$comment['data'] = $comment2;
		$comment['total'] = $total;
		
		return $comment;
	}
	
	//添加项目评论
	public function add_project_comment() {
		$_POST['uid'] = $this->uid;
		$_POST['content'] = h(t($_POST['content'],true));
		$_POST['pro_id'] = $this->pro_id;
		$_POST['ctime'] = time();
		$id = M('project_comment')->add($_POST);
		if ($id){
			$this->assign('jumpUrl', U('home/project/project_detail',array('pro_id'=>$this->pro_id)));
			$this->success('保存成功');
		} else {
			$this->error('保存失败');
		}
	}
	
	// 项目搜索
	function search() {
		$search_key = $this->_getSearchKey();

		if ($search_key) {
			$data = M('project')->where( "title like '%$search_key%' and status=1")->order('`pro_id` DESC')->findPage(10);
		}
		$data3 = M('project_cate')->order('`cate_id` ASC')->findAll();  
		foreach ($data3 as $v){
			$catearr[$v['cate_id']] = $v['name'];	
		}
		$this->assign('project_cate', $catearr);
		$data4 = M('project_capital')->order('`cap_id` ASC')->findAll();  
		foreach ($data4 as $v){
			$catearr4[$v['cap_id']] = $v['name'];	
		}
		$this->assign('project_capital', $catearr4);
		$this->assign('data', $data);
        $this->setTitle("项目搜索");
    	$this->display();
    }	

    protected function _getSearchKey($key_name = 'k'){
	    	$key = '';
		    // 为使搜索条件在分页时也有效，将搜索条件记录到SESSION中
			if ( isset($_REQUEST[$key_name]) && !empty($_REQUEST[$key_name]) ) {
				if($_GET[$key_name]){
					$key = html_entity_decode( urldecode($_GET[$key_name]) ,ENT_QUOTES);
				}elseif($_POST[$key_name]){
					$key = $_POST[$key_name];
				}
				// 关键字不能超过30个字符
				if ( mb_strlen($key, 'UTF8') > 30 )
					$key = mb_substr($key, 0, 30, 'UTF8');
				$_SESSION['group_search_' . $key_name] = serialize( $key );
			}else if ( is_numeric($_GET[C('VAR_PAGE')]) ) {
				$key = unserialize( $_SESSION['project_search_' . $key_name] );
			}			
        	$this->assign('search_key', h(t($key)));
			return trim($key);
	    }
	
	//项目收藏
	public function add_fav() {
		$_POST['uid']= $this->mid;
		$_POST['pro_id']= $this->pro_id;
		$_POST['status']= 1;
		$_POST['ctime'] = time();
		if ($_POST['iscollect'] == '0'){
			$res = M('project_collect')->add($_POST);
		} else {
			$res = M('project_collect')->delete(intval($_POST['iscollect']));
		}
		if($res) {
			$this->assign('jumpUrl', U('home/project/project_detail',array('pro_id'=>$this->pro_id)));
			$this->success('保存成功');
		}else {
			$this->error('保存失败');
		}
		
		$this->display();
	}


	//删除项目
	function delProject() {
		if (M('project')->delete(intval($this->pro_id))){
			// 积分操作
			X('Credit')->setUserCredit($this->mid, 'delete_project');
			$this->assign('jumpUrl', U('home/project/my_project'));
			$this->success('删除成功');
		} else {
			$this->assign('jumpUrl', U('home/project/index'));
			$this->error('删除失败');
		}
	}


   	//最新项目列表
	//Limitnum为最新项目个数，默认为3个。
	public function new_project($limitnum=5) {
		//得到项目分类和资金规模
		$data = M('project')->where( array( 'status'=>1))->order('`pro_id` DESC')->limit($limitnum)->findAll();
		return $data;
	}
	
	//最热项目列表
	//Limitnum为最热项目个数，默认为3个。
	public function hot_project($limitnum=5) {
		//得到项目分类和资金规模
		$data = M('project')->where( array( 'status'=>1))->order('`browsecount` DESC')->limit($limitnum)->findAll();
		return $data;
	}

}
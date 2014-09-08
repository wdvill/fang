<?php
/*
博客操作类
*/
class BlogAction extends Action {
	
	private $id = 0;
	
	public function _initialize(){
		if($_GET['id']){
			$this->id = $_GET['id'];
		} elseif ($_POST['id']){
			$this->id = $_POST['id'];
		}
	}
	
	//所有的博客列表
	public function index() {
		//得到博客分类
		$data3 = M('blog_category')->order('`id` ASC')->findAll();  
		foreach ($data3 as $v){
			$catearr[$v['id']] = $v['name'];	
		}
		$this->assign('blog_category', $catearr);

		//$new_blog = $this->new_blog();
		//$hot_blog = $this->hot_blog();
		$hot_bloger = $this->hot_bloger();
		//$this->assign('new_blog',$new_blog);
		//$this->assign('hot_blog',$hot_blog);
		$this->assign('hot_bloger',$hot_bloger);
		$data = M('blog')->where( array( 'status'=>1))->order('`id` DESC')->findPage(5);
		$this->assign('data', $data);
		$this->display();
	}
	
	//自己发布的博客
	public function my_blog() {
		$uid = $this->mid;
		$data3 = M('blog_category')->order('`id` ASC')->findAll();  
		foreach ($data3 as $v){
			$catearr[$v['id']] = $v['name'];	
		}
		$this->assign('blog_category', $catearr);

		//$new_blog = $this->new_blog();
		//$hot_blog = $this->hot_blog();
		$hot_bloger = $this->hot_bloger();
		//$this->assign('new_blog',$new_blog);
		//$this->assign('hot_blog',$hot_blog);
		$this->assign('hot_bloger',$hot_bloger);
		$data = M('blog')->where( array( 'uid'=>intval($uid)))->order('`id` DESC')->findPage(5);
		$this->assign('data', $data);
		$this->display();
	}
	
	//修改博客界面
	public function modiblog() {
		$data3 = M('blog_category')->order('`id` ASC')->findAll();  
		$this->assign('blog_category', $data3);

		$data = M('blog')->where( array( 'id'=>intval($this->id)))->find();
		$data['content'] = htmlspecialchars_decode($data['content']);
		$this->assign('data', $data);

		//$new_blog = $this->new_blog();
		//$hot_blog = $this->hot_blog();
		$hot_bloger = $this->hot_bloger();
		//$this->assign('new_blog',$new_blog);
		//$this->assign('hot_blog',$hot_blog);
		$this->assign('hot_bloger',$hot_bloger);
		$this->display();
	}
	
	//修改博客
	public function modi_blog() {
		$blog['id'] = $_POST['id'];
		$blog['title'] = h(t(trim($_POST['title'])));
		$blog['content'] = t(trim($_POST['content']));
		$blog['uid'] = $this->mid;
		$blog['cTime'] = time();
		//参数验证
		if(strlen($blog['title'])<=0 || strlen($blog['title'])>150){
			handleErrorByJs('博客标题不能为空，且50字以内！',-1);
		}
		if(strlen($blog['content'])<30){
			handleErrorByJs('博客内容不能少于10个字！',-1);
		}
		
		$blog['category'] = $_POST['category'];
		$data3 = M('blog_category')->findAll();  
		foreach ($data3 as $v){
			if ($v['id'] == $blog['category']){
				$blog['category_title'] = $v['name'];
			}
		}
		
		$res = M('blog')->save($blog);
		if ($res){
			handleErrorByJs('博客修改成功！',U('home/blog/my_blog'));
		}else {
			handleErrorByJs('博客修改失败！');
		}
		
	}
		
	//添加博客界面
	public function post_blog() {
		$data3 = M('blog_category')->order('`id` ASC')->findAll();  
		$this->assign('blog_category', $data3);


		//$new_blog = $this->new_blog();
		//$hot_blog = $this->hot_blog();
		$hot_bloger = $this->hot_bloger();
		//$this->assign('new_blog',$new_blog);
		//$this->assign('hot_blog',$hot_blog);
		$this->assign('hot_bloger',$hot_bloger);
		$this->display();
	}
	
	//添加博客
	public function add_blog() {
		$content_len = real_strip_tags(trim($_POST['content']));
		$blog['title'] = t(trim($_POST['title']));
		$blog['content'] = t(trim($_POST['content']));
		$blog['uid'] = $this->mid;
		$blog['cTime'] = time();
		//参数验证
		if(strlen($blog['title'])<=0 || strlen($blog['title'])>150){
			handleErrorByJs('博客标题不能为空，且50字以内！',-1);
		}
		if($content_len<30){
			handleErrorByJs('博客内容不能少于10个字！',-1);
		}
		
		$blog['category'] = $_POST['cate_id'];
		$data3 = M('blog_category')->findAll();  
		foreach ($data3 as $v){
			if ($v['id'] == $blog['category']){
				$blog['category_title'] = $v['name'];
			}
		}

		$id = M('blog')->add($blog);
		if ($id){
			//积分操作
			X('Credit')->setUserCredit($this->mid, 'add_blog');
			handleErrorByJs('博客发布成功！',U('home/blog/my_blog'));
		}else {
			handleErrorByJs('博客发布失败！');
		}
		
	}
	
	//博客详情
	public function blog_detail() {
		
		$data = M('blog')->where( array( 'id'=>intval($this->id)))->order('`id` DESC')->find();
		$data['readCount'] = intval($data['readCount'])+1;
		$data['content'] = htmlspecialchars_decode($data['content']);
		$this->assign('blog', $data);
		
		//更新访问次数
		if($this->mid != $data['uid']){
			$_POST['readCount'] = intval($data['readCount']);
			$_POST['id'] = $this->id;
			$res = M('blog')->save($_POST);
		}
		
		//得到博客分类
		$uid = $this->mid;
		$user = getUserBaseInfo($uid);
		$this->assign('user', $user);
		$uid = $data['uid'];
		$user2 = getUserBaseInfo($uid);
		$this->assign('create_user', $user2);
		$data3 = M('blog_category')->order('`id` ASC')->findAll();  
		foreach ($data3 as $v){
			$catearr[$v['id']] = $v['name'];	
		}
		$this->assign('blog_category', $catearr);
		$this->assign('user',$user);
		//$new_blog = $this->new_blog();
		//$hot_blog = $this->hot_blog();
		$hot_bloger = $this->hot_bloger();
		//$this->assign('new_blog',$new_blog);
		//$this->assign('hot_blog',$hot_blog);
		$this->assign('hot_bloger',$hot_bloger);

		$this->display();
	}
	
	
	//博客转发微博
	function transpond(){
		$id = intval($_POST['id']);
		if($id <= 0) return ;
		
		$blog = M('blog')->where('id='.$id.' AND status=1')->field('title')->find();
		$blog_url = getShortUrl(U("home/blog/blog_detail",array('id'=>$id)));
		$data['content'] = $blog['title'].' '.$blog_url.' （来自博客频道）';
		//转发至微博
		if(D("Weibo","weibo")->publish( $this->mid,$data,$id,0,'','','blog')){
			echo U('weibo/index/mine');
		}
		exit;
	}
	
	// 博客搜索
	function search() {
		$search_key = $this->_getSearchKey();

		if ($search_key) {
			$data = M('blog')->where( "title like '%$search_key%' and status=1")->order('`id` DESC')->findPage(5);
		}
		$data3 = M('blog_category')->order('`id` ASC')->findAll();  
		foreach ($data3 as $v){
			$catearr[$v['id']] = $v['name'];	
		}
		$this->assign('blog_category', $catearr);
		$this->assign('data', $data);
        $this->setTitle("博客搜索");
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
				$key = unserialize( $_SESSION['blog_search_' . $key_name] );
			}			
        	$this->assign('search_key', h(t($key)));
			return trim($key);
	    }

	//删除博客
	function delBlog() {
		if (M('blog')->delete(intval($this->id))){
			//积分操作
			X('Credit')->setUserCredit($this->mid, 'delete_blog');
			$this->assign('jumpUrl', U('home/blog/my_blog'));
			$this->success('删除成功');
		} else {
			$this->assign('jumpUrl', U('home/blog/index'));
			$this->error('删除失败');
		}
	}


   	//最新博客列表
	//Limitnum为最新博客个数，默认为3个。
	public function new_blog($limitnum=3) {
		$data = M('blog')->where( array( 'status'=>1))->order('`id` DESC')->limit($limitnum)->findAll();
		return $data;
	}
	
	//最热博客列表
	//Limitnum为最热项目个数，默认为3个。
	public function hot_blog($limitnum=3) {
		$data = M('blog')->where( array( 'status'=>1))->order('`readCount` DESC')->limit($limitnum)->findAll();
		return $data;
	}
	
	//精英博主列表
	//Limitnum为精英博主个数，默认为5个。
	public function hot_bloger($limitnum=6) {
		$data = M('blog')->where( array( 'status'=>1,'isHot'=>1))->order('`readCount` DESC')->limit($limitnum)->distinct('uid')->findAll();
		foreach ($data as $v){
			$temparr[$v['uid']] = $v['uid'];
		}
		$map['uid'] = array('in', $temparr);
		$hot_bloger1 = M('user')->where($map)->limit($limitnum)->findAll();
		return $hot_bloger1;
	}

}
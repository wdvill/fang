<?php
class ContentAction extends AdministratorAction {
	
	//private $channels = array(1=>'订阅',2=>'新闻',3=>'优惠',4=>'玩乐',5=>'餐厅',6=>'图片');
	public $site_pre_url = "http://www.tradetochina.cn";
	private $channels;
	
	public function _initialize() {
		$this->channels = C('SYSTEM_CHANNEL');
		parent::_initialize();
	}
	private function logapi($str){
		//调试代码开始
		$geturl = "From URL : ".$this->site_pre_url.$_SERVER['REQUEST_URI']."\n\n";
		$nowtime = "Execute time : ".date("Y-m-d H:i:s")."\n\n";
		$str = "\n".$nowtime.$geturl.$lastsql."\n";
		$k2=fopen("/var/www/other/zsts/api/content2.log.txt","a+");
		$k=fopen("/var/www/other/zsts/api/content.log.txt","w");
		fwrite($k,$str);
		fclose($k);
		fwrite($k2,$str);
		fclose($k2);
		//调试代码结束
	}
	
	private function __isValidRequest($field, $array = 'post') {
		$field = is_array($field) ? $field : explode(',', $field);
		$array = $array == 'post' ? $_POST : $_GET;
		foreach ($field as $v){
			$v = trim($v);
			if ( !isset($array[$v]) || $array[$v] == '' ) return false;
		}
		return true;
	}

	/** 内容管理 - 建议管理 **/

	public function suggestion() {
		$data = M('suggestion')->order("`id` DESC")->findAll();  
		$this->assign('data', $data);
		$this->display();
	}

	public function doDeleteSuggestion() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		$map['id'] = array('in', t($_POST['ids']));
		
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '2';
		$data[] = '内容 - 删除建议管理 ';
		$data[] =  M('suggestion')->where( $map )->findall();
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		echo M('suggestion')->where($map)->delete() ? '1' : '0';
	}

	/** 内容管理 - 生活服务修改管理 **/

	public function lifecontent2() {
		$map  = '1=1 ';
		if (isset($_REQUEST['title']) && strlen($_REQUEST['title'])>0){
			$map = $map." and cname like '%".$_REQUEST['title']."%'";
		}
		if (isset($_REQUEST['intro']) && strlen($_REQUEST['intro'])>0){
			$map = $map." and intro like '%".$_REQUEST['intro']."%'";
		}
		if (isset($_REQUEST['telephone']) && strlen($_REQUEST['telephone'])>0){
			$map = $map." and telephone like '%".$_REQUEST['telephone']."%'";
		}
		if (isset($_REQUEST['address']) && strlen($_REQUEST['address'])>0){
			$map = $map." and address like '%".$_REQUEST['address']."%'";
		}
		//echo 'map='.$map;
		$data = M('ts_lifecontent2')->where($map)->order("`copy_id` DESC")->findPage(10);  
		$this->assign('info', $data);
		$this->display();
	}

	/**启动图片的管理  开始**/

	public function editLoadpic() {
		$map['infotype'] = 7;
		$ad = M('information')->where($map)->find();
		if(empty($ad)) 
			$this->error('参数错误');
		$this->assign($ad);

		$this->assign('type', 'edit');
		$this->display('editLoadpic');
	}

	public function doEditLoadpic() {
		if( ($_POST['info_id'] = intval($_POST['info_id'])) <= 0 )
			unset($_POST['info_id']);
		// 启动图
		$options['userId']		=	$this->mid;
		$options['max_size']    =   80*1024*1024;  //8MB
		$options['allow_exts']	=	'jpg,gif,png,jpeg,bmp';
		$info	=	X('Xattach')->upload('info_logo',$options);
		if($info['status']) {
			$_POST['cover'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];
		}else{
			if (!isset($_POST['info_id'])){
				$_POST['cover'] = '';
			}
		}

		// 格式化数据
		$_POST['title']			= h(t($_POST['title']));
		$_POST['intro']			= h(t($_POST['intro']));
		$_POST['recommend']		= 0;
		$_POST['status']		= 1;
		$_POST['fid']			= 0;
		$_POST['infotype']		= '7';
		$_POST['cate_id']		= 0;
		if (!isset($_POST['info_id'])){
			$_POST['uid']			= $this->mid;
		}
		$_POST['mtime']			= time();
		if ( !isset($_POST['info_id']) ) 
			$_POST['ctime']		= time();

		// 数据检查
		if(empty($_POST['title']))
			$this->error('标题不能为空');
			
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = isset($_POST['info_id']) ? '3' : '1';
		$data[] = '内容 - 修改启动图片管理 ';
		isset($_POST['info_id']) && $data[] =  M('information')->where( array( 'info_id'=>intval($_POST['info_id']) ) )->find();
		if ( isset($_POST['info_id']) ) unset( $data['1']['ctime'] );
		//unset( $data['1']['display_order'] );
		if( $_POST['__hash__'] )unset( $_POST['__hash__'] );
		$data[] = $_POST;
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		// 提交数据
		$res = isset($_POST['info_id']) ? M('information')->save($_POST) : M('information')->add($_POST);

		if($res) {
			if( !isset($_POST['info_id']) ) {
				$this->assign('jumpUrl', U('admin/Content/editLoadpic'));
			}else {
				$this->assign('jumpUrl', U('admin/Content/editLoadpic'));
			}
			$this->success('保存成功');
		}else {
			$this->error('保存失败');
		}
	}

	/**启动图片的管理  结束**/
	
	
	/** 内容管理 - 单独订阅管理 **/

	public function otherorder() {
		$this->assign('info_cate', $this->getinfo_cate(1));
		
		$map = ' cate_id = 16';
		$order = ' info_id DESC ';
		$data = M('information')->where($map)->order($order)->findPage(10);
		$this->assign('info', $data);
		$this->display();
	}
	
	/** 内容管理 - 便民订阅管理 **/

	public function lifeorder() {
		
		$map = ' fid = 0 and cate_id = 9 and title<>"关于我们"';

		if (isset($_REQUEST['status']) && ($_REQUEST['status'] != -1)){
			$map = $map." and status=".$_REQUEST['status'];
		}
		if (isset($_REQUEST['title'])){
			$map = $map." and title like '%".$_REQUEST['title']."%'";
		}
		if (isset($_REQUEST['url'])){
			$map = $map." and intro like '%".$_REQUEST['url']."%'";
		}
		$order = ' info_id DESC ';
		$data = M('information')->where($map)->order($order)->findPage(10);
		$this->assign('info', $data);
		$this->display();
	}

	public function addLifeorder() {
		$this->assign('status', '1');
		$this->assign('recommend', '0');
		$this->assign('cate_id', '9');
		$this->assign('fid', '0');
		$this->assign('type', 'add');
		$this->display('editLifeorder');
	}

	public function editLifeorder() {
		$map['info_id'] = intval($_GET['id']);
		$ad = M('information')->where($map)->find();
		if(empty($ad)) 
			$this->error('参数错误');
		$this->assign($ad);

		$this->assign('type', 'edit');
		$this->display('editLifeorder');
	}

	public function doEditLifeorder() {
		if( ($_POST['info_id'] = intval($_POST['info_id'])) <= 0 )
			unset($_POST['info_id']);
		// 新闻焦点图
		// 新闻列表图
		$options['userId']		=	$this->mid;
		$options['max_size']    =   80*1024*1024;  //8MB
		$options['allow_exts']	=	'jpg,gif,png,jpeg,bmp';
		$info	=	X('Xattach')->upload('info_logo',$options);
		if($info['status']) {
			$_POST['smallcover'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];
			$_POST['cicon'] = $_POST['smallcover'];
		}else{
			if (!isset($_POST['info_id'])){
				$_POST['smallcover'] = '';
				$_POST['cicon'] = '';
			}
		}

		// 格式化数据
		$_POST['title']			= h(t($_POST['title']));
		$_POST['intro']			= h(t($_POST['intro']));
		//$_POST['recommend']	= intval($_POST['recommend']);
		$_POST['status']		= intval($_POST['status']);
		$_POST['fid']			= 0;
		$_POST['infotype']		= '1';
		$_POST['content']		= h(t($_POST['content']));
		$_POST['cate_id']		= 9;
		if (!isset($_POST['info_id'])){
			$_POST['uid']			= $this->mid;
		}
		$_POST['mtime']			= time();
		if ( !isset($_POST['info_id']) ) 
			$_POST['ctime']		= time();

		// 数据检查
		if(empty($_POST['title']))
			$this->error('标题不能为空');
			
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = isset($_POST['info_id']) ? '3' : '1';
		$data[] = '内容 - 修改便民订阅管理 ';
		isset($_POST['info_id']) && $data[] =  M('information')->where( array( 'info_id'=>intval($_POST['info_id']) ) )->find();
		if ( isset($_POST['info_id']) ) unset( $data['1']['ctime'] );
		//unset( $data['1']['display_order'] );
		if( $_POST['__hash__'] )unset( $_POST['__hash__'] );
		$data[] = $_POST;
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		// 提交数据
		$res = isset($_POST['info_id']) ? M('information')->save($_POST) : M('information')->add($_POST);

		if($res) {
			if( !isset($_POST['info_id']) ) {
				$this->assign('jumpUrl', U('admin/Content/lifeorder'));
			}else {
				$this->assign('jumpUrl', U('admin/Content/lifeorder'));
			}
			$this->success('保存成功');
		}else {
			$this->error('保存失败');
		}
	}

	public function doDeleteLifeorder() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		$map['info_id'] = array('in', t($_POST['ids']));
		
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '2';
		$data[] = '内容 - 删除便民订阅管理 ';
		$data[] =  M('information')->where( $map )->findall();
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		echo M('information')->where($map)->delete() ? '1' : '0';
	}

	/** 便民订阅内容管理结束 **/

	private function getTopicCate($cate_id) {
		$cate_id = intval($cate_id);
		$map = " cate_id={$cate_id} ";
		$map = $map." and status=1 ";
		$order = ' sort_id desc,mtime desc,info_id DESC ';
		$topicCate = M('information')->field('info_id, title')->where($map)->order($order)->select();
		return $topicCate;
	}
	/** 内容管理 - 餐厅管理 **/
	
	public function restaurant() {
		$this->assign('info_cate', $this->getinfo_cate(5));
	
		$map = ' cid=5 ';
		if (isset($_REQUEST['cate_id']) && ($_REQUEST['cate_id'] != -1)){
			$map = $map." and cate_id=".$_REQUEST['cate_id'];
		}
		if (isset($_REQUEST['title']) && strlen($_REQUEST['title'])>0){
			$map = $map." and cname like '%".$_REQUEST['title']."%'";
		}
		if (isset($_REQUEST['status']) && ($_REQUEST['status'] != -1)){
			$map = $map." and status=".$_REQUEST['status'];
		}
		if (isset($_REQUEST['address']) && strlen($_REQUEST['address'])>0){
			$map = $map." and address like '%".$_REQUEST['address']."%'";
		}
		if (isset($_REQUEST['intro']) && strlen($_REQUEST['intro'])>0){
			$map = $map." and intro like '%".$_REQUEST['intro']."%'";
		}
		if (isset($_REQUEST['telephone']) && strlen($_REQUEST['telephone'])>0){
			$map = $map." and telephone like '%".$_REQUEST['telephone']."%'";
		}
		$order = ' sort_id desc,id DESC ';

		$data = M('ts_lifecontent')->where($map)->order($order)->findPage(10);
		$this->assign('info', $data);
		$this->display();
	}
	
	public function addRestaurant() {
		$this->assign('info_cate', $this->getinfo_cate(5));
		$topic_cate = $this->getTopicCate(7);
		$this->assign('topic_cate', $topic_cate);
		$this->assign('status', '1');
		$this->assign('type', 'add');
		$this->display('editRestaurant');
	}

	public function editRestaurant() {
		$this->assign('info_cate', $this->getinfo_cate(5));
		
		$topic_cate = $this->getTopicCate(7);
		
		$map['id'] = intval($_GET['id']);
		$ad = M('ts_lifecontent')->where($map)->find();
		if(empty($ad)) 
			$this->error('参数错误');
		$this->assign($ad);

		$this->assign('topic_cate', $topic_cate);
		$this->assign('type', 'edit');
		$this->display('editRestaurant');
	}

	public function doEditRestaurant() {
		if( ($_POST['id'] = intval($_POST['id'])) <= 0 )
			unset($_POST['id']);
		// 新闻焦点图
		// 新闻列表图
		$options['userId']		=	$this->mid;
		$options['max_size']    =   80*1024*1024;  //8MB
		$options['allow_exts']	=	'jpg,gif,png,jpeg,bmp';
		$info	=	X('Xattach')->upload('info_logo',$options);

		if($info['status']) {
			$key = $info['info'][0]['key'];
			//echo 'key='.$key;
			//exit;
			if ($key == 'pic'){
				$_POST['pic'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];	
			} else {
				$_POST['smallpic'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];
			}
			if (count($info['info']) > 1){
				$_POST['smallpic'] = $info['info'][1]['savepath'] . $info['info'][1]['savename'];
			}
		}else{
			if (!isset($_POST['id'])){
				$_POST['pic'] = '';
				$_POST['smallpic'] = '';
			}
		}

		// 格式化数据
		$_POST['cname']			= h(t($_POST['cname']));
		$_POST['intro']			= h(t($_POST['intro']));
		$_POST['tag']			= '';
		$_POST['telephone']		= h(t($_POST['telephone']));
		$_POST['address']		= h(t($_POST['address']));
		$_POST['sdish']			= h(t($_POST['sdish']));
		$_POST['consume']		= intval($_POST['consume']);
		$loglat					= $_POST['loglat'];
		if (stristr($loglat,',')){
			$loglatarr = explode(',',$loglat,2);
			$_POST['longitude']		= $loglatarr[0];
			$_POST['latitude']		= $loglatarr[1];
		}
		$_POST['cid']		= intval($_POST['cid']);
		$_POST['cate_id']		= intval($_POST['cate_id']);
		$_POST['topic_id']		= intval($_POST['topic_id']);
		$_POST['sort_id']		= intval($_POST['sort_id']);
		//echo "sort_id=".$_POST['sort_id'];
		//exit;
		if (!isset($_POST['id'])){
			$_POST['uid']			= $this->mid;
		}
		
		// 数据检查
		if(empty($_POST['cname'])) {
			$this->error('标题不能为空');
		}
		
		// 提交数据
		$res = isset($_POST['id']) ? M('ts_lifecontent')->save($_POST) : M('ts_lifecontent')->add($_POST);

		if($res) {
			if( !isset($_POST['id']) ) {
				$this->assign('jumpUrl', U('admin/Content/restaurant'));
			}else {
				$this->assign('jumpUrl', U('admin/Content/restaurant'));
			}
			$this->success('保存成功');
		}else {
			$this->error('保存失败');
		}
	}

	public function doDeleteRestaurant() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		$map['id'] = array('in', t($_POST['ids']));
		
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '2';
		$data[] = '内容 - 删除餐厅内容管理 ';
		$data[] =  M('ts_lifecontent')->where( $map )->findall();
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		echo M('ts_lifecontent')->where($map)->delete() ? '1' : '0';
	}

	/** 餐厅内容管理结束 **/


	/** 内容管理 - 玩乐场所管理 **/
	
	public function playplace() {
		$this->assign('info_cate', $this->getinfo_cate(4));
	
		$map = ' cid=4 ';
		if (isset($_REQUEST['cate_id']) && ($_REQUEST['cate_id'] != -1)){
			$map = $map." and cate_id=".$_REQUEST['cate_id'];
		}
		if (isset($_REQUEST['title']) && strlen($_REQUEST['title'])>0){
			$map = $map." and cname like '%".$_REQUEST['title']."%'";
		}
		if (isset($_REQUEST['status']) && ($_REQUEST['status'] != -1)){
			$map = $map." and status=".$_REQUEST['status'];
		}
		if (isset($_REQUEST['address']) && strlen($_REQUEST['address'])>0){
			$map = $map." and address like '%".$_REQUEST['address']."%'";
		}
		if (isset($_REQUEST['intro']) && strlen($_REQUEST['intro'])>0){
			$map = $map." and intro like '%".$_REQUEST['intro']."%'";
		}
		if (isset($_REQUEST['telephone']) && strlen($_REQUEST['telephone'])>0){
			$map = $map." and telephone like '%".$_REQUEST['telephone']."%'";
		}
		$order = ' sort_id desc,id DESC ';
	
		$data = M('ts_lifecontent')->where($map)->order($order)->findPage(10);
		$this->assign('info', $data);
		$this->display();
	}
	
	public function addPlayplace() {
		$this->assign('info_cate', $this->getinfo_cate(4));
		$topic_cate = $this->getTopicCate(8);
		$this->assign('topic_cate', $topic_cate);
		$this->assign('status', '1');
		$this->assign('type', 'add');
		$this->display('editPlayplace');
	}
	
	public function editPlayplace() {
		$this->assign('info_cate', $this->getinfo_cate(4));
		$topic_cate = $this->getTopicCate(8);
		$this->assign('topic_cate', $topic_cate);
		
		$map['id'] = intval($_GET['id']);
		$ad = M('ts_lifecontent')->where($map)->find();
		if(empty($ad))
			$this->error('参数错误');
		$this->assign($ad);
	
		$this->assign('type', 'edit');
		$this->display('editPlayplace');
	}
	
	public function doEditPlayplace() {
		if( ($_POST['id'] = intval($_POST['id'])) <= 0 )
			unset($_POST['id']);
		// 新闻焦点图
		// 新闻列表图
		$options['userId']		=	$this->mid;
		$options['max_size']    =   80*1024*1024;  //8MB
		$options['allow_exts']	=	'jpg,gif,png,jpeg,bmp';
		$info	=	X('Xattach')->upload('info_logo',$options);
	
		if($info['status']) {
			$key = $info['info'][0]['key'];
			//echo 'key='.$key;
			//exit;
			if ($key == 'pic'){
				$_POST['pic'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];
			} else {
				$_POST['smallpic'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];
			}
			if (count($info['info']) > 1){
				$_POST['smallpic'] = $info['info'][1]['savepath'] . $info['info'][1]['savename'];
			}
		}else{
			if (!isset($_POST['id'])){
				$_POST['pic'] = '';
				$_POST['smallpic'] = '';
			}
		}
	
		// 格式化数据
		$_POST['cname']			= h(t($_POST['cname']));
		$_POST['intro']			= h(t($_POST['intro']));
		$_POST['tag']			= '';
		$_POST['telephone']		= h(t($_POST['telephone']));
		$_POST['address']		= h(t($_POST['address']));
		$_POST['consume']		= intval($_POST['consume']);
		$loglat					= $_POST['loglat'];
		if (stristr($loglat,',')){
			$loglatarr = explode(',',$loglat,2);
			$_POST['longitude']		= $loglatarr[0];
			$_POST['latitude']		= $loglatarr[1];
		}
		$_POST['cid']		= intval($_POST['cid']);
		$_POST['cate_id']		= intval($_POST['cate_id']);
		$_POST['topic_id']		= intval($_POST['topic_id']);
		$_POST['sort_id']		= intval($_POST['sort_id']);
		//echo "sort_id=".$_POST['sort_id'];
		//exit;
		if (!isset($_POST['id'])){
			$_POST['uid']			= $this->mid;
		}
	
		// 数据检查
		if(empty($_POST['cname']))
			$this->error('标题不能为空');
	
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = isset($_POST['id']) ? '3' : '1';
		$data[] = '内容 - 修改餐厅内容管理 ';
		isset($_POST['id']) && $data[] =  M('ts_lifecontent')->where( array( 'id'=>intval($_POST['id']) ) )->find();
		if ( isset($_POST['id']) ) unset( $data['1']['ctime'] );
		//unset( $data['1']['display_order'] );
		if( $_POST['__hash__'] )unset( $_POST['__hash__'] );
		$data[] = $_POST;
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
	
		// 提交数据
		$res = isset($_POST['id']) ? M('ts_lifecontent')->save($_POST) : M('ts_lifecontent')->add($_POST);
	
		if($res) {
			if( !isset($_POST['id']) ) {
				$this->assign('jumpUrl', U('admin/Content/playplace'));
			}else {
				$this->assign('jumpUrl', U('admin/Content/playplace'));
			}
			$this->success('保存成功');
		}else {
			$this->error('保存失败');
		}
	}
	
	public function doDeletePlayplace() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		$map['id'] = array('in', t($_POST['ids']));
	
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '2';
		$data[] = '内容 - 删除餐厅内容管理 ';
		$data[] =  M('ts_lifecontent')->where( $map )->findall();
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
	
		echo M('ts_lifecontent')->where($map)->delete() ? '1' : '0';
	}
	
	/** 玩乐场所内容管理结束 **/
	
	public function sublifetopic() {
		$topic_id = intval( $_REQUEST['topic_id']);
		
		$map = " topic_id={$topic_id} AND status=1 ";
		$order = ' sort_id desc,id DESC ';
		
		$data = M('ts_lifecontent')->where($map)->order($order)->findPage(10);
		$this->assign('info', $data);
		$this->display();
	}
	
	/** 内容管理 - 图片专题管理 **/

	public function picture() {
		$this->assign('info_cate', $this->getinfo_cate(6));
		
		$map = ' infotype=3 and cate_id!=7 and cate_id!=8 ';
		if (isset($_REQUEST['cate_id']) && ($_REQUEST['cate_id'] != -1)){
			$map = $map." and cate_id=".$_REQUEST['cate_id'];
		}
		if (isset($_REQUEST['title'])){
			$map = $map." and title like '%".$_REQUEST['title']."%'";
		}
		if (isset($_REQUEST['status']) && ($_REQUEST['status'] != -1)){
			$map = $map." and status=".$_REQUEST['status'];
		}
		if (isset($_REQUEST['recommend']) && ($_REQUEST['recommend'] != -1)){
			$map = $map." and recommend=".$_REQUEST['recommend'];
		}
		$order = ' sort_id desc,mtime desc,info_id DESC ';
		$data = M('information')->where($map)->order($order)->findPage(10);
		$this->assign('info', $data);
		$this->display();
	}

	public function addPicture() {
		$this->assign('info_cate', $this->getinfo_cate(6));

		$this->assign('status', '1');
		$this->assign('recommend', '0');
		$this->assign('source', '0');
		$this->assign('fid', '0');
		$this->assign('type', 'add');
		$this->display('editPicture');
	}

	public function editPicture() {
		$this->assign('info_cate', $this->getinfo_cate(6));

		$map['info_id'] = intval($_GET['id']);
		$ad = M('information')->where($map)->find();
		if(empty($ad)) 
			$this->error('参数错误');
		$this->assign($ad);

		$this->assign('type', 'edit');
		$this->display('editPicture');
	}

	public function doEditPicture() {
		if( ($_POST['info_id'] = intval($_POST['info_id'])) <= 0 )
			unset($_POST['info_id']);
		// 新闻焦点图
		// 新闻列表图
		$options['userId']		=	$this->mid;
		$options['max_size']    =   80*1024*1024;  //8MB
		$options['allow_exts']	=	'jpg,gif,png,jpeg,bmp';
		$info	=	X('Xattach')->upload('info_logo',$options);
		if($info['status']) {
			$_POST['smallcover'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];
		}else{
			if (!isset($_POST['info_id'])){
				$_POST['smallcover'] = '';
			}
		}

		// 格式化数据
		$_POST['title']			= h(t($_POST['title']));
		$_POST['content']		= h(t($_POST['content']));
		$_POST['recommend']		= intval($_POST['recommend']);
		$_POST['status']		= intval($_POST['status']);
		$_POST['source']		= intval($_POST['source']);
		$_POST['fid']			= intval($_POST['fid']);
		$_POST['sort_id']		= intval($_POST['sort_id']);
		$_POST['infotype']		= '3';
		$_POST['cate_id']		= intval($_POST['cate_id']);
		if (!isset($_POST['info_id'])){
			$_POST['uid']			= $this->mid;
		}
		$_POST['mtime']			= time();
		if ( !isset($_POST['info_id']) ) 
			$_POST['ctime']		= time();

		// 数据检查
		if(empty($_POST['title']))
			$this->error('标题不能为空');
			
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = isset($_POST['info_id']) ? '3' : '1';
		$data[] = '内容 - 修改图片管理 ';
		isset($_POST['info_id']) && $data[] =  M('information')->where( array( 'info_id'=>intval($_POST['info_id']) ) )->find();
		if ( isset($_POST['info_id']) ) unset( $data['1']['ctime'] );
		//unset( $data['1']['display_order'] );
		if( $_POST['__hash__'] )unset( $_POST['__hash__'] );
		$data[] = $_POST;
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		// 提交数据
		$res = isset($_POST['info_id']) ? M('information')->save($_POST) : M('information')->add($_POST);

		if($res) {
			if( !isset($_POST['info_id']) ) {
				$this->assign('jumpUrl', U('admin/Content/picture'));
			}else {
				$this->assign('jumpUrl', U('admin/Content/picture'));
			}
			$this->success('保存成功');
		}else {
			$this->error('保存失败');
		}
	}

	public function doDeletePicture() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		$map['info_id'] = array('in', t($_POST['ids']));
		
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '2';
		$data[] = '内容 - 删除图片管理 ';
		$data[] =  M('information')->where( $map )->findall();
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		echo M('information')->where($map)->delete() ? '1' : '0';
	}

	/** 图片内容管理结束 **/


	/** 内容管理 - 餐厅特色榜单管理 **/
	
	public function ptopic() {
		$type = intval($_REQUEST['type']);
		if( !$type) {
			exit('请求错误');
		} 
		$map = " cate_id={$type} ";
		
		if (isset($_REQUEST['title'])){
			$map = $map." and title like '%".$_REQUEST['title']."%'";
		}
		if (isset($_REQUEST['status']) && ($_REQUEST['status'] != -1)){
			$map = $map." and status=".$_REQUEST['status'];
		}
		if (isset($_REQUEST['recommend']) && ($_REQUEST['recommend'] != -1)){
			$map = $map." and recommend=".$_REQUEST['recommend'];
		}
		$order = ' sort_id desc,mtime desc,info_id DESC ';
		$data = M('information')->where($map)->order($order)->findPage(10);
		
		if( $type==7) {
			$title = "特色榜单管理";
		} elseif ($type==8) {
			$title="旅游专题管理";
		}
		$this->assign('title', $title);
		$this->assign('info', $data);
		$this->assign('type', $type);
		$this->display('ptopic');
	}
	
	public function addPTopic() {
		$type = intval($_REQUEST['type']);
		if( !$type) {
			exit('请求错误');
		}
		$this->assign('type', $type);
		$this->assign('handle', 'add');
		$this->assign('status', '1');
		$this->assign('recommend', '0');
		$this->assign('source', '0');
		$this->assign('fid', '0');
		$this->display('editPTopic');
	}
	
	public function editPTopic() {
		$type = intval($_REQUEST['type']);
		if( !$type) {
			exit('请求错误');
		}
		$map['info_id'] = intval($_GET['id']);
		$ad = M('information')->where($map)->find();
		if(empty($ad))
			$this->error('参数错误');
		$this->assign($ad);
	
		$this->assign('type', $type);
		$this->assign('handle', 'edit');
		$this->display('editPTopic');
	}
	
	public function doEditPTopic() {
		$type = intval($_REQUEST['type']);
		if( !$type) {
			exit('请求错误');
		}
		if( ($_POST['info_id'] = intval($_POST['info_id'])) <= 0 )
			unset($_POST['info_id']);
		// 新闻焦点图
		// 新闻列表图
		$options['userId']		=	$this->mid;
		$options['max_size']    =   80*1024*1024;  //8MB
		$options['allow_exts']	=	'jpg,gif,png,jpeg,bmp';
		$info	=	X('Xattach')->upload('info_logo',$options);
		if($info['status']) {
			$_POST['smallcover'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];
		}else{
			if (!isset($_POST['info_id'])){
				$_POST['smallcover'] = '';
			}
		}

		// 格式化数据
		$_POST['title']			= h(t($_POST['title']));
		$_POST['content']		= h(t($_POST['content']));
		$_POST['recommend']		= intval($_POST['recommend']);
		$_POST['status']		= intval($_POST['status']);
		$_POST['source']		= intval($_POST['source']);
		$_POST['sort_id']		= intval($_POST['sort_id']);
		$_POST['infotype']		= '3';
		$_POST['cate_id']		= intval( $type);
		if (!isset($_POST['info_id'])){
			$_POST['uid']			= $this->mid;
		}
		$_POST['mtime']			= time();
		if ( !isset($_POST['info_id']) )
			$_POST['ctime']		= time();
	
		// 数据检查
		if(empty($_POST['title']))
			$this->error('标题不能为空');
	
		// 提交数据
		$res = isset($_POST['info_id']) ? M('information')->save($_POST) : M('information')->add($_POST);
	
		if($res) {
			if( !isset($_POST['info_id']) ) {
				$this->assign('jumpUrl', U('admin/Content/ptopic', array('type'=>$type)));
			}else {
				$this->assign('jumpUrl', U('admin/Content/ptopic', array('type'=>$type)));
			}
			$this->success('保存成功');
		}else {
			$this->error('保存失败');
		}
	}
	
	public function doDeletePTopic() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		$map['info_id'] = array('in', t($_POST['ids']));
	
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '2';
		$data[] = '内容 - 删除图片管理 ';
		$data[] =  M('information')->where( $map )->findall();
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
	
		echo M('information')->where($map)->delete() ? '1' : '0';
	}
	
	/** 图片内容管理结束 **/


	/** 内容管理 - 微刊和优惠的子内容管理 **/

	public function subinfo() {
		$infotype = intval($_REQUEST['infotype']);
		$info_id = intval($_REQUEST['info_id']);
		$this->assign('infotype', $infotype);
		$this->assign('info_id', $info_id);

		$map = ' info_id ='.$info_id;
		$order = ' sort_id desc,id desc ';
		$data = M('ts_sub_info')->where($map)->order($order)->findPage(10);
		$this->assign('info', $data);
		$this->display();
	}

	public function addSubinfo() {
		$infotype = intval($_REQUEST['infotype']);
		$info_id = intval($_REQUEST['info_id']);
		$this->assign('infotype', $infotype);
		$this->assign('info_id', $info_id);
		$this->assign('status', '1');
		$this->assign('type', 'add');
		$this->display('editSubinfo');
	}

	public function editSubinfo() {
		$infotype = intval($_REQUEST['infotype']);
		$info_id = intval($_REQUEST['info_id']);
		$this->assign('infotype', $infotype);
		$this->assign('info_id', $info_id);
		$map['id'] = intval($_GET['id']);
		$ad = M('ts_sub_info')->where($map)->find();
		if(empty($ad)) 
			$this->error('参数错误');
		$this->assign($ad);

		$this->assign('type', 'edit');
		$this->display('editSubinfo');
	}

	public function doEditSubinfo() {
		if( ($_POST['id'] = intval($_POST['id'])) <= 0 )
			unset($_POST['id']);
		// 新闻焦点图
		// 新闻列表图
		$options['userId']		=	$this->mid;
		$options['max_size']    =   80*1024*1024;  //8MB
		$options['allow_exts']	=	'jpg,gif,png,jpeg,bmp';
		$info	=	X('Xattach')->upload('info_logo',$options);
		if($info['status']) {
			$_POST['pic'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];
		}else{
			if (!isset($_POST['info_id'])){
				$_POST['pic'] = '';
			}
		}

		// 格式化数据
		$_POST['title']			= h(t($_POST['title']));
		$_POST['intro']		= h(t($_POST['intro']));
		$_POST['type']		= intval($_POST['infotype']);
		$_POST['status']		= intval($_POST['status']);
		$_POST['info_id']		= intval($_POST['info_id']);
		$_POST['sort_id']		= intval($_POST['sort_id']);
		if (!isset($_POST['id'])){
			$_POST['uid']			= $this->mid;
		}

		// 数据检查
		if(empty($_POST['title']))
			$this->error('标题不能为空');
			
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = isset($_POST['id']) ? '3' : '1';
		$data[] = '内容 - 修改户型图管理 ';
		isset($_POST['id']) && $data[] =  M('ts_sub_info')->where( array( 'id'=>intval($_POST['id']) ) )->find();
		if ( isset($_POST['id']) ) unset( $data['1']['ctime'] );
		//unset( $data['1']['display_order'] );
		if( $_POST['__hash__'] )unset( $_POST['__hash__'] );
		$data[] = $_POST;
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		// 提交数据
		if ( isset($_POST['id'])) {
			$id = $_POST['id'];
			$map = array();
			$map['id'] = $id;
			if ( $_SESSION['issecondadmin']) {
				$map['uid_admin'] = $_SESSION['mid'];
			} elseif ( !$_SESSION['isadminman']) {
				$sub_info = M('ts_sub_info')->map($map)->find();
				$infomap = array();
				$infomap['info_id'] = $sub_info['info_id'];
				$infomap['uid'] = $_SESSION['mid'];
				if ( !M('information')->where($map)->find()) {
					$this->error("出现错误！！");
				}
			}
			$res = M('ts_sub_info')->where($map)->save($_POST);
		} else {
			if ( $_SESSION['issecondadmin']) {
				$_POST['uid_admin'] = $_SESSION['mid'];
			} elseif ( !$_SESSION['isadminman']) {
				$_POST['uid_admin'] = model('CUser')->getPid( $_SESSION['mid']);
			}
			$res = M('ts_sub_info')->add($_POST);
		}
		
		if($res) {
			if( !isset($_POST['id']) ) {
				$this->assign('jumpUrl', U('admin/Content/subinfo',array('infotype'=>$_POST['type'],'info_id'=>$_POST['info_id'])));
			}else {
				$this->assign('jumpUrl', U('admin/Content/subinfo',array('infotype'=>$_POST['type'],'info_id'=>$_POST['info_id'])));
			}
			$this->success('保存成功');
		}else {
			$this->error('保存失败,或者没有修改');
		}
	}

	public function doDeleteSubinfo() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		$map['id'] = array('in', t($_POST['ids']));
		
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '2';
		$data[] = '内容 - 删除微刊和优惠的子内容管理 ';
		$data[] =  M('ts_sub_info')->where( $map )->findall();
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		echo M('ts_sub_info')->where($map)->delete() ? '1' : '0';
	}

	/** 微刊和优惠的子内容管理结束 **/

	public function selectschpage() {
		$school_areas = model('Area')->getAreaList(2);
		$cus_areas = array();
		foreach ( $school_areas as $area) {
			$cus_areas[$area['area_id']] = $area['title'];
		}
		$this->assign('school_areas', $cus_areas);
		$this->display('select_school_page');
	}

	public function area_schools() {		
		$area_id = intval($_REQUEST['area_id']);
		if ($area_id) {
			$aSchool = M('school')->where("area_id={$area_id}")->order('`id` ASC')->findAll();
		} else {
			$aSchool = array();
		}
		$str = '<div class="option-list"><ul>';
		foreach ( $aSchool as $school) {
			$str .= "<li>";
			$str .= "<i>·</i>";
			$str .= "<a href=# onClick=\"choose_school(".$school['id'].", '".$school['title']."'); return false;\">";
			$str .= $school['title'];
			$str .= "</a>";
			$str .= "</li>";
		}
		$str .= '</ul></div>';
		exit( $str);
	}
	/** 内容管理 - 房产信息管理 **/

	public function info() {
		//if (isset($_REQUEST['infotype'])){
			$_REQUEST['infotype']		= intval($_REQUEST['infotype']) ? intval($_REQUEST['infotype']) : 1;
		//}
		if (isset($_REQUEST['modelid'])){
			$_REQUEST['modelid']		= intval($_REQUEST['modelid']);
		}
		if (isset($_REQUEST['status'])){
			$_REQUEST['status']			= intval($_REQUEST['status']);
		}
		if (isset($_REQUEST['cate_id'])){
			$_REQUEST['cate_id']		= intval($_REQUEST['cate_id']);
		}
		if (isset($_REQUEST['recommend'])){
			$_REQUEST['recommend']		= intval($_REQUEST['recommend']);
		}
		if (isset($_REQUEST['title'])){
			$_REQUEST['title']	= $_REQUEST['title'];
		}

		$map = '';
		if ( $_SESSION['issecondadmin']) {
			$map = " uid_admin={$_SESSION['mid']}";
		} elseif ( !$_SESSION['isadminman']) {
			$map = " uid={$_SESSION['mid']}";
		}

		$map .= " and infotype=".$_REQUEST['infotype'];
		if (isset($_REQUEST['modelid']) && ($_REQUEST['modelid'] != -1)){
			$map = $map." and modelid=".$_REQUEST['modelid'];
		}
		if (isset($_REQUEST['status']) && ($_REQUEST['status'] != -1)){
			$map = $map." and status=".$_REQUEST['status'];
		}
		if (isset($_REQUEST['area']) && ($_REQUEST['area'] != -1)){
			$map = $map." and area=".$_REQUEST['area'];
		}
		if (isset($_REQUEST['property_type']) && ($_REQUEST['property_type'] != -1)){
			$map = $map." and property_type=".$_REQUEST['property_type'];
		}
		if (isset($_REQUEST['price']) && ($_REQUEST['price'] != -1)){
			$prices = C('SEARCH_PRICE');
			switch( $_REQUEST['price']) {
				case 1:
					$map .= " and price<10000"; 
					break;
				case 2:
					$map .= " and price>=10000 and price<15000";
					break;
				case 3:
					$map .= " and price>=15000 and price<20000";
					break;
				case 4:
					$map .= " and price>=20000 and price<30000";
					break;
				case 5:
					$map .= " and price>=30000 and price<40000";
					break;
				case 6:
					$map .= " and price>=40000 and price<50000";
					break;
				case 7:
					$map .= " and price>=50000";
					break;
				default:
					$this->error("价格错误");
					break;
			}
		}
		
		if (isset($_REQUEST['uid_name']) && (strlen($_REQUEST['uid_name']) > 0)){
			$user_arr = M('user')->where(" uname like '%{$_REQUEST['uid_name']}%'")->findAll();
			$uid_arr = array();
			foreach( $user_arr as $user) {
				$uid_arr[] = $user['uid'];
			}
			if ( $uid_arr) {
				$map = $map." and uid in (". join(',', $uid_arr). ")";
			}
		}
		
		if (isset($_REQUEST['uid_admin_name']) && (strlen($_REQUEST['uid_admin_name']) > 0)){
			$user_arr = M('user')->where(" uname like '%{$_REQUEST['uid_admin_name']}%'")->findAll();
			$uid_arr = array();
			foreach( $user_arr as $user) {
				$uid_arr[] = $user['uid'];
			}
			if ( $uid_arr) {
				$map = $map." and uid_admin in (". join(',', $uid_arr). ")";
			}
		}

		if (isset($_REQUEST['title']) && (strlen($_REQUEST['title']) > 0)){
			$map = $map." and title like '%".$_REQUEST['title']."%' ";
		}
		
		$title = $this->channels[$_REQUEST['infotype']];
		$order = ' status desc,recommend desc,sort_id desc,mtime DESC ';
		$order = ' info_id DESC ';
		//echo "map=".$map;
		$data = M('information')->where($map)->order($order)->findPage(10);
		$this->assign('info', $data);
		
		$areas = M('Area')->where("view=1")->order('`area_id` ASC')->findAll();
		$cus_areas = array();
		foreach ( $areas as $area) {
			$cus_areas[$area['area_id']] = $area['title'];
		}
		$this->assign('infotype', $_REQUEST['infotype']);
		$this->assign('areas', $cus_areas);
		$this->assign('property_types', C('PROPERTY_TYPE'));
		$this->assign('building_types', C('BUILDING_TYPE'));
		$this->assign('search_prices', C('SEARCH_PRICE'));
		$this->assign('traffic_positions', C('TRAFFIC_POSITION'));
		$this->assign('decorations', C('DECORATION'));

		$this->assign("title", $title);
		$this->display('info_1');
	}

	public function addInfo() {
		$this->assign('info_cate', $this->getinfo_cate(2));
		
		$this->assign('property_types', C('PROPERTY_TYPE'));
		$this->assign('building_types', C('BUILDING_TYPE'));
		$this->assign('traffic_positions', C('TRAFFIC_POSITION'));
		$this->assign('decorations', C('DECORATION'));
		$areas = M('Area')->where("view=1")->order('`area_id` ASC')->findAll();
		$cus_areas = array();
		foreach ( $areas as $area) {
			$cus_areas[$area['area_id']] = $area['title'];
		}
		$this->assign('areas', $cus_areas);		
		
		$this->assign('infotype', intval($_REQUEST['infotype']));
		$this->assign('status', '0');
		$this->assign('recommend', '0');
		$this->assign('source', '0');
		$this->assign('modelid', '0');
		$this->assign('browsecount', '0');
		$this->assign('fid', '0');
		$this->assign('type', 'add');
		$this->display('editInfo');
	}

	public function editInfo() {
		$this->assign('info_cate', $this->getinfo_cate(2));  
		$this->assign('property_types', C('PROPERTY_TYPE'));
		$this->assign('building_types', C('BUILDING_TYPE'));
		$this->assign('building_structs', C('BUILDING_STRUCTS'));
		$this->assign('traffic_positions', C('TRAFFIC_POSITION'));
		$this->assign('decorations', C('DECORATION'));
		$areas = M('Area')->where("view=1")->order('`area_id` ASC')->findAll();
		$cus_areas = array();
		foreach ( $areas as $area) {
			$cus_areas[$area['area_id']] = $area['title'];
		}
		$this->assign('areas', $cus_areas);
		
		if ( $_SESSION['issecondadmin']) {
			$map['uid_admin'] = $_SESSION['mid'];
		} elseif ( !$_SESSION['isadminman']) {
			$map['uid'] = $_SESSION['mid'];
		}
		
		$map['info_id'] = intval($_GET['id']);
		$ad = M('information')->where($map)->find();
		if(empty($ad)) 
			$this->error('参数错误');
		$this->assign($ad);
		$this->assign('type', 'edit');
		$this->display('editInfo');
	}

	public function doEditInfo() {
		$channels = $this->channels;
		if( ($_POST['info_id'] = intval($_POST['info_id'])) <= 0 )
			unset($_POST['info_id']);
		// 新闻焦点图
		// 新闻列表图
		$options['userId']		=	$this->mid;
		$options['max_size']    =   8*1024*1024;  //8MB
		$options['allow_exts']	=	'jpg,gif,png,jpeg,bmp';
		$info	=	X('Xattach')->upload('info_logo',$options);
		//print_r($info);
		//exit;
		
		if($info['status']) {
			$key = $info['info'][0]['key'];
			//echo 'key='.$key;
			//exit;
			if ($key == 'cover'){
				$_POST['cover'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];	
			} else {
				$_POST['smallcover'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];
			}
			if (count($info['info']) > 1){
				$_POST['smallcover'] = $info['info'][1]['savepath'] . $info['info'][1]['savename'];
			}
		}else{
			if (!isset($_POST['info_id'])){
				$_POST['cover'] = '';
				$_POST['smallcover'] = '';
			}
		}

		// 格式化数据
		$_POST['title']			= h(t($_POST['title']));
		$_POST['price']			= intval(t($_POST['price']));
		$_POST['opening_time']	= t(t($_POST['opening_time']));
		$_POST['opening_info']	= h($_POST['opening_info']);
		$_POST['benefit_info']	= h($_POST['benefit_info']);
		$_POST['remaining_house']= intval(t($_POST['remaining_house']));
		$_POST['opening_info']	= h(t($_POST['opening_info']));
		$_POST['total_area']	= intval(t($_POST['total_area']));
		$_POST['floor']			= h(t($_POST['floor']));
		$_POST['area']			= intval(t($_POST['area']));
		$_POST['location']		= h($_POST['location']);
		$_POST['movedate']		= h($_POST['movedate']);
		$_POST['property_type']	= intval($_POST['property_type']);
		$_POST['property_company']	= h($_POST['property_company']);
		$_POST['property_charges']	= h(t($_POST['property_charges']));
		$_POST['parking']		= h($_POST['parking']);
		$_POST['building_type']	= intval($_POST['building_type']);
		$_POST['building_structure']	= intval($_POST['building_structure']);
		$_POST['property_rights']	= h($_POST['property_rights']);
		$_POST['property_rights_years']	= intval($_POST['property_rights_years']);
		$_POST['double_gas']	= h($_POST['double_gas']);
		$_POST['decoration']	= h($_POST['decoration']);
		$_POST['household']		= intval($_POST['household']);
		$_POST['greening_rate']	= h($_POST['greening_rate']);
		$_POST['property_developers']	= h($_POST['property_developers']);
		$_POST['sale_permit']	= h($_POST['sale_permit']);
		$_POST['house_type']	= h($_POST['house_type']);
		$_POST['house_huxing']	= h($_POST['house_huxing']);
		$_POST['size']			= intval($_POST['size']);
		$_POST['traffic']		= h($_POST['traffic']);
		$_POST['school']		= h($_POST['school']);
		$_POST['seller']		= h($_POST['seller']);
		$_POST['phone']			= h($_POST['phone']);
		$_POST['tag']			= h($_POST['tag']);
		$_POST['status']		= intval($_POST['status']);
		$_POST['infotype']		= intval($_POST['infotype']);
		if (!$_POST['infotype']) {
			$this->error('未知错误！！！');
		}
		if (!isset($_POST['info_id'])){
			$_POST['uid']			= $this->mid;
			$this->assign('jumpUrl', U('home/Public/adminlogin'));
		}
		$_POST['mtime']			= time();
		if ( !isset($_POST['info_id']) ) 
			$_POST['ctime']		= time();

		// 数据检查
		if(empty($_POST['title']))
			$this->error('项目名称不能为空');

		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = isset($_POST['info_id']) ? '3' : '1';
		$data[] = "内容 - 修改".$channels[$_POST['infotype']]."信息";
		isset($_POST['info_id']) && $data[] =  M('information')->where( array( 'info_id'=>intval($_POST['info_id']) ) )->find();
		if ( isset($_POST['info_id']) ) unset( $data['1']['ctime'] );
		//unset( $data['1']['display_order'] );
		if( $_POST['__hash__'] )unset( $_POST['__hash__'] );
		$data[] = $_POST;
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);

		// 提交数据
		if (isset($_POST['info_id'])) {
			$map = array();
			if ( $_SESSION['issecondadmin']) {
				$map['uid_admin'] = $_SESSION['mid'];
			} elseif ( !$_SESSION['isadminman']) {
				$map['uid'] = $_SESSION['mid'];
			}
			$map['info_id'] = intval( $_POST['info_id']);
			$res = M('information')->where($map)->save($_POST);
		} else {
			if ( $_SESSION['issecondadmin']) {
				$_POST['uid_admin'] = $_SESSION['mid'];
			} elseif ( !$_SESSION['isadminman']) {
				$_POST['uid_admin'] = model('CUser')->getPid( $_SESSION['mid']);
			}
			$res = M('information')->add($_POST);
		}
		
		if($res) {
			if( !isset($_POST['info_id']) ) {
				$this->assign('jumpUrl', U('admin/Content/info'));
			}else {
				$this->assign('jumpUrl', U('admin/Content/info'));
			}
			$this->success('保存成功');
		}else {
			$this->error('保存失败');
		}
	}

	public function doDeleteInfo() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		//权限控制
		$map = array();
		if ( $_SESSION['issecondadmin']) {
			$map['uid_admin'] = $_SESSION['mid'];
		} elseif ( !$_SESSION['isadminman']) {
			$map['uid'] = $_SESSION['mid'];
		}
		
		$map['info_id'] = array('in', t($_POST['ids']));
		
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '2';
		$data[] = '内容 - 删除新闻管理 ';
		$data[] =  M('information')->where( $map )->findall();
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		echo M('information')->where($map)->delete() ? '1' : '0';
	}


	public function getinfo_cate($type = 0) {
		$map = ' status=1 and fid = '.$type;
		$data = M('information_cate')->where($map)->order('`sort_id` asc')->findAll();
		foreach ($data as $v){
			$catearr[$v['cate_id']] = $v['name'];	
		}
		return $catearr;
	}
	/** 内容管理- 相册管理 **/
	public function albums() {
		$fid = $_REQUEST['fid'] = intval( $_GET['fid']);
		$type = intval( $_GET['type']);
		if( !$type) {
			exit('缺少类型');
		}
		$map = " 1=1 ";
		if (isset($_REQUEST['fid'])){
			$map = $map." and fid=".$_REQUEST['fid'];
		}

		$order = ' sort_id desc,mtime desc,id DESC ';
		$data = M('albums')->where($map)->order($order)->findPage(10);
		
		$restaurant = M('ts_lifecontent')->field('cname')->where(array(id=>$fid))->find();
		
		$this->assign('res_name', $restaurant['cname']);
		$this->assign('type', $type);
		$this->assign('fid',  $fid);
		$this->assign('info', $data);
		$this->display();
	}
	//添加相片
	public function addAlbum() {
		$type = intval($_REQUEST['type']);
		$fid = intval($_REQUEST['fid']);
		$this->assign('type', $type);
		$this->assign('fid', $fid);
		$this->display('editAlbum');
	}
	
	public function editAlbum() {
		$type = intval($_REQUEST['type']);
		$fid = intval($_REQUEST['fid']);
		$this->assign('type', $type);
		$this->assign('fid', $fid);
		$map['id'] = intval($_GET['id']);
		$ad = M('albums')->where($map)->find();
		if(empty($ad))
			$this->error('参数错误');
		$this->assign($ad);
	
		$this->display('editAlbum');
	}
	
	public function doEditAlbum() {
		if( ($_POST['id'] = intval($_POST['id'])) <= 0 )
			unset($_POST['id']);
		// 新闻焦点图
		// 新闻列表图
		$options['userId']		=	$this->mid;
		$options['max_size']    =   80*1024*1024;  //8MB
		$options['allow_exts']	=	'jpg,gif,png,jpeg,bmp';
		$info	=	X('Xattach')->upload('info_logo',$options);
		if($info['status']) {
			$_POST['pic'] = $info['info'][0]['savepath'] . $info['info'][0]['savename'];
		}
		
		// 格式化数据
		$_POST['desc']		= h(t($_POST['desc']));
		$_POST['cate_id']	= intval($_POST['type']);
		$_POST['fid']		= intval($_POST['fid']);
		$_POST['sort_id']	= intval($_POST['sort_id']);
		$_POST['mtime']		= time();
		if (!isset($_POST['id'])){
			$_POST['uid']			= $this->mid;
		}

		if( !$_POST['cate_id'] || !$_POST['fid']) {
			$this->error('缺少参数');
		}
		// 提交数据
		$res = isset($_POST['id']) ? M('albums')->save($_POST) : M('albums')->add($_POST);
	
		if($res) {
			$this->assign('jumpUrl', U('admin/Content/albums',array('type'=>$_POST['type'],'fid'=>$_POST['fid'])));
			$this->success('保存成功');
		}else {
			$this->error('保存失败');
		}
	}
	
	public function doDeleteAlbum() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		$map['id'] = array('in', t($_POST['ids']));
	
		echo M('albums')->where($map)->delete() ? '1' : '0';
	}
		
	
	/** 内容 - 附件管理 */
	
	public function attach($map) {
		$dao = model('Attach');
		$attaches   = $dao->getAttachByMap($map);
		$extensions = $dao->enumerateExtension();
		$this->assign($attaches);
		$this->assign('extensions', $extensions);
		
		$this->assign($_POST);
		$this->assign('isSearch', empty($map)?'0':'1');
		$this->display('attach');
	}
	
	public function doSearchAttach() {
        // 安全过滤
        $_POST = array_map('t',$_POST);

		$map = $this->_getSearchMap(array('in' => array('id', 'userId', 'extension')));
		$this->attach($map);
	}
	
	public function doDeleteAttach() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '2';
		$data[] = '内容 - 附件管理 ';
		$map['id'] = array('in',t($_POST['ids']));
		$data[] = model('Attach')->getAttachByMap($map);
		$data[] = array('isFile'=>intval($_POST['withfile']));
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		echo model('Attach')->deleteAttach( t($_POST['ids']), intval($_POST['withfile']) ) ? '1' : '0';
	}
	
	/** 内容 - 短消息管理 */
	
	public function message($map) {
		$msg = model('Message')->getMessageByMap($map);
		$this->assign($msg);
		
		$this->assign($_POST);
		$this->assign('isSearch', empty($map)?'0':'1');
		$this->display('message');
	}
	
	public function doSearchMessage() {
        // 安全过滤
        $_POST = array_map('t',$_POST);
		
		// 标题模糊查询
    	if ( isset($_POST['title']) && $_POST['title'] != '' ) {
    		$_POST['title']	= '%' . $_POST['title'] . '%';
    	}
    	$map = $this->_getSearchMap( array('in'=>array('message_id','from_uid','to_uid'), 'like'=>array('title')) );
    	$this->message($map);
	}
	
	public function doDeleteMessage() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '2';
		$data[] = '内容 - 短消息管理';
		$map['message_id'] = array('in',t($_POST['ids']));
		$data[] = model('Message')->getMessageByMap($map);
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		echo model('Message')->deleteMessage( t($_POST['ids']) ) ? '1' : '0';
	}
	
	/**
	 * 后台日志管理
	 */
	public function adminLog($map){
		$data = M( 'AdminLog' )->where($map)->order('ID DESC')->findpage();
		$this->assign($data);
		$this->assign($_POST);
		$this->assign('isSearch', empty($map)?'0':'1');
		$this->display(adminLog);
	}
	
	public function showAdminLog(){
		$map['id'] = $_GET['id'];
		$data = M('AdminLog')->where($map)->find();

		$this->assign($data);
		$this->display();
	}
	
	public function doSearchAdminLog(){
		if(!$_POST['type'])
			unset($_POST['type']);
		// 安全过滤
        $_POST = array_map('t',$_POST);
		
		$map = $this->_getSearchMap(array('in'=>array('id','uid','type')));
		$this->adminLog($map);
	}
	
	public function doDeleteAdminLog() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		$where['id'] = array('in',t($_POST['ids']));
		echo M( 'AdminLog' )->where( $where )->delete() ? '1' : '0';
	}
	
	public function lookDetail(){
		$data = M( 'AdminLog' )->where( 'id='.$_POST['ids'] )->find();
		$this->assign($data);
		$this->display();
	}
}
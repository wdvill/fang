<?php
/*
资讯相关
*/
class InfoAction extends Action{
	var $info;
	public function _initialize(){
		$this->info = D("info");
	}
	
	public function index(){
		//查找所有区域信息
		$areas = M('Area')->where("view=1")->order('`area_id` ASC')->findAll();
		$cus_areas = array();
		foreach ( $areas as $area) {
			$cus_areas[$area['area_id']] = str_replace(array('市', '县', '区'), array(), $area['title']);
		}

		$infotype = intval($_REQUEST['infotype']) ? intval($_REQUEST['infotype']) : 1;
		$data['infotype'] = $infotype;
		$data['areas'] = $cus_areas;
		
		//标题
		$data['title'] = "新房速递";
		
		//价格选择
		$data['search_prices'] = C('SEARCH_PRICE');
		
		//房屋结构
		$data['building_structs'] = C('BUILDING_STRUCTS');
		
		//最新一手房源信息
		$order = ' info_id DESC ';
		$map = array();
		$map['infotype'] = $infotype;
		$map['status'] = 1;
		
		$url = 'index.php?app=home&mod=info';
		if ( $_REQUEST['area']) {
			$map['area'] = intval( $_REQUEST['area']);
			$url = $url."&area={$_REQUEST['area']}";
		}

		if ( !$_POST && $_REQUEST['search_price'] == '-1') {
			unset( $_REQUEST['start_price']);
			unset( $_REQUEST['end_price']);
		}
		
		if ( $_REQUEST['start_price'] && $_REQUEST['end_price']) {
			unset( $_REQUEST['search_price']);
			$map['price'] = array(array('egt', $_REQUEST['start_price']),array('lt', $_REQUEST['end_price']));
			$url = $url."&start_price={$_REQUEST['start_price']}";
			$url = $url."&end_price={$_REQUEST['end_price']}";
			$this->assign("sprice", $_REQUEST['start_price']);
			$this->assign("eprice", $_REQUEST['end_price']);
		}
		if ( $_REQUEST['search_price']) {
			$prices = C('SEARCH_PRICE');
			switch( $_REQUEST['search_price']) {
				case 1:
					$map['price']  = array('lt',10000);
					break;
				case 2:
					$map['price'] = array(array('egt', 10000),array('lt', 15000));
					break;
				case 3:
					$map['price'] = array(array('egt', 15000),array('lt', 20000));
					break;
				case 4:
					$map['price'] = array(array('egt', 20000),array('lt', 30000));
					break;
				case 5:
					$map['price'] = array(array('egt', 30000),array('lt', 40000));
					break;
				case 6:
					$map['price'] = array(array('egt', 40000),array('lt', 50000));
					break;
				case 7:
					$map['price']  = array('egt',50000);
					break;
			}
			$url = $url."&search_price={$_REQUEST['search_price']}";
		}
		if ( $_REQUEST['building_struct']) {
			$map['building_structure'] = intval( $_REQUEST['building_struct']);
			$url = $url."&building_struct={$_REQUEST['building_struct']}";
		}

		$data['info'] = M('information')->where($map)->order($order)->findPage(10);
		$data['url'] = $url;
		$this->assign($data);
		$this->display();
	}
	
	//资讯列表页
	public function lists(){
		$cate = $_REQUEST['cate'];
		//获取列表名称
		$data['cate'] = $this->info->getInfoCateById($cate);
		//获取资讯列表
		$map = "cate_id={$cate} AND status=1";
		$data['list'] = $this->info->getInfoListByMap($map,20,"*");
		
		//获取热门资讯
		$data['hot'] = $this->info->getHotInfo(10);
		$this->assign($data);
		$this->display();
	}
   	//关于
	public function detail2() {
		$info_id = $_REQUEST['ind'];
		$map['info_id'] = $info_id;
		$document = M('information')->where($map)->find();
		if ( empty($document) )
			$this->error('该新闻不存在');
		//$info['cate'] = $this->getInfoCateById($info['cate_id']);
		$info['title'] = real_strip_tags($info['title']);
		$info['intro'] = real_strip_tags($info['intro']);
		$info['cover'] = empty($info['cover']) ? '':__UPLOAD__.'/'.$info['cover'];
		$info['content'] = htmlspecialchars_decode($info['content']);
		$info['cdate'] = date("Y-m-d H:i",$info['ctime']);
		$info['mdate'] = date("Y-m-d H:i",$info['mtime']);
		
		$data['info']= $info;
		$this->assign($data);
		//$this->assign("title",real_strip_tags($document['title']));
		//$this->assign("content",htmlspecialchars_decode($document['content']));
			$this->display();
	}
	
	function detail(){
		$info_id = $_REQUEST['ind'];
		if(!is_numeric($info_id) || !$data['info'] = $this->info->getInfoDetail($info_id))
			handleErrorByJs("该信息不存在！",U("home/info/index"));
		
		$areas = M('Area')->where("view=1")->order('`area_id` ASC')->findAll();
		$cus_areas = array();
		foreach ( $areas as $area) {
			$cus_areas[$area['area_id']] = str_replace(array('市', '县', '区'), array(), $area['title']);
		}
		$this->assign('infotype', $_REQUEST['infotype']);
		$this->assign('areas', $cus_areas);
		
		$data['title'] = "找房子";
		
		$this->assign('property_types', C('PROPERTY_TYPE'));
		$this->assign('building_types', C('BUILDING_TYPE'));
		$this->assign('search_prices', C('SEARCH_PRICE'));
		$this->assign('traffic_positions', C('TRAFFIC_POSITION'));
		$this->assign('decorations', C('DECORATION'));
		
		//楼盘户型图信息
		$map = ' info_id ='.$data['info']['info_id'];
		$order = ' sort_id desc,id desc ';
		$data['sub_info'] = M('ts_sub_info')->where($map)->order($order)->findPage(10);

		$this->assign($data);
		if( $data['info']['infotype'] == 1) {
			$this->display("newhouse");
		}
	}
	
	function lpinfor() {
		$info_id = $_REQUEST['ind'];
		if(!is_numeric($info_id) || !$data['info'] = $this->info->getInfoDetail($info_id))
			handleErrorByJs("该信息不存在！",U("home/info/index"));
		
		$this->assign($data);
		$this->display();
	}
	//资讯转发微博
	function transpond(){
		$info_id = intval($_POST['id']);
		if($info_id <= 0) return ;
		
		$info = M('information')->where('info_id='.$info_id.' AND status=1')->field('title')->find();
		$info_url = getShortUrl($this->info->getInfoUrl('detail',array('ind'=>$info_id)));
		$data['content'] = $info['title'].' '.$info_url.' （来自资讯频道）';
		//转发至微博
		if(D("Weibo","weibo")->publish( $this->mid,$data,$info_id,0,'','','info')){
			echo U('weibo/index/mine');
		}
		exit;
	}
	
	//资讯搜索
	public function search() {
		$search_key = $this->_getSearchKey();
		if(!empty($search_key)){
			$map = "title LIKE '%".$search_key."%' OR intro LIKE '%".$search_key."%' OR content LIKE '%".$search_key."%'";
			$data['list'] = $this->info->getInfoListByMap($map,20,'info_id,cate_id,title,intro,cover,ctime','info_id DESC');
		}
		$this->assign($data);
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
			$_SESSION['friend_search_' . $key_name] = serialize( $key );
		}else if ( is_numeric($_GET[C('VAR_PAGE')]) ) {
			$key = unserialize( $_SESSION['friend_search_' . $key_name] );
		}			
		$this->assign('search_key', h(t($key)));
		return trim($key);
	}
	
	/**
	 * 保存用户的优惠申请
	 */
	public function send_preferential() {
		$data = array();
		$info_id = intval( $_POST['info_id']);
		$buy_name = html_entity_decode( urldecode($_POST['buy_name']) ,ENT_QUOTES);
		$buy_phone = html_entity_decode( urldecode($_POST['buy_phone']) ,ENT_QUOTES);
		$buy_house_id = html_entity_decode( urldecode($_POST['buy_house_id']) ,ENT_QUOTES);
		$buy_seller = html_entity_decode( urldecode($_POST['buy_seller']) ,ENT_QUOTES);
		
		if ( !$info_id) {
			exit(0);
		}
		//判断是否有此房源
		$infoArr = M('information')->where("info_id = $info_id")->find();
		$data['uid'] = $infoArr['uid'];
		$data['uid_admin'] = $infoArr['uid_admin'];

		//过滤完参数，保存数据
		$data['info_id'] = $info_id;
		$data['buy_name'] = $buy_name;
		$data['buy_phone'] = $buy_phone;
		$data['buy_house_id'] = $buy_house_id;
		$data['buy_seller'] = $buy_seller;
		$pre_id = M('preferential')->add($data);
		exit($pre_id);
	}
	
	/**
	 * 保存用户的挑错信息
	 */
	public function find_fault() {
		$data = array();
		$info_id = intval( $_POST['info_id']);
		$fault_type = $_POST['fault_type'];
		$fault_content = html_entity_decode( urldecode($_POST['fault_content']) ,ENT_QUOTES);
	
		foreach( $fault_type as $type) {
			$data['fault_'.intval($type)] = 1;
		}
		
		//判断是否有此房源
		$infoArr = M('information')->where("info_id = $info_id")->find();
		$data['uid'] = $infoArr['uid'];
		$data['uid_admin'] = $infoArr['uid_admin'];
		
		//过滤完参数，保存数据
		$data['info_id'] = $info_id;
		$data['fault_content'] = $fault_content;

		$faults_id = M('faults')->add($data);
		exit( $faults_id);
	}
}
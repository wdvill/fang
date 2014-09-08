<?php
/*
资讯相关
*/
class InfoAction extends Action{
	var $info;
	public function _initialize(){
		$this->info = D("Info");
	}
	
	public function index(){
		//获取资讯分类
		$data['cate_name'] = $this->info->getInfoCateListByCate();
		
		//获取资讯列表
		$data['list'] = $this->info->getHomeInfoList(9);
		
		//获取推荐资讯
		$data['recommend'] = $this->info->getRecommendInfo(5);
		
		//获取热门资讯
		$data['hot'] = $this->info->getHotInfo(10);
		
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
			handleErrorByJs("该资讯不存在！",U("home/info/index"));
		
		//更新点击数量
		$this->info->InfoBrowseCount($info_id);
		//获取热门资讯
		//$data['hot'] = $this->info->getHotInfo(10);
			
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
}
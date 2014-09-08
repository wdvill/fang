<?php 
class AcyApi extends Api{
	//http://www.tsqss.com.cn/index.php?app=api&mod=zsts&act=getchannel&type=2    //获取新闻频道的栏目
		
	var $site_pre_url = "http://www.fang.com";

	//格式化字符串
	//将null转化为""
	function formatStr($str){
		if (is_null($str)){
			return "";
		} else if (strlen($str) == 0){
			return "";
		}
		return $str;
	}
	
	function logapi($tabname){
		//调试代码开始
		$geturl = "From URL : ".$this->site_pre_url.$_SERVER['REQUEST_URI']."\n\n";
		$lastsql = "Execute sql : ".M($tabname)->getLastSql()."\n\n";
		$nowtime = "Execute time : ".date("Y-m-d H:i:s")."\n\n";
		$str = "\n".$nowtime.$geturl.$lastsql."\n";
		$k2=fopen("/var/www/other/zsts/api/api2.log.txt","a+");
		$k=fopen("/var/www/other/zsts/api/api.log.txt","w");
		fwrite($k,$str);
		fclose($k);
		fwrite($k2,$str);
		fclose($k2);
		//调试代码结束
	}
	
	/**
	 * 计算两组经纬度坐标 之间的距离
	 * params ：lat1 纬度1； lng1 经度1； lat2 纬度2； lng2 经度2； len_type （1:m or 2:km);
	 * return m or km
	 */
	function GetDistance($lat1, $lng1, $lat2, $lng2, $len_type = 1, $decimal = 2)
	{
	   define('EARTH_RADIUS', 6378.137);//地球半径，假设地球是规则的球体
	   define('PI', 3.1415926);
	   $radLat1 = $lat1 * PI / 180.0;
	   $radLat2 = $lat2 * PI / 180.0;
	   $a         = $radLat1 - $radLat2;
	   $b         = ($lng1 * PI / 180.0) - ($lng2 * PI / 180.0);
	   $s = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
	   $s = $s * EARTH_RADIUS;
	   $s = round($s * 1000);
	   if ($len_type > 1)
	   {
	       $s /= 1000;
	   }
	   
	   return round($s, $decimal);
	}
	//echo GetDistance(39.908156,116.4767, 39.908452,116.450479, 2);//输出距离/米
	
	//1 普通频道接口 getchannel
	//支持两级频道
	//分类现在为2：新闻，3：优惠，4：微刊，5：生活。
	function getchannel($type=2){
		$type = intval($_REQUEST['type']);
		$map = ' fid ="'.$type.'" AND status=1';
		$order = ' sort_id ASC ';
		$field = 'cate_id,img,name,sort_id';
		$error_arr = array("errorCode" => "-1", "errorMessage" => "输入的类别没有数据");

		
		$res = M('information_cate')->where($map)->order($order)->field($field)->findAll();
		if ($res){
			foreach($res as $k=>$v){
				$v3['cid'] = $v['cate_id'];					//频道的id
				$v3['cname'] = $this->formatStr($v['name']);					//频道的名字
				$v3['cpic'] = $this->formatStr($v['img']);
				if (strlen($v3['cpic']) > 0){
					if (!strpos($v3['cpic'], "http:")){
						$v3['cpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['cpic'];
					}
				} else {
					$v3['cpic'] = '';
				}
				$v3['sortable'] = $this->formatStr($v['sort_id']);			//频道的排列顺序
			
				$return['data'][$k] = $v3;

				$subtype = $v['cate_id'];
				$map = ' fid ="'.$subtype.'" AND status=1';
				$order = ' sort_id ASC ';
				$field = 'cate_id,name,sort_id';
				$res1 = M('information_cate')->where($map)->order($order)->field($field)->findAll();
				if ($res1){
					foreach($res1 as $k1=>$v1){
						$v4['scid'] = $v1['cate_id'];
						$v4['scname'] = $this->formatStr($v1['name']);
						$v4['scpic'] = $this->formatStr($v1['img']);
				if (strlen($v4['scpic']) > 0){
					if (!strpos($v4['scpic'], "http:")){
						$v4['scpic'] =  $this->site_pre_url.'/data/uploads/'.$v4['scpic'];
					}
				} else {
					$v4['scpic'] = '';
				}
						$v4['ssortable'] = $this->formatStr($v1['sort_id']);
			
						$return['data'][$k]['subchannel'][$k1] = $v4;
					}
				} else {
					$return['data'][$k]['subchannel'] = array();
				}
			}
			$this->logapi('information_cate');
			return $return;
		} else {
			$this->logapi('information_cate');
			return $error_arr;
		}
	}
	
	//2 所有订阅频道接口 getsubchannel
	//支持两级频道
	//分类现在为1:订阅
	function getsubchannel(){
		$type = 1;
		$map = ' fid ="'.$type.'" AND status=1';
		$order = ' sort_id ASC ';
		$field = 'cate_id,name,sort_id';
		$error_arr = array("errorCode" => "-1", "errorMessage" => "输入的类别没有数据");

		
		$res = M('information_cate')->where($map)->order($order)->field($field)->findAll();
		if ($res){
			foreach($res as $k=>$v){
				$v3['cid'] = $v['cate_id'];					//频道的id
				$v3['cname'] = $this->formatStr($v['name']);					//频道的名字
				//$v3['cicon'] = $v['img']?$v['img']:'';
				$v3['sortable'] = $this->formatStr($v['sort_id']);			//频道的排列顺序
			
				$return['data'][$k] = $v3;

				$subtype = $v['cate_id'];
				if ($subtype == 8){
					$map = ' fid = 0 AND status=1 and infotype=4 and ordertype=1';    //ordertype=1为微刊订阅频道下的微刊，ordertype=2为单独订阅的微刊
					$order = ' info_id desc ';
					$field = 'info_id,title,cicon,intro';
					$res1 = M('information')->where($map)->order($order)->field($field)->findAll();
					if ($res1){
						foreach($res1 as $k1=>$v1){
							$v4['scid'] = $v1['info_id'];
							$v4['scname'] = $this->formatStr($v1['title']);
							$v4['scicon'] = $this->formatStr($v1['cicon']);
							if (strlen($v4['scicon']) > 0){
								if (!strpos($v4['scicon'], "http:")){
									$v4['scicon'] =  $this->site_pre_url.'/data/uploads/'.$v4['scicon'];
								}
							} else {
								$v4['scicon'] = '';
							}
							$v4['ssortable'] = $this->formatStr($v1['info_id']);
							$v4['surl'] = "nourl";
				
							$return['data'][$k]['subchannel'][] = $v4;
						}
					} else {
						$return['data'][$k]['subchannel'] = array();
					}
				} else if ($subtype == 9){
					$map = ' fid = 0 AND status=1 and cate_id = 9';
					$order = ' info_id desc ';
					$field = 'info_id,intro,title,cicon';
					$res1 = M('information')->where($map)->order($order)->field($field)->findAll();
					if ($res1){
						foreach($res1 as $k1=>$v1){
							if ('关于我们' != $v1['title']){   //关于我们是介绍，不能订阅
								$v4['scid'] = $v1['info_id'];
								$v4['scname'] = $this->formatStr($v1['title']);
								$v4['scicon'] = $this->formatStr($v1['cicon']);
								if (strlen($v4['scicon']) > 0){
									if (!strpos($v4['scicon'], "http:")){
										$v4['scicon'] =  $this->site_pre_url.'/data/uploads/'.$v4['scicon'];
									}
								} else {
									$v4['scicon'] = '';
								}
								$v4['ssortable'] = $this->formatStr($v1['info_id']);
								$v4['surl'] = $this->formatStr($v1['intro']); //在便民服务里面，暂时由intro字段存放url地址
				
								$return['data'][$k]['subchannel'][] = $v4;
							}
						}
					} else {
						$return['data'][$k]['subchannel'] = array();
					}
				}
			}
			$this->logapi('information_cate');
			return $return;
		} else {
			$this->logapi('information_cate');
			return $error_arr;
		}
	}
	
	//3 焦点图接口 getFocus
	//分类现在为1:首页的焦点图，2：新闻频道的焦点图,大于2的为微刊栏目的Id（如果微刊栏目是有推荐图的话）
	function getfocus($type=1){
		$type = intval($_REQUEST['type']);
		$type = 1;
		$map =' recommend > 0 and length(cover) > 0 and status = 1'; 
		$order = ' status desc,sort_id desc,mtime desc,info_id DESC ';
		$field = 'info_id,title,cover';
		
		$res = M('information')->where($map)->order($order)->field($field)->findAll();
		if ($res){
			foreach($res as $k=>$v){
				$v3['cid'] = $v['info_id'];		//焦点图的内容id
				$v3['ctitle'] = $this->formatStr($v['title']);	//焦点图的标题
				$v3['cpic'] = $this->formatStr($v['cover']);		//焦点图的图片地址
				if (strlen($v3['cpic']) > 0){
					if (!strpos($v3['cpic'], "http:")){
						$v3['cpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['cpic'];
					}
				} else {
					$v3['cpic'] = '';
				}
				$v3['curl'] = $this->site_pre_url.'/info/'.$v['info_id'];	//焦点图指向的内容的链接地址
			
				$return['data'][$k] = $v3;
			}
			$this->logapi('information');
			return $return;
		} else {
			$this->logapi('information');
			return array();
		}
	}
	
	
	//4 单个微刊列表获取接口 getonemagazinelist
	//cid为微刊名称
	//返回内容为微刊名称下面的每一期微刊，为列表形式
	function getonemagazinelist(){
		$cid = intval($_REQUEST['cid']);
		$page = intval($_REQUEST['page']) ? intval($_REQUEST['page']):1;
		$pagesize = intval($_REQUEST['pagesize']) ? intval($_REQUEST['pagesize']) : 10;
		$page_fir = ($page-1)*$pagesize;
		$map = ' status=1 and infotype = 4 and fid='.$cid;
		$order = ' info_id DESC ';
		$field = ' info_id,title,intro,smallcover,contenttype,ctime';
		$error_arr = array("errorCode" => "-1", "errorMessage" => "输入的微刊id下没有内容");

		
		$res = M('information')->where($map)->order($order)->field($field)->limit("$page_fir,$pagesize")->findAll();
		if ($res){
			foreach($res as $k=>$v){
				$v3['cid'] = $v['info_id'];  			//内容的id
				$v3['ctitle'] = $this->formatStr($v['title']);			//内容的标题
				$v3['cbrief'] = $this->formatStr($v['intro']);			//内容的简介
				$v3['cpic'] = $this->formatStr($v['smallcover']);			//内容的列表图片
				if (strlen($v3['cpic']) > 0){
					if (!strpos($v3['cpic'], "http:")){
						$v3['cpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['cpic'];
					}
				} else {
					$v3['cpic'] = '';
				}
				$v3['ctype'] = $this->formatStr($v['contenttype']);				//内容是否是图片列表，如果为0是，为1就为新闻链接
				if ($v3['ctype'] == 1){
					$v3['curl'] = $this->site_pre_url.'/info/'.$v['info_id'];		//详细内容的链接地址
				} else {
					$v3['curl'] = 'nourl';
				}
				$v3['ctime'] = date('Y-m-d H:i:m',$v['ctime']);	//内容创建的时间
			
				$return['data'][$k] = $v3;
			}
			$this->logapi('information');
			return $return;
		} else {
			$this->logapi('information');
			return $error_arr;
		}
	}
	
	//5 新闻内容列表获取接口 getnewslist
	//type为频道id,可以为主频道，也可以为子频道
	//返回内容为普通新闻的话，直接通过url让用户在浏览器查看
	//如果为微刊或者优惠或者专题，则需要调用getsubcontent接口查看下一层的内容
	function getnewslist($rmap=''){
		$cid = intval($_REQUEST['type']);
		$page = intval($_REQUEST['page']) ? intval($_REQUEST['page']):1;
		$pagesize = intval($_REQUEST['pagesize']) ? intval($_REQUEST['pagesize']) : 10;
		$page_fir = ($page-1)*$pagesize;
		$map = ' status=1 and infotype=2 and source != 2 and recommend <= 0 and cate_id='.$cid;
		if( $rmap) {
			$map = $rmap;
		}
		$order = ' sort_id desc,ctime DESC ';   //mtime改为ctime，按照新闻的创建时间排序，而不是修改时间。lzf 2013.3.8
		$field = ' info_id,title,intro,smallcover,source,infotype,ctime';
		$error_arr = array("errorCode" => "-1", "errorMessage" => "输入的频道下没有数据");

		
		$res = M('information')->where($map)->order($order)->field($field)->limit("$page_fir,$pagesize")->findAll();
		if ($res){
			foreach($res as $k=>$v){
				$v3['cid'] = $v['info_id'];  			//内容的id
				$v3['ctitle'] = $this->formatStr($v['title']);			//内容的标题
				$v3['cbrief'] = $this->formatStr($v['intro']);			//内容的简介
				$v3['csource'] = $this->formatStr($v['source']);			//内容的来源，比如外链、专题等,1为专题,2为专题下新闻，0为普通新闻
				$v3['cfocuspic'] = $this->formatStr($v['cover']);			//内容的焦点图图片
				if (strlen($v3['cfocuspic']) > 0){
					if (!strpos($v3['cfocuspic'], "http:")){
						$v3['cfocuspic'] =  $this->site_pre_url.'/data/uploads/'.$v3['cfocuspic'];
					}
				} else {
					$v3['cfocuspic'] = '';
				}
				$v3['cpic'] = $this->formatStr($v['smallcover']);			//内容的列表图片
				if (strlen($v3['cpic']) > 0){
					if (!strpos($v3['cpic'], "http:")){
						$v3['cpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['cpic'];
					}
				} else {
					$v3['cpic'] = '';
				}
				$v3['ctopicpic'] = $this->formatStr($v['cicon']);			//内容的专题图片
				if (strlen($v3['ctopicpic']) > 0){
					if (!strpos($v3['ctopicpic'], "http:")){
						$v3['ctopicpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['ctopicpic'];
					}
				} else {
					$v3['ctopicpic'] = '';
				}
				//$v3['ctype'] = $v['infotype'];			//内容的类型，如新闻、图片等
				$v3['ctime'] = date('Y-m-d H:i:m',$v['ctime']);	//内容创建的时间
				$v3['curl'] = $this->site_pre_url.'/info/'.$v['info_id'];		//详细内容的链接地址
			
				$return['data'][$k] = $v3;
			}
			$this->logapi('information');
			return $return;
		} else {
			$this->logapi('information');
			return $error_arr;
		}
	}
	
	private function getpictopic( $type, $recommend=0) {
		$cid = intval($type);
		$page = intval($_REQUEST['page']) ? intval($_REQUEST['page']):1;
		$pagesize = intval($_REQUEST['pagesize']) ? intval($_REQUEST['pagesize']) : 20;
		$page_fir = ($page-1)*$pagesize;
		$map = ' status=1 and infotype = 3 and cate_id='.$cid;
		if ( $recommend == 1){
			$map .= ' and recommend = 1';
		}
		$order = ' sort_id desc,mtime DESC ';
		$field = ' info_id,title,intro,smallcover,source,infotype,ctime';
		$error_arr = array("errorCode" => "-1", "errorMessage" => "输入的频道下没有数据");
		
		
		$res = M('information')->where($map)->order($order)->field($field)->limit("$page_fir,$pagesize")->findAll();
		if( !$res) {
			return array();
		}
		if ($res){
			foreach($res as $k=>$v){
				$v3['cid'] = $v['info_id'];  			//内容的id
				$v3['ctitle'] = $this->formatStr($v['title']);			//内容的标题
				$v3['cpic'] = $this->formatStr($v['smallcover']);			//内容的列表图片
				if (strlen($v3['cpic']) > 0){
					if (!strpos($v3['cpic'], "http:")){
						$v3['cpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['cpic'];
					}
				} else {
					$v3['cpic'] = '';
				}
		
				$return['data'][$k] = $v3;
			}
			return $return;
		} else {
			return $error_arr;
		}
	}
	//6 优惠内容列表获取接口 getrecommendlist
	//type为频道id,可以为主频道，也可以为子频道
	//返回内容为普通新闻的话，直接通过url让用户在浏览器查看
	//如果为微刊或者优惠或者专题，则需要调用getsubcontent接口查看下一层的内容
	function getrecommendlist(){
		$type = 17;
		return $this->getpictopic($type);
	}
	//吃喝专题
	public function getrestaurant() {
		$type = 7;
		return $this->getpictopic($type);
	}
	//玩乐专题
	public function getplayplace() {
		$type = 8;
		return $this->getpictopic($type);
	}
	//吃喝专题下子餐厅
	public function getsublife() {
		$topic_id = intval($_REQUEST['topic_id']);
		if( !$topic_id) {
			return array();
		}
		$map = " status=1 and topic_id={$topic_id} ";
		$field = ' id,cname,consume,cate_id,smallpic as cpic,address,intro ';
		$rlist = $this->getlifelist('0', $field, $map);
		
		$cateList = M('information_cate')->where('fid=4 or fid=5')->field('cate_id, name')->findAll();
		$aCate = array();
		foreach( $cateList as $cate) {
			$aCate[$cate['cate_id']] = $cate['name'];
		}
		foreach( $rlist as $key=>$list) {
			$rlist[$key]['cate_name'] = $aCate[$list['cate_id']];
			unset($rlist[$key]['cate_id']);
		}
		return $rlist;
	}
	//玩乐专题下子玩乐场所
	
	//吃喝推荐
	public function getrstrecommond() {
		$_REQUEST['page'] = 1;
		$_REQUEST['pagesize'] = 8;
		$type = 7;
		return $this->getpictopic($type, 1);
	}
	//玩乐推荐
	public function getpprecommond() {
		$_REQUEST['page'] = 1;
		$_REQUEST['pagesize'] = 8;
		$type = 8;
		return $this->getpictopic($type, 1);
	}
	//7 微刊频道列表获取接口 getmagazinelist
	//type为频道id,可以为主频道，也可以为子频道
	//返回内容为普通新闻的话，直接通过url让用户在浏览器查看
	//如果为微刊或者优惠或者专题，则需要调用getsubcontent接口查看下一层的内容
	function getchaoyanglist(){
		$page = intval($_REQUEST['page']) ? intval($_REQUEST['page']):1;
		$pagesize = intval($_REQUEST['pagesize']) ? intval($_REQUEST['pagesize']) : 10;
		$page_fir = ($page-1)*$pagesize;
		$map = ' status=1 and infotype = 4';

		$order = ' sort_id desc,mtime desc,info_id DESC ';
		$field = ' info_id,title,intro,smallcover,source,infotype,ctime';
		$error_arr = array("errorCode" => "-1", "errorMessage" => "输入的频道下没有数据");
		
		$res = M('information')->where($map)->order($order)->field($field)->limit("$page_fir,$pagesize")->findAll();
		if( !$res) {
			return array();
		}
		if ($res){
			foreach($res as $k=>$v){
				$v3['cid'] = $v['info_id'];  			//内容的id
				$v3['ctitle'] = $this->formatStr($v['title']);			//内容的标题
				//$v3['cbrief'] = $this->formatStr($v['intro']);			//内容的简介
				$v3['cpic'] = $this->formatStr($v['smallcover']);			//内容的列表图片
				if (strlen($v3['cpic']) > 0){
					if (!strpos($v3['cpic'], "http:")){
						$v3['cpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['cpic'];
					}
				} else {
					$v3['cpic'] = '';
				}
				$v3['ctime'] = date('Y-m-d H:i:m',$v['ctime']);	//内容创建的时间
				$v3['curl'] = $this->site_pre_url.'/info/'.$v['info_id'];		//详细内容的链接地址
				$return['data'][$k] = $v3;
			}
			$this->logapi('information');
			return $return;
		} else {
			$this->logapi('information');
			return $error_arr;
		}
	}
	
	// 获取餐厅列表
	function getrestaurantlist() {
		$cid = 5;
		$field = ' id,cname,consume,cate_id,smallpic as cpic,address';
		$rlist = $this->getlifelist($cid, $field);
		
		$cateList = M('information_cate')->where('fid='.$cid)->field('cate_id, name')->findAll();
		$aCate = array();
		foreach( $cateList as $cate) {
			$aCate[$cate['cate_id']] = $cate['name'];
		}
		foreach( $rlist as $key=>$list) {
			$rlist[$key]['cate_name'] = $aCate[$list['cate_id']];
			unset($rlist[$key]['cate_id']);
		}
		return $rlist;
	}
	
	// 获取玩乐列表
	function getplayplacelist() {
		$cid = 4;
		$field = ' id,cname,consume,cate_id,smallpic as cpic,address';
		$rlist = $this->getlifelist($cid, $field);
	
		$cateList = M('information_cate')->where('fid='.$cid)->field('cate_id, name')->findAll();
		$aCate = array();
		foreach( $cateList as $cate) {
			$aCate[$cate['cate_id']] = $cate['name'];
		}
		foreach( $rlist as $key=>$list) {
			$rlist[$key]['cate_name'] = $aCate[$list['cate_id']];
			unset($rlist[$key]['cate_id']);
		}
		return $rlist;
	}
	
	//获取餐厅详细信息
	function rstdetail() {
		$id = intval($_REQUEST['id']);
		if( !$id) {
			return array();
		}
		$map = " id={$id} and status=1 ";
		
		$res = M('ts_lifecontent')->where($map)->find();
		if( !$res) {
			return array();
		}
		
		$cpic = $this->formatStr($res['pic']);			//内容的列表图片
		if (strlen($cpic) > 0){
			if (!strpos($cpic, "http:")){
				$cpic =  $this->site_pre_url.'/data/uploads/'.$cpic;
			}
		} else {
			$cpic = '';
		}
		
		//获取餐厅相片集
		$detail = array();
		$detail['id'] = $res['id'];
		$detail['cname'] = $res['cname'];
		$detail['cpic'] = $cpic;
		$detail['telephone'] = $res['telephone'];
		$detail['address'] = $res['address'];
		$detail['sdish'] = $res['sdish'];		//招牌菜
		$detail['intro'] = $res['intro'];		//推荐理由
		$detail['consume'] = $res['consume'];
		$detail['clongitude'] = $res['longitude'];
		$detail['clatitude'] = $res['latitude'];
		
		//照片
		$detail['albums'] = $this->getlifeAlbums($id);
		return $detail;
	}
	/**
	 * 获取某个的相片集
	 * @param unknown_type $fid
	 */
	private function getlifeAlbums($fid) {
		if( !$fid) {
			return array();
		}
		
		$field = array('pic', 'desc');
		$map = " fid={$fid} ";
		$order = ' sort_id desc,id DESC ';
		$res = M('albums')->field($field)->where($map)->order($order)->limit("0,15")->findAll();
		if( !$res) {
			return array();
		}
		foreach( $res as $key=>$album) {
			$cpic = $this->formatStr($album['pic']);			//内容的列表图片
			if (strlen($cpic) > 0){
				if (!strpos($cpic, "http:")){
					$cpic =  $this->site_pre_url.'/data/uploads/'.$cpic;
				}
			} else {
				$cpic = '';
			}
			$res[$key]['pic'] = $cpic;
		}
		return $res;
	}
	//获取餐厅分类列表
	function getrestaurantcate() {
		$fid = 5;
		return $this->getcatlist($fid);
	}
	//获取玩乐分类列表
	function getplaypalcecate() {
		$fid = 4;
		return $this->getcatlist($fid);
	}
	private function getcatlist( $fid) {
		$field = array('cate_id', 'name');
		$map = " fid={$fid} ";
		$order = ' sort_id desc,cate_id DESC ';
		$res = M('information_cate')->field($field)->where($map)->order($order)->findAll();
		if( !$res) {
			return array();
		}
		return $res;
	}
	
	function getlifelist($cid, $field, $rwmap='', $limit=true) {
		$map = ' status=1 and cid='.$cid;
		$cate_id = $_REQUEST['type'];
		if( $cate_id) {
			$map .= ' and cate_id='.$cate_id;
		}
		$cname = $_REQUEST['cname'];
		if( $cname) {
			$map .= " and `cname` like '%{$cname}%' ";
		}
		if( $rwmap) {
			$map = $rwmap;
		}
		$order = ' sort_id desc,id DESC ';
		$error_arr = array("errorCode" => "-1", "errorMessage" => "输入的频道下没有数据");
		$page = intval($_REQUEST['page']) ? intval($_REQUEST['page']):1;
		$pagesize = intval($_REQUEST['pagesize']) ? intval($_REQUEST['pagesize']) : 15;
		$page_fir = ($page-1)*$pagesize;
		
		if( $limit === false) {
			$res = M('ts_lifecontent')->where($map)->order($order)->field($field)->findAll();
		} else {
			$res = M('ts_lifecontent')->where($map)->order($order)->field($field)->limit("$page_fir,$pagesize")->findAll();
		}
		
		if( !$res) {
			return array();
		}
		foreach($res as $k=>$v){
			$cpic = $this->formatStr($v['cpic']);		//商家的列表图片
			if (strlen($cpic) > 0){
				if (!strpos($cpic, "http:")){
					$cpic =  $this->site_pre_url.'/data/uploads/'.$cpic;
				}
			} else {
				$cpic = '';
			}
			
			$res[$k]['cpic'] = $cpic;
		}
		return $res;

	}

	//9 子内容列表获取接口 getsubcontent
	//type为分类，其中1：图片，2：微刊，3：专题。
	//cid为主内容的id,可以优惠券的id，也可以为微刊每一期的id或者专题的id
	function getsubcontent($type=1,$cid=11){
		$type = intval($_REQUEST['type']);
		$cid = intval($_REQUEST['cid']);
		$page = intval($_REQUEST['page']) ? intval($_REQUEST['page']):1;
		$pagesize = intval($_REQUEST['pagesize']) ? intval($_REQUEST['pagesize']) : 10;
		$page_fir = ($page-1)*$pagesize;
		
		if ($type == 3){  //专题
			$map = ' fid='.$cid;
			$order = ' sort_id desc,mtime desc,info_id DESC ';
			$field = ' info_id,title,intro,smallcover';
			$error_arr = array("errorCode" => "-1", "errorMessage" => "输入的内容下没有数据");
		
			$res = M('information')->where($map)->order($order)->field($field)->limit("$page_fir,$pagesize")->findAll();
			if ($res){
				foreach($res as $k=>$v){
					$v3['scid'] = $v['info_id'];							//子内容的id
					$v3['sctitle'] = $this->formatStr($v['title']);							//子内容的标题
					$v3['scbrief'] = $this->formatStr($v['intro']);							//子内容的简介
					$v3['scpic'] = $this->formatStr($v['smallcover']);						//子内容的图片地址
					$v3['curl'] = $this->site_pre_url.'/info/'.$v['info_id'];		//详细内容的链接地址
					if (strlen($v3['scpic']) > 0){
						if (!strpos($v3['scpic'], "http:")){
							$v3['scpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['scpic'];
						}
					} else {
						$v3['scpic'] = '';
					}
			
					$return['data'][$k] = $v3;
				}
				$this->logapi('information');
				return $return;
			} else {
				$this->logapi('information');
				return $error_arr;
			}
		} else {
			$map = ' info_id='.$cid;
			$order = ' sort_id desc,id DESC ';
			$field = ' id,title,intro,type,pic,info_id';
			$error_arr = array("errorCode" => "-1", "errorMessage" => "输入的内容下没有数据");

			$res = M('ts_sub_info')->where($map)->order($order)->field($field)->limit("$page_fir,$pagesize")->findAll();
			if ($res){
				foreach($res as $k=>$v){
					$v3['scid'] = $v['id'];									//子内容的id
					$v3['sctitle'] = $this->formatStr($v['title']);							//子内容的标题
					$v3['scbrief'] = $this->formatStr($v['intro']);							//子内容的简介
					$v3['scpic'] = $this->formatStr($v['pic']);								//子内容的图片地址
				if (strlen($v3['scpic']) > 0){
					if (!strpos($v3['scpic'], "http:")){
						$v3['scpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['scpic'];
					}
				} else {
					$v3['scpic'] = '';
				}
			
					$return['data'][$k] = $v3;
				}
				$this->logapi('ts_sub_info');
				return $return;
			} else {
				$this->logapi('ts_sub_info');
				return $error_arr;
			}
		}
	}
	
	
	//10 生活服务内容搜索获取接口 searchlifelist
	//type为频道id,可以为主频道，也可以为子频道，默认为全部
	//key为搜索关键字
	function searchlifelist($type=0,$key){
		$key = trim($_REQUEST['key']);
		$type = intval($_REQUEST['type']) ? intval($_REQUEST['type']):0;
		$page = intval($_REQUEST['page']) ? intval($_REQUEST['page']):1;
		$pagesize = intval($_REQUEST['pagesize']) ? intval($_REQUEST['pagesize']) : 10;
		$page_fir = ($page-1)*$pagesize;
		$map = " status=1 and (cname like '%".$key."%' or tag like '%".$key."%' or intro like '%".$key."%') ";
		if ($type != 0)
			$map = " status=1 and cate_id = ".$type." and (cname like '%"
			.$key."%' or tag like '%".$key."%' or intro like '%".$key."%') ";
		$order = ' sort_id desc,id DESC ';
		$field = ' id,cname,tag,intro,smallpic,ctime';
		$error_arr = array("errorCode" => "-1", "errorMessage" => "没有搜索到数据");

		
		$res = M('ts_lifecontent')->where($map)->order($order)->field($field)->limit("$page_fir,$pagesize")->findAll();
		if ($res){
			foreach($res as $k=>$v){
				$v3['cid'] = $v['id'];  				//商家的id
				$v3['cname'] = $this->formatStr($v['cname']);				//商家的名称
				$v3['ctag'] = $this->formatStr($v['tag']);				//商家的简介
				$v3['cdesc'] = $this->formatStr($v['intro']);				//商家的简介
				$v3['cpic'] = $this->formatStr($v['smallpic']);			//商家的列表图片
				if (strlen($v3['cpic']) > 0){
					if (!strpos($v3['cpic'], "http:")){
						$v3['cpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['cpic'];
					}
				} else {
					$v3['cpic'] = '';
				}
				$v3['ctime'] = $this->formatStr($v['ctime']);				//商家创建的时间
			
				$return['data'][$k] = $v3;
			}
			$this->logapi('ts_lifecontent');
			return $return;
		} else {
			$this->logapi('ts_lifecontent');
			return $error_arr;
		}
	}
	
	
	//11 生活服务内容详情获取接口 getlifecontent
	//cid为商家的id
	function getlifecontent($cid=1){
		$cid = intval($_REQUEST['cid']);
		$map = ' id='.$cid;
		$field = ' id,cname,intro,address,tag,pic,telephone,longitude,latitude';
		$error_arr = array("errorCode" => "-1", "errorMessage" => "输入的商家id不存在");

		
		$res = M('ts_lifecontent')->where($map)->field($field)->findAll();
		if ($res){
			foreach($res as $k=>$v){
				$v3['cid'] = $v['id'];									//商家的id
				$v3['cname'] = $this->formatStr($v['cname']);								//商家的名称
				$v3['ctag'] = $this->formatStr($v['tag']);								//商家的简介
				$v3['cdesc'] = $this->formatStr($v['intro']);								//商家的简介
				$v3['caddress'] = $this->formatStr($v['address']);						//商家的类型
				$v3['ctelephone'] = $this->formatStr($v['telephone']);					//商家的类型
				$v3['cpic'] = $this->formatStr($v['pic']);								//商家的图片地址
				if (strlen($v3['cpic']) > 0){
					if (!strpos($v3['cpic'], "http:")){
						$v3['cpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['cpic'];
					}
				} else {
					$v3['cpic'] = '';
				}
				$v3['clongitude'] = $this->formatStr($v['longitude']);					//商家的经度
				$v3['clatitude'] = $this->formatStr($v['latitude']);						//商家的纬度
			
				$return['data'][$k] = $v3;
			}
			$this->logapi('ts_lifecontent');
			return $return;
		} else {
			$this->logapi('ts_lifecontent');
			return $error_arr;
		}
	}
	
	
	//12 生活服务内容详情修改接口 modlifecontent
	//cid为商家的id
	//本修改只是增加一条记录到ts_lifecontent2
	function modlifecontent(){
		$success_arr = array("errorCode" => "0", "errorMessage" => "更新成功");
		$error_arr = array("errorCode" => "-1", "errorMessage" => "提交失败");
		$id = intval($_REQUEST['cid']);
		$map = ' id='.$id;
		$field = ' id,cname,intro,address,telephone ';
		$res = M('ts_lifecontent')->where($map)->field($field)->find();

		
		if ($res){
			$cname = trim($_REQUEST['name']);
			$address = $_REQUEST['address'];
			$telephone = $_REQUEST['telephone'];
			$intro = $_REQUEST['desc'];
			if (empty($cname) && $res[0]['cname']) {
				$cname = $this->formatStr($res[0]['cname']);
			}
			if (empty($address) && $res[0]['address']) {
				$address = $this->formatStr($res[0]['address']);
			}
			if (empty($telephone) && $res[0]['telephone']) {
				$telephone = $this->formatStr($res[0]['telephone']);
			}
			if (empty($intro) && $res[0]['intro']) {
				$intro = $this->formatStr($res[0]['intro']);
			}
			$data = array('id'=>$id,
						  'telephone'=>$telephone,
						  'intro'=>$intro,
						  'cname'=>$cname,
						  'address'=>$address);
			$result = M('ts_lifecontent2')->add($data);
			$this->logapi('ts_lifecontent2');
			if($result){
				return $success_arr;
			} else {
				return $error_arr;
			}
		} else {
			$this->logapi('ts_lifecontent2');
			return $error_arr;
		}
	}
	
	
	//13 启动图接口 getloadpic
	//获得最新的启动图片，在zx_ts_static里面的type=1的内容，取最新的一张图片
	function getloadpic(){
		$map = ' infotype = 7';
		$order = ' info_id DESC ';
		$field = 'info_id,title,cover';
		$error_arr = array("errorCode" => "-1", "errorMessage" => "暂时没有图片");

		
		$res = M('information')->where($map)->order($order)->field($field)->findAll();
		if ($res){
			$v3['cid'] = $res[0]['info_id'];			//启动图的内容id
			$v3['ctitle'] = $this->formatStr($res[0]['title']);	//启动图的标题
			$v3['cpic'] = $this->formatStr($res[0]['cover']);		//启动图的图片地址
				if (strlen($v3['cpic']) > 0){
					if (!strpos($v3['cpic'], "http:")){
						$v3['cpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['cpic'];
					}
				} else {
					$v3['cpic'] = '';
				}
		
			$return['data'][0] = $v3;
			$this->logapi('ts_static');
			return $return;
		} else {
			$this->logapi('ts_static');
			return $error_arr;
		}
	}

	
	//14增加ios/android设备的token
	//type为ios或者android
	function addtoken($type = 'ios'){
		$success_arr = array("errorCode" => "0", "errorMessage" => "增加".$type."设备成功");
		$success_arr1 = array("errorCode" => "0", "errorMessage" => $type."设备已存在，无需增加");
		$error_arr = array("errorCode" => "-1", "errorMessage" => "增加".$type."设备失败");
		$token = trim($_REQUEST['token']);
		$macaddr = trim($_REQUEST['macAddr']);
		$type = $_REQUEST['type'];
		if(empty($token)) 
			return $error_arr;
		
		$data['macaddr'] = $macaddr;
		$data['token'] = $token;
		$data['type'] = $type;
		//echo 'macaddr='.$macaddr;
		if($res = M('iosdevice')->where("token='".$data['token']."' and macaddr='".$data['macaddr']."' and type='".$data['type']."'")->find()){
			if($res['status']==1){
				$this->logapi('iosdevice');
				return $success_arr1;
			}else{
				if(M('iosdevice')->setField("status",1,"id=".$res['id'])){
				$this->logapi('iosdevice');
					return $success_arr;
				}
			}
		}else{
			if(M('iosdevice')->add($data)){
				$this->logapi('iosdevice');
				return $success_arr;
			} else {
				$this->logapi('iosdevice');
				return $error_arr;
			}
		}
	}
	
	
	//15 其他订阅内容获取接口 getothercontent
	//cid为内容keyid，由用户在后台输入的一个字符串
	//返回内容为微刊或者优惠或者专题，则需要调用getsubcontent接口查看下一层的内容
	function getothercontent(){
		$cid = trim($_REQUEST['cid']);
		$map = ' status = 1 and infotype=4 and ordertype=2 and keyid="'.$cid.'"';
		//$map = ' status = 1 and ordertype=2 and title like "%'.$key.'%"';
		$order = ' info_id DESC ';
		$field = ' info_id,title,smallcover';
		$error_arr = array("errorCode" => "-1", "errorMessage" => "没有找到您所需微刊");
		
		$res = M('information')->where($map)->order($order)->field($field)->findAll();
		if ($res){
			foreach($res as $k1=>$v1){
				$v3['cid'] = $v1['info_id'];  			//内容的id
				$v3['ctitle'] = $this->formatStr($v1['title']);			//内容的标题
				$v3['cpic'] = $this->formatStr($v1['smallcover']);			//内容的列表图片
				if (strlen($v3['cpic']) > 0){
					if (!strpos($v3['cpic'], "http:")){
						$v3['cpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['cpic'];
					}
				} else {
					$v3['cpic'] = '';
				}
				$v3['curl'] = 'nourl';   //$this->site_pre_url.'/info/'.$v1['info_id'];		//详细内容的链接地址
			
				$return['data'][$k1] = $v3;
			}
			$this->logapi('information');
			return $return;
		} else {
			$this->logapi('information');
			return $error_arr;
		}
	}

	
	//16添加建议反馈
	//type为ios或者android
	function addsuggest(){
		$success_arr = array("errorCode" => "0", "errorMessage" => "增加".$type."设备成功");
		$success_arr1 = array("errorCode" => "0", "errorMessage" => $type."设备已存在，无需增加");
		$error_arr = array("errorCode" => "-1", "errorMessage" => "增加".$type."设备失败");
		$cname = trim($_REQUEST['cname']);
		$content = trim($_REQUEST['content']);
		if(empty($content)) 
			return $error_arr;
		
		$data['title'] = $cname;
		$data['content'] = $content;
		
		if(M('suggestion')->add($data)){
				$this->logapi('suggestion');
				return $success_arr;
		} else {
				$this->logapi('suggestion');
				return $error_arr;
		}
	}
	//关于我们
	function getaboutus() {
		$map['infotype'] = '6';
		$field = "info_id, title, intro, content, cover, smallcover";
		$ad = M('information')->field($field)->where($map)->find();
		
		$ad['curl'] = $this->site_pre_url.'/info/'.$ad['info_id'];		//详细内容的链接地址
		return $ad;
	}
	//17返回生活频道下面的其它内容
	//包括本地公交、关于我们等展示型内容，统一通过URL展现(关于我们是直接显示内容页面。
	//但是”反馈“是通过接口的。
	function getotherlist(){
		$error_arr = array("errorCode" => "-1", "errorMessage" => "没有获得数据");
		$map = ' infotype = 6';    //得到id=38的“关于我们”的数据
		$order = ' info_id desc ';
		$field = 'info_id,intro,title,cicon';
		$res1 = M('information')->where($map)->order($order)->field($field)->findAll();
		if ($res1){
			foreach($res1 as $k1=>$v1){
				$v4['scid'] = $v1['info_id'];
				$v4['scname'] = $this->formatStr($v1['title']);
				$v4['scicon'] = $this->formatStr($v1['cicon']);
				if (strlen($v4['scicon']) > 0){
					if (!strpos($v4['scicon'], "http:")){
						$v4['scicon'] =  $this->site_pre_url.'/data/uploads/'.$v4['scicon'];
					}
				} else {
					$v4['scicon'] = '';
				}
				$v4['ssortable'] = $this->formatStr($v1['info_id']);
				$v4['surl'] = $this->formatStr($v1['intro']);      //在便民服务里面，暂时由intro字段存放url地址
				$v4['surl'] = $this->site_pre_url.'/info/'.$v1['info_id'];	//指向的内容的链接地址
				//$return['data'][$k1] = $v4;    //考虑到android客户端单独列出了“关于我们”，所以去掉。2012.12.16
			}
		}

		$map = ' fid = 0 AND status=1 and cate_id = 9 and infotype=1';   //得到便民下面其他的信息，如高客、公交等
		$order = ' info_id desc ';
		$field = 'info_id,intro,title,cicon';
		$res2 = M('information')->where($map)->order($order)->field($field)->findAll();
		if ($res2){
			foreach($res2 as $k1=>$v1){
				$v4['scid'] = $v1['info_id'];
				$v4['scname'] = $this->formatStr($v1['title']);
				$v4['scicon'] = $this->formatStr($v1['cicon']);
				if (strlen($v4['scicon']) > 0){
					if (!strpos($v4['scicon'], "http:")){
						$v4['scicon'] =  $this->site_pre_url.'/data/uploads/'.$v4['scicon'];
					}
				} else {
					$v4['scicon'] = '';
				}
				$v4['ssortable'] = $this->formatStr($v1['info_id']);
				$v4['surl'] = $this->formatStr($v1['intro']);      //在便民服务里面，暂时由intro字段存放url地址
				if ($res1){
					$return['data'][$k1] = $v4;
				} else {
					$return['data'][$k1] = $v4;
				}
			}
				$this->logapi('information');
				return $return;
		} else {
			$this->logapi('information');
			return $error_arr;
		}
	}
	
	//获取附件的餐厅
	function getnearrestaurant() {
		$cid = 5;
		$field = ' id,cname,consume,cate_id,smallpic as cpic,address, longitude,latitude';
		$rlist = $this->getlifelist($cid, $field, '', false);
		
		$cateList = M('information_cate')->where('fid=5')->field('cate_id, name')->findAll();
		$aCate = array();
		foreach( $cateList as $cate) {
			$aCate[$cate['cate_id']] = $cate['name'];
		}
		foreach( $rlist as $key=>$list) {
			$rlist[$key]['cate_name'] = $aCate[$list['cate_id']];
			unset($rlist[$key]['cate_id']);
		}
		$nearlist = $this->nearlife($rlist);
		return $nearlist;
	}
	
	//获取附件的玩乐场所
	function getnearplayplace() {
		$cid = 4;
		$field = ' id,cname,consume,cate_id,smallpic as cpic,address, longitude,latitude';
		$rlist = $this->getlifelist($cid, $field, '', false);
	
		$cateList = M('information_cate')->where('fid=4')->field('cate_id, name')->findAll();
		$aCate = array();
		foreach( $cateList as $cate) {
			$aCate[$cate['cate_id']] = $cate['name'];
		}
		foreach( $rlist as $key=>$list) {
			$rlist[$key]['cate_name'] = $aCate[$list['cate_id']];
			unset($rlist[$key]['cate_id']);
		}
		$nearlist = $this->nearlife($rlist);
		return $nearlist;
	}
	
	private function nearlife($res) {
		if( !$res || !is_array($res)) {
			return array();
		}
		$longitude = trim($_REQUEST['longitude']);
		$latitude = trim($_REQUEST['latitude']);
		$distance = trim($_REQUEST['distance']);
		$distance = intval($distance) > 0 ? intval($distance) : 2000;
		
		$start = 0;   //计算获得的商家数
		$return = array();
		$return['data'] = array();
		foreach($res as $k=>$v){
			if (strlen($v['latitude']) == 0 || strlen($v['longitude']) == 0){
				continue;
			}
			//echo 'title='.$v['cname'];
			$dis = $this->GetDistance($latitude,$longitude, $v['latitude'],$v['longitude'], 1);   //判断两个位置的距离
			//echo 'dis='.$dis;
			if ($dis <= $distance){	
				$v['distance'] = $dis;
				$return['data'][$start] = $v;
				$start = $start + 1;
			}
		}
		$allLife = $return['data'];
		$return['data'] = $this->array_sort($allLife,'distance');
		
		$page = intval($_REQUEST['page']) ? intval($_REQUEST['page']):1;
		$pagesize = intval($_REQUEST['pagesize']) ? intval($_REQUEST['pagesize']) : 10;
		$page_fir = ($page-1)*$pagesize;
		$data = $return['data'];
		$data = array_slice($data, $page_fir, $pagesize);
		$return['data'] = $data;
		
		return $return;
	}
	//18返回附近的商户
	//输入longitude=经度和latitude=纬度以及附近的距离distance(以米m为单位）
	//返回附近的商户经纬度列表。
	//http://www.tradetochina.cn/index.php?app=api&mod=zsts&act=getnearliststore&latitude=39.908452&longitude=116.450479&distance=3000
	private function getnearliststore($type, $field){
		$error_arr = array("errorCode" => "-1", "errorMessage" => "没有获得数据");
		$longitude = trim($_REQUEST['longitude']);
		$latitude = trim($_REQUEST['latitude']);
		$distance = trim($_REQUEST['distance']);
		$distance = intval($distance) > 0 ? intval($distance) : 2000;
		$map = " type={$type} and status=1 ";
		
		$res = M('ts_lifecontent')->where($map)->field($field)->findAll();
		$start = 0;   //计算获得的商家数
		if ($res){
			foreach($res as $k=>$v){
				if (strlen($v['latitude']) == 0 || strlen($v['longitude']) == 0){
					continue;
				} 
				//echo 'title='.$v['cname'];
				$dis = $this->GetDistance($latitude,$longitude, $v['latitude'],$v['longitude'], 1);   //判断两个位置的距离
				//echo 'dis='.$dis;
				if ($dis <= $distance){
					$cpic = $this->formatStr($v['cpic']);			//商家的列表图片
					if (strlen($cpic) > 0){
						if (!strpos($cpic, "http:")){
							$v3['cpic'] =  $this->site_pre_url.'/data/uploads/'.$v3['cpic'];
						}
					} else {
						$cpic = '';
					}
					$v['distance'] = $dis;
					$v['pic'] = $cpic;
					$return['data'][$start] = $v;
					$start = $start + 1;
				}
			}
			$this->logapi('ts_lifecontent');
			if ($start > 0){
				$page = intval($_REQUEST['page']) ? intval($_REQUEST['page']):1;
				$pagesize = intval($_REQUEST['pagesize']) ? intval($_REQUEST['pagesize']) : 10;
				$page_fir = ($page-1)*$pagesize;
				$data = $return['data'];
				$data = array_slice($data, $page_fir, $pagesize);
				$return['data'] = $data;
				return $return;
			} else {
				return $error_arr;
			}
		} else {
			$this->logapi('ts_lifecontent');
			return $error_arr;
		}
		$this->logapi('ts_lifecontent');
		return $error_arr;
	}

	private function array_sort($arr,$keys,$type='asc'){
		$keysvalue = $new_array = array();
		foreach ($arr as $k=>$v){
			$keysvalue[$k] = $v[$keys];
		}
		if($type == 'asc'){
			asort($keysvalue);
		}else{
			arsort($keysvalue);
		}
		reset($keysvalue);
		$nk = 0;
		foreach ($keysvalue as $k=>$v){
			$new_array[$nk] = $arr[$k];
			$nk++;
		}
		return $new_array;
	}
	
	//19 推送内容接口 getpush
	//输入参数无
	//返回值：
	//pushid：（不能重复）可以累加
	//type：1：新闻  2：微刊 3：新版本
	//url：（type=1或者type=2）返回值为cid    type=3时返回apk下载地址 
	//title：推送的标题
	//content：推送的内容

	function getpush(){
		$type = trim($_REQUEST['type']);
		if (empty($type) || strlen($type) == 0){
			$type = 'android';
		}
		$map = ' send_type="'.$type.'"';
		//$map = ' status = 1 and ordertype=2 and title like "%'.$key.'%"';
		$order = ' id DESC ';
		$field = ' id,content,content_type,url,title,send_type,send_time';
		$error_arr = array("errorCode" => "-1", "errorMessage" => "暂时没有最新的推送信息");
		
		$res = M('push_message')->where($map)->order($order)->field($field)->findAll();
		if ($res){
			//foreach($res as $k1=>$v1){
				$v3['pushid'] = $res[0]['id'];  						//内容的id
				$v3['type'] = $res[0]['content_type'];  				//内容的id
				$v3['title'] = $this->formatStr($res[0]['title']);		//内容的标题
				$v3['content'] = $this->formatStr($res[0]['content']);	//内容的列表图片
				$v3['url'] = $this->formatStr($res[0]['url']);			//详细内容的链接地址
			
				$return['data'][0] = $v3;
			//}
			$this->logapi('push_message');
			return $return;
		} else {
			$this->logapi('push_message');
			return $error_arr;
		}
	}
	
	/**
	 * 用户注册
	 */
	public function register() {		
		//参数合法性检查
		$required_field = array(
				'email'		=> 'Email',
				'password'	=> '密码',
				'uname'		=> '姓名',
		);
		foreach ($required_field as $k => $v) {
			if ( empty($_POST[$k]) ) $this->result(0, $v . '不可为空');
		}
		if ( ! isValidEmail($_POST['email']) ) {
			$this->result(1, 'Email格式错误，请重新输入');
		}
		if ( strlen($_POST['password']) < 6 || strlen($_POST['password']) > 16 ) {
			$this->result(1, '密码必须为6-16位');
		}
		if ( ! isEmailAvailable($_POST['email']) ) {
			$this->result(1, 'Email已经被使用，请重新输入');
		}
		if( !isLegalUsername( t($_POST['uname']) ) ){
			$this->result(1, '昵称格式不正确');
		}
	
		$haveName = M('User')->where( "`uname`='".t($_POST['uname'])."'")->find();
		if( is_array( $haveName ) && sizeof($haveName)>0 ){
			$this->result(1, '昵称已被使用');
		}
	
		//注册用户
		$_POST['email']     = escape(h(t($_POST['email'])));
		$_POST['uname']		= escape(h(t($_POST['uname'])));
		$_POST['password']  = md5($_POST['password']);
		$_POST['domain']    = h($_POST['domain']);
		$_POST['ctime']		= time();
		$_POST['is_active'] = 1;
		$_POST['sex']		= 0;
		$_POST['is_init']   = '1';
	
		$uid = M('user')->add($_POST);
		if (!$uid) {
			$this->result(1, '抱歉：注册失败，请稍后重试');
			exit;
		}
		$_POST['userid'] = $uid;
		//添加用户组信息
		model('UserGroup')->addUserToUserGroup( $uid, 28 );		//添加为普通用户
	
		$this->result(0, array( $_POST));
	}
	/**
	 * 用户登陆
	 */
	public function login() {
		$email = escape( h(t($_POST['email'])));
		$password = escape( h(t($_POST['password'])));
		if( !$email || !$password) {
			$this->result('1','请填写好邮箱或者密码');
		}
		$md5passowrd = md5( $password);
		$user = M('user')->where("`email`='$email' AND `password`='$md5passowrd'")->find();
		if( !$user) {
			$this->result(1, '账号密码错误');
		}
		$token = $this->gettoken($user['uid'], time());
		$_SESSION[$email] = $token;
		if( $user['head_pic_url']) {
			$user['head_pic_url'] = $this->site_pre_url.$user['head_pic_url'];
		}
		$json_user = array('code'=>0, 'head_pic_url'=>$user['head_pic_url'], 'username'=>$user['uname'], 'userid'=>$user['uid'], 'token'=>$token);
		return $json_user;
	}
	/**
	 * 用户修改昵称
	 */
	public function modifyname(){
		//参数合法性检查
		$_POST['uid']	= intval($_POST['userid']);
		$_POST['uname'] =  escape(h(t($_POST['username'])));

		if ( empty($_POST['uid']) ) $this->result(1, '参数非法');
		if ( empty($_POST['uname']) ) $this->result(1, '昵称不可为空');

		if ( mb_strlen($_POST['uname'],'UTF8') > 10 ) {
			$this->result(1, '昵称不能超过10个字');
		}
		
		//保存修改
		$key   			 = array('uname');
		$value 			 = array($_POST['uname'] );

		$map['uid']	= $_POST['uid'];
		
		$res = M('user')->where($map)->setField($key, $value);
		
		$this->result(0, '修改成功');
	}
	/**
	 * 退出登陆
	 */
	public function logout() {
		$uid = $_POST['userid'];
		if( !$uid) {
			$this->result(1, '错误');
		}
		$user = M('user')->where('`uid`='.$uid)->find();
		$email = $user['email'];
		unset( $_SESSION[$email]);
		$this->result(0);
	}
	/**
	 * 修改头像
	 */
	public function uploadheadimage() {
		@header("Expires: 0");
		@header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
		@header("Pragma: no-cache");
		$uid = intval( $_POST['userid']);
		$user = M('user')->where('`uid`='.$uid)->find();
		if( !$user) {
			return $this->result(1, '请先登陆');
		}
		$pic_id = time();//使用时间来模拟图片的ID.
		$pic_path = $this->getSavePath($uid).'/source.jpg';
		//保存上传图片.
		if(empty($_FILES['imgfile'])) {
			$this->result(1, '对不起, 图片未上传成功, 请再试一下');
		}else{
			$file = @$_FILES['imgfile']['tmp_name'];
			file_exists($pic_path) && @unlink($pic_path);
			if(@copy($_FILES['imgfile']['tmp_name'], $pic_path) || @move_uploaded_file($_FILES['imgfile']['tmp_name'], $pic_path))
			{
				@unlink($_FILES['imgfile']['tmp_name']);
				list($sr_w, $sr_h, $sr_type, $sr_attr) = @getimagesize($pic_path);
		
				$return['data']['image'] = __UPLOAD__.'/avatar/'.$this->uid.'/source.jpg';
				$return['data']['picurl'] = 'avatar/'.$this->uid.'/source.jpg';
				$return['data']['picwidth'] = $sr_w;
				$return['data']['picheight'] = $sr_h;
				$return['status']    = '1';
			} else {
				@unlink($_FILES['imgfile']['tmp_name']);
				$this->result(1, '对不起, 图片未上传成功');
			}
			 
		}
		$pic_path = str_replace(SITE_PATH, '', $pic_path);
		//保存修改
		$key   			 = array('head_pic_url');
		$value 			 = array($pic_path);
		
		$map['uid']	= $uid;
		$res = M('user')->where($map)->setField($key, $value);
		$user['head_pic_url'] = $this->site_pre_url.$pic_path;
		return $this->result(0, $user);
	}
	//收藏新闻
	function collect(){
		$info_id = intval($_REQUEST['info_id']);
		$userid = intval( $_REQUEST['userid']);
		if( !$info_id || !$userid) {
			$this->result(1, '参数错误');
		}
		$data = array('info_id'=>$info_id,
				'userid'=>$userid,
				'time'=>time());
		$result = M('collect')->add($data);
		return $this->result(0, '成功');
	}
	//删除新闻收藏
	function delcollect() {
		$info_id = intval($_REQUEST['info_id']);
		$userid = intval( $_REQUEST['userid']);
		if( !$info_id || !$userid) {
			$this->result(1, '参数错误');
		}
		$map = array();
		$map['info_id'] = $info_id;
		$map['userid'] = $userid;
		M('collect')->where($map)->delete();
		
		return $this->result(0, '成功');
	}
	//收藏列表
	function getcollect() {
		$userid = intval( $_REQUEST['userid']);
		if( !$userid) {
			return array();
		}
		
		$map = array();
		$map['userid'] = $userid;
		
		$order = ' time DESC ';
		
		$page = intval($_REQUEST['page']) ? intval($_REQUEST['page']):1;
		$pagesize = intval($_REQUEST['pagesize']) ? intval($_REQUEST['pagesize']) : 10;
		$page_fir = ($page-1)*$pagesize;
		
		$aCollect = M('collect')->where($map)->order($order)->limit("$page_fir,$pagesize")->findAll();
		
		$aInfo_id = array();
		foreach ( $aCollect as $collect) {
			$aInfo_id[] = $collect['info_id'];
		}
		$sInfo_id = join( $aInfo_id, ',');
		$map = " info_id in ({$sInfo_id}) and status=1 ";
		
		$arr = $this->getnewslist($map);
		if( $arr['errorCode']) {
			return array();
		}
		return $arr;
	}
	
	function getSavePath($uid){
		$savePath = SITE_PATH.'/data/uploads/avatar/'.$uid;
		if( !file_exists( $savePath ) ) mk_dir( $savePath  );
		return $savePath;
	}
	public function gettoken($userid, $time){
		$secret = "@#$%^";
		$str = md5($userid.$time.$secret);
		return $time.$str;
	}
	public function result($errorCode, $errorMessage='') {
		$arr = array('code'=>$errorCode, 'errorMessage'=>$errorMessage);
		exit( json_encode( $arr));
	}
}
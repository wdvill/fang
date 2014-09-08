<?php
// +----------------------------------------------------------------------
// | ThinkSNS
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://www.thinksns.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: nonant <nonant@thinksns.com>
// +----------------------------------------------------------------------
//

/**
 * 动态服务
 */
class FeedService extends Service {
	public function __construct() {
	}
	
	/**
	 * 发布动态
	 * 
	 * @param string $type 动态类型, 必须与模版的类型相同, 使用下划线分割应用. 
	 * 					   如$type = "weibo_follow"定位至/apps/weibo/Language/cn/feed.php的"weibo_follow"
	 * @param array  $data 动态的数据数组, 该数组的key必须对应$type定位到数组的key
	 * @param int    $uid  发布动态的用户ID
	 * @return false|int   保存失败返回false, 否则返回该条数据在数据库的ID
	 */
	public function put($type, $data, $uid) {
		$data['uid'] = $map['uid'] = ($uid)?$uid:$_SESSION['mid'];
		$data['type'] = $type;
		$data['data'] = $map['data'] = serialize($data);
		$data['ctime'] = $save_data['ctime'] = time();
		if(M('feed')->where($map)->count()){
			return M('feed')->where($map)->save($save_data);
		}else{
			return M ('feed')->data($data)->add();
		}
	}
	
	//发布动态（put方法不能满足的时候使用，主要是数据过于繁琐的时候使用）
	function addFeed($uid,$data,$type){
		$datas['uid'] = $uid;
		$datas['data'] = $map['data'] = serialize($data);
		$datas['type'] = $type;
		$datas['ctime'] = $save_data['ctime'] = time();
		if(M('feed')->where($map)->count()){
			return M('feed')->where($map)->save($save_data);
		}else{
			return M ('feed')->add($datas);
		}
	}
	/**
	 * 获取给定用户看到的动态
	 * @param int    $uid   用户ID
	 * @param string $order 结果集顺序
	 * @return array
	 */
	public function get($uid, $order = 'feed_id DESC') {
		$prefix = C ( 'DB_PREFIX' );
		$list = M ( 'feed' )->where ( "uid IN (SELECT fid FROM {$prefix}follow where uid=$uid) OR uid=$uid" )->order ( $order )->findPage ( 20 );
		foreach ( $list ['data'] as $key => $value ) {
			$list ['data'] [$key] = array_merge ( $value, $this->_parseTemplate ( $value ) );
		}
		return $list;
	}
	
	/**
	 * 获取用户动态并按照用户分组
	 * @param int    $uid   用户ID
	 * @param string $order 结果集顺序
	 * @return array
	 */
	public function getFeed($uid,$limit=20) {
		$prefix = C('DB_PREFIX');
		/*
		 *获取好友动态
		 
		//获取用户好友id
		$friend = M("friend")->where("(uid={$uid} OR friend_uid={$uid}) AND status=1")->field("uid,friend_uid")->findAll();
		$uids = getSubByKey($friend,'uid');
		$friend_uids = getSubByKey($friend,'friend_uid');
		$fids = array_unique(array_merge($uids,$friend_uids));
		*/
		
		//获取用户关注动态
		$follow = M("follow")->where("uid={$uid} AND status=1")->field('fid')->findAll();
		$fids = getSubByKey($follow,'fid');
		
		$table = "{$prefix}feed AS a LEFT JOIN {$prefix}user AS b ON a.uid=b.uid";
		if(M('')->table($table)->where("a.uid IN (".implode(',',$fids).") AND a.status=1 AND b.is_active=1 AND a.ctime>=".(time()-86400*7))->field("a.feed_id")->count()){
			$map_time = " AND a.ctime>=".(time()-86400*7);
		}else{
			$map_time = " AND a.ctime>=".(time()-86400*30);
		}
		$list = M('')->table($table)->where("a.uid IN (".implode(',',$fids).") AND a.status=1 AND b.is_active=1".$map_time)->order("a.ctime DESC")->field("a.*,b.uname AS uname")->findPage ($limit);
		foreach($list['data'] as $key => $value){
			$value['date'] = friendlyDate($value['ctime']);
			$psraetpl = $this->_parseTemplate($value);
			if($psraetpl && $psraetpl['title']){
				$datas[$value['uid']][] = array_merge($value,$psraetpl);
			}else{
				continue;
			}
		}
		
		$list['data'] = $datas;
		return $list;
	}
	
	/**
	 * 根据给定条件获取动态
	 * @param array|string $map   查询条件, 必须使用ThinkPHP的查询规则
	 * @param int          $limit 分页中每页的数据条数
	 * @param string       $order 结果集顺序
	 * @return array
	 */
	public function getFeedByMap($map, $limit = 20, $order = 'feed_id DESC') {
		$list = M ( 'feed' )->where ( $map )->order ( $order )->findPage ( $limit );
		foreach ( $list ['data'] as $key => $value ) {
			$list ['data'] [$key] = array_merge ( $value, $this->_parseTemplate ( $value ) );
		}
		return $list;
	}
	
	/**
	 * 枚举动态类型
	 * @return array
	 */
	public function enumerateType() {
		$sql = "SELECT `type` FROM " . C ( 'DB_PREFIX' ) . "feed GROUP BY `type`";
		$res = M ( '' )->query ( $sql );
		return getSubByKey ( $res, 'type' );
	}
	
	/**
	 * 删除单条微博
	 * @param int $uid     用户ID
	 * @param int $feed_id 动态ID
	 * @return boolean
	 */
	public function deleteOneFeed($uid, $feed_id) {
		$map ['uid'] = $uid;
		$map ['feed_id'] = $feed_id;
		return M ( 'feed' )->where ( $map )->delete ();
	}
	
	/**
	 * 删除多条微博
	 * @param int|array $ids 动态ID
	 */
	public function deleteFeed($ids) {
		$ids = is_array ( $ids ) ? $ids : explode ( ',', $ids );
		if (empty ( $ids ))
			return false;
		$map ['feed_id'] = array ('in', $ids );
		return M ( 'feed' )->where ( $map )->delete ();
	}
	
	/**
	 * 解析模板
	 */
	public function _parseTemplate($i_data) {
		
		if (false == $i_data ['data'] = unserialize ( $i_data ['data'] )) {
			$i_data ['data'] = unserialize ( stripslashes ( $i_data ['data'] ) );
		}
		
		if(!$i_data ['data']){
			$return ['title'] = '';
			$return ['body'] = '';
			return $return;
		}
		
		if($i_data['type']!='weibo_follow'){
			$type = substr($i_data['type'],0,strpos($i_data['type'],'_'));
			$tpltype = '_parse'.ucfirst($type).'Template';
			if(method_exists($this,$tpltype)){
				$return['title'] = $this->$tpltype($i_data['data'][$type.'_id'],$i_data);
			}else{
				$return['title'] = '';
			}
		}else{
			$replace ["{actor}"] = '<a href="' . U ( "home/space/index", array ("uid" => $i_data ['uid'] ) ) . '" target="_blank">' . getUserName ( $i_data ['uid'] ) . '</a>';
			if ($i_data)
				extract ( $i_data ['data'], EXTR_OVERWRITE );
			unset ( $i_data ['data'] );
			//extract ( $i_data, EXTR_OVERWRITE );
			$template_type = explode ( '_', $i_data ['type'] );
			$template = require (SITE_PATH . '/apps/' . $template_type [0] . '/Language/cn/feed.php');
		
			$return ['title'] = str_replace ( array_keys ( $replace ), array_values ( $replace ), $template [$type] ['title'] );
			$return ['body'] = str_replace ( array_keys ( $replace ), array_values ( $replace ), $template [$type] ['body'] );
		}
		
		return $return;
	}
	
	/**
	 * 解析微博动态模板
	 */
	public function _parseWeiboTemplate($weibo_id,$i_data=null) {
		//获取微博信息
		$result = D("Weibo","weibo")->getOne($weibo_id);
		if(!$result) return null;
		
		$return =  '<div class="font4 mb10">'.format($result['content'],true).'</div>';
		
		if($result['transpond_id']){
			if($result['expend']){
				$return .= '<div class="">
								<div class="rtit3_2"></div>
								<div class="bgc1 p10 border3 wid610">
									<p class="font5"><a href="'.$result['expend']['url'].'">@'.$result['expend']['uname'].'</a></p>
									<p class="rtit3_3 mb10"><b>“</b>'.format($result['expend']['content'],true).'<b>”</b></p>
									<div class="cl"></div>
									<div class="mb5">
										<div class="l wid20 font2">'.friendlyDate($result['expend']['ctime']).'</div>
										<div class="r wid77 tr">
											<label class="font5"><a href="#">转发</a></label>';
											if($result['expend']['transpond']){
												$return .= '<label class="font2">共'.$result['expend']['transpond'].'次</label>';
											}
											$return .= '&nbsp;|&nbsp;<label class="font5"><a href="#">收藏</a></label>';
											if($result['expend']['collect']){
												$return .= '<label class="font2">共'.$result['expend']['collect'].'次</label></label>';
											}
											$return .= '&nbsp;|&nbsp;<label class="font5"><a href="#">评论</a></label>';
											if($result['expend']['comment']){
												$return .= '<label class="font2">共'.$result['expend']['comment'].'次</label>';
											}
							$return .= '</div>
									</div>
									<div class="cl border4"></div>
								</div>
							</div>';
			}else{
				$return .= '<div class="">
								<div class="rtit3_2"></div>
								<div class="bgc1 p10 border3 wid610">
									<b>此微博已被原作者删除</b>
									<div class="cl border4"></div>
								</div>
							</div>';
			}
		}else{
			$return .= $result["expend"];
		}
		
		$return .= '<div class="p3 mb10 border5 hei20">
						<p class="l wid49 rtit3_1">'.friendlyDate($result['ctime']).'</p>
						<p class="tr">';
							$return .= '<label class="font5"><a href="javascript:void(0)" onclick="weibo.transpond('.$result['id'].')">转发('.$result['transpond'].')</a></label>&nbsp;&nbsp;|&nbsp;&nbsp;
							<label class="font5">';
							if($result['is_favorited']){
								$return .= '<a href="javascript:void(0)" onclick="weibo.unFavorite('.$result['id'].',this)">取消收藏</a>';
							}else{
								$return .= '<a href="javascript:void(0)" onclick="weibo.favorite('.$result['id'].',this)">收藏</a>';
							}
							$return .= '</label>&nbsp;&nbsp;|&nbsp;&nbsp;
							<label class="font5"><a href="javascript:void(0)" rel="comment" minid="'.$result['id'].'" >评论('.$result['comment'].')</a></label>
						</p>
					</div>
					<div class="cl"></div>
					<div class="bgc2 mb10" id="comment_list_'.$result['id'].'"></div>';
		return $return;
	}
	
	/**
	 * 解析问答动态模板
	 */
	public function _parseQuestionTemplate($ques_id,$i_data=null) {
		//获取问答信息
		$result = M('question')->where("ques_id={$ques_id} AND status=1")->find();
		if(!$result) return null;
		
		$result['uname'] = getUserName($result['uid']);
		$result['url'] = getUserUrl($result['uid']);
		$result['face'] = getUserFace($result['uid']);
		$result['content'] = format(htmlspecialchars_decode($result['content']));
		$result['is_collect'] = M('question_collect')->where("uid=".intval($_SESSION['mid'])." AND ques_id=".$result['ques_id'])->count();
		$result['collect'] = intval(M('question_collect')->where("ques_id=".$result['ques_id'])->count());
		$result['cdate'] = date('Y-m-d H:i',$result['ctime']);
		if(!$result['public']){
			$res = M('question_target')->where("ques_id=".$result['ques_id']." AND status=1")->field('uid')->findAll();
			$allow = getSubByKey($res,'uid');
			if($_SESSION['mid'] != $result['uid'] && !in_array($_SESSION['mid'],$allow)){
				return null;
			}
		}
		
		$return =  '<img src="'.__THEME__.'/images/top1.png" />
						<div class="font4 ml20 mr30" style="word-wrap:break-word">
							<div class="l date_show">
								<div style="text-align:center;font-size:16px;font-weight:700">?</div>
								<div class="mt5" style="text-align:center;font-size:16px;font-weight:700">提问</div>
  							</div>
  							<div class="r wid89">
    							<b>'.format($result['content'],true).'</b>
							</div>
						  	<div class="cl"></div>
						</div>
					<img src="'.__THEME__.'/images/bottom1.png" />';
		
		$return .= '<div class="p3 mb20 border5 hei20">
						<p class="l wid49 rtit3_1">'.friendlyDate($result['ctime']).'</p>
						<p class="tr">';
							$return .= '<label class="font5">';
								if($result['is_collect']){
									$return .= '<a href="javascript:void(0)" class="collecting collected" qd="'.$result['ques_id'].'">已收藏</a>';
								}else{
									$return .= '<a href="javascript:void(0)" class="collecting collect" qd="'.$result['ques_id'].'">收藏</a>';
								}
							$return .= '<span>('.$result['collect'].')</span></label>&nbsp;&nbsp;|&nbsp;&nbsp;
							<label class="font5"><a href="javascript:void();" onclick="getPrivateAnswer('.$result['ques_id'].');">私密回答</a></label>&nbsp;&nbsp;|&nbsp;&nbsp;
							<label class="font5"><a href="javascript:void();" onclick="getQuestionAnswer('.$result['ques_id'].');">回答</a><span>('.$result['answer'].')</span></label>
						</p>
					</div>
					<div style="margin-top:10px;padding:10px;display:none" class="border5 showanswer_'.$result['ques_id'].'">
						<div class="l ml10 mr10">
							<a href="'.getUserUrl($_SESSION['mid']).'" target="_blank"><img src="'.getUserFace($_SESSION['mid']).'" width="60" height="60"/></a>
						</div>
						<div style="margin-left:80px">
						<form action="'.U('home/qa/doanswer').'" method="post" onsubmit="return checkAnswer(this);">
							<textarea name="content" rows="5" style="border:1px solid #CCC; width:500px; height:60px; color:#666;overflow:hidden;"></textarea><br />
							<input type="submit" value="回答" class="N_but" />
							<input type="hidden" name="qd" value="'.$result['ques_id'].'" />
							<input type="hidden" name="public" value="1" />
							<input type="hidden" name="sd" />
							<span class="error-message"></span>
						</form>
						</div>
						<div class="cl"></div>
						<div id="answer_list_'.$result['ques_id'].'"></div>
					</div>';
		return $return;
	}
	
	/**
	 * 解析添加好友动态模板
	 */
	public function _parseFriendTemplate($friend_uid,$i_data=null) {
		if(!$friend_uid) return null;
		
		$return =  '<div class="rtit3 mb5"><h1>  和  <label><a href="'.U('home/space/index',array('uid'=>$friend_uid)).'" target="_blank">'.getUserName($friend_uid).'</a></label>  建立了联系</h1></div><div class="cl"></div><div class="p3 rtit3_1 mb10 border5 hei20"><p class="l wid20">'.friendlyDate($i_data['ctime']).'</p></div><div class="cl"></div>';
		return $return;
	}
	
	//运行服务，系统服务自动运行
	public function run(){

	}
	
	//启动服务，未编码
	public function _start() {
		return true;
	}
	
	//停止服务，未编码
	public function _stop() {
		return true;
	}
	
	//安装服务，未编码
	public function _install() {
		return true;
	}
	
	//卸载服务，未编码
	public function _uninstall() {
		return true;
	}
}
?>
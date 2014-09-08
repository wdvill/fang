<?php
class InfoModel extends Model{
	protected $tableName = 'information';
	var $prefix;
    
	function __construct(){
		$this->prefix = C("DB_PREFIX");
	}
	
	//获取首页资讯列表
	function getHomeInfoList($count){
		$sql = "SELECT a.info_id,a.cate_id,a.title,a.cover,a.ctime FROM {$this->prefix}information AS a WHERE a.status=1 AND a.recommend=1 AND (SELECT count(info_id) FROM {$this->prefix}information WHERE a.cate_id=cate_id AND status=1 AND recommend=1 AND a.info_id<info_id)<{$count}";
		$res = M()->query($sql);
		
		foreach($res as $k=>$v){
			$v['title'] = real_strip_tags($v['title']);
			$v['m_title'] = msubstr($v['title'],0,20);
			$v['cover'] = __UPLOAD__.'/'.$v['cover'];
			$v['url'] = $this->getInfoUrl('detail',array('ind'=>$v['info_id']));
			$return[$v['cate_id']][] = $v;
		}
		
		return $return;
	}
	
	//获取资讯列表
	function getInfoListByMap($map,$limit=20,$field="*",$order="info_id DESC"){
		$res = M("information")->where($map)->order($order)->field($field)->findPage($limit);
		
		if(!$res) return;
		
		foreach($res['data'] as $k=>$v){
			$v['title'] = real_strip_tags($v['title']);
			$v['intro'] = real_strip_tags($v['intro']);
			$v['cdate'] = date("Y-m-d H:i",$v['ctime']);
			$v['cover'] = __UPLOAD__.'/'.$v['cover'];
			$v['url'] = $this->getInfoUrl('detail',array('ind'=>$v['info_id']));
			$res['data'][$k] = $v;
		}
		
		return $res;
	}
	
	//获取推荐资讯
	function getRecommendInfo($limit=10,$order="info_id DESC"){
		$res = M("information")->where("recommend=1 AND cover != '' AND status=1")->order($order)->field("info_id,title,cate_id,cover,ctime")->limit($limit)->findAll();
		
		if(!$res) return;
		
		foreach($res as $k=>$v){
			$v['title'] = real_strip_tags($v['title']);
			$v['m_title'] = msubstr($v['title'],0,20);
			$v['cover'] = __UPLOAD__.'/'.$v['cover'];
			$v['cdate'] = date("Y-m-d H:i",$v['ctime']);
			$v['url'] = $this->getInfoUrl('detail',array('ind'=>$v['info_id']));
			$res[$k] = $v;
		}
		
		return $res;
	}
	
	//获取热门资讯（按点击量排名）
	function getHotInfo($limit=10){
		$res = M("information")->where("browsecount>0 AND status=1")->order("browsecount DESC")->field("info_id,title,cate_id,cover,ctime")->limit($limit)->findAll();
		
		if(!$res) return;
		
		foreach($res as $k=>$v){
			$v['title'] = real_strip_tags($v['title']);
			$v['m_title'] = msubstr($v['title'],0,15);
			$v['cover'] = __UPLOAD__.'/'.$v['cover'];
			$v['cdate'] = date("Y-m-d H:i",$v['ctime']);
			$v['url'] = $this->getInfoUrl('detail',array('ind'=>$v['info_id']));
			$res[$k] = $v;
		}
		
		return $res;
	}
	
	//获取资讯信息
	function getInfoDetail($info_id){
		if(!is_numeric($info_id)) return ;
		
		$info = M("information")->where("info_id={$info_id} AND status=1")->find();
		
		$info['cate'] = $this->getInfoCateById($info['cate_id']);
		$info['title'] = real_strip_tags($info['title']);
		$info['intro'] = real_strip_tags($info['intro']);
		$info['cover'] = empty($info['cover']) ? '':__UPLOAD__.'/'.$info['cover'];
		$info['content'] = htmlspecialchars_decode($info['content']);
		$info['cdate'] = date("Y-m-d H:i",$info['ctime']);
		$info['mdate'] = date("Y-m-d H:i",$info['mtime']);
		
		return $info;
	}
	
	//通过id获取类别信息
	function getInfoCateById($cate_id){
		return M("information_cate")->where("cate_id={$cate_id} AND status=1")->find();
	}
	
	//获取资讯类别
	function getInfoCateList($count=4){
		return M("information_cate")->where("status=1")->findAll();
	}
	
	//获取资讯类别名称(并按cate_id分组)
	function getInfoCateListByCate($count=4){
		$res = M("information_cate")->where("status=1")->findAll();
		foreach($res as $k=>$v){
			$return[$v['cate_id']] = $v['name'];
		}
		
		return $return;
	}
	
	//获取资讯链接
	function getInfoUrl($type='detail',$param){
		return U("home/info/".$type,$param);
	}
	
	//资讯信息点击量计数
	function InfoBrowseCount($info_id){
		if(!is_numeric($info_id)) return ;
		
		$sql = "UPDATE {$this->prefix}information SET browsecount=browsecount+1 WHERE info_id={$info_id}";
		M()->query($sql);
	}
}
?>
<?php
class AdsModel extends Model {
	protected $tableName = 'ads';
	var $prefix;
    
	function __construct(){
		$this->prefix = C("DB_PREFIX");
	}
	
	//获取首页广告列表
	function getHomeADList($limit=5){
		$map = "type = 0 AND status=1 AND recommend = 1";
		$res = M("ads")->where($map)->order("ctime DESC")->limit($limit)->findAll();
		
		foreach($res as $k=>$v){
			$v['image'] = __UPLOAD__.'/'.$v['image'];
			$res[$k] = $v;
		}
		
		return $res;
	}
	
	//获取广告列表
	function getADList($type=3,$limit=1,$field="*",$order="ctime DESC"){
		$map = "type={$type} AND status=1";
		$res = M("ads")->where($map)->order("ctime DESC")->field($field)->limit($limit)->findAll();
		
		foreach($res as $k=>$v){
			$v['image'] = __UPLOAD__.'/'.$v['image'];
			$res[$k] = $v;
		}
		
		return $res;
	}
}
?>
<?php
/**
 * 验证模型
 * 
 * @author nonant
 */
class CheckModel{
	var $uid;
	//判断相关资料是否验证
	function isCheck($name,$data){
		$obj = !empty($data['app']) ? D($name,$data['app']) : model($name);
		if(!is_object($obj)) return null;
		
		$uid = intval($data['uid'])>0 ? $data['uid'] : $this->uid;
		if($obj instanceof Model){
			return $obj->check($uid);
		}
	}
}
?>
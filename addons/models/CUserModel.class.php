<?php
/**
 * 用户基本模型
 * 
 * @author nonant
 */
class CUserModel extends Model {
	protected $tableName = 'user';
	
	/**
	 * 获取用户的所属父id
	 * @param unknown_type $uid
	 */
	public function getPid($uid) {
		$map['uid'] = $uid;
		$res = $this->where($map)->find();
		return $res['pid'];
	}
	
	/**
	 * 获取用户所属父信息
	 * @param unknown_type $uid
	 */
	public function getPUser($uid) {
		$map = array();
		$map['uid'] = $uid;
		$res = $this->where($map)->find();
		if ( !$res) {
			return array();
		}
		$map = array();
		$map['uid'] = $res['pid'];
		$res = $this->where($map)->find();
		return $res;
	}
}
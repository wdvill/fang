<?php
/**
 * 举报模型
 * 
 * @author JunStar <wangjuncheng@zhishisoft.com>
 */
class DenounceModel extends Model {
	/**
	 * [后台]获取相应类型的举报列表
	 */
	public function getFromList($map){
		return $this->where( $map )->order('ID DESC')->findpage();
	}
	/**
	 * [后台]进入回收站
	 */
	public function deleteDenounce( $ids ){
		$ids = is_array ( $ids ) ? $ids : explode ( ',', $ids );
		if (empty ( $ids ))
			return false;
		$map ['id'] = array ('in', $ids );
		return $this->where ( $map )->save ( array('state'=>'1') );
	}
	/**
	 * [后台]通过审核
	 */
	public function reviewDenounce( $ids ){
		$ids = is_array ( $ids ) ? $ids : explode ( ',', $ids );
		if (empty ( $ids ))
			return false;
		$map ['id'] = array ('in', $ids );
		return $this->where ( $map )->save ( array('state'=>'2') );
	}
	/**
	 * [各应用]获取已经被举报并且管理员将其进入回收站的各应用的id值
	 * $type参数为空则返回一个数组
	 * $type参数不为空则返回一个以逗号隔开的id字符串
	 */
	public function getIdsDenounce( $from,$type='' ){
		$map['from'] = $from;
		$map['state'] = '1';
		$ids = getSubByKey( $this->where( $map )->field('aid')->findall(),'aid' );
		if( $type ){
			$ids = implode(',', $ids);
		}
		return $ids;
	}
}
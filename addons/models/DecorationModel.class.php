<?php
/**
 * 装修状况模型
 * 
 */
class DecorationModel extends Model {
	protected $tableName = 'decoration';
	
	/**
	 * 组装一个key value 形式的 装修状况字典
	 */
	public function keyvalList() {
		$aDecoration = M("decoration")->findAll();
		$cusDecoration = array();
		foreach ( $aDecoration as $decoration) {
			$cusDecoration[$decoration['id']] = $decoration['decoration'];
		}
		return $cusDecoration;
	}
	
	/**
	 * 判断 id 是否存在于 decoration里
	 * @param int $id
	 */
	public function idExists($id) {
		$aDecoration = M("decoration")->findAll();
		foreach ( $aDecoration as $decoration) {
			if ( $decoration['id'] == $id) {
				return true;
			}
		}
		return false;
	}

}
?>
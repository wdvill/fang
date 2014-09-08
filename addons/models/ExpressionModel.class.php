<?php
/**
 * 表情模型
 * 
 * @author daniel <desheng.young@gmail.com>
 */
class ExpressionModel extends Model {
	protected $tableName = 'expression';

	/**
	 * 获取表情
	 * 
	 * @param array  $map   查询条件
	 * @param string $order 默认表情类型升序,表情ID升序排列
	 * @return array 返回中的filepath为表情图片的真实地址
	 */
	public function getExpressionByMap($map = array(), $order = 'type ASC,expression_id ASC') {
		$res = $this->where($map)->order($order)->findAll();
		foreach ($res as $k => $v) {
			$res[$k]['filepath'] = __THEME__ . '/images/expression/' . $v['type'] . '/' . $v['filename'];
		}
		return $res;
	}
	
	public function getAllExpression() {
		$cache_id = '_model_expression';
		if (($res = F($cache_id)) === false) {
			$res = $this->field('title,emotion,filename,type')->findAll();
			F($cache_id, $res);
		}
		return $res;
	}
	
	public function getExpressionDetailByEmotion($emotion) {
		$cache_id = "_model_expression";
		if (($list = object_cache_get($cache_id)) === false) {
			$list = array();
			$res = $this->getAllExpression();
			foreach ($res as $v) {
				$list[$v['emotion']] = $v;
			}
			object_cache_set($cache_id, $list);
		}
		
		return $list[$emotion];
	}
}
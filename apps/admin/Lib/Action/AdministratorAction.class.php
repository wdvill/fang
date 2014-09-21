<?php
class AdministratorAction extends Action {
	
	public function _initialize()
	{
		// $this->success(); 和 $this->error();通过isAdmin变量决定是否加载头部
		$this->assign('isAdmin', 1);
		
		// 检查用户是否登陆管理后台, 有效期为$_SESSION的有效期
		if (!service('Passport')->isLoggedAdmin())
			redirect( U('home/Public/adminlogin') );
		
		// 如果是应用的后台，检查用户是否具有节点权限
		if (APP_NAME != 'admin' && ! service('SystemPopedom')->hasPopedom($this->mid, 'admin/Apps/*', false)) {
			$this->assign('jumpUrl', U('home/Public/adminlogin'));
			$this->error('您无权限查看');
		}
	}
	
	protected function _getSearchMap($fields)
	{
		// 为使搜索条件在分页时也有效，将搜索条件记录到SESSION中
		if (!empty($_POST)) {
			$_SESSION['admin_search_attach'] = serialize($_POST);
		} else if (isset($_GET[C('VAR_PAGE')])) {
			$_POST = unserialize($_SESSION['admin_search_attach']);
		} else {
			unset($_SESSION['admin_search_attach']);
		}
		
		// 组装查询条件
		$map = array();
		foreach ($fields as $k => $v) {
			foreach ($v as $field) {
				if (isset($_POST[$field]) && $_POST[$field] != '') {
					if($k == 'in')
						$map[$field] = array($k, explode(',', $_POST[$field]));
					else
						$map[$field] = array($k, $_POST[$field]);					
				}
			}
		}
		
		return $map;
	}

	/**
	 * 现实分类页面
	 * @param array $tree 树形结构数据
	 * @param string $stable 资源表明
	 * @param integer $level 子分类添加层级数目，默认为0（无限极）
	 * @param array $delParam 删除关联数据模型参数，app、module、method
	 * @param array $extra 附加配置信息字段，字段间使用|分割，字段的属性用-分割。例：attach|type-是-否|is_audit
	 * @return string HTML页面数据
	 */
	public function displayTree($tree = array(), $stable = null, $level = 0, $delParam = null, $extra = '', $limit = 0)
	{
		$this->assign('stable', $stable);
		if(!isset($delParam['module']) || !isset($delParam['method'])) {
			$delParam = null;
		}
		$this->assign('delParam', $delParam);
		$this->assign('tree', $tree);
		$this->assign('level', $level);
		$this->assign('extra', $extra);
		$this->assign('limit', $limit);
		$this->display(THEME_PATH.'/admin_tree.html');
	}
}
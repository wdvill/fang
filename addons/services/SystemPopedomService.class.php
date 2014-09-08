<?php
/**
 * 系统权限服务
 * 
 * @author daniel <desheng.young@gmail.com>
 */
class SystemPopedomService extends Service {

	/**
	 * 检查给定用户是否拥有给定节点的权限
	 * 
	 * @param int	 $uid               用户ID(默认当前用户)
	 * @param string $node              节点, 格式为"APP_NAME/MOD_NAME/ACT_NAME"(默认当前节点)
	 * @param bool	 $has_admin_popedom 当没有设置admin节点权限时的是否默认拥有admin权限 ( true:有权限 false:没有权限 )
	 */
	public function hasPopedom($uid = null, $node = null, $has_admin_popedom = true) {
		global $ts;
		
		$uid  	= isset($uid) ? intval($uid) : $_SESSION['mid'];
		
		// 超级管理员拥有所有权限
		if ( $uid == $_SESSION['mid'] && $_SESSION['userInfo']['admin_level'] == '1' )
			return true;
		
		$node 	= isset($node) ? explode('/', $node) : array($ts['_app'], $ts['_mod'], $ts['_act']);
		$app  	= $node[0];
		$mod  	= $node[1];
		$act  	= $node[2];
		unset($node);
		
		//获取有权限查看此节点的用户组ID
		$prefix = C('DB_PREFIX');
		$where	= "n.app_name='$app' AND ( ( n.mod_name='$mod' AND ( n.act_name='$act' OR n.act_name='*' ) ) OR n.mod_name='*' )";
		$sql 	= "SELECT p.user_group_id FROM {$prefix}node AS n INNER JOIN {$prefix}user_group_popedom AS p ON n.node_id = p.node_id WHERE $where";
		$gid    = M('')->query($sql);
		$gid	= getSubByKey($gid, 'user_group_id');
		
		if ( empty($gid) ) {
			return $has_admin_popedom ? true : $app != 'admin';
		}else {
			// 检查用户是否有权限
			return model('UserGroup')->isUserInUserGroup($uid, $gid);
		}
	}
	
	public function run() {

	}

	public function _start() {

	}

	public function _stop() {

	}

	public function _install() {

	}

	public function _uninstall() {

	}
}
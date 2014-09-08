<?php
class PluginAction extends AdministratorAction {
	
	private function __getPluginInfo($path_name = '', $using_lowercase = true) {
		$filename = SITE_PATH . '/addons/plugins/' . $path_name . '/info.php';
		
		if ( is_file($filename) ) {
			$info = include_once $filename;
			return $using_lowercase ? array_change_key_case($info) : array_change_key_case($info,CASE_UPPER);
		}else {
			return null;
		}
	}
	
	/** 插件 - 勋章管理 **/
	
	public function medal() {
		$this->assign('medal', model('Medal')->getInstalledMedal());
		$this->display();
	}
	
	public function installMedal() {
		// 已安装的插件
		$installed		= model('Medal')->getInstalledMedal();
		$installed		= getSubByKey($installed, 'path_name');
		
		// 全部插件
		require_once SITE_PATH . '/addons/libs/Io/Dir.class.php';
		$dirs	= new Dir(SITE_PATH.'/addons/plugins/Medal');
		$dirs	= $dirs->toArray();
		
		// 获取未安装的插件
		$uninstalled	= array();
		foreach($dirs as $v)
			if ( $v['isDir'] && !in_array($v['filename'], $installed) )
				if ( $info = $this->__getPluginInfo('Medal/'.$v['filename']) )
					$uninstalled[]	= $info;
		
		$this->assign('uninstalled', $uninstalled);
		$this->display('installMedal');
	}
	
	public function doInstallMadel() {
		$_GET['path_name'] = t($_GET['path_name']);
		
		$info = $this->__getPluginInfo('Medal/'.t($_GET['path_name']));
		if ( ! $info ) {
			$this->error('未找到安装信息');
		}else {
			// 检查是否已安装
			$installed		= model('Medal')->getInstalledMedal();
			$installed		= getSubByKey($installed, 'path_name');
			if ( in_array($_GET['path_name'], $installed) )
				$this->error('该勋章已安装');
			
			$info['is_active']	= 1;
			$info['ctime']		= time();
			if ( ( $medal_id = M('medal')->add($info) ) ) {
				// 为排序方便，设置 display_order = medal_id
				
				$_LOG['uid'] = $this->mid;
				$_LOG['type'] = '1';
				$data[] = '扩展 - 插件 - 勋章管理 - 安装勋章';
				$data[] = $_GET['path_name'];
				$_LOG['data'] = serialize($data);
				$_LOG['ctime'] = time();
				M('AdminLog')->add($_LOG);
				
				M('medal')->where('`medal_id`='.$medal_id)->setField('display_order', $medal_id);
				$this->assign('jumpUrl', U('admin/Plugin/installMedal'));
				$this->success('安装成功');
			}else {
				$this->error('安装失败');
			}
		}
	}
	
	public function doSetMedalStatus() {
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '1';
		$data[] = '扩展 - 插件 - 勋章管理 - 设置勋章状态';
		$data[] = $_POST;
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		echo model('Medal')->setMedalStatus(intval($_POST['id']), intval($_POST['status'])) ? '1' : '0';
	}
	
	public function doMedalOrder() {
		$_POST['id']	 = intval($_POST['id']);
		$_POST['baseid'] = intval($_POST['baseid']);
		if ( $_POST['id'] <= 0 || $_POST['baseid'] <= 0 ) {
			echo 0;
			exit;
		}
		$dao = M('medal');
		$map['medal_id'] = array('in', array($_POST['id'], $_POST['baseid']));
		$res = $dao->where($map)->field('medal_id,display_order')->findAll();
		if ( count($res) != 2 ) {
			echo 0;
			exit;
		}

		//转为结果集为array('id'=>'order')的格式
    	foreach($res as $v) {
    		$order[$v['medal_id']]	= intval($v['display_order']);
    	}
    	unset($res);

    	//交换order值
    	$res = 		   $dao->where('`medal_id`=' . $_POST['id'])->setField( 'display_order', $order[$_POST['baseid']] );
    	$res = $res && $dao->where('`medal_id`=' . $_POST['baseid'])->setField( 'display_order', $order[$_POST['id']] );
		
    	$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '1';
		$data[] = '扩展 - 插件 - 勋章管理 - 设置勋章排序';
		$data[] = $_POST;
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
    	
    	if($res) echo 1;
    	else	 echo 0;
	}
	
	public function uninstallMedal() {
		if ( ($medal_id = intval($_GET['medal_id'])) <= 0 )
			$this->error('参数错误');
			
		$this->assign('jumpUrl', U('admin/Plugin/medal'));
		if ( model('Medal')->deleteMedal($medal_id) ){
			$_LOG['uid'] = $this->mid;
			$_LOG['type'] = '2';
			$data[] = '扩展 - 插件 - 勋章管理 - 卸载勋章';
			$data[] = model('Medal')->where( 'medal_id='.$_GET['medal_id'] )->field('path_name')->find();
			$_LOG['data'] = serialize($data);
			$_LOG['ctime'] = time();
			M('AdminLog')->add($_LOG);
			
			$this->success('卸载成功');
		}else{ 
			$this->error('卸载失败');
		}
	}
	
	
	public function shorturl(){
		$shorturl = model('Xdata')->lget('shorturl');
		$this->assign($shorturl);
		$this->display();
	}
	
	public function doshorturl(){
		$data['shorturl_type'] = $_POST['shorturl_type'];
		$data['customize_url'] = h($_POST['customize_url']);
		model('Xdata')->lput('shorturl', $data);
		$this->redirect( 'admin/Plugin/shorturl' );
	}
}
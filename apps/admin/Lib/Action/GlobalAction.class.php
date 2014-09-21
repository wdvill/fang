<?php
class GlobalAction extends AdministratorAction {
	
	private function __isValidRequest($field, $array = 'post') {
		$field = is_array($field) ? $field : explode(',', $field);
		$array = $array == 'post' ? $_POST : $_GET;
		foreach ($field as $v){
			$v = trim($v);
			if ( !isset($array[$v]) || $array[$v] == '' ) return false;
		}
		return true;
	}
	
	/** 系统配置 - 站点配置 **/
	
	//站点设置
	public function siteopt() {
		$site_opt = model('Xdata')->lget('siteopt');
		$this->assign($site_opt);

		require_once ADDON_PATH . '/libs/Io/Dir.class.php';
        $theme_list = new Dir(SITE_PATH.'/public/themes/');
        $this->assign('theme_list',$theme_list->toArray());
        $this->display();
	}
	
	//设置站点
	public function doSetSiteOpt() {
		if (empty($_POST)) {
			$this->error('参数错误');
		}
		
		$_POST['site_name']           		= t($_POST['site_name']);
		$_POST['site_slogan']		  		= t($_POST['site_slogan']);
		$_POST['site_header_keywords']		= t($_POST['site_header_keywords']);
		$_POST['site_header_description']	= t($_POST['site_header_description']);
		$_POST['site_closed']		 		= intval($_POST['site_closed']);
		$_POST['site_closed_reason'] 		= t($_POST['site_closed_reason']);
		$_POST['site_icp']  		 		= t($_POST['site_icp']);
		$_POST['site_verify']		 		= isset($_POST['site_verify']) ? $_POST['site_verify'] : '';
		
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '3';
		$data[] = '全局 - 站点配置 ';
		$site_opt = model('Xdata')->lget('siteopt');
		$data[] = $site_opt;
		if( $_POST['__hash__'] ) unset( $_POST['__hash__'] );
		$data[] = $_POST;
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		$res = model('Xdata')->lput('siteopt', $_POST);
		if ($res) {
			$this->assign('jumpUrl', U('admin/Global/siteopt'));
			$this->success('保存成功');
		}else {
			$this->error('保存失败');
		}
	}
	
	/** 系统配置 - 注册配置 **/
	
	public function register() {
		$register = model('Xdata')->lget('register');
		$this->assign($register);
		$invite   = model('Invite')->getSet();
		$this->assign($invite);
		$this->display();
	}
	
	public function doSetRegisterOpt() {
		
		$invite_set['invite_set'] = t($_POST['invite_set']);
		
		$invite   = model('Invite')->getSet();
		
		$site_opt = model('Xdata')->lget('register');
		
		unset($_POST['invite_set']);
		if ( model('Xdata')->lput('register', $_POST) && model('Xdata')->lput('inviteset', $invite_set) ) {
			$this->assign('jumpUrl', U('admin/Global/register'));
			
			$_LOG['uid'] = $this->mid;
			$_LOG['type'] = '3';
			$data[] = '全局 - 注册配置 ';
			$site_opt['invite_set'] = $invite['invite_set'];
			if( $site_opt['__hash__'] ) unset( $site_opt['__hash__'] );
			$data[] = $site_opt;
			$_POST['invite_set'] = $invite_set['invite_set'];
			if( $_POST['__hash__'] ) unset( $_POST['__hash__'] );
			$data[] = $_POST;
			$_LOG['data'] = serialize($data);
			$_LOG['ctime'] = time();
			M('AdminLog')->add($_LOG);
			
			$this->success('保存成功');
		}else {
			$this->error('保存失败');
		}
	}
	
	/** 系统配置 - 公告配置 **/
	
	public function announcement() {
		if ($_POST) {
			$_LOG['uid'] = $this->mid;
			$_LOG['type'] = '3';
			$data[] = '全局 - 公告配置 ';
			$data[] = model('Xdata')->lget('announcement');
			if( $_POST['__hash__'] )unset( $_POST['__hash__'] );
			$data[] = $_POST;
			$_LOG['data'] = serialize($data);
			$_LOG['ctime'] = time();
			M('AdminLog')->add($_LOG);
			
			unset($data);
			$data['is_open'] = intval($_POST['is_open']);
			$data['content'] = t($_POST['content'], false, ENT_QUOTES);
			model('Xdata')->lput('announcement', $data);
			
			F('_home_user_action_announcement', null);
			
			$this->assign('jumpUrl', U('admin/Global/announcement'));
			$this->success('保存成功');
		}else {
			$announcement = model('Xdata')->lget('announcement');
			$this->assign($announcement);
			$this->display();
		}
	}
	
	/** 系统配置 - 邮件配置 **/
	
	public function email(){
		if($_POST){
			
			$_LOG['uid'] = $this->mid;
			$_LOG['type'] = '3';
			$data[] = '全局 - 邮件配置 ';
			$data[] = model('Xdata')->lget('email');
			if( $_POST['__hash__'] )unset( $_POST['__hash__'] );
			$data[] = $_POST;
			$_LOG['data'] = serialize($data);
			$_LOG['ctime'] = time();
			M('AdminLog')->add($_LOG);
			
			unset($_POST['__hash__']);
			model('Xdata')->lput('email',$_POST);
			$this->assign('jumpUrl', U('admin/Global/email'));
			$this->success('保存成功');
		}else{
			$email = model('Xdata')->lget('email');
			$this->assign($email);
			$this->display();
		}
	}
	
	/** 系统配置 - 附件配置 **/
	
	public function attachConfig() {
		if ($_POST) {
			
			$_LOG['uid'] = $this->mid;
			$_LOG['type'] = '3';
			$data[] = '全局 - 附件配置 ';
			$data[] = model('Xdata')->lget('attach');
			if( $_POST['__hash__'] )unset( $_POST['__hash__'] );
			$data[] = $_POST;
			$_LOG['data'] = serialize($data);
			$_LOG['ctime'] = time();
			M('AdminLog')->add($_LOG);
			
			$_POST['attach_path_rule']		 = t($_POST['attach_path_rule']);
			$_POST['attach_max_size']		 = floatval($_POST['attach_max_size']);
			$_POST['attach_allow_extension'] = t($_POST['attach_allow_extension']);
			$this->assign('jumpUrl', U('admin/Global/attachConfig'));
			if ( model('Xdata')->lput('attach', $_POST) )
				$this->success('保存成功');
			else
				$this->error('保存失败');
			
		}else {
			$data = model('Xdata')->lget('attach');
			$this->assign($data);
			$this->display();
		}
	}
	

	/** 系统配置 - 文章配置 **/

	public function document() {
		$data = M('document')->order('`display_order` ASC,`document_id` ASC')->findAll();
		$this->assign('data', $data);
		$this->display();
	}

	public function addDocument() {
		$this->assign('type', 'add');
		$this->display('editDocument');
	}

	public function editDocument() {
		$map['document_id'] = intval($_GET['id']);
		$document = M('document')->where($map)->find();
		if ( empty($document) )
			$this->error('该文章不存在');
		$this->assign($document);

		$this->assign('type', 'edit');
		$this->display();
	}

	public function doEditDocument() {
		if ( ($_POST['document_id'] = intval($_POST['document_id'])) <= 0 )
			unset($_POST['document_id']);

		// 格式化数据
		$_POST['title']			= t($_POST['title']);
		$_POST['is_active']		= intval($_POST['is_active']);
		$_POST['is_on_footer']	= intval($_POST['is_on_footer']);
		$_POST['last_editor_id']= $this->mid;
		$_POST['mtime']			= time();
		if(!preg_match("/^<p>((?:https?|mailto):\/\/.*?)<\/p>.+/i",$_POST['content']) && preg_match("/^<p>((?:https?|mailto):\/\/.*?)<\/p>/i",$_POST['content'],$url)){
			$_POST['content'] = h($url[1]);
		}else{			
			$_POST['content'] = t(h($_POST['content']));
		}
		if ( !isset($_POST['document_id']) ) {
			// 新建文章
			$_POST['author_id']	= $this->mid;
			$_POST['ctime']		= $_POST['mtime'];
		}

		// 数据检查
		if ( empty($_POST['title']) )
			$this->error('标题不能为空');
		
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = isset($_POST['document_id']) ? '3' : '1';
		$data[] = '全局 - 文章配置 ';
		isset($_POST['document_id']) && $data[] =  model('Xdata')->lget('platform');
		if( $_POST['__hash__'] )unset( $_POST['__hash__'] );
		$data[] = $_POST;
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		// 提交
		$res = isset($_POST['document_id']) ? M('document')->save($_POST) : M('document')->add($_POST);

		if($res) {
			if ( isset($_POST['document_id']) ) {
				$this->assign('jumpUrl', U('admin/Global/document'));
			}else {
				// 为排序方便, 新建完毕后, 将display_order设置为ad_id
				M('document')->where("`document_id`=$res")->setField('display_order', $res);
				$this->assign('jumpUrl', U('admin/Global/addDocument'));
			}
			$this->success('保存成功');
		}else {
			$this->error('保存失败');
		}
	}

	public function doDeleteDocument() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = '2';
		$data[] = '全局 - 文章配置 ';
		$data[] = model('Xdata')->lget('platform');
		if( $_POST['__hash__'] )unset( $_POST['__hash__'] );
		$data[] = $_POST;
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);
		
		$map['document_id'] = array('in', t($_POST['ids']));
		echo M('document')->where($map)->delete() ? '1' : '0';
	}

	public function doDocumentOrder() {
		$_POST['document_id']	= intval($_POST['document_id']);
		$_POST['baseid']		= intval($_POST['baseid']);
		if ( $_POST['document_id'] <= 0 || $_POST['baseid'] <= 0 ) {
			echo 0;
			exit;
		}

		// 获取详情
		$map['document_id'] = array('in', array($_POST['document_id'], $_POST['baseid']));
		$res = M('document')->where($map)->field('document_id,display_order')->findAll();
		if ( count($res) < 2 ) {
			echo 0;
			exit;
		}

		//转为结果集为array('id'=>'order')的格式
    	foreach($res as $v) {
    		$order[$v['document_id']] = intval($v['display_order']);
    	}
    	unset($res);

    	//交换order值
    	$res = 		   M('document')->where('`document_id`=' . $_POST['document_id'])->setField(  'display_order', $order[$_POST['baseid']] );
    	$res = $res && M('document')->where('`document_id`=' . $_POST['baseid'])->setField( 'display_order', $order[$_POST['document_id']]  );

    	if($res) echo 1;
    	else	 echo 0;
	}
	
	/** 审核配置 **/
	public function audit(){
		$audit = model('Xdata')->lget('audit');
		$this->assign($audit);
		$this->display();
	}
	
	public function doSaveAudit(){
		if($_POST){
			$_LOG['uid'] = $this->mid;
			$_LOG['type'] = '3';
			$data[] = '全局 - 审核配置 ';
			$data[] = model('Xdata')->lget('audit', $map);
			if( $_POST['__hash__'] )unset( $_POST['__hash__'] );
			$data[] = $_POST;
			$_LOG['data'] = serialize($data);
			$_LOG['ctime'] = time();
			M('AdminLog')->add($_LOG);
			
			model('Xdata')->lput('audit', $_POST);
		}
		$this->assign('jumpUrl', U('admin/Global/audit'));
		$this->success("配置成功");
	}
	
	/** 装修状况配置 **/
	public function decoration(){
		$aDecoration = M('decoration')->findAll();
		$this->assign('data', $aDecoration);
		$this->display();
	}
	
	public function addDecoration() {
		$this->assign('type', 'add');
		$this->display('editDecoration');
	}
	
	public function editDecoration() {
		$map['id'] = intval($_GET['id']);
		$ad = M('decoration')->where($map)->find();
		if(empty($ad))
			$this->error('参数错误');
		$this->assign($ad);
		$this->assign('type', 'edit');
		$this->display();
	}
	
	public function doEditDecoration() {
		// 格式化数据
		$_POST['id']			= h(t($_POST['id']));
		$_POST['decoration']	= h(t($_POST['decoration']));

		$_POST['mtime']			= time();
		if ( !isset($_POST['id']) )
			$_POST['ctime']		= time();
	
		// 数据检查
		if(empty($_POST['decoration']))
			$this->error('装修状况不能为空');
	
		$_LOG['uid'] = $this->mid;
		$_LOG['type'] = isset($_POST['info_id']) ? '3' : '1';
		$data[] = "内容 - 修改装修状况信息";
		isset($_POST['id']) && $data[] =  M('decoration')->where( array( 'id'=>intval($_POST['id']) ) )->find();
		if ( isset($_POST['id']) ) unset( $data['1']['ctime'] );
		//unset( $data['1']['display_order'] );
		if( $_POST['__hash__'] )unset( $_POST['__hash__'] );
		$data[] = $_POST;
		$_LOG['data'] = serialize($data);
		$_LOG['ctime'] = time();
		M('AdminLog')->add($_LOG);

		// 提交数据
		if ( $_POST['type'] == 'edit') {
			$map = array();
			$map['id'] = intval( $_POST['id']);
			$res = M('decoration')->where($map)->save($_POST);
		} else {
			$res = M('decoration')->add($_POST);
		}
	
		if($res) {
			if( !isset($_POST['http_referer']) ) {
				$this->assign('jumpUrl', $_POST['http_referer']);
			}else {
				$this->assign('jumpUrl', U('admin/Global/decoration'));
			}
			$this->success('保存成功');
		}else {
			$this->error('保存失败');
		}
	}
	
	public function doDeleteDecorations() {
		if( empty($_POST['ids']) ) {
			echo 0;
			exit ;
		}
		$map['id'] = array('in', t($_POST['ids']));

		echo M('decoration')->where($map)->delete() ? '1' : '0';
	}
}
<?php 
class MessageAction extends Action{
	
	public function index($type = 'inbox'){
		$dao = model('Message');
		
		$list = $type == 'inbox' ? $dao->getInboxByUid($this->mid) : $dao->getOutboxByUid($this->mid);
		foreach ($list['data'] as $k => $v){
			$list['data'][$k]['summary'] = msubstr($v['content'], 0, 100);
		}
		$this->assign($list);
		
		$session_count = $dao->getSessionCount( $this->mid, getSubByKey($list['data'], 'source_message_id') );
		$this->assign('session_count', $session_count);
		
		$this->assign('type', $type);
		$this->setTitle($type == 'inbox' ? '收件箱' : '发件箱');
		$this->display('list');
	}
	
	public function inbox(){
		$this->index('inbox');
	}
	
	public function outbox(){
		$this->index('outbox');
	}
	
	public function garbage(){
		$dao = model('Message');
		
		$list = $dao->getGarbageByUid($this->mid);
		foreach ($list['data'] as $k => $v){
			$list['data'][$k]['summary'] = msubstr($v['content'], 0, 100);
		}
		$this->assign($list);
		
		$session_count = $dao->getSessionCount( $this->mid, getSubByKey($list['data'], 'source_message_id') );
		$this->assign('session_count', $session_count);
		
		$this->setTitle('垃圾箱');
		$this->display();
	}
	
	//通知
	public function notify()
	{
		$list = X('Notify')->get('receive=' . $this->mid, 10);
		// 解析表情
		foreach($list['data'] as $k => $v) {
			$list['data'][$k]['title'] = preg_replace_callback("/\[(.+?)\]/is",replaceEmot,$v['title']);
			$list['data'][$k]['body']  = preg_replace_callback("/\[(.+?)\]/is",replaceEmot,$v['body']);
			$list['data'][$k]['other'] = preg_replace_callback("/\[(.+?)\]/is",replaceEmot,$v['other']);
		}
		$this->assign('userCount', X('Notify')->getCount($this->mid));
		$this->assign($list);
		$this->setTitle('系统通知');
		$this->display();
	}
	
	//应用消息（漫游的邀请）
	public function appmessage() {
		$db_prefix	= C('DB_PREFIX');
		$sql		= "SELECT COUNT(appid) AS count,`appid`,`typename` FROM {$db_prefix}myop_myinvite WHERE `touid`={$this->mid} GROUP BY `appid`";
		$res		= M('')->query($sql);
		$my_count	= array();
		foreach ($res as $v) {
			$my_count[$v['appid']]	= $v;
		}
		
		$map['touid']	= $this->mid;
		$res	= M('myop_myinvite')->where($map)->order('appid DESC')->findPage('10');
		unset($map);
		// 将应用消息置为已读
		$appids = getSubByKey($res['data'], 'id');
		$map['touid'] = $this->mid;
		$map['id']    = array('in', $appids);
		M('myop_myinvite')->where($map)->setField('is_read', '1');
		
    	$this->assign($res);
    	$this->setTitle('应用消息');
		$this->display('appmessage');
	}
	
	public function deleteMyInvite() {
		$_POST['hash']	= t($_POST['hash']);
		$map['touid']	= $this->mid;
		$map['hash']	= $_POST['hash'];
		if ( M('myop_myinvite')->where($map)->find() && M('myop_myinvite')->where($map)->delete() ) {
			echo 1;
		}else {
			echo 0;
		}
	}
	
	//删除通知
	function delnotify(){
		$intNotifyId = intval( $_POST['notify_id'] );
		if(M('notify')->where('notify_id='.$intNotifyId.' AND receive='.$this->mid)->delete()){
			echo 1;
		}
	}
	
	public function detail() {
		$message = model('Message')->getDetailById( $this->mid, intval($_GET['id']) );
		if ( empty($message) ) $this->error('该站内信不存在或已删除');

		$this->assign('message', $message);
		$this->assign('count', count($message));
		$this->assign('type', t($_GET['type']) == 'inbox' ? 'inbox' : 'outbox');
		
		//设置私信为已读后, 重新设置计数
		model('Message')->setMessageIsRead($message[0]['source_message_id']);
		
		$this->setTitle('私信');
		$this->display();
	}
	
	public function post(){
		$touid = intval($_GET['touid']);
		$this->assign('touid',$touid);
		$this->display();
	}
	
	public function doPost() {
		if (!lockSubmit(10)) {
			echo -1;
			exit;
		}
		if (empty($_POST['to']) || empty($_POST['content'])) {
			echo 0;
			exit;
		}
		$to_num = explode(',', $_POST['to']);
		if( sizeof($to_num)>10 ){
			echo '-2';
			exit;
		}
		$res = model('Message')->postMessage($_POST, $this->mid);
		if ($res) {
			echo 1;
		}else {
			echo 0;
		}
		
		// NO unlockSubmit(); !!!
	}
	
	public function doReply() {
		if ( empty($_POST['reply_content']) ) {
			echo 0;
			exit;
		}
		
		$res = model('Message')->replyMessage( intval($_POST['message_id']), t($_POST['reply_content']), $this->mid );
		if ($res) {
			echo 1;
		}else {
			echo 0;
		}
	}
	
	public function doSetIsUnread() {
		$res = model('Message')->setMessageIsUnread(t($_POST['ids']));
		if ($res) echo 1;
		else	  echo 0;
	}
	
	public function doSetIsRead() {
		$res = model('Message')->setMessageIsRead(t($_POST['ids']));
		if ($res) echo 1;
		else	  echo 0;
	}
	
	public function doDelete() {
		$res = model('Message')->deleteMessageById($this->mid, t($_POST['ids']),$_POST['type']);
		if ($res) echo 1;
		else	  echo 0;
	}
	
	public function doRecover() {
		$res = model('Message')->recoverMessageById($this->mid, t($_POST['ids']));
		if ($res) echo 1;
		else	  echo 0;
	}
}
?>
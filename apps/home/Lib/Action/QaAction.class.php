<?php
/* 
问答相关
*/ 
class QaAction extends Action {
	private $question;
	
	public function _initialize() {
		$this->question = D('Question');
	}
	
	public function index() {
		$this->assign($data);
		$this->display();
	}
	
	public function search(){
		$search_key = $this->_getSearchKey();
		if(!empty($search_key)){
			$map = "content LIKE '%".h(t($search_key))."%'";
			$data['list'] = $this->question->getQuestionListByMap($this->mid,$map,20,'ques_id,uid,answer,content,public,ctime','ques_id DESC',true);
		}
		$this->assign($data);
		$this->display();
	}
	
	function ask(){
		$res = $this->question->ask($this->mid,$_POST);
		//处理目标信息
		if(is_array($res)){
			echo $res['id'];
			$this->question->saveTarget($this->mid,$res['id'],$res['target']);
		}elseif($res){
			echo $res;
		}
		exit;
	}
	
	//回答问题
	function doanswer(){
		echo json_encode($this->question->answer($this->mid,$_POST));
	}
	
	//加载回答页面
	function loadanswer(){
		//获取某问题的列表
		$data['list'] = $this->question->getQuestionAnswer($_POST['id']);
		
		$this->assign($data);
		$this->display();
	}
	
	//回复答案表单模板
	function getreplytpl(){
		echo '<form action="'.U('home/qa/doanswer').'" method="post" onsubmit="return checkReplyAnswer(this);" id="reply_answer_'.$_POST['sd'].'" style="margin-left:80px;">
				  <textarea name="content" rows="5" style="border:1px solid #CCC; width:700px; height:60px; color:#666;overflow:hidden;"></textarea><br />
				  <input type="submit" value="回复" class="N_but l" />
				  <input type="button" value="取消" class="N_but r" onclick="removeReply(this);"/>
				  <input type="hidden" name="qd" value="'.$_POST['qd'].'" />
				  <input type="hidden" name="sd" value="'.$_POST['sd'].'" />
				  <span class="error-message"></span>
			  </form>';
		exit;
	}
	
	//收藏问题
	function collect(){
		if($_POST['type']=='collect'){
			echo $this->question->doCollect($this->mid,$_POST['qd']);
		}elseif($_POST['type']=='uncollect'){
			echo $this->question->deleteCollect($this->mid,$_POST['qd']);
		}
		exit;
	}
	
	//删除问题
	function deletequestion(){
		echo $this->question->deleteQuestion($this->mid,intval($_POST['id']));
	}
	
	//删除问题答案
	function deleteanswer(){
		echo $this->question->deleteAnswer($this->mid,intval($_POST['id']));
	}
	
	//获取私密问答人脉列表
	function getfriend(){
		$list = model("Friend")->getFriendList($this->mid,null,'','friend_id DESC',false);
		echo $this->getFriendTpl($list);
		exit;
	}
	
	//私密问答人脉模板
	function getFriendTpl($list){
		if(empty($list['data'])) return ;
		
		$return = '';
		foreach($list['data'] as $k=>$v){
			$return .= '<div style="padding:2px 10px;border-bottom:1px dashed #CCC;"><input type="checkbox" value="'.$v['uid'].'">&nbsp;&nbsp;'.$v['uname'].'&nbsp;（'.$v['position'].'，'.$v['company'].'）</div>';
		}
		
		return $return;
	}
	
	protected function _getSearchKey($key_name = 'k'){
		$key = '';
		// 为使搜索条件在分页时也有效，将搜索条件记录到SESSION中
		if ( isset($_REQUEST[$key_name]) && !empty($_REQUEST[$key_name]) ) {
			if($_GET[$key_name]){
				$key = html_entity_decode( urldecode($_GET[$key_name]) ,ENT_QUOTES);
			}elseif($_POST[$key_name]){
				$key = $_POST[$key_name];
			}
			// 关键字不能超过30个字符
			if ( mb_strlen($key, 'UTF8') > 30 )
				$key = mb_substr($key, 0, 30, 'UTF8');
			$_SESSION['question_search_' . $key_name] = serialize( $key );
		}else if ( is_numeric($_GET[C('VAR_PAGE')]) ) {
			$key = unserialize( $_SESSION['question_search_' . $key_name] );
		}			
		$this->assign('search_key', h(t($key)));
		return trim($key);
	}
}
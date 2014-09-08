<?php 
class TopicAction extends Action{
    
	function init(){
		echo './Public/miniblog.js';
	}
    
	function index(){
		$data = '';
		$this->assign( $data );
        $this->display();
	}
    
	//热门话题
	function hot(){
		$data ['list'] = '';
		//print_r($data ['list']);
		$this->assign( $data );
        $this->display();
	}
	
	//话题内容页
	function detail(){
		$data ['list'] = '';
		//print_r($data ['list']);
		$this->assign( $data );
        $this->display();
	}
	
	private function __getSearchKey() {
		$key = '';
		// 为使搜索条件在分页时也有效，将搜索条件记录到SESSION中
		if (isset ( $_REQUEST ['k'] ) && ! empty ( $_REQUEST ['k'] )) {
			if ($_GET ['k']) {
				$key = html_entity_decode ( urldecode ( $_GET ['k'] ), ENT_QUOTES );
			} elseif ($_POST ['k']) {
				$key = $_POST ['k'];
			}
			// 关键字不能超过30个字符
			if (mb_strlen ( $key, 'UTF8' ) > 30)
				$key = mb_substr ( $key, 0, 30, 'UTF8' );
			$_SESSION ['weibo_search_key'] = serialize ( $key );
		
		} else if (is_numeric ( $_GET [C ( 'VAR_PAGE' )] )) {
			$key = unserialize ( $_SESSION ['weibo_search_key'] );
		
		} else {
			//unset($_SESSION['weibo_search_key']);
		}
		
		return trim ( $key );
	}
}
?>
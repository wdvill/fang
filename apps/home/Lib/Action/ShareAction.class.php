<?php
/*
分享相关
*/
class ShareAction extends Action {
	
	public function _initialize() {
		
	}
	
	public function index() {
		
		$this->assign($data);
		$this->display();
	}
}
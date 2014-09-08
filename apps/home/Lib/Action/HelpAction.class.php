<?php
/*
帮助类
*/
class HelpAction extends Action {
	

	public function _initialize() {

	}

   	//关于
	public function aboutus() {
		$map['document_id'] = 1;
		$document = M('document')->where($map)->find();
		if ( empty($document) )
			$this->error('该帮助文档不存在');
		$this->assign("title",real_strip_tags($document['title']));
		$this->assign("content",htmlspecialchars_decode($document['content']));
		$this->display();
	}

   	//服务条款
	public function terms() {
		$map['document_id'] = 2;
		$document = M('document')->where($map)->find();
		if ( empty($document) )
			$this->error('该帮助文档不存在');
		$this->assign("title",real_strip_tags($document['title']));
		$this->assign("content",htmlspecialchars_decode($document['content']));
		$this->display();
	}

   	//联系我们
	public function contact() {
		$map['document_id'] = 3;
		$document = M('document')->where($map)->find();
		if ( empty($document) )
			$this->error('该帮助文档不存在');
		$this->assign("title",real_strip_tags($document['title']));
		$this->assign("content",htmlspecialchars_decode($document['content']));
		$this->display();
	}

   	//使用帮助
	public function operate() {
		$map['document_id'] = 4;
		$document = M('document')->where($map)->find();
		if ( empty($document) )
			$this->error('该帮助文档不存在');
		$this->assign("title",real_strip_tags($document['title']));
		$this->assign("content",htmlspecialchars_decode($document['content']));
		$this->display();
	}

   	//积分规则
	public function credit() {
		$map['document_id'] = 5;
		$document = M('document')->where($map)->find();
		if ( empty($document) )
			$this->error('该帮助文档不存在');
		$this->assign("title",real_strip_tags($document['title']));
		$this->assign("content",htmlspecialchars_decode($document['content']));
		$this->display();
	}

}
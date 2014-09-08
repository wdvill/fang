<?php 
class UserApi extends Api{
	
	//按用户UID或昵称返回用户资料，同时也将返回用户的最新发布的微博
	function show(){
		$data = getUserInfo($this->user_id, urldecode($this->user_name),$this->mid,true);
		return $data;
	}
	
	public function notificationCount() {
		return service('Notify')->getCount($this->user_id);
	}
	
	public function unsetNotificationCount()
	{
		switch ($this->data['type']) { // 暂仅允许message/weibo_commnet/atMe
			case 'message':
				return model('Message')->setAllIsRead($this->user_id);
			case 'weibo_comment':
				return model('UserCount')->setZero($this->user_id, 'comment');
			case 'atMe':
				return model('UserCount')->setZero($this->user_id, 'atme');
			default:
				return false;
		}
	}
}
<?php
class MedalAction extends Action {
	
	public function medalCallBack() {
		$medal_name		= t($_REQUEST['medal']);
		$method_name	= t($_REQUEST['method']);
		$param			= unserialize(urldecode($_REQUEST['param']));
		echo medal($medal_name)->$method_name($param);
	}
}
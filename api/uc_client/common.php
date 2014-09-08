<?php
//添加ThinkSNS与UCenter的用户映射
function add_ucenter_user_ref($uid,$uc_uid,$uc_username=''){
	$uc_ref_data = array(
					   'uid' => $uid,
					   'uc_uid' => $uc_uid,
					   'uc_username'  => $uc_username,
				   );
	M('ucenter_user_link')->add($uc_ref_data);
	return $uc_ref_data;
}
//更新ThinkSNS与UCenter的用户映射
function update_ucenter_user_ref($uid,$uc_uid,$uc_username=''){
	$uid 		 &&	$map['uid']					= intval($uid);
	$uc_uid 	 && $map['uc_uid'] 				= intval($uc_uid);
	$uc_username && $uc_ref_data['uc_username'] = $uc_username;
	if(empty($uc_ref_data['uc_username']))return;
	M('ucenter_user_link')->where($map)->save($uc_ref_data);
}
//获取ThinkSNS与UCenter的用户映射
function get_ucenter_user_ref($uid='',$uc_uid='',$uc_username=''){
	$uid && $map['uid'] 				= intval($uid);
	$uc_uid && $map['uc_uid'] 			= intval($uc_uid);
	$uc_username && $map['uc_username'] = intval($uc_username);
	if(!$map)return;
	return M('ucenter_user_link')->where($map)->find();
}
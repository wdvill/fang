<?php

//是否已设置头像
function isSetAvatar($uid){
    return is_file( SITE_PATH.'/data/uploads/avatar/'.$uid.'/small.jpg');
}

//获取微博条数
function getMiniNum($uid){
	return M('weibo')->where('uid='.$uid)->count();
}

//获取关注数
function getUserFollow($uid){
	$count['following'] = M('follow')->where("uid=$uid AND type=0")->count();
	$count['follower']  = M('follow')->where("fid=$uid AND type=0")->count();
	return $count;
}

// 短地址
function getContentUrl($url) {
	return getShortUrl( $url[1] ).' ';
}

// 登陆页微博表情解析
function login_emot_format($content)
{
    echo preg_replace_callback('/(?:#[^#]*[^#^\s][^#]*#|(\[.+?\]))/is', 'replaceEmot', $content);
}
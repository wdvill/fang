<?php

function compress($buffer) {//去除文件中的注释
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	return $buffer;
}

function getContentUrl($url){
	return getShortUrl( $url[1] ).' ';
}

//获取微博页面广告
function getWeiboAds($limit=1){
	$res = M("ad")->where('status=1')->order("rand()")->limit($limit)->findAll();
	
	foreach($res as $k=>$v){
		$v['content'] = unserialize($v['content']);
		$res[$k] = $v;
	}
	
	return $res;
}

//获取微博人气用户
function getWeiboHotUser($limit=5){
	$res = M("user")->where('is_active=1')->limit($limit)->field("uid,uname,position,company")->findAll();
	
	foreach($res as $k=>$v){
		$v['url'] = getUserUrl($v['uid']);
		$v['face'] = getUserFace($v['uid'],'m');
		$res[$k] = $v;
	}
	
	return $res;
}
<?php
/*
 * 游客访问的黑/白名单
 */
return array(
	"access"	=>	array(
		'home/Widget/renderWidget' 	=> true,
		'home/User/countNew'		=> true,
		'home/Public/*'				=> true,
		'home/Help/*'				=> true,
		'home/Space/*'      		=> true,
		'home/Info/*'      		=> true,
		'phptest/*/*'				=> true,
		'api/*/*'					=> true,
		'home/info/detail'			=> true,
		'wap/*/*'					=> true,
		'wap_sz/*/*'				=> true,
		'admin/*/*'					=> true, // 管理后台的权限由它自己控制
		'weibo/Plugins/init'		=> true, // 个人主页时引入动态生成的JS
		'home/Square/*'				=> true, // 微博广场的权限由管理后台控制
		'home/Friend/search'		=> true, // 搜索的权限由管理后台控制
	)
);
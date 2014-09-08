<?php
if (!defined('SITE_PATH')) exit();

return array(
	// 数据库常用配置
	'DB_TYPE'			=>	'mysql',			// 数据库类型
	'DB_HOST'			=>	'localhost',			// 数据库服务器地址
	'DB_NAME'			=>	'acy_fang',			// 数据库名
	'DB_USER'			=>	'root',		// 数据库用户名
	'DB_PWD'			=>	'',		// 数据库密码
	'DB_PORT'			=>	3306,				// 数据库端口
	'DB_PREFIX'			=>	'zx_',		// 数据库表前缀（因为漫游的原因，数据库表前缀必须写在本文件）
	'DB_CHARSET'		=>	'utf8',				// 数据库编码
	'DB_FIELDS_CACHE'	=>	true,				// 启用字段缓存
	

	// 默认应用
    'DEFAULT_APPS'		=> array('api', 'admin', 'home', 'weibo'),

	'SYSTEM_CHANNEL'	=> array(1=>'一手房', 2=>'二手房', 3=>'出租房'),
	'PROPERTY_TYPE'		=> array(1=>'住宅', 2=>'经济适用房', 3=>'别墅', 4=>'写字楼', 5=>'商铺', 6=>'自住型商品房', 7=>'综合体', 8=>'商住两用', 9=>'四合院', 10=>'平房'),
	'BUILDING_TYPE'		=> array(1=>'板楼', 2=>'塔楼', 3=>'平房', 4=>'联排', 5=>'叠拼', 6=>'独栋'),
	'DECORATION'        => array(1=>'毛坯', 2=>'简装', 3=>'精装'),
	'TRAFFIC_POSITION'   => array(1=>'二环以内', 2=>'二至三环', 3=>'三至四环', 4=>'四至五环', 5=>'五至六环', 6=>'六环以外'),
	'SEARCH_PRICE'		=> array(1=>'10000元/m²以下', 2=>'10000-15000元/m²', 3=>'15000-20000元/m²', 4=>'20000-30000元/m²', 5=>'30000-40000元/m²', 6=>'40000元/m²以上'),

	'USER_GROUP'		=> array(1=>'管理员', 12=>'二级用户', 23=>'三级用户'),

    // 是否开启URL Rewrite
	'URL_ROUTER_ON'		=> true,    //false,
    
    // 是否开启调试模式 (开启AllInOne模式时该配置无效, 将自动置为false)
	'APP_DEBUG'			=> FALSE,
);

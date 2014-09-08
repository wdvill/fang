DROP TABLE IF EXISTS ts_ad;
CREATE TABLE `ts_ad` (
  `ad_id` int(11) NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `content` text,
  `status` tinyint(1) NOT NULL default '1',
  `recommend` tinyint(1) NOT NULL default '0',
  `ctime` int(11) default NULL,
  `mtime` int(11) default NULL,
  `display_order` smallint(2) NOT NULL default '0',
  PRIMARY KEY  (`ad_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_admin_log;
CREATE TABLE `ts_admin_log` (
  `id` int(11) NOT NULL auto_increment COMMENT '主键ID',
  `uid` int(11) NOT NULL COMMENT '操作人UID',
  `type` tinyint(4) NOT NULL,
  `data` text NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

INSERT INTO ts_admin_log VALUES ('1','1','1','a:2:{i:0;s:22:\"应用 - 安装应用 \";i:1;a:22:{s:9:\"host_type\";i:0;s:12:\"homepage_url\";s:0:\"\";s:23:\"sidebar_support_submenu\";i:0;s:11:\"author_name\";s:6:\"haixia\";s:12:\"author_email\";s:19:\"haixia@thinksns.com\";s:19:\"author_homepage_url\";s:0:\"\";s:16:\"contributor_name\";s:18:\"陈伟川，赵杰\";s:12:\"release_date\";s:10:\"2008-08-08\";s:16:\"last_update_date\";s:9:\"2011-2-12\";s:8:\"app_name\";s:6:\"poster\";s:9:\"app_alias\";s:6:\"招贴\";s:11:\"description\";s:9:\"招贴板\";s:8:\"category\";s:6:\"工具\";s:9:\"app_entry\";s:11:\"Index/index\";s:8:\"icon_url\";s:59:\"http://192.168.243.101/ts/apps/poster/Appinfo/ico_app24.png\";s:14:\"large_icon_url\";s:57:\"http://192.168.243.101/ts/apps/poster/Appinfo/ico_app.png\";s:11:\"admin_entry\";s:11:\"Admin/index\";s:16:\"statistics_entry\";s:27:\"PosterStatistics/statistics\";s:13:\"sidebar_title\";s:0:\"\";s:13:\"sidebar_entry\";s:0:\"\";s:16:\"sidebar_icon_url\";s:0:\"\";s:25:\"sidebar_is_submenu_active\";i:0;}}','1324628463');
INSERT INTO ts_admin_log VALUES ('2','1','1','a:2:{i:0;s:22:\"应用 - 安装应用 \";i:1;a:22:{s:9:\"host_type\";i:0;s:12:\"homepage_url\";s:0:\"\";s:23:\"sidebar_support_submenu\";i:0;s:11:\"author_name\";s:6:\"haixia\";s:12:\"author_email\";s:19:\"haixia@thinksns.com\";s:19:\"author_homepage_url\";s:0:\"\";s:16:\"contributor_name\";s:30:\"陈伟川，赵杰，杨德升\";s:12:\"release_date\";s:10:\"2008-08-08\";s:16:\"last_update_date\";s:10:\"2010-12-22\";s:8:\"app_name\";s:5:\"photo\";s:9:\"app_alias\";s:6:\"相册\";s:11:\"description\";s:12:\"分享图片\";s:8:\"category\";s:6:\"工具\";s:9:\"app_entry\";s:11:\"Index/index\";s:8:\"icon_url\";s:56:\"http://192.168.243.101/ts/apps/photo/Appinfo/ico_app.gif\";s:14:\"large_icon_url\";s:62:\"http://192.168.243.101/ts/apps/photo/Appinfo/ico_app_large.gif\";s:11:\"admin_entry\";s:11:\"Admin/index\";s:16:\"statistics_entry\";s:26:\"PhotoStatistics/statistics\";s:13:\"sidebar_title\";s:6:\"上传\";s:13:\"sidebar_entry\";s:12:\"Upload/flash\";s:16:\"sidebar_icon_url\";s:0:\"\";s:25:\"sidebar_is_submenu_active\";i:0;}}','1324628476');
INSERT INTO ts_admin_log VALUES ('3','1','1','a:2:{i:0;s:22:\"应用 - 安装应用 \";i:1;a:22:{s:9:\"host_type\";i:0;s:12:\"homepage_url\";s:0:\"\";s:23:\"sidebar_support_submenu\";i:0;s:11:\"author_name\";s:9:\"陈伟川\";s:12:\"author_email\";s:0:\"\";s:19:\"author_homepage_url\";s:0:\"\";s:16:\"contributor_name\";s:17:\"赵杰, 杨德升\";s:12:\"release_date\";s:10:\"2008-08-08\";s:16:\"last_update_date\";s:9:\"2010-12-9\";s:8:\"app_name\";s:4:\"vote\";s:9:\"app_alias\";s:6:\"投票\";s:11:\"description\";s:63:\"想分享你的投票给你的好友么，快来发起投票吧\";s:8:\"category\";s:6:\"工具\";s:9:\"app_entry\";s:11:\"Index/index\";s:8:\"icon_url\";s:55:\"http://192.168.243.101/ts/apps/vote/Appinfo/ico_app.gif\";s:14:\"large_icon_url\";s:61:\"http://192.168.243.101/ts/apps/vote/Appinfo/ico_app_large.gif\";s:11:\"admin_entry\";s:11:\"Admin/index\";s:16:\"statistics_entry\";s:25:\"VoteStatistics/statistics\";s:13:\"sidebar_title\";s:6:\"发表\";s:13:\"sidebar_entry\";s:10:\"Index/post\";s:16:\"sidebar_icon_url\";s:0:\"\";s:25:\"sidebar_is_submenu_active\";i:0;}}','1324628481');
INSERT INTO ts_admin_log VALUES ('4','1','1','a:2:{i:0;s:22:\"应用 - 安装应用 \";i:1;a:22:{s:9:\"host_type\";i:0;s:12:\"homepage_url\";s:0:\"\";s:23:\"sidebar_support_submenu\";i:0;s:11:\"author_name\";s:5:\"Satan\";s:12:\"author_email\";s:21:\"wangzuo0714@gmail.com\";s:19:\"author_homepage_url\";s:0:\"\";s:16:\"contributor_name\";s:17:\"杨德升, 赵杰\";s:12:\"release_date\";s:10:\"2008-08-08\";s:16:\"last_update_date\";s:9:\"2010-12-3\";s:8:\"app_name\";s:4:\"blog\";s:9:\"app_alias\";s:6:\"日志\";s:11:\"description\";s:63:\"想分享你的文章给你的好友么，快来记录日志吧\";s:8:\"category\";s:6:\"工具\";s:9:\"app_entry\";s:11:\"Index/index\";s:8:\"icon_url\";s:55:\"http://192.168.243.101/ts/apps/blog/Appinfo/ico_app.gif\";s:14:\"large_icon_url\";s:61:\"http://192.168.243.101/ts/apps/blog/Appinfo/ico_app_large.gif\";s:11:\"admin_entry\";s:11:\"Admin/index\";s:16:\"statistics_entry\";s:25:\"BlogStatistics/statistics\";s:13:\"sidebar_title\";s:6:\"发表\";s:13:\"sidebar_entry\";s:10:\"Index/post\";s:16:\"sidebar_icon_url\";s:0:\"\";s:25:\"sidebar_is_submenu_active\";i:0;}}','1324628486');
INSERT INTO ts_admin_log VALUES ('5','1','1','a:2:{i:0;s:22:\"应用 - 安装应用 \";i:1;a:22:{s:9:\"host_type\";i:0;s:12:\"homepage_url\";s:0:\"\";s:23:\"sidebar_support_submenu\";i:0;s:11:\"author_name\";s:6:\"haixia\";s:12:\"author_email\";s:19:\"haixia@thinksns.com\";s:19:\"author_homepage_url\";s:0:\"\";s:16:\"contributor_name\";s:27:\"陈伟川，赵杰，曹颖\";s:12:\"release_date\";s:10:\"2008-08-08\";s:16:\"last_update_date\";s:10:\"2010-12-22\";s:8:\"app_name\";s:5:\"event\";s:9:\"app_alias\";s:6:\"活动\";s:11:\"description\";s:12:\"发起活动\";s:8:\"category\";s:6:\"工具\";s:9:\"app_entry\";s:11:\"Index/index\";s:8:\"icon_url\";s:58:\"http://192.168.243.101/ts/apps/event/Appinfo/ico_app24.png\";s:14:\"large_icon_url\";s:56:\"http://192.168.243.101/ts/apps/event/Appinfo/ico_app.png\";s:11:\"admin_entry\";s:11:\"Admin/index\";s:16:\"statistics_entry\";s:26:\"EventStatistics/statistics\";s:13:\"sidebar_title\";s:0:\"\";s:13:\"sidebar_entry\";s:0:\"\";s:16:\"sidebar_icon_url\";s:0:\"\";s:25:\"sidebar_is_submenu_active\";i:0;}}','1324628490');
INSERT INTO ts_admin_log VALUES ('6','1','1','a:2:{i:0;s:22:\"应用 - 安装应用 \";i:1;a:22:{s:9:\"host_type\";i:0;s:12:\"homepage_url\";s:0:\"\";s:23:\"sidebar_support_submenu\";i:0;s:11:\"author_name\";s:3:\"sam\";s:12:\"author_email\";s:19:\"haixia@thinksns.com\";s:19:\"author_homepage_url\";s:0:\"\";s:16:\"contributor_name\";s:30:\"赵杰，陈伟川，杨德升\";s:12:\"release_date\";s:10:\"2008-08-08\";s:16:\"last_update_date\";s:10:\"2010-12-22\";s:8:\"app_name\";s:4:\"gift\";s:9:\"app_alias\";s:6:\"礼物\";s:11:\"description\";s:12:\"礼品赠送\";s:8:\"category\";s:6:\"工具\";s:9:\"app_entry\";s:11:\"Index/index\";s:8:\"icon_url\";s:55:\"http://192.168.243.101/ts/apps/gift/Appinfo/ico_app.gif\";s:14:\"large_icon_url\";s:61:\"http://192.168.243.101/ts/apps/gift/Appinfo/ico_app_large.gif\";s:11:\"admin_entry\";s:11:\"Admin/index\";s:16:\"statistics_entry\";s:25:\"GiftStatistics/statistics\";s:13:\"sidebar_title\";s:6:\"赠送\";s:13:\"sidebar_entry\";s:0:\"\";s:16:\"sidebar_icon_url\";s:0:\"\";s:25:\"sidebar_is_submenu_active\";i:0;}}','1324628494');
INSERT INTO ts_admin_log VALUES ('7','1','1','a:2:{i:0;s:22:\"应用 - 安装应用 \";i:1;a:22:{s:9:\"host_type\";i:0;s:12:\"homepage_url\";s:0:\"\";s:23:\"sidebar_support_submenu\";i:0;s:11:\"author_name\";s:6:\"haixia\";s:12:\"author_email\";s:19:\"haixia@thinksns.com\";s:19:\"author_homepage_url\";s:0:\"\";s:16:\"contributor_name\";s:39:\"廖素南，陈伟川，赵杰，申川\";s:12:\"release_date\";s:10:\"2008-08-08\";s:16:\"last_update_date\";s:9:\"2011-2-16\";s:8:\"app_name\";s:5:\"group\";s:9:\"app_alias\";s:6:\"群组\";s:11:\"description\";s:30:\"创建群组，发起话题。\";s:8:\"category\";s:6:\"工具\";s:9:\"app_entry\";s:11:\"Index/index\";s:8:\"icon_url\";s:58:\"http://192.168.243.101/ts/apps/group/Appinfo/ico_app24.png\";s:14:\"large_icon_url\";s:56:\"http://192.168.243.101/ts/apps/group/Appinfo/ico_app.png\";s:11:\"admin_entry\";s:11:\"Admin/index\";s:16:\"statistics_entry\";s:26:\"GroupStatistics/statistics\";s:13:\"sidebar_title\";s:0:\"\";s:13:\"sidebar_entry\";s:0:\"\";s:16:\"sidebar_icon_url\";s:0:\"\";s:25:\"sidebar_is_submenu_active\";i:0;}}','1324628502');
INSERT INTO ts_admin_log VALUES ('8','1','3','a:2:{i:0;s:21:\"应用 - 设置状态\";i:1;a:2:{s:6:\"app_id\";s:1:\"1\";s:6:\"status\";s:1:\"1\";}}','1324628531');
INSERT INTO ts_admin_log VALUES ('9','1','3','a:2:{i:0;s:21:\"应用 - 设置状态\";i:1;a:2:{s:6:\"app_id\";s:1:\"2\";s:6:\"status\";s:1:\"1\";}}','1324628533');
INSERT INTO ts_admin_log VALUES ('10','1','3','a:2:{i:0;s:21:\"应用 - 设置状态\";i:1;a:2:{s:6:\"app_id\";s:1:\"3\";s:6:\"status\";s:1:\"1\";}}','1324628535');
INSERT INTO ts_admin_log VALUES ('11','1','3','a:2:{i:0;s:21:\"应用 - 设置状态\";i:1;a:2:{s:6:\"app_id\";s:1:\"4\";s:6:\"status\";s:1:\"1\";}}','1324628537');
INSERT INTO ts_admin_log VALUES ('12','1','3','a:2:{i:0;s:21:\"应用 - 设置状态\";i:1;a:2:{s:6:\"app_id\";s:1:\"5\";s:6:\"status\";s:1:\"1\";}}','1324628539');
INSERT INTO ts_admin_log VALUES ('13','1','3','a:2:{i:0;s:21:\"应用 - 设置状态\";i:1;a:2:{s:6:\"app_id\";s:1:\"6\";s:6:\"status\";s:1:\"1\";}}','1324628541');
INSERT INTO ts_admin_log VALUES ('14','1','3','a:2:{i:0;s:21:\"应用 - 设置状态\";i:1;a:2:{s:6:\"app_id\";s:1:\"7\";s:6:\"status\";s:1:\"1\";}}','1324628543');
INSERT INTO ts_admin_log VALUES ('15','1','3','a:3:{i:0;s:22:\"全局 - 站点配置 \";i:1;a:18:{s:9:\"site_name\";s:8:\"ThinkSNS\";s:11:\"site_slogan\";s:21:\"社会化动力平台\";s:11:\"site_closed\";i:0;s:11:\"site_verify\";a:1:{i:0;s:8:\"register\";}s:19:\"site_user_domain_on\";s:1:\"1\";s:19:\"site_system_version\";s:12:\"ThinkSNS 2.3\";s:26:\"site_system_version_number\";s:5:\"16095\";s:8:\"__hash__\";s:32:\"f9d2155a200139766ad5aa2e4606504c\";s:10:\"site_theme\";s:8:\"classic2\";s:18:\"site_closed_reason\";s:0:\"\";s:20:\"site_header_keywords\";s:12:\"ThinkSNS|SNS\";s:23:\"site_header_description\";s:19:\"ThinkSNS|SNS|Sociax\";s:8:\"site_icp\";s:57:\"智士软件（北京）有限公司 京ICP备04000001号\";s:14:\"site_anonymous\";s:1:\"1\";s:21:\"site_anonymous_square\";s:1:\"0\";s:21:\"site_anonymous_search\";s:1:\"0\";s:22:\"site_appalias_wordwrap\";s:1:\"1\";s:17:\"site_user_visited\";s:1:\"1\";}i:2;a:15:{s:9:\"site_name\";s:8:\"ThinkSNS\";s:11:\"site_slogan\";s:21:\"社会化动力平台\";s:20:\"site_header_keywords\";s:12:\"ThinkSNS|SNS\";s:23:\"site_header_description\";s:19:\"ThinkSNS|SNS|Sociax\";s:11:\"site_closed\";i:0;s:18:\"site_closed_reason\";s:0:\"\";s:14:\"site_anonymous\";s:1:\"1\";s:21:\"site_anonymous_square\";s:1:\"0\";s:21:\"site_anonymous_search\";s:1:\"0\";s:19:\"site_user_domain_on\";s:1:\"1\";s:17:\"site_user_visited\";s:1:\"1\";s:22:\"site_appalias_wordwrap\";s:1:\"1\";s:8:\"site_icp\";s:57:\"智士软件（北京）有限公司 京ICP备04000001号\";s:10:\"site_theme\";s:7:\"classic\";s:11:\"site_verify\";a:1:{i:0;s:8:\"register\";}}}','1325068790');
INSERT INTO ts_admin_log VALUES ('16','1','3','a:3:{i:0;s:22:\"全局 - 公告配置 \";i:1;a:2:{s:7:\"is_open\";s:1:\"1\";s:7:\"content\";s:20:\"欢迎使用ThinkSNS\";}i:2;a:2:{s:7:\"is_open\";s:1:\"0\";s:7:\"content\";s:20:\"欢迎使用ThinkSNS\";}}','1325143095');
INSERT INTO ts_admin_log VALUES ('17','1','3','a:3:{i:0;s:22:\"全局 - 站点配置 \";i:1;a:18:{s:19:\"site_system_version\";s:12:\"ThinkSNS 2.3\";s:26:\"site_system_version_number\";s:5:\"16095\";s:8:\"__hash__\";s:32:\"f9d2155a200139766ad5aa2e4606504c\";s:9:\"site_name\";s:8:\"ThinkSNS\";s:11:\"site_slogan\";s:21:\"社会化动力平台\";s:20:\"site_header_keywords\";s:12:\"ThinkSNS|SNS\";s:23:\"site_header_description\";s:19:\"ThinkSNS|SNS|Sociax\";s:11:\"site_closed\";i:0;s:18:\"site_closed_reason\";s:0:\"\";s:14:\"site_anonymous\";s:1:\"1\";s:21:\"site_anonymous_square\";s:1:\"0\";s:21:\"site_anonymous_search\";s:1:\"0\";s:19:\"site_user_domain_on\";s:1:\"1\";s:17:\"site_user_visited\";s:1:\"1\";s:22:\"site_appalias_wordwrap\";s:1:\"1\";s:8:\"site_icp\";s:57:\"智士软件（北京）有限公司 京ICP备04000001号\";s:10:\"site_theme\";s:7:\"classic\";s:11:\"site_verify\";a:1:{i:0;s:8:\"register\";}}i:2;a:15:{s:9:\"site_name\";s:24:\"知行网社交平台\";s:11:\"site_slogan\";s:39:\"中国最大的高端商务社交平台\";s:20:\"site_header_keywords\";s:37:\"知行网|高端商务社交平台\";s:23:\"site_header_description\";s:69:\"知行网社交平台，是中国最大的高端商务社交平台\";s:11:\"site_closed\";i:0;s:18:\"site_closed_reason\";s:0:\"\";s:14:\"site_anonymous\";s:1:\"1\";s:21:\"site_anonymous_square\";s:1:\"0\";s:21:\"site_anonymous_search\";s:1:\"0\";s:19:\"site_user_domain_on\";s:1:\"1\";s:17:\"site_user_visited\";s:1:\"1\";s:22:\"site_appalias_wordwrap\";s:1:\"1\";s:8:\"site_icp\";s:30:\"北京知行网有限公司\";s:10:\"site_theme\";s:7:\"classic\";s:11:\"site_verify\";a:1:{i:0;s:8:\"register\";}}}','1325236232');
INSERT INTO ts_admin_log VALUES ('18','1','3','a:3:{i:0;s:22:\"全局 - 公告配置 \";i:1;a:2:{s:7:\"is_open\";i:0;s:7:\"content\";s:20:\"欢迎使用ThinkSNS\";}i:2;a:2:{s:7:\"is_open\";s:1:\"0\";s:7:\"content\";s:36:\"欢迎使用知行网社交平台\";}}','1325237780');
INSERT INTO ts_admin_log VALUES ('19','1','3','a:3:{i:0;s:22:\"全局 - 文章配置 \";i:1;a:0:{}i:2;a:7:{s:11:\"document_id\";i:2;s:5:\"title\";s:12:\"关于我们\";s:9:\"is_active\";i:1;s:12:\"is_on_footer\";i:1;s:7:\"content\";s:119:\"&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; 知行网社交平台是一个高端商务人士的交流社区。&lt;/p&gt;\";s:14:\"last_editor_id\";i:1;s:5:\"mtime\";i:1325237869;}}','1325237869');
INSERT INTO ts_admin_log VALUES ('20','1','3','a:3:{i:0;s:22:\"全局 - 文章配置 \";i:1;a:0:{}i:2;a:7:{s:11:\"document_id\";i:1;s:5:\"title\";s:12:\"官方社区\";s:9:\"is_active\";i:1;s:12:\"is_on_footer\";i:1;s:7:\"content\";s:102:\"&amp;lt;p&amp;gt;&lt;a href=\"http://baidu.com\"&gt;http://baidu.com&amp;lt;/a&amp;gt;&amp;lt;/p&amp;gt;\";s:14:\"last_editor_id\";i:1;s:5:\"mtime\";i:1325237895;}}','1325237895');
INSERT INTO ts_admin_log VALUES ('21','1','3','a:3:{i:0;s:22:\"全局 - 文章配置 \";i:1;a:0:{}i:2;a:7:{s:11:\"document_id\";i:1;s:5:\"title\";s:12:\"官方社区\";s:9:\"is_active\";i:1;s:12:\"is_on_footer\";i:1;s:7:\"content\";s:67:\"&lt;p&gt;官方社区官方社区官方社区官方社区&lt;/p&gt;\";s:14:\"last_editor_id\";i:1;s:5:\"mtime\";i:1325237997;}}','1325237997');
INSERT INTO ts_admin_log VALUES ('22','1','3','a:3:{i:0;s:22:\"全局 - 文章配置 \";i:1;a:0:{}i:2;a:7:{s:11:\"document_id\";i:2;s:5:\"title\";s:12:\"关于我们\";s:9:\"is_active\";i:1;s:12:\"is_on_footer\";i:1;s:7:\"content\";s:88:\"&lt;p&gt;知行网社交平台是一个高端商务人士的交流社区。&lt;/p&gt;\";s:14:\"last_editor_id\";i:1;s:5:\"mtime\";i:1325238023;}}','1325238023');
INSERT INTO ts_admin_log VALUES ('23','1','2','a:3:{i:0;s:22:\"内容 - 附件管理 \";i:1;a:6:{s:5:\"count\";s:1:\"1\";s:10:\"totalPages\";d:1;s:9:\"totalRows\";s:1:\"1\";s:7:\"nowPage\";i:1;s:4:\"html\";s:0:\"\";s:4:\"data\";a:1:{i:0;a:14:{s:2:\"id\";s:2:\"16\";s:11:\"attach_type\";s:10:\"group_logo\";s:6:\"userId\";s:1:\"1\";s:10:\"uploadTime\";s:10:\"1324637521\";s:4:\"name\";s:132:\"33da3dba30a49e1b03cc7826e7a4d9748f8d58c300bd4faf14f08b946be0a7957df7274fa32610d93e41e5a1a517d7287d5e79d1b87c5eda9a36cc25ef48f821.jpg\";s:4:\"type\";s:10:\"image/jpeg\";s:4:\"size\";s:6:\"125424\";s:9:\"extension\";s:3:\"jpg\";s:4:\"hash\";s:32:\"df26539521bd2c0a9f552cc1f179ac2a\";s:7:\"private\";s:1:\"0\";s:5:\"isDel\";s:1:\"0\";s:8:\"savepath\";s:13:\"2011/1223/18/\";s:8:\"savename\";s:17:\"4ef45d5189dae.jpg\";s:10:\"savedomain\";s:1:\"0\";}}}i:2;a:1:{s:6:\"isFile\";i:0;}}','1325238300');

DROP TABLE IF EXISTS ts_app;
CREATE TABLE `ts_app` (
  `app_id` int(11) NOT NULL auto_increment,
  `app_name` varchar(255) NOT NULL,
  `app_alias` varchar(255) NOT NULL,
  `description` text,
  `version` varchar(255) default NULL,
  `status` tinyint(1) NOT NULL default '1' COMMENT '0:关闭 1:默认 2:可选',
  `category` varchar(255) default NULL,
  `release_date` varchar(255) default NULL,
  `last_update_date` varchar(255) default NULL,
  `host_type` tinyint(1) NOT NULL default '0' COMMENT '0：本地应用 1：远程应用',
  `app_entry` varchar(255) default NULL,
  `icon_url` varchar(255) default NULL,
  `large_icon_url` varchar(255) default NULL,
  `admin_entry` varchar(255) default NULL,
  `statistics_entry` varchar(255) default NULL,
  `homepage_url` varchar(255) default NULL,
  `sidebar_title` varchar(255) default NULL,
  `sidebar_entry` varchar(255) default NULL,
  `sidebar_icon_url` varchar(255) default NULL,
  `sidebar_support_submenu` tinyint(1) NOT NULL default '0',
  `sidebar_is_submenu_active` tinyint(1) NOT NULL default '0',
  `author_name` varchar(255) default NULL,
  `author_email` varchar(255) default NULL,
  `author_homepage_url` varchar(255) default NULL,
  `contributor_name` text,
  `display_order` smallint(5) NOT NULL default '0',
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`app_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO ts_app VALUES ('1','poster','招贴','招贴板','','1','工具','2008-08-08','2011-2-12','0','Index/index','http://192.168.243.101/ts/apps/poster/Appinfo/ico_app24.png','http://192.168.243.101/ts/apps/poster/Appinfo/ico_app.png','Admin/index','PosterStatistics/statistics','','','','','0','0','haixia','haixia@thinksns.com','','陈伟川，赵杰','1','1324628463');
INSERT INTO ts_app VALUES ('2','photo','相册','分享图片','','1','工具','2008-08-08','2010-12-22','0','Index/index','http://192.168.243.101/ts/apps/photo/Appinfo/ico_app.gif','http://192.168.243.101/ts/apps/photo/Appinfo/ico_app_large.gif','Admin/index','PhotoStatistics/statistics','','上传','Upload/flash','','0','0','haixia','haixia@thinksns.com','','陈伟川，赵杰，杨德升','2','1324628476');
INSERT INTO ts_app VALUES ('3','vote','投票','想分享你的投票给你的好友么，快来发起投票吧','','1','工具','2008-08-08','2010-12-9','0','Index/index','http://192.168.243.101/ts/apps/vote/Appinfo/ico_app.gif','http://192.168.243.101/ts/apps/vote/Appinfo/ico_app_large.gif','Admin/index','VoteStatistics/statistics','','发表','Index/post','','0','0','陈伟川','','','赵杰, 杨德升','3','1324628481');
INSERT INTO ts_app VALUES ('4','blog','日志','想分享你的文章给你的好友么，快来记录日志吧','','1','工具','2008-08-08','2010-12-3','0','Index/index','http://192.168.243.101/ts/apps/blog/Appinfo/ico_app.gif','http://192.168.243.101/ts/apps/blog/Appinfo/ico_app_large.gif','Admin/index','BlogStatistics/statistics','','发表','Index/post','','0','0','Satan','wangzuo0714@gmail.com','','杨德升, 赵杰','4','1324628486');
INSERT INTO ts_app VALUES ('5','event','活动','发起活动','','1','工具','2008-08-08','2010-12-22','0','Index/index','http://192.168.243.101/ts/apps/event/Appinfo/ico_app24.png','http://192.168.243.101/ts/apps/event/Appinfo/ico_app.png','Admin/index','EventStatistics/statistics','','','','','0','0','haixia','haixia@thinksns.com','','陈伟川，赵杰，曹颖','5','1324628490');
INSERT INTO ts_app VALUES ('6','gift','礼物','礼品赠送','','1','工具','2008-08-08','2010-12-22','0','Index/index','http://192.168.243.101/ts/apps/gift/Appinfo/ico_app.gif','http://192.168.243.101/ts/apps/gift/Appinfo/ico_app_large.gif','Admin/index','GiftStatistics/statistics','','赠送','','','0','0','sam','haixia@thinksns.com','','赵杰，陈伟川，杨德升','6','1324628494');
INSERT INTO ts_app VALUES ('7','group','群组','创建群组，发起话题。','','1','工具','2008-08-08','2011-2-16','0','Index/index','http://192.168.243.101/ts/apps/group/Appinfo/ico_app24.png','http://192.168.243.101/ts/apps/group/Appinfo/ico_app.png','Admin/index','GroupStatistics/statistics','','','','','0','0','haixia','haixia@thinksns.com','','廖素南，陈伟川，赵杰，申川','7','1324628502');

DROP TABLE IF EXISTS ts_area;
CREATE TABLE `ts_area` (
  `area_id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`area_id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=3235 DEFAULT CHARSET=utf8;

INSERT INTO ts_area VALUES ('1','北京','0');
INSERT INTO ts_area VALUES ('2','北京市','1');
INSERT INTO ts_area VALUES ('3','东城区','2');
INSERT INTO ts_area VALUES ('4','西城区','2');
INSERT INTO ts_area VALUES ('5','崇文区','2');
INSERT INTO ts_area VALUES ('6','宣武区','2');
INSERT INTO ts_area VALUES ('7','朝阳区','2');
INSERT INTO ts_area VALUES ('8','丰台区','2');
INSERT INTO ts_area VALUES ('9','石景山区','2');
INSERT INTO ts_area VALUES ('10','海淀区','2');
INSERT INTO ts_area VALUES ('11','门头沟区','2');
INSERT INTO ts_area VALUES ('12','房山区','2');
INSERT INTO ts_area VALUES ('13','通州区','2');
INSERT INTO ts_area VALUES ('14','顺义区','2');
INSERT INTO ts_area VALUES ('15','昌平区','2');
INSERT INTO ts_area VALUES ('16','大兴区','2');
INSERT INTO ts_area VALUES ('17','怀柔区','2');
INSERT INTO ts_area VALUES ('18','平谷区','2');
INSERT INTO ts_area VALUES ('19','密云县','2');
INSERT INTO ts_area VALUES ('20','延庆县','2');
INSERT INTO ts_area VALUES ('21','天津','0');
INSERT INTO ts_area VALUES ('22','天津市','21');
INSERT INTO ts_area VALUES ('23','和平区','22');
INSERT INTO ts_area VALUES ('24','河东区','22');
INSERT INTO ts_area VALUES ('25','河西区','22');
INSERT INTO ts_area VALUES ('26','南开区','22');
INSERT INTO ts_area VALUES ('27','河北区','22');
INSERT INTO ts_area VALUES ('28','红桥区','22');
INSERT INTO ts_area VALUES ('29','塘沽区','22');
INSERT INTO ts_area VALUES ('30','汉沽区','22');
INSERT INTO ts_area VALUES ('31','大港区','22');
INSERT INTO ts_area VALUES ('32','东丽区','22');
INSERT INTO ts_area VALUES ('33','西青区','22');
INSERT INTO ts_area VALUES ('34','津南区','22');
INSERT INTO ts_area VALUES ('35','北辰区','22');
INSERT INTO ts_area VALUES ('36','武清区','22');
INSERT INTO ts_area VALUES ('37','宝坻区','22');
INSERT INTO ts_area VALUES ('38','宁河县','22');
INSERT INTO ts_area VALUES ('39','静海县','22');
INSERT INTO ts_area VALUES ('40','蓟县','22');
INSERT INTO ts_area VALUES ('41','河北','0');
INSERT INTO ts_area VALUES ('42','石家庄市','41');
INSERT INTO ts_area VALUES ('43','长安区','42');
INSERT INTO ts_area VALUES ('44','桥东区','42');
INSERT INTO ts_area VALUES ('45','桥西区','42');
INSERT INTO ts_area VALUES ('46','新华区','42');
INSERT INTO ts_area VALUES ('47','井陉矿区','42');
INSERT INTO ts_area VALUES ('48','裕华区','42');
INSERT INTO ts_area VALUES ('49','井陉县','42');
INSERT INTO ts_area VALUES ('50','正定县','42');
INSERT INTO ts_area VALUES ('51','栾城县','42');
INSERT INTO ts_area VALUES ('52','行唐县','42');
INSERT INTO ts_area VALUES ('53','灵寿县','42');
INSERT INTO ts_area VALUES ('54','高邑县','42');
INSERT INTO ts_area VALUES ('55','深泽县','42');
INSERT INTO ts_area VALUES ('56','赞皇县','42');
INSERT INTO ts_area VALUES ('57','无极县','42');
INSERT INTO ts_area VALUES ('58','平山县','42');
INSERT INTO ts_area VALUES ('59','元氏县','42');
INSERT INTO ts_area VALUES ('60','赵县','42');
INSERT INTO ts_area VALUES ('61','辛集市','42');
INSERT INTO ts_area VALUES ('62','藁城市','42');
INSERT INTO ts_area VALUES ('63','晋州市','42');
INSERT INTO ts_area VALUES ('64','新乐市','42');
INSERT INTO ts_area VALUES ('65','鹿泉市','42');
INSERT INTO ts_area VALUES ('66','唐山市','41');
INSERT INTO ts_area VALUES ('67','路南区','66');
INSERT INTO ts_area VALUES ('68','路北区','66');
INSERT INTO ts_area VALUES ('69','古冶区','66');
INSERT INTO ts_area VALUES ('70','开平区','66');
INSERT INTO ts_area VALUES ('71','丰南区','66');
INSERT INTO ts_area VALUES ('72','丰润区','66');
INSERT INTO ts_area VALUES ('73','滦县','66');
INSERT INTO ts_area VALUES ('74','滦南县','66');
INSERT INTO ts_area VALUES ('75','乐亭县','66');
INSERT INTO ts_area VALUES ('76','迁西县','66');
INSERT INTO ts_area VALUES ('77','玉田县','66');
INSERT INTO ts_area VALUES ('78','唐海县','66');
INSERT INTO ts_area VALUES ('79','遵化市','66');
INSERT INTO ts_area VALUES ('80','迁安市','66');
INSERT INTO ts_area VALUES ('81','秦皇岛市','41');
INSERT INTO ts_area VALUES ('82','海港区','81');
INSERT INTO ts_area VALUES ('83','山海关区','81');
INSERT INTO ts_area VALUES ('84','北戴河区','81');
INSERT INTO ts_area VALUES ('85','青龙满族自治县','81');
INSERT INTO ts_area VALUES ('86','昌黎县','81');
INSERT INTO ts_area VALUES ('87','抚宁县','81');
INSERT INTO ts_area VALUES ('88','卢龙县','81');
INSERT INTO ts_area VALUES ('89','邯郸市','41');
INSERT INTO ts_area VALUES ('90','邯山区','89');
INSERT INTO ts_area VALUES ('91','丛台区','89');
INSERT INTO ts_area VALUES ('92','复兴区','89');
INSERT INTO ts_area VALUES ('93','峰峰矿区','89');
INSERT INTO ts_area VALUES ('94','邯郸县','89');
INSERT INTO ts_area VALUES ('95','临漳县','89');
INSERT INTO ts_area VALUES ('96','成安县','89');
INSERT INTO ts_area VALUES ('97','大名县','89');
INSERT INTO ts_area VALUES ('98','涉县','89');
INSERT INTO ts_area VALUES ('99','磁县','89');
INSERT INTO ts_area VALUES ('100','肥乡县','89');
INSERT INTO ts_area VALUES ('101','永年县','89');
INSERT INTO ts_area VALUES ('102','邱县','89');
INSERT INTO ts_area VALUES ('103','鸡泽县','89');
INSERT INTO ts_area VALUES ('104','广平县','89');
INSERT INTO ts_area VALUES ('105','馆陶县','89');
INSERT INTO ts_area VALUES ('106','魏县','89');
INSERT INTO ts_area VALUES ('107','曲周县','89');
INSERT INTO ts_area VALUES ('108','武安市','89');
INSERT INTO ts_area VALUES ('109','邢台市','41');
INSERT INTO ts_area VALUES ('110','桥东区','109');
INSERT INTO ts_area VALUES ('111','桥西区','109');
INSERT INTO ts_area VALUES ('112','邢台县','109');
INSERT INTO ts_area VALUES ('113','临城县','109');
INSERT INTO ts_area VALUES ('114','内丘县','109');
INSERT INTO ts_area VALUES ('115','柏乡县','109');
INSERT INTO ts_area VALUES ('116','隆尧县','109');
INSERT INTO ts_area VALUES ('117','任县','109');
INSERT INTO ts_area VALUES ('118','南和县','109');
INSERT INTO ts_area VALUES ('119','宁晋县','109');
INSERT INTO ts_area VALUES ('120','巨鹿县','109');
INSERT INTO ts_area VALUES ('121','新河县','109');
INSERT INTO ts_area VALUES ('122','广宗县','109');
INSERT INTO ts_area VALUES ('123','平乡县','109');
INSERT INTO ts_area VALUES ('124','威县','109');
INSERT INTO ts_area VALUES ('125','清河县','109');
INSERT INTO ts_area VALUES ('126','临西县','109');
INSERT INTO ts_area VALUES ('127','南宫市','109');
INSERT INTO ts_area VALUES ('128','沙河市','109');
INSERT INTO ts_area VALUES ('129','保定市','41');
INSERT INTO ts_area VALUES ('130','新市区','129');
INSERT INTO ts_area VALUES ('131','北市区','129');
INSERT INTO ts_area VALUES ('132','南市区','129');
INSERT INTO ts_area VALUES ('133','满城县','129');
INSERT INTO ts_area VALUES ('134','清苑县','129');
INSERT INTO ts_area VALUES ('135','涞水县','129');
INSERT INTO ts_area VALUES ('136','阜平县','129');
INSERT INTO ts_area VALUES ('137','徐水县','129');
INSERT INTO ts_area VALUES ('138','定兴县','129');
INSERT INTO ts_area VALUES ('139','唐县','129');
INSERT INTO ts_area VALUES ('140','高阳县','129');
INSERT INTO ts_area VALUES ('141','容城县','129');
INSERT INTO ts_area VALUES ('142','涞源县','129');
INSERT INTO ts_area VALUES ('143','望都县','129');
INSERT INTO ts_area VALUES ('144','安新县','129');
INSERT INTO ts_area VALUES ('145','易县','129');
INSERT INTO ts_area VALUES ('146','曲阳县','129');
INSERT INTO ts_area VALUES ('147','蠡县','129');
INSERT INTO ts_area VALUES ('148','顺平县','129');
INSERT INTO ts_area VALUES ('149','博野县','129');
INSERT INTO ts_area VALUES ('150','雄县','129');
INSERT INTO ts_area VALUES ('151','涿州市','129');
INSERT INTO ts_area VALUES ('152','定州市','129');
INSERT INTO ts_area VALUES ('153','安国市','129');
INSERT INTO ts_area VALUES ('154','高碑店市','129');
INSERT INTO ts_area VALUES ('155','张家口市','41');
INSERT INTO ts_area VALUES ('156','桥东区','155');
INSERT INTO ts_area VALUES ('157','桥西区','155');
INSERT INTO ts_area VALUES ('158','宣化区','155');
INSERT INTO ts_area VALUES ('159','下花园区','155');
INSERT INTO ts_area VALUES ('160','宣化县','155');
INSERT INTO ts_area VALUES ('161','张北县','155');
INSERT INTO ts_area VALUES ('162','康保县','155');
INSERT INTO ts_area VALUES ('163','沽源县','155');
INSERT INTO ts_area VALUES ('164','尚义县','155');
INSERT INTO ts_area VALUES ('165','蔚县','155');
INSERT INTO ts_area VALUES ('166','阳原县','155');
INSERT INTO ts_area VALUES ('167','怀安县','155');
INSERT INTO ts_area VALUES ('168','万全县','155');
INSERT INTO ts_area VALUES ('169','怀来县','155');
INSERT INTO ts_area VALUES ('170','涿鹿县','155');
INSERT INTO ts_area VALUES ('171','赤城县','155');
INSERT INTO ts_area VALUES ('172','崇礼县','155');
INSERT INTO ts_area VALUES ('173','承德市','41');
INSERT INTO ts_area VALUES ('174','双桥区','173');
INSERT INTO ts_area VALUES ('175','双滦区','173');
INSERT INTO ts_area VALUES ('176','鹰手营子矿区','173');
INSERT INTO ts_area VALUES ('177','承德县','173');
INSERT INTO ts_area VALUES ('178','兴隆县','173');
INSERT INTO ts_area VALUES ('179','平泉县','173');
INSERT INTO ts_area VALUES ('180','滦平县','173');
INSERT INTO ts_area VALUES ('181','隆化县','173');
INSERT INTO ts_area VALUES ('182','丰宁满族自治县','173');
INSERT INTO ts_area VALUES ('183','宽城满族自治县','173');
INSERT INTO ts_area VALUES ('184','围场满族蒙古族自治县','173');
INSERT INTO ts_area VALUES ('185','沧州市','41');
INSERT INTO ts_area VALUES ('186','新华区','185');
INSERT INTO ts_area VALUES ('187','运河区','185');
INSERT INTO ts_area VALUES ('188','沧县','185');
INSERT INTO ts_area VALUES ('189','青县','185');
INSERT INTO ts_area VALUES ('190','东光县','185');
INSERT INTO ts_area VALUES ('191','海兴县','185');
INSERT INTO ts_area VALUES ('192','盐山县','185');
INSERT INTO ts_area VALUES ('193','肃宁县','185');
INSERT INTO ts_area VALUES ('194','南皮县','185');
INSERT INTO ts_area VALUES ('195','吴桥县','185');
INSERT INTO ts_area VALUES ('196','献县','185');
INSERT INTO ts_area VALUES ('197','孟村回族自治县','185');
INSERT INTO ts_area VALUES ('198','泊头市','185');
INSERT INTO ts_area VALUES ('199','任丘市','185');
INSERT INTO ts_area VALUES ('200','黄骅市','185');
INSERT INTO ts_area VALUES ('201','河间市','185');
INSERT INTO ts_area VALUES ('202','廊坊市','41');
INSERT INTO ts_area VALUES ('203','安次区','202');
INSERT INTO ts_area VALUES ('204','广阳区','202');
INSERT INTO ts_area VALUES ('205','固安县','202');
INSERT INTO ts_area VALUES ('206','永清县','202');
INSERT INTO ts_area VALUES ('207','香河县','202');
INSERT INTO ts_area VALUES ('208','大城县','202');
INSERT INTO ts_area VALUES ('209','文安县','202');
INSERT INTO ts_area VALUES ('210','大厂回族自治县','202');
INSERT INTO ts_area VALUES ('211','霸州市','202');
INSERT INTO ts_area VALUES ('212','三河市','202');
INSERT INTO ts_area VALUES ('213','衡水市','41');
INSERT INTO ts_area VALUES ('214','桃城区','213');
INSERT INTO ts_area VALUES ('215','枣强县','213');
INSERT INTO ts_area VALUES ('216','武邑县','213');
INSERT INTO ts_area VALUES ('217','武强县','213');
INSERT INTO ts_area VALUES ('218','饶阳县','213');
INSERT INTO ts_area VALUES ('219','安平县','213');
INSERT INTO ts_area VALUES ('220','故城县','213');
INSERT INTO ts_area VALUES ('221','景县','213');
INSERT INTO ts_area VALUES ('222','阜城县','213');
INSERT INTO ts_area VALUES ('223','冀州市','213');
INSERT INTO ts_area VALUES ('224','深州市','213');
INSERT INTO ts_area VALUES ('225','山西','0');
INSERT INTO ts_area VALUES ('226','太原市','225');
INSERT INTO ts_area VALUES ('227','小店区','226');
INSERT INTO ts_area VALUES ('228','迎泽区','226');
INSERT INTO ts_area VALUES ('229','杏花岭区','226');
INSERT INTO ts_area VALUES ('230','尖草坪区','226');
INSERT INTO ts_area VALUES ('231','万柏林区','226');
INSERT INTO ts_area VALUES ('232','晋源区','226');
INSERT INTO ts_area VALUES ('233','清徐县','226');
INSERT INTO ts_area VALUES ('234','阳曲县','226');
INSERT INTO ts_area VALUES ('235','娄烦县','226');
INSERT INTO ts_area VALUES ('236','古交市','226');
INSERT INTO ts_area VALUES ('237','大同市','225');
INSERT INTO ts_area VALUES ('238','城区','237');
INSERT INTO ts_area VALUES ('239','矿区','237');
INSERT INTO ts_area VALUES ('240','南郊区','237');
INSERT INTO ts_area VALUES ('241','新荣区','237');
INSERT INTO ts_area VALUES ('242','阳高县','237');
INSERT INTO ts_area VALUES ('243','天镇县','237');
INSERT INTO ts_area VALUES ('244','广灵县','237');
INSERT INTO ts_area VALUES ('245','灵丘县','237');
INSERT INTO ts_area VALUES ('246','浑源县','237');
INSERT INTO ts_area VALUES ('247','左云县','237');
INSERT INTO ts_area VALUES ('248','大同县','237');
INSERT INTO ts_area VALUES ('249','阳泉市','225');
INSERT INTO ts_area VALUES ('250','城区','249');
INSERT INTO ts_area VALUES ('251','矿区','249');
INSERT INTO ts_area VALUES ('252','郊区','249');
INSERT INTO ts_area VALUES ('253','平定县','249');
INSERT INTO ts_area VALUES ('254','盂县','249');
INSERT INTO ts_area VALUES ('255','长治市','225');
INSERT INTO ts_area VALUES ('256','城区','255');
INSERT INTO ts_area VALUES ('257','郊区','255');
INSERT INTO ts_area VALUES ('258','长治县','255');
INSERT INTO ts_area VALUES ('259','襄垣县','255');
INSERT INTO ts_area VALUES ('260','屯留县','255');
INSERT INTO ts_area VALUES ('261','平顺县','255');
INSERT INTO ts_area VALUES ('262','黎城县','255');
INSERT INTO ts_area VALUES ('263','壶关县','255');
INSERT INTO ts_area VALUES ('264','长子县','255');
INSERT INTO ts_area VALUES ('265','武乡县','255');
INSERT INTO ts_area VALUES ('266','沁县','255');
INSERT INTO ts_area VALUES ('267','沁源县','255');
INSERT INTO ts_area VALUES ('268','潞城市','255');
INSERT INTO ts_area VALUES ('269','晋城市','225');
INSERT INTO ts_area VALUES ('270','城区','269');
INSERT INTO ts_area VALUES ('271','沁水县','269');
INSERT INTO ts_area VALUES ('272','阳城县','269');
INSERT INTO ts_area VALUES ('273','陵川县','269');
INSERT INTO ts_area VALUES ('274','泽州县','269');
INSERT INTO ts_area VALUES ('275','高平市','269');
INSERT INTO ts_area VALUES ('276','朔州市','225');
INSERT INTO ts_area VALUES ('277','朔城区','276');
INSERT INTO ts_area VALUES ('278','平鲁区','276');
INSERT INTO ts_area VALUES ('279','山阴县','276');
INSERT INTO ts_area VALUES ('280','应县','276');
INSERT INTO ts_area VALUES ('281','右玉县','276');
INSERT INTO ts_area VALUES ('282','怀仁县','276');
INSERT INTO ts_area VALUES ('283','晋中市','225');
INSERT INTO ts_area VALUES ('284','榆次区','283');
INSERT INTO ts_area VALUES ('285','榆社县','283');
INSERT INTO ts_area VALUES ('286','左权县','283');
INSERT INTO ts_area VALUES ('287','和顺县','283');
INSERT INTO ts_area VALUES ('288','昔阳县','283');
INSERT INTO ts_area VALUES ('289','寿阳县','283');
INSERT INTO ts_area VALUES ('290','太谷县','283');
INSERT INTO ts_area VALUES ('291','祁县','283');
INSERT INTO ts_area VALUES ('292','平遥县','283');
INSERT INTO ts_area VALUES ('293','灵石县','283');
INSERT INTO ts_area VALUES ('294','介休市','283');
INSERT INTO ts_area VALUES ('295','运城市','225');
INSERT INTO ts_area VALUES ('296','盐湖区','295');
INSERT INTO ts_area VALUES ('297','临猗县','295');
INSERT INTO ts_area VALUES ('298','万荣县','295');
INSERT INTO ts_area VALUES ('299','闻喜县','295');
INSERT INTO ts_area VALUES ('300','稷山县','295');
INSERT INTO ts_area VALUES ('301','新绛县','295');
INSERT INTO ts_area VALUES ('302','绛县','295');
INSERT INTO ts_area VALUES ('303','垣曲县','295');
INSERT INTO ts_area VALUES ('304','夏县','295');
INSERT INTO ts_area VALUES ('305','平陆县','295');
INSERT INTO ts_area VALUES ('306','芮城县','295');
INSERT INTO ts_area VALUES ('307','永济市','295');
INSERT INTO ts_area VALUES ('308','河津市','295');
INSERT INTO ts_area VALUES ('309','忻州市','225');
INSERT INTO ts_area VALUES ('310','忻府区','309');
INSERT INTO ts_area VALUES ('311','定襄县','309');
INSERT INTO ts_area VALUES ('312','五台县','309');
INSERT INTO ts_area VALUES ('313','代县','309');
INSERT INTO ts_area VALUES ('314','繁峙县','309');
INSERT INTO ts_area VALUES ('315','宁武县','309');
INSERT INTO ts_area VALUES ('316','静乐县','309');
INSERT INTO ts_area VALUES ('317','神池县','309');
INSERT INTO ts_area VALUES ('318','五寨县','309');
INSERT INTO ts_area VALUES ('319','岢岚县','309');
INSERT INTO ts_area VALUES ('320','河曲县','309');
INSERT INTO ts_area VALUES ('321','保德县','309');
INSERT INTO ts_area VALUES ('322','偏关县','309');
INSERT INTO ts_area VALUES ('323','原平市','309');
INSERT INTO ts_area VALUES ('324','临汾市','225');
INSERT INTO ts_area VALUES ('325','尧都区','324');
INSERT INTO ts_area VALUES ('326','曲沃县','324');
INSERT INTO ts_area VALUES ('327','翼城县','324');
INSERT INTO ts_area VALUES ('328','襄汾县','324');
INSERT INTO ts_area VALUES ('329','洪洞县','324');
INSERT INTO ts_area VALUES ('330','古县','324');
INSERT INTO ts_area VALUES ('331','安泽县','324');
INSERT INTO ts_area VALUES ('332','浮山县','324');
INSERT INTO ts_area VALUES ('333','吉县','324');
INSERT INTO ts_area VALUES ('334','乡宁县','324');
INSERT INTO ts_area VALUES ('335','大宁县','324');
INSERT INTO ts_area VALUES ('336','隰县','324');
INSERT INTO ts_area VALUES ('337','永和县','324');
INSERT INTO ts_area VALUES ('338','蒲县','324');
INSERT INTO ts_area VALUES ('339','汾西县','324');
INSERT INTO ts_area VALUES ('340','侯马市','324');
INSERT INTO ts_area VALUES ('341','霍州市','324');
INSERT INTO ts_area VALUES ('342','吕梁市','225');
INSERT INTO ts_area VALUES ('343','离石区','342');
INSERT INTO ts_area VALUES ('344','文水县','342');
INSERT INTO ts_area VALUES ('345','交城县','342');
INSERT INTO ts_area VALUES ('346','兴县','342');
INSERT INTO ts_area VALUES ('347','临县','342');
INSERT INTO ts_area VALUES ('348','柳林县','342');
INSERT INTO ts_area VALUES ('349','石楼县','342');
INSERT INTO ts_area VALUES ('350','岚县','342');
INSERT INTO ts_area VALUES ('351','方山县','342');
INSERT INTO ts_area VALUES ('352','中阳县','342');
INSERT INTO ts_area VALUES ('353','交口县','342');
INSERT INTO ts_area VALUES ('354','孝义市','342');
INSERT INTO ts_area VALUES ('355','汾阳市','342');
INSERT INTO ts_area VALUES ('356','内蒙古','0');
INSERT INTO ts_area VALUES ('357','呼和浩特市','356');
INSERT INTO ts_area VALUES ('358','新城区','357');
INSERT INTO ts_area VALUES ('359','回民区','357');
INSERT INTO ts_area VALUES ('360','玉泉区','357');
INSERT INTO ts_area VALUES ('361','赛罕区','357');
INSERT INTO ts_area VALUES ('362','土默特左旗','357');
INSERT INTO ts_area VALUES ('363','托克托县','357');
INSERT INTO ts_area VALUES ('364','和林格尔县','357');
INSERT INTO ts_area VALUES ('365','清水河县','357');
INSERT INTO ts_area VALUES ('366','武川县','357');
INSERT INTO ts_area VALUES ('367','包头市','356');
INSERT INTO ts_area VALUES ('368','东河区','367');
INSERT INTO ts_area VALUES ('369','昆都仑区','367');
INSERT INTO ts_area VALUES ('370','青山区','367');
INSERT INTO ts_area VALUES ('371','石拐区','367');
INSERT INTO ts_area VALUES ('372','白云矿区','367');
INSERT INTO ts_area VALUES ('373','九原区','367');
INSERT INTO ts_area VALUES ('374','土默特右旗','367');
INSERT INTO ts_area VALUES ('375','固阳县','367');
INSERT INTO ts_area VALUES ('376','达尔罕茂明安联合旗','367');
INSERT INTO ts_area VALUES ('377','乌海市','356');
INSERT INTO ts_area VALUES ('378','海勃湾区','377');
INSERT INTO ts_area VALUES ('379','海南区','377');
INSERT INTO ts_area VALUES ('380','乌达区','377');
INSERT INTO ts_area VALUES ('381','赤峰市','356');
INSERT INTO ts_area VALUES ('382','红山区','381');
INSERT INTO ts_area VALUES ('383','元宝山区','381');
INSERT INTO ts_area VALUES ('384','松山区','381');
INSERT INTO ts_area VALUES ('385','阿鲁科尔沁旗','381');
INSERT INTO ts_area VALUES ('386','巴林左旗','381');
INSERT INTO ts_area VALUES ('387','巴林右旗','381');
INSERT INTO ts_area VALUES ('388','林西县','381');
INSERT INTO ts_area VALUES ('389','克什克腾旗','381');
INSERT INTO ts_area VALUES ('390','翁牛特旗','381');
INSERT INTO ts_area VALUES ('391','喀喇沁旗','381');
INSERT INTO ts_area VALUES ('392','宁城县','381');
INSERT INTO ts_area VALUES ('393','敖汉旗','381');
INSERT INTO ts_area VALUES ('394','通辽市','356');
INSERT INTO ts_area VALUES ('395','科尔沁区','394');
INSERT INTO ts_area VALUES ('396','科尔沁左翼中旗','394');
INSERT INTO ts_area VALUES ('397','科尔沁左翼后旗','394');
INSERT INTO ts_area VALUES ('398','开鲁县','394');
INSERT INTO ts_area VALUES ('399','库伦旗','394');
INSERT INTO ts_area VALUES ('400','奈曼旗','394');
INSERT INTO ts_area VALUES ('401','扎鲁特旗','394');
INSERT INTO ts_area VALUES ('402','霍林郭勒市','394');
INSERT INTO ts_area VALUES ('403','鄂尔多斯市','356');
INSERT INTO ts_area VALUES ('404','市辖区','403');
INSERT INTO ts_area VALUES ('405','  东胜区','403');
INSERT INTO ts_area VALUES ('406','达拉特旗','403');
INSERT INTO ts_area VALUES ('407','准格尔旗','403');
INSERT INTO ts_area VALUES ('408','鄂托克前旗','403');
INSERT INTO ts_area VALUES ('409','鄂托克旗','403');
INSERT INTO ts_area VALUES ('410','杭锦旗','403');
INSERT INTO ts_area VALUES ('411','乌审旗','403');
INSERT INTO ts_area VALUES ('412','伊金霍洛旗','403');
INSERT INTO ts_area VALUES ('413','呼伦贝尔市','356');
INSERT INTO ts_area VALUES ('414','海拉尔区','413');
INSERT INTO ts_area VALUES ('415','阿荣旗','413');
INSERT INTO ts_area VALUES ('416','莫力达瓦达斡尔族自治旗','413');
INSERT INTO ts_area VALUES ('417','鄂伦春自治旗','413');
INSERT INTO ts_area VALUES ('418','鄂温克族自治旗','413');
INSERT INTO ts_area VALUES ('419','陈巴尔虎旗','413');
INSERT INTO ts_area VALUES ('420','新巴尔虎左旗','413');
INSERT INTO ts_area VALUES ('421','新巴尔虎右旗','413');
INSERT INTO ts_area VALUES ('422','满洲里市','413');
INSERT INTO ts_area VALUES ('423','牙克石市','413');
INSERT INTO ts_area VALUES ('424','扎兰屯市','413');
INSERT INTO ts_area VALUES ('425','额尔古纳市','413');
INSERT INTO ts_area VALUES ('426','根河市','413');
INSERT INTO ts_area VALUES ('427','巴彦淖尔市','356');
INSERT INTO ts_area VALUES ('428','临河区','427');
INSERT INTO ts_area VALUES ('429','五原县','427');
INSERT INTO ts_area VALUES ('430','磴口县','427');
INSERT INTO ts_area VALUES ('431','乌拉特前旗','427');
INSERT INTO ts_area VALUES ('432','乌拉特中旗','427');
INSERT INTO ts_area VALUES ('433','乌拉特后旗','427');
INSERT INTO ts_area VALUES ('434','杭锦后旗','427');
INSERT INTO ts_area VALUES ('435','乌兰察布市','356');
INSERT INTO ts_area VALUES ('436','集宁区','435');
INSERT INTO ts_area VALUES ('437','卓资县','435');
INSERT INTO ts_area VALUES ('438','化德县','435');
INSERT INTO ts_area VALUES ('439','商都县','435');
INSERT INTO ts_area VALUES ('440','兴和县','435');
INSERT INTO ts_area VALUES ('441','凉城县','435');
INSERT INTO ts_area VALUES ('442','察哈尔右翼前旗','435');
INSERT INTO ts_area VALUES ('443','察哈尔右翼中旗','435');
INSERT INTO ts_area VALUES ('444','察哈尔右翼后旗','435');
INSERT INTO ts_area VALUES ('445','四子王旗','435');
INSERT INTO ts_area VALUES ('446','丰镇市','435');
INSERT INTO ts_area VALUES ('447','兴安盟','356');
INSERT INTO ts_area VALUES ('448','乌兰浩特市','447');
INSERT INTO ts_area VALUES ('449','阿尔山市','447');
INSERT INTO ts_area VALUES ('450','科尔沁右翼前旗','447');
INSERT INTO ts_area VALUES ('451','科尔沁右翼中旗','447');
INSERT INTO ts_area VALUES ('452','扎赉特旗','447');
INSERT INTO ts_area VALUES ('453','突泉县','447');
INSERT INTO ts_area VALUES ('454','锡林郭勒盟','356');
INSERT INTO ts_area VALUES ('455','二连浩特市','454');
INSERT INTO ts_area VALUES ('456','锡林浩特市','454');
INSERT INTO ts_area VALUES ('457','阿巴嘎旗','454');
INSERT INTO ts_area VALUES ('458','苏尼特左旗','454');
INSERT INTO ts_area VALUES ('459','苏尼特右旗','454');
INSERT INTO ts_area VALUES ('460','东乌珠穆沁旗','454');
INSERT INTO ts_area VALUES ('461','西乌珠穆沁旗','454');
INSERT INTO ts_area VALUES ('462','太仆寺旗','454');
INSERT INTO ts_area VALUES ('463','镶黄旗','454');
INSERT INTO ts_area VALUES ('464','正镶白旗','454');
INSERT INTO ts_area VALUES ('465','正蓝旗','454');
INSERT INTO ts_area VALUES ('466','多伦县','454');
INSERT INTO ts_area VALUES ('467','阿拉善盟','356');
INSERT INTO ts_area VALUES ('468','阿拉善左旗','467');
INSERT INTO ts_area VALUES ('469','阿拉善右旗','467');
INSERT INTO ts_area VALUES ('470','额济纳旗','467');
INSERT INTO ts_area VALUES ('471','辽宁','0');
INSERT INTO ts_area VALUES ('472','沈阳市','471');
INSERT INTO ts_area VALUES ('473','和平区','472');
INSERT INTO ts_area VALUES ('474','沈河区','472');
INSERT INTO ts_area VALUES ('475','大东区','472');
INSERT INTO ts_area VALUES ('476','皇姑区','472');
INSERT INTO ts_area VALUES ('477','铁西区','472');
INSERT INTO ts_area VALUES ('478','苏家屯区','472');
INSERT INTO ts_area VALUES ('479','东陵区','472');
INSERT INTO ts_area VALUES ('480','沈北新区','472');
INSERT INTO ts_area VALUES ('481','于洪区','472');
INSERT INTO ts_area VALUES ('482','辽中县','472');
INSERT INTO ts_area VALUES ('483','康平县','472');
INSERT INTO ts_area VALUES ('484','法库县','472');
INSERT INTO ts_area VALUES ('485','新民市','472');
INSERT INTO ts_area VALUES ('486','大连市','471');
INSERT INTO ts_area VALUES ('487','中山区','486');
INSERT INTO ts_area VALUES ('488','西岗区','486');
INSERT INTO ts_area VALUES ('489','沙河口区','486');
INSERT INTO ts_area VALUES ('490','甘井子区','486');
INSERT INTO ts_area VALUES ('491','旅顺口区','486');
INSERT INTO ts_area VALUES ('492','金州区','486');
INSERT INTO ts_area VALUES ('493','长海县','486');
INSERT INTO ts_area VALUES ('494','瓦房店市','486');
INSERT INTO ts_area VALUES ('495','普兰店市','486');
INSERT INTO ts_area VALUES ('496','庄河市','486');
INSERT INTO ts_area VALUES ('497','鞍山市','471');
INSERT INTO ts_area VALUES ('498','铁东区','497');
INSERT INTO ts_area VALUES ('499','铁西区','497');
INSERT INTO ts_area VALUES ('500','立山区','497');
INSERT INTO ts_area VALUES ('501','千山区','497');
INSERT INTO ts_area VALUES ('502','台安县','497');
INSERT INTO ts_area VALUES ('503','岫岩满族自治县','497');
INSERT INTO ts_area VALUES ('504','海城市','497');
INSERT INTO ts_area VALUES ('505','抚顺市','471');
INSERT INTO ts_area VALUES ('506','新抚区','505');
INSERT INTO ts_area VALUES ('507','东洲区','505');
INSERT INTO ts_area VALUES ('508','望花区','505');
INSERT INTO ts_area VALUES ('509','顺城区','505');
INSERT INTO ts_area VALUES ('510','抚顺县','505');
INSERT INTO ts_area VALUES ('511','新宾满族自治县','505');
INSERT INTO ts_area VALUES ('512','清原满族自治县','505');
INSERT INTO ts_area VALUES ('513','本溪市','471');
INSERT INTO ts_area VALUES ('514','平山区','513');
INSERT INTO ts_area VALUES ('515','溪湖区','513');
INSERT INTO ts_area VALUES ('516','明山区','513');
INSERT INTO ts_area VALUES ('517','南芬区','513');
INSERT INTO ts_area VALUES ('518','本溪满族自治县','513');
INSERT INTO ts_area VALUES ('519','桓仁满族自治县','513');
INSERT INTO ts_area VALUES ('520','丹东市','471');
INSERT INTO ts_area VALUES ('521','元宝区','520');
INSERT INTO ts_area VALUES ('522','振兴区','520');
INSERT INTO ts_area VALUES ('523','振安区','520');
INSERT INTO ts_area VALUES ('524','宽甸满族自治县','520');
INSERT INTO ts_area VALUES ('525','东港市','520');
INSERT INTO ts_area VALUES ('526','凤城市','520');
INSERT INTO ts_area VALUES ('527','锦州市','471');
INSERT INTO ts_area VALUES ('528','古塔区','527');
INSERT INTO ts_area VALUES ('529','凌河区','527');
INSERT INTO ts_area VALUES ('530','太和区','527');
INSERT INTO ts_area VALUES ('531','黑山县','527');
INSERT INTO ts_area VALUES ('532','义县','527');
INSERT INTO ts_area VALUES ('533','凌海市','527');
INSERT INTO ts_area VALUES ('534','北镇市','527');
INSERT INTO ts_area VALUES ('535','营口市','471');
INSERT INTO ts_area VALUES ('536','站前区','535');
INSERT INTO ts_area VALUES ('537','西市区','535');
INSERT INTO ts_area VALUES ('538','鲅鱼圈区','535');
INSERT INTO ts_area VALUES ('539','老边区','535');
INSERT INTO ts_area VALUES ('540','盖州市','535');
INSERT INTO ts_area VALUES ('541','大石桥市','535');
INSERT INTO ts_area VALUES ('542','阜新市','471');
INSERT INTO ts_area VALUES ('543','海州区','542');
INSERT INTO ts_area VALUES ('544','新邱区','542');
INSERT INTO ts_area VALUES ('545','太平区','542');
INSERT INTO ts_area VALUES ('546','清河门区','542');
INSERT INTO ts_area VALUES ('547','细河区','542');
INSERT INTO ts_area VALUES ('548','阜新蒙古族自治县','542');
INSERT INTO ts_area VALUES ('549','彰武县','542');
INSERT INTO ts_area VALUES ('550','辽阳市','471');
INSERT INTO ts_area VALUES ('551','白塔区','550');
INSERT INTO ts_area VALUES ('552','文圣区','550');
INSERT INTO ts_area VALUES ('553','宏伟区','550');
INSERT INTO ts_area VALUES ('554','弓长岭区','550');
INSERT INTO ts_area VALUES ('555','太子河区','550');
INSERT INTO ts_area VALUES ('556','辽阳县','550');
INSERT INTO ts_area VALUES ('557','灯塔市','550');
INSERT INTO ts_area VALUES ('558','盘锦市','471');
INSERT INTO ts_area VALUES ('559','双台子区','558');
INSERT INTO ts_area VALUES ('560','兴隆台区','558');
INSERT INTO ts_area VALUES ('561','大洼县','558');
INSERT INTO ts_area VALUES ('562','盘山县','558');
INSERT INTO ts_area VALUES ('563','铁岭市','471');
INSERT INTO ts_area VALUES ('564','银州区','563');
INSERT INTO ts_area VALUES ('565','清河区','563');
INSERT INTO ts_area VALUES ('566','铁岭县','563');
INSERT INTO ts_area VALUES ('567','西丰县','563');
INSERT INTO ts_area VALUES ('568','昌图县','563');
INSERT INTO ts_area VALUES ('569','调兵山市','563');
INSERT INTO ts_area VALUES ('570','开原市','563');
INSERT INTO ts_area VALUES ('571','朝阳市','471');
INSERT INTO ts_area VALUES ('572','双塔区','571');
INSERT INTO ts_area VALUES ('573','龙城区','571');
INSERT INTO ts_area VALUES ('574','朝阳县','571');
INSERT INTO ts_area VALUES ('575','建平县','571');
INSERT INTO ts_area VALUES ('576','喀喇沁左翼蒙古族自治县','571');
INSERT INTO ts_area VALUES ('577','北票市','571');
INSERT INTO ts_area VALUES ('578','凌源市','571');
INSERT INTO ts_area VALUES ('579','葫芦岛市','471');
INSERT INTO ts_area VALUES ('580','连山区','579');
INSERT INTO ts_area VALUES ('581','龙港区','579');
INSERT INTO ts_area VALUES ('582','南票区','579');
INSERT INTO ts_area VALUES ('583','绥中县','579');
INSERT INTO ts_area VALUES ('584','建昌县','579');
INSERT INTO ts_area VALUES ('585','兴城市','579');
INSERT INTO ts_area VALUES ('586','吉林','0');
INSERT INTO ts_area VALUES ('587','长春市','586');
INSERT INTO ts_area VALUES ('588','南关区','587');
INSERT INTO ts_area VALUES ('589','宽城区','587');
INSERT INTO ts_area VALUES ('590','朝阳区','587');
INSERT INTO ts_area VALUES ('591','二道区','587');
INSERT INTO ts_area VALUES ('592','绿园区','587');
INSERT INTO ts_area VALUES ('593','双阳区','587');
INSERT INTO ts_area VALUES ('594','农安县','587');
INSERT INTO ts_area VALUES ('595','九台市','587');
INSERT INTO ts_area VALUES ('596','榆树市','587');
INSERT INTO ts_area VALUES ('597','德惠市','587');
INSERT INTO ts_area VALUES ('598','吉林市','586');
INSERT INTO ts_area VALUES ('599','昌邑区','598');
INSERT INTO ts_area VALUES ('600','龙潭区','598');
INSERT INTO ts_area VALUES ('601','船营区','598');
INSERT INTO ts_area VALUES ('602','丰满区','598');
INSERT INTO ts_area VALUES ('603','永吉县','598');
INSERT INTO ts_area VALUES ('604','蛟河市','598');
INSERT INTO ts_area VALUES ('605','桦甸市','598');
INSERT INTO ts_area VALUES ('606','舒兰市','598');
INSERT INTO ts_area VALUES ('607','磐石市','598');
INSERT INTO ts_area VALUES ('608','四平市','586');
INSERT INTO ts_area VALUES ('609','铁西区','608');
INSERT INTO ts_area VALUES ('610','铁东区','608');
INSERT INTO ts_area VALUES ('611','梨树县','608');
INSERT INTO ts_area VALUES ('612','伊通满族自治县','608');
INSERT INTO ts_area VALUES ('613','公主岭市','608');
INSERT INTO ts_area VALUES ('614','双辽市','608');
INSERT INTO ts_area VALUES ('615','辽源市','586');
INSERT INTO ts_area VALUES ('616','龙山区','615');
INSERT INTO ts_area VALUES ('617','西安区','615');
INSERT INTO ts_area VALUES ('618','东丰县','615');
INSERT INTO ts_area VALUES ('619','东辽县','615');
INSERT INTO ts_area VALUES ('620','通化市','586');
INSERT INTO ts_area VALUES ('621','东昌区','620');
INSERT INTO ts_area VALUES ('622','二道江区','620');
INSERT INTO ts_area VALUES ('623','通化县','620');
INSERT INTO ts_area VALUES ('624','辉南县','620');
INSERT INTO ts_area VALUES ('625','柳河县','620');
INSERT INTO ts_area VALUES ('626','梅河口市','620');
INSERT INTO ts_area VALUES ('627','集安市','620');
INSERT INTO ts_area VALUES ('628','白山市','586');
INSERT INTO ts_area VALUES ('629','八道江区','628');
INSERT INTO ts_area VALUES ('630','  江源区','628');
INSERT INTO ts_area VALUES ('631','抚松县','628');
INSERT INTO ts_area VALUES ('632','靖宇县','628');
INSERT INTO ts_area VALUES ('633','长白朝鲜族自治县','628');
INSERT INTO ts_area VALUES ('634','临江市','628');
INSERT INTO ts_area VALUES ('635','松原市','586');
INSERT INTO ts_area VALUES ('636','宁江区','635');
INSERT INTO ts_area VALUES ('637','前郭尔罗斯蒙古族自治县','635');
INSERT INTO ts_area VALUES ('638','长岭县','635');
INSERT INTO ts_area VALUES ('639','乾安县','635');
INSERT INTO ts_area VALUES ('640','扶余县','635');
INSERT INTO ts_area VALUES ('641','白城市','586');
INSERT INTO ts_area VALUES ('642','洮北区','641');
INSERT INTO ts_area VALUES ('643','镇赉县','641');
INSERT INTO ts_area VALUES ('644','通榆县','641');
INSERT INTO ts_area VALUES ('645','洮南市','641');
INSERT INTO ts_area VALUES ('646','大安市','641');
INSERT INTO ts_area VALUES ('647','延边朝鲜族自治州','586');
INSERT INTO ts_area VALUES ('648','延吉市','647');
INSERT INTO ts_area VALUES ('649','图们市','647');
INSERT INTO ts_area VALUES ('650','敦化市','647');
INSERT INTO ts_area VALUES ('651','珲春市','647');
INSERT INTO ts_area VALUES ('652','龙井市','647');
INSERT INTO ts_area VALUES ('653','和龙市','647');
INSERT INTO ts_area VALUES ('654','汪清县','647');
INSERT INTO ts_area VALUES ('655','安图县','647');
INSERT INTO ts_area VALUES ('656','黑龙江','0');
INSERT INTO ts_area VALUES ('657','哈尔滨市','656');
INSERT INTO ts_area VALUES ('658','道里区','657');
INSERT INTO ts_area VALUES ('659','南岗区','657');
INSERT INTO ts_area VALUES ('660','道外区','657');
INSERT INTO ts_area VALUES ('661','平房区','657');
INSERT INTO ts_area VALUES ('662','松北区','657');
INSERT INTO ts_area VALUES ('663','香坊区','657');
INSERT INTO ts_area VALUES ('664','呼兰区','657');
INSERT INTO ts_area VALUES ('665','阿城区                 ','657');
INSERT INTO ts_area VALUES ('666','依兰县','657');
INSERT INTO ts_area VALUES ('667','方正县','657');
INSERT INTO ts_area VALUES ('668','宾县','657');
INSERT INTO ts_area VALUES ('669','巴彦县','657');
INSERT INTO ts_area VALUES ('670','木兰县','657');
INSERT INTO ts_area VALUES ('671','通河县','657');
INSERT INTO ts_area VALUES ('672','延寿县','657');
INSERT INTO ts_area VALUES ('673','双城市','657');
INSERT INTO ts_area VALUES ('674','尚志市','657');
INSERT INTO ts_area VALUES ('675','五常市','657');
INSERT INTO ts_area VALUES ('676','齐齐哈尔市','656');
INSERT INTO ts_area VALUES ('677','龙沙区','676');
INSERT INTO ts_area VALUES ('678','建华区','676');
INSERT INTO ts_area VALUES ('679','铁锋区','676');
INSERT INTO ts_area VALUES ('680','昂昂溪区','676');
INSERT INTO ts_area VALUES ('681','富拉尔基区','676');
INSERT INTO ts_area VALUES ('682','碾子山区','676');
INSERT INTO ts_area VALUES ('683','梅里斯达斡尔族区','676');
INSERT INTO ts_area VALUES ('684','龙江县','676');
INSERT INTO ts_area VALUES ('685','依安县','676');
INSERT INTO ts_area VALUES ('686','泰来县','676');
INSERT INTO ts_area VALUES ('687','甘南县','676');
INSERT INTO ts_area VALUES ('688','富裕县','676');
INSERT INTO ts_area VALUES ('689','克山县','676');
INSERT INTO ts_area VALUES ('690','克东县','676');
INSERT INTO ts_area VALUES ('691','拜泉县','676');
INSERT INTO ts_area VALUES ('692','讷河市','676');
INSERT INTO ts_area VALUES ('693','鸡西市','656');
INSERT INTO ts_area VALUES ('694','鸡冠区','693');
INSERT INTO ts_area VALUES ('695','恒山区','693');
INSERT INTO ts_area VALUES ('696','滴道区','693');
INSERT INTO ts_area VALUES ('697','梨树区','693');
INSERT INTO ts_area VALUES ('698','城子河区','693');
INSERT INTO ts_area VALUES ('699','麻山区','693');
INSERT INTO ts_area VALUES ('700','鸡东县','693');
INSERT INTO ts_area VALUES ('701','虎林市','693');
INSERT INTO ts_area VALUES ('702','密山市','693');
INSERT INTO ts_area VALUES ('703','鹤岗市','656');
INSERT INTO ts_area VALUES ('704','向阳区','703');
INSERT INTO ts_area VALUES ('705','工农区','703');
INSERT INTO ts_area VALUES ('706','南山区','703');
INSERT INTO ts_area VALUES ('707','兴安区','703');
INSERT INTO ts_area VALUES ('708','东山区','703');
INSERT INTO ts_area VALUES ('709','兴山区','703');
INSERT INTO ts_area VALUES ('710','萝北县','703');
INSERT INTO ts_area VALUES ('711','绥滨县','703');
INSERT INTO ts_area VALUES ('712','双鸭山市','656');
INSERT INTO ts_area VALUES ('713','尖山区','712');
INSERT INTO ts_area VALUES ('714','岭东区','712');
INSERT INTO ts_area VALUES ('715','四方台区','712');
INSERT INTO ts_area VALUES ('716','宝山区','712');
INSERT INTO ts_area VALUES ('717','集贤县','712');
INSERT INTO ts_area VALUES ('718','友谊县','712');
INSERT INTO ts_area VALUES ('719','宝清县','712');
INSERT INTO ts_area VALUES ('720','饶河县','712');
INSERT INTO ts_area VALUES ('721','大庆市','656');
INSERT INTO ts_area VALUES ('722','萨尔图区','721');
INSERT INTO ts_area VALUES ('723','龙凤区','721');
INSERT INTO ts_area VALUES ('724','让胡路区','721');
INSERT INTO ts_area VALUES ('725','红岗区','721');
INSERT INTO ts_area VALUES ('726','大同区','721');
INSERT INTO ts_area VALUES ('727','肇州县','721');
INSERT INTO ts_area VALUES ('728','肇源县','721');
INSERT INTO ts_area VALUES ('729','林甸县','721');
INSERT INTO ts_area VALUES ('730','杜尔伯特蒙古族自治县','721');
INSERT INTO ts_area VALUES ('731','伊春市','656');
INSERT INTO ts_area VALUES ('732','伊春区','731');
INSERT INTO ts_area VALUES ('733','南岔区','731');
INSERT INTO ts_area VALUES ('734','友好区','731');
INSERT INTO ts_area VALUES ('735','西林区','731');
INSERT INTO ts_area VALUES ('736','翠峦区','731');
INSERT INTO ts_area VALUES ('737','新青区','731');
INSERT INTO ts_area VALUES ('738','美溪区','731');
INSERT INTO ts_area VALUES ('739','金山屯区','731');
INSERT INTO ts_area VALUES ('740','五营区','731');
INSERT INTO ts_area VALUES ('741','乌马河区','731');
INSERT INTO ts_area VALUES ('742','汤旺河区','731');
INSERT INTO ts_area VALUES ('743','带岭区','731');
INSERT INTO ts_area VALUES ('744','乌伊岭区','731');
INSERT INTO ts_area VALUES ('745','红星区','731');
INSERT INTO ts_area VALUES ('746','上甘岭区','731');
INSERT INTO ts_area VALUES ('747','嘉荫县','731');
INSERT INTO ts_area VALUES ('748','铁力市','731');
INSERT INTO ts_area VALUES ('749','佳木斯市','656');
INSERT INTO ts_area VALUES ('750','向阳区','749');
INSERT INTO ts_area VALUES ('751','前进区','749');
INSERT INTO ts_area VALUES ('752','东风区','749');
INSERT INTO ts_area VALUES ('753','郊区','749');
INSERT INTO ts_area VALUES ('754','桦南县','749');
INSERT INTO ts_area VALUES ('755','桦川县','749');
INSERT INTO ts_area VALUES ('756','汤原县','749');
INSERT INTO ts_area VALUES ('757','抚远县','749');
INSERT INTO ts_area VALUES ('758','同江市','749');
INSERT INTO ts_area VALUES ('759','富锦市','749');
INSERT INTO ts_area VALUES ('760','七台河市','656');
INSERT INTO ts_area VALUES ('761','新兴区','760');
INSERT INTO ts_area VALUES ('762','桃山区','760');
INSERT INTO ts_area VALUES ('763','茄子河区','760');
INSERT INTO ts_area VALUES ('764','勃利县','760');
INSERT INTO ts_area VALUES ('765','牡丹江市','656');
INSERT INTO ts_area VALUES ('766','东安区','765');
INSERT INTO ts_area VALUES ('767','阳明区','765');
INSERT INTO ts_area VALUES ('768','爱民区','765');
INSERT INTO ts_area VALUES ('769','西安区','765');
INSERT INTO ts_area VALUES ('770','东宁县','765');
INSERT INTO ts_area VALUES ('771','林口县','765');
INSERT INTO ts_area VALUES ('772','绥芬河市','765');
INSERT INTO ts_area VALUES ('773','海林市','765');
INSERT INTO ts_area VALUES ('774','宁安市','765');
INSERT INTO ts_area VALUES ('775','穆棱市','765');
INSERT INTO ts_area VALUES ('776','黑河市','656');
INSERT INTO ts_area VALUES ('777','爱辉区','776');
INSERT INTO ts_area VALUES ('778','嫩江县','776');
INSERT INTO ts_area VALUES ('779','逊克县','776');
INSERT INTO ts_area VALUES ('780','孙吴县','776');
INSERT INTO ts_area VALUES ('781','北安市','776');
INSERT INTO ts_area VALUES ('782','五大连池市','776');
INSERT INTO ts_area VALUES ('783','绥化市','656');
INSERT INTO ts_area VALUES ('784','北林区','783');
INSERT INTO ts_area VALUES ('785','望奎县','783');
INSERT INTO ts_area VALUES ('786','兰西县','783');
INSERT INTO ts_area VALUES ('787','青冈县','783');
INSERT INTO ts_area VALUES ('788','庆安县','783');
INSERT INTO ts_area VALUES ('789','明水县','783');
INSERT INTO ts_area VALUES ('790','绥棱县','783');
INSERT INTO ts_area VALUES ('791','安达市','783');
INSERT INTO ts_area VALUES ('792','肇东市','783');
INSERT INTO ts_area VALUES ('793','海伦市','783');
INSERT INTO ts_area VALUES ('794','大兴安岭地区','656');
INSERT INTO ts_area VALUES ('795','加格达奇区','794');
INSERT INTO ts_area VALUES ('796','松岭区','794');
INSERT INTO ts_area VALUES ('797','新林区','794');
INSERT INTO ts_area VALUES ('798','呼中区','794');
INSERT INTO ts_area VALUES ('799','呼玛县','794');
INSERT INTO ts_area VALUES ('800','塔河县','794');
INSERT INTO ts_area VALUES ('801','漠河县','794');
INSERT INTO ts_area VALUES ('802','上海','0');
INSERT INTO ts_area VALUES ('803','上海市','802');
INSERT INTO ts_area VALUES ('804','黄浦区','803');
INSERT INTO ts_area VALUES ('805','卢湾区','803');
INSERT INTO ts_area VALUES ('806','徐汇区','803');
INSERT INTO ts_area VALUES ('807','长宁区','803');
INSERT INTO ts_area VALUES ('808','静安区','803');
INSERT INTO ts_area VALUES ('809','普陀区','803');
INSERT INTO ts_area VALUES ('810','闸北区','803');
INSERT INTO ts_area VALUES ('811','虹口区','803');
INSERT INTO ts_area VALUES ('812','杨浦区','803');
INSERT INTO ts_area VALUES ('813','闵行区','803');
INSERT INTO ts_area VALUES ('814','宝山区','803');
INSERT INTO ts_area VALUES ('815','嘉定区','803');
INSERT INTO ts_area VALUES ('816','浦东新区','803');
INSERT INTO ts_area VALUES ('817','金山区','803');
INSERT INTO ts_area VALUES ('818','松江区','803');
INSERT INTO ts_area VALUES ('819','青浦区','803');
INSERT INTO ts_area VALUES ('820','南汇区','803');
INSERT INTO ts_area VALUES ('821','奉贤区','803');
INSERT INTO ts_area VALUES ('822','崇明县','803');
INSERT INTO ts_area VALUES ('823','江苏','0');
INSERT INTO ts_area VALUES ('824','南京市','823');
INSERT INTO ts_area VALUES ('825','玄武区','824');
INSERT INTO ts_area VALUES ('826','白下区','824');
INSERT INTO ts_area VALUES ('827','秦淮区','824');
INSERT INTO ts_area VALUES ('828','建邺区','824');
INSERT INTO ts_area VALUES ('829','鼓楼区','824');
INSERT INTO ts_area VALUES ('830','下关区','824');
INSERT INTO ts_area VALUES ('831','浦口区','824');
INSERT INTO ts_area VALUES ('832','栖霞区','824');
INSERT INTO ts_area VALUES ('833','雨花台区','824');
INSERT INTO ts_area VALUES ('834','江宁区','824');
INSERT INTO ts_area VALUES ('835','六合区','824');
INSERT INTO ts_area VALUES ('836','溧水县','824');
INSERT INTO ts_area VALUES ('837','高淳县','824');
INSERT INTO ts_area VALUES ('838','无锡市','823');
INSERT INTO ts_area VALUES ('839','崇安区','838');
INSERT INTO ts_area VALUES ('840','南长区','838');
INSERT INTO ts_area VALUES ('841','北塘区','838');
INSERT INTO ts_area VALUES ('842','锡山区','838');
INSERT INTO ts_area VALUES ('843','惠山区','838');
INSERT INTO ts_area VALUES ('844','滨湖区','838');
INSERT INTO ts_area VALUES ('845','江阴市','838');
INSERT INTO ts_area VALUES ('846','宜兴市','838');
INSERT INTO ts_area VALUES ('847','徐州市','823');
INSERT INTO ts_area VALUES ('848','鼓楼区','847');
INSERT INTO ts_area VALUES ('849','云龙区','847');
INSERT INTO ts_area VALUES ('850','九里区','847');
INSERT INTO ts_area VALUES ('851','贾汪区','847');
INSERT INTO ts_area VALUES ('852','泉山区','847');
INSERT INTO ts_area VALUES ('853','丰县','847');
INSERT INTO ts_area VALUES ('854','沛县','847');
INSERT INTO ts_area VALUES ('855','铜山县','847');
INSERT INTO ts_area VALUES ('856','睢宁县','847');
INSERT INTO ts_area VALUES ('857','新沂市','847');
INSERT INTO ts_area VALUES ('858','邳州市','847');
INSERT INTO ts_area VALUES ('859','常州市','823');
INSERT INTO ts_area VALUES ('860','天宁区','859');
INSERT INTO ts_area VALUES ('861','钟楼区','859');
INSERT INTO ts_area VALUES ('862','戚墅堰区','859');
INSERT INTO ts_area VALUES ('863','新北区','859');
INSERT INTO ts_area VALUES ('864','武进区','859');
INSERT INTO ts_area VALUES ('865','溧阳市','859');
INSERT INTO ts_area VALUES ('866','金坛市','859');
INSERT INTO ts_area VALUES ('867','苏州市','823');
INSERT INTO ts_area VALUES ('868','沧浪区','867');
INSERT INTO ts_area VALUES ('869','平江区','867');
INSERT INTO ts_area VALUES ('870','金阊区','867');
INSERT INTO ts_area VALUES ('871','虎丘区','867');
INSERT INTO ts_area VALUES ('872','吴中区','867');
INSERT INTO ts_area VALUES ('873','相城区','867');
INSERT INTO ts_area VALUES ('874','常熟市','867');
INSERT INTO ts_area VALUES ('875','张家港市','867');
INSERT INTO ts_area VALUES ('876','昆山市','867');
INSERT INTO ts_area VALUES ('877','吴江市','867');
INSERT INTO ts_area VALUES ('878','太仓市','867');
INSERT INTO ts_area VALUES ('879','南通市','823');
INSERT INTO ts_area VALUES ('880','崇川区','879');
INSERT INTO ts_area VALUES ('881','港闸区','879');
INSERT INTO ts_area VALUES ('882','海安县','879');
INSERT INTO ts_area VALUES ('883','如东县','879');
INSERT INTO ts_area VALUES ('884','启东市','879');
INSERT INTO ts_area VALUES ('885','如皋市','879');
INSERT INTO ts_area VALUES ('886','通州市','879');
INSERT INTO ts_area VALUES ('887','海门市','879');
INSERT INTO ts_area VALUES ('888','连云港市','823');
INSERT INTO ts_area VALUES ('889','连云区','888');
INSERT INTO ts_area VALUES ('890','新浦区','888');
INSERT INTO ts_area VALUES ('891','海州区','888');
INSERT INTO ts_area VALUES ('892','赣榆县','888');
INSERT INTO ts_area VALUES ('893','东海县','888');
INSERT INTO ts_area VALUES ('894','灌云县','888');
INSERT INTO ts_area VALUES ('895','灌南县','888');
INSERT INTO ts_area VALUES ('896','淮安市','823');
INSERT INTO ts_area VALUES ('897','清河区','896');
INSERT INTO ts_area VALUES ('898','楚州区','896');
INSERT INTO ts_area VALUES ('899','淮阴区','896');
INSERT INTO ts_area VALUES ('900','清浦区','896');
INSERT INTO ts_area VALUES ('901','涟水县','896');
INSERT INTO ts_area VALUES ('902','洪泽县','896');
INSERT INTO ts_area VALUES ('903','盱眙县','896');
INSERT INTO ts_area VALUES ('904','金湖县','896');
INSERT INTO ts_area VALUES ('905','盐城市','823');
INSERT INTO ts_area VALUES ('906','亭湖区','905');
INSERT INTO ts_area VALUES ('907','盐都区','905');
INSERT INTO ts_area VALUES ('908','响水县','905');
INSERT INTO ts_area VALUES ('909','滨海县','905');
INSERT INTO ts_area VALUES ('910','阜宁县','905');
INSERT INTO ts_area VALUES ('911','射阳县','905');
INSERT INTO ts_area VALUES ('912','建湖县','905');
INSERT INTO ts_area VALUES ('913','东台市','905');
INSERT INTO ts_area VALUES ('914','大丰市','905');
INSERT INTO ts_area VALUES ('915','扬州市','823');
INSERT INTO ts_area VALUES ('916','广陵区','915');
INSERT INTO ts_area VALUES ('917','邗江区','915');
INSERT INTO ts_area VALUES ('918','维扬区','915');
INSERT INTO ts_area VALUES ('919','宝应县','915');
INSERT INTO ts_area VALUES ('920','仪征市','915');
INSERT INTO ts_area VALUES ('921','高邮市','915');
INSERT INTO ts_area VALUES ('922','江都市','915');
INSERT INTO ts_area VALUES ('923','镇江市','823');
INSERT INTO ts_area VALUES ('924','京口区','923');
INSERT INTO ts_area VALUES ('925','润州区','923');
INSERT INTO ts_area VALUES ('926','丹徒区','923');
INSERT INTO ts_area VALUES ('927','丹阳市','923');
INSERT INTO ts_area VALUES ('928','扬中市','923');
INSERT INTO ts_area VALUES ('929','句容市','923');
INSERT INTO ts_area VALUES ('930','泰州市','823');
INSERT INTO ts_area VALUES ('931','海陵区','930');
INSERT INTO ts_area VALUES ('932','高港区','930');
INSERT INTO ts_area VALUES ('933','兴化市','930');
INSERT INTO ts_area VALUES ('934','靖江市','930');
INSERT INTO ts_area VALUES ('935','泰兴市','930');
INSERT INTO ts_area VALUES ('936','姜堰市','930');
INSERT INTO ts_area VALUES ('937','宿迁市','823');
INSERT INTO ts_area VALUES ('938','宿城区','937');
INSERT INTO ts_area VALUES ('939','宿豫区','937');
INSERT INTO ts_area VALUES ('940','沭阳县','937');
INSERT INTO ts_area VALUES ('941','泗阳县','937');
INSERT INTO ts_area VALUES ('942','泗洪县','937');
INSERT INTO ts_area VALUES ('943','浙江','0');
INSERT INTO ts_area VALUES ('944','杭州市','943');
INSERT INTO ts_area VALUES ('945','上城区','944');
INSERT INTO ts_area VALUES ('946','下城区','944');
INSERT INTO ts_area VALUES ('947','江干区','944');
INSERT INTO ts_area VALUES ('948','拱墅区','944');
INSERT INTO ts_area VALUES ('949','西湖区','944');
INSERT INTO ts_area VALUES ('950','滨江区','944');
INSERT INTO ts_area VALUES ('951','萧山区','944');
INSERT INTO ts_area VALUES ('952','余杭区','944');
INSERT INTO ts_area VALUES ('953','桐庐县','944');
INSERT INTO ts_area VALUES ('954','淳安县','944');
INSERT INTO ts_area VALUES ('955','建德市','944');
INSERT INTO ts_area VALUES ('956','富阳市','944');
INSERT INTO ts_area VALUES ('957','临安市','944');
INSERT INTO ts_area VALUES ('958','宁波市','943');
INSERT INTO ts_area VALUES ('959','海曙区','958');
INSERT INTO ts_area VALUES ('960','江东区','958');
INSERT INTO ts_area VALUES ('961','江北区','958');
INSERT INTO ts_area VALUES ('962','北仑区','958');
INSERT INTO ts_area VALUES ('963','镇海区','958');
INSERT INTO ts_area VALUES ('964','鄞州区','958');
INSERT INTO ts_area VALUES ('965','象山县','958');
INSERT INTO ts_area VALUES ('966','宁海县','958');
INSERT INTO ts_area VALUES ('967','余姚市','958');
INSERT INTO ts_area VALUES ('968','慈溪市','958');
INSERT INTO ts_area VALUES ('969','奉化市','958');
INSERT INTO ts_area VALUES ('970','温州市','943');
INSERT INTO ts_area VALUES ('971','鹿城区','970');
INSERT INTO ts_area VALUES ('972','龙湾区','970');
INSERT INTO ts_area VALUES ('973','瓯海区','970');
INSERT INTO ts_area VALUES ('974','洞头县','970');
INSERT INTO ts_area VALUES ('975','永嘉县','970');
INSERT INTO ts_area VALUES ('976','平阳县','970');
INSERT INTO ts_area VALUES ('977','苍南县','970');
INSERT INTO ts_area VALUES ('978','文成县','970');
INSERT INTO ts_area VALUES ('979','泰顺县','970');
INSERT INTO ts_area VALUES ('980','瑞安市','970');
INSERT INTO ts_area VALUES ('981','乐清市','970');
INSERT INTO ts_area VALUES ('982','嘉兴市','943');
INSERT INTO ts_area VALUES ('983','南湖区','982');
INSERT INTO ts_area VALUES ('984','秀洲区','982');
INSERT INTO ts_area VALUES ('985','嘉善县','982');
INSERT INTO ts_area VALUES ('986','海盐县','982');
INSERT INTO ts_area VALUES ('987','海宁市','982');
INSERT INTO ts_area VALUES ('988','平湖市','982');
INSERT INTO ts_area VALUES ('989','桐乡市','982');
INSERT INTO ts_area VALUES ('990','湖州市','943');
INSERT INTO ts_area VALUES ('991','吴兴区','990');
INSERT INTO ts_area VALUES ('992','南浔区','990');
INSERT INTO ts_area VALUES ('993','德清县','990');
INSERT INTO ts_area VALUES ('994','长兴县','990');
INSERT INTO ts_area VALUES ('995','安吉县','990');
INSERT INTO ts_area VALUES ('996','绍兴市','943');
INSERT INTO ts_area VALUES ('997','越城区','996');
INSERT INTO ts_area VALUES ('998','绍兴县','996');
INSERT INTO ts_area VALUES ('999','新昌县','996');
INSERT INTO ts_area VALUES ('1000','诸暨市','996');
INSERT INTO ts_area VALUES ('1001','上虞市','996');
INSERT INTO ts_area VALUES ('1002','嵊州市','996');
INSERT INTO ts_area VALUES ('1003','金华市','943');
INSERT INTO ts_area VALUES ('1004','婺城区','1003');
INSERT INTO ts_area VALUES ('1005','金东区','1003');
INSERT INTO ts_area VALUES ('1006','武义县','1003');
INSERT INTO ts_area VALUES ('1007','浦江县','1003');
INSERT INTO ts_area VALUES ('1008','磐安县','1003');
INSERT INTO ts_area VALUES ('1009','兰溪市','1003');
INSERT INTO ts_area VALUES ('1010','义乌市','1003');
INSERT INTO ts_area VALUES ('1011','东阳市','1003');
INSERT INTO ts_area VALUES ('1012','永康市','1003');
INSERT INTO ts_area VALUES ('1013','衢州市','943');
INSERT INTO ts_area VALUES ('1014','柯城区','1013');
INSERT INTO ts_area VALUES ('1015','衢江区','1013');
INSERT INTO ts_area VALUES ('1016','常山县','1013');
INSERT INTO ts_area VALUES ('1017','开化县','1013');
INSERT INTO ts_area VALUES ('1018','龙游县','1013');
INSERT INTO ts_area VALUES ('1019','江山市','1013');
INSERT INTO ts_area VALUES ('1020','舟山市','943');
INSERT INTO ts_area VALUES ('1021','定海区','1020');
INSERT INTO ts_area VALUES ('1022','普陀区','1020');
INSERT INTO ts_area VALUES ('1023','岱山县','1020');
INSERT INTO ts_area VALUES ('1024','嵊泗县','1020');
INSERT INTO ts_area VALUES ('1025','台州市','943');
INSERT INTO ts_area VALUES ('1026','椒江区','1025');
INSERT INTO ts_area VALUES ('1027','黄岩区','1025');
INSERT INTO ts_area VALUES ('1028','路桥区','1025');
INSERT INTO ts_area VALUES ('1029','玉环县','1025');
INSERT INTO ts_area VALUES ('1030','三门县','1025');
INSERT INTO ts_area VALUES ('1031','天台县','1025');
INSERT INTO ts_area VALUES ('1032','仙居县','1025');
INSERT INTO ts_area VALUES ('1033','温岭市','1025');
INSERT INTO ts_area VALUES ('1034','临海市','1025');
INSERT INTO ts_area VALUES ('1035','丽水市','943');
INSERT INTO ts_area VALUES ('1036','莲都区','1035');
INSERT INTO ts_area VALUES ('1037','青田县','1035');
INSERT INTO ts_area VALUES ('1038','缙云县','1035');
INSERT INTO ts_area VALUES ('1039','遂昌县','1035');
INSERT INTO ts_area VALUES ('1040','松阳县','1035');
INSERT INTO ts_area VALUES ('1041','云和县','1035');
INSERT INTO ts_area VALUES ('1042','庆元县','1035');
INSERT INTO ts_area VALUES ('1043','景宁畲族自治县','1035');
INSERT INTO ts_area VALUES ('1044','龙泉市','1035');
INSERT INTO ts_area VALUES ('1045','安徽','0');
INSERT INTO ts_area VALUES ('1046','合肥市','1045');
INSERT INTO ts_area VALUES ('1047','瑶海区','1046');
INSERT INTO ts_area VALUES ('1048','庐阳区','1046');
INSERT INTO ts_area VALUES ('1049','蜀山区','1046');
INSERT INTO ts_area VALUES ('1050','包河区','1046');
INSERT INTO ts_area VALUES ('1051','长丰县','1046');
INSERT INTO ts_area VALUES ('1052','肥东县','1046');
INSERT INTO ts_area VALUES ('1053','肥西县','1046');
INSERT INTO ts_area VALUES ('1054','芜湖市','1045');
INSERT INTO ts_area VALUES ('1055','镜湖区','1054');
INSERT INTO ts_area VALUES ('1056','弋江区','1054');
INSERT INTO ts_area VALUES ('1057','鸠江区','1054');
INSERT INTO ts_area VALUES ('1058','三山区','1054');
INSERT INTO ts_area VALUES ('1059','芜湖县','1054');
INSERT INTO ts_area VALUES ('1060','繁昌县','1054');
INSERT INTO ts_area VALUES ('1061','南陵县','1054');
INSERT INTO ts_area VALUES ('1062','蚌埠市','1045');
INSERT INTO ts_area VALUES ('1063','龙子湖区','1062');
INSERT INTO ts_area VALUES ('1064','蚌山区','1062');
INSERT INTO ts_area VALUES ('1065','禹会区','1062');
INSERT INTO ts_area VALUES ('1066','淮上区','1062');
INSERT INTO ts_area VALUES ('1067','怀远县','1062');
INSERT INTO ts_area VALUES ('1068','五河县','1062');
INSERT INTO ts_area VALUES ('1069','固镇县','1062');
INSERT INTO ts_area VALUES ('1070','淮南市','1045');
INSERT INTO ts_area VALUES ('1071','大通区','1070');
INSERT INTO ts_area VALUES ('1072','田家庵区','1070');
INSERT INTO ts_area VALUES ('1073','谢家集区','1070');
INSERT INTO ts_area VALUES ('1074','八公山区','1070');
INSERT INTO ts_area VALUES ('1075','潘集区','1070');
INSERT INTO ts_area VALUES ('1076','凤台县','1070');
INSERT INTO ts_area VALUES ('1077','马鞍山市','1045');
INSERT INTO ts_area VALUES ('1078','金家庄区','1077');
INSERT INTO ts_area VALUES ('1079','花山区','1077');
INSERT INTO ts_area VALUES ('1080','雨山区','1077');
INSERT INTO ts_area VALUES ('1081','当涂县','1077');
INSERT INTO ts_area VALUES ('1082','淮北市','1045');
INSERT INTO ts_area VALUES ('1083','杜集区','1082');
INSERT INTO ts_area VALUES ('1084','相山区','1082');
INSERT INTO ts_area VALUES ('1085','烈山区','1082');
INSERT INTO ts_area VALUES ('1086','濉溪县','1082');
INSERT INTO ts_area VALUES ('1087','铜陵市','1045');
INSERT INTO ts_area VALUES ('1088','铜官山区','1087');
INSERT INTO ts_area VALUES ('1089','狮子山区','1087');
INSERT INTO ts_area VALUES ('1090','郊区','1087');
INSERT INTO ts_area VALUES ('1091','铜陵县','1087');
INSERT INTO ts_area VALUES ('1092','安庆市','1045');
INSERT INTO ts_area VALUES ('1093','迎江区','1092');
INSERT INTO ts_area VALUES ('1094','大观区','1092');
INSERT INTO ts_area VALUES ('1095','宜秀区','1092');
INSERT INTO ts_area VALUES ('1096','怀宁县','1092');
INSERT INTO ts_area VALUES ('1097','枞阳县','1092');
INSERT INTO ts_area VALUES ('1098','潜山县','1092');
INSERT INTO ts_area VALUES ('1099','太湖县','1092');
INSERT INTO ts_area VALUES ('1100','宿松县','1092');
INSERT INTO ts_area VALUES ('1101','望江县','1092');
INSERT INTO ts_area VALUES ('1102','岳西县','1092');
INSERT INTO ts_area VALUES ('1103','桐城市','1092');
INSERT INTO ts_area VALUES ('1104','黄山市','1045');
INSERT INTO ts_area VALUES ('1105','屯溪区','1104');
INSERT INTO ts_area VALUES ('1106','黄山区','1104');
INSERT INTO ts_area VALUES ('1107','徽州区','1104');
INSERT INTO ts_area VALUES ('1108','歙县','1104');
INSERT INTO ts_area VALUES ('1109','休宁县','1104');
INSERT INTO ts_area VALUES ('1110','黟县','1104');
INSERT INTO ts_area VALUES ('1111','祁门县','1104');
INSERT INTO ts_area VALUES ('1112','滁州市','1045');
INSERT INTO ts_area VALUES ('1113','琅琊区','1112');
INSERT INTO ts_area VALUES ('1114','南谯区','1112');
INSERT INTO ts_area VALUES ('1115','来安县','1112');
INSERT INTO ts_area VALUES ('1116','全椒县','1112');
INSERT INTO ts_area VALUES ('1117','定远县','1112');
INSERT INTO ts_area VALUES ('1118','凤阳县','1112');
INSERT INTO ts_area VALUES ('1119','天长市','1112');
INSERT INTO ts_area VALUES ('1120','明光市','1112');
INSERT INTO ts_area VALUES ('1121','阜阳市','1045');
INSERT INTO ts_area VALUES ('1122','颍州区','1121');
INSERT INTO ts_area VALUES ('1123','颍东区','1121');
INSERT INTO ts_area VALUES ('1124','颍泉区','1121');
INSERT INTO ts_area VALUES ('1125','临泉县','1121');
INSERT INTO ts_area VALUES ('1126','太和县','1121');
INSERT INTO ts_area VALUES ('1127','阜南县','1121');
INSERT INTO ts_area VALUES ('1128','颍上县','1121');
INSERT INTO ts_area VALUES ('1129','界首市','1121');
INSERT INTO ts_area VALUES ('1130','宿州市','1045');
INSERT INTO ts_area VALUES ('1131','埇桥区','1130');
INSERT INTO ts_area VALUES ('1132','砀山县','1130');
INSERT INTO ts_area VALUES ('1133','萧县','1130');
INSERT INTO ts_area VALUES ('1134','灵璧县','1130');
INSERT INTO ts_area VALUES ('1135','泗县','1130');
INSERT INTO ts_area VALUES ('1136','巢湖市','1045');
INSERT INTO ts_area VALUES ('1137','居巢区','1136');
INSERT INTO ts_area VALUES ('1138','庐江县','1136');
INSERT INTO ts_area VALUES ('1139','无为县','1136');
INSERT INTO ts_area VALUES ('1140','含山县','1136');
INSERT INTO ts_area VALUES ('1141','和县','1136');
INSERT INTO ts_area VALUES ('1142','六安市','1045');
INSERT INTO ts_area VALUES ('1143','金安区','1142');
INSERT INTO ts_area VALUES ('1144','裕安区','1142');
INSERT INTO ts_area VALUES ('1145','寿县','1142');
INSERT INTO ts_area VALUES ('1146','霍邱县','1142');
INSERT INTO ts_area VALUES ('1147','舒城县','1142');
INSERT INTO ts_area VALUES ('1148','金寨县','1142');
INSERT INTO ts_area VALUES ('1149','霍山县','1142');
INSERT INTO ts_area VALUES ('1150','亳州市','1045');
INSERT INTO ts_area VALUES ('1151','谯城区','1150');
INSERT INTO ts_area VALUES ('1152','涡阳县','1150');
INSERT INTO ts_area VALUES ('1153','蒙城县','1150');
INSERT INTO ts_area VALUES ('1154','利辛县','1150');
INSERT INTO ts_area VALUES ('1155','池州市','1045');
INSERT INTO ts_area VALUES ('1156','贵池区','1155');
INSERT INTO ts_area VALUES ('1157','东至县','1155');
INSERT INTO ts_area VALUES ('1158','石台县','1155');
INSERT INTO ts_area VALUES ('1159','青阳县','1155');
INSERT INTO ts_area VALUES ('1160','宣城市','1045');
INSERT INTO ts_area VALUES ('1161','宣州区','1160');
INSERT INTO ts_area VALUES ('1162','郎溪县','1160');
INSERT INTO ts_area VALUES ('1163','广德县','1160');
INSERT INTO ts_area VALUES ('1164','泾县','1160');
INSERT INTO ts_area VALUES ('1165','绩溪县','1160');
INSERT INTO ts_area VALUES ('1166','旌德县','1160');
INSERT INTO ts_area VALUES ('1167','宁国市','1160');
INSERT INTO ts_area VALUES ('1168','福建','0');
INSERT INTO ts_area VALUES ('1169','福州市','1168');
INSERT INTO ts_area VALUES ('1170','鼓楼区','1169');
INSERT INTO ts_area VALUES ('1171','台江区','1169');
INSERT INTO ts_area VALUES ('1172','仓山区','1169');
INSERT INTO ts_area VALUES ('1173','马尾区','1169');
INSERT INTO ts_area VALUES ('1174','晋安区','1169');
INSERT INTO ts_area VALUES ('1175','闽侯县','1169');
INSERT INTO ts_area VALUES ('1176','连江县','1169');
INSERT INTO ts_area VALUES ('1177','罗源县','1169');
INSERT INTO ts_area VALUES ('1178','闽清县','1169');
INSERT INTO ts_area VALUES ('1179','永泰县','1169');
INSERT INTO ts_area VALUES ('1180','平潭县','1169');
INSERT INTO ts_area VALUES ('1181','福清市','1169');
INSERT INTO ts_area VALUES ('1182','长乐市','1169');
INSERT INTO ts_area VALUES ('1183','厦门市','1168');
INSERT INTO ts_area VALUES ('1184','思明区','1183');
INSERT INTO ts_area VALUES ('1185','海沧区','1183');
INSERT INTO ts_area VALUES ('1186','湖里区','1183');
INSERT INTO ts_area VALUES ('1187','集美区','1183');
INSERT INTO ts_area VALUES ('1188','同安区','1183');
INSERT INTO ts_area VALUES ('1189','翔安区','1183');
INSERT INTO ts_area VALUES ('1190','莆田市','1168');
INSERT INTO ts_area VALUES ('1191','城厢区','1190');
INSERT INTO ts_area VALUES ('1192','涵江区','1190');
INSERT INTO ts_area VALUES ('1193','荔城区','1190');
INSERT INTO ts_area VALUES ('1194','秀屿区','1190');
INSERT INTO ts_area VALUES ('1195','仙游县','1190');
INSERT INTO ts_area VALUES ('1196','三明市','1168');
INSERT INTO ts_area VALUES ('1197','梅列区','1196');
INSERT INTO ts_area VALUES ('1198','三元区','1196');
INSERT INTO ts_area VALUES ('1199','明溪县','1196');
INSERT INTO ts_area VALUES ('1200','清流县','1196');
INSERT INTO ts_area VALUES ('1201','宁化县','1196');
INSERT INTO ts_area VALUES ('1202','大田县','1196');
INSERT INTO ts_area VALUES ('1203','尤溪县','1196');
INSERT INTO ts_area VALUES ('1204','沙县','1196');
INSERT INTO ts_area VALUES ('1205','将乐县','1196');
INSERT INTO ts_area VALUES ('1206','泰宁县','1196');
INSERT INTO ts_area VALUES ('1207','建宁县','1196');
INSERT INTO ts_area VALUES ('1208','永安市','1196');
INSERT INTO ts_area VALUES ('1209','泉州市','1168');
INSERT INTO ts_area VALUES ('1210','鲤城区','1209');
INSERT INTO ts_area VALUES ('1211','丰泽区','1209');
INSERT INTO ts_area VALUES ('1212','洛江区','1209');
INSERT INTO ts_area VALUES ('1213','泉港区','1209');
INSERT INTO ts_area VALUES ('1214','惠安县','1209');
INSERT INTO ts_area VALUES ('1215','安溪县','1209');
INSERT INTO ts_area VALUES ('1216','永春县','1209');
INSERT INTO ts_area VALUES ('1217','德化县','1209');
INSERT INTO ts_area VALUES ('1218','金门县','1209');
INSERT INTO ts_area VALUES ('1219','石狮市','1209');
INSERT INTO ts_area VALUES ('1220','晋江市','1209');
INSERT INTO ts_area VALUES ('1221','南安市','1209');
INSERT INTO ts_area VALUES ('1222','漳州市','1168');
INSERT INTO ts_area VALUES ('1223','芗城区','1222');
INSERT INTO ts_area VALUES ('1224','龙文区','1222');
INSERT INTO ts_area VALUES ('1225','云霄县','1222');
INSERT INTO ts_area VALUES ('1226','漳浦县','1222');
INSERT INTO ts_area VALUES ('1227','诏安县','1222');
INSERT INTO ts_area VALUES ('1228','长泰县','1222');
INSERT INTO ts_area VALUES ('1229','东山县','1222');
INSERT INTO ts_area VALUES ('1230','南靖县','1222');
INSERT INTO ts_area VALUES ('1231','平和县','1222');
INSERT INTO ts_area VALUES ('1232','华安县','1222');
INSERT INTO ts_area VALUES ('1233','龙海市','1222');
INSERT INTO ts_area VALUES ('1234','南平市','1168');
INSERT INTO ts_area VALUES ('1235','延平区','1234');
INSERT INTO ts_area VALUES ('1236','顺昌县','1234');
INSERT INTO ts_area VALUES ('1237','浦城县','1234');
INSERT INTO ts_area VALUES ('1238','光泽县','1234');
INSERT INTO ts_area VALUES ('1239','松溪县','1234');
INSERT INTO ts_area VALUES ('1240','政和县','1234');
INSERT INTO ts_area VALUES ('1241','邵武市','1234');
INSERT INTO ts_area VALUES ('1242','武夷山市','1234');
INSERT INTO ts_area VALUES ('1243','建瓯市','1234');
INSERT INTO ts_area VALUES ('1244','建阳市','1234');
INSERT INTO ts_area VALUES ('1245','龙岩市','1168');
INSERT INTO ts_area VALUES ('1246','新罗区','1245');
INSERT INTO ts_area VALUES ('1247','长汀县','1245');
INSERT INTO ts_area VALUES ('1248','永定县','1245');
INSERT INTO ts_area VALUES ('1249','上杭县','1245');
INSERT INTO ts_area VALUES ('1250','武平县','1245');
INSERT INTO ts_area VALUES ('1251','连城县','1245');
INSERT INTO ts_area VALUES ('1252','漳平市','1245');
INSERT INTO ts_area VALUES ('1253','宁德市','1168');
INSERT INTO ts_area VALUES ('1254','蕉城区','1253');
INSERT INTO ts_area VALUES ('1255','霞浦县','1253');
INSERT INTO ts_area VALUES ('1256','古田县','1253');
INSERT INTO ts_area VALUES ('1257','屏南县','1253');
INSERT INTO ts_area VALUES ('1258','寿宁县','1253');
INSERT INTO ts_area VALUES ('1259','周宁县','1253');
INSERT INTO ts_area VALUES ('1260','柘荣县','1253');
INSERT INTO ts_area VALUES ('1261','福安市','1253');
INSERT INTO ts_area VALUES ('1262','福鼎市','1253');
INSERT INTO ts_area VALUES ('1263','江西','0');
INSERT INTO ts_area VALUES ('1264','南昌市','1263');
INSERT INTO ts_area VALUES ('1265','东湖区','1264');
INSERT INTO ts_area VALUES ('1266','西湖区','1264');
INSERT INTO ts_area VALUES ('1267','青云谱区','1264');
INSERT INTO ts_area VALUES ('1268','湾里区','1264');
INSERT INTO ts_area VALUES ('1269','青山湖区','1264');
INSERT INTO ts_area VALUES ('1270','南昌县','1264');
INSERT INTO ts_area VALUES ('1271','新建县','1264');
INSERT INTO ts_area VALUES ('1272','安义县','1264');
INSERT INTO ts_area VALUES ('1273','进贤县','1264');
INSERT INTO ts_area VALUES ('1274','景德镇市','1263');
INSERT INTO ts_area VALUES ('1275','昌江区','1274');
INSERT INTO ts_area VALUES ('1276','珠山区','1274');
INSERT INTO ts_area VALUES ('1277','浮梁县','1274');
INSERT INTO ts_area VALUES ('1278','乐平市','1274');
INSERT INTO ts_area VALUES ('1279','萍乡市','1263');
INSERT INTO ts_area VALUES ('1280','安源区','1279');
INSERT INTO ts_area VALUES ('1281','湘东区','1279');
INSERT INTO ts_area VALUES ('1282','莲花县','1279');
INSERT INTO ts_area VALUES ('1283','上栗县','1279');
INSERT INTO ts_area VALUES ('1284','芦溪县','1279');
INSERT INTO ts_area VALUES ('1285','九江市','1263');
INSERT INTO ts_area VALUES ('1286','庐山区','1285');
INSERT INTO ts_area VALUES ('1287','浔阳区','1285');
INSERT INTO ts_area VALUES ('1288','九江县','1285');
INSERT INTO ts_area VALUES ('1289','武宁县','1285');
INSERT INTO ts_area VALUES ('1290','修水县','1285');
INSERT INTO ts_area VALUES ('1291','永修县','1285');
INSERT INTO ts_area VALUES ('1292','德安县','1285');
INSERT INTO ts_area VALUES ('1293','星子县','1285');
INSERT INTO ts_area VALUES ('1294','都昌县','1285');
INSERT INTO ts_area VALUES ('1295','湖口县','1285');
INSERT INTO ts_area VALUES ('1296','彭泽县','1285');
INSERT INTO ts_area VALUES ('1297','瑞昌市','1285');
INSERT INTO ts_area VALUES ('1298','新余市','1263');
INSERT INTO ts_area VALUES ('1299','渝水区','1298');
INSERT INTO ts_area VALUES ('1300','分宜县','1298');
INSERT INTO ts_area VALUES ('1301','鹰潭市','1263');
INSERT INTO ts_area VALUES ('1302','月湖区','1301');
INSERT INTO ts_area VALUES ('1303','余江县','1301');
INSERT INTO ts_area VALUES ('1304','贵溪市','1301');
INSERT INTO ts_area VALUES ('1305','赣州市','1263');
INSERT INTO ts_area VALUES ('1306','章贡区','1305');
INSERT INTO ts_area VALUES ('1307','赣县','1305');
INSERT INTO ts_area VALUES ('1308','信丰县','1305');
INSERT INTO ts_area VALUES ('1309','大余县','1305');
INSERT INTO ts_area VALUES ('1310','上犹县','1305');
INSERT INTO ts_area VALUES ('1311','崇义县','1305');
INSERT INTO ts_area VALUES ('1312','安远县','1305');
INSERT INTO ts_area VALUES ('1313','龙南县','1305');
INSERT INTO ts_area VALUES ('1314','定南县','1305');
INSERT INTO ts_area VALUES ('1315','全南县','1305');
INSERT INTO ts_area VALUES ('1316','宁都县','1305');
INSERT INTO ts_area VALUES ('1317','于都县','1305');
INSERT INTO ts_area VALUES ('1318','兴国县','1305');
INSERT INTO ts_area VALUES ('1319','会昌县','1305');
INSERT INTO ts_area VALUES ('1320','寻乌县','1305');
INSERT INTO ts_area VALUES ('1321','石城县','1305');
INSERT INTO ts_area VALUES ('1322','瑞金市','1305');
INSERT INTO ts_area VALUES ('1323','南康市','1305');
INSERT INTO ts_area VALUES ('1324','吉安市','1263');
INSERT INTO ts_area VALUES ('1325','吉州区','1324');
INSERT INTO ts_area VALUES ('1326','青原区','1324');
INSERT INTO ts_area VALUES ('1327','吉安县','1324');
INSERT INTO ts_area VALUES ('1328','吉水县','1324');
INSERT INTO ts_area VALUES ('1329','峡江县','1324');
INSERT INTO ts_area VALUES ('1330','新干县','1324');
INSERT INTO ts_area VALUES ('1331','永丰县','1324');
INSERT INTO ts_area VALUES ('1332','泰和县','1324');
INSERT INTO ts_area VALUES ('1333','遂川县','1324');
INSERT INTO ts_area VALUES ('1334','万安县','1324');
INSERT INTO ts_area VALUES ('1335','安福县','1324');
INSERT INTO ts_area VALUES ('1336','永新县','1324');
INSERT INTO ts_area VALUES ('1337','井冈山市','1324');
INSERT INTO ts_area VALUES ('1338','宜春市','1263');
INSERT INTO ts_area VALUES ('1339','袁州区','1338');
INSERT INTO ts_area VALUES ('1340','奉新县','1338');
INSERT INTO ts_area VALUES ('1341','万载县','1338');
INSERT INTO ts_area VALUES ('1342','上高县','1338');
INSERT INTO ts_area VALUES ('1343','宜丰县','1338');
INSERT INTO ts_area VALUES ('1344','靖安县','1338');
INSERT INTO ts_area VALUES ('1345','铜鼓县','1338');
INSERT INTO ts_area VALUES ('1346','丰城市','1338');
INSERT INTO ts_area VALUES ('1347','樟树市','1338');
INSERT INTO ts_area VALUES ('1348','高安市','1338');
INSERT INTO ts_area VALUES ('1349','抚州市','1263');
INSERT INTO ts_area VALUES ('1350','临川区','1349');
INSERT INTO ts_area VALUES ('1351','南城县','1349');
INSERT INTO ts_area VALUES ('1352','黎川县','1349');
INSERT INTO ts_area VALUES ('1353','南丰县','1349');
INSERT INTO ts_area VALUES ('1354','崇仁县','1349');
INSERT INTO ts_area VALUES ('1355','乐安县','1349');
INSERT INTO ts_area VALUES ('1356','宜黄县','1349');
INSERT INTO ts_area VALUES ('1357','金溪县','1349');
INSERT INTO ts_area VALUES ('1358','资溪县','1349');
INSERT INTO ts_area VALUES ('1359','东乡县','1349');
INSERT INTO ts_area VALUES ('1360','广昌县','1349');
INSERT INTO ts_area VALUES ('1361','上饶市','1263');
INSERT INTO ts_area VALUES ('1362','信州区','1361');
INSERT INTO ts_area VALUES ('1363','上饶县','1361');
INSERT INTO ts_area VALUES ('1364','广丰县','1361');
INSERT INTO ts_area VALUES ('1365','玉山县','1361');
INSERT INTO ts_area VALUES ('1366','铅山县','1361');
INSERT INTO ts_area VALUES ('1367','横峰县','1361');
INSERT INTO ts_area VALUES ('1368','弋阳县','1361');
INSERT INTO ts_area VALUES ('1369','余干县','1361');
INSERT INTO ts_area VALUES ('1370','鄱阳县','1361');
INSERT INTO ts_area VALUES ('1371','万年县','1361');
INSERT INTO ts_area VALUES ('1372','婺源县','1361');
INSERT INTO ts_area VALUES ('1373','德兴市','1361');
INSERT INTO ts_area VALUES ('1374','山东','0');
INSERT INTO ts_area VALUES ('1375','济南市','1374');
INSERT INTO ts_area VALUES ('1376','历下区','1375');
INSERT INTO ts_area VALUES ('1377','市中区','1375');
INSERT INTO ts_area VALUES ('1378','槐荫区','1375');
INSERT INTO ts_area VALUES ('1379','天桥区','1375');
INSERT INTO ts_area VALUES ('1380','历城区','1375');
INSERT INTO ts_area VALUES ('1381','长清区','1375');
INSERT INTO ts_area VALUES ('1382','平阴县','1375');
INSERT INTO ts_area VALUES ('1383','济阳县','1375');
INSERT INTO ts_area VALUES ('1384','商河县','1375');
INSERT INTO ts_area VALUES ('1385','章丘市','1375');
INSERT INTO ts_area VALUES ('1386','青岛市','1374');
INSERT INTO ts_area VALUES ('1387','市南区','1386');
INSERT INTO ts_area VALUES ('1388','市北区','1386');
INSERT INTO ts_area VALUES ('1389','四方区','1386');
INSERT INTO ts_area VALUES ('1390','黄岛区','1386');
INSERT INTO ts_area VALUES ('1391','崂山区','1386');
INSERT INTO ts_area VALUES ('1392','李沧区','1386');
INSERT INTO ts_area VALUES ('1393','城阳区','1386');
INSERT INTO ts_area VALUES ('1394','胶州市','1386');
INSERT INTO ts_area VALUES ('1395','即墨市','1386');
INSERT INTO ts_area VALUES ('1396','平度市','1386');
INSERT INTO ts_area VALUES ('1397','胶南市','1386');
INSERT INTO ts_area VALUES ('1398','莱西市','1386');
INSERT INTO ts_area VALUES ('1399','淄博市','1374');
INSERT INTO ts_area VALUES ('1400','淄川区','1399');
INSERT INTO ts_area VALUES ('1401','张店区','1399');
INSERT INTO ts_area VALUES ('1402','博山区','1399');
INSERT INTO ts_area VALUES ('1403','临淄区','1399');
INSERT INTO ts_area VALUES ('1404','周村区','1399');
INSERT INTO ts_area VALUES ('1405','桓台县','1399');
INSERT INTO ts_area VALUES ('1406','高青县','1399');
INSERT INTO ts_area VALUES ('1407','沂源县','1399');
INSERT INTO ts_area VALUES ('1408','枣庄市','1374');
INSERT INTO ts_area VALUES ('1409','市中区','1408');
INSERT INTO ts_area VALUES ('1410','薛城区','1408');
INSERT INTO ts_area VALUES ('1411','峄城区','1408');
INSERT INTO ts_area VALUES ('1412','台儿庄区','1408');
INSERT INTO ts_area VALUES ('1413','山亭区','1408');
INSERT INTO ts_area VALUES ('1414','滕州市','1408');
INSERT INTO ts_area VALUES ('1415','东营市','1374');
INSERT INTO ts_area VALUES ('1416','东营区','1415');
INSERT INTO ts_area VALUES ('1417','河口区','1415');
INSERT INTO ts_area VALUES ('1418','垦利县','1415');
INSERT INTO ts_area VALUES ('1419','利津县','1415');
INSERT INTO ts_area VALUES ('1420','广饶县','1415');
INSERT INTO ts_area VALUES ('1421','烟台市','1374');
INSERT INTO ts_area VALUES ('1422','芝罘区','1421');
INSERT INTO ts_area VALUES ('1423','福山区','1421');
INSERT INTO ts_area VALUES ('1424','牟平区','1421');
INSERT INTO ts_area VALUES ('1425','莱山区','1421');
INSERT INTO ts_area VALUES ('1426','长岛县','1421');
INSERT INTO ts_area VALUES ('1427','龙口市','1421');
INSERT INTO ts_area VALUES ('1428','莱阳市','1421');
INSERT INTO ts_area VALUES ('1429','莱州市','1421');
INSERT INTO ts_area VALUES ('1430','蓬莱市','1421');
INSERT INTO ts_area VALUES ('1431','招远市','1421');
INSERT INTO ts_area VALUES ('1432','栖霞市','1421');
INSERT INTO ts_area VALUES ('1433','海阳市','1421');
INSERT INTO ts_area VALUES ('1434','潍坊市','1374');
INSERT INTO ts_area VALUES ('1435','潍城区','1434');
INSERT INTO ts_area VALUES ('1436','寒亭区','1434');
INSERT INTO ts_area VALUES ('1437','坊子区','1434');
INSERT INTO ts_area VALUES ('1438','奎文区','1434');
INSERT INTO ts_area VALUES ('1439','临朐县','1434');
INSERT INTO ts_area VALUES ('1440','昌乐县','1434');
INSERT INTO ts_area VALUES ('1441','青州市','1434');
INSERT INTO ts_area VALUES ('1442','诸城市','1434');
INSERT INTO ts_area VALUES ('1443','寿光市','1434');
INSERT INTO ts_area VALUES ('1444','安丘市','1434');
INSERT INTO ts_area VALUES ('1445','高密市','1434');
INSERT INTO ts_area VALUES ('1446','昌邑市','1434');
INSERT INTO ts_area VALUES ('1447','济宁市','1374');
INSERT INTO ts_area VALUES ('1448','市中区','1447');
INSERT INTO ts_area VALUES ('1449','任城区','1447');
INSERT INTO ts_area VALUES ('1450','微山县','1447');
INSERT INTO ts_area VALUES ('1451','鱼台县','1447');
INSERT INTO ts_area VALUES ('1452','金乡县','1447');
INSERT INTO ts_area VALUES ('1453','嘉祥县','1447');
INSERT INTO ts_area VALUES ('1454','汶上县','1447');
INSERT INTO ts_area VALUES ('1455','泗水县','1447');
INSERT INTO ts_area VALUES ('1456','梁山县','1447');
INSERT INTO ts_area VALUES ('1457','曲阜市','1447');
INSERT INTO ts_area VALUES ('1458','兖州市','1447');
INSERT INTO ts_area VALUES ('1459','邹城市','1447');
INSERT INTO ts_area VALUES ('1460','泰安市','1374');
INSERT INTO ts_area VALUES ('1461','泰山区','1460');
INSERT INTO ts_area VALUES ('1462','岱岳区','1460');
INSERT INTO ts_area VALUES ('1463','宁阳县','1460');
INSERT INTO ts_area VALUES ('1464','东平县','1460');
INSERT INTO ts_area VALUES ('1465','新泰市','1460');
INSERT INTO ts_area VALUES ('1466','肥城市','1460');
INSERT INTO ts_area VALUES ('1467','威海市','1374');
INSERT INTO ts_area VALUES ('1468','环翠区','1467');
INSERT INTO ts_area VALUES ('1469','文登市','1467');
INSERT INTO ts_area VALUES ('1470','荣成市','1467');
INSERT INTO ts_area VALUES ('1471','乳山市','1467');
INSERT INTO ts_area VALUES ('1472','日照市','1374');
INSERT INTO ts_area VALUES ('1473','东港区','1472');
INSERT INTO ts_area VALUES ('1474','岚山区','1472');
INSERT INTO ts_area VALUES ('1475','五莲县','1472');
INSERT INTO ts_area VALUES ('1476','莒县','1472');
INSERT INTO ts_area VALUES ('1477','莱芜市','1374');
INSERT INTO ts_area VALUES ('1478','莱城区','1477');
INSERT INTO ts_area VALUES ('1479','钢城区','1477');
INSERT INTO ts_area VALUES ('1480','临沂市','1374');
INSERT INTO ts_area VALUES ('1481','兰山区','1480');
INSERT INTO ts_area VALUES ('1482','罗庄区','1480');
INSERT INTO ts_area VALUES ('1483','河东区','1480');
INSERT INTO ts_area VALUES ('1484','沂南县','1480');
INSERT INTO ts_area VALUES ('1485','郯城县','1480');
INSERT INTO ts_area VALUES ('1486','沂水县','1480');
INSERT INTO ts_area VALUES ('1487','苍山县','1480');
INSERT INTO ts_area VALUES ('1488','费县','1480');
INSERT INTO ts_area VALUES ('1489','平邑县','1480');
INSERT INTO ts_area VALUES ('1490','莒南县','1480');
INSERT INTO ts_area VALUES ('1491','蒙阴县','1480');
INSERT INTO ts_area VALUES ('1492','临沭县','1480');
INSERT INTO ts_area VALUES ('1493','德州市','1374');
INSERT INTO ts_area VALUES ('1494','德城区','1493');
INSERT INTO ts_area VALUES ('1495','陵县','1493');
INSERT INTO ts_area VALUES ('1496','宁津县','1493');
INSERT INTO ts_area VALUES ('1497','庆云县','1493');
INSERT INTO ts_area VALUES ('1498','临邑县','1493');
INSERT INTO ts_area VALUES ('1499','齐河县','1493');
INSERT INTO ts_area VALUES ('1500','平原县','1493');
INSERT INTO ts_area VALUES ('1501','夏津县','1493');
INSERT INTO ts_area VALUES ('1502','武城县','1493');
INSERT INTO ts_area VALUES ('1503','乐陵市','1493');
INSERT INTO ts_area VALUES ('1504','禹城市','1493');
INSERT INTO ts_area VALUES ('1505','聊城市','1374');
INSERT INTO ts_area VALUES ('1506','东昌府区','1505');
INSERT INTO ts_area VALUES ('1507','阳谷县','1505');
INSERT INTO ts_area VALUES ('1508','莘县','1505');
INSERT INTO ts_area VALUES ('1509','茌平县','1505');
INSERT INTO ts_area VALUES ('1510','东阿县','1505');
INSERT INTO ts_area VALUES ('1511','冠县','1505');
INSERT INTO ts_area VALUES ('1512','高唐县','1505');
INSERT INTO ts_area VALUES ('1513','临清市','1505');
INSERT INTO ts_area VALUES ('1514','滨州市','1374');
INSERT INTO ts_area VALUES ('1515','滨城区','1514');
INSERT INTO ts_area VALUES ('1516','惠民县','1514');
INSERT INTO ts_area VALUES ('1517','阳信县','1514');
INSERT INTO ts_area VALUES ('1518','无棣县','1514');
INSERT INTO ts_area VALUES ('1519','沾化县','1514');
INSERT INTO ts_area VALUES ('1520','博兴县','1514');
INSERT INTO ts_area VALUES ('1521','邹平县','1514');
INSERT INTO ts_area VALUES ('1522','菏泽市','1374');
INSERT INTO ts_area VALUES ('1523','牡丹区','1522');
INSERT INTO ts_area VALUES ('1524','曹县','1522');
INSERT INTO ts_area VALUES ('1525','单县','1522');
INSERT INTO ts_area VALUES ('1526','成武县','1522');
INSERT INTO ts_area VALUES ('1527','巨野县','1522');
INSERT INTO ts_area VALUES ('1528','郓城县','1522');
INSERT INTO ts_area VALUES ('1529','鄄城县','1522');
INSERT INTO ts_area VALUES ('1530','定陶县','1522');
INSERT INTO ts_area VALUES ('1531','东明县','1522');
INSERT INTO ts_area VALUES ('1532','河南','0');
INSERT INTO ts_area VALUES ('1533','郑州市','1532');
INSERT INTO ts_area VALUES ('1534','中原区','1533');
INSERT INTO ts_area VALUES ('1535','二七区','1533');
INSERT INTO ts_area VALUES ('1536','管城回族区','1533');
INSERT INTO ts_area VALUES ('1537','金水区','1533');
INSERT INTO ts_area VALUES ('1538','上街区','1533');
INSERT INTO ts_area VALUES ('1539','惠济区','1533');
INSERT INTO ts_area VALUES ('1540','中牟县','1533');
INSERT INTO ts_area VALUES ('1541','巩义市','1533');
INSERT INTO ts_area VALUES ('1542','荥阳市','1533');
INSERT INTO ts_area VALUES ('1543','新密市','1533');
INSERT INTO ts_area VALUES ('1544','新郑市','1533');
INSERT INTO ts_area VALUES ('1545','登封市','1533');
INSERT INTO ts_area VALUES ('1546','开封市','1532');
INSERT INTO ts_area VALUES ('1547','龙亭区','1546');
INSERT INTO ts_area VALUES ('1548','顺河回族区','1546');
INSERT INTO ts_area VALUES ('1549','鼓楼区','1546');
INSERT INTO ts_area VALUES ('1550','禹王台区','1546');
INSERT INTO ts_area VALUES ('1551','金明区','1546');
INSERT INTO ts_area VALUES ('1552','杞县','1546');
INSERT INTO ts_area VALUES ('1553','通许县','1546');
INSERT INTO ts_area VALUES ('1554','尉氏县','1546');
INSERT INTO ts_area VALUES ('1555','开封县','1546');
INSERT INTO ts_area VALUES ('1556','兰考县','1546');
INSERT INTO ts_area VALUES ('1557','洛阳市','1532');
INSERT INTO ts_area VALUES ('1558','老城区','1557');
INSERT INTO ts_area VALUES ('1559','西工区','1557');
INSERT INTO ts_area VALUES ('1560','瀍河回族区','1557');
INSERT INTO ts_area VALUES ('1561','涧西区','1557');
INSERT INTO ts_area VALUES ('1562','吉利区','1557');
INSERT INTO ts_area VALUES ('1563','洛龙区','1557');
INSERT INTO ts_area VALUES ('1564','孟津县','1557');
INSERT INTO ts_area VALUES ('1565','新安县','1557');
INSERT INTO ts_area VALUES ('1566','栾川县','1557');
INSERT INTO ts_area VALUES ('1567','嵩县','1557');
INSERT INTO ts_area VALUES ('1568','汝阳县','1557');
INSERT INTO ts_area VALUES ('1569','宜阳县','1557');
INSERT INTO ts_area VALUES ('1570','洛宁县','1557');
INSERT INTO ts_area VALUES ('1571','伊川县','1557');
INSERT INTO ts_area VALUES ('1572','偃师市','1557');
INSERT INTO ts_area VALUES ('1573','平顶山市','1532');
INSERT INTO ts_area VALUES ('1574','新华区','1573');
INSERT INTO ts_area VALUES ('1575','卫东区','1573');
INSERT INTO ts_area VALUES ('1576','石龙区','1573');
INSERT INTO ts_area VALUES ('1577','湛河区','1573');
INSERT INTO ts_area VALUES ('1578','宝丰县','1573');
INSERT INTO ts_area VALUES ('1579','叶县','1573');
INSERT INTO ts_area VALUES ('1580','鲁山县','1573');
INSERT INTO ts_area VALUES ('1581','郏县','1573');
INSERT INTO ts_area VALUES ('1582','舞钢市','1573');
INSERT INTO ts_area VALUES ('1583','汝州市','1573');
INSERT INTO ts_area VALUES ('1584','安阳市','1532');
INSERT INTO ts_area VALUES ('1585','文峰区','1584');
INSERT INTO ts_area VALUES ('1586','北关区','1584');
INSERT INTO ts_area VALUES ('1587','殷都区','1584');
INSERT INTO ts_area VALUES ('1588','龙安区','1584');
INSERT INTO ts_area VALUES ('1589','安阳县','1584');
INSERT INTO ts_area VALUES ('1590','汤阴县','1584');
INSERT INTO ts_area VALUES ('1591','滑县','1584');
INSERT INTO ts_area VALUES ('1592','内黄县','1584');
INSERT INTO ts_area VALUES ('1593','林州市','1584');
INSERT INTO ts_area VALUES ('1594','鹤壁市','1532');
INSERT INTO ts_area VALUES ('1595','鹤山区','1594');
INSERT INTO ts_area VALUES ('1596','山城区','1594');
INSERT INTO ts_area VALUES ('1597','淇滨区','1594');
INSERT INTO ts_area VALUES ('1598','浚县','1594');
INSERT INTO ts_area VALUES ('1599','淇县','1594');
INSERT INTO ts_area VALUES ('1600','新乡市','1532');
INSERT INTO ts_area VALUES ('1601','红旗区','1600');
INSERT INTO ts_area VALUES ('1602','卫滨区','1600');
INSERT INTO ts_area VALUES ('1603','凤泉区','1600');
INSERT INTO ts_area VALUES ('1604','牧野区','1600');
INSERT INTO ts_area VALUES ('1605','新乡县','1600');
INSERT INTO ts_area VALUES ('1606','获嘉县','1600');
INSERT INTO ts_area VALUES ('1607','原阳县','1600');
INSERT INTO ts_area VALUES ('1608','延津县','1600');
INSERT INTO ts_area VALUES ('1609','封丘县','1600');
INSERT INTO ts_area VALUES ('1610','长垣县','1600');
INSERT INTO ts_area VALUES ('1611','卫辉市','1600');
INSERT INTO ts_area VALUES ('1612','辉县市','1600');
INSERT INTO ts_area VALUES ('1613','焦作市','1532');
INSERT INTO ts_area VALUES ('1614','解放区','1613');
INSERT INTO ts_area VALUES ('1615','中站区','1613');
INSERT INTO ts_area VALUES ('1616','马村区','1613');
INSERT INTO ts_area VALUES ('1617','山阳区','1613');
INSERT INTO ts_area VALUES ('1618','修武县','1613');
INSERT INTO ts_area VALUES ('1619','博爱县','1613');
INSERT INTO ts_area VALUES ('1620','武陟县','1613');
INSERT INTO ts_area VALUES ('1621','温县','1613');
INSERT INTO ts_area VALUES ('1622','济源市','1613');
INSERT INTO ts_area VALUES ('1623','沁阳市','1613');
INSERT INTO ts_area VALUES ('1624','孟州市','1613');
INSERT INTO ts_area VALUES ('1625','濮阳市','1532');
INSERT INTO ts_area VALUES ('1626','华龙区','1625');
INSERT INTO ts_area VALUES ('1627','清丰县','1625');
INSERT INTO ts_area VALUES ('1628','南乐县','1625');
INSERT INTO ts_area VALUES ('1629','范县','1625');
INSERT INTO ts_area VALUES ('1630','台前县','1625');
INSERT INTO ts_area VALUES ('1631','濮阳县','1625');
INSERT INTO ts_area VALUES ('1632','许昌市','1532');
INSERT INTO ts_area VALUES ('1633','魏都区','1632');
INSERT INTO ts_area VALUES ('1634','许昌县','1632');
INSERT INTO ts_area VALUES ('1635','鄢陵县','1632');
INSERT INTO ts_area VALUES ('1636','襄城县','1632');
INSERT INTO ts_area VALUES ('1637','禹州市','1632');
INSERT INTO ts_area VALUES ('1638','长葛市','1632');
INSERT INTO ts_area VALUES ('1639','漯河市','1532');
INSERT INTO ts_area VALUES ('1640','源汇区','1639');
INSERT INTO ts_area VALUES ('1641','郾城区','1639');
INSERT INTO ts_area VALUES ('1642','召陵区','1639');
INSERT INTO ts_area VALUES ('1643','舞阳县','1639');
INSERT INTO ts_area VALUES ('1644','临颍县','1639');
INSERT INTO ts_area VALUES ('1645','三门峡市','1532');
INSERT INTO ts_area VALUES ('1646','湖滨区','1645');
INSERT INTO ts_area VALUES ('1647','渑池县','1645');
INSERT INTO ts_area VALUES ('1648','陕县','1645');
INSERT INTO ts_area VALUES ('1649','卢氏县','1645');
INSERT INTO ts_area VALUES ('1650','义马市','1645');
INSERT INTO ts_area VALUES ('1651','灵宝市','1645');
INSERT INTO ts_area VALUES ('1652','南阳市','1532');
INSERT INTO ts_area VALUES ('1653','宛城区','1652');
INSERT INTO ts_area VALUES ('1654','卧龙区','1652');
INSERT INTO ts_area VALUES ('1655','南召县','1652');
INSERT INTO ts_area VALUES ('1656','方城县','1652');
INSERT INTO ts_area VALUES ('1657','西峡县','1652');
INSERT INTO ts_area VALUES ('1658','镇平县','1652');
INSERT INTO ts_area VALUES ('1659','内乡县','1652');
INSERT INTO ts_area VALUES ('1660','淅川县','1652');
INSERT INTO ts_area VALUES ('1661','社旗县','1652');
INSERT INTO ts_area VALUES ('1662','唐河县','1652');
INSERT INTO ts_area VALUES ('1663','新野县','1652');
INSERT INTO ts_area VALUES ('1664','桐柏县','1652');
INSERT INTO ts_area VALUES ('1665','邓州市','1652');
INSERT INTO ts_area VALUES ('1666','商丘市','1532');
INSERT INTO ts_area VALUES ('1667','梁园区','1666');
INSERT INTO ts_area VALUES ('1668','睢阳区','1666');
INSERT INTO ts_area VALUES ('1669','民权县','1666');
INSERT INTO ts_area VALUES ('1670','睢县','1666');
INSERT INTO ts_area VALUES ('1671','宁陵县','1666');
INSERT INTO ts_area VALUES ('1672','柘城县','1666');
INSERT INTO ts_area VALUES ('1673','虞城县','1666');
INSERT INTO ts_area VALUES ('1674','夏邑县','1666');
INSERT INTO ts_area VALUES ('1675','永城市','1666');
INSERT INTO ts_area VALUES ('1676','信阳市','1532');
INSERT INTO ts_area VALUES ('1677','浉河区','1676');
INSERT INTO ts_area VALUES ('1678','平桥区','1676');
INSERT INTO ts_area VALUES ('1679','罗山县','1676');
INSERT INTO ts_area VALUES ('1680','光山县','1676');
INSERT INTO ts_area VALUES ('1681','新县','1676');
INSERT INTO ts_area VALUES ('1682','商城县','1676');
INSERT INTO ts_area VALUES ('1683','固始县','1676');
INSERT INTO ts_area VALUES ('1684','潢川县','1676');
INSERT INTO ts_area VALUES ('1685','淮滨县','1676');
INSERT INTO ts_area VALUES ('1686','息县','1676');
INSERT INTO ts_area VALUES ('1687','周口市','1532');
INSERT INTO ts_area VALUES ('1688','川汇区','1687');
INSERT INTO ts_area VALUES ('1689','扶沟县','1687');
INSERT INTO ts_area VALUES ('1690','西华县','1687');
INSERT INTO ts_area VALUES ('1691','商水县','1687');
INSERT INTO ts_area VALUES ('1692','沈丘县','1687');
INSERT INTO ts_area VALUES ('1693','郸城县','1687');
INSERT INTO ts_area VALUES ('1694','淮阳县','1687');
INSERT INTO ts_area VALUES ('1695','太康县','1687');
INSERT INTO ts_area VALUES ('1696','鹿邑县','1687');
INSERT INTO ts_area VALUES ('1697','项城市','1687');
INSERT INTO ts_area VALUES ('1698','驻马店市','1532');
INSERT INTO ts_area VALUES ('1699','驿城区','1698');
INSERT INTO ts_area VALUES ('1700','西平县','1698');
INSERT INTO ts_area VALUES ('1701','上蔡县','1698');
INSERT INTO ts_area VALUES ('1702','平舆县','1698');
INSERT INTO ts_area VALUES ('1703','正阳县','1698');
INSERT INTO ts_area VALUES ('1704','确山县','1698');
INSERT INTO ts_area VALUES ('1705','泌阳县','1698');
INSERT INTO ts_area VALUES ('1706','汝南县','1698');
INSERT INTO ts_area VALUES ('1707','遂平县','1698');
INSERT INTO ts_area VALUES ('1708','新蔡县','1698');
INSERT INTO ts_area VALUES ('1709','湖北','0');
INSERT INTO ts_area VALUES ('1710','武汉市','1709');
INSERT INTO ts_area VALUES ('1711','江岸区','1710');
INSERT INTO ts_area VALUES ('1712','江汉区','1710');
INSERT INTO ts_area VALUES ('1713','硚口区','1710');
INSERT INTO ts_area VALUES ('1714','汉阳区','1710');
INSERT INTO ts_area VALUES ('1715','武昌区','1710');
INSERT INTO ts_area VALUES ('1716','青山区','1710');
INSERT INTO ts_area VALUES ('1717','洪山区','1710');
INSERT INTO ts_area VALUES ('1718','东西湖区','1710');
INSERT INTO ts_area VALUES ('1719','汉南区','1710');
INSERT INTO ts_area VALUES ('1720','蔡甸区','1710');
INSERT INTO ts_area VALUES ('1721','江夏区','1710');
INSERT INTO ts_area VALUES ('1722','黄陂区','1710');
INSERT INTO ts_area VALUES ('1723','新洲区','1710');
INSERT INTO ts_area VALUES ('1724','黄石市','1709');
INSERT INTO ts_area VALUES ('1725','黄石港区','1724');
INSERT INTO ts_area VALUES ('1726','西塞山区','1724');
INSERT INTO ts_area VALUES ('1727','下陆区','1724');
INSERT INTO ts_area VALUES ('1728','铁山区','1724');
INSERT INTO ts_area VALUES ('1729','阳新县','1724');
INSERT INTO ts_area VALUES ('1730','大冶市','1724');
INSERT INTO ts_area VALUES ('1731','十堰市','1709');
INSERT INTO ts_area VALUES ('1732','茅箭区','1731');
INSERT INTO ts_area VALUES ('1733','张湾区','1731');
INSERT INTO ts_area VALUES ('1734','郧县','1731');
INSERT INTO ts_area VALUES ('1735','郧西县','1731');
INSERT INTO ts_area VALUES ('1736','竹山县','1731');
INSERT INTO ts_area VALUES ('1737','竹溪县','1731');
INSERT INTO ts_area VALUES ('1738','房县','1731');
INSERT INTO ts_area VALUES ('1739','丹江口市','1731');
INSERT INTO ts_area VALUES ('1740','宜昌市','1709');
INSERT INTO ts_area VALUES ('1741','西陵区','1740');
INSERT INTO ts_area VALUES ('1742','伍家岗区','1740');
INSERT INTO ts_area VALUES ('1743','点军区','1740');
INSERT INTO ts_area VALUES ('1744','猇亭区','1740');
INSERT INTO ts_area VALUES ('1745','夷陵区','1740');
INSERT INTO ts_area VALUES ('1746','远安县','1740');
INSERT INTO ts_area VALUES ('1747','兴山县','1740');
INSERT INTO ts_area VALUES ('1748','秭归县','1740');
INSERT INTO ts_area VALUES ('1749','长阳土家族自治县','1740');
INSERT INTO ts_area VALUES ('1750','五峰土家族自治县','1740');
INSERT INTO ts_area VALUES ('1751','宜都市','1740');
INSERT INTO ts_area VALUES ('1752','当阳市','1740');
INSERT INTO ts_area VALUES ('1753','枝江市','1740');
INSERT INTO ts_area VALUES ('1754','襄樊市','1709');
INSERT INTO ts_area VALUES ('1755','襄城区','1754');
INSERT INTO ts_area VALUES ('1756','樊城区','1754');
INSERT INTO ts_area VALUES ('1757','襄阳区','1754');
INSERT INTO ts_area VALUES ('1758','南漳县','1754');
INSERT INTO ts_area VALUES ('1759','谷城县','1754');
INSERT INTO ts_area VALUES ('1760','保康县','1754');
INSERT INTO ts_area VALUES ('1761','老河口市','1754');
INSERT INTO ts_area VALUES ('1762','枣阳市','1754');
INSERT INTO ts_area VALUES ('1763','宜城市','1754');
INSERT INTO ts_area VALUES ('1764','鄂州市','1709');
INSERT INTO ts_area VALUES ('1765','梁子湖区','1764');
INSERT INTO ts_area VALUES ('1766','华容区','1764');
INSERT INTO ts_area VALUES ('1767','鄂城区','1764');
INSERT INTO ts_area VALUES ('1768','荆门市','1709');
INSERT INTO ts_area VALUES ('1769','东宝区','1768');
INSERT INTO ts_area VALUES ('1770','掇刀区','1768');
INSERT INTO ts_area VALUES ('1771','京山县','1768');
INSERT INTO ts_area VALUES ('1772','沙洋县','1768');
INSERT INTO ts_area VALUES ('1773','钟祥市','1768');
INSERT INTO ts_area VALUES ('1774','孝感市','1709');
INSERT INTO ts_area VALUES ('1775','孝南区','1774');
INSERT INTO ts_area VALUES ('1776','孝昌县','1774');
INSERT INTO ts_area VALUES ('1777','大悟县','1774');
INSERT INTO ts_area VALUES ('1778','云梦县','1774');
INSERT INTO ts_area VALUES ('1779','应城市','1774');
INSERT INTO ts_area VALUES ('1780','安陆市','1774');
INSERT INTO ts_area VALUES ('1781','汉川市','1774');
INSERT INTO ts_area VALUES ('1782','荆州市','1709');
INSERT INTO ts_area VALUES ('1783','沙市区','1782');
INSERT INTO ts_area VALUES ('1784','荆州区','1782');
INSERT INTO ts_area VALUES ('1785','公安县','1782');
INSERT INTO ts_area VALUES ('1786','监利县','1782');
INSERT INTO ts_area VALUES ('1787','江陵县','1782');
INSERT INTO ts_area VALUES ('1788','石首市','1782');
INSERT INTO ts_area VALUES ('1789','洪湖市','1782');
INSERT INTO ts_area VALUES ('1790','松滋市','1782');
INSERT INTO ts_area VALUES ('1791','黄冈市','1709');
INSERT INTO ts_area VALUES ('1792','黄州区','1791');
INSERT INTO ts_area VALUES ('1793','团风县','1791');
INSERT INTO ts_area VALUES ('1794','红安县','1791');
INSERT INTO ts_area VALUES ('1795','罗田县','1791');
INSERT INTO ts_area VALUES ('1796','英山县','1791');
INSERT INTO ts_area VALUES ('1797','浠水县','1791');
INSERT INTO ts_area VALUES ('1798','蕲春县','1791');
INSERT INTO ts_area VALUES ('1799','黄梅县','1791');
INSERT INTO ts_area VALUES ('1800','麻城市','1791');
INSERT INTO ts_area VALUES ('1801','武穴市','1791');
INSERT INTO ts_area VALUES ('1802','咸宁市','1709');
INSERT INTO ts_area VALUES ('1803','咸安区','1802');
INSERT INTO ts_area VALUES ('1804','嘉鱼县','1802');
INSERT INTO ts_area VALUES ('1805','通城县','1802');
INSERT INTO ts_area VALUES ('1806','崇阳县','1802');
INSERT INTO ts_area VALUES ('1807','通山县','1802');
INSERT INTO ts_area VALUES ('1808','赤壁市','1802');
INSERT INTO ts_area VALUES ('1809','随州市','1709');
INSERT INTO ts_area VALUES ('1810','曾都区','1809');
INSERT INTO ts_area VALUES ('1811','广水市','1809');
INSERT INTO ts_area VALUES ('1812','恩施土家族苗族自治州','1709');
INSERT INTO ts_area VALUES ('1813','恩施市','1812');
INSERT INTO ts_area VALUES ('1814','利川市','1812');
INSERT INTO ts_area VALUES ('1815','建始县','1812');
INSERT INTO ts_area VALUES ('1816','巴东县','1812');
INSERT INTO ts_area VALUES ('1817','宣恩县','1812');
INSERT INTO ts_area VALUES ('1818','咸丰县','1812');
INSERT INTO ts_area VALUES ('1819','来凤县','1812');
INSERT INTO ts_area VALUES ('1820','鹤峰县','1812');
INSERT INTO ts_area VALUES ('1821','省直辖县级行政单位','1709');
INSERT INTO ts_area VALUES ('1822','仙桃市','1821');
INSERT INTO ts_area VALUES ('1823','潜江市','1821');
INSERT INTO ts_area VALUES ('1824','天门市','1821');
INSERT INTO ts_area VALUES ('1825','神农架林区','1821');
INSERT INTO ts_area VALUES ('1826','湖南','0');
INSERT INTO ts_area VALUES ('1827','长沙市','1826');
INSERT INTO ts_area VALUES ('1828','芙蓉区','1827');
INSERT INTO ts_area VALUES ('1829','天心区','1827');
INSERT INTO ts_area VALUES ('1830','岳麓区','1827');
INSERT INTO ts_area VALUES ('1831','开福区','1827');
INSERT INTO ts_area VALUES ('1832','雨花区','1827');
INSERT INTO ts_area VALUES ('1833','长沙县','1827');
INSERT INTO ts_area VALUES ('1834','望城县','1827');
INSERT INTO ts_area VALUES ('1835','宁乡县','1827');
INSERT INTO ts_area VALUES ('1836','浏阳市','1827');
INSERT INTO ts_area VALUES ('1837','株洲市','1826');
INSERT INTO ts_area VALUES ('1838','荷塘区','1837');
INSERT INTO ts_area VALUES ('1839','芦淞区','1837');
INSERT INTO ts_area VALUES ('1840','石峰区','1837');
INSERT INTO ts_area VALUES ('1841','天元区','1837');
INSERT INTO ts_area VALUES ('1842','株洲县','1837');
INSERT INTO ts_area VALUES ('1843','攸县','1837');
INSERT INTO ts_area VALUES ('1844','茶陵县','1837');
INSERT INTO ts_area VALUES ('1845','炎陵县','1837');
INSERT INTO ts_area VALUES ('1846','醴陵市','1837');
INSERT INTO ts_area VALUES ('1847','湘潭市','1826');
INSERT INTO ts_area VALUES ('1848','雨湖区','1847');
INSERT INTO ts_area VALUES ('1849','岳塘区','1847');
INSERT INTO ts_area VALUES ('1850','湘潭县','1847');
INSERT INTO ts_area VALUES ('1851','湘乡市','1847');
INSERT INTO ts_area VALUES ('1852','韶山市','1847');
INSERT INTO ts_area VALUES ('1853','衡阳市','1826');
INSERT INTO ts_area VALUES ('1854','珠晖区','1853');
INSERT INTO ts_area VALUES ('1855','雁峰区','1853');
INSERT INTO ts_area VALUES ('1856','石鼓区','1853');
INSERT INTO ts_area VALUES ('1857','蒸湘区','1853');
INSERT INTO ts_area VALUES ('1858','南岳区','1853');
INSERT INTO ts_area VALUES ('1859','衡阳县','1853');
INSERT INTO ts_area VALUES ('1860','衡南县','1853');
INSERT INTO ts_area VALUES ('1861','衡山县','1853');
INSERT INTO ts_area VALUES ('1862','衡东县','1853');
INSERT INTO ts_area VALUES ('1863','祁东县','1853');
INSERT INTO ts_area VALUES ('1864','耒阳市','1853');
INSERT INTO ts_area VALUES ('1865','常宁市','1853');
INSERT INTO ts_area VALUES ('1866','邵阳市','1826');
INSERT INTO ts_area VALUES ('1867','双清区','1866');
INSERT INTO ts_area VALUES ('1868','大祥区','1866');
INSERT INTO ts_area VALUES ('1869','北塔区','1866');
INSERT INTO ts_area VALUES ('1870','邵东县','1866');
INSERT INTO ts_area VALUES ('1871','新邵县','1866');
INSERT INTO ts_area VALUES ('1872','邵阳县','1866');
INSERT INTO ts_area VALUES ('1873','隆回县','1866');
INSERT INTO ts_area VALUES ('1874','洞口县','1866');
INSERT INTO ts_area VALUES ('1875','绥宁县','1866');
INSERT INTO ts_area VALUES ('1876','新宁县','1866');
INSERT INTO ts_area VALUES ('1877','城步苗族自治县','1866');
INSERT INTO ts_area VALUES ('1878','武冈市','1866');
INSERT INTO ts_area VALUES ('1879','岳阳市','1826');
INSERT INTO ts_area VALUES ('1880','岳阳楼区','1879');
INSERT INTO ts_area VALUES ('1881','云溪区','1879');
INSERT INTO ts_area VALUES ('1882','君山区','1879');
INSERT INTO ts_area VALUES ('1883','岳阳县','1879');
INSERT INTO ts_area VALUES ('1884','华容县','1879');
INSERT INTO ts_area VALUES ('1885','湘阴县','1879');
INSERT INTO ts_area VALUES ('1886','平江县','1879');
INSERT INTO ts_area VALUES ('1887','汨罗市','1879');
INSERT INTO ts_area VALUES ('1888','临湘市','1879');
INSERT INTO ts_area VALUES ('1889','常德市','1826');
INSERT INTO ts_area VALUES ('1890','武陵区','1889');
INSERT INTO ts_area VALUES ('1891','鼎城区','1889');
INSERT INTO ts_area VALUES ('1892','安乡县','1889');
INSERT INTO ts_area VALUES ('1893','汉寿县','1889');
INSERT INTO ts_area VALUES ('1894','澧县','1889');
INSERT INTO ts_area VALUES ('1895','临澧县','1889');
INSERT INTO ts_area VALUES ('1896','桃源县','1889');
INSERT INTO ts_area VALUES ('1897','石门县','1889');
INSERT INTO ts_area VALUES ('1898','津市市','1889');
INSERT INTO ts_area VALUES ('1899','张家界市','1826');
INSERT INTO ts_area VALUES ('1900','永定区','1899');
INSERT INTO ts_area VALUES ('1901','武陵源区','1899');
INSERT INTO ts_area VALUES ('1902','慈利县','1899');
INSERT INTO ts_area VALUES ('1903','桑植县','1899');
INSERT INTO ts_area VALUES ('1904','益阳市','1826');
INSERT INTO ts_area VALUES ('1905','资阳区','1904');
INSERT INTO ts_area VALUES ('1906','赫山区','1904');
INSERT INTO ts_area VALUES ('1907','南县','1904');
INSERT INTO ts_area VALUES ('1908','桃江县','1904');
INSERT INTO ts_area VALUES ('1909','安化县','1904');
INSERT INTO ts_area VALUES ('1910','沅江市','1904');
INSERT INTO ts_area VALUES ('1911','郴州市','1826');
INSERT INTO ts_area VALUES ('1912','北湖区','1911');
INSERT INTO ts_area VALUES ('1913','苏仙区','1911');
INSERT INTO ts_area VALUES ('1914','桂阳县','1911');
INSERT INTO ts_area VALUES ('1915','宜章县','1911');
INSERT INTO ts_area VALUES ('1916','永兴县','1911');
INSERT INTO ts_area VALUES ('1917','嘉禾县','1911');
INSERT INTO ts_area VALUES ('1918','临武县','1911');
INSERT INTO ts_area VALUES ('1919','汝城县','1911');
INSERT INTO ts_area VALUES ('1920','桂东县','1911');
INSERT INTO ts_area VALUES ('1921','安仁县','1911');
INSERT INTO ts_area VALUES ('1922','资兴市','1911');
INSERT INTO ts_area VALUES ('1923','永州市','1826');
INSERT INTO ts_area VALUES ('1924','零陵区','1923');
INSERT INTO ts_area VALUES ('1925','冷水滩区','1923');
INSERT INTO ts_area VALUES ('1926','祁阳县','1923');
INSERT INTO ts_area VALUES ('1927','东安县','1923');
INSERT INTO ts_area VALUES ('1928','双牌县','1923');
INSERT INTO ts_area VALUES ('1929','道县','1923');
INSERT INTO ts_area VALUES ('1930','江永县','1923');
INSERT INTO ts_area VALUES ('1931','宁远县','1923');
INSERT INTO ts_area VALUES ('1932','蓝山县','1923');
INSERT INTO ts_area VALUES ('1933','新田县','1923');
INSERT INTO ts_area VALUES ('1934','江华瑶族自治县','1923');
INSERT INTO ts_area VALUES ('1935','怀化市','1826');
INSERT INTO ts_area VALUES ('1936','鹤城区','1935');
INSERT INTO ts_area VALUES ('1937','中方县','1935');
INSERT INTO ts_area VALUES ('1938','沅陵县','1935');
INSERT INTO ts_area VALUES ('1939','辰溪县','1935');
INSERT INTO ts_area VALUES ('1940','溆浦县','1935');
INSERT INTO ts_area VALUES ('1941','会同县','1935');
INSERT INTO ts_area VALUES ('1942','麻阳苗族自治县','1935');
INSERT INTO ts_area VALUES ('1943','新晃侗族自治县','1935');
INSERT INTO ts_area VALUES ('1944','芷江侗族自治县','1935');
INSERT INTO ts_area VALUES ('1945','靖州苗族侗族自治县','1935');
INSERT INTO ts_area VALUES ('1946','通道侗族自治县','1935');
INSERT INTO ts_area VALUES ('1947','洪江市','1935');
INSERT INTO ts_area VALUES ('1948','娄底市','1826');
INSERT INTO ts_area VALUES ('1949','娄星区','1948');
INSERT INTO ts_area VALUES ('1950','双峰县','1948');
INSERT INTO ts_area VALUES ('1951','新化县','1948');
INSERT INTO ts_area VALUES ('1952','冷水江市','1948');
INSERT INTO ts_area VALUES ('1953','涟源市','1948');
INSERT INTO ts_area VALUES ('1954','湘西土家族苗族自治州','1826');
INSERT INTO ts_area VALUES ('1955','吉首市','1954');
INSERT INTO ts_area VALUES ('1956','泸溪县','1954');
INSERT INTO ts_area VALUES ('1957','凤凰县','1954');
INSERT INTO ts_area VALUES ('1958','花垣县','1954');
INSERT INTO ts_area VALUES ('1959','保靖县','1954');
INSERT INTO ts_area VALUES ('1960','古丈县','1954');
INSERT INTO ts_area VALUES ('1961','永顺县','1954');
INSERT INTO ts_area VALUES ('1962','龙山县','1954');
INSERT INTO ts_area VALUES ('1963','广东','0');
INSERT INTO ts_area VALUES ('1964','广州市','1963');
INSERT INTO ts_area VALUES ('1965','荔湾区','1964');
INSERT INTO ts_area VALUES ('1966','越秀区','1964');
INSERT INTO ts_area VALUES ('1967','海珠区','1964');
INSERT INTO ts_area VALUES ('1968','天河区','1964');
INSERT INTO ts_area VALUES ('1969','白云区','1964');
INSERT INTO ts_area VALUES ('1970','黄埔区','1964');
INSERT INTO ts_area VALUES ('1971','番禺区','1964');
INSERT INTO ts_area VALUES ('1972','花都区','1964');
INSERT INTO ts_area VALUES ('1973','南沙区','1964');
INSERT INTO ts_area VALUES ('1974','萝岗区','1964');
INSERT INTO ts_area VALUES ('1975','增城市','1964');
INSERT INTO ts_area VALUES ('1976','从化市','1964');
INSERT INTO ts_area VALUES ('1977','韶关市','1963');
INSERT INTO ts_area VALUES ('1978','武江区','1977');
INSERT INTO ts_area VALUES ('1979','浈江区','1977');
INSERT INTO ts_area VALUES ('1980','曲江区','1977');
INSERT INTO ts_area VALUES ('1981','始兴县','1977');
INSERT INTO ts_area VALUES ('1982','仁化县','1977');
INSERT INTO ts_area VALUES ('1983','翁源县','1977');
INSERT INTO ts_area VALUES ('1984','乳源瑶族自治县','1977');
INSERT INTO ts_area VALUES ('1985','新丰县','1977');
INSERT INTO ts_area VALUES ('1986','乐昌市','1977');
INSERT INTO ts_area VALUES ('1987','南雄市','1977');
INSERT INTO ts_area VALUES ('1988','深圳市','1963');
INSERT INTO ts_area VALUES ('1989','罗湖区','1988');
INSERT INTO ts_area VALUES ('1990','福田区','1988');
INSERT INTO ts_area VALUES ('1991','南山区','1988');
INSERT INTO ts_area VALUES ('1992','宝安区','1988');
INSERT INTO ts_area VALUES ('1993','龙岗区','1988');
INSERT INTO ts_area VALUES ('1994','盐田区','1988');
INSERT INTO ts_area VALUES ('1995','珠海市','1963');
INSERT INTO ts_area VALUES ('1996','香洲区','1995');
INSERT INTO ts_area VALUES ('1997','斗门区','1995');
INSERT INTO ts_area VALUES ('1998','金湾区','1995');
INSERT INTO ts_area VALUES ('1999','汕头市','1963');
INSERT INTO ts_area VALUES ('2000','龙湖区','1999');
INSERT INTO ts_area VALUES ('2001','金平区','1999');
INSERT INTO ts_area VALUES ('2002','濠江区','1999');
INSERT INTO ts_area VALUES ('2003','潮阳区','1999');
INSERT INTO ts_area VALUES ('2004','潮南区','1999');
INSERT INTO ts_area VALUES ('2005','澄海区','1999');
INSERT INTO ts_area VALUES ('2006','南澳县','1999');
INSERT INTO ts_area VALUES ('2007','佛山市','1963');
INSERT INTO ts_area VALUES ('2008','禅城区','2007');
INSERT INTO ts_area VALUES ('2009','南海区','2007');
INSERT INTO ts_area VALUES ('2010','顺德区','2007');
INSERT INTO ts_area VALUES ('2011','三水区','2007');
INSERT INTO ts_area VALUES ('2012','高明区','2007');
INSERT INTO ts_area VALUES ('2013','江门市','1963');
INSERT INTO ts_area VALUES ('2014','蓬江区','2013');
INSERT INTO ts_area VALUES ('2015','江海区','2013');
INSERT INTO ts_area VALUES ('2016','新会区','2013');
INSERT INTO ts_area VALUES ('2017','台山市','2013');
INSERT INTO ts_area VALUES ('2018','开平市','2013');
INSERT INTO ts_area VALUES ('2019','鹤山市','2013');
INSERT INTO ts_area VALUES ('2020','恩平市','2013');
INSERT INTO ts_area VALUES ('2021','湛江市','1963');
INSERT INTO ts_area VALUES ('2022','赤坎区','2021');
INSERT INTO ts_area VALUES ('2023','霞山区','2021');
INSERT INTO ts_area VALUES ('2024','坡头区','2021');
INSERT INTO ts_area VALUES ('2025','麻章区','2021');
INSERT INTO ts_area VALUES ('2026','遂溪县','2021');
INSERT INTO ts_area VALUES ('2027','徐闻县','2021');
INSERT INTO ts_area VALUES ('2028','廉江市','2021');
INSERT INTO ts_area VALUES ('2029','雷州市','2021');
INSERT INTO ts_area VALUES ('2030','吴川市','2021');
INSERT INTO ts_area VALUES ('2031','茂名市','1963');
INSERT INTO ts_area VALUES ('2032','茂南区','2031');
INSERT INTO ts_area VALUES ('2033','茂港区','2031');
INSERT INTO ts_area VALUES ('2034','电白县','2031');
INSERT INTO ts_area VALUES ('2035','高州市','2031');
INSERT INTO ts_area VALUES ('2036','化州市','2031');
INSERT INTO ts_area VALUES ('2037','信宜市','2031');
INSERT INTO ts_area VALUES ('2038','肇庆市','1963');
INSERT INTO ts_area VALUES ('2039','端州区','2038');
INSERT INTO ts_area VALUES ('2040','鼎湖区','2038');
INSERT INTO ts_area VALUES ('2041','广宁县','2038');
INSERT INTO ts_area VALUES ('2042','怀集县','2038');
INSERT INTO ts_area VALUES ('2043','封开县','2038');
INSERT INTO ts_area VALUES ('2044','德庆县','2038');
INSERT INTO ts_area VALUES ('2045','高要市','2038');
INSERT INTO ts_area VALUES ('2046','四会市','2038');
INSERT INTO ts_area VALUES ('2047','惠州市','1963');
INSERT INTO ts_area VALUES ('2048','惠城区','2047');
INSERT INTO ts_area VALUES ('2049','惠阳区','2047');
INSERT INTO ts_area VALUES ('2050','博罗县','2047');
INSERT INTO ts_area VALUES ('2051','惠东县','2047');
INSERT INTO ts_area VALUES ('2052','龙门县','2047');
INSERT INTO ts_area VALUES ('2053','梅州市','1963');
INSERT INTO ts_area VALUES ('2054','梅江区','2053');
INSERT INTO ts_area VALUES ('2055','梅县','2053');
INSERT INTO ts_area VALUES ('2056','大埔县','2053');
INSERT INTO ts_area VALUES ('2057','丰顺县','2053');
INSERT INTO ts_area VALUES ('2058','五华县','2053');
INSERT INTO ts_area VALUES ('2059','平远县','2053');
INSERT INTO ts_area VALUES ('2060','蕉岭县','2053');
INSERT INTO ts_area VALUES ('2061','兴宁市','2053');
INSERT INTO ts_area VALUES ('2062','汕尾市','1963');
INSERT INTO ts_area VALUES ('2063','城区','2062');
INSERT INTO ts_area VALUES ('2064','海丰县','2062');
INSERT INTO ts_area VALUES ('2065','陆河县','2062');
INSERT INTO ts_area VALUES ('2066','陆丰市','2062');
INSERT INTO ts_area VALUES ('2067','河源市','1963');
INSERT INTO ts_area VALUES ('2068','源城区','2067');
INSERT INTO ts_area VALUES ('2069','紫金县','2067');
INSERT INTO ts_area VALUES ('2070','龙川县','2067');
INSERT INTO ts_area VALUES ('2071','连平县','2067');
INSERT INTO ts_area VALUES ('2072','和平县','2067');
INSERT INTO ts_area VALUES ('2073','东源县','2067');
INSERT INTO ts_area VALUES ('2074','阳江市','1963');
INSERT INTO ts_area VALUES ('2075','江城区','2074');
INSERT INTO ts_area VALUES ('2076','阳西县','2074');
INSERT INTO ts_area VALUES ('2077','阳东县','2074');
INSERT INTO ts_area VALUES ('2078','阳春市','2074');
INSERT INTO ts_area VALUES ('2079','清远市','1963');
INSERT INTO ts_area VALUES ('2080','清城区','2079');
INSERT INTO ts_area VALUES ('2081','佛冈县','2079');
INSERT INTO ts_area VALUES ('2082','阳山县','2079');
INSERT INTO ts_area VALUES ('2083','连山壮族瑶族自治县','2079');
INSERT INTO ts_area VALUES ('2084','连南瑶族自治县','2079');
INSERT INTO ts_area VALUES ('2085','清新县','2079');
INSERT INTO ts_area VALUES ('2086','英德市','2079');
INSERT INTO ts_area VALUES ('2087','连州市','2079');
INSERT INTO ts_area VALUES ('2088','东莞市','1963');
INSERT INTO ts_area VALUES ('2089','中山市','1963');
INSERT INTO ts_area VALUES ('2090','潮州市','1963');
INSERT INTO ts_area VALUES ('2091','湘桥区','2090');
INSERT INTO ts_area VALUES ('2092','潮安县','2090');
INSERT INTO ts_area VALUES ('2093','饶平县','2090');
INSERT INTO ts_area VALUES ('2094','揭阳市','1963');
INSERT INTO ts_area VALUES ('2095','榕城区','2094');
INSERT INTO ts_area VALUES ('2096','揭东县','2094');
INSERT INTO ts_area VALUES ('2097','揭西县','2094');
INSERT INTO ts_area VALUES ('2098','惠来县','2094');
INSERT INTO ts_area VALUES ('2099','普宁市','2094');
INSERT INTO ts_area VALUES ('2100','云浮市','1963');
INSERT INTO ts_area VALUES ('2101','云城区','2100');
INSERT INTO ts_area VALUES ('2102','新兴县','2100');
INSERT INTO ts_area VALUES ('2103','郁南县','2100');
INSERT INTO ts_area VALUES ('2104','云安县','2100');
INSERT INTO ts_area VALUES ('2105','罗定市','2100');
INSERT INTO ts_area VALUES ('2106','广西','0');
INSERT INTO ts_area VALUES ('2107','南宁市','2106');
INSERT INTO ts_area VALUES ('2108','兴宁区','2107');
INSERT INTO ts_area VALUES ('2109','青秀区','2107');
INSERT INTO ts_area VALUES ('2110','江南区','2107');
INSERT INTO ts_area VALUES ('2111','西乡塘区','2107');
INSERT INTO ts_area VALUES ('2112','良庆区','2107');
INSERT INTO ts_area VALUES ('2113','邕宁区','2107');
INSERT INTO ts_area VALUES ('2114','武鸣县','2107');
INSERT INTO ts_area VALUES ('2115','隆安县','2107');
INSERT INTO ts_area VALUES ('2116','马山县','2107');
INSERT INTO ts_area VALUES ('2117','上林县','2107');
INSERT INTO ts_area VALUES ('2118','宾阳县','2107');
INSERT INTO ts_area VALUES ('2119','横县','2107');
INSERT INTO ts_area VALUES ('2120','柳州市','2106');
INSERT INTO ts_area VALUES ('2121','城中区','2120');
INSERT INTO ts_area VALUES ('2122','鱼峰区','2120');
INSERT INTO ts_area VALUES ('2123','柳南区','2120');
INSERT INTO ts_area VALUES ('2124','柳北区','2120');
INSERT INTO ts_area VALUES ('2125','柳江县','2120');
INSERT INTO ts_area VALUES ('2126','柳城县','2120');
INSERT INTO ts_area VALUES ('2127','鹿寨县','2120');
INSERT INTO ts_area VALUES ('2128','融安县','2120');
INSERT INTO ts_area VALUES ('2129','融水苗族自治县','2120');
INSERT INTO ts_area VALUES ('2130','三江侗族自治县','2120');
INSERT INTO ts_area VALUES ('2131','桂林市','2106');
INSERT INTO ts_area VALUES ('2132','秀峰区','2131');
INSERT INTO ts_area VALUES ('2133','叠彩区','2131');
INSERT INTO ts_area VALUES ('2134','象山区','2131');
INSERT INTO ts_area VALUES ('2135','七星区','2131');
INSERT INTO ts_area VALUES ('2136','雁山区','2131');
INSERT INTO ts_area VALUES ('2137','阳朔县','2131');
INSERT INTO ts_area VALUES ('2138','临桂县','2131');
INSERT INTO ts_area VALUES ('2139','灵川县','2131');
INSERT INTO ts_area VALUES ('2140','全州县','2131');
INSERT INTO ts_area VALUES ('2141','兴安县','2131');
INSERT INTO ts_area VALUES ('2142','永福县','2131');
INSERT INTO ts_area VALUES ('2143','灌阳县','2131');
INSERT INTO ts_area VALUES ('2144','龙胜各族自治县','2131');
INSERT INTO ts_area VALUES ('2145','资源县','2131');
INSERT INTO ts_area VALUES ('2146','平乐县','2131');
INSERT INTO ts_area VALUES ('2147','荔蒲县','2131');
INSERT INTO ts_area VALUES ('2148','恭城瑶族自治县','2131');
INSERT INTO ts_area VALUES ('2149','梧州市','2106');
INSERT INTO ts_area VALUES ('2150','万秀区','2149');
INSERT INTO ts_area VALUES ('2151','蝶山区','2149');
INSERT INTO ts_area VALUES ('2152','长洲区','2149');
INSERT INTO ts_area VALUES ('2153','苍梧县','2149');
INSERT INTO ts_area VALUES ('2154','藤县','2149');
INSERT INTO ts_area VALUES ('2155','蒙山县','2149');
INSERT INTO ts_area VALUES ('2156','岑溪市','2149');
INSERT INTO ts_area VALUES ('2157','北海市','2106');
INSERT INTO ts_area VALUES ('2158','海城区','2157');
INSERT INTO ts_area VALUES ('2159','银海区','2157');
INSERT INTO ts_area VALUES ('2160','铁山港区','2157');
INSERT INTO ts_area VALUES ('2161','合浦县','2157');
INSERT INTO ts_area VALUES ('2162','防城港市','2106');
INSERT INTO ts_area VALUES ('2163','港口区','2162');
INSERT INTO ts_area VALUES ('2164','防城区','2162');
INSERT INTO ts_area VALUES ('2165','上思县','2162');
INSERT INTO ts_area VALUES ('2166','东兴市','2162');
INSERT INTO ts_area VALUES ('2167','钦州市','2106');
INSERT INTO ts_area VALUES ('2168','钦南区','2167');
INSERT INTO ts_area VALUES ('2169','钦北区','2167');
INSERT INTO ts_area VALUES ('2170','灵山县','2167');
INSERT INTO ts_area VALUES ('2171','浦北县','2167');
INSERT INTO ts_area VALUES ('2172','贵港市','2106');
INSERT INTO ts_area VALUES ('2173','港北区','2172');
INSERT INTO ts_area VALUES ('2174','港南区','2172');
INSERT INTO ts_area VALUES ('2175','覃塘区','2172');
INSERT INTO ts_area VALUES ('2176','平南县','2172');
INSERT INTO ts_area VALUES ('2177','桂平市','2172');
INSERT INTO ts_area VALUES ('2178','玉林市','2106');
INSERT INTO ts_area VALUES ('2179','玉州区','2178');
INSERT INTO ts_area VALUES ('2180','容县','2178');
INSERT INTO ts_area VALUES ('2181','陆川县','2178');
INSERT INTO ts_area VALUES ('2182','博白县','2178');
INSERT INTO ts_area VALUES ('2183','兴业县','2178');
INSERT INTO ts_area VALUES ('2184','北流市','2178');
INSERT INTO ts_area VALUES ('2185','百色市','2106');
INSERT INTO ts_area VALUES ('2186','右江区','2185');
INSERT INTO ts_area VALUES ('2187','田阳县','2185');
INSERT INTO ts_area VALUES ('2188','田东县','2185');
INSERT INTO ts_area VALUES ('2189','平果县','2185');
INSERT INTO ts_area VALUES ('2190','德保县','2185');
INSERT INTO ts_area VALUES ('2191','靖西县','2185');
INSERT INTO ts_area VALUES ('2192','那坡县','2185');
INSERT INTO ts_area VALUES ('2193','凌云县','2185');
INSERT INTO ts_area VALUES ('2194','乐业县','2185');
INSERT INTO ts_area VALUES ('2195','田林县','2185');
INSERT INTO ts_area VALUES ('2196','西林县','2185');
INSERT INTO ts_area VALUES ('2197','隆林各族自治县','2185');
INSERT INTO ts_area VALUES ('2198','贺州市','2106');
INSERT INTO ts_area VALUES ('2199','八步区','2198');
INSERT INTO ts_area VALUES ('2200','昭平县','2198');
INSERT INTO ts_area VALUES ('2201','钟山县','2198');
INSERT INTO ts_area VALUES ('2202','富川瑶族自治县','2198');
INSERT INTO ts_area VALUES ('2203','河池市','2106');
INSERT INTO ts_area VALUES ('2204','金城江区','2203');
INSERT INTO ts_area VALUES ('2205','南丹县','2203');
INSERT INTO ts_area VALUES ('2206','天峨县','2203');
INSERT INTO ts_area VALUES ('2207','凤山县','2203');
INSERT INTO ts_area VALUES ('2208','东兰县','2203');
INSERT INTO ts_area VALUES ('2209','罗城仫佬族自治县','2203');
INSERT INTO ts_area VALUES ('2210','环江毛南族自治县','2203');
INSERT INTO ts_area VALUES ('2211','巴马瑶族自治县','2203');
INSERT INTO ts_area VALUES ('2212','都安瑶族自治县','2203');
INSERT INTO ts_area VALUES ('2213','大化瑶族自治县','2203');
INSERT INTO ts_area VALUES ('2214','宜州市','2203');
INSERT INTO ts_area VALUES ('2215','来宾市','2106');
INSERT INTO ts_area VALUES ('2216','兴宾区','2215');
INSERT INTO ts_area VALUES ('2217','忻城县','2215');
INSERT INTO ts_area VALUES ('2218','象州县','2215');
INSERT INTO ts_area VALUES ('2219','武宣县','2215');
INSERT INTO ts_area VALUES ('2220','金秀瑶族自治县','2215');
INSERT INTO ts_area VALUES ('2221','合山市','2215');
INSERT INTO ts_area VALUES ('2222','崇左市','2106');
INSERT INTO ts_area VALUES ('2223','江洲区','2222');
INSERT INTO ts_area VALUES ('2224','扶绥县','2222');
INSERT INTO ts_area VALUES ('2225','宁明县','2222');
INSERT INTO ts_area VALUES ('2226','龙州县','2222');
INSERT INTO ts_area VALUES ('2227','大新县','2222');
INSERT INTO ts_area VALUES ('2228','天等县','2222');
INSERT INTO ts_area VALUES ('2229','凭祥市','2222');
INSERT INTO ts_area VALUES ('2230','海南','0');
INSERT INTO ts_area VALUES ('2231','海口市','2230');
INSERT INTO ts_area VALUES ('2232','秀英区','2231');
INSERT INTO ts_area VALUES ('2233','龙华区','2231');
INSERT INTO ts_area VALUES ('2234','琼山区','2231');
INSERT INTO ts_area VALUES ('2235','美兰区','2231');
INSERT INTO ts_area VALUES ('2236','三亚市','2230');
INSERT INTO ts_area VALUES ('2237','省直辖县级行政单位','2230');
INSERT INTO ts_area VALUES ('2238','五指山市','2237');
INSERT INTO ts_area VALUES ('2239','琼海市','2237');
INSERT INTO ts_area VALUES ('2240','儋州市','2237');
INSERT INTO ts_area VALUES ('2241','文昌市','2237');
INSERT INTO ts_area VALUES ('2242','万宁市','2237');
INSERT INTO ts_area VALUES ('2243','东方市','2237');
INSERT INTO ts_area VALUES ('2244','定安县','2237');
INSERT INTO ts_area VALUES ('2245','屯昌县','2237');
INSERT INTO ts_area VALUES ('2246','澄迈县','2237');
INSERT INTO ts_area VALUES ('2247','临高县','2237');
INSERT INTO ts_area VALUES ('2248','白沙黎族自治县','2237');
INSERT INTO ts_area VALUES ('2249','昌江黎族自治县','2237');
INSERT INTO ts_area VALUES ('2250','乐东黎族自治县','2237');
INSERT INTO ts_area VALUES ('2251','陵水黎族自治县','2237');
INSERT INTO ts_area VALUES ('2252','保亭黎族苗族自治县','2237');
INSERT INTO ts_area VALUES ('2253','琼中黎族苗族自治县','2237');
INSERT INTO ts_area VALUES ('2254','西沙群岛','2237');
INSERT INTO ts_area VALUES ('2255','南沙群岛','2237');
INSERT INTO ts_area VALUES ('2256','中沙群岛的岛礁及其海域','2237');
INSERT INTO ts_area VALUES ('2257','重庆市','0');
INSERT INTO ts_area VALUES ('2258','重庆市','2257');
INSERT INTO ts_area VALUES ('2259','万州区','2258');
INSERT INTO ts_area VALUES ('2260','涪陵区','2258');
INSERT INTO ts_area VALUES ('2261','渝中区','2258');
INSERT INTO ts_area VALUES ('2262','大渡口区','2258');
INSERT INTO ts_area VALUES ('2263','江北区','2258');
INSERT INTO ts_area VALUES ('2264','沙坪坝区','2258');
INSERT INTO ts_area VALUES ('2265','九龙坡区','2258');
INSERT INTO ts_area VALUES ('2266','南岸区','2258');
INSERT INTO ts_area VALUES ('2267','北碚区','2258');
INSERT INTO ts_area VALUES ('2268','万盛区','2258');
INSERT INTO ts_area VALUES ('2269','双桥区','2258');
INSERT INTO ts_area VALUES ('2270','渝北区','2258');
INSERT INTO ts_area VALUES ('2271','巴南区','2258');
INSERT INTO ts_area VALUES ('2272','黔江区','2258');
INSERT INTO ts_area VALUES ('2273','长寿区','2258');
INSERT INTO ts_area VALUES ('2274','江津区','2258');
INSERT INTO ts_area VALUES ('2275','合川区','2258');
INSERT INTO ts_area VALUES ('2276','永川区','2258');
INSERT INTO ts_area VALUES ('2277','南川区','2258');
INSERT INTO ts_area VALUES ('2278','綦江县','2258');
INSERT INTO ts_area VALUES ('2279','潼南县','2258');
INSERT INTO ts_area VALUES ('2280','铜梁县','2258');
INSERT INTO ts_area VALUES ('2281','大足县','2258');
INSERT INTO ts_area VALUES ('2282','荣昌县','2258');
INSERT INTO ts_area VALUES ('2283','璧山县','2258');
INSERT INTO ts_area VALUES ('2284','梁平县','2258');
INSERT INTO ts_area VALUES ('2285','城口县','2258');
INSERT INTO ts_area VALUES ('2286','丰都县','2258');
INSERT INTO ts_area VALUES ('2287','垫江县','2258');
INSERT INTO ts_area VALUES ('2288','武隆县','2258');
INSERT INTO ts_area VALUES ('2289','忠县','2258');
INSERT INTO ts_area VALUES ('2290','开县','2258');
INSERT INTO ts_area VALUES ('2291','云阳县','2258');
INSERT INTO ts_area VALUES ('2292','奉节县','2258');
INSERT INTO ts_area VALUES ('2293','巫山县','2258');
INSERT INTO ts_area VALUES ('2294','巫溪县','2258');
INSERT INTO ts_area VALUES ('2295','石柱土家族自治县','2258');
INSERT INTO ts_area VALUES ('2296','秀山土家族苗族自治县','2258');
INSERT INTO ts_area VALUES ('2297','酉阳土家族苗族自治县','2258');
INSERT INTO ts_area VALUES ('2298','彭水苗族土家族自治县','2258');
INSERT INTO ts_area VALUES ('2299','四川','0');
INSERT INTO ts_area VALUES ('2300','成都市','2299');
INSERT INTO ts_area VALUES ('2301','锦江区','2300');
INSERT INTO ts_area VALUES ('2302','青羊区','2300');
INSERT INTO ts_area VALUES ('2303','金牛区','2300');
INSERT INTO ts_area VALUES ('2304','武侯区','2300');
INSERT INTO ts_area VALUES ('2305','成华区','2300');
INSERT INTO ts_area VALUES ('2306','龙泉驿区','2300');
INSERT INTO ts_area VALUES ('2307','青白江区','2300');
INSERT INTO ts_area VALUES ('2308','新都区','2300');
INSERT INTO ts_area VALUES ('2309','温江区','2300');
INSERT INTO ts_area VALUES ('2310','金堂县','2300');
INSERT INTO ts_area VALUES ('2311','双流县','2300');
INSERT INTO ts_area VALUES ('2312','郫县','2300');
INSERT INTO ts_area VALUES ('2313','大邑县','2300');
INSERT INTO ts_area VALUES ('2314','蒲江县','2300');
INSERT INTO ts_area VALUES ('2315','新津县','2300');
INSERT INTO ts_area VALUES ('2316','都江堰市','2300');
INSERT INTO ts_area VALUES ('2317','彭州市','2300');
INSERT INTO ts_area VALUES ('2318','邛崃市','2300');
INSERT INTO ts_area VALUES ('2319','崇州市','2300');
INSERT INTO ts_area VALUES ('2320','自贡市','2299');
INSERT INTO ts_area VALUES ('2321','自流井区','2320');
INSERT INTO ts_area VALUES ('2322','贡井区','2320');
INSERT INTO ts_area VALUES ('2323','大安区','2320');
INSERT INTO ts_area VALUES ('2324','沿滩区','2320');
INSERT INTO ts_area VALUES ('2325','荣县','2320');
INSERT INTO ts_area VALUES ('2326','富顺县','2320');
INSERT INTO ts_area VALUES ('2327','攀枝花市','2299');
INSERT INTO ts_area VALUES ('2328','东区','2327');
INSERT INTO ts_area VALUES ('2329','西区','2327');
INSERT INTO ts_area VALUES ('2330','仁和区','2327');
INSERT INTO ts_area VALUES ('2331','米易县','2327');
INSERT INTO ts_area VALUES ('2332','盐边县','2327');
INSERT INTO ts_area VALUES ('2333','泸州市','2299');
INSERT INTO ts_area VALUES ('2334','江阳区','2333');
INSERT INTO ts_area VALUES ('2335','纳溪区','2333');
INSERT INTO ts_area VALUES ('2336','龙马潭区','2333');
INSERT INTO ts_area VALUES ('2337','泸县','2333');
INSERT INTO ts_area VALUES ('2338','合江县','2333');
INSERT INTO ts_area VALUES ('2339','叙永县','2333');
INSERT INTO ts_area VALUES ('2340','古蔺县','2333');
INSERT INTO ts_area VALUES ('2341','德阳市','2299');
INSERT INTO ts_area VALUES ('2342','旌阳区','2341');
INSERT INTO ts_area VALUES ('2343','中江县','2341');
INSERT INTO ts_area VALUES ('2344','罗江县','2341');
INSERT INTO ts_area VALUES ('2345','广汉市','2341');
INSERT INTO ts_area VALUES ('2346','什邡市','2341');
INSERT INTO ts_area VALUES ('2347','绵竹市','2341');
INSERT INTO ts_area VALUES ('2348','绵阳市','2299');
INSERT INTO ts_area VALUES ('2349','涪城区','2348');
INSERT INTO ts_area VALUES ('2350','游仙区','2348');
INSERT INTO ts_area VALUES ('2351','三台县','2348');
INSERT INTO ts_area VALUES ('2352','盐亭县','2348');
INSERT INTO ts_area VALUES ('2353','安县','2348');
INSERT INTO ts_area VALUES ('2354','梓潼县','2348');
INSERT INTO ts_area VALUES ('2355','北川羌族自治县','2348');
INSERT INTO ts_area VALUES ('2356','平武县','2348');
INSERT INTO ts_area VALUES ('2357','江油市','2348');
INSERT INTO ts_area VALUES ('2358','广元市','2299');
INSERT INTO ts_area VALUES ('2359','市中区','2358');
INSERT INTO ts_area VALUES ('2360','元坝区','2358');
INSERT INTO ts_area VALUES ('2361','朝天区','2358');
INSERT INTO ts_area VALUES ('2362','旺苍县','2358');
INSERT INTO ts_area VALUES ('2363','青川县','2358');
INSERT INTO ts_area VALUES ('2364','剑阁县','2358');
INSERT INTO ts_area VALUES ('2365','苍溪县','2358');
INSERT INTO ts_area VALUES ('2366','遂宁市','2299');
INSERT INTO ts_area VALUES ('2367','船山区','2366');
INSERT INTO ts_area VALUES ('2368','安居区','2366');
INSERT INTO ts_area VALUES ('2369','蓬溪县','2366');
INSERT INTO ts_area VALUES ('2370','射洪县','2366');
INSERT INTO ts_area VALUES ('2371','大英县','2366');
INSERT INTO ts_area VALUES ('2372','内江市','2299');
INSERT INTO ts_area VALUES ('2373','市中区','2372');
INSERT INTO ts_area VALUES ('2374','东兴区','2372');
INSERT INTO ts_area VALUES ('2375','威远县','2372');
INSERT INTO ts_area VALUES ('2376','资中县','2372');
INSERT INTO ts_area VALUES ('2377','隆昌县','2372');
INSERT INTO ts_area VALUES ('2378','乐山市','2299');
INSERT INTO ts_area VALUES ('2379','市中区','2378');
INSERT INTO ts_area VALUES ('2380','沙湾区','2378');
INSERT INTO ts_area VALUES ('2381','五通桥区','2378');
INSERT INTO ts_area VALUES ('2382','金口河区','2378');
INSERT INTO ts_area VALUES ('2383','犍为县','2378');
INSERT INTO ts_area VALUES ('2384','井研县','2378');
INSERT INTO ts_area VALUES ('2385','夹江县','2378');
INSERT INTO ts_area VALUES ('2386','沐川县','2378');
INSERT INTO ts_area VALUES ('2387','峨边彝族自治县','2378');
INSERT INTO ts_area VALUES ('2388','马边彝族自治县','2378');
INSERT INTO ts_area VALUES ('2389','峨眉山市','2378');
INSERT INTO ts_area VALUES ('2390','南充市','2299');
INSERT INTO ts_area VALUES ('2391','顺庆区','2390');
INSERT INTO ts_area VALUES ('2392','高坪区','2390');
INSERT INTO ts_area VALUES ('2393','嘉陵区','2390');
INSERT INTO ts_area VALUES ('2394','南部县','2390');
INSERT INTO ts_area VALUES ('2395','营山县','2390');
INSERT INTO ts_area VALUES ('2396','蓬安县','2390');
INSERT INTO ts_area VALUES ('2397','仪陇县','2390');
INSERT INTO ts_area VALUES ('2398','西充县','2390');
INSERT INTO ts_area VALUES ('2399','阆中市','2390');
INSERT INTO ts_area VALUES ('2400','眉山市','2299');
INSERT INTO ts_area VALUES ('2401','东坡区','2400');
INSERT INTO ts_area VALUES ('2402','仁寿县','2400');
INSERT INTO ts_area VALUES ('2403','彭山县','2400');
INSERT INTO ts_area VALUES ('2404','洪雅县','2400');
INSERT INTO ts_area VALUES ('2405','丹棱县','2400');
INSERT INTO ts_area VALUES ('2406','青神县','2400');
INSERT INTO ts_area VALUES ('2407','宜宾市','2299');
INSERT INTO ts_area VALUES ('2408','翠屏区','2407');
INSERT INTO ts_area VALUES ('2409','宜宾县','2407');
INSERT INTO ts_area VALUES ('2410','南溪县','2407');
INSERT INTO ts_area VALUES ('2411','江安县','2407');
INSERT INTO ts_area VALUES ('2412','长宁县','2407');
INSERT INTO ts_area VALUES ('2413','高县','2407');
INSERT INTO ts_area VALUES ('2414','珙县','2407');
INSERT INTO ts_area VALUES ('2415','筠连县','2407');
INSERT INTO ts_area VALUES ('2416','兴文县','2407');
INSERT INTO ts_area VALUES ('2417','屏山县','2407');
INSERT INTO ts_area VALUES ('2418','广安市','2299');
INSERT INTO ts_area VALUES ('2419','广安区','2418');
INSERT INTO ts_area VALUES ('2420','岳池县','2418');
INSERT INTO ts_area VALUES ('2421','武胜县','2418');
INSERT INTO ts_area VALUES ('2422','邻水县','2418');
INSERT INTO ts_area VALUES ('2423','华蓥市','2418');
INSERT INTO ts_area VALUES ('2424','达州市','2299');
INSERT INTO ts_area VALUES ('2425','通川区','2424');
INSERT INTO ts_area VALUES ('2426','达县','2424');
INSERT INTO ts_area VALUES ('2427','宣汉县','2424');
INSERT INTO ts_area VALUES ('2428','开江县','2424');
INSERT INTO ts_area VALUES ('2429','大竹县','2424');
INSERT INTO ts_area VALUES ('2430','渠县','2424');
INSERT INTO ts_area VALUES ('2431','万源市','2424');
INSERT INTO ts_area VALUES ('2432','雅安市','2299');
INSERT INTO ts_area VALUES ('2433','雨城区','2432');
INSERT INTO ts_area VALUES ('2434','名山县','2432');
INSERT INTO ts_area VALUES ('2435','荥经县','2432');
INSERT INTO ts_area VALUES ('2436','汉源县','2432');
INSERT INTO ts_area VALUES ('2437','石棉县','2432');
INSERT INTO ts_area VALUES ('2438','天全县','2432');
INSERT INTO ts_area VALUES ('2439','芦山县','2432');
INSERT INTO ts_area VALUES ('2440','宝兴县','2432');
INSERT INTO ts_area VALUES ('2441','巴中市','2299');
INSERT INTO ts_area VALUES ('2442','巴州区','2441');
INSERT INTO ts_area VALUES ('2443','通江县','2441');
INSERT INTO ts_area VALUES ('2444','南江县','2441');
INSERT INTO ts_area VALUES ('2445','平昌县','2441');
INSERT INTO ts_area VALUES ('2446','资阳市','2299');
INSERT INTO ts_area VALUES ('2447','雁江区','2446');
INSERT INTO ts_area VALUES ('2448','安岳县','2446');
INSERT INTO ts_area VALUES ('2449','乐至县','2446');
INSERT INTO ts_area VALUES ('2450','简阳市','2446');
INSERT INTO ts_area VALUES ('2451','阿坝藏族羌族自治州','2299');
INSERT INTO ts_area VALUES ('2452','汶川县','2451');
INSERT INTO ts_area VALUES ('2453','理县','2451');
INSERT INTO ts_area VALUES ('2454','茂县','2451');
INSERT INTO ts_area VALUES ('2455','松潘县','2451');
INSERT INTO ts_area VALUES ('2456','九寨沟县','2451');
INSERT INTO ts_area VALUES ('2457','金川县','2451');
INSERT INTO ts_area VALUES ('2458','小金县','2451');
INSERT INTO ts_area VALUES ('2459','黑水县','2451');
INSERT INTO ts_area VALUES ('2460','马尔康县','2451');
INSERT INTO ts_area VALUES ('2461','壤塘县','2451');
INSERT INTO ts_area VALUES ('2462','阿坝县','2451');
INSERT INTO ts_area VALUES ('2463','若尔盖县','2451');
INSERT INTO ts_area VALUES ('2464','红原县','2451');
INSERT INTO ts_area VALUES ('2465','甘孜藏族自治州','2299');
INSERT INTO ts_area VALUES ('2466','康定县','2465');
INSERT INTO ts_area VALUES ('2467','泸定县','2465');
INSERT INTO ts_area VALUES ('2468','丹巴县','2465');
INSERT INTO ts_area VALUES ('2469','九龙县','2465');
INSERT INTO ts_area VALUES ('2470','雅江县','2465');
INSERT INTO ts_area VALUES ('2471','道孚县','2465');
INSERT INTO ts_area VALUES ('2472','炉霍县','2465');
INSERT INTO ts_area VALUES ('2473','甘孜县','2465');
INSERT INTO ts_area VALUES ('2474','新龙县','2465');
INSERT INTO ts_area VALUES ('2475','德格县','2465');
INSERT INTO ts_area VALUES ('2476','白玉县','2465');
INSERT INTO ts_area VALUES ('2477','石渠县','2465');
INSERT INTO ts_area VALUES ('2478','色达县','2465');
INSERT INTO ts_area VALUES ('2479','理塘县','2465');
INSERT INTO ts_area VALUES ('2480','巴塘县','2465');
INSERT INTO ts_area VALUES ('2481','乡城县','2465');
INSERT INTO ts_area VALUES ('2482','稻城县','2465');
INSERT INTO ts_area VALUES ('2483','得荣县','2465');
INSERT INTO ts_area VALUES ('2484','凉山彝族自治州','2299');
INSERT INTO ts_area VALUES ('2485','西昌市','2484');
INSERT INTO ts_area VALUES ('2486','木里藏族自治县','2484');
INSERT INTO ts_area VALUES ('2487','盐源县','2484');
INSERT INTO ts_area VALUES ('2488','德昌县','2484');
INSERT INTO ts_area VALUES ('2489','会理县','2484');
INSERT INTO ts_area VALUES ('2490','会东县','2484');
INSERT INTO ts_area VALUES ('2491','宁南县','2484');
INSERT INTO ts_area VALUES ('2492','普格县','2484');
INSERT INTO ts_area VALUES ('2493','布拖县','2484');
INSERT INTO ts_area VALUES ('2494','金阳县','2484');
INSERT INTO ts_area VALUES ('2495','昭觉县','2484');
INSERT INTO ts_area VALUES ('2496','喜德县','2484');
INSERT INTO ts_area VALUES ('2497','冕宁县','2484');
INSERT INTO ts_area VALUES ('2498','越西县','2484');
INSERT INTO ts_area VALUES ('2499','甘洛县','2484');
INSERT INTO ts_area VALUES ('2500','美姑县','2484');
INSERT INTO ts_area VALUES ('2501','雷波县','2484');
INSERT INTO ts_area VALUES ('2502','贵州','0');
INSERT INTO ts_area VALUES ('2503','贵阳市','2502');
INSERT INTO ts_area VALUES ('2504','南明区','2503');
INSERT INTO ts_area VALUES ('2505','云岩区','2503');
INSERT INTO ts_area VALUES ('2506','花溪区','2503');
INSERT INTO ts_area VALUES ('2507','乌当区','2503');
INSERT INTO ts_area VALUES ('2508','白云区','2503');
INSERT INTO ts_area VALUES ('2509','小河区','2503');
INSERT INTO ts_area VALUES ('2510','开阳县','2503');
INSERT INTO ts_area VALUES ('2511','息烽县','2503');
INSERT INTO ts_area VALUES ('2512','修文县','2503');
INSERT INTO ts_area VALUES ('2513','清镇市','2503');
INSERT INTO ts_area VALUES ('2514','六盘水市','2502');
INSERT INTO ts_area VALUES ('2515','钟山区','2514');
INSERT INTO ts_area VALUES ('2516','六枝特区','2514');
INSERT INTO ts_area VALUES ('2517','水城县','2514');
INSERT INTO ts_area VALUES ('2518','盘县','2514');
INSERT INTO ts_area VALUES ('2519','遵义市','2502');
INSERT INTO ts_area VALUES ('2520','红花岗区','2519');
INSERT INTO ts_area VALUES ('2521','汇川区','2519');
INSERT INTO ts_area VALUES ('2522','遵义县','2519');
INSERT INTO ts_area VALUES ('2523','桐梓县','2519');
INSERT INTO ts_area VALUES ('2524','绥阳县','2519');
INSERT INTO ts_area VALUES ('2525','正安县','2519');
INSERT INTO ts_area VALUES ('2526','道真仡佬族苗族自治县','2519');
INSERT INTO ts_area VALUES ('2527','务川仡佬族苗族自治县','2519');
INSERT INTO ts_area VALUES ('2528','凤冈县','2519');
INSERT INTO ts_area VALUES ('2529','湄潭县','2519');
INSERT INTO ts_area VALUES ('2530','余庆县','2519');
INSERT INTO ts_area VALUES ('2531','习水县','2519');
INSERT INTO ts_area VALUES ('2532','赤水市','2519');
INSERT INTO ts_area VALUES ('2533','仁怀市','2519');
INSERT INTO ts_area VALUES ('2534','安顺市','2502');
INSERT INTO ts_area VALUES ('2535','西秀区','2534');
INSERT INTO ts_area VALUES ('2536','平坝县','2534');
INSERT INTO ts_area VALUES ('2537','普定县','2534');
INSERT INTO ts_area VALUES ('2538','镇宁布依族苗族自治县','2534');
INSERT INTO ts_area VALUES ('2539','关岭布依族苗族自治县','2534');
INSERT INTO ts_area VALUES ('2540','紫云苗族布依族自治县','2534');
INSERT INTO ts_area VALUES ('2541','铜仁地区','2502');
INSERT INTO ts_area VALUES ('2542','铜仁市','2541');
INSERT INTO ts_area VALUES ('2543','江口县','2541');
INSERT INTO ts_area VALUES ('2544','玉屏侗族自治县','2541');
INSERT INTO ts_area VALUES ('2545','石阡县','2541');
INSERT INTO ts_area VALUES ('2546','思南县','2541');
INSERT INTO ts_area VALUES ('2547','印江土家族苗族自治县','2541');
INSERT INTO ts_area VALUES ('2548','德江县','2541');
INSERT INTO ts_area VALUES ('2549','沿河土家族自治县','2541');
INSERT INTO ts_area VALUES ('2550','松桃苗族自治县','2541');
INSERT INTO ts_area VALUES ('2551','万山特区','2541');
INSERT INTO ts_area VALUES ('2552','黔西南布依族苗族自治州','2502');
INSERT INTO ts_area VALUES ('2553','兴义市','2552');
INSERT INTO ts_area VALUES ('2554','兴仁县','2552');
INSERT INTO ts_area VALUES ('2555','普安县','2552');
INSERT INTO ts_area VALUES ('2556','晴隆县','2552');
INSERT INTO ts_area VALUES ('2557','贞丰县','2552');
INSERT INTO ts_area VALUES ('2558','望谟县','2552');
INSERT INTO ts_area VALUES ('2559','册亨县','2552');
INSERT INTO ts_area VALUES ('2560','安龙县','2552');
INSERT INTO ts_area VALUES ('2561','毕节地区','2502');
INSERT INTO ts_area VALUES ('2562','毕节市','2561');
INSERT INTO ts_area VALUES ('2563','大方县','2561');
INSERT INTO ts_area VALUES ('2564','黔西县','2561');
INSERT INTO ts_area VALUES ('2565','金沙县','2561');
INSERT INTO ts_area VALUES ('2566','织金县','2561');
INSERT INTO ts_area VALUES ('2567','纳雍县','2561');
INSERT INTO ts_area VALUES ('2568','威宁彝族回族苗族自治县','2561');
INSERT INTO ts_area VALUES ('2569','赫章县','2561');
INSERT INTO ts_area VALUES ('2570','黔东南苗族侗族自治州','2502');
INSERT INTO ts_area VALUES ('2571','凯里市','2570');
INSERT INTO ts_area VALUES ('2572','黄平县','2570');
INSERT INTO ts_area VALUES ('2573','施秉县','2570');
INSERT INTO ts_area VALUES ('2574','三穗县','2570');
INSERT INTO ts_area VALUES ('2575','镇远县','2570');
INSERT INTO ts_area VALUES ('2576','岑巩县','2570');
INSERT INTO ts_area VALUES ('2577','天柱县','2570');
INSERT INTO ts_area VALUES ('2578','锦屏县','2570');
INSERT INTO ts_area VALUES ('2579','剑河县','2570');
INSERT INTO ts_area VALUES ('2580','台江县','2570');
INSERT INTO ts_area VALUES ('2581','黎平县','2570');
INSERT INTO ts_area VALUES ('2582','榕江县','2570');
INSERT INTO ts_area VALUES ('2583','从江县','2570');
INSERT INTO ts_area VALUES ('2584','雷山县','2570');
INSERT INTO ts_area VALUES ('2585','麻江县','2570');
INSERT INTO ts_area VALUES ('2586','丹寨县','2570');
INSERT INTO ts_area VALUES ('2587','黔南布依族苗族自治州','2502');
INSERT INTO ts_area VALUES ('2588','都匀市','2587');
INSERT INTO ts_area VALUES ('2589','福泉市','2587');
INSERT INTO ts_area VALUES ('2590','荔波县','2587');
INSERT INTO ts_area VALUES ('2591','贵定县','2587');
INSERT INTO ts_area VALUES ('2592','瓮安县','2587');
INSERT INTO ts_area VALUES ('2593','独山县','2587');
INSERT INTO ts_area VALUES ('2594','平塘县','2587');
INSERT INTO ts_area VALUES ('2595','罗甸县','2587');
INSERT INTO ts_area VALUES ('2596','长顺县','2587');
INSERT INTO ts_area VALUES ('2597','龙里县','2587');
INSERT INTO ts_area VALUES ('2598','惠水县','2587');
INSERT INTO ts_area VALUES ('2599','三都水族自治县','2587');
INSERT INTO ts_area VALUES ('2600','云南','0');
INSERT INTO ts_area VALUES ('2601','昆明市','2600');
INSERT INTO ts_area VALUES ('2602','五华区','2601');
INSERT INTO ts_area VALUES ('2603','盘龙区','2601');
INSERT INTO ts_area VALUES ('2604','官渡区','2601');
INSERT INTO ts_area VALUES ('2605','西山区','2601');
INSERT INTO ts_area VALUES ('2606','东川区','2601');
INSERT INTO ts_area VALUES ('2607','呈贡县','2601');
INSERT INTO ts_area VALUES ('2608','晋宁县','2601');
INSERT INTO ts_area VALUES ('2609','富民县','2601');
INSERT INTO ts_area VALUES ('2610','宜良县','2601');
INSERT INTO ts_area VALUES ('2611','石林彝族自治县','2601');
INSERT INTO ts_area VALUES ('2612','嵩明县','2601');
INSERT INTO ts_area VALUES ('2613','禄劝彝族苗族自治县','2601');
INSERT INTO ts_area VALUES ('2614','寻甸回族彝族自治县','2601');
INSERT INTO ts_area VALUES ('2615','安宁市','2601');
INSERT INTO ts_area VALUES ('2616','曲靖市','2600');
INSERT INTO ts_area VALUES ('2617','麒麟区','2616');
INSERT INTO ts_area VALUES ('2618','马龙县','2616');
INSERT INTO ts_area VALUES ('2619','陆良县','2616');
INSERT INTO ts_area VALUES ('2620','师宗县','2616');
INSERT INTO ts_area VALUES ('2621','罗平县','2616');
INSERT INTO ts_area VALUES ('2622','富源县','2616');
INSERT INTO ts_area VALUES ('2623','会泽县','2616');
INSERT INTO ts_area VALUES ('2624','沾益县','2616');
INSERT INTO ts_area VALUES ('2625','宣威市','2616');
INSERT INTO ts_area VALUES ('2626','玉溪市','2600');
INSERT INTO ts_area VALUES ('2627','红塔区','2626');
INSERT INTO ts_area VALUES ('2628','江川县','2626');
INSERT INTO ts_area VALUES ('2629','澄江县','2626');
INSERT INTO ts_area VALUES ('2630','通海县','2626');
INSERT INTO ts_area VALUES ('2631','华宁县','2626');
INSERT INTO ts_area VALUES ('2632','易门县','2626');
INSERT INTO ts_area VALUES ('2633','峨山彝族自治县','2626');
INSERT INTO ts_area VALUES ('2634','新平彝族傣族自治县','2626');
INSERT INTO ts_area VALUES ('2635','元江哈尼族彝族傣族自治县','2626');
INSERT INTO ts_area VALUES ('2636','保山市','2600');
INSERT INTO ts_area VALUES ('2637','隆阳区','2636');
INSERT INTO ts_area VALUES ('2638','施甸县','2636');
INSERT INTO ts_area VALUES ('2639','腾冲县','2636');
INSERT INTO ts_area VALUES ('2640','龙陵县','2636');
INSERT INTO ts_area VALUES ('2641','昌宁县','2636');
INSERT INTO ts_area VALUES ('2642','昭通市','2600');
INSERT INTO ts_area VALUES ('2643','昭阳区','2642');
INSERT INTO ts_area VALUES ('2644','鲁甸县','2642');
INSERT INTO ts_area VALUES ('2645','巧家县','2642');
INSERT INTO ts_area VALUES ('2646','盐津县','2642');
INSERT INTO ts_area VALUES ('2647','大关县','2642');
INSERT INTO ts_area VALUES ('2648','永善县','2642');
INSERT INTO ts_area VALUES ('2649','绥江县','2642');
INSERT INTO ts_area VALUES ('2650','镇雄县','2642');
INSERT INTO ts_area VALUES ('2651','彝良县','2642');
INSERT INTO ts_area VALUES ('2652','威信县','2642');
INSERT INTO ts_area VALUES ('2653','水富县','2642');
INSERT INTO ts_area VALUES ('2654','丽江市','2600');
INSERT INTO ts_area VALUES ('2655','古城区','2654');
INSERT INTO ts_area VALUES ('2656','玉龙纳西族自治县','2654');
INSERT INTO ts_area VALUES ('2657','永胜县','2654');
INSERT INTO ts_area VALUES ('2658','华坪县','2654');
INSERT INTO ts_area VALUES ('2659','宁蒗彝族自治县','2654');
INSERT INTO ts_area VALUES ('2660','普洱市','2600');
INSERT INTO ts_area VALUES ('2661','思茅区','2660');
INSERT INTO ts_area VALUES ('2662','宁洱哈尼族彝族自治县','2660');
INSERT INTO ts_area VALUES ('2663','墨江哈尼族自治县','2660');
INSERT INTO ts_area VALUES ('2664','景东彝族自治县','2660');
INSERT INTO ts_area VALUES ('2665','景谷傣族彝族自治县','2660');
INSERT INTO ts_area VALUES ('2666','镇沅彝族哈尼族拉祜族自治县','2660');
INSERT INTO ts_area VALUES ('2667','江城哈尼族彝族自治县','2660');
INSERT INTO ts_area VALUES ('2668','孟连傣族拉祜族佤族自治县','2660');
INSERT INTO ts_area VALUES ('2669','澜沧拉祜族自治县','2660');
INSERT INTO ts_area VALUES ('2670','西盟佤族自治县','2660');
INSERT INTO ts_area VALUES ('2671','临沧市','2600');
INSERT INTO ts_area VALUES ('2672','临翔区','2671');
INSERT INTO ts_area VALUES ('2673','凤庆县','2671');
INSERT INTO ts_area VALUES ('2674','云县','2671');
INSERT INTO ts_area VALUES ('2675','永德县','2671');
INSERT INTO ts_area VALUES ('2676','镇康县','2671');
INSERT INTO ts_area VALUES ('2677','双江拉祜族佤族布朗族傣族自治县','2671');
INSERT INTO ts_area VALUES ('2678','耿马傣族佤族自治县','2671');
INSERT INTO ts_area VALUES ('2679','沧源佤族自治县','2671');
INSERT INTO ts_area VALUES ('2680','楚雄彝族自治州','2600');
INSERT INTO ts_area VALUES ('2681','楚雄市','2680');
INSERT INTO ts_area VALUES ('2682','双柏县','2680');
INSERT INTO ts_area VALUES ('2683','牟定县','2680');
INSERT INTO ts_area VALUES ('2684','南华县','2680');
INSERT INTO ts_area VALUES ('2685','姚安县','2680');
INSERT INTO ts_area VALUES ('2686','大姚县','2680');
INSERT INTO ts_area VALUES ('2687','永仁县','2680');
INSERT INTO ts_area VALUES ('2688','元谋县','2680');
INSERT INTO ts_area VALUES ('2689','武定县','2680');
INSERT INTO ts_area VALUES ('2690','禄丰县','2680');
INSERT INTO ts_area VALUES ('2691','红河哈尼族彝族自治州','2600');
INSERT INTO ts_area VALUES ('2692','个旧市','2691');
INSERT INTO ts_area VALUES ('2693','开远市','2691');
INSERT INTO ts_area VALUES ('2694','蒙自县','2691');
INSERT INTO ts_area VALUES ('2695','屏边苗族自治县','2691');
INSERT INTO ts_area VALUES ('2696','建水县','2691');
INSERT INTO ts_area VALUES ('2697','石屏县','2691');
INSERT INTO ts_area VALUES ('2698','弥勒县','2691');
INSERT INTO ts_area VALUES ('2699','泸西县','2691');
INSERT INTO ts_area VALUES ('2700','元阳县','2691');
INSERT INTO ts_area VALUES ('2701','红河县','2691');
INSERT INTO ts_area VALUES ('2702','金平苗族瑶族傣族自治县','2691');
INSERT INTO ts_area VALUES ('2703','绿春县','2691');
INSERT INTO ts_area VALUES ('2704','河口瑶族自治县','2691');
INSERT INTO ts_area VALUES ('2705','文山壮族苗族自治州','2600');
INSERT INTO ts_area VALUES ('2706','文山县','2705');
INSERT INTO ts_area VALUES ('2707','砚山县','2705');
INSERT INTO ts_area VALUES ('2708','西畴县','2705');
INSERT INTO ts_area VALUES ('2709','麻栗坡县','2705');
INSERT INTO ts_area VALUES ('2710','马关县','2705');
INSERT INTO ts_area VALUES ('2711','丘北县','2705');
INSERT INTO ts_area VALUES ('2712','广南县','2705');
INSERT INTO ts_area VALUES ('2713','富宁县','2705');
INSERT INTO ts_area VALUES ('2714','西双版纳傣族自治州','2600');
INSERT INTO ts_area VALUES ('2715','景洪市','2714');
INSERT INTO ts_area VALUES ('2716','勐海县','2714');
INSERT INTO ts_area VALUES ('2717','勐腊县','2714');
INSERT INTO ts_area VALUES ('2718','大理白族自治州','2600');
INSERT INTO ts_area VALUES ('2719','大理市','2718');
INSERT INTO ts_area VALUES ('2720','漾濞彝族自治县','2718');
INSERT INTO ts_area VALUES ('2721','祥云县','2718');
INSERT INTO ts_area VALUES ('2722','宾川县','2718');
INSERT INTO ts_area VALUES ('2723','弥渡县','2718');
INSERT INTO ts_area VALUES ('2724','南涧彝族自治县','2718');
INSERT INTO ts_area VALUES ('2725','巍山彝族回族自治县','2718');
INSERT INTO ts_area VALUES ('2726','永平县','2718');
INSERT INTO ts_area VALUES ('2727','云龙县','2718');
INSERT INTO ts_area VALUES ('2728','洱源县','2718');
INSERT INTO ts_area VALUES ('2729','剑川县','2718');
INSERT INTO ts_area VALUES ('2730','鹤庆县','2718');
INSERT INTO ts_area VALUES ('2731','德宏傣族景颇族自治州','2600');
INSERT INTO ts_area VALUES ('2732','瑞丽市','2731');
INSERT INTO ts_area VALUES ('2733','潞西市','2731');
INSERT INTO ts_area VALUES ('2734','梁河县','2731');
INSERT INTO ts_area VALUES ('2735','盈江县','2731');
INSERT INTO ts_area VALUES ('2736','陇川县','2731');
INSERT INTO ts_area VALUES ('2737','怒江傈僳族自治州','2600');
INSERT INTO ts_area VALUES ('2738','泸水县','2737');
INSERT INTO ts_area VALUES ('2739','福贡县','2737');
INSERT INTO ts_area VALUES ('2740','贡山独龙族怒族自治县','2737');
INSERT INTO ts_area VALUES ('2741','兰坪白族普米族自治县','2737');
INSERT INTO ts_area VALUES ('2742','迪庆藏族自治州','2600');
INSERT INTO ts_area VALUES ('2743','香格里拉县','2742');
INSERT INTO ts_area VALUES ('2744','德钦县','2742');
INSERT INTO ts_area VALUES ('2745','维西傈僳族自治县','2742');
INSERT INTO ts_area VALUES ('2746','西藏','0');
INSERT INTO ts_area VALUES ('2747','拉萨市','2746');
INSERT INTO ts_area VALUES ('2748','城关区','2747');
INSERT INTO ts_area VALUES ('2749','林周县','2747');
INSERT INTO ts_area VALUES ('2750','当雄县','2747');
INSERT INTO ts_area VALUES ('2751','尼木县','2747');
INSERT INTO ts_area VALUES ('2752','曲水县','2747');
INSERT INTO ts_area VALUES ('2753','堆龙德庆县','2747');
INSERT INTO ts_area VALUES ('2754','达孜县','2747');
INSERT INTO ts_area VALUES ('2755','墨竹工卡县','2747');
INSERT INTO ts_area VALUES ('2756','昌都地区','2746');
INSERT INTO ts_area VALUES ('2757','昌都县','2756');
INSERT INTO ts_area VALUES ('2758','江达县','2756');
INSERT INTO ts_area VALUES ('2759','贡觉县','2756');
INSERT INTO ts_area VALUES ('2760','类乌齐县','2756');
INSERT INTO ts_area VALUES ('2761','丁青县','2756');
INSERT INTO ts_area VALUES ('2762','察雅县','2756');
INSERT INTO ts_area VALUES ('2763','八宿县','2756');
INSERT INTO ts_area VALUES ('2764','左贡县','2756');
INSERT INTO ts_area VALUES ('2765','芒康县','2756');
INSERT INTO ts_area VALUES ('2766','洛隆县','2756');
INSERT INTO ts_area VALUES ('2767','边坝县','2756');
INSERT INTO ts_area VALUES ('2768','山南地区','2746');
INSERT INTO ts_area VALUES ('2769','乃东县','2768');
INSERT INTO ts_area VALUES ('2770','扎囊县','2768');
INSERT INTO ts_area VALUES ('2771','贡嘎县','2768');
INSERT INTO ts_area VALUES ('2772','桑日县','2768');
INSERT INTO ts_area VALUES ('2773','琼结县','2768');
INSERT INTO ts_area VALUES ('2774','曲松县','2768');
INSERT INTO ts_area VALUES ('2775','措美县','2768');
INSERT INTO ts_area VALUES ('2776','洛扎县','2768');
INSERT INTO ts_area VALUES ('2777','加查县','2768');
INSERT INTO ts_area VALUES ('2778','隆子县','2768');
INSERT INTO ts_area VALUES ('2779','错那县','2768');
INSERT INTO ts_area VALUES ('2780','浪卡子县','2768');
INSERT INTO ts_area VALUES ('2781','日喀则地区','2746');
INSERT INTO ts_area VALUES ('2782','日喀则市','2781');
INSERT INTO ts_area VALUES ('2783','南木林县','2781');
INSERT INTO ts_area VALUES ('2784','江孜县','2781');
INSERT INTO ts_area VALUES ('2785','定日县','2781');
INSERT INTO ts_area VALUES ('2786','萨迦县','2781');
INSERT INTO ts_area VALUES ('2787','拉孜县','2781');
INSERT INTO ts_area VALUES ('2788','昂仁县','2781');
INSERT INTO ts_area VALUES ('2789','谢通门县','2781');
INSERT INTO ts_area VALUES ('2790','白朗县','2781');
INSERT INTO ts_area VALUES ('2791','仁布县','2781');
INSERT INTO ts_area VALUES ('2792','康马县','2781');
INSERT INTO ts_area VALUES ('2793','定结县','2781');
INSERT INTO ts_area VALUES ('2794','仲巴县','2781');
INSERT INTO ts_area VALUES ('2795','亚东县','2781');
INSERT INTO ts_area VALUES ('2796','吉隆县','2781');
INSERT INTO ts_area VALUES ('2797','聂拉木县','2781');
INSERT INTO ts_area VALUES ('2798','萨嘎县','2781');
INSERT INTO ts_area VALUES ('2799','岗巴县','2781');
INSERT INTO ts_area VALUES ('2800','那曲地区','2746');
INSERT INTO ts_area VALUES ('2801','那曲县','2800');
INSERT INTO ts_area VALUES ('2802','嘉黎县','2800');
INSERT INTO ts_area VALUES ('2803','比如县','2800');
INSERT INTO ts_area VALUES ('2804','聂荣县','2800');
INSERT INTO ts_area VALUES ('2805','安多县','2800');
INSERT INTO ts_area VALUES ('2806','申扎县','2800');
INSERT INTO ts_area VALUES ('2807','索县','2800');
INSERT INTO ts_area VALUES ('2808','班戈县','2800');
INSERT INTO ts_area VALUES ('2809','巴青县','2800');
INSERT INTO ts_area VALUES ('2810','尼玛县','2800');
INSERT INTO ts_area VALUES ('2811','阿里地区','2746');
INSERT INTO ts_area VALUES ('2812','普兰县','2811');
INSERT INTO ts_area VALUES ('2813','札达县','2811');
INSERT INTO ts_area VALUES ('2814','噶尔县','2811');
INSERT INTO ts_area VALUES ('2815','日土县','2811');
INSERT INTO ts_area VALUES ('2816','革吉县','2811');
INSERT INTO ts_area VALUES ('2817','改则县','2811');
INSERT INTO ts_area VALUES ('2818','措勤县','2811');
INSERT INTO ts_area VALUES ('2819','林芝地区','2746');
INSERT INTO ts_area VALUES ('2820','林芝县','2819');
INSERT INTO ts_area VALUES ('2821','工布江达县','2819');
INSERT INTO ts_area VALUES ('2822','米林县','2819');
INSERT INTO ts_area VALUES ('2823','墨脱县','2819');
INSERT INTO ts_area VALUES ('2824','波密县','2819');
INSERT INTO ts_area VALUES ('2825','察隅县','2819');
INSERT INTO ts_area VALUES ('2826','朗县','2819');
INSERT INTO ts_area VALUES ('2827','陕西','0');
INSERT INTO ts_area VALUES ('2828','西安市','2827');
INSERT INTO ts_area VALUES ('2829','新城区','2828');
INSERT INTO ts_area VALUES ('2830','碑林区','2828');
INSERT INTO ts_area VALUES ('2831','莲湖区','2828');
INSERT INTO ts_area VALUES ('2832','灞桥区','2828');
INSERT INTO ts_area VALUES ('2833','未央区','2828');
INSERT INTO ts_area VALUES ('2834','雁塔区','2828');
INSERT INTO ts_area VALUES ('2835','阎良区','2828');
INSERT INTO ts_area VALUES ('2836','临潼区','2828');
INSERT INTO ts_area VALUES ('2837','长安区','2828');
INSERT INTO ts_area VALUES ('2838','蓝田县','2828');
INSERT INTO ts_area VALUES ('2839','周至县','2828');
INSERT INTO ts_area VALUES ('2840','户县','2828');
INSERT INTO ts_area VALUES ('2841','高陵县','2828');
INSERT INTO ts_area VALUES ('2842','铜川市','2827');
INSERT INTO ts_area VALUES ('2843','王益区','2842');
INSERT INTO ts_area VALUES ('2844','印台区','2842');
INSERT INTO ts_area VALUES ('2845','耀州区','2842');
INSERT INTO ts_area VALUES ('2846','宜君县','2842');
INSERT INTO ts_area VALUES ('2847','宝鸡市','2827');
INSERT INTO ts_area VALUES ('2848','渭滨区','2847');
INSERT INTO ts_area VALUES ('2849','金台区','2847');
INSERT INTO ts_area VALUES ('2850','陈仓区','2847');
INSERT INTO ts_area VALUES ('2851','凤翔县','2847');
INSERT INTO ts_area VALUES ('2852','岐山县','2847');
INSERT INTO ts_area VALUES ('2853','扶风县','2847');
INSERT INTO ts_area VALUES ('2854','眉县','2847');
INSERT INTO ts_area VALUES ('2855','陇县','2847');
INSERT INTO ts_area VALUES ('2856','千阳县','2847');
INSERT INTO ts_area VALUES ('2857','麟游县','2847');
INSERT INTO ts_area VALUES ('2858','凤县','2847');
INSERT INTO ts_area VALUES ('2859','太白县','2847');
INSERT INTO ts_area VALUES ('2860','咸阳市','2827');
INSERT INTO ts_area VALUES ('2861','秦都区','2860');
INSERT INTO ts_area VALUES ('2862','杨凌区','2860');
INSERT INTO ts_area VALUES ('2863','渭城区','2860');
INSERT INTO ts_area VALUES ('2864','三原县','2860');
INSERT INTO ts_area VALUES ('2865','泾阳县','2860');
INSERT INTO ts_area VALUES ('2866','乾县','2860');
INSERT INTO ts_area VALUES ('2867','礼泉县','2860');
INSERT INTO ts_area VALUES ('2868','永寿县','2860');
INSERT INTO ts_area VALUES ('2869','彬县','2860');
INSERT INTO ts_area VALUES ('2870','长武县','2860');
INSERT INTO ts_area VALUES ('2871','旬邑县','2860');
INSERT INTO ts_area VALUES ('2872','淳化县','2860');
INSERT INTO ts_area VALUES ('2873','武功县','2860');
INSERT INTO ts_area VALUES ('2874','兴平市','2860');
INSERT INTO ts_area VALUES ('2875','渭南市','2827');
INSERT INTO ts_area VALUES ('2876','临渭区','2875');
INSERT INTO ts_area VALUES ('2877','华县','2875');
INSERT INTO ts_area VALUES ('2878','潼关县','2875');
INSERT INTO ts_area VALUES ('2879','大荔县','2875');
INSERT INTO ts_area VALUES ('2880','合阳县','2875');
INSERT INTO ts_area VALUES ('2881','澄城县','2875');
INSERT INTO ts_area VALUES ('2882','蒲城县','2875');
INSERT INTO ts_area VALUES ('2883','白水县','2875');
INSERT INTO ts_area VALUES ('2884','富平县','2875');
INSERT INTO ts_area VALUES ('2885','韩城市','2875');
INSERT INTO ts_area VALUES ('2886','华阴市','2875');
INSERT INTO ts_area VALUES ('2887','延安市','2827');
INSERT INTO ts_area VALUES ('2888','宝塔区','2887');
INSERT INTO ts_area VALUES ('2889','延长县','2887');
INSERT INTO ts_area VALUES ('2890','延川县','2887');
INSERT INTO ts_area VALUES ('2891','子长县','2887');
INSERT INTO ts_area VALUES ('2892','安塞县','2887');
INSERT INTO ts_area VALUES ('2893','志丹县','2887');
INSERT INTO ts_area VALUES ('2894','吴起县','2887');
INSERT INTO ts_area VALUES ('2895','甘泉县','2887');
INSERT INTO ts_area VALUES ('2896','富县','2887');
INSERT INTO ts_area VALUES ('2897','洛川县','2887');
INSERT INTO ts_area VALUES ('2898','宜川县','2887');
INSERT INTO ts_area VALUES ('2899','黄龙县','2887');
INSERT INTO ts_area VALUES ('2900','黄陵县','2887');
INSERT INTO ts_area VALUES ('2901','汉中市','2827');
INSERT INTO ts_area VALUES ('2902','汉台区','2901');
INSERT INTO ts_area VALUES ('2903','南郑县','2901');
INSERT INTO ts_area VALUES ('2904','城固县','2901');
INSERT INTO ts_area VALUES ('2905','洋县','2901');
INSERT INTO ts_area VALUES ('2906','西乡县','2901');
INSERT INTO ts_area VALUES ('2907','勉县','2901');
INSERT INTO ts_area VALUES ('2908','宁强县','2901');
INSERT INTO ts_area VALUES ('2909','略阳县','2901');
INSERT INTO ts_area VALUES ('2910','镇巴县','2901');
INSERT INTO ts_area VALUES ('2911','留坝县','2901');
INSERT INTO ts_area VALUES ('2912','佛坪县','2901');
INSERT INTO ts_area VALUES ('2913','榆林市','2827');
INSERT INTO ts_area VALUES ('2914','榆阳区','2913');
INSERT INTO ts_area VALUES ('2915','神木县','2913');
INSERT INTO ts_area VALUES ('2916','府谷县','2913');
INSERT INTO ts_area VALUES ('2917','横山县','2913');
INSERT INTO ts_area VALUES ('2918','靖边县','2913');
INSERT INTO ts_area VALUES ('2919','定边县','2913');
INSERT INTO ts_area VALUES ('2920','绥德县','2913');
INSERT INTO ts_area VALUES ('2921','米脂县','2913');
INSERT INTO ts_area VALUES ('2922','佳县','2913');
INSERT INTO ts_area VALUES ('2923','吴堡县','2913');
INSERT INTO ts_area VALUES ('2924','清涧县','2913');
INSERT INTO ts_area VALUES ('2925','子洲县','2913');
INSERT INTO ts_area VALUES ('2926','安康市','2827');
INSERT INTO ts_area VALUES ('2927','汉滨区','2926');
INSERT INTO ts_area VALUES ('2928','汉阴县','2926');
INSERT INTO ts_area VALUES ('2929','石泉县','2926');
INSERT INTO ts_area VALUES ('2930','宁陕县','2926');
INSERT INTO ts_area VALUES ('2931','紫阳县','2926');
INSERT INTO ts_area VALUES ('2932','岚皋县','2926');
INSERT INTO ts_area VALUES ('2933','平利县','2926');
INSERT INTO ts_area VALUES ('2934','镇坪县','2926');
INSERT INTO ts_area VALUES ('2935','旬阳县','2926');
INSERT INTO ts_area VALUES ('2936','白河县','2926');
INSERT INTO ts_area VALUES ('2937','商洛市','2827');
INSERT INTO ts_area VALUES ('2938','商州区','2937');
INSERT INTO ts_area VALUES ('2939','洛南县','2937');
INSERT INTO ts_area VALUES ('2940','丹凤县','2937');
INSERT INTO ts_area VALUES ('2941','商南县','2937');
INSERT INTO ts_area VALUES ('2942','山阳县','2937');
INSERT INTO ts_area VALUES ('2943','镇安县','2937');
INSERT INTO ts_area VALUES ('2944','柞水县','2937');
INSERT INTO ts_area VALUES ('2945','甘肃','0');
INSERT INTO ts_area VALUES ('2946','兰州市','2945');
INSERT INTO ts_area VALUES ('2947','城关区','2946');
INSERT INTO ts_area VALUES ('2948','七里河区','2946');
INSERT INTO ts_area VALUES ('2949','西固区','2946');
INSERT INTO ts_area VALUES ('2950','安宁区','2946');
INSERT INTO ts_area VALUES ('2951','红古区','2946');
INSERT INTO ts_area VALUES ('2952','永登县','2946');
INSERT INTO ts_area VALUES ('2953','皋兰县','2946');
INSERT INTO ts_area VALUES ('2954','榆中县','2946');
INSERT INTO ts_area VALUES ('2955','嘉峪关市','2945');
INSERT INTO ts_area VALUES ('2956','金昌市','2945');
INSERT INTO ts_area VALUES ('2957','金川区','2956');
INSERT INTO ts_area VALUES ('2958','永昌县','2956');
INSERT INTO ts_area VALUES ('2959','白银市','2945');
INSERT INTO ts_area VALUES ('2960','白银区','2959');
INSERT INTO ts_area VALUES ('2961','平川区','2959');
INSERT INTO ts_area VALUES ('2962','靖远县','2959');
INSERT INTO ts_area VALUES ('2963','会宁县','2959');
INSERT INTO ts_area VALUES ('2964','景泰县','2959');
INSERT INTO ts_area VALUES ('2965','天水市','2945');
INSERT INTO ts_area VALUES ('2966','秦州区','2965');
INSERT INTO ts_area VALUES ('2967','麦积区','2965');
INSERT INTO ts_area VALUES ('2968','清水县','2965');
INSERT INTO ts_area VALUES ('2969','秦安县','2965');
INSERT INTO ts_area VALUES ('2970','甘谷县','2965');
INSERT INTO ts_area VALUES ('2971','武山县','2965');
INSERT INTO ts_area VALUES ('2972','张家川回族自治县','2965');
INSERT INTO ts_area VALUES ('2973','武威市','2945');
INSERT INTO ts_area VALUES ('2974','凉州区','2973');
INSERT INTO ts_area VALUES ('2975','民勤县','2973');
INSERT INTO ts_area VALUES ('2976','古浪县','2973');
INSERT INTO ts_area VALUES ('2977','天祝藏族自治县','2973');
INSERT INTO ts_area VALUES ('2978','张掖市','2945');
INSERT INTO ts_area VALUES ('2979','甘州区','2978');
INSERT INTO ts_area VALUES ('2980','肃南裕固族自治县','2978');
INSERT INTO ts_area VALUES ('2981','民乐县','2978');
INSERT INTO ts_area VALUES ('2982','临泽县','2978');
INSERT INTO ts_area VALUES ('2983','高台县','2978');
INSERT INTO ts_area VALUES ('2984','山丹县','2978');
INSERT INTO ts_area VALUES ('2985','平凉市','2945');
INSERT INTO ts_area VALUES ('2986','崆峒区','2985');
INSERT INTO ts_area VALUES ('2987','泾川县','2985');
INSERT INTO ts_area VALUES ('2988','灵台县','2985');
INSERT INTO ts_area VALUES ('2989','崇信县','2985');
INSERT INTO ts_area VALUES ('2990','华亭县','2985');
INSERT INTO ts_area VALUES ('2991','庄浪县','2985');
INSERT INTO ts_area VALUES ('2992','静宁县','2985');
INSERT INTO ts_area VALUES ('2993','酒泉市','2945');
INSERT INTO ts_area VALUES ('2994','肃州区','2993');
INSERT INTO ts_area VALUES ('2995','金塔县','2993');
INSERT INTO ts_area VALUES ('2996','瓜州县','2993');
INSERT INTO ts_area VALUES ('2997','肃北蒙古族自治县','2993');
INSERT INTO ts_area VALUES ('2998','阿克塞哈萨克族自治县','2993');
INSERT INTO ts_area VALUES ('2999','玉门市','2993');
INSERT INTO ts_area VALUES ('3000','敦煌市','2993');
INSERT INTO ts_area VALUES ('3001','庆阳市','2945');
INSERT INTO ts_area VALUES ('3002','西峰区','3001');
INSERT INTO ts_area VALUES ('3003','庆城县','3001');
INSERT INTO ts_area VALUES ('3004','环县','3001');
INSERT INTO ts_area VALUES ('3005','华池县','3001');
INSERT INTO ts_area VALUES ('3006','合水县','3001');
INSERT INTO ts_area VALUES ('3007','正宁县','3001');
INSERT INTO ts_area VALUES ('3008','宁县','3001');
INSERT INTO ts_area VALUES ('3009','镇原县','3001');
INSERT INTO ts_area VALUES ('3010','定西市','2945');
INSERT INTO ts_area VALUES ('3011','安定区','3010');
INSERT INTO ts_area VALUES ('3012','通渭县','3010');
INSERT INTO ts_area VALUES ('3013','陇西县','3010');
INSERT INTO ts_area VALUES ('3014','渭源县','3010');
INSERT INTO ts_area VALUES ('3015','临洮县','3010');
INSERT INTO ts_area VALUES ('3016','漳县','3010');
INSERT INTO ts_area VALUES ('3017','岷县','3010');
INSERT INTO ts_area VALUES ('3018','陇南市','2945');
INSERT INTO ts_area VALUES ('3019','武都区','3018');
INSERT INTO ts_area VALUES ('3020','成县','3018');
INSERT INTO ts_area VALUES ('3021','文县','3018');
INSERT INTO ts_area VALUES ('3022','宕昌县','3018');
INSERT INTO ts_area VALUES ('3023','康县','3018');
INSERT INTO ts_area VALUES ('3024','西和县','3018');
INSERT INTO ts_area VALUES ('3025','礼县','3018');
INSERT INTO ts_area VALUES ('3026','徽县','3018');
INSERT INTO ts_area VALUES ('3027','两当县','3018');
INSERT INTO ts_area VALUES ('3028','临夏回族自治州','2945');
INSERT INTO ts_area VALUES ('3029','临夏市','3028');
INSERT INTO ts_area VALUES ('3030','临夏县','3028');
INSERT INTO ts_area VALUES ('3031','康乐县','3028');
INSERT INTO ts_area VALUES ('3032','永靖县','3028');
INSERT INTO ts_area VALUES ('3033','广河县','3028');
INSERT INTO ts_area VALUES ('3034','和政县','3028');
INSERT INTO ts_area VALUES ('3035','东乡族自治县','3028');
INSERT INTO ts_area VALUES ('3036','积石山保安族东乡族撒拉族自治县','3028');
INSERT INTO ts_area VALUES ('3037','甘南藏族自治州','2945');
INSERT INTO ts_area VALUES ('3038','合作市','3037');
INSERT INTO ts_area VALUES ('3039','临潭县','3037');
INSERT INTO ts_area VALUES ('3040','卓尼县','3037');
INSERT INTO ts_area VALUES ('3041','舟曲县','3037');
INSERT INTO ts_area VALUES ('3042','迭部县','3037');
INSERT INTO ts_area VALUES ('3043','玛曲县','3037');
INSERT INTO ts_area VALUES ('3044','碌曲县','3037');
INSERT INTO ts_area VALUES ('3045','夏河县','3037');
INSERT INTO ts_area VALUES ('3046','青海','0');
INSERT INTO ts_area VALUES ('3047','西宁市','3046');
INSERT INTO ts_area VALUES ('3048','城东区','3047');
INSERT INTO ts_area VALUES ('3049','城中区','3047');
INSERT INTO ts_area VALUES ('3050','城西区','3047');
INSERT INTO ts_area VALUES ('3051','城北区','3047');
INSERT INTO ts_area VALUES ('3052','大通回族土族自治县','3047');
INSERT INTO ts_area VALUES ('3053','湟中县','3047');
INSERT INTO ts_area VALUES ('3054','湟源县','3047');
INSERT INTO ts_area VALUES ('3055','海东地区','3046');
INSERT INTO ts_area VALUES ('3056','平安县','3055');
INSERT INTO ts_area VALUES ('3057','民和回族土族自治县','3055');
INSERT INTO ts_area VALUES ('3058','乐都县','3055');
INSERT INTO ts_area VALUES ('3059','互助土族自治县','3055');
INSERT INTO ts_area VALUES ('3060','化隆回族自治县','3055');
INSERT INTO ts_area VALUES ('3061','循化撒拉族自治县','3055');
INSERT INTO ts_area VALUES ('3062','海北藏族自治州','3046');
INSERT INTO ts_area VALUES ('3063','门源回族自治县','3062');
INSERT INTO ts_area VALUES ('3064','祁连县','3062');
INSERT INTO ts_area VALUES ('3065','海晏县','3062');
INSERT INTO ts_area VALUES ('3066','刚察县','3062');
INSERT INTO ts_area VALUES ('3067','黄南藏族自治州','3046');
INSERT INTO ts_area VALUES ('3068','同仁县','3067');
INSERT INTO ts_area VALUES ('3069','尖扎县','3067');
INSERT INTO ts_area VALUES ('3070','泽库县','3067');
INSERT INTO ts_area VALUES ('3071','河南蒙古族自治县','3067');
INSERT INTO ts_area VALUES ('3072','海南藏族自治州','3046');
INSERT INTO ts_area VALUES ('3073','共和县','3072');
INSERT INTO ts_area VALUES ('3074','同德县','3072');
INSERT INTO ts_area VALUES ('3075','贵德县','3072');
INSERT INTO ts_area VALUES ('3076','兴海县','3072');
INSERT INTO ts_area VALUES ('3077','贵南县','3072');
INSERT INTO ts_area VALUES ('3078','果洛藏族自治州','3046');
INSERT INTO ts_area VALUES ('3079','玛沁县','3078');
INSERT INTO ts_area VALUES ('3080','班玛县','3078');
INSERT INTO ts_area VALUES ('3081','甘德县','3078');
INSERT INTO ts_area VALUES ('3082','达日县','3078');
INSERT INTO ts_area VALUES ('3083','久治县','3078');
INSERT INTO ts_area VALUES ('3084','玛多县','3078');
INSERT INTO ts_area VALUES ('3085','玉树藏族自治州','3046');
INSERT INTO ts_area VALUES ('3086','玉树县','3085');
INSERT INTO ts_area VALUES ('3087','杂多县','3085');
INSERT INTO ts_area VALUES ('3088','称多县','3085');
INSERT INTO ts_area VALUES ('3089','治多县','3085');
INSERT INTO ts_area VALUES ('3090','囊谦县','3085');
INSERT INTO ts_area VALUES ('3091','曲麻莱县','3085');
INSERT INTO ts_area VALUES ('3092','海西蒙古族藏族自治州','3046');
INSERT INTO ts_area VALUES ('3093','格尔木市','3092');
INSERT INTO ts_area VALUES ('3094','德令哈市','3092');
INSERT INTO ts_area VALUES ('3095','乌兰县','3092');
INSERT INTO ts_area VALUES ('3096','都兰县','3092');
INSERT INTO ts_area VALUES ('3097','天峻县','3092');
INSERT INTO ts_area VALUES ('3098','宁夏','0');
INSERT INTO ts_area VALUES ('3099','银川市','3098');
INSERT INTO ts_area VALUES ('3100','兴庆区','3099');
INSERT INTO ts_area VALUES ('3101','西夏区','3099');
INSERT INTO ts_area VALUES ('3102','金凤区','3099');
INSERT INTO ts_area VALUES ('3103','永宁县','3099');
INSERT INTO ts_area VALUES ('3104','贺兰县','3099');
INSERT INTO ts_area VALUES ('3105','灵武市','3099');
INSERT INTO ts_area VALUES ('3106','石嘴山市','3098');
INSERT INTO ts_area VALUES ('3107','大武口区','3106');
INSERT INTO ts_area VALUES ('3108','惠农区','3106');
INSERT INTO ts_area VALUES ('3109','平罗县','3106');
INSERT INTO ts_area VALUES ('3110','吴忠市','3098');
INSERT INTO ts_area VALUES ('3111','利通区','3110');
INSERT INTO ts_area VALUES ('3112','盐池县','3110');
INSERT INTO ts_area VALUES ('3113','同心县','3110');
INSERT INTO ts_area VALUES ('3114','青铜峡市','3110');
INSERT INTO ts_area VALUES ('3115','固原市','3098');
INSERT INTO ts_area VALUES ('3116','原州区','3115');
INSERT INTO ts_area VALUES ('3117','西吉县','3115');
INSERT INTO ts_area VALUES ('3118','隆德县','3115');
INSERT INTO ts_area VALUES ('3119','泾源县','3115');
INSERT INTO ts_area VALUES ('3120','彭阳县','3115');
INSERT INTO ts_area VALUES ('3121','中卫市','3098');
INSERT INTO ts_area VALUES ('3122','沙坡头区','3121');
INSERT INTO ts_area VALUES ('3123','中宁县','3121');
INSERT INTO ts_area VALUES ('3124','海原县','3121');
INSERT INTO ts_area VALUES ('3125','新疆','0');
INSERT INTO ts_area VALUES ('3126','乌鲁木齐市','3125');
INSERT INTO ts_area VALUES ('3127','天山区','3126');
INSERT INTO ts_area VALUES ('3128','沙依巴克区','3126');
INSERT INTO ts_area VALUES ('3129','新市区','3126');
INSERT INTO ts_area VALUES ('3130','水磨沟区','3126');
INSERT INTO ts_area VALUES ('3131','头屯河区','3126');
INSERT INTO ts_area VALUES ('3132','达坂城区','3126');
INSERT INTO ts_area VALUES ('3133','米东区','3126');
INSERT INTO ts_area VALUES ('3134','乌鲁木齐县','3126');
INSERT INTO ts_area VALUES ('3135','克拉玛依市','3125');
INSERT INTO ts_area VALUES ('3136','独山子区','3135');
INSERT INTO ts_area VALUES ('3137','克拉玛依区','3135');
INSERT INTO ts_area VALUES ('3138','白碱滩区','3135');
INSERT INTO ts_area VALUES ('3139','乌尔禾区','3135');
INSERT INTO ts_area VALUES ('3140','吐鲁番地区','3125');
INSERT INTO ts_area VALUES ('3141','吐鲁番市','3140');
INSERT INTO ts_area VALUES ('3142','鄯善县','3140');
INSERT INTO ts_area VALUES ('3143','托克逊县','3140');
INSERT INTO ts_area VALUES ('3144','哈密地区','3125');
INSERT INTO ts_area VALUES ('3145','昌吉回族自治州','3125');
INSERT INTO ts_area VALUES ('3146','昌吉市','3145');
INSERT INTO ts_area VALUES ('3147','阜康市','3145');
INSERT INTO ts_area VALUES ('3148','呼图壁县','3145');
INSERT INTO ts_area VALUES ('3149','玛纳斯县','3145');
INSERT INTO ts_area VALUES ('3150','奇台县','3145');
INSERT INTO ts_area VALUES ('3151','吉木萨尔县','3145');
INSERT INTO ts_area VALUES ('3152','木垒哈萨克自治县','3145');
INSERT INTO ts_area VALUES ('3153','博尔塔拉蒙古自治州','3125');
INSERT INTO ts_area VALUES ('3154','博乐市','3153');
INSERT INTO ts_area VALUES ('3155','精河县','3153');
INSERT INTO ts_area VALUES ('3156','温泉县','3153');
INSERT INTO ts_area VALUES ('3157','巴音郭楞蒙古自治州','3125');
INSERT INTO ts_area VALUES ('3158','库尔勒市','3157');
INSERT INTO ts_area VALUES ('3159','轮台县','3157');
INSERT INTO ts_area VALUES ('3160','尉犁县','3157');
INSERT INTO ts_area VALUES ('3161','若羌县','3157');
INSERT INTO ts_area VALUES ('3162','且末县','3157');
INSERT INTO ts_area VALUES ('3163','焉耆回族自治县','3157');
INSERT INTO ts_area VALUES ('3164','和静县','3157');
INSERT INTO ts_area VALUES ('3165','和硕县','3157');
INSERT INTO ts_area VALUES ('3166','博湖县','3157');
INSERT INTO ts_area VALUES ('3167','阿克苏地区','3125');
INSERT INTO ts_area VALUES ('3168','阿克苏市','3167');
INSERT INTO ts_area VALUES ('3169','温宿县','3167');
INSERT INTO ts_area VALUES ('3170','库车县','3167');
INSERT INTO ts_area VALUES ('3171','沙雅县','3167');
INSERT INTO ts_area VALUES ('3172','新和县','3167');
INSERT INTO ts_area VALUES ('3173','拜城县','3167');
INSERT INTO ts_area VALUES ('3174','乌什县','3167');
INSERT INTO ts_area VALUES ('3175','阿瓦提县','3167');
INSERT INTO ts_area VALUES ('3176','柯坪县','3167');
INSERT INTO ts_area VALUES ('3177','克孜勒苏柯尔克孜自治州','3125');
INSERT INTO ts_area VALUES ('3178','阿图什市','3177');
INSERT INTO ts_area VALUES ('3179','阿克陶县','3177');
INSERT INTO ts_area VALUES ('3180','阿合奇县','3177');
INSERT INTO ts_area VALUES ('3181','乌恰县','3177');
INSERT INTO ts_area VALUES ('3182','喀什地区','3125');
INSERT INTO ts_area VALUES ('3183','喀什市','3182');
INSERT INTO ts_area VALUES ('3184','疏附县','3182');
INSERT INTO ts_area VALUES ('3185','疏勒县','3182');
INSERT INTO ts_area VALUES ('3186','英吉沙县','3182');
INSERT INTO ts_area VALUES ('3187','泽普县','3182');
INSERT INTO ts_area VALUES ('3188','莎车县','3182');
INSERT INTO ts_area VALUES ('3189','叶城县','3182');
INSERT INTO ts_area VALUES ('3190','麦盖提县','3182');
INSERT INTO ts_area VALUES ('3191','岳普湖县','3182');
INSERT INTO ts_area VALUES ('3192','伽师县','3182');
INSERT INTO ts_area VALUES ('3193','巴楚县','3182');
INSERT INTO ts_area VALUES ('3194','塔什库尔干塔吉克自治县','3182');
INSERT INTO ts_area VALUES ('3195','和田地区','3125');
INSERT INTO ts_area VALUES ('3196','和田市','3195');
INSERT INTO ts_area VALUES ('3197','和田县','3195');
INSERT INTO ts_area VALUES ('3198','墨玉县','3195');
INSERT INTO ts_area VALUES ('3199','皮山县','3195');
INSERT INTO ts_area VALUES ('3200','洛浦县','3195');
INSERT INTO ts_area VALUES ('3201','策勒县','3195');
INSERT INTO ts_area VALUES ('3202','于田县','3195');
INSERT INTO ts_area VALUES ('3203','民丰县','3195');
INSERT INTO ts_area VALUES ('3204','伊犁哈萨克自治州','3125');
INSERT INTO ts_area VALUES ('3205','伊宁市','3204');
INSERT INTO ts_area VALUES ('3206','奎屯市','3204');
INSERT INTO ts_area VALUES ('3207','伊宁县','3204');
INSERT INTO ts_area VALUES ('3208','察布查尔锡伯自治县','3204');
INSERT INTO ts_area VALUES ('3209','霍城县','3204');
INSERT INTO ts_area VALUES ('3210','巩留县','3204');
INSERT INTO ts_area VALUES ('3211','新源县','3204');
INSERT INTO ts_area VALUES ('3212','昭苏县','3204');
INSERT INTO ts_area VALUES ('3213','特克斯县','3204');
INSERT INTO ts_area VALUES ('3214','尼勒克县','3204');
INSERT INTO ts_area VALUES ('3215','塔城地区','3125');
INSERT INTO ts_area VALUES ('3216','塔城市','3215');
INSERT INTO ts_area VALUES ('3217','乌苏市','3215');
INSERT INTO ts_area VALUES ('3218','额敏县','3215');
INSERT INTO ts_area VALUES ('3219','沙湾县','3215');
INSERT INTO ts_area VALUES ('3220','托里县','3215');
INSERT INTO ts_area VALUES ('3221','裕民县','3215');
INSERT INTO ts_area VALUES ('3222','和布克赛尔蒙古自治县','3215');
INSERT INTO ts_area VALUES ('3223','阿勒泰地区','3125');
INSERT INTO ts_area VALUES ('3224','阿勒泰市','3223');
INSERT INTO ts_area VALUES ('3225','布尔津县','3223');
INSERT INTO ts_area VALUES ('3226','富蕴县','3223');
INSERT INTO ts_area VALUES ('3227','福海县','3223');
INSERT INTO ts_area VALUES ('3228','哈巴河县','3223');
INSERT INTO ts_area VALUES ('3229','青河县','3223');
INSERT INTO ts_area VALUES ('3230','吉木乃县','3223');
INSERT INTO ts_area VALUES ('3231','石河子市','3223');
INSERT INTO ts_area VALUES ('3232','阿拉尔市','3223');
INSERT INTO ts_area VALUES ('3233','图木舒克市','3223');
INSERT INTO ts_area VALUES ('3234','五家渠','3223');

DROP TABLE IF EXISTS ts_attach;
CREATE TABLE `ts_attach` (
  `id` int(11) NOT NULL auto_increment,
  `attach_type` varchar(50) NOT NULL default 'attach',
  `userId` int(11) unsigned default NULL,
  `uploadTime` int(11) unsigned default NULL,
  `name` varchar(255) default NULL,
  `type` varchar(255) default NULL,
  `size` varchar(20) default NULL,
  `extension` varchar(20) default NULL,
  `hash` varchar(32) default NULL,
  `private` tinyint(1) default '0',
  `isDel` tinyint(1) default '0',
  `savepath` varchar(255) default NULL,
  `savename` varchar(255) default NULL,
  `savedomain` tinyint(3) default '0',
  PRIMARY KEY  (`id`),
  KEY `userId` (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

INSERT INTO ts_attach VALUES ('1','photo','1','1324629712','4ea55642166be.jpg','application/octet-stream','221838','jpg','1ddbe0944c41ba7cf914bbb76b9aec43','0','0','2011/1223/16/','4ef43ed029881.jpg','0');
INSERT INTO ts_attach VALUES ('2','photo','1','1324629712','4ec4e6b01d5f1.jpg','application/octet-stream','290991','jpg','4bf21dc35f064daa7dd29fdf590368aa','0','0','2011/1223/16/','4ef43ed057fc1.jpg','0');
INSERT INTO ts_attach VALUES ('3','photo','1','1324629810','car.jpg','image/pjpeg','18245','jpg','089285cf497f73112938126f4d1f7dfa','0','0','2011/1223/16/','4ef43f326e86f.jpg','0');
INSERT INTO ts_attach VALUES ('4','group_logo','1','1324631370','car.jpg','image/pjpeg','18245','jpg','089285cf497f73112938126f4d1f7dfa','0','0','2011/1223/17/','4ef4454aecad3.jpg','0');
INSERT INTO ts_attach VALUES ('5','group_file','1','1324631637','car.jpg','image/pjpeg','18245','jpg','089285cf497f73112938126f4d1f7dfa','0','0','2011/1223/17/','4ef44655a02d7.jpg','0');
INSERT INTO ts_attach VALUES ('6','photo','1','1324636283','car.jpg','application/octet-stream','18245','jpg','089285cf497f73112938126f4d1f7dfa','0','0','2011/1223/18/','4ef4587bdd276.jpg','0');
INSERT INTO ts_attach VALUES ('7','photo','1','1324636932','car.jpg','application/octet-stream','18245','jpg','089285cf497f73112938126f4d1f7dfa','0','0','2011/1223/18/','4ef45b04a7260.jpg','0');
INSERT INTO ts_attach VALUES ('8','photo','1','1324636932','car.jpg','application/octet-stream','18245','jpg','089285cf497f73112938126f4d1f7dfa','0','0','2011/1223/18/','4ef45b04bd155.jpg','0');
INSERT INTO ts_attach VALUES ('9','photo','1','1324636932','car.jpg','application/octet-stream','18245','jpg','089285cf497f73112938126f4d1f7dfa','0','0','2011/1223/18/','4ef45b04d01a7.jpg','0');
INSERT INTO ts_attach VALUES ('10','photo','1','1324636932','car.jpg','application/octet-stream','18245','jpg','089285cf497f73112938126f4d1f7dfa','0','0','2011/1223/18/','4ef45b04eeacf.jpg','0');
INSERT INTO ts_attach VALUES ('11','photo','1','1324636933','car.jpg','application/octet-stream','18245','jpg','089285cf497f73112938126f4d1f7dfa','0','0','2011/1223/18/','4ef45b050dafa.jpg','0');
INSERT INTO ts_attach VALUES ('12','photo','1','1324636933','car.jpg','application/octet-stream','18245','jpg','089285cf497f73112938126f4d1f7dfa','0','0','2011/1223/18/','4ef45b05284ce.jpg','0');
INSERT INTO ts_attach VALUES ('13','photo','1','1324636933','car.jpg','application/octet-stream','18245','jpg','089285cf497f73112938126f4d1f7dfa','0','0','2011/1223/18/','4ef45b053b62e.jpg','0');
INSERT INTO ts_attach VALUES ('14','photo','1','1324637423','1088_91647275_repaste.jpg','application/octet-stream','88812','jpg','536ff06122e0229ed59cb63ce4411880','0','0','2011/1223/18/','4ef45cef9c962.jpg','0');
INSERT INTO ts_attach VALUES ('15','photo','1','1324637423','9b5c4cc8-a2a4-4bd4-aeea-a1c434a8f605.jpg','application/octet-stream','358387','jpg','b48e816425fe95ba767b05a0f7b8e108','0','0','2011/1223/18/','4ef45cefbeea9.jpg','0');
INSERT INTO ts_attach VALUES ('17','kissy','1','1324637765','car.jpg','image/jpeg','18245','jpg','089285cf497f73112938126f4d1f7dfa','0','0','2011/1223/18/','4ef45e45168a9.jpg','0');
INSERT INTO ts_attach VALUES ('18','kissy','1','1324886478','car.jpg','image/jpeg','18245','jpg','089285cf497f73112938126f4d1f7dfa','0','0','2011/1226/16/','4ef829cee351b.jpg','0');

DROP TABLE IF EXISTS ts_blog;
CREATE TABLE `ts_blog` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `name` varchar(20) default NULL,
  `title` varchar(255) default NULL,
  `category` mediumint(5) default NULL,
  `category_title` varchar(255) default NULL,
  `cover` varchar(255) default NULL,
  `content` longtext,
  `readCount` int(11) NOT NULL default '0',
  `commentCount` int(11) NOT NULL default '0',
  `recommendCount` int(11) NOT NULL default '0',
  `tags` varchar(255) default NULL,
  `cTime` int(11) default NULL,
  `mTime` int(11) default NULL,
  `rTime` int(11) NOT NULL default '0',
  `isHot` varchar(1) NOT NULL default '0',
  `type` int(1) default NULL,
  `status` varchar(1) NOT NULL default '1',
  `private` tinyint(1) NOT NULL default '0',
  `private_data` varchar(255) default NULL,
  `hot` int(11) NOT NULL default '0',
  `canableComment` tinyint(1) NOT NULL default '1',
  `attach` text,
  PRIMARY KEY  (`id`),
  KEY `hot` (`hot`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO ts_blog VALUES ('1','1','','这是秘密啊...','2','私人','','&lt;p&gt;这是秘密啊...&lt;/p&gt;&lt;p&gt;这是秘密啊...&lt;/p&gt;&lt;p&gt;这是秘密啊...&lt;/p&gt;&lt;p&gt;这是秘密啊...&lt;/p&gt;&lt;p&gt;这是秘密啊...&lt;/p&gt;&lt;p&gt;这是秘密啊...&lt;/p&gt;','0','1','0','','1324633797','1324633797','0','0','0','1','0','d41d8cd98f00b204e9800998ecf8427e','0','0','');
INSERT INTO ts_blog VALUES ('2','1','','马云内部讲话','3','学习文档','','&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;font size=\"3\"&gt;&lt;font color=\"#000000\"&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;请记住本站网址：&lt;/span&gt;&lt;span&gt;http://r.book118.com&lt;/span&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;或&lt;/span&gt;&lt;span&gt;http://www.book118.com&lt;/span&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;span&gt;&lt;font color=\"#000000\" size=\"3\"&gt;&amp;nbsp;&lt;/font&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;font size=\"3\"&gt;&lt;font color=\"#000000\"&gt;&lt;span&gt;&amp;lt;&lt;/span&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;马云内部讲话&lt;/span&gt;&lt;span&gt;&amp;gt;&lt;/span&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;span&gt;&lt;font color=\"#000000\" size=\"3\"&gt;&amp;nbsp;&lt;/font&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;span&gt;&lt;font color=\"#000000\" size=\"3\"&gt;&amp;nbsp;&lt;/font&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;font size=\"3\"&gt;&lt;font color=\"#000000\"&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;面对信仰缺乏，一个公司怎么确立自己的理想&lt;/span&gt; &lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;面对信仰缺乏，一个公司怎…&lt;/span&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;span&gt;&lt;font color=\"#000000\" size=\"3\"&gt;&amp;nbsp;&lt;/font&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;font size=\"3\"&gt;&lt;font color=\"#000000\"&gt;&lt;span&gt;&lt;span&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;/span&gt;&lt;/span&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;马云内部讲话关键时马云说了什么倒立，是阿里巴巴员工的必修课&lt;/span&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;span&gt;&lt;font color=\"#000000\" size=\"3\"&gt;&amp;nbsp;&lt;/font&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;font size=\"3\"&gt;&lt;font color=\"#000000\"&gt;&lt;span&gt;&lt;span&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;/span&gt;2008&lt;/span&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;年是互联网世界风起云涌、合纵连横的一年。在年初，微软欲收购阿里巴巴股东雅虎，被杨致远拒绝。&lt;/span&gt;&lt;span&gt;2008&lt;/span&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;年&lt;/span&gt;&lt;span&gt;3&lt;/span&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;月&lt;/span&gt;&lt;span&gt;28&lt;/span&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;日在湖畔学院讲话我追求的那种阿里味儿谢谢大家，我一直盼望有一个关于领导力的探讨。听大家在讨论，听得也很开心。很多很多想法都在撞击我。我一直在做一些事情，但是做得对不对，还有平时在做的、在讲的一些东西，和大家想的是不是一样，没有和大家探讨过。很多东西讲了，一直没有一个充裕的时间来整理。这次，大家把手头上很重要的事情都放下来了，我觉得探讨领导力是最重要的事情。我自己刚才也在反思阿里巴巴未来的战略，到底该怎么来领导？我们需要一个什么样的领导力？我自己这么看：这世界上所有的领导者的最高境界是一样的，不管你做平台也好，做各种各样的技术也好。我自己比较有幸见过许多优秀的领导者。我见过很多诺贝尔奖获得者，见过第一章面对信仰缺乏一个公非常优秀的总统，像克林顿，也见过很多的优秀运动员、奥林匹克的金牌获得者，司还有优秀的艺术家，我后来也在达沃斯世界经济论坛上见过各种各样的人。我发现这些人其实都是一样的，包括我见到过不少很朴实的农民。如果他做得好的话，一个优秀的耕地的农民和这个公司的领导者有着一样的境界。领导者在境界上其实是相通的，他们有共同的品质和思想。怎么确立自己的理想&lt;/span&gt;&lt;span&gt;3&lt;/span&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;span&gt;&lt;font color=\"#000000\" size=\"3\"&gt;&amp;nbsp;&lt;/font&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;font size=\"3\"&gt;&lt;font color=\"#000000\"&gt;&lt;span&gt;&lt;span&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;/span&gt;&lt;/span&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;马云内部讲话关键时马云说了什么今天不管领导什么，就算是一个农民，他想做好，也必须作为一个优秀的领导者来管理田里面的庄稼。他怎么分配他所有的资源，怎么去跟别人协调。反正，我听了大家的发言之后，感受到的其实不是我们将来做什么样的领导，而是做任何事情都需要领导力，都需要同样的品质和素质。我非常同意领导力更倾向于艺术、管理更倾向于科学的观点。领导是一种艺术，既然是艺术就要讲究一种平衡。我们可能没有找到最好的词，但是这个词，这个意思本身，这个衡字说明了很多问题。我是蛮喜欢平衡这个词，可能领导最重要的技能在于太极图里阴阳之间的这条线。阴阳中间有一种转动，高气压到低气压，低气压到高气压，阴过了就是阳，阳过了就是阴。阴阳中间的这条线，我不知道叫什么，是不是叫平衡，我不知道，但就是这一点应该是领导者很重要的一点。大家刚才也谈到领导者的魅力，比如幽默。当今世界上，幽默是很多员工和普通人对领导和领袖最期待的气质。但是我觉得很难让每个人都学会幽默，这是一个很独特的技能。让一个从来不幽默的人学会幽默是一件特不幽默的事情。但我后来发现很多领导者，从老农民到优秀的国家领导人、优秀的企业领导者，具有一个基本面，他应该有这些东西：他是他自己，他是个朴实的人，他是个自在的人。一个朴实的人，他知道他没有装腔作势，他昨天是这样，他今天还是这样，他是一个普通的人。讲到这里，我突然发现我追求的那种“阿里味儿”出来了。克林顿这么厉害的人，他跟你聊天跟你讲话的时候，眼睛是看着你的，他是一个普通的人在听你讲故事。你注意到了吗？假如他把自己当做“我”，他的眼睛是这么斜着看你，或者是这么歪着听你的时候，永远都不行。你去看，那些优秀的领导者，在任何的台上他都是他自己，他是真实的表现，他错了，他并不回避。一个人敢于笑话自己，他是有很强的安全感的。因为只有你是你自己的时候，才会有安全感，装腔作势的时候永远没有安全感。什么是内涵？我想就是一股气，只要你珍惜，只要你是自己，你语言不好没有关系，但是你讲的是真实的想法。假设你的汉语表达能力不是很好，上台后最简&lt;/span&gt;&lt;span&gt;4&lt;span&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;/span&gt;&lt;/span&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;span&gt;&lt;font color=\"#000000\" size=\"3\"&gt;&amp;nbsp;&lt;/font&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;font size=\"3\"&gt;&lt;font color=\"#000000\"&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;面对信仰缺乏，一个公司怎么确立自己的理想&lt;/span&gt; &lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;面对信仰缺乏，一个公司怎…&lt;/span&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;span&gt;&lt;font color=\"#000000\" size=\"3\"&gt;&amp;nbsp;&lt;/font&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;font size=\"3\"&gt;&lt;font color=\"#000000\"&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;——&lt;/span&gt;&lt;span&gt;&lt;span&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;/span&gt;&lt;/span&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;商鞅变法是被人恶骂的，王安石变法的时候也被恶骂，但由于商鞅变法，秦国发生了变化；由于王安石变法，宋朝发生了变化、后面的时代发生了变化。看待一个历史事件，我们要从长远的眼光来看。单的策略就是把你想讲的东西讲完。有的时候你因为对自己的表达不放心，越描绘时间越长，陷入了一种恶性循环。基本上，当每个人明白自己是谁，该干些什么的时候，他掌握了自己的性格，了解了自己以后，就变得很自在，变得很放松，自己独特的东西就会体现出来。有些不太会讲话的人也要找到自己独特的魅力去影响这个世界，你不可能去模仿克林顿，世界上没有几个人可以模仿他，模仿他是搞笑的事情。我想这个可能就是领导者的魅力，不管你走得多高，不管你做得多低，今天你当总统的时候，或是你今天一贫如洗，你还是你自己。看到浩瀚的宇宙，你就有了远见我今天在这里看到一些标语，比如“超越伯乐”、“勇气和坚持”等。我自己也一直认为领导力最重要的是眼光、胸怀和实力。眼光就是一种远见，但怎么去理解远见？我自己也在思考。很多人觉得一个优秀的领导者，是要看到未来美好的东西。但这是一种动态的平衡。你要看到美好的东西，是要在别人低落的时候看到美好的东西，在人们骄傲的时候你要看到灾难的到来，所以要把握这个平衡的度。什么时候你要讲好，什么时候你要讲坏，这是一种眼光、一种远见。远见是一个优秀的船长最重要的功能，他要能告诉大家，什么时候有风暴要来了，这是他的经验、他的眼光、他的远见。我觉得在不同的角度上，你比别人看得更远、更宽、更长、更独特，这才是最关键的。商鞅变法是被人恶骂的，王安石变法的时候也被恶骂，但由于商鞅变法，秦国发生了变化；由于王安石变法，宋朝发生了变化、后面的时代发生了变化。看待一个历史事件，我们要从长远的眼光来看。每个人的视野、视角要看得更宽、更远、更深、更独特，然后你才能抓住这个第一章面对信仰缺乏一个公司怎么确立自己的理想&lt;/span&gt;&lt;span&gt;5&lt;/span&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;span&gt;&lt;font color=\"#000000\" size=\"3\"&gt;&amp;nbsp;&lt;/font&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;font size=\"3\"&gt;&lt;font color=\"#000000\"&gt;&lt;span&gt;&lt;span&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;/span&gt;&lt;/span&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;马云内部讲话关键时马云说了什么机会。大家都看得到的东西，凭什么你有机会？所以我觉得一个领导者，读万卷书不如行万里路。其实我周游全世界，觉得自己实在是太渺小了。我们还以为自己很牛，在自己的办公室、在自己的同事、员工和家人面前，哇塞，觉得自己很厉害。但是再走远一点看看呢，在世界上你微不足道。我是到了伦敦的格林尼治天文台才真正明白我是多么的渺小，那个宇宙是多么的浩瀚，地球像个灰尘的灰尘根本找不到，地球都找不到，人更别说啦。你要想到这些问题，你就有了远见。胸怀里边就是使命感再来讲胸怀。其实胸怀是一个死命题。我刚才讲了一个领导者要有很大的胸怀，俗话说男人的胸怀是被冤枉大的。为什么你的胸怀这么大、别人的胸怀这么小。在我看来，很重要的一个原因就是这个人有强烈的使命感，他根本不在乎让边上的人骂几句。这个很重要。胸怀这个字眼里边就是使命感。因为有使命感，你就有这种胸怀，让别人去说，自己知道自己在做什么，而且我一定要把它做出来，比如我胸怀超大，希望改变人类。我希望影响别人，帮助别人，有这种使命感。这样，你往前走的时候，就如网上有句话，很傻很天真。别人看他很傻很天真，但是他比谁都意志坚强。从这里你可以看得到，胸怀就是他根本不在乎别人是怎么评价他的。谁冤枉你你无所谓，为什么这称得上是胸怀呢？是因为他有强烈的意志要活下去，我想改变别人，我想完善这个社会，这就是领导者的气质。我今天不想总结说，我们一定要往这边走，而是和大家一起探讨一些思想。还有就是我们以前讲的实力，我今天看到标语上这么几个字，“勇气和坚持”。我以前讲过，实力就是抗击打能力，你怎么打我我都不倒，明天又来了。在这&lt;/span&gt;&lt;span&gt;6&lt;span&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;/span&gt;&lt;/span&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;span&gt;&lt;font color=\"#000000\" size=\"3\"&gt;&amp;nbsp;&lt;/font&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;font size=\"3\"&gt;&lt;font color=\"#000000\"&gt;&lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;面对信仰缺乏，一个公司怎么确立自己的理想&lt;/span&gt; &lt;span style=\"font-family: 微软雅黑,sans-serif;\"&gt;面对信仰缺乏，一个公司怎…&lt;/span&gt;&lt;/font&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=\"margin: 0cm 0cm 10pt;\"&gt;&lt;span&gt;&lt;font color=\"#000000\" size=\"3\"&gt;&amp;nbsp;&lt;/font&gt;&lt;/span&gt;&lt;/p&gt;','0','1','0','','1324869897','1324869897','0','0','0','1','0','d41d8cd98f00b204e9800998ecf8427e','0','0','');
INSERT INTO ts_blog VALUES ('3','1','','萨达撒旦撒旦撒','1','未分类','','&lt;p&gt;&lt;img style=\"float:none;margin:0px;&amp;quot; alt=&amp;quot;\" src=\"http://192.168.243.101/ts/data/uploads/2011/1226/16/4ef829cee351b.jpg\" /&gt;&lt;/p&gt;','0','0','0','','1324886496','1324886496','0','0','0','1','0','d41d8cd98f00b204e9800998ecf8427e','0','0','');
INSERT INTO ts_blog VALUES ('4','1','','瞧瞧切切切切切切切切切轻轻巧巧','1','未分类','','&lt;p&gt;撒旦撒旦&lt;/p&gt;','0','0','0','','1324886521','1324886521','0','0','0','1','0','d41d8cd98f00b204e9800998ecf8427e','0','0','');

DROP TABLE IF EXISTS ts_blog_category;
CREATE TABLE `ts_blog_category` (
  `id` mediumint(5) NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `uid` int(11) default NULL,
  `pid` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ts_blog_category VALUES ('1','未分类','0','0');
INSERT INTO ts_blog_category VALUES ('2','私人','1','');
INSERT INTO ts_blog_category VALUES ('3','学习文档','1','');

DROP TABLE IF EXISTS ts_blog_item;
CREATE TABLE `ts_blog_item` (
  `id` int(11) NOT NULL auto_increment,
  `sourceId` int(11) default NULL,
  `snapday` int(11) default NULL,
  `pubdate` int(11) default NULL,
  `boot` tinyint(1) NOT NULL default '0',
  `title` varchar(255) default NULL,
  `link` varchar(255) default NULL,
  `summary` text,
  PRIMARY KEY  (`id`),
  KEY `source_id` (`sourceId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_blog_mention;
CREATE TABLE `ts_blog_mention` (
  `id` int(11) NOT NULL auto_increment,
  `blogid` int(20) default NULL,
  `uid` int(11) default NULL,
  `name` varchar(20) character set utf8 collate utf8_unicode_ci default NULL,
  `type` varchar(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `blogid` (`blogid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_blog_outline;
CREATE TABLE `ts_blog_outline` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `name` varchar(20) default NULL,
  `title` varchar(255) default NULL,
  `category` mediumint(5) default NULL,
  `cover` varchar(255) default NULL,
  `content` longtext,
  `readCount` int(11) NOT NULL default '0',
  `commentCount` int(11) NOT NULL default '0',
  `tags` varchar(255) default NULL,
  `cTime` int(11) default NULL,
  `mTime` int(11) default NULL,
  `isHot` varchar(1) NOT NULL default '0',
  `type` int(1) default NULL,
  `status` varchar(1) NOT NULL default '1',
  `private` tinyint(1) NOT NULL default '0',
  `hot` int(11) NOT NULL default '0',
  `friendId` text,
  `canableComment` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `hot` (`hot`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_blog_source;
CREATE TABLE `ts_blog_source` (
  `id` int(11) NOT NULL auto_increment,
  `service` varchar(10) default NULL,
  `username` char(30) default NULL,
  `cTime` int(11) default NULL,
  `lastSnap` int(11) default NULL,
  `isNew` tinyint(1) default NULL,
  `changes` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_blog_subscribe;
CREATE TABLE `ts_blog_subscribe` (
  `id` int(11) NOT NULL auto_increment,
  `sourceId` int(11) default NULL,
  `uid` int(11) default NULL,
  `type` tinyint(4) default '0',
  `newNum` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `sourceId` (`sourceId`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_category;
CREATE TABLE `ts_category` (
  `id` int(4) NOT NULL auto_increment,
  `tid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cleft` int(11) NOT NULL,
  `cright` int(11) NOT NULL,
  `corder` int(5) NOT NULL default '0',
  `namespace` varchar(255) NOT NULL default 'default',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_comment;
CREATE TABLE `ts_comment` (
  `id` int(11) NOT NULL auto_increment,
  `type` char(15) default NULL,
  `appid` int(11) default NULL,
  `appuid` int(11) default NULL,
  `name` varchar(30) default NULL,
  `uid` int(11) default NULL,
  `comment` text,
  `cTime` int(12) default NULL,
  `toId` int(11) NOT NULL default '0',
  `status` int(1) default '0',
  `quietly` tinyint(1) NOT NULL default '0',
  `to_uid` int(11) NOT NULL default '0',
  `data` text,
  PRIMARY KEY  (`id`),
  KEY `type` (`type`),
  KEY `appid` (`appid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO ts_comment VALUES ('1','vote','1','1','','1','的输入法','1324636427','0','1','0','1','a:5:{s:5:\"title\";s:30:\"你喜欢白天还是黑夜？\";s:3:\"url\";s:74:\"http://192.168.243.101/ts/index.php?app=vote&mod=Index&act=pollDetail&id=1\";s:5:\"table\";s:4:\"vote\";s:8:\"id_field\";s:2:\"id\";s:19:\"comment_count_field\";s:12:\"commentCount\";}');
INSERT INTO ts_comment VALUES ('2','photo','12','1','','1','ssdfsdfgdfsdfg','1324637445','0','1','0','1','a:5:{s:5:\"title\";s:18:\"管理员的相册\";s:3:\"url\";s:92:\"http://192.168.243.101/ts/index.php?app=photo&mod=Index&act=photo&id=12&aid=1&uid=1#show_pic\";s:5:\"table\";s:5:\"photo\";s:8:\"id_field\";s:2:\"id\";s:19:\"comment_count_field\";s:12:\"commentCount\";}');
INSERT INTO ts_comment VALUES ('3','blog','1','1','','1','asdfasfd','1324637648','0','1','0','1','a:5:{s:5:\"title\";s:18:\"这是秘密啊...\";s:3:\"url\";s:74:\"http://192.168.243.101/ts/index.php?app=blog&mod=Index&act=show&id=1&mid=1\";s:5:\"table\";s:4:\"blog\";s:8:\"id_field\";s:2:\"id\";s:19:\"comment_count_field\";s:12:\"commentCount\";}');
INSERT INTO ts_comment VALUES ('4','blog','2','1','','1','阿萨德飞','1324869926','0','1','0','1','a:5:{s:5:\"title\";s:18:\"马云内部讲话\";s:3:\"url\";s:74:\"http://192.168.243.101/ts/index.php?app=blog&mod=Index&act=show&id=2&mid=1\";s:5:\"table\";s:4:\"blog\";s:8:\"id_field\";s:2:\"id\";s:19:\"comment_count_field\";s:12:\"commentCount\";}');

DROP TABLE IF EXISTS ts_credit_setting;
CREATE TABLE `ts_credit_setting` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `type` varchar(30) NOT NULL default 'user',
  `info` text NOT NULL,
  `score` int(11) NOT NULL default '0',
  `experience` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

INSERT INTO ts_credit_setting VALUES ('106','delete_blog','删除博客','blog','{action}{sign}了{score}{typecn}','-5','-5');
INSERT INTO ts_credit_setting VALUES ('37','invite_friend','邀请好友','register','{action}{sign}了{score}{typecn}','10','10');
INSERT INTO ts_credit_setting VALUES ('39','add_weibo','发布微薄','weibo','{action}{sign}了{score}{typecn}','1','2');
INSERT INTO ts_credit_setting VALUES ('40','user_login','用户登录','user','{action}{sign}了{score}{typecn}','0','1');
INSERT INTO ts_credit_setting VALUES ('42','space_visited','空间被访问','user','{action}{sign}了{score}{typecn}','1','1');
INSERT INTO ts_credit_setting VALUES ('104','delete_vote','删除投票','vote','{action}{sign}了{score}{typecn}','-20','-20');
INSERT INTO ts_credit_setting VALUES ('103','joined_vote','投票被参与','vote','{action}{sign}了{score}{typecn}','1','1');
INSERT INTO ts_credit_setting VALUES ('102','join_vote','参与投票','vote','{action}{sign}了{score}{typecn}','1','5');
INSERT INTO ts_credit_setting VALUES ('92','init_default','注册积分','register','{action}{sign}了{score}{typecn}','200','0');
INSERT INTO ts_credit_setting VALUES ('59','add_comment','评论别人','comment','{action}{sign}了{score}{typecn}','1','1');
INSERT INTO ts_credit_setting VALUES ('60','reply_comment','回复别人的评论','comment','{action}{sign}了{score}{typecn}','1','1');
INSERT INTO ts_credit_setting VALUES ('61','replied_comment','评论被回复','comment','{action}{sign}了{score}{typecn}','2','2');
INSERT INTO ts_credit_setting VALUES ('63','reply_weibo','回复微博','weibo','{action}{sign}了{score}{typecn}','1','1');
INSERT INTO ts_credit_setting VALUES ('64','replied_weibo','微博被回复','weibo','{action}{sign}了{score}{typecn}','1','1');
INSERT INTO ts_credit_setting VALUES ('81','is_commented','被别人评论','comment','{action}{sign}了{score}{typecn}','1','2');
INSERT INTO ts_credit_setting VALUES ('100','add_photo','上传图片','photo','{action}{sign}了{score}{typecn}','2','2');
INSERT INTO ts_credit_setting VALUES ('83','share_to_weibo','分享到微薄','weibo','{action}{sign}了{score}{typecn}','3','3');
INSERT INTO ts_credit_setting VALUES ('105','add_blog','发表博客','blog','{action}{sign}了{score}{typecn}','5','5');
INSERT INTO ts_credit_setting VALUES ('99','delete_album','删除相册','photo','{action}{sign}了{score}{typecn}','-10','-10');
INSERT INTO ts_credit_setting VALUES ('98','add_album','创建相册','photo','{action}{sign}了{score}{typecn}','10','10');
INSERT INTO ts_credit_setting VALUES ('101','add_vote','发起投票','vote','{action}{sign}了{score}{typecn}','20','20');
INSERT INTO ts_credit_setting VALUES ('88','delete_comment','删除评论','comment','{action}{sign}了{score}{typecn}','-2','-2');
INSERT INTO ts_credit_setting VALUES ('89','delete_weibo','删除微薄','weibo','{action}{sign}了{score}{typecn}','-2','-2');
INSERT INTO ts_credit_setting VALUES ('90','forward_weibo','转发微薄','weibo','{action}{sign}了{score}{typecn}','1','1');
INSERT INTO ts_credit_setting VALUES ('91','forwarded_weibo','微博被转发','weibo','{action}{sign}了{score}{typecn}','1','1');
INSERT INTO ts_credit_setting VALUES ('93','delete_weibo_comment','删除微博评论','weibo','{action}{sign}了{score}{typecn}','-1','-1');
INSERT INTO ts_credit_setting VALUES ('94','add_medal','获得勋章','medal','{action}{sign}了{score}{typecn}','5','5');
INSERT INTO ts_credit_setting VALUES ('95','delete_medal','丢失勋章','medal','{action}{sign}了{score}{typecn}','-5','0');
INSERT INTO ts_credit_setting VALUES ('96','add_poster','发起招贴','poster','{action}{sign}了{score}{typecn}','2','2');
INSERT INTO ts_credit_setting VALUES ('97','delete_poster','删除招贴','poster','{action}{sign}了{score}{typecn}','-2','-2');
INSERT INTO ts_credit_setting VALUES ('107','add_event','发起活动','event','{action}{sign}了{score}{typecn}','10','10');
INSERT INTO ts_credit_setting VALUES ('108','delete_event','删除活动','event','{action}{sign}了{score}{typecn}','-10','-10');
INSERT INTO ts_credit_setting VALUES ('109','join_event','参加活动','event','{action}{sign}了{score}{typecn}','3','2');
INSERT INTO ts_credit_setting VALUES ('110','cancel_join_event','取消参加活动','event','{action}{sign}了{score}{typecn}','-3','-2');
INSERT INTO ts_credit_setting VALUES ('111','add_group','创建群组','group','{action}{sign}了{score}{typecn}','5','5');
INSERT INTO ts_credit_setting VALUES ('112','delete_group','解散群租','group','{action}{sign}了{score}{typecn}','-5','-5');
INSERT INTO ts_credit_setting VALUES ('113','join_group','加入群组','group','{action}{sign}了{score}{typecn}','2','2');
INSERT INTO ts_credit_setting VALUES ('114','quit_group','退出群组','group','{action}{sign}了{score}{typecn}','-2','-2');
INSERT INTO ts_credit_setting VALUES ('115','group_add_topic','发表帖子','group','{action}{sign}了{score}{typecn}','5','5');
INSERT INTO ts_credit_setting VALUES ('116','group_reply_topic','回复帖子','group','{action}{sign}了{score}{typecn}','2','2');
INSERT INTO ts_credit_setting VALUES ('117','group_delete_topic','删除帖子','group','{action}{sign}了{score}{typecn}','-5','-5');
INSERT INTO ts_credit_setting VALUES ('118','group_upload_file','上传文件','group','{action}{sign}了{score}{typecn}','5','5');
INSERT INTO ts_credit_setting VALUES ('119','group_download_file','下载文件','group','{action}{sign}了{score}{typecn}','2','2');
INSERT INTO ts_credit_setting VALUES ('120','group_delete_file','删除文件','group','{action}{sign}了{score}{typecn}','-5','-5');

DROP TABLE IF EXISTS ts_credit_type;
CREATE TABLE `ts_credit_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ts_credit_type VALUES ('1','score','积分');
INSERT INTO ts_credit_type VALUES ('2','experience','经验');
INSERT INTO ts_credit_type VALUES ('3','gold','金币');

DROP TABLE IF EXISTS ts_credit_user;
CREATE TABLE `ts_credit_user` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  `gold` varchar(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ts_credit_user VALUES ('1','1','129','146','0');
INSERT INTO ts_credit_user VALUES ('2','2','205','6','0');
INSERT INTO ts_credit_user VALUES ('3','3','202','2','0');

DROP TABLE IF EXISTS ts_denounce;
CREATE TABLE `ts_denounce` (
  `id` int(11) NOT NULL auto_increment COMMENT '主键ID',
  `from` varchar(255) NOT NULL COMMENT '目前存入各个应用的名称，比如blog,weibo，说明举报的是不同应用下的内容',
  `aid` int(11) NOT NULL COMMENT '记录内容表的主键ID',
  `state` tinyint(4) NOT NULL COMMENT '记录状态，0，默认，表示刚举报；1，表示已删除；2，表示已经通过可以正常显示；',
  `uid` int(11) NOT NULL COMMENT '记录举报人的UID',
  `fuid` int(11) NOT NULL COMMENT '记录被举报人UID',
  `reason` text NOT NULL COMMENT '举报理由',
  `content` varchar(255) NOT NULL,
  `ctime` int(11) NOT NULL COMMENT '记录举报的时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_document;
CREATE TABLE `ts_document` (
  `document_id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `content` text,
  `author_id` int(11) default NULL,
  `last_editor_id` int(11) default NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  `is_on_footer` tinyint(1) NOT NULL default '0' COMMENT '是否在页脚显示',
  `ctime` int(11) default NULL,
  `mtime` int(11) default NULL,
  `display_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`document_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ts_document VALUES ('1','官方社区','&lt;p&gt;官方社区官方社区官方社区官方社区&lt;/p&gt;','4','1','1','1','1292213500','1325237997','1');
INSERT INTO ts_document VALUES ('2','关于我们','&lt;p&gt;知行网社交平台是一个高端商务人士的交流社区。&lt;/p&gt;','4','1','1','1','1292213562','1325238023','2');

DROP TABLE IF EXISTS ts_event;
CREATE TABLE `ts_event` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `title` text NOT NULL,
  `explain` text NOT NULL,
  `contact` varchar(32) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `sTime` int(11) default NULL,
  `eTime` int(11) default NULL,
  `address` varchar(255) default NULL,
  `cTime` int(11) NOT NULL,
  `deadline` int(11) NOT NULL,
  `joinCount` int(11) NOT NULL default '0',
  `attentionCount` int(11) NOT NULL default '0',
  `limitCount` int(11) NOT NULL default '0',
  `commentCount` int(11) NOT NULL default '0',
  `coverId` int(11) NOT NULL default '0',
  `optsId` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_event VALUES ('1','1','it讲座','<p>阿四大四大撒打算打算阿四大四大撒打算打算阿四大四大撒打算打算阿四大四大撒打算打算阿四大四大撒打算打算阿四大四大撒打算打算阿四大四大撒打算打算阿四大四大撒打算打算阿四大四大撒打算打算阿四大四大撒打算打算阿四大四大撒打算打算阿四大四大撒打算打算阿四大四大撒打算打算阿四大四大撒打算打算阿四大四大撒打算打算</p>','','2','1323256598','1325330200','埃索达是','1325157446','1325243802','0','0','10','0','0','1');

DROP TABLE IF EXISTS ts_event_opts;
CREATE TABLE `ts_event_opts` (
  `id` int(11) NOT NULL auto_increment,
  `cost` char(10) NOT NULL default '0',
  `costExplain` varchar(255) default '0',
  `province` char(10) default NULL,
  `city` char(10) default NULL,
  `area` varchar(10) default NULL,
  `opts` varchar(50) NOT NULL default '0',
  `isHot` tinyint(1) NOT NULL default '0',
  `rTime` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_event_opts VALUES ('1','0','','北京','','','a:2:{s:6:\"friend\";i:0;s:5:\"allow\";i:0;}','1','');

DROP TABLE IF EXISTS ts_event_photo;
CREATE TABLE `ts_event_photo` (
  `id` int(11) NOT NULL auto_increment,
  `eventId` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `savename` varchar(255) NOT NULL,
  `aid` int(11) NOT NULL,
  `cTime` int(11) NOT NULL,
  `commentCount` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_event_type;
CREATE TABLE `ts_event_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO ts_event_type VALUES ('1','音乐/演出');
INSERT INTO ts_event_type VALUES ('2','展览');
INSERT INTO ts_event_type VALUES ('3','电影');
INSERT INTO ts_event_type VALUES ('4','讲座/沙龙');
INSERT INTO ts_event_type VALUES ('5','戏剧/曲艺');
INSERT INTO ts_event_type VALUES ('8','体育');
INSERT INTO ts_event_type VALUES ('9','旅行');
INSERT INTO ts_event_type VALUES ('10','公益');
INSERT INTO ts_event_type VALUES ('11','其它');

DROP TABLE IF EXISTS ts_event_user;
CREATE TABLE `ts_event_user` (
  `id` int(11) NOT NULL auto_increment,
  `eventId` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `contact` text,
  `action` char(10) NOT NULL default 'attention',
  `status` tinyint(1) NOT NULL default '1',
  `cTime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_event_user VALUES ('1','1','1','','admin','1','1325157447');

DROP TABLE IF EXISTS ts_expression;
CREATE TABLE `ts_expression` (
  `expression_id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL default 'miniblog',
  `emotion` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY  (`expression_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

INSERT INTO ts_expression VALUES ('1','拥抱','miniblog','[拥抱]','hug.gif');
INSERT INTO ts_expression VALUES ('2','示爱','miniblog','[示爱]','kiss.gif');
INSERT INTO ts_expression VALUES ('3','呲牙','miniblog','[呲牙]','lol.gif');
INSERT INTO ts_expression VALUES ('4','可爱','miniblog','[可爱]','loveliness.gif');
INSERT INTO ts_expression VALUES ('5','折磨','miniblog','[折磨]','mad.gif');
INSERT INTO ts_expression VALUES ('6','难过','miniblog','[难过]','sad.gif');
INSERT INTO ts_expression VALUES ('7','流汗','miniblog','[流汗]','sweat.gif');
INSERT INTO ts_expression VALUES ('8','憨笑','miniblog','[憨笑]','biggrin.gif');
INSERT INTO ts_expression VALUES ('9','大哭','miniblog','[大哭]','cry.gif');
INSERT INTO ts_expression VALUES ('10','惊恐','miniblog','[惊恐]','funk.gif');
INSERT INTO ts_expression VALUES ('11','握手','miniblog','[握手]','handshake.gif');
INSERT INTO ts_expression VALUES ('12','发怒','miniblog','[发怒]','huffy.gif');
INSERT INTO ts_expression VALUES ('13','惊讶','miniblog','[惊讶]','shocked.gif');
INSERT INTO ts_expression VALUES ('14','害羞','miniblog','[害羞]','shy.gif');
INSERT INTO ts_expression VALUES ('15','微笑','miniblog','[微笑]','smile.gif');
INSERT INTO ts_expression VALUES ('16','偷笑','miniblog','[偷笑]','titter.gif');
INSERT INTO ts_expression VALUES ('17','调皮','miniblog','[调皮]','tongue.gif');
INSERT INTO ts_expression VALUES ('18','胜利','miniblog','[胜利]','victory.gif');

DROP TABLE IF EXISTS ts_feed;
CREATE TABLE `ts_feed` (
  `feed_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `data` text NOT NULL,
  `ctime` int(11) NOT NULL,
  `type` varchar(120) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`feed_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO ts_feed VALUES ('1','1','a:3:{s:3:\"fid\";i:2;s:3:\"uid\";i:1;s:4:\"type\";s:12:\"weibo_follow\";}','1324887566','weibo_follow','1');
INSERT INTO ts_feed VALUES ('2','2','a:3:{s:3:\"fid\";i:1;s:3:\"uid\";i:2;s:4:\"type\";s:12:\"weibo_follow\";}','1324887566','weibo_follow','1');
INSERT INTO ts_feed VALUES ('4','1','a:3:{s:3:\"fid\";i:3;s:3:\"uid\";i:1;s:4:\"type\";s:12:\"weibo_follow\";}','1325327029','weibo_follow','1');
INSERT INTO ts_feed VALUES ('5','3','a:3:{s:3:\"fid\";i:1;s:3:\"uid\";i:3;s:4:\"type\";s:12:\"weibo_follow\";}','1325327029','weibo_follow','1');
INSERT INTO ts_feed VALUES ('6','3','a:3:{s:3:\"fid\";s:1:\"2\";s:3:\"uid\";i:3;s:4:\"type\";s:12:\"weibo_follow\";}','1325327035','weibo_follow','1');

DROP TABLE IF EXISTS ts_follow;
CREATE TABLE `ts_follow` (
  `follow_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`follow_id`),
  KEY `fid` (`fid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO ts_follow VALUES ('1','1','2','0');
INSERT INTO ts_follow VALUES ('4','1','3','0');
INSERT INTO ts_follow VALUES ('3','2','1','0');
INSERT INTO ts_follow VALUES ('5','3','1','0');
INSERT INTO ts_follow VALUES ('6','3','2','0');

DROP TABLE IF EXISTS ts_follow_group;
CREATE TABLE `ts_follow_group` (
  `follow_group_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`follow_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_follow_group_link;
CREATE TABLE `ts_follow_group_link` (
  `follow_group_link_id` int(11) NOT NULL auto_increment,
  `follow_group_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY  (`follow_group_link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_friend;
CREATE TABLE `ts_friend` (
  `friend_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `friend_uid` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `ctime` int(11) NOT NULL,
  PRIMARY KEY  (`friend_id`),
  UNIQUE KEY `uid` (`uid`,`friend_uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_friend VALUES ('1','1','2','1','23424325');

DROP TABLE IF EXISTS ts_friend_group;
CREATE TABLE `ts_friend_group` (
  `friend_group_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL,
  PRIMARY KEY  (`friend_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_friend_group_link;
CREATE TABLE `ts_friend_group_link` (
  `uid` int(11) NOT NULL,
  `friend_uid` int(11) NOT NULL,
  `friend_uname` varchar(255) NOT NULL,
  `friend_group_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_gift;
CREATE TABLE `ts_gift` (
  `id` int(11) NOT NULL auto_increment,
  `categoryId` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `cTime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

INSERT INTO ts_gift VALUES ('56','2','冰块','998','50','4a6ff66da5b9f.gif','1','1248851565');
INSERT INTO ts_gift VALUES ('22','1','玫瑰','943','28','birth1.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('23','1','开心蛋糕','928','38','birth2.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('24','1','钻石','958','50','birth3.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('25','1','金元宝','979','50','birth4.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('26','1','宝贝熊','988','36','birth5.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('27','1','香槟','974','22','birth6.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('28','1','心愿','999','20','birth7.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('29','1','浓情棒棒糖','993','20','birth8.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('30','1','女人最爱','956','33','birth9.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('31','1','男人期待','980','33','birth10.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('32','2','衬衣','999','20','new1.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('33','2','哇财','988','45','new2.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('34','2','口红','1000','20','new3.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('35','2','洗衣板','1000','22','new4.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('36','2','性感肚兜','999','30','new5.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('37','2','靓丽高跟鞋','1000','35','new6.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('38','2','浓情红玫瑰','1000','26','new7.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('39','2','剃须刀','1000','28','new8.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('40','2','真爱冰激淋','1000','20','new9.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('41','2','奶嘴','997','20','new10.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('43','1','雷公','872','22','birth11.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('44','1','电母','885','22','birth12.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('45','1','协会','885','25','birth13.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('46','1','雷语','992','22','birth14.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('47','1','小队长','888','20','birth15.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('48','1','中队长','886','20','birth16.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('49','1','大队长','878','20','birth17.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('50','2','帅哥证','999','26','new11.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('51','2','美女证','1000','26','new12.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('52','2','公章','1000','28','new13.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('53','2','公章','1000','28','new14.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('54','2','公章','1000','28','new15.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('55','1','豪华跑车','876','45','birth18.gif','1','1214839221');
INSERT INTO ts_gift VALUES ('57','2','啤酒','988','50','4a6ff694f1a7a.gif','1','1248851604');
INSERT INTO ts_gift VALUES ('58','1','礼物盒','995','50','4a6ff7c85bd99.gif','1','1248851912');
INSERT INTO ts_gift VALUES ('59','2','乒乓球拍','997','50','4a6ffa25bb600.gif','1','1248852517');
INSERT INTO ts_gift VALUES ('60','2','网球','999','50','4a6ffa3b53591.gif','1','1248852539');
INSERT INTO ts_gift VALUES ('61','2','高尔夫球','998','50','4a6ffa4e50ea3.gif','1','1248852558');
INSERT INTO ts_gift VALUES ('62','2','橄榄球','999','50','4a6ffa69b46dd.gif','1','1248852585');
INSERT INTO ts_gift VALUES ('63','2','排球','998','50','4a6ffa7c62a7a.gif','1','1248852604');
INSERT INTO ts_gift VALUES ('64','2','篮球','996','50','4a6ffa94366a0.gif','1','1248852628');
INSERT INTO ts_gift VALUES ('65','2','足球','987','50','4a6ffa9ee5d18.gif','1','1248852638');
INSERT INTO ts_gift VALUES ('66','1','红枣粽子','997','50','4a6ffc7d10214.gif','1','1248853117');
INSERT INTO ts_gift VALUES ('67','1','运动鞋','994','100','4a6ffe72c1046.gif','1','1248853618');
INSERT INTO ts_gift VALUES ('68','1','披萨','987','100','4a700398492ca.gif','1','1248854936');
INSERT INTO ts_gift VALUES ('69','1','购物袋','994','100','4a7004032f310.gif','1','1248855043');
INSERT INTO ts_gift VALUES ('70','2','吸血蝙蝠','999','100','4a70046342824.gif','1','1248855139');
INSERT INTO ts_gift VALUES ('71','1','MP3','989','100','4a700508e3c92.gif','1','1248855304');
INSERT INTO ts_gift VALUES ('72','1','香水','987','100','4a700724e1fa1.gif','1','1248855844');
INSERT INTO ts_gift VALUES ('73','1','游戏机','998','100','4a70079505d66.gif','1','1248855957');
INSERT INTO ts_gift VALUES ('74','1','数码相机','996','200','4a7007a6923ea.gif','1','1248855974');
INSERT INTO ts_gift VALUES ('75','2','小笼包','997','100','4a700a2f649b4.gif','1','1248856623');
INSERT INTO ts_gift VALUES ('76','2','滑板','997','100','4a700a42a35b1.gif','1','1248856642');
INSERT INTO ts_gift VALUES ('77','1','红色跑车','84','200','4a700ae34514a.gif','1','1248856803');
INSERT INTO ts_gift VALUES ('78','1','急速跑车','70','200','4a700afee7d2e.gif','1','1248856830');

DROP TABLE IF EXISTS ts_gift_category;
CREATE TABLE `ts_gift_category` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  `cTime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ts_gift_category VALUES ('1','热门礼物','1','0');
INSERT INTO ts_gift_category VALUES ('2','最新上架','1','0');

DROP TABLE IF EXISTS ts_gift_user;
CREATE TABLE `ts_gift_user` (
  `id` int(11) NOT NULL auto_increment,
  `fromUserId` int(11) NOT NULL,
  `toUserId` int(11) NOT NULL,
  `giftPrice` int(11) NOT NULL,
  `giftImg` varchar(255) NOT NULL,
  `sendInfo` text NOT NULL,
  `sendWay` tinyint(1) NOT NULL,
  `cTime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_group;
CREATE TABLE `ts_group` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL default '0',
  `name` varchar(32) NOT NULL,
  `intro` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `announce` text NOT NULL,
  `cid0` smallint(6) unsigned NOT NULL,
  `cid1` smallint(6) unsigned NOT NULL,
  `membercount` smallint(6) unsigned NOT NULL default '0',
  `threadcount` smallint(6) unsigned NOT NULL default '0',
  `type` enum('open','limit','close') NOT NULL,
  `need_invite` tinyint(1) NOT NULL default '2',
  `need_verify` tinyint(4) NOT NULL,
  `actor_level` tinyint(4) NOT NULL,
  `brower_level` tinyint(4) NOT NULL default '-1',
  `openBlog` tinyint(1) NOT NULL default '1',
  `openUploadFile` tinyint(1) NOT NULL default '1',
  `whoUploadFile` tinyint(1) NOT NULL default '1',
  `whoDownloadFile` tinyint(1) NOT NULL default '2',
  `openAlbum` tinyint(1) NOT NULL default '1',
  `whoCreateAlbum` tinyint(1) NOT NULL default '1',
  `whoUploadPic` tinyint(1) NOT NULL default '0',
  `anno` tinyint(1) NOT NULL default '0',
  `ipshow` tinyint(1) NOT NULL default '0',
  `invitepriv` tinyint(1) NOT NULL default '0',
  `createalbumpriv` tinyint(1) NOT NULL default '1',
  `uploadpicpriv` tinyint(1) NOT NULL default '0',
  `ctime` int(11) NOT NULL default '0',
  `mtime` int(11) unsigned NOT NULL default '0',
  `status` tinyint(1) NOT NULL default '1',
  `isrecom` tinyint(1) NOT NULL default '0',
  `is_del` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ts_group VALUES ('1','1','测试群组...','测试群组...','2011/1223/17/4ef4454aecad3.jpg','asdfasdfafsdfsdf','1','0','1','0','open','0','0','0','-1','1','1','3','3','0','0','0','0','0','0','1','0','1324631370','0','1','0','0');
INSERT INTO ts_group VALUES ('2','1','asdfa','asdfsdffasdfsfd','2011/1223/18/4ef45d5189dae.jpg','','2','16','1','0','close','2','0','0','1','1','1','3','3','0','0','0','0','0','0','1','0','1324637521','0','1','0','0');

DROP TABLE IF EXISTS ts_group_album;
CREATE TABLE `ts_group_album` (
  `id` int(11) NOT NULL auto_increment,
  `gid` int(11) NOT NULL,
  `userId` int(11) default NULL,
  `name` varchar(255) default NULL,
  `info` text,
  `cTime` int(11) unsigned default NULL,
  `mTime` int(11) unsigned default NULL,
  `coverImageId` int(11) NOT NULL,
  `coverImagePath` varchar(255) default NULL,
  `photoCount` int(11) default '0',
  `status` tinyint(2) unsigned NOT NULL default '1',
  `share` tinyint(1) NOT NULL default '0',
  `is_del` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `uid` (`userId`),
  KEY `cTime` (`cTime`),
  KEY `mTime` (`mTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_group_attachment;
CREATE TABLE `ts_group_attachment` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `gid` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `attachId` int(11) unsigned NOT NULL,
  `name` varchar(32) NOT NULL,
  `note` text NOT NULL,
  `filesize` int(10) NOT NULL default '0',
  `filetype` varchar(10) NOT NULL,
  `fileurl` varchar(255) NOT NULL,
  `totaldowns` mediumint(6) NOT NULL default '0',
  `ctime` int(11) NOT NULL,
  `mtime` varchar(11) NOT NULL default '0',
  `status` tinyint(1) NOT NULL default '0',
  `is_del` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `gid` (`gid`),
  KEY `gid_2` (`gid`,`attachId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_group_attachment VALUES ('1','1','1','5','car.jpg','','18245','jpg','2011/1223/17/4ef44655a02d7.jpg','1','1324631637','0','0','0');

DROP TABLE IF EXISTS ts_group_category;
CREATE TABLE `ts_group_category` (
  `id` mediumint(5) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL default '1',
  `pid` mediumint(5) NOT NULL default '0',
  `module` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

INSERT INTO ts_group_category VALUES ('1','明星粉丝','1','0','');
INSERT INTO ts_group_category VALUES ('2','行业交流','1','0','');
INSERT INTO ts_group_category VALUES ('3','兴趣爱好','1','0','');
INSERT INTO ts_group_category VALUES ('4','科教人文','1','0','');
INSERT INTO ts_group_category VALUES ('5','生活时尚','1','0','');
INSERT INTO ts_group_category VALUES ('6','同城会','1','0','');
INSERT INTO ts_group_category VALUES ('7','老友记','1','0','');
INSERT INTO ts_group_category VALUES ('8','房产汽车','1','0','');
INSERT INTO ts_group_category VALUES ('9','港台','1','1','');
INSERT INTO ts_group_category VALUES ('10','内地','1','1','');
INSERT INTO ts_group_category VALUES ('11','日韩','1','1','');
INSERT INTO ts_group_category VALUES ('12','欧美','1','1','');
INSERT INTO ts_group_category VALUES ('13','网络红人','1','1','');
INSERT INTO ts_group_category VALUES ('14','其它','1','1','');
INSERT INTO ts_group_category VALUES ('15','IT互联网','1','2','');
INSERT INTO ts_group_category VALUES ('16','商业财经','1','2','');
INSERT INTO ts_group_category VALUES ('17','传媒公关','1','2','');
INSERT INTO ts_group_category VALUES ('18','机构&公益','1','2','');
INSERT INTO ts_group_category VALUES ('19','创意联盟','1','2','');
INSERT INTO ts_group_category VALUES ('20','其它行业','1','2','');
INSERT INTO ts_group_category VALUES ('21','第三方应用','1','2','');
INSERT INTO ts_group_category VALUES ('22','囧笑话','1','3','');
INSERT INTO ts_group_category VALUES ('23','动漫','1','3','');
INSERT INTO ts_group_category VALUES ('24','游戏','1','3','');
INSERT INTO ts_group_category VALUES ('25','体育','1','3','');
INSERT INTO ts_group_category VALUES ('26','购物','1','3','');
INSERT INTO ts_group_category VALUES ('27','旅游','1','3','');
INSERT INTO ts_group_category VALUES ('28','摄影','1','3','');
INSERT INTO ts_group_category VALUES ('29','音乐','1','3','');
INSERT INTO ts_group_category VALUES ('30','电影','1','3','');
INSERT INTO ts_group_category VALUES ('31','电视','1','3','');
INSERT INTO ts_group_category VALUES ('32','数码','1','3','');
INSERT INTO ts_group_category VALUES ('33','稀奇古怪','1','3','');
INSERT INTO ts_group_category VALUES ('34','文学阅读','1','4','');
INSERT INTO ts_group_category VALUES ('35','社科文艺','1','4','');
INSERT INTO ts_group_category VALUES ('36','科学技术','1','4','');
INSERT INTO ts_group_category VALUES ('37','教育考试','1','4','');
INSERT INTO ts_group_category VALUES ('38','历史军事','1','4','');
INSERT INTO ts_group_category VALUES ('39','潮流时尚','1','5','');
INSERT INTO ts_group_category VALUES ('40','七八九零','1','5','');
INSERT INTO ts_group_category VALUES ('41','帅哥美女','1','5','');
INSERT INTO ts_group_category VALUES ('42','情感','1','5','');
INSERT INTO ts_group_category VALUES ('43','健康','1','5','');
INSERT INTO ts_group_category VALUES ('44','星座','1','5','');
INSERT INTO ts_group_category VALUES ('45','宠物','1','5','');
INSERT INTO ts_group_category VALUES ('46','美食','1','5','');
INSERT INTO ts_group_category VALUES ('47','休闲','1','5','');
INSERT INTO ts_group_category VALUES ('48','家庭亲子','1','5','');
INSERT INTO ts_group_category VALUES ('49','生活信息','1','5','');
INSERT INTO ts_group_category VALUES ('50','北京','1','6','');
INSERT INTO ts_group_category VALUES ('51','上海','1','6','');
INSERT INTO ts_group_category VALUES ('52','广东','1','6','');
INSERT INTO ts_group_category VALUES ('53','江苏','1','6','');
INSERT INTO ts_group_category VALUES ('54','山东','1','6','');
INSERT INTO ts_group_category VALUES ('55','安徽','1','6','');
INSERT INTO ts_group_category VALUES ('56','浙江','1','6','');
INSERT INTO ts_group_category VALUES ('57','福建','1','6','');
INSERT INTO ts_group_category VALUES ('58','河北','1','6','');
INSERT INTO ts_group_category VALUES ('59','河南','1','6','');
INSERT INTO ts_group_category VALUES ('60','辽宁','1','6','');
INSERT INTO ts_group_category VALUES ('61','湖北','1','6','');
INSERT INTO ts_group_category VALUES ('62','四川','1','6','');
INSERT INTO ts_group_category VALUES ('63','同学','1','7','');
INSERT INTO ts_group_category VALUES ('64','老乡','1','7','');
INSERT INTO ts_group_category VALUES ('65','同事','1','7','');
INSERT INTO ts_group_category VALUES ('66','好友','1','7','');
INSERT INTO ts_group_category VALUES ('67','互粉','1','7','');
INSERT INTO ts_group_category VALUES ('68','小区','1','8','');
INSERT INTO ts_group_category VALUES ('69','房产家居','1','8','');
INSERT INTO ts_group_category VALUES ('70','汽车','1','8','');
INSERT INTO ts_group_category VALUES ('71','fff','1','1','');

DROP TABLE IF EXISTS ts_group_invite_verify;
CREATE TABLE `ts_group_invite_verify` (
  `invite_id` int(11) NOT NULL auto_increment,
  `gid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `is_used` int(11) NOT NULL default '0',
  PRIMARY KEY  (`invite_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_group_log;
CREATE TABLE `ts_group_log` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `gid` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `content` text NOT NULL,
  `ctime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_group_log VALUES ('1','1','1','setting','<a href=\'http://192.168.243.101/ts/index.php?app=home&mod=Space&act=index&uid=1\' class=\'fn\' target=\'_blank\'>@管理员</a> 发布公告: asdfasdfafsdfsdf','1324637464');

DROP TABLE IF EXISTS ts_group_member;
CREATE TABLE `ts_group_member` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `gid` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL default '0',
  `name` char(10) NOT NULL,
  `reason` text NOT NULL,
  `status` tinyint(1) default '1',
  `level` tinyint(2) unsigned default '1',
  `ctime` int(11) NOT NULL default '0',
  `mtime` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `gid` (`gid`,`uid`),
  KEY `mid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ts_group_member VALUES ('1','1','1','管理员','','1','1','1324631370','1325753543');
INSERT INTO ts_group_member VALUES ('2','2','1','管理员','','1','1','1324637521','1324637521');

DROP TABLE IF EXISTS ts_group_photo;
CREATE TABLE `ts_group_photo` (
  `id` int(11) NOT NULL auto_increment,
  `gid` int(11) NOT NULL,
  `attachId` int(11) NOT NULL,
  `albumId` int(11) NOT NULL,
  `userId` int(11) default NULL,
  `status` tinyint(2) unsigned NOT NULL default '1',
  `name` varchar(255) NOT NULL,
  `cTime` int(11) unsigned default NULL,
  `mTime` int(11) unsigned default NULL,
  `info` text,
  `commentCount` int(11) unsigned default '0',
  `readCount` int(11) unsigned default '0',
  `savepath` varchar(255) NOT NULL,
  `size` int(11) NOT NULL default '0',
  `tags` text,
  `order` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `gid` (`gid`,`albumId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_group_post;
CREATE TABLE `ts_group_post` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `gid` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `tid` int(11) unsigned NOT NULL,
  `content` text NOT NULL,
  `ip` char(16) NOT NULL,
  `istopic` tinyint(1) NOT NULL default '0',
  `ctime` int(11) NOT NULL default '0',
  `status` tinyint(1) NOT NULL default '0',
  `quote` int(11) unsigned NOT NULL default '0',
  `is_del` varchar(1) NOT NULL default '0',
  `attach` text,
  PRIMARY KEY  (`id`),
  KEY `gid` (`gid`,`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_group_post VALUES ('1','1','1','1','&lt;p&gt;吼吼...欢迎大家来玩啊...吼吼...欢迎大家来玩啊...吼吼...欢迎大家来玩啊...&lt;/p&gt;','192.168.243.103','1','1324631639','0','0','0','');

DROP TABLE IF EXISTS ts_group_tag;
CREATE TABLE `ts_group_tag` (
  `group_tag_id` int(11) NOT NULL auto_increment,
  `gid` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY  (`group_tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ts_group_tag VALUES ('1','1','1');
INSERT INTO ts_group_tag VALUES ('2','1','2');
INSERT INTO ts_group_tag VALUES ('3','2','3');

DROP TABLE IF EXISTS ts_group_topic;
CREATE TABLE `ts_group_topic` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `gid` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `name` varchar(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `cid` int(11) unsigned NOT NULL,
  `viewcount` smallint(6) unsigned NOT NULL default '0',
  `replycount` smallint(6) unsigned NOT NULL default '0',
  `dist` tinyint(1) NOT NULL default '0',
  `top` tinyint(1) NOT NULL default '0',
  `lock` tinyint(1) NOT NULL default '0',
  `addtime` int(11) NOT NULL default '0',
  `replytime` int(11) NOT NULL default '0',
  `mtime` int(11) unsigned NOT NULL default '0',
  `status` tinyint(1) NOT NULL default '0',
  `isrecom` tinyint(1) NOT NULL default '0',
  `is_del` tinyint(1) NOT NULL default '0',
  `attach` text,
  PRIMARY KEY  (`id`),
  KEY `gid` (`gid`),
  KEY `gid_2` (`gid`,`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_group_topic VALUES ('1','1','1','管理员','吼吼...欢迎大家来玩啊...','0','4','0','0','0','0','1324631639','1324631639','0','0','0','0','a:1:{i:0;s:1:\"1\";}');

DROP TABLE IF EXISTS ts_group_topic_category;
CREATE TABLE `ts_group_topic_category` (
  `id` mediumint(6) unsigned NOT NULL auto_increment,
  `gid` int(11) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_group_topic_collect;
CREATE TABLE `ts_group_topic_collect` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `tid` int(11) unsigned NOT NULL default '0',
  `mid` int(11) unsigned NOT NULL default '0',
  `addtime` int(11) unsigned NOT NULL default '0',
  `is_del` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `tid` (`tid`,`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_group_user_count;
CREATE TABLE `ts_group_user_count` (
  `uid` int(11) NOT NULL,
  `atme` mediumint(6) NOT NULL,
  `comment` mediumint(6) NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_group_weibo;
CREATE TABLE `ts_group_weibo` (
  `weibo_id` int(11) NOT NULL auto_increment,
  `gid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `content` text NOT NULL,
  `ctime` int(11) NOT NULL,
  `from` tinyint(1) NOT NULL,
  `from_data` text,
  `comment` mediumint(8) NOT NULL,
  `transpond_id` int(11) NOT NULL default '0',
  `transpond` mediumint(8) NOT NULL,
  `type` varchar(255) default '0',
  `type_data` text,
  `isdel` tinyint(1) NOT NULL,
  PRIMARY KEY  (`weibo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO ts_group_weibo VALUES ('1','1','1','欢迎光临 测试群组哈...','1324631462','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('2','1','1','似懂非懂是','1324631489','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('3','1','1','水电费','1324631493','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('4','1','1','随碟附送','1324631496','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('5','1','1','随碟附送地方似懂非懂是','1324631499','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('6','1','1','随碟附送地方第三方','1324631503','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('7','1','1','水电费','1324631507','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('8','1','1','似懂非懂是','1324631510','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('9','1','1','似懂非懂是','1324631513','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('10','1','1','似懂非懂','1324631516','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('11','1','1','水电费','1324631520','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('12','1','1','随碟附送的','1324631523','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('13','1','1','似懂非懂是','1324631526','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('14','1','1','随碟附送的','1324631529','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('15','1','1','我发起了一份帖子:【吼吼...欢迎大家来玩啊...】 http://goo.gl/66XYo ','1324631643','0','','0','0','0','0','','0');
INSERT INTO ts_group_weibo VALUES ('16','1','1','asdfsdfafasdf','1324637535','0','','0','0','0','0','','0');

DROP TABLE IF EXISTS ts_group_weibo_atme;
CREATE TABLE `ts_group_weibo_atme` (
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `weibo_id` int(11) NOT NULL,
  UNIQUE KEY `uid` (`uid`,`weibo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_group_weibo_comment;
CREATE TABLE `ts_group_weibo_comment` (
  `comment_id` int(11) NOT NULL auto_increment,
  `gid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `reply_comment_id` int(11) NOT NULL,
  `reply_uid` int(11) NOT NULL,
  `weibo_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `ctime` int(11) NOT NULL,
  `isdel` tinyint(1) NOT NULL,
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_group_weibo_topic;
CREATE TABLE `ts_group_weibo_topic` (
  `topic_id` int(11) unsigned NOT NULL auto_increment,
  `gid` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `count` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY  (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_industry;
CREATE TABLE `ts_industry` (
  `indust_id` int(5) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `fid` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`indust_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_information;
CREATE TABLE `ts_information` (
  `info_id` int(11) NOT NULL auto_increment,
  `cate_id` int(3) NOT NULL,
  `title` varchar(300) collate utf8_unicode_ci NOT NULL,
  `intro` varchar(1000) collate utf8_unicode_ci NOT NULL,
  `content` text collate utf8_unicode_ci NOT NULL,
  `uid` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '0',
  `recommend` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`info_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS ts_information_cate;
CREATE TABLE `ts_information_cate` (
  `cate_id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `ename` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_information_comment;
CREATE TABLE `ts_information_comment` (
  `id` int(11) NOT NULL auto_increment,
  `content` varchar(10000) NOT NULL,
  `uid` int(11) NOT NULL,
  `reply_uid` int(11) NOT NULL default '0',
  `source_id` int(11) NOT NULL default '0',
  `info_id` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_invite_record;
CREATE TABLE `ts_invite_record` (
  `invite_record_id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL,
  `fid` int(11) unsigned NOT NULL,
  `ctime` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`invite_record_id`),
  UNIQUE KEY `uid` (`uid`,`fid`),
  KEY `ctime` (`ctime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_invitecode;
CREATE TABLE `ts_invitecode` (
  `invite_code_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `code` varchar(120) NOT NULL,
  `is_used` tinyint(1) NOT NULL,
  `type` char(40) NOT NULL,
  `is_received` tinyint(1) NOT NULL,
  PRIMARY KEY  (`invite_code_id`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_login;
CREATE TABLE `ts_login` (
  `login_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `type_uid` varchar(255) NOT NULL default '',
  `type` char(80) NOT NULL,
  `oauth_token` varchar(150) default NULL,
  `oauth_token_secret` varchar(150) default NULL,
  `is_sync` tinyint(1) NOT NULL,
  PRIMARY KEY  (`login_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_user_online;
CREATE TABLE `ts_user_online` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_login_record;
CREATE TABLE `ts_login_record` (
  `login_record_id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `ip` varchar(15) default NULL,
  `place` varchar(255) default NULL,
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`login_record_id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

INSERT INTO ts_login_record VALUES ('1','1','192.168.243.100','- LAN','1324622987');
INSERT INTO ts_login_record VALUES ('2','1','192.168.243.100','- LAN','1324623069');
INSERT INTO ts_login_record VALUES ('3','1','192.168.243.103','- LAN','1324628253');
INSERT INTO ts_login_record VALUES ('4','1','192.168.243.103','- LAN','1324628253');
INSERT INTO ts_login_record VALUES ('5','1','192.168.243.103','- LAN','1324630359');
INSERT INTO ts_login_record VALUES ('6','1','192.168.243.103','- LAN','1324632147');
INSERT INTO ts_login_record VALUES ('7','1','192.168.243.100','- LAN','1324802890');
INSERT INTO ts_login_record VALUES ('8','1','192.168.243.100','- LAN','1324869693');
INSERT INTO ts_login_record VALUES ('9','1','192.168.243.103','- LAN','1324870147');
INSERT INTO ts_login_record VALUES ('10','1','192.168.243.100','- LAN','1324878856');
INSERT INTO ts_login_record VALUES ('11','2','192.168.243.100','- LAN','1324887554');
INSERT INTO ts_login_record VALUES ('12','1','192.168.243.103','- LAN','1324973259');
INSERT INTO ts_login_record VALUES ('13','2','192.168.243.100','- LAN','1324973412');
INSERT INTO ts_login_record VALUES ('14','1','192.168.243.103','- LAN','1324980394');
INSERT INTO ts_login_record VALUES ('15','1','192.168.243.103','- LAN','1325036400');
INSERT INTO ts_login_record VALUES ('16','1','192.168.243.103','- LAN','1325036400');
INSERT INTO ts_login_record VALUES ('17','1','192.168.243.103','- LAN','1325036400');
INSERT INTO ts_login_record VALUES ('18','1','192.168.243.103','- LAN','1325036400');
INSERT INTO ts_login_record VALUES ('19','1','192.168.243.103','- LAN','1325036400');
INSERT INTO ts_login_record VALUES ('20','1','192.168.243.103','- LAN','1325036400');
INSERT INTO ts_login_record VALUES ('21','1','192.168.243.103','- LAN','1325039366');
INSERT INTO ts_login_record VALUES ('22','1','192.168.243.103','- LAN','1325039366');
INSERT INTO ts_login_record VALUES ('23','1','192.168.243.103','- LAN','1325039367');
INSERT INTO ts_login_record VALUES ('24','1','192.168.243.103','- LAN','1325039367');
INSERT INTO ts_login_record VALUES ('25','1','192.168.243.103','- LAN','1325039367');
INSERT INTO ts_login_record VALUES ('26','1','192.168.243.103','- LAN','1325039367');
INSERT INTO ts_login_record VALUES ('27','1','192.168.243.103','- LAN','1325054710');
INSERT INTO ts_login_record VALUES ('28','1','192.168.243.103','- LAN','1325054710');
INSERT INTO ts_login_record VALUES ('29','1','192.168.243.103','- LAN','1325054711');
INSERT INTO ts_login_record VALUES ('30','1','192.168.243.103','- LAN','1325054711');
INSERT INTO ts_login_record VALUES ('31','1','192.168.243.103','- LAN','1325054711');
INSERT INTO ts_login_record VALUES ('32','1','192.168.243.103','- LAN','1325054711');
INSERT INTO ts_login_record VALUES ('33','1','192.168.243.103','- LAN','1325054923');
INSERT INTO ts_login_record VALUES ('34','1','192.168.243.103','- LAN','1325068724');
INSERT INTO ts_login_record VALUES ('35','1','192.168.243.101','- LAN','1325073655');
INSERT INTO ts_login_record VALUES ('36','1','192.168.243.101','- LAN','1325073675');
INSERT INTO ts_login_record VALUES ('37','1','192.168.243.103','- LAN','1325123432');
INSERT INTO ts_login_record VALUES ('38','1','192.168.243.103','- LAN','1325123433');
INSERT INTO ts_login_record VALUES ('39','1','192.168.243.103','- LAN','1325143083');
INSERT INTO ts_login_record VALUES ('40','1','192.168.243.103','- LAN','1325145110');
INSERT INTO ts_login_record VALUES ('41','1','192.168.243.103','- LAN','1325152838');
INSERT INTO ts_login_record VALUES ('42','1','192.168.243.103','- LAN','1325218350');
INSERT INTO ts_login_record VALUES ('43','1','192.168.243.103','- LAN','1325227163');
INSERT INTO ts_login_record VALUES ('44','1','192.168.243.103','- LAN','1325227298');
INSERT INTO ts_login_record VALUES ('45','1','192.168.243.103','- LAN','1325227385');
INSERT INTO ts_login_record VALUES ('46','1','192.168.243.103','- LAN','1325227408');
INSERT INTO ts_login_record VALUES ('47','2','192.168.243.100','- LAN','1325230364');
INSERT INTO ts_login_record VALUES ('48','1','192.168.243.100','- LAN','1325230453');
INSERT INTO ts_login_record VALUES ('49','1','192.168.243.100','- LAN','1325232429');
INSERT INTO ts_login_record VALUES ('50','1','192.168.243.100','- LAN','1325294949');
INSERT INTO ts_login_record VALUES ('51','1','192.168.243.103','- LAN','1325297954');
INSERT INTO ts_login_record VALUES ('52','1','192.168.243.103','- LAN','1325311151');
INSERT INTO ts_login_record VALUES ('53','1','192.168.243.103','- LAN','1325320014');
INSERT INTO ts_login_record VALUES ('54','3','192.168.243.100','- LAN','1325327016');
INSERT INTO ts_login_record VALUES ('55','1','192.168.243.100','- LAN','1325640256');
INSERT INTO ts_login_record VALUES ('56','1','192.168.243.100','- LAN','1325640321');
INSERT INTO ts_login_record VALUES ('57','1','192.168.243.103','- LAN','1325727380');
INSERT INTO ts_login_record VALUES ('58','1','192.168.243.103','- LAN','1325731622');
INSERT INTO ts_login_record VALUES ('59','1','192.168.243.103','- LAN','1325740532');
INSERT INTO ts_login_record VALUES ('60','1','192.168.243.103','- LAN','1325746287');
INSERT INTO ts_login_record VALUES ('61','1','192.168.243.103','- LAN','1325746773');
INSERT INTO ts_login_record VALUES ('62','1','192.168.243.103','- LAN','1325749128');
INSERT INTO ts_login_record VALUES ('63','1','192.168.243.103','- LAN','1325754962');
INSERT INTO ts_login_record VALUES ('64','1','192.168.243.100','- LAN','1325758956');
INSERT INTO ts_login_record VALUES ('65','1','192.168.243.100','- LAN','1325758993');
INSERT INTO ts_login_record VALUES ('66','1','192.168.243.103','- LAN','1325760159');
INSERT INTO ts_login_record VALUES ('67','1','192.168.243.100','- LAN','1325831685');
INSERT INTO ts_login_record VALUES ('68','1','192.168.243.103','- LAN','1326073468');
INSERT INTO ts_login_record VALUES ('69','1','192.168.243.100','- LAN','1326088983');
INSERT INTO ts_login_record VALUES ('70','1','192.168.243.100','- LAN','1326089819');

DROP TABLE IF EXISTS ts_medal;
CREATE TABLE `ts_medal` (
  `medal_id` int(11) NOT NULL auto_increment,
  `path_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `data` text,
  `is_active` tinyint(1) NOT NULL default '1',
  `display_order` smallint(4) NOT NULL default '0',
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`medal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_message;
CREATE TABLE `ts_message` (
  `message_id` int(11) NOT NULL auto_increment,
  `from_uid` int(11) NOT NULL,
  `to_uid` int(11) NOT NULL,
  `title` varchar(255) default NULL,
  `content` text,
  `source_message_id` int(255) NOT NULL default '0',
  `is_read` tinyint(1) NOT NULL default '0',
  `is_lastest` tinyint(1) NOT NULL default '1',
  `deleted_by` int(11) NOT NULL default '0',
  `ctime` int(11) NOT NULL,
  PRIMARY KEY  (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_myop_friendlog;
CREATE TABLE `ts_myop_friendlog` (
  `uid` int(11) NOT NULL,
  `fuid` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `dateline` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO ts_myop_friendlog VALUES ('1','2','add','1324887566');
INSERT INTO ts_myop_friendlog VALUES ('2','1','add','1324887566');
INSERT INTO ts_myop_friendlog VALUES ('2','1','add','1324978366');
INSERT INTO ts_myop_friendlog VALUES ('1','3','add','1325327029');
INSERT INTO ts_myop_friendlog VALUES ('3','1','add','1325327029');
INSERT INTO ts_myop_friendlog VALUES ('3','2','add','1325327035');

DROP TABLE IF EXISTS ts_myop_myapp;
CREATE TABLE `ts_myop_myapp` (
  `appid` mediumint(8) unsigned NOT NULL default '0',
  `appname` varchar(60) NOT NULL default '',
  `narrow` tinyint(1) NOT NULL default '0',
  `flag` tinyint(1) NOT NULL default '0',
  `version` mediumint(8) unsigned NOT NULL default '0',
  `displaymethod` tinyint(1) NOT NULL default '0',
  `displayorder` smallint(6) unsigned NOT NULL default '0',
  PRIMARY KEY  (`appid`),
  KEY `flag` (`flag`,`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_myop_myinvite;
CREATE TABLE `ts_myop_myinvite` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `typename` varchar(100) NOT NULL default '',
  `appid` mediumint(8) NOT NULL default '0',
  `type` tinyint(1) NOT NULL default '0',
  `fromuid` mediumint(8) unsigned NOT NULL default '0',
  `touid` mediumint(8) unsigned NOT NULL default '0',
  `myml` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL default '0',
  `hash` int(10) unsigned NOT NULL default '0',
  `is_read` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `hash` (`hash`),
  KEY `uid` (`touid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_myop_userapp;
CREATE TABLE `ts_myop_userapp` (
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `appid` mediumint(8) unsigned NOT NULL default '0',
  `appname` varchar(60) NOT NULL default '',
  `privacy` tinyint(1) NOT NULL default '0',
  `allowsidenav` tinyint(1) NOT NULL default '0',
  `allowfeed` tinyint(1) NOT NULL default '0',
  `allowprofilelink` tinyint(1) NOT NULL default '0',
  `narrow` tinyint(1) NOT NULL default '0',
  `menuorder` smallint(6) NOT NULL default '0',
  `displayorder` smallint(6) NOT NULL default '0',
  `ext` text,
  KEY `uid` (`uid`,`appid`),
  KEY `menuorder` (`uid`,`menuorder`),
  KEY `displayorder` (`uid`,`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_myop_userappfield;
CREATE TABLE `ts_myop_userappfield` (
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `appid` mediumint(8) unsigned NOT NULL default '0',
  `profilelink` text NOT NULL,
  `myml` text NOT NULL,
  KEY `uid` (`uid`,`appid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_myop_userlog;
CREATE TABLE `ts_myop_userlog` (
  `uid` int(11) NOT NULL default '0',
  `action` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL default '0',
  `dateline` int(11) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO ts_myop_userlog VALUES ('1','add','0','1324622963');
INSERT INTO ts_myop_userlog VALUES ('2','add','0','1324887554');
INSERT INTO ts_myop_userlog VALUES ('3','add','0','1325327016');

DROP TABLE IF EXISTS ts_node;
CREATE TABLE `ts_node` (
  `node_id` int(11) NOT NULL auto_increment,
  `app_name` varchar(255) NOT NULL,
  `app_alias` varchar(255) default NULL,
  `mod_name` varchar(255) NOT NULL,
  `mod_alias` varchar(255) default NULL,
  `act_name` varchar(255) NOT NULL,
  `act_alias` varchar(255) default NULL,
  `parent_node_id` int(11) NOT NULL COMMENT '??action',
  `description` text,
  PRIMARY KEY  (`node_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_node VALUES ('1','admin','管理后台','*','全部','*','全部','0','在“权限管理”中将本节点赋予某个用户组，它就能访问管理后台了');

DROP TABLE IF EXISTS ts_notify;
CREATE TABLE `ts_notify` (
  `notify_id` int(11) NOT NULL auto_increment,
  `from` int(11) NOT NULL,
  `receive` int(11) NOT NULL,
  `type` char(80) NOT NULL,
  `data` text NOT NULL,
  `is_read` tinyint(1) NOT NULL default '0',
  `ctime` int(11) NOT NULL,
  PRIMARY KEY  (`notify_id`),
  KEY `receive` (`receive`,`is_read`),
  KEY `ctime` (`ctime`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO ts_notify VALUES ('2','1','2','follow','s:0:\"\";','0','1324887566');
INSERT INTO ts_notify VALUES ('3','2','1','follow','s:0:\"\";','0','1324887566');
INSERT INTO ts_notify VALUES ('4','2','1','follow','s:0:\"\";','0','1324978366');
INSERT INTO ts_notify VALUES ('5','1','3','follow','s:0:\"\";','0','1325327029');
INSERT INTO ts_notify VALUES ('6','3','1','follow','s:0:\"\";','0','1325327029');
INSERT INTO ts_notify VALUES ('7','3','2','follow','s:0:\"\";','0','1325327035');

DROP TABLE IF EXISTS ts_photo;
CREATE TABLE `ts_photo` (
  `id` int(11) NOT NULL auto_increment,
  `attachId` int(11) default NULL,
  `albumId` int(11) default NULL,
  `userId` int(11) default NULL,
  `status` tinyint(2) unsigned NOT NULL default '1',
  `name` varchar(255) default NULL,
  `cTime` int(11) unsigned default NULL,
  `mTime` int(11) unsigned default NULL,
  `info` text,
  `commentCount` int(11) unsigned default '0',
  `readCount` int(11) unsigned default '0',
  `savepath` varchar(255) default NULL,
  `size` int(11) NOT NULL default '0',
  `privacy` int(1) NOT NULL default '1',
  `tags` text,
  `order` int(11) NOT NULL default '0',
  `isDel` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO ts_photo VALUES ('1','1','1','1','1','4ea55642166be','1324629712','1324629712','','0','6','2011/1223/16/4ef43ed029881.jpg','221838','1','','10000','0');
INSERT INTO ts_photo VALUES ('2','2','1','1','1','4ec4e6b01d5f1','1324629712','1324629712','','0','5','2011/1223/16/4ef43ed057fc1.jpg','290991','1','','10000','0');
INSERT INTO ts_photo VALUES ('3','3','1','1','1','car','1324629810','1324629810','','0','6','2011/1223/16/4ef43f326e86f.jpg','18245','1','','10000','0');
INSERT INTO ts_photo VALUES ('4','6','1','1','1','car','1324636283','1324636283','','0','2','2011/1223/18/4ef4587bdd276.jpg','18245','1','','10000','0');
INSERT INTO ts_photo VALUES ('5','7','1','1','1','car','1324636932','1324636932','','0','3','2011/1223/18/4ef45b04a7260.jpg','18245','1','','10000','0');
INSERT INTO ts_photo VALUES ('6','8','1','1','1','car','1324636932','1324636932','','0','2','2011/1223/18/4ef45b04bd155.jpg','18245','1','','10000','0');
INSERT INTO ts_photo VALUES ('7','9','1','1','1','car','1324636932','1324636932','','0','2','2011/1223/18/4ef45b04d01a7.jpg','18245','1','','10000','0');
INSERT INTO ts_photo VALUES ('8','10','1','1','1','car','1324636932','1324636932','','0','2','2011/1223/18/4ef45b04eeacf.jpg','18245','1','','10000','0');
INSERT INTO ts_photo VALUES ('9','11','1','1','1','car','1324636933','1324636933','','0','3','2011/1223/18/4ef45b050dafa.jpg','18245','1','','10000','0');
INSERT INTO ts_photo VALUES ('10','12','1','1','1','car','1324636933','1324636933','','0','2','2011/1223/18/4ef45b05284ce.jpg','18245','1','','10000','0');
INSERT INTO ts_photo VALUES ('11','13','1','1','1','car','1324636933','1324636933','','0','2','2011/1223/18/4ef45b053b62e.jpg','18245','1','','10000','0');
INSERT INTO ts_photo VALUES ('12','14','1','1','1','tytyty','1324637423','1324637423','','1','3','2011/1223/18/4ef45cef9c962.jpg','88812','1','','10000','0');
INSERT INTO ts_photo VALUES ('13','15','1','1','1','9b5c4cc8-a2a4-4bd4-aeea-a1c434a8f605','1324637423','1324637423','','0','0','2011/1223/18/4ef45cefbeea9.jpg','358387','1','','10000','0');

DROP TABLE IF EXISTS ts_photo_album;
CREATE TABLE `ts_photo_album` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) default NULL,
  `name` varchar(255) default NULL,
  `info` text,
  `cTime` int(11) unsigned default NULL,
  `mTime` int(11) unsigned default NULL,
  `coverImageId` int(11) default NULL,
  `coverImagePath` varchar(255) default NULL,
  `photoCount` int(11) default '0',
  `readCount` int(11) default '0',
  `status` tinyint(2) unsigned NOT NULL default '1',
  `isHot` varchar(1) NOT NULL default '0',
  `rTime` int(11) NOT NULL default '0',
  `share` tinyint(1) NOT NULL default '0',
  `privacy` tinyint(1) default NULL,
  `privacy_data` text,
  `isDel` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `uid` (`userId`),
  KEY `cTime` (`cTime`),
  KEY `mTime` (`mTime`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_photo_album VALUES ('1','1','管理员的相册','','1324629702','1324629702','2','2011/1223/16/4ef43ed057fc1.jpg','13','12','1','0','0','0','1','','0');

DROP TABLE IF EXISTS ts_photo_index;
CREATE TABLE `ts_photo_index` (
  `albumId` int(11) NOT NULL default '0',
  `photoId` int(11) NOT NULL default '0',
  `userId` int(11) default NULL,
  `order` int(11) default NULL,
  `privacy` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`albumId`,`photoId`),
  UNIQUE KEY `album_photo` (`albumId`,`photoId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_photo_mark;
CREATE TABLE `ts_photo_mark` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `photoId` int(11) default NULL,
  `userId` int(11) default NULL,
  `userName` varchar(50) default NULL,
  `markedUserId` int(11) default NULL,
  `x` varchar(100) default NULL,
  `y` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_poster;
CREATE TABLE `ts_poster` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `title` varchar(255) character set gbk NOT NULL,
  `type` int(11) default NULL,
  `uid` int(11) NOT NULL,
  `address_city` int(11) default NULL,
  `address_province` int(11) default NULL,
  `cTime` int(11) default NULL,
  `deadline` int(11) default NULL,
  `content` text character set gbk NOT NULL,
  `contact` varchar(255) character set gbk default NULL,
  `private` int(1) NOT NULL default '0',
  `cover` varchar(255) character set gbk default NULL,
  `extra1` varchar(255) character set gbk default NULL,
  `extra2` varchar(255) character set gbk default NULL,
  `extra3` varchar(255) character set gbk default NULL,
  `extra4` varchar(255) character set gbk default NULL,
  `extra5` varchar(255) character set gbk default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_poster_small_type;
CREATE TABLE `ts_poster_small_type` (
  `id` int(11) NOT NULL auto_increment,
  `label` varchar(255) character set gbk NOT NULL default '类别',
  `name` varchar(255) character set gbk NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO ts_poster_small_type VALUES ('1','物品分类','影碟音像');
INSERT INTO ts_poster_small_type VALUES ('2','物品分类','书籍资料');
INSERT INTO ts_poster_small_type VALUES ('3','物品分类','服装饰品');
INSERT INTO ts_poster_small_type VALUES ('4','物品分类','日用百货');
INSERT INTO ts_poster_small_type VALUES ('5','物品分类','化妆保健品');
INSERT INTO ts_poster_small_type VALUES ('6','物品分类','票务优惠券');
INSERT INTO ts_poster_small_type VALUES ('7','物品分类','电脑相关');
INSERT INTO ts_poster_small_type VALUES ('8','物品分类','数码通讯');
INSERT INTO ts_poster_small_type VALUES ('9','物品分类','电家具');
INSERT INTO ts_poster_small_type VALUES ('10','物品分类','婴童用品');
INSERT INTO ts_poster_small_type VALUES ('11','物品分类','工艺收藏');
INSERT INTO ts_poster_small_type VALUES ('12','物品分类','其它');
INSERT INTO ts_poster_small_type VALUES ('13','团购种类','我要发起一个新团购');
INSERT INTO ts_poster_small_type VALUES ('14','团购种类','我要告诉大家团购消息');
INSERT INTO ts_poster_small_type VALUES ('15','房屋信息','出租');
INSERT INTO ts_poster_small_type VALUES ('16','房屋信息','求租');

DROP TABLE IF EXISTS ts_poster_type;
CREATE TABLE `ts_poster_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) character set gbk NOT NULL,
  `type` varchar(255) character set gbk default NULL,
  `templet` varchar(255) character set gbk default NULL,
  `explain` varchar(255) character set gbk NOT NULL,
  `ico` varchar(255) character set gbk NOT NULL,
  `state` tinyint(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO ts_poster_type VALUES ('1','分享物品','物品分类','12','与好友分享你的闲置物品如书籍、影碟、生活用品等，赠送、交换或出借','icon_fx.gif','0');
INSERT INTO ts_poster_type VALUES ('2','出售二手物品','物品分类','13','发布各类二手物品出售信息，可通过好友转发给更多的人','icon_rs.gif','0');
INSERT INTO ts_poster_type VALUES ('3','团购信息','团购种类','','你发起或想要告诉好友的任何团购优惠','icon_tg.gif','0');
INSERT INTO ts_poster_type VALUES ('4','拼车','物品类别','','发布拼车、搭顺风车相关信息','icon_pc.gif','0');
INSERT INTO ts_poster_type VALUES ('5','物品求购','物品分类','13','发布你的生活物品等的求购信息','icon_qg.gif','0');
INSERT INTO ts_poster_type VALUES ('6','房屋求租、出租','房屋信息','14,15,16','发布房屋出租或求租、合租等信息。','icon_house1.gif','0');

DROP TABLE IF EXISTS ts_poster_widget;
CREATE TABLE `ts_poster_widget` (
  `id` int(11) NOT NULL auto_increment,
  `label` varchar(255) character set gbk NOT NULL,
  `widget` varchar(255) character set gbk NOT NULL,
  `data` text character set gbk NOT NULL,
  `field` varchar(255) character set gbk NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO ts_poster_widget VALUES ('12','分享方式','CheckBox','a:3:{i:0;s:16:\"赠送[selected]\";i:1;s:8:\"\r\n借用\";i:2;s:8:\"\r\n交换\";}','extra1');
INSERT INTO ts_poster_widget VALUES ('13','价格','Input','s:0:\"\";','extra1');
INSERT INTO ts_poster_widget VALUES ('14','位置','Input','s:0:\"\";','extra1');
INSERT INTO ts_poster_widget VALUES ('15','面积','Input','s:0:\"\";','extra2');
INSERT INTO ts_poster_widget VALUES ('16','租金','Input','s:0:\"\";','extra3');

DROP TABLE IF EXISTS ts_project;
CREATE TABLE `ts_project` (
  `pro_id` int(11) NOT NULL auto_increment,
  `title` varchar(300) NOT NULL,
  `intro` text NOT NULL,
  `cap_id` int(3) NOT NULL default '0' COMMENT '资金规模',
  `cate_id` int(3) NOT NULL default '0' COMMENT '项目类别',
  `instruction` varchar(1000) NOT NULL,
  `browsecount` int(11) NOT NULL default '0',
  `uid` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`pro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_project_capital;
CREATE TABLE `ts_project_capital` (
  `cap_id` int(3) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`cap_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_project_cate;
CREATE TABLE `ts_project_cate` (
  `cate_id` int(3) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_project_collect;
CREATE TABLE `ts_project_collect` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_project_comment;
CREATE TABLE `ts_project_comment` (
  `id` int(11) NOT NULL auto_increment,
  `content` varchar(10000) NOT NULL,
  `uid` int(11) NOT NULL,
  `reply_uid` int(11) NOT NULL default '0',
  `source_id` int(11) NOT NULL default '0',
  `pro_id` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_question;
CREATE TABLE `ts_question` (
  `ques_id` int(11) NOT NULL auto_increment,
  `content` varchar(10000) NOT NULL,
  `ques_file` varchar(500) NOT NULL,
  `uid` int(11) NOT NULL,
  `public` tinyint(1) NOT NULL default '1',
  `ctime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`ques_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_question_answer;
CREATE TABLE `ts_question_answer` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `content` varchar(10000) collate utf8_unicode_ci NOT NULL,
  `reply_uid` int(11) NOT NULL default '0',
  `source_id` int(11) NOT NULL default '0',
  `ques_id` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS ts_question_collect;
CREATE TABLE `ts_question_collect` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_record_card;
CREATE TABLE `ts_record_card` (
  `rc_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sex` tinyint(1) NOT NULL default '0',
  `cellphone` varchar(12) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `company` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `intro` varchar(1000) NOT NULL,
  PRIMARY KEY  (`rc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_space;
CREATE TABLE `ts_space` (
  `uid` int(11) unsigned NOT NULL default '0',
  `hit` int(11) unsigned NOT NULL default '0',
  `setting` text NOT NULL,
  `credit_score` int(11) unsigned NOT NULL default '0',
  `credit_exp` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO ts_space VALUES ('2','0','','0','0');
INSERT INTO ts_space VALUES ('3','0','','0','0');

DROP TABLE IF EXISTS ts_system_data;
CREATE TABLE `ts_system_data` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL default '0',
  `list` char(30) default 'default',
  `key` char(50) default 'default',
  `value` text,
  `mtime` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `list` (`list`,`key`)
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=utf8;

INSERT INTO ts_system_data VALUES ('140','0','siteopt','site_name','s:24:\"知行网社交平台\";','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('141','0','siteopt','site_slogan','s:39:\"中国最大的高端商务社交平台\";','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('144','0','siteopt','site_closed','i:0;','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('154','0','siteopt','site_verify','a:1:{i:0;s:8:\"register\";}','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('149','0','siteopt','site_user_domain_on','s:1:\"1\";','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('6','0','siteopt','site_system_version','s:12:\"ThinkSNS 2.3\";','2010-12-31 15:46:44');
INSERT INTO ts_system_data VALUES ('7','0','siteopt','site_system_version_number','s:5:\"16095\";','2010-12-31 15:46:44');
INSERT INTO ts_system_data VALUES ('8','0','siteopt','__hash__','s:32:\"f9d2155a200139766ad5aa2e4606504c\";','2010-11-29 17:40:14');
INSERT INTO ts_system_data VALUES ('9','0','register','register_type','s:4:\"open\";','2010-12-06 12:08:56');
INSERT INTO ts_system_data VALUES ('10','0','register','register_email_activate','s:1:\"0\";','2010-12-06 12:08:56');
INSERT INTO ts_system_data VALUES ('36','0','register','register_auto_friend','i:1;','2011-12-23 14:49:23');
INSERT INTO ts_system_data VALUES ('12','0','register','register_realname_check','s:1:\"0\";','2010-11-25 17:33:01');
INSERT INTO ts_system_data VALUES ('13','0','register','register_lastname_single','s:3582:\"艾,安,昂,敖,奥,巴,霸,白,柏,拜,班,包,保,葆,豹,鲍,暴,卑,贲,毕,闭,秘,边,鞭,彪,别,宾,邴,秉,薄,卜,布,部,才,蔡,仓,苍,操,曹,策,岑,柴,镡,昌,苌,常,昶,畅,唱,晁,巢,朝,车,陈,谌,成,承,晟,乘,程,池,迟,充,种,崇,丑,侴,初,储,楚,禇,揣,啜,春,椿,慈,次,从,丛,爨,崔,萃,寸,达,笪,大,代,戴,丹,但,啖,党,刀,德,邓,狄,翟,邸,底,弟,典,刁,丁,定,东,冬,董,豆,窦,都,堵,杜,度,端,段,敦,顿,多,朵,颚,恩,法,氾,樊,范,方,芳,防,房,费,丰,风,封,酆,冯,逢,凤,奉,俸,伏,扶,苻,服,符,福,付,傅,富,改,盖,干,甘,淦,冮,刚,皋,高,杲,郜,戈,革,合,格,盖,葛,庚,赓,耿,弓,公,宫,龚,巩,贡,勾,缑,苟,勾,辜,古,谷,固,顾,关,官,筦,管,观,贯,冠,光,广,归,妫,邽,炅,炔,贵,桂,滚,过,呙,郭,国,虢,果,哈,海,罕,撖,杭,郝,合,何,和,亻各,贺,赫,黑,亨,恒,衡,弘,闳,宏,鸿,侯,后,郈,厚,呼,轷,狐,胡,壶,虎,户,扈,花,华,滑,华,怀,槐,还,环,郇,桓,宦,皇,黄,回,惠,浑,火,霍,姬,嵇,稽,及,吉,汲,姞,戢,集,藉,籍,纪,计,季,暨,冀,加,家,嘉,郏,甲,贾,坚,菅,检,简,翦,蹇,见,监,江,将,姜,蒋,降,焦,矫,皎,敫,曒,教,接,揭,节,介,金,晋,烬,京,经,荆,井,景,敬,靖,静,酒,局,倶,琚,鞠,菊,巨,剧,隽,圈,角,开,凯,阚,康,亢,伉,柯,可,坑,孔,寇,库,蒯,郐,宽,匡,邝,旷,况,奎,隗,夔,腊,来,赖,兰,蓝,郎,劳,老,乐,雷,冷,离,黎,李,里,力,历,厉,立,励,利,郦,栗,连,廉,练,良,梁,聊,廖,列,林,临,吝,蔺,令,泠,凌,刘,留,柳,龙,隆,娄,楼,卢,庐,鲁,陆,逯,禄,路,闾,吕,律,栾,论,论,罗,洛,骆,雒,麻,马,买,麦,满,莽,毛,茆,茅,冒,枚,梅,门,蒙,孟,弥,祢,糜,米,芈,弭,宓,密,苗,缪,闵,敏,名,万,莫,墨,默,牟,母,木,沐,睦,慕,穆,那,纳,乃,佴,南,铙,倪,年,粘,念,乜,聂,宁,牛,钮,农,侬,区,欧,潘,盘,泮,庞,裴,彭,邳,皮,朴,品,平,繁,蒲,濮,浦,普,溥,柒,戚,漆,亓,齐,祁,歧,綦,乞,杞,启,千,钱,潜,强,乔,桥,谯,且,郄,钦,秦,琴,覃,勤,青,卿,清,庆,丘,邱,秋,仇,求,裘,曲,屈,麴,渠,璩,瞿,蘧,权,全,泉,阙,冉,饶,壬,任,戎,荣,容,茹,汝,阮,软,芮,瑞,洒,撒,萨,伞,桑,沙,山,闪,陕,单,善,商,赏,尚,少,召,邵,折,佘,厍,舍,申,莘,神,沈,生,绳,盛,师,施,石,时,史,士,世,是,奭,首,寿,殳,舒,疏,束,树,耍,帅,双,水,睡,顺,司,思,死,斯,四,佀,姒,松,宋,苏,宿,粟,眭,睢,隋,随,穗,孙,所,索,塔,台,邰,台,太,泰,谈,覃,谭,澹,檀,镡,汤,唐,棠,陶,腾,提,遆,题,帖,铁,通,仝,同,佟,彤,童,钭,徒,涂,屠,土,脱,完,宛,晚,万,汪,王,望,危,韦,维,蒍,隗,位,尉,温,文,闻,问,翁,瓮,邬,巫,毋,吾,吴,伍,仵,武,务,西,析,郗,息,奚,锡,习,席,袭,隰,舄,夏,先,鲜,咸,冼,洗,羡,线,相,香,襄,祥,向,相,项,肖,萧,孝,谢,渫,辛,忻,新,信,兴,星,刑,邢,行,幸,熊,修,须,顼,徐,许,旭,续,轩,禤,旋,薛,穴,雪,寻,郇,荀,押,牙,轧,鄢,燕,延,严,言,阎,颜,晏,扬,羊,阳,杨,仰,幺,要,尧,姚,铫,药,冶,业,叶,伊,衣,依,仪,宜,乙,蚁,扆,弋,义,亦,易,弈,益,裔,翼,阴,殷,银,尹,印,应,英,营,赢,灜,雍,勇,涌,幽,尤,由,游,於,欲,余,鱼,俞,馀,宇,禹,庾,玉,郁,遇,喻,裕,毓,渊,元,袁,原,圆,源,员,苑,院,乐,岳,悦,越,云,妘,郧,运,员,郓,恽,韵,载,昝,臧,迮,笮,曾,增,查,乍,翟,呰,祭,占,詹,瞻,展,战,湛,张,章,彰,仉,掌,招,召,兆,赵,肇,真,甄,镇,正,郑,政,支,执,直,植,志,郅,智,终,钟,衷,种,仲,周,朱,邾,诸,竹,竺,主,祝,专,庄,卓,禚,资,訾,子,紫,宗,邹,驺,俎,祖,左,韩\";','2010-07-29 16:43:04');
INSERT INTO ts_system_data VALUES ('14','0','register','register_lastname_double','s:3060:\"安陵,安平,安期,安阳,白马,百里,柏侯,鲍俎,北宫,北郭,北门,北山,北唐,奔水,逼阳,宾牟,薄奚薄野,曹牟,曹丘,常涛,长鱼,车非,成功,成阳,乘马,叱卢,丑门,樗里,穿封,淳子,答禄,达勃,达步,达奚,淡台,邓陵,第五,地连,地伦,东方,东里,东南,东宫,东门东乡,东丹,东郭,东陵,东关,东闾,东阳,东野,东莱,豆卢,斗于,都尉,独孤端木,段干,多子,尔朱,方雷丰将,封人,封父,夫蒙,夫馀,浮丘,傅余,干已,高车,高陵,高堂,高阳,高辛,皋落,哥舒,盖楼,庚桑,梗阳,宫孙,公羊,公良,公孙,公罔,公西,公冶,公敛,公梁,公输,公上,公山,公户,公玉,公仪,公仲公坚,公伯,公祖,公乘,公晰,公族,姑布,古口,古龙,古孙,谷梁,谷浑,瓜田,关龙,鲑阳,归海,函治,韩馀,罕井,浩生,浩星,纥骨,纥奚纥于,贺拨,贺兰,贺楼,赫连,黑齿,黑肱,侯冈,呼延,壶丘,呼衍,斛律,胡非,胡母,胡毋,皇甫,皇父,兀官吉白,即墨,季瓜,季连,季孙,茄众,蒋丘,金齿,晋楚,京城,泾阳,九百,九方,睢鸠,沮渠,巨母,勘阻,渴侯,渴单,可汗,空桐,空相,昆吾,老阳,乐羊,荔菲,栎阳,梁丘,梁由,梁馀,梁垣,陵阳伶舟,冷沦,令狐,刘王,柳下,龙丘,卢妃,卢蒲,鲁步,陆费,角里,闾丘,马矢,麦丘,茅夷,弥牟,密革,密茅,墨夷,墨台,万俊,昌顿,慕容,木门,木易,南宫,南郭,南门,南荣,欧侯,欧阳,逄门,盆成,彭祖,平陵,平宁,破丑,仆固,濮阳,漆雕,奇介,綦母,綦毋,綦连,祁连,乞伏,绮里,千代,千乘,勤宿,青阳,丘丽,丘陵,屈侯,屈突,屈男,屈卢,屈同,屈门,屈引,壤四,扰龙,容成,汝嫣,萨孤,三饭,三闾,三州,桑丘,商瞿,上官,尚方,少师,少施,少室,少叔,少正,社南社北,申屠,申徒,沈犹,胜屠,石作石牛,侍其,士季,士弱,士孙,士贞,叔孙,叔先,叔促,水丘,司城,司空,司寇,司鸿,司马,司徒,司士,似和,素和,夙沙,孙阳,索阳,索卢,沓卢,太史,太叔,太阳,澹台,唐山,堂溪,陶丘,同蹄,统奚,秃发,涂钦,吐火,吐贺,吐万,吐罗,吐门,吐难,吐缶,吐浑吐奚,吐和,屯浑,脱脱,拓拨,完颜,王孙,王官,王人,微生,尾勺,温孤,温稽,闻人,屋户,巫马,吾丘,无庸,无钩,五鹿,息夫,西陵,西乞,西钥,西乡,西门,西周,西郭,西方,西野,西宫,戏阳,瑕吕,霞露,夏侯,鲜虞,鲜于,鲜阳,咸丘,相里,解枇,谢丘,新垣,辛垣,信都,信平,修鱼,徐吾,宣于,轩辕,轩丘,阏氏,延陵,罔法,铅陵,羊角,耶律,叶阳,伊祁,伊耆,猗卢,义渠,邑由,因孙,银齿,尹文,雍门,游水,由吾,右师,宥连,於陵,虞丘,盂丘,宇文,尉迟,乐羊,乐正,运奄,运期,宰父,辗迟,湛卢,章仇,仉督,长孙,长儿,真鄂,正令,执头,中央,中长,中行,中野,中英,中梁,中垒,钟离,钟吾,终黎,终葵,仲孙,仲长,周阳,周氏,周生,朱阳,诸葛,主父,颛孙,颛顼,訾辱,淄丘,子言,子人,子服子家,子桑,子叔,子车,子阳,宗伯,宗正,宗政,尊卢,昨和,左人,左丘,左师,左行,刘文,额尔,达力,蔡斯,浩赏,斛斯,夹谷,揭阳,万俟,淳于,单于,徐离\";','2010-07-29 16:43:04');
INSERT INTO ts_system_data VALUES ('15','0','register','__hash__','s:32:\"f81cb2f2175eaa0a59d1a48d2cd6dadb\";','2010-12-06 12:08:56');
INSERT INTO ts_system_data VALUES ('16','0','register','register_lastname','s:6643:\"艾,安,昂,敖,奥,巴,霸,白,柏,拜,班,包,保,葆,豹,鲍,暴,卑,贲,毕,闭,秘,边,鞭,彪,别,宾,邴,秉,薄,卜,布,部,才,蔡,仓,苍,操,曹,策,岑,柴,镡,昌,苌,常,昶,畅,唱,晁,巢,朝,车,陈,谌,成,承,晟,乘,程,池,迟,充,种,崇,丑,侴,初,储,楚,禇,揣,啜,春,椿,慈,次,从,丛,爨,崔,萃,寸,达,笪,大,代,戴,丹,但,啖,党,刀,德,邓,狄,翟,邸,底,弟,典,刁,丁,定,东,冬,董,豆,窦,都,堵,杜,度,端,段,敦,顿,多,朵,颚,恩,法,氾,樊,范,方,芳,防,房,费,丰,风,封,酆,冯,逢,凤,奉,俸,伏,扶,苻,服,符,福,付,傅,富,改,盖,干,甘,淦,冮,刚,皋,高,杲,郜,戈,革,合,格,盖,葛,庚,赓,耿,弓,公,宫,龚,巩,贡,勾,缑,苟,勾,辜,古,谷,固,顾,关,官,筦,管,观,贯,冠,光,广,归,妫,邽,炅,炔,贵,桂,滚,过,呙,郭,国,虢,果,哈,海,罕,撖,杭,郝,合,何,和,亻各,贺,赫,黑,亨,恒,衡,弘,闳,宏,鸿,侯,后,郈,厚,呼,轷,狐,胡,壶,虎,户,扈,花,华,滑,华,怀,槐,还,环,郇,桓,宦,皇,黄,回,惠,浑,火,霍,姬,嵇,稽,及,吉,汲,姞,戢,集,藉,籍,纪,计,季,暨,冀,加,家,嘉,郏,甲,贾,坚,菅,检,简,翦,蹇,见,监,江,将,姜,蒋,降,焦,矫,皎,敫,曒,教,接,揭,节,介,金,晋,烬,京,经,荆,井,景,敬,靖,静,酒,局,倶,琚,鞠,菊,巨,剧,隽,圈,角,开,凯,阚,康,亢,伉,柯,可,坑,孔,寇,库,蒯,郐,宽,匡,邝,旷,况,奎,隗,夔,腊,来,赖,兰,蓝,郎,劳,老,乐,雷,冷,离,黎,李,里,力,历,厉,立,励,利,郦,栗,连,廉,练,良,梁,聊,廖,列,林,临,吝,蔺,令,泠,凌,刘,留,柳,龙,隆,娄,楼,卢,庐,鲁,陆,逯,禄,路,闾,吕,律,栾,论,论,罗,洛,骆,雒,麻,马,买,麦,满,莽,毛,茆,茅,冒,枚,梅,门,蒙,孟,弥,祢,糜,米,芈,弭,宓,密,苗,缪,闵,敏,名,万,莫,墨,默,牟,母,木,沐,睦,慕,穆,那,纳,乃,佴,南,铙,倪,年,粘,念,乜,聂,宁,牛,钮,农,侬,区,欧,潘,盘,泮,庞,裴,彭,邳,皮,朴,品,平,繁,蒲,濮,浦,普,溥,柒,戚,漆,亓,齐,祁,歧,綦,乞,杞,启,千,钱,潜,强,乔,桥,谯,且,郄,钦,秦,琴,覃,勤,青,卿,清,庆,丘,邱,秋,仇,求,裘,曲,屈,麴,渠,璩,瞿,蘧,权,全,泉,阙,冉,饶,壬,任,戎,荣,容,茹,汝,阮,软,芮,瑞,洒,撒,萨,伞,桑,沙,山,闪,陕,单,善,商,赏,尚,少,召,邵,折,佘,厍,舍,申,莘,神,沈,生,绳,盛,师,施,石,时,史,士,世,是,奭,首,寿,殳,舒,疏,束,树,耍,帅,双,水,睡,顺,司,思,死,斯,四,佀,姒,松,宋,苏,宿,粟,眭,睢,隋,随,穗,孙,所,索,塔,台,邰,台,太,泰,谈,覃,谭,澹,檀,镡,汤,唐,棠,陶,腾,提,遆,题,帖,铁,通,仝,同,佟,彤,童,钭,徒,涂,屠,土,脱,完,宛,晚,万,汪,王,望,危,韦,维,蒍,隗,位,尉,温,文,闻,问,翁,瓮,邬,巫,毋,吾,吴,伍,仵,武,务,西,析,郗,息,奚,锡,习,席,袭,隰,舄,夏,先,鲜,咸,冼,洗,羡,线,相,香,襄,祥,向,相,项,肖,萧,孝,谢,渫,辛,忻,新,信,兴,星,刑,邢,行,幸,熊,修,须,顼,徐,许,旭,续,轩,禤,旋,薛,穴,雪,寻,郇,荀,押,牙,轧,鄢,燕,延,严,言,阎,颜,晏,扬,羊,阳,杨,仰,幺,要,尧,姚,铫,药,冶,业,叶,伊,衣,依,仪,宜,乙,蚁,扆,弋,义,亦,易,弈,益,裔,翼,阴,殷,银,尹,印,应,英,营,赢,灜,雍,勇,涌,幽,尤,由,游,於,欲,余,鱼,俞,馀,宇,禹,庾,玉,郁,遇,喻,裕,毓,渊,元,袁,原,圆,源,员,苑,院,乐,岳,悦,越,云,妘,郧,运,员,郓,恽,韵,载,昝,臧,迮,笮,曾,增,查,乍,翟,呰,祭,占,詹,瞻,展,战,湛,张,章,彰,仉,掌,招,召,兆,赵,肇,真,甄,镇,正,郑,政,支,执,直,植,志,郅,智,终,钟,衷,种,仲,周,朱,邾,诸,竹,竺,主,祝,专,庄,卓,禚,资,訾,子,紫,宗,邹,驺,俎,祖,左,韩,安陵,安平,安期,安阳,白马,百里,柏侯,鲍俎,北宫,北郭,北门,北山,北唐,奔水,逼阳,宾牟,薄奚薄野,曹牟,曹丘,常涛,长鱼,车非,成功,成阳,乘马,叱卢,丑门,樗里,穿封,淳子,答禄,达勃,达步,达奚,淡台,邓陵,第五,地连,地伦,东方,东里,东南,东宫,东门东乡,东丹,东郭,东陵,东关,东闾,东阳,东野,东莱,豆卢,斗于,都尉,独孤端木,段干,多子,尔朱,方雷丰将,封人,封父,夫蒙,夫馀,浮丘,傅余,干已,高车,高陵,高堂,高阳,高辛,皋落,哥舒,盖楼,庚桑,梗阳,宫孙,公羊,公良,公孙,公罔,公西,公冶,公敛,公梁,公输,公上,公山,公户,公玉,公仪,公仲公坚,公伯,公祖,公乘,公晰,公族,姑布,古口,古龙,古孙,谷梁,谷浑,瓜田,关龙,鲑阳,归海,函治,韩馀,罕井,浩生,浩星,纥骨,纥奚纥于,贺拨,贺兰,贺楼,赫连,黑齿,黑肱,侯冈,呼延,壶丘,呼衍,斛律,胡非,胡母,胡毋,皇甫,皇父,兀官吉白,即墨,季瓜,季连,季孙,茄众,蒋丘,金齿,晋楚,京城,泾阳,九百,九方,睢鸠,沮渠,巨母,勘阻,渴侯,渴单,可汗,空桐,空相,昆吾,老阳,乐羊,荔菲,栎阳,梁丘,梁由,梁馀,梁垣,陵阳伶舟,冷沦,令狐,刘王,柳下,龙丘,卢妃,卢蒲,鲁步,陆费,角里,闾丘,马矢,麦丘,茅夷,弥牟,密革,密茅,墨夷,墨台,万俊,昌顿,慕容,木门,木易,南宫,南郭,南门,南荣,欧侯,欧阳,逄门,盆成,彭祖,平陵,平宁,破丑,仆固,濮阳,漆雕,奇介,綦母,綦毋,綦连,祁连,乞伏,绮里,千代,千乘,勤宿,青阳,丘丽,丘陵,屈侯,屈突,屈男,屈卢,屈同,屈门,屈引,壤四,扰龙,容成,汝嫣,萨孤,三饭,三闾,三州,桑丘,商瞿,上官,尚方,少师,少施,少室,少叔,少正,社南社北,申屠,申徒,沈犹,胜屠,石作石牛,侍其,士季,士弱,士孙,士贞,叔孙,叔先,叔促,水丘,司城,司空,司寇,司鸿,司马,司徒,司士,似和,素和,夙沙,孙阳,索阳,索卢,沓卢,太史,太叔,太阳,澹台,唐山,堂溪,陶丘,同蹄,统奚,秃发,涂钦,吐火,吐贺,吐万,吐罗,吐门,吐难,吐缶,吐浑吐奚,吐和,屯浑,脱脱,拓拨,完颜,王孙,王官,王人,微生,尾勺,温孤,温稽,闻人,屋户,巫马,吾丘,无庸,无钩,五鹿,息夫,西陵,西乞,西钥,西乡,西门,西周,西郭,西方,西野,西宫,戏阳,瑕吕,霞露,夏侯,鲜虞,鲜于,鲜阳,咸丘,相里,解枇,谢丘,新垣,辛垣,信都,信平,修鱼,徐吾,宣于,轩辕,轩丘,阏氏,延陵,罔法,铅陵,羊角,耶律,叶阳,伊祁,伊耆,猗卢,义渠,邑由,因孙,银齿,尹文,雍门,游水,由吾,右师,宥连,於陵,虞丘,盂丘,宇文,尉迟,乐羊,乐正,运奄,运期,宰父,辗迟,湛卢,章仇,仉督,长孙,长儿,真鄂,正令,执头,中央,中长,中行,中野,中英,中梁,中垒,钟离,钟吾,终黎,终葵,仲孙,仲长,周阳,周氏,周生,朱阳,诸葛,主父,颛孙,颛顼,訾辱,淄丘,子言,子人,子服子家,子桑,子叔,子车,子阳,宗伯,宗正,宗政,尊卢,昨和,左人,左丘,左师,左行,刘文,额尔,达力,蔡斯,浩赏,斛斯,夹谷,揭阳,万俟,淳于,单于,徐离\";','2010-11-25 17:33:01');
INSERT INTO ts_system_data VALUES ('17','0','inviteset','invite_set','s:6:\"common\";','2010-12-06 12:08:56');
INSERT INTO ts_system_data VALUES ('153','0','siteopt','site_theme','s:7:\"classic\";','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('19','0','inviteset','__hash__','s:32:\"de6fa0dbb82ebd33d9d824d757332c1e\";','2010-11-26 11:51:05');
INSERT INTO ts_system_data VALUES ('20','0','default','default','15','2010-11-19 11:57:11');
INSERT INTO ts_system_data VALUES ('145','0','siteopt','site_closed_reason','s:0:\"\";','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('142','0','siteopt','site_header_keywords','s:37:\"知行网|高端商务社交平台\";','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('143','0','siteopt','site_header_description','s:69:\"知行网社交平台，是中国最大的高端商务社交平台\";','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('152','0','siteopt','site_icp','s:30:\"北京知行网有限公司\";','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('146','0','siteopt','site_anonymous','s:1:\"1\";','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('147','0','siteopt','site_anonymous_square','s:1:\"0\";','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('148','0','siteopt','site_anonymous_search','s:1:\"0\";','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('151','0','siteopt','site_appalias_wordwrap','s:1:\"1\";','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('29','0','attach','attach_path_rule','s:7:\"Y/md/H/\";','2010-11-29 17:41:15');
INSERT INTO ts_system_data VALUES ('30','0','attach','attach_max_size','d:2;','2010-11-29 17:41:15');
INSERT INTO ts_system_data VALUES ('31','0','attach','attach_allow_extension','s:59:\"jpg,gif,png,jpeg,bmp,zip,rar,doc,xls,ppt,docx,xlsx,pptx,pdf\";','2010-11-29 17:41:15');
INSERT INTO ts_system_data VALUES ('32','0','attach','__hash__','s:32:\"3d1ba92bca03cacb92bb32379f880356\";','2010-11-29 17:41:15');
INSERT INTO ts_system_data VALUES ('155','0','announcement','is_open','i:0;','2011-12-30 17:36:20');
INSERT INTO ts_system_data VALUES ('156','0','announcement','content','s:36:\"欢迎使用知行网社交平台\";','2011-12-30 17:36:20');
INSERT INTO ts_system_data VALUES ('150','0','siteopt','site_user_visited','s:1:\"1\";','2011-12-30 17:10:32');
INSERT INTO ts_system_data VALUES ('37','0','poster','version_number','s:5:\"15520\";','2011-12-23 16:21:03');
INSERT INTO ts_system_data VALUES ('38','0','photo','album_raws','s:1:\"6\";','2010-12-02 18:18:16');
INSERT INTO ts_system_data VALUES ('39','0','photo','photo_raws','s:1:\"8\";','2010-11-19 10:52:26');
INSERT INTO ts_system_data VALUES ('40','0','photo','photo_preview','s:1:\"1\";','2010-11-19 10:52:38');
INSERT INTO ts_system_data VALUES ('41','0','photo','photo_max_size','s:1:\"2\";','2010-11-19 10:52:56');
INSERT INTO ts_system_data VALUES ('42','0','photo','photo_file_ext','s:16:\"jpeg,gif,jpg,png\";','2010-11-19 10:53:05');
INSERT INTO ts_system_data VALUES ('43','0','photo','max_flash_upload_num','s:2:\"10\";','2010-11-19 10:53:27');
INSERT INTO ts_system_data VALUES ('120','0','photo','version_number','s:5:\"16095\";','2011-12-26 16:06:03');
INSERT INTO ts_system_data VALUES ('45','0','vote','limitpage','s:2:\"20\";','2010-12-03 13:11:32');
INSERT INTO ts_system_data VALUES ('46','0','vote','defaultTime','s:7:\"7776000\";','2010-12-02 18:18:16');
INSERT INTO ts_system_data VALUES ('47','0','vote','join','s:3:\"all\";','2010-12-02 18:18:16');
INSERT INTO ts_system_data VALUES ('121','0','vote','version_number','s:5:\"16095\";','2011-12-26 16:06:09');
INSERT INTO ts_system_data VALUES ('49','0','blog','allorder','year','2010-12-02 18:18:16');
INSERT INTO ts_system_data VALUES ('50','0','blog','savetime','5','2010-11-19 10:52:26');
INSERT INTO ts_system_data VALUES ('51','0','blog','smiletype','mini','2010-11-19 10:52:38');
INSERT INTO ts_system_data VALUES ('52','0','blog','leadingnum','100','2010-11-19 10:52:56');
INSERT INTO ts_system_data VALUES ('53','0','blog','leadingin','1','2010-11-19 10:53:05');
INSERT INTO ts_system_data VALUES ('54','0','blog','notifyfriend','1','2010-11-19 10:53:27');
INSERT INTO ts_system_data VALUES ('55','0','blog','fileaway','0','2010-12-03 16:26:02');
INSERT INTO ts_system_data VALUES ('56','0','blog','fileawaypage','6','2010-12-03 11:03:53');
INSERT INTO ts_system_data VALUES ('57','0','blog','all','1','2010-12-02 19:05:40');
INSERT INTO ts_system_data VALUES ('58','0','blog','delete','0','2010-12-02 19:05:40');
INSERT INTO ts_system_data VALUES ('59','0','blog','suffix','...','2010-11-19 10:54:58');
INSERT INTO ts_system_data VALUES ('60','0','blog','titleshort','200','2010-12-03 14:50:57');
INSERT INTO ts_system_data VALUES ('61','0','blog','limitpage','20','2010-12-03 13:11:32');
INSERT INTO ts_system_data VALUES ('122','0','blog','version_number','s:5:\"16095\";','2011-12-26 16:06:54');
INSERT INTO ts_system_data VALUES ('114','0','event','limitpage','s:2:\"10\";','2011-12-23 18:46:24');
INSERT INTO ts_system_data VALUES ('115','0','event','canCreate','s:1:\"1\";','2011-12-23 18:46:24');
INSERT INTO ts_system_data VALUES ('116','0','event','credit','s:1:\"0\";','2011-12-23 18:46:24');
INSERT INTO ts_system_data VALUES ('117','0','event','credit_type','s:5:\"score\";','2011-12-23 18:46:24');
INSERT INTO ts_system_data VALUES ('118','0','event','limittime','s:1:\"0\";','2011-12-23 18:46:24');
INSERT INTO ts_system_data VALUES ('68','0','event','version_number','s:5:\"15520\";','2011-12-23 16:21:30');
INSERT INTO ts_system_data VALUES ('69','0','gift','credit','s:5:\"score\";','2010-12-24 11:22:17');
INSERT INTO ts_system_data VALUES ('70','0','gift','version_number','s:5:\"16095\";','2011-12-23 16:21:34');
INSERT INTO ts_system_data VALUES ('71','0','group','close_invite','s:1:\"2\";','2011-06-28 11:46:49');
INSERT INTO ts_system_data VALUES ('72','0','group','createAudit','s:1:\"1\";','2011-06-28 11:46:47');
INSERT INTO ts_system_data VALUES ('73','0','group','createGroup','s:1:\"1\";','2011-06-28 11:46:47');
INSERT INTO ts_system_data VALUES ('74','0','group','createMaxGroup','s:1:\"3\";','2011-06-28 11:46:47');
INSERT INTO ts_system_data VALUES ('75','0','group','creditType','s:10:\"experience\";','2011-06-28 11:46:47');
INSERT INTO ts_system_data VALUES ('76','0','group','editSubmit','s:1:\"1\";','2011-06-28 11:46:49');
INSERT INTO ts_system_data VALUES ('77','0','group','hotTags','s:0:\"\";','2011-06-28 11:46:47');
INSERT INTO ts_system_data VALUES ('78','0','group','joinMaxGroup','s:2:\"10\";','2011-06-28 11:46:47');
INSERT INTO ts_system_data VALUES ('79','0','group','openBlog','s:1:\"1\";','2011-06-28 11:46:49');
INSERT INTO ts_system_data VALUES ('80','0','group','openUploadFile','s:1:\"1\";','2011-06-28 11:46:49');
INSERT INTO ts_system_data VALUES ('81','0','group','open_invite','s:1:\"0\";','2011-06-28 11:46:49');
INSERT INTO ts_system_data VALUES ('82','0','group','uploadFile','s:1:\"1\";','2011-06-28 11:46:47');
INSERT INTO ts_system_data VALUES ('83','0','group','simpleFileSize','s:1:\"2\";','2011-06-28 11:46:47');
INSERT INTO ts_system_data VALUES ('84','0','group','spaceSize','s:2:\"10\";','2011-06-28 11:46:47');
INSERT INTO ts_system_data VALUES ('85','0','group','uploadFileType','s:59:\"jpg|gif|png|jpeg|bmp|zip|rar|doc|xls|ppt|docx|xlsx|pptx|pdf\";','2011-06-28 11:46:47');
INSERT INTO ts_system_data VALUES ('86','0','group','userCredit','s:3:\"100\";','2011-06-28 11:46:47');
INSERT INTO ts_system_data VALUES ('87','0','group','whoDownloadFile','s:1:\"3\";','2011-06-28 11:46:49');
INSERT INTO ts_system_data VALUES ('88','0','group','whoUploadFile','s:1:\"3\";','2011-06-28 11:46:49');
INSERT INTO ts_system_data VALUES ('89','0','group','version_number','s:5:\"16095\";','2011-12-23 16:21:42');
INSERT INTO ts_system_data VALUES ('119','0','event','__hash__','s:32:\"dc7f7f7cd760d9814e814c5330c5a15a\";','2011-12-23 18:46:24');

DROP TABLE IF EXISTS ts_tag;
CREATE TABLE `ts_tag` (
  `tag_id` int(11) NOT NULL auto_increment,
  `tag_name` varchar(120) NOT NULL,
  PRIMARY KEY  (`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ts_tag VALUES ('1','跑车');
INSERT INTO ts_tag VALUES ('2','娱乐');
INSERT INTO ts_tag VALUES ('3','sadf');

DROP TABLE IF EXISTS ts_template;
CREATE TABLE `ts_template` (
  `tpl_id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) default NULL,
  `title` text,
  `body` text,
  `lang` varchar(255) NOT NULL default 'zh',
  `type` varchar(255) default NULL,
  `type2` varchar(255) default NULL,
  `is_cache` tinyint(1) NOT NULL default '1',
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`tpl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO ts_template VALUES ('1','invite_register','邀请注册','{actor_name}邀请您加入{site_name}','亲爱的{email}您好，\r\n{actor}邀请您加入{site}','zh','invite','','1','1282554257');
INSERT INTO ts_template VALUES ('2','poster_create_weibo','发布招贴','','我发起了一份招贴：【{title}】{url}','zh','poster','weibo','0','1290417734');
INSERT INTO ts_template VALUES ('3','poster_share_weibo','分享招贴','','分享@{author} 的招贴:【{title}】 {url}','zh','poster','weibo','0','1290595552');
INSERT INTO ts_template VALUES ('4','photo_create_weibo','发表图片','','我上传了{count}张新图片:【{title}】... {url}','zh','photo','weibo','0','1290417734');
INSERT INTO ts_template VALUES ('5','photo_share_weibo','分享图片','','分享@{author} 的图片:【{title}】{url}','zh','photo','weibo','0','1290595552');
INSERT INTO ts_template VALUES ('6','album_share_weibo','分享相册','',' 分享@{author} 的相册:【{title}】{url}','zh','album','weibo','0','1290595552');
INSERT INTO ts_template VALUES ('7','vote_create_weibo','发起投票','','我发起了一个投票:【{title}】 {url}','zh','vote','weibo','0','1290417734');
INSERT INTO ts_template VALUES ('8','vote_share_weibo','分享投票','','分享@{author} 的投票:【{title}】{url}','zh','vote','weibo','0','1290595552');
INSERT INTO ts_template VALUES ('9','blog_create_weibo','发表日志','','我发表了一篇日志:【{title}】 {url}','zh','blog','weibo','0','1290417734');
INSERT INTO ts_template VALUES ('10','blog_share_weibo','分享日志','','分享@{author} 的日志:【{title}】 {url}','zh','blog','weibo','0','1290595552');
INSERT INTO ts_template VALUES ('11','event_create_weibo','发起活动','','我发起了一个活动：【{title}】{url}','zh','event','weibo','0','1290417734');
INSERT INTO ts_template VALUES ('12','event_share_weibo','分享活动','','分享@{author} 的活动:【{title}】 {url}','zh','event','weibo','0','1290595552');
INSERT INTO ts_template VALUES ('13','gift_send_weibo','礼物赠送','','我送给{user} 一份礼物:【{title}】{content} 参与送礼{url}','zh','gift','weibo','0','1290417734');
INSERT INTO ts_template VALUES ('14','group_share_weibo','分享群组','','我在@{author} 的群组 【{name}】 里玩得很嗨， {url} 推荐大家也来看看哦~','zh','group','weibo','0','1307590430');
INSERT INTO ts_template VALUES ('15','group_post_share_weibo','分享帖子','','分享@{author} 的帖子:【{title}】 {url}','zh','group','weibo','0','1307415524');
INSERT INTO ts_template VALUES ('16','group_post_create_weibo','发布帖子','','我发起了一份帖子:【{title}】 {url}','zh','group','weibo','0','1307417128');

DROP TABLE IF EXISTS ts_template_record;
CREATE TABLE `ts_template_record` (
  `tpl_record_id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `tpl_name` varchar(255) NOT NULL default '',
  `tpl_alias` varchar(255) default NULL,
  `type` varchar(255) default NULL,
  `type2` varchar(255) default NULL,
  `data` text,
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`tpl_record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_ucenter_user_link;
CREATE TABLE `ts_ucenter_user_link` (
  `uid` int(11) NOT NULL,
  `uc_uid` mediumint(8) NOT NULL,
  `uc_username` char(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_user;
CREATE TABLE `ts_user` (
  `uid` int(11) NOT NULL auto_increment,
  `email` varchar(255) default NULL,
  `password` varchar(255) default NULL,
  `uname` varchar(255) default NULL,
  `sex` tinyint(1) NOT NULL default '0',
  `province` mediumint(6) NOT NULL default '0',
  `city` mediumint(6) NOT NULL default '0',
  `location` varchar(255) default NULL,
  `cellphone` varchar(12) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `company` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `indust_id` int(5) NOT NULL default '0',
  `admin_level` varchar(255) default '0',
  `commend` tinyint(1) default NULL,
  `is_active` tinyint(1) NOT NULL default '0',
  `is_init` tinyint(1) NOT NULL,
  `is_synchronizing` tinyint(1) NOT NULL default '0',
  `ctime` int(11) default NULL,
  `identity` tinyint(1) NOT NULL default '1',
  `score` int(11) NOT NULL default '0',
  `myop_menu_num` int(2) NOT NULL default '10',
  `api_key` varchar(255) default NULL,
  `domain` char(80) NOT NULL,
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `email` (`email`),
  KEY `location` (`location`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ts_user VALUES ('1','admin@admin.com','96e79218965eb72c92a549dd5a330112','管理员','0','0','0','','','','北京帕米信息','软件工程师','','0','1','','1','1','0','1324622963','1','0','10','','');
INSERT INTO ts_user VALUES ('2','lizhifeng@pamii.net','96e79218965eb72c92a549dd5a330112','lizhifeng','1','225','249','山西 阳泉市','','','北京帕米信息','总裁兼CEO','','0','0','','1','1','0','1324887554','1','0','10','','');
INSERT INTO ts_user VALUES ('3','kincardli@163.com','96e79218965eb72c92a549dd5a330112','bigapple','0','1','2','北京 北京市','','','','','','0','0','','1','1','0','1325327016','1','0','10','','');

DROP TABLE IF EXISTS ts_user_app;
CREATE TABLE `ts_user_app` (
  `user_app_id` int(11) unsigned NOT NULL auto_increment,
  `app_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `display_order` int(5) NOT NULL default '0',
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`user_app_id`),
  KEY `display_order` (`display_order`),
  KEY `app_id` (`app_id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_user_blacklist;
CREATE TABLE `ts_user_blacklist` (
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `ctime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_user_count;
CREATE TABLE `ts_user_count` (
  `uid` int(11) NOT NULL,
  `atme` mediumint(6) NOT NULL,
  `comment` mediumint(6) NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO ts_user_count VALUES ('2','0','0');

DROP TABLE IF EXISTS ts_user_group;
CREATE TABLE `ts_user_group` (
  `user_group_id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `ctime` int(11) default NULL,
  `icon` varchar(120) NOT NULL,
  PRIMARY KEY  (`user_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_user_group VALUES ('1','管理员','1291136345','v_05.gif');

DROP TABLE IF EXISTS ts_user_group_link;
CREATE TABLE `ts_user_group_link` (
  `user_gorup_link_id` int(11) NOT NULL auto_increment,
  `user_group_id` int(11) NOT NULL,
  `user_group_title` varchar(255) default NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY  (`user_gorup_link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_user_group_link VALUES ('1','1','管理员','1');

DROP TABLE IF EXISTS ts_user_group_popedom;
CREATE TABLE `ts_user_group_popedom` (
  `user_group_popedom_id` int(11) NOT NULL auto_increment,
  `user_group_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  PRIMARY KEY  (`user_group_popedom_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_user_group_popedom VALUES ('1','1','1');

DROP TABLE IF EXISTS ts_user_medal;
CREATE TABLE `ts_user_medal` (
  `user_medal_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `medal_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  `data` text,
  PRIMARY KEY  (`user_medal_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_user_online;
CREATE TABLE `ts_user_online` (
  `uid` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO ts_user_online VALUES ('1','1326094148');
INSERT INTO ts_user_online VALUES ('2','1325230430');
INSERT INTO ts_user_online VALUES ('3','1325328920');

DROP TABLE IF EXISTS ts_user_privacy;
CREATE TABLE `ts_user_privacy` (
  `uid` int(11) NOT NULL,
  `key` varchar(120) NOT NULL,
  `value` varchar(120) NOT NULL,
  UNIQUE KEY `key` (`key`),
  UNIQUE KEY `key_2` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_user_profile;
CREATE TABLE `ts_user_profile` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `module` varchar(150) NOT NULL,
  `data` longtext,
  `type` varchar(60) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO ts_user_profile VALUES ('1','1','career','a:4:{s:7:\"company\";s:9:\"的风格\";s:8:\"position\";s:18:\"的风格的风格\";s:9:\"begintime\";s:6:\"2011-1\";s:7:\"endtime\";s:6:\"2011-1\";}','list');
INSERT INTO ts_user_profile VALUES ('2','1','education','a:3:{s:6:\"school\";s:13:\" 的水电费\";s:7:\"classes\";s:18:\"的爽肤水地方\";s:4:\"year\";s:4:\"1986\";}','list');
INSERT INTO ts_user_profile VALUES ('3','2','education','a:3:{s:6:\"school\";s:12:\"湖南大学\";s:7:\"classes\";s:9:\"计算机\";s:4:\"year\";s:4:\"1986\";}','list');
INSERT INTO ts_user_profile VALUES ('4','2','career','a:4:{s:7:\"company\";s:12:\"帕米信息\";s:8:\"position\";s:9:\"技术部\";s:9:\"begintime\";s:6:\"2011-1\";s:7:\"endtime\";s:6:\"2011-1\";}','list');
INSERT INTO ts_user_profile VALUES ('5','2','career','a:4:{s:7:\"company\";s:18:\"上的防守打法\";s:8:\"position\";s:9:\"撒地方\";s:9:\"begintime\";s:6:\"2011-1\";s:7:\"endtime\";s:6:\"2011-1\";}','list');

DROP TABLE IF EXISTS ts_user_set;
CREATE TABLE `ts_user_set` (
  `id` int(11) NOT NULL auto_increment,
  `fieldkey` varchar(120) NOT NULL,
  `fieldname` varchar(120) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `module` varchar(60) NOT NULL,
  `showspace` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO ts_user_set VALUES ('3','name','名字','1','intro','1');
INSERT INTO ts_user_set VALUES ('4','summary','我的简介','1','intro','0');
INSERT INTO ts_user_set VALUES ('5','nearestwish','最近心愿','1','intro','0');
INSERT INTO ts_user_set VALUES ('6','motto','座右铭','1','intro','0');
INSERT INTO ts_user_set VALUES ('7','idol','偶像','1','intro','0');
INSERT INTO ts_user_set VALUES ('8','favbook','喜欢的书','1','intro','0');
INSERT INTO ts_user_set VALUES ('9','interest','兴趣爱好','1','intro','0');
INSERT INTO ts_user_set VALUES ('10','address','地址','1','contact','0');
INSERT INTO ts_user_set VALUES ('11','postcode','邮编','1','contact','0');
INSERT INTO ts_user_set VALUES ('12','telphone','电话','1','contact','0');
INSERT INTO ts_user_set VALUES ('13','mobile','手机','1','contact','0');
INSERT INTO ts_user_set VALUES ('14','qq','QQ','1','contact','0');
INSERT INTO ts_user_set VALUES ('15','msn','MSN','1','contact','0');
INSERT INTO ts_user_set VALUES ('16','blood','血型','1','intro','0');

DROP TABLE IF EXISTS ts_user_tag;
CREATE TABLE `ts_user_tag` (
  `user_tag_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY  (`user_tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_user_verified;
CREATE TABLE `ts_user_verified` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL,
  `realname` varchar(50) character set utf8 collate utf8_unicode_ci default NULL,
  `phone` varchar(20) character set utf8 collate utf8_unicode_ci default NULL,
  `reason` varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  `info` varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  `verified` enum('0','1') character set utf8 collate utf8_unicode_ci NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_user_visited;
CREATE TABLE `ts_user_visited` (
  `visited_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `ctime` int(11) NOT NULL default '0',
  PRIMARY KEY  (`visited_id`),
  UNIQUE KEY `uid_2` (`uid`,`fid`),
  KEY `uid` (`uid`),
  KEY `fid` (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO ts_user_visited VALUES ('1','2','1','232133');
INSERT INTO ts_user_visited VALUES ('2','1','1','231232');
INSERT INTO ts_user_visited VALUES ('3','1','2','1325294970');
INSERT INTO ts_user_visited VALUES ('4','3','1','1325327786');
INSERT INTO ts_user_visited VALUES ('5','1','3','1326088986');

DROP TABLE IF EXISTS ts_validation;
CREATE TABLE `ts_validation` (
  `validation_id` int(11) unsigned NOT NULL auto_increment,
  `type` varchar(255) default NULL,
  `from_uid` int(11) NOT NULL default '0',
  `to_user` varchar(255) NOT NULL default '0',
  `data` text,
  `code` varchar(120) NOT NULL default '0',
  `target_url` varchar(255) default NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`validation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_vote;
CREATE TABLE `ts_vote` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `title` text NOT NULL,
  `explain` text NOT NULL,
  `type` tinyint(4) NOT NULL,
  `glimit` tinyint(4) NOT NULL default '0',
  `deadline` int(11) NOT NULL,
  `onlyfriend` tinyint(4) NOT NULL,
  `cTime` int(11) NOT NULL,
  `isHot` varchar(1) NOT NULL,
  `rTime` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `vote_num` int(11) NOT NULL default '0',
  `commentCount` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ts_vote VALUES ('1','1','你喜欢白天还是黑夜？','','0','0','1332410400','0','1324636413','','0','','1','1');

DROP TABLE IF EXISTS ts_vote_opt;
CREATE TABLE `ts_vote_opt` (
  `id` int(11) NOT NULL auto_increment,
  `vote_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `num` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ts_vote_opt VALUES ('1','1','白天','1');
INSERT INTO ts_vote_opt VALUES ('2','1','黑夜','0');
INSERT INTO ts_vote_opt VALUES ('3','1','都不喜欢','0');

DROP TABLE IF EXISTS ts_vote_user;
CREATE TABLE `ts_vote_user` (
  `id` int(11) NOT NULL auto_increment,
  `vote_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `opts` text NOT NULL,
  `cTime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO ts_vote_user VALUES ('1','1','1','','1324636413');
INSERT INTO ts_vote_user VALUES ('2','1','1','白天','1324636417');

DROP TABLE IF EXISTS ts_weibo;
CREATE TABLE `ts_weibo` (
  `weibo_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `content` text NOT NULL,
  `ctime` int(11) NOT NULL,
  `from` tinyint(1) NOT NULL,
  `comment` mediumint(8) NOT NULL,
  `transpond_id` int(11) NOT NULL default '0',
  `transpond` mediumint(8) NOT NULL,
  `type` varchar(255) default '0',
  `type_data` text,
  `from_data` text,
  `isdel` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`weibo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO ts_weibo VALUES ('1','1','xvzxcvzxcv','1324629746','0','0','0','0','0','','','0');
INSERT INTO ts_weibo VALUES ('2','1','欢迎光临 测试群组哈...','1324631462','0','0','0','0','0','','a:4:{s:8:\"app_type\";s:9:\"local_app\";s:8:\"app_name\";s:5:\"group\";s:5:\"title\";s:15:\"测试群组...\";s:3:\"url\";s:71:\"http://192.168.243.101/ts/index.php?app=group&mod=Group&act=index&gid=1\";}','0');
INSERT INTO ts_weibo VALUES ('3','1','我上传了2张新图片:【1088_91647275_repaste】... http://goo.gl/nkMGR ','1324637433','0','0','0','0','1','a:3:{s:8:\"thumburl\";s:51:\"miniblog/c492487a9d8a756ae9f591dc4d01465d_small.jpg\";s:14:\"thumbmiddleurl\";s:52:\"miniblog/c492487a9d8a756ae9f591dc4d01465d_middle.jpg\";s:6:\"picurl\";s:45:\"miniblog/c492487a9d8a756ae9f591dc4d01465d.jpg\";}','','0');
INSERT INTO ts_weibo VALUES ('4','1','阿斯顿发生的飞洒的发生地方','1324869956','0','0','0','0','0','','','0');
INSERT INTO ts_weibo VALUES ('5','1','我发表了一篇日志:【瞧瞧切切切切切切切切切轻轻巧巧】 http://goo.gl/C13oY ','1324886557','0','0','0','0','0','','','0');
INSERT INTO ts_weibo VALUES ('6','2','haoha','1324887580','0','0','0','3','0','','','0');
INSERT INTO ts_weibo VALUES ('7','1','dsdasdsd','1324977971','0','0','6','0','0','','','0');
INSERT INTO ts_weibo VALUES ('8','1','//@管理员:dsdasdsdasdasdasdasd','1324977980','0','0','6','0','0','','','0');
INSERT INTO ts_weibo VALUES ('9','1','asdasdasdasdasd//@管理员://@管理员:dsdasdsdasdasdasdasd','1324977990','0','0','6','0','0','','','0');

DROP TABLE IF EXISTS ts_weibo_atme;
CREATE TABLE `ts_weibo_atme` (
  `uid` int(11) NOT NULL,
  `weibo_id` int(11) NOT NULL,
  UNIQUE KEY `uid` (`uid`,`weibo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO ts_weibo_atme VALUES ('1','8');
INSERT INTO ts_weibo_atme VALUES ('1','9');
INSERT INTO ts_weibo_atme VALUES ('2','7');
INSERT INTO ts_weibo_atme VALUES ('2','8');
INSERT INTO ts_weibo_atme VALUES ('2','9');

DROP TABLE IF EXISTS ts_weibo_comment;
CREATE TABLE `ts_weibo_comment` (
  `comment_id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `reply_comment_id` int(11) NOT NULL,
  `reply_uid` int(11) NOT NULL,
  `weibo_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `ctime` int(11) NOT NULL,
  `isdel` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_weibo_favorite;
CREATE TABLE `ts_weibo_favorite` (
  `uid` int(11) NOT NULL,
  `weibo_id` int(11) NOT NULL,
  PRIMARY KEY  (`uid`,`weibo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_weibo_plugin;
CREATE TABLE `ts_weibo_plugin` (
  `plugin_id` int(11) NOT NULL auto_increment,
  `plugin_name` varchar(120) NOT NULL,
  `icon_pic` varchar(120) NOT NULL,
  `plugin_path` varchar(255) NOT NULL,
  PRIMARY KEY  (`plugin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO ts_weibo_plugin VALUES ('1','图片','','image');
INSERT INTO ts_weibo_plugin VALUES ('3','视频','','video');
INSERT INTO ts_weibo_plugin VALUES ('4','音乐','','music');

DROP TABLE IF EXISTS ts_weibo_star;
CREATE TABLE `ts_weibo_star` (
  `star_id` int(11) NOT NULL auto_increment,
  `star_group_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`star_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_weibo_star_group;
CREATE TABLE `ts_weibo_star_group` (
  `star_group_id` int(11) NOT NULL auto_increment,
  `top_group_id` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL default '0',
  `ctime` int(11) default NULL,
  PRIMARY KEY  (`star_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ts_weibo_topic;
CREATE TABLE `ts_weibo_topic` (
  `topic_id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(150) NOT NULL,
  `count` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  PRIMARY KEY  (`topic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO ts_weibo_topic VALUES ('1','日志','0','1324973296');
INSERT INTO ts_weibo_topic VALUES ('2','管理员','0','1324973302');
INSERT INTO ts_weibo_topic VALUES ('3','帕米信息','0','1324973460');

DROP TABLE IF EXISTS ts_weibo_topics;
CREATE TABLE `ts_weibo_topics` (
  `topics_id` int(11) unsigned NOT NULL auto_increment,
  `topic_id` int(11) unsigned NOT NULL,
  `domain` varchar(100) character set utf8 collate utf8_unicode_ci default NULL,
  `pic` varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  `link` varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  `note` varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  `content` text character set utf8 collate utf8_unicode_ci,
  `recommend` enum('1','0') character set utf8 collate utf8_unicode_ci NOT NULL default '0',
  `ctime` int(11) default NULL,
  `isdel` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`topics_id`),
  UNIQUE KEY `page` (`domain`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



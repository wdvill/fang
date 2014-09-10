fang
====

fang

数据库文件在  data/database 目录下



09-10 更新db

INSERT INTO `acy_fang`.`zx_node` (`node_id`, `app_name`, `app_alias`, `mod_name`, `mod_alias`, `act_name`, `act_alias`, `parent_node_id`, `description`) VALUES (NULL, 'admin', '编辑', 'User', '用户', 'profile', '个人信息', '', '在“权限管理”中将本节点赋予某个用户组，它就能访问管理后台了');

INSERT INTO `acy_fang`.`zx_node` (`node_id`, `app_name`, `app_alias`, `mod_name`, `mod_alias`, `act_name`, `act_alias`, `parent_node_id`, `description`) VALUES (NULL, 'admin', '编辑', 'User', '用户', 'doProfile', '修改个人信息', '', '在“权限管理”中将本节点赋予某个用户组，它就能访问管理后台了');

INSERT INTO `acy_fang`.`zx_user_group_popedom` (`user_group_popedom_id`, `user_group_id`, `node_id`) VALUES (NULL, '23', '15'), (NULL, '23', '16');

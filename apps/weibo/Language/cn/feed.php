<?php 
return  array(
	'weibo_follow'   => array(
		'title' => '<div class="rtit3 mb5"><h1>  关注了  <label><a href="'.U('home/space/index',array('uid'=>$fid)).'" target="_blank">'.getUserName($fid).'</a></label>  </h1></div><div class="cl"></div><div class="p3 rtit3_1 mb10 border5 hei20"><p class="l wid20">'.friendlyDate($i_data['ctime']).'</p></div><div class="cl"></div>',
	),
);
?>


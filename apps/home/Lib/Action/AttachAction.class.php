<?php
//附件管理
class AttachAction extends Action{

	public function _initialize() {
		if(!$this->mid){
			echo "-1";	//没有权限，需要登陆后上传
		}
	}

	//我的附件列表
	public function download(){
		$aid	=	intval($_REQUEST['id']);
		$uid	=	intval($_REQUEST['uid']);
		$attach	=	model('Xattach')->where("id='$aid' AND uid='$uid'")->find();
		//$attach	=	model('Xattach')->where("id='$aid'")->find();
		
		if(!$attach){
			$this->error('附件不存在或已被删除！');
		}
		//下载函数
		//import("ORG.Net.Http");             //调用下载类
		require_cache('./addons/libs/Think/Http.class.php');
		if(file_exists(UPLOAD_PATH.'/'.$attach['savepath'].$attach['savename'])) {
			//增加下载次数
			model('Xattach')->setInc('totaldowns',"id='$aid'");    
			//输出文件
			$filename	=	$attach['name'];
			$filename	=	auto_charset($filename,"UTF-8",'GBK');
			//$filename	=	'attach_'.$attach['id'].'.'.$attach['extension'];
			Http::download(UPLOAD_PATH.'/'.$attach['savepath'].$attach['savename'],$filename);
		}else{
			$this->error('附件不存在或已被删除！');
		}
	}
	
	//ewebeditor控件上传
	public function ewebeditor(){

		//执行附件上传操作
		$attach_type	=	'ewebeditor';

		$options['uid']			=	$this->mid;
		$options['allow_exts']	=	'jpg,jpeg,bmp,png,gif';
		$info	=	X('Xattach')->upload($attach_type,$options);

		if(is_array($info['info'])){
			$image_url	=	SITE_URL.'/data/uploads/'.$info['info'][0]['savepath'].$info['info'][0]['savename'];
		}

		//上传成功
		if($info['status']==true){
			echo $image_url;
		}
	}

	//kissy编辑器上传
	public function kissy(){

		//执行附件上传操作
		$attach_type	=	'kissy';

		$options['uid']			=	$this->mid;
		$options['allow_exts']	=	'jpg,jpeg,bmp,png,gif';
		$info	=	X('Xattach')->upload($attach_type,$options);

		if(is_array($info['info'])){
			$image_url	=	SITE_URL.'/data/uploads/'.$info['info'][0]['savepath'].$info['info'][0]['savename'];
		}

		//上传成功
		if($info['status']==true){
			echo '{"status": "0", "imgUrl": "' .$image_url. '"}';
		}else{
			echo '{"status": "1", "error": "'.$info['info'].'"}';
		}
	}

	//截图上传
	public function capture(){
		
		error_reporting(0);

		//解析上传方式
		$query_string	=	t($_SERVER['QUERY_STRING']);
		parse_str($query_string,$query_data);

		$log_file	=	time().'_'.rand(0,1000).'.txt';

		$log_path	=	RUNTIME_PATH.'/logs/'.date('Y/md/H/');

		if(!is_dir($log_path))
			mkdir($log_path,0777,true);

		$file_path	=	'./data/uploads/'.date('Y/md/H/');

		if(!is_dir($file_path))
			mkdir($file_path,0777,true);

		file_put_contents($log_path.$log_file,var_export($query_data,true));

		//按钮截图：FileType=img 
		if($query_data['FileType']=='img'){
			$file_name	=	'capture_'.time().'.jpg';
		}

		//附件上传：FileType=Attachment & FileName=xxx.jpg
		if($query_data['FileType']=='Attachment'){
			$file_name	=	$query_data['FileName'];
		}

		//处理数据流
		if ($stream = fopen('php://input', 'r')) {
			// print all the page starting at the offset 10
			// echo stream_get_contents($stream, -1, 10);
			$content	=	stream_get_contents($stream);
			file_put_contents($file_path.$file_name,$content);
			fclose($stream);
		}

		//include 'UploadFile.class.php';

		//$up	=	new UploadFile();
		//$up->upload('./uploads/');
		//$info	=	$up->getUploadFileInfo();

		//echo "<pre>";
		//var_dump($_SERVER);
		//var_dump($info);
		//echo "</pre>";

		//输出文件
		echo SITE_URL.ltrim($file_path.$file_name,'.');
	}

	//上传附件
	public function ajaxUpload(){

		//执行附件上传操作

		$attach_type	=	t($_REQUEST['type']);

		$options['uid']			=	$this->mid;
		//加密了这个字段
		$options['allow_exts']	=	jiemi(t($_REQUEST['token']));
		$options['limit']       =   intval($_REQUEST['limit']);
		$options['now_pageCount'] = intval($_REQUEST['now_pageCount']);
		$info	=	X('Xattach')->upload($attach_type,$options);
		if($info['status']==true){
			unset($info['info']['savename']);
			unset($info['info']['savepath']);
			unset($info['info']['hash']);
			unset($info['info']['attach_type']);
		}
		//上传成功
		echo json_encode($info);
	}

	// 图片截取
	public function thumbImage() {

		// 过滤成本地图片地址
		$src_arr	=	explode("?",$_POST['bigImage']);
        $src		=	$src_arr[0];
		$src		=	str_ireplace(SITE_URL,'.','http://'.$_SERVER['HTTP_HOST'].$src);

		// 获取源图的扩展名宽高
		list($sr_w, $sr_h, $sr_type, $sr_attr) = @getimagesize($src);
		if($sr_type){
			//获取后缀名
			$ext = image_type_to_extension($sr_type,false);
		} else {
			echo "-1";
		}
		
		// 获取相关数据
		$txt_left	=	(float) $_POST['txt_left'];
		$txt_top	=	(float) $_POST['txt_top'];
		$txt_width	=	(float) $_POST['txt_width'];
		$txt_height	=	(float) $_POST['txt_height'];
		$zoom		=	(float) $_POST['txt_Zoom'];

		// 头像大方快的宽高
		$targ_w		=	120;
		$targ_h		=	120;

		// 头像小方块的宽高
		$small_w	=	45;
		$small_h	=	45;

		// 生成头像目录
        $face_path  =	SITE_PATH.'/data/userface/'.$this->mid;
		$face_url	=	SITE_URL.'/data/userface/'.$this->mid;
		if(!file_exists($face_path)){
			mkdir($face_path,0777,true);
			chmod($face_path,0777);
		}
		// 生成头像名称
        $middle_name	=	$face_path.'/middle_face.jpg';		// 中图
		$small_name		=	$face_path.'/small_face.jpg';		// 小图

		// 生成原图拷贝
		$func	=	($ext != 'jpg')?'imagecreatefrom'.$ext:'imagecreatefromjpeg';
		$img_r	=	call_user_func($func,$src);

		//计算原图截图坐标，以源图左上角为坐标原点
		$dx1	=	$txt_left;
		$dy1	=	$txt_top;
		$dx2	=	$dx1+$targ_w;
		$dy2	=	$dy1+$targ_h;

		$sx1	=	0;
		$sy1	=	0;
		$sx2	=	$txt_width;
		$sy2	=	$txt_height;

		//计算拷贝区域坐标，以源图左上角为坐标原点
		$smx1	=	$dx1>$sx1 ? $dx1 : $sx1;
		$smy1	=	$dy1>$sy1 ? $dy1 : $sy1;
		$smx2	=	$dx2>$sx2 ? $sx2 : $dx2;
		$smy2	=	$dy2>$sy2 ? $sy2 : $dy2;

		$src_x	=	$smx1/$zoom;
		$src_y	=	$smy1/$zoom;

		$src_w	=	($smx2-$smx1)/$zoom;
		$src_h	=	($smy2-$smy1)/$zoom;
		
		//计算拷贝区域坐标，以目标图左上角为坐标原点，坐标原点平移到 $dx1,$dy1
		$dst_x	=	$smx1-$dx1;
		$dst_y	=	$smy1-$dy1;

		$dst_w	=	$smx2-$smx1;
		$dst_h	=	$smy2-$smy1;
		
		//dump($smx1.','.$smy1.','.$smx2.','.$smy2.','.$src_w.','.$src_h.'|'.$dmx1.','.$dmy1.','.$dmx2.','.$dmy2.','.$dst_w.','.$dst_h);

		// 开始切割大方块头像
		$dst_r	=	ImageCreateTrueColor( $targ_w, $targ_h );
		$back	=	ImageColorAllocate( $dst_r, 255, 255, 255 );
		ImageFilledRectangle( $dst_r, 0, 0, $targ_w, $targ_h, $back );
		ImageCopyResampled( $dst_r, $img_r, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h );
	
		ImagePNG($dst_r,$middle_name);  // 生成中图
		chmod($middle_name,0777);

		// 开始切割大方块头像成小方块头像
		$sdst_r	=	ImageCreateTrueColor( $small_w, $small_h );
		ImageCopyResampled( $sdst_r, $dst_r, 0, 0, 0, 0, $small_w, $small_h, $targ_w, $targ_h );

		ImagePNG($sdst_r,$small_name);  // 生成小图
		chmod($small_name,0777);

		ImageDestroy($dst_r);
		ImageDestroy($sdst_r);
		ImageDestroy($img_r);
		
		$output	=	array( 'big' => $face_url.'/middle_face.jpg', 'small' => $face_url.'/small_face.jpg' );

		echo json_encode($output);
	}

	//删除附件
	public function deleteAttach($aid,$uid){
		$map['uid']	=	$uid;
		$map['id']	=	$id;

		//执行附件删除操作
		$result	=	model('Xattach')->where($map)->limit(1)->delete();
		//上传成功
		echo $result;
	}
}
?>
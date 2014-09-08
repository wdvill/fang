<?php
/**
 * 电话模型
 * 
 */
class PhoneModel extends Model {
	protected $tableName = '';
	
	//判断手机号码是否已经验证
	function isCheckPhone($uid){
		$res = M("user")->where("uid={$uid}")->field("cellphone")->find();
		
		if(is_numeric($res['cellphone'])){
			return true;
		}else{
			return false;
		}
	}
	
	//判断手机号码是否已经验证
	function check($uid){
		$res = M("user")->where("uid={$uid}")->field("cellphone")->find();
		
		if(is_numeric($res['cellphone'])){
			return true;
		}else{
			return false;
		}
	}
	
	//判断手机号码是否已经被使用
	function isPhoneUsed($uid,$phone){
		$res = M("user")->where("uid!={$uid} AND cellphone='".$phone."'")->count();
		
		if($res > 0){
			return true;
		}else{
			return false;
		}
	}
	
	//发送手机验证码
	function sendPhoneVerify($phone){
		if(!$this->checkPhoneNumber($phone)){
			return -2;
		}
		
		if($phone == $_SESSION['pverify_phone']){
			if( intval(time()-$_SESSION['pverify_time']) <= 300 ){
				return -1;
			}
			if(intval(time()-$_SESSION['pverify_time']) < 600){
				return -3;
			}
		}
		
		//发送验证码
		$verify = $this->createPhoneVerify();
		//短信内容
		$content = "您的验证码是：".$verify."。感谢您关注知行网。";
		$getdata = $this->sendPhoneMessage($phone,$content);
		if($getdata){
			$_SESSION['pverify_time'] = time();
			$_SESSION['pverify_num'] = $verify;
			$_SESSION['pverify_phone'] = $phone;
			return 1;
		}else{
			return 0;
		}
	}
	
	function savePhone($uid,$phone,$phoneverify){
		if(!intval($phone) || !intval($phoneverify)) return ;
		//判断手机和密码是否合法
		if( intval(time()-$_SESSION['pverify_time'])>600 || $phone != $_SESSION['pverify_phone'] || $phoneverify != $_SESSION['pverify_num'] ){
			return -1;
		}
		
		if(M("user")->setField("cellphone",$phone,"uid={$uid}")){
			unset($_SESSION['pverify_time']);
			unset($_SESSION['pverify_num']);
			unset($_SESSION['pverify_phone']);
			return 1;
		}else{
			return -2;
		}
	}
	
	//验证手机号码是否合法
	function checkPhoneNumber($phone){
		$check = preg_match("/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",$phone);
		if($check){
			return true;
		}else{
			return false;
		}
	}
	
	//生成手机验证码
	function createPhoneVerify(){
		$num = mt_rand(1000000,9999999);
		return $num;		
	}
	
	//发送手机短信
	function sendPhoneMessage($phone,$content){
		if(!$phone || empty($content)) return 0;
		$url = "http://admin.golds365.com:20004/shttp.recmt?ua=pamii&pw=123456&mobile=".$phone."&msg=".@iconv("utf-8","gb2312",$content);
		$getdatas = curls($url);
		//获取发送状态
		$statuslen1 = strpos($getdatas,"<Result>");
		$statuslen2 = strpos($getdatas,"</Result>");
		$status = substr($getdatas,$statuslen1+8,$statuslen2);
		
		return $status;
	}
}
?>
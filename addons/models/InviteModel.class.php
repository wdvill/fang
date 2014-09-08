<?php
/**
 * 邀请模型
 * 
 * @author nonant
 */
class InviteModel extends Model{
	var $tableName = 'invitecode';

	/**
	 * 获未邻取的邀请码数量
	 * 
	 * @param int $uid 用户ID
	 * @return int
	 */
	function getReceiveCount( $uid ){
		return $this->where("uid=$uid AND is_received=0 AND is_used=0")->count();
	}

	/**
	 * 领取邀请码，将未邻取的邀请码标记为已领取
	 * 
	 * @param int $uid 用户ID
	 * @return boolean
	 */
	function getReceiveCode( $uid ){
		return $this->setField('is_received',1,"uid=$uid AND is_received=0 AND is_used=0");
	}

	/**
	 * 获取邀请码列表
	 * 
     * @param int $uid 用户ID
     * @return array
	 */
	function getInviteCode($uid,$email=''){
		$res = $this->where("uid={$uid}")->field("code")->find();
		if(!$res){
			$res['code'] = sendinvite($uid);
		}
		if($email){
			$code = base64_encode($email.'/'.$res['code']);
		}else{
			$code = base64_encode($res['code']);
		}
		
		return $code;
	}

	/**
	 * 生成邀请码
	 * 
     * @param int $uid 用户ID
	 * @param int $num 邀请码数量
	 * @return boolean
	 */
   function sendcode($uid,$num){
   		if(!$uid) return '';
		for ($i=1;$i<=$num;$i++){
			$invitecode = md5($uid.time()."^@*&@*HF*@&#&@*(*@#".$i);
			$code[] = "($uid,'$invitecode',0)";
		}
		if($code){
			$this->query("INSERT INTO ".C('DB_PREFIX')."invitecode (uid,code,is_used) VALUES ".implode(',',$code));
		}
			//$sql = "INSERT INTO ".C('DB_PREFIX')."invitecode "
	}

	/**
	 * 返回邀请设置
	 * 
	 * @return array invite_set三种状态:close-关闭邀请,invitecode-使用邀请码,common-普通邀请
	 */
	function getSet(){
		$inviteset = model('Xdata')->lget('inviteset');
		$data['invite_set'] = ($inviteset['invite_set']) ? $inviteset['invite_set'] : 'common';
		return $data;
	}

	/**
	 * 获取邀请码信息(验证邀请码是否存在)
	 * 
	 * @param string $invitecode 邀请码
	 * @return array
	 */
	function checkInviteCode($invitecode){
		$invitecode = base64_decode($invitecode);
		$code_arr = explode('/',$invitecode);
		if($code_arr[0] && isValidEmail($code_arr[0]) && count($code_arr)==2){
			if($inviteinfo = $this->where("code='".$code_arr[1]."'")->find()){
				$user = M("user")->where("email='".$code_arr[0]."'")->field("uid,uname,password,email")->find();
				if($user){
					if(empty($user['password'])){
						$inviteinfo['email'] = $user['email'];
						$inviteinfo['uname'] = $user['uname'];
						$inviteinfo['invite_uid'] = $user['uid'];
						return $inviteinfo;
					}else{
						return $inviteinfo;
					}
				}else{
					return $inviteinfo;
				}
			}
		}else{
			if($inviteinfo = $this->where("code='".$invitecode."'")->find()){
				return $inviteinfo;
			}
		}
	}
	
	//获取邀请链接
	function getInviteUrl($uid,$code){
		if(!$code){
			$code = $this->getInviteCode($uid);
		}
		return SITE_URL."/?invite=".$code;
	}
	
	/**
	 * 设置邀请码失效,即设置为已使用
	 * 
	 * @param string $invitecode 邀请码
	 * @return boolean
	 */
	function setInviteCodeUsed($invitecode){
		return $this->setField('is_used',1,"code='{$invitecode}'");
	}
	
	//发送邮件快速邀请好友
	function sendInviteEmail($uid,$email){
		if(!$uid || !$email) return ;
		if(!isValidEmail($email)){
			return -1;
		}
		if(M('user')->where("email='".$email."'")->find()){
			return -2;
		}
		//发送邮件邀请
		$body = $this->getInviteTpl($uid,$post['invite'],$email);
		$email_sent = service('Mail')->send_email($email, getUserName($uid)."邀请您加入知行网",$body);
		if($email_sent){
			return 1;
		}
	}
	
	//获取默认邀请函内容
	function getInviteTpl($uid,$content,$email){
		if(empty($content)){
			$content = "快来加入我们吧。";
		}
		//获取邀请链接
		$code = $this->getInviteCode($uid,$email);
		$invite_url = SITE_URL."/?invite=".$code;
		
		$content_tpl = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>知行网好友邀请</title>
		</head>
		<body>
		<table style="BORDER-BOTTOM: rgb(230,230,230) 4px solid; TEXT-ALIGN: left; BORDER-LEFT: rgb(230,230,230) 4px solid; LINE-HEIGHT: 1.4; FONT-FAMILY: Arial, Helvetica, sans-serif; BACKGROUND: rgb(255,255,255); COLOR: rgb(45,45,45); FONT-SIZE: 12px; BORDER-TOP: rgb(230,230,230) 4px solid; BORDER-RIGHT: rgb(230,230,230) 4px solid" border="0" cellspacing="0" cellpadding="5" width="700" align="center">
		  <tbody>
			<tr>
			  <td valign="top">
				<table style="BORDER-BOTTOM: rgb(163,194,224) 3px solid" border="0" cellspacing="0" cellpadding="5" width="100%">
				  <tbody>
					<tr>
					  <td align="left">
						&nbsp;&nbsp;您好！
					  </td>
					  <td height="50"> </td>
					</tr>
				  </tbody>
				</table>
				<table style="BORDER-BOTTOM: rgb(220,220,220) 1px solid; MARGIN: 10px 0px; BORDER-COLLAPSE: collapse; BACKGROUND: rgb(244,244,244); FONT-SIZE: 12px; BORDER-TOP: rgb(220,220,220) 1px solid" border="0" cellspacing="0" cellpadding="4" width="100%">
				  <tbody>
					<tr>
					  <td>
						'.date("Y年m月d日",time()).'：<a href="'.getUserUrl($uid).'" target="_blank">'.getUserName($uid).'</a>邀请您加入知行网。
					  </td>
					</tr>
				  </tbody>
				</table>
				<table style="MARGIN-TOP: 20px" border="0" cellspacing="0" cellpadding="5" width="100%">
				  <tbody>
				  '.$content.'
				  </tbody>
				</table>
				<table style="MARGIN-TOP: 20px" border="0" cellspacing="0" cellpadding="5" width="100%">
				  <tbody></tbody>
				</table>
				<table style="MARGIN-TOP: 20px" border="0" cellspacing="0" cellpadding="5" width="100%">
				  <tbody></tbody>
				</table>
				<table style="MARGIN-TOP: 25px; BACKGROUND: rgb(245,245,245); COLOR: rgb(135,135,135)" border="0" cellspacing="0" cellpadding="6" width="100%">
				  <tbody>
					<tr>
					  <td>
						<p style="MARGIN: 3px 0px; FONT-SIZE: 12px">
						  请点击以下链接接受邀请。如果不能点击，请复制并粘贴以下链接到您浏览器的地址栏内：<br /><a href="'.$invite_url.'" target="_blank">'.$invite_url.'</a> 
						</p>
					  </td>
					</tr>
				  </tbody>
				</table>
				<table style="MARGIN-TOP: 15px; COLOR: rgb(130,130,130); BORDER-TOP: rgb(230,230,230) 2px solid" border="0" cellspacing="0" cellpadding="5" width="100%">
				  <tbody>
					<tr>
					  <td>
						<p style="MARGIN: 5px 0px 2px; FONT-SIZE: 12px">知行网</p>
						<p style="MARGIN: 0px; FONT-SIZE: 12px">
						  <a style="COLOR: rgb(130,130,130); TEXT-DECORATION: underline" href="'.SITE_URL.'" target="_blank">http://www.zhixing001.com</a>
						</p>
					  </td>
					</tr>
				  </tbody>
				</table>
			  </td>
			</tr>
		  </tbody>
		</table>
		</body>
		</html>';
		
		return $content_tpl;
	}
}
?>
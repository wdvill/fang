<?php
class ToolModel extends Model {
	//获取ios设备列表
	function getDeviceList($map='',$limit=10,$field="*",$order="id DESC"){
		$res = M('iosdevice')->where($map)->order($order)->field($field)->findPage($limit);
		
		if(!$res) return array();
		
		return $res;
	}
	
	//获取全部ios设备
	function getAllDevice($map){
		if(empty($map)) $map = 'status=1 and type="ios"';
		
		$res = M('iosdevice')->where($map)->findAll();
		
		if(!$res) return array();
		
		return getSubByKey($res,'token');
	}
	
	//获取ios设备信息
	function getDeviceInfo($id){
		$res = M('iosdevice')->where("id={$id}")->find();
		
		if(!$res) return array();
		
		return $res;
	}
	
	//添加ios设备信息
	function addDevice($post){
		$data['token'] = trim($post['token']);
		$data['macaddr'] = trim($post['macaddr']);
		if(empty($data['token'])) return NULL;
		
		if($res = M('iosdevice')->where("token='".$data['token']."' and macaddr='".$data['macaddr']."' and type='".$data['type']."'")->find()){
			if($res['status']==1){
				return 'exist';
			}else{
				if(M('iosdevice')->setField("status",1,"id={$res['id']}")){
					return 1;
				}
			}
		}else{
			if(M('iosdevice')->add($data)){
				return 1;
			}
		}
	}
	
	//删除ios设备信息
	function deleteDevice($ids){
		if(empty($ids)) return NULL;
		
		$ids = is_array($ids) ? implode(',',$ids):$ids;
		
		if(M('iosdevice')->setField('status',0,"id IN (".$ids.")")){
			return 1;
		}
	}
	
	/*
	 *ios-push通知
	 */
	//发送push通知
	function sendPush($deviceToken,$message,$id,$url,$type='1'){
		$deviceToken = is_array($deviceToken) ? $deviceToken : explode(',',$deviceToken);
		//print_r($deviceToken);
		//exit;
		//$deviceToken = 'c8b716e24785895c10e5875424fdf5267c49bd5d28b037616ee7c92b2cdcba36';
		$p12_file = SITE_PATH.'/ck.pem';
		//echo 'file='.$p12_file.';';
		$passphrase = 'tiger';
                //$passphrase = 'superjoo';
		
		if(empty($message) || empty($deviceToken) || empty($p12_file)){
			echo '参数不合法！';
			exit;
		}
		
		//链接APNS地址
		//正式地址
		$aurl = 'ssl://gateway.push.apple.com:2195';
		//测试地址
		//$aurl = 'ssl://gateway.sandbox.push.apple.com:2195';
		
		$ctx = stream_context_create();
		stream_context_set_option($ctx,'ssl','local_cert',$p12_file);
		stream_context_set_option($ctx,'ssl','passphrase',$passphrase);
		
		$fp = stream_socket_client($aurl,$err,$errstr,60,STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT,$ctx);
		
		if (!$fp){
			return "Failed to connect: $err $errstr".PHP_EOL;
		}
		
		//echo 'Connected to APNS'.PHP_EOL;
		
		$body['aps'] = array(
						'alert' => $message,
						'badge' => 1,
						'sound' => 'default',
						'type'  => $type,
						'id' => $id,
						'url' => $url
					   );
		//$body['badge'] = '1';
		$payload = json_encode($body);
		$sendresult = 0;   //发送是否有成功的记录
		foreach($deviceToken as $v){
			//echo $v.'---';
			$msg = chr(0).pack('n',32).pack('H*',$v).pack('n',strlen($payload)).$payload;
			
			$result = fwrite($fp,$msg,strlen($msg));
		
			if ($result){
				//echo '1111';
				$sendresult = 1;			//只要有一个设备发送成功，就算发送成功了。
			}
		}
		if ($sendresult == 1){
				$_POST=array('content' => $message,
							 'content_type' => $type,
							 'content_sound' => 'default',
							 'send_type' => 'ios',
							 'send_result' => '1',
							 'url' => $url,
							 'title' => $id,
							 'token' => $v
							 );
				M('push_message')->add($_POST);
			
		}else {
				$_POST=array('content' => $message,
							 'content_type' => $type,
							 'content_sound' => 'default',
							 'send_type' => 'ios',
							 'send_result' => '0',
							 'url' => $url,
							 'title' => $id,
							 'token' => $v
							 );
							
				M('push_message')->add($_POST);
			
		}
			
		fclose($fp);
		
		//return $deviceToken[0];
		return '1';
	}
}

?>

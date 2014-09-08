<?php
//From http://zxs19861202.iteye.com/blog/1532460
//openssl pkcs12 -nocerts -out iospush.pem -in iospush.p12
$deviceToken = '0e559d950fcaab85b7663a3337c51b64a21fb48f03c5e56412ffb74005c8187c';
$p12_file = 'pushCer.pem';
$passphrase = '12345678';
$message = $_REQUEST['mess'];
$type = $_REQUEST['type'];

if(empty($message) || empty($deviceToken) || empty($p12_file)){
	echo '参数不合法！';
	exit;
}

//链接APNS地址
//正式地址
//$url = 'ssl://gateway.push.apple.com:2195';
//测试地址
$url = 'ssl://gateway.sandbox.push.apple.com:2195';

$ctx = stream_context_create();
stream_context_set_option($ctx,'ssl','local_cert',$p12_file);
stream_context_set_option($ctx,'ssl','passphrase',$passphrase);

//$fp = stream_socket_client($url,$err,$errstr,60,STREAM_CLIENT_CONNECT,$ctx);
$fp = stream_socket_client($url,$err,$errstr,60,STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT,$ctx);

if (!$fp){
	exit("Failed to connect: $err $errstr".PHP_EOL);
}

echo 'Connected to APNS'.PHP_EOL;

$body['aps'] = array(
				'alert' => $message,
				'sound' => 'default',
				'type' => $type
			   );
$payload = json_encode($body);

$msg = chr(0).pack('n',32).pack('H*',$deviceToken).pack('n',strlen($payload)).$payload;
echo "msg=".$msg;
$result = fwrite($fp,$msg,strlen($msg));

if ($result){
	echo '22222222222Success!';
}else{
	echo '222222Failure';
}

fclose($fp);

?>
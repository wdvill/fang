<?php
//From http://zxs19861202.iteye.com/blog/1532460
//http://article.ityran.com/archives/194
//openssl pkcs12 -nocerts -out iospush.pem -in iospush.p12
$deviceToken = '0e559d950fcaab85b7663a3337c51b64a21fb48f03c5e56412ffb74005c8187c';
$p12_file = 'pushCer.pem';
$passphrase = '12345678';

// Put your alert message here:
 
$message = 'aaa';
 

$ctx = stream_context_create();
 
stream_context_set_option($ctx, 'ssl', 'local_cert', 'pushCer.pem');
 
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
 

// Open a connection to the APNS server
 
//这个为正是的发布地址
 
 //$fp = stream_socket_client(“ssl://gateway.push.apple.com:2195“, $err, $errstr, 60, //STREAM_CLIENT_CONNECT, $ctx);
 
//这个是沙盒测试地址，发布到appstore后记得修改哦
 
$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,
 
$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
 



if (!$fp)
 
exit("Failed to connect: $err $errstr" . PHP_EOL);
 



echo 'Connected to APNS' . PHP_EOL;
 



// Create the payload body
 
$body['aps'] = array(
 
'alert' => $message,
 
'sound' => 'default'
 
);
 



// Encode the payload as JSON
 
$payload = json_encode($body);
 



// Build the binary notification
 
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
 



// Send it to the server
 
$result = fwrite($fp, $msg, strlen($msg));
 
echo "=====result=".$result."======";


if (!$result)
 
echo 'Message not delivered' . PHP_EOL;
 
else
 
echo 'Message successfully delivered' . PHP_EOL;
 



// Close the connection to the server
 
fclose($fp);
 
?>

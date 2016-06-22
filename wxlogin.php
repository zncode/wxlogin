<?php  
  
$appid = "appid";  
$secret = "app secret";  
$code = $_GET["code"];  

$get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';  
$result = http_request($get_token_url); 
$json_obj = json_decode($result,true);  
  
 
if($access_token = $json_obj['access_token'])
 {
	$openid = $json_obj['openid'];  
	$get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';  
	$result = http_request($get_user_info_url); 
	$user_obj = json_decode($result,true);  

	if($user_obj['nickname']){		
		echo json_encode(array('code'=>0, 'msg'=>'SUCCESS', 'data'=$user_obj));
	}else{
		echo json_encode(array('code'=>1, 'msg'=>'Invalid openid', 'data'=array()));
	}
 }
 else{

 	echo json_encode(array('code'=>1, 'msg'=>'Invalid code', 'data'=array()));
 }


 

function http_request($url){
	$ch = curl_init();  
	curl_setopt($ch,CURLOPT_URL,$url);  
	curl_setopt($ch,CURLOPT_HEADER,0);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );  
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);  
	$result = curl_exec($ch);  
	curl_close($ch);  

	return $result;
}
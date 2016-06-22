<?php

define( "WB_AKEY" , 'xxxxxxxxxx' );
define( "WB_SKEY" , 'xxxxxxxxxxxxxxxxxxxxxxxxx' );
define( "WB_CALLBACK_URL" , 'http://xxxxxxxxxxxx/callback.php' );

include_once( 'saetv2.ex.class.php' );


$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

if (isset($_REQUEST['code'])) {
	$keys = array();
	$keys['code'] = $_REQUEST['code'];
	$keys['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token = $o->getAccessToken( 'code', $keys ) ;
		echo $token;
	} catch (OAuthException $e) {
	}
}
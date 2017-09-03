<?php

	$user = new user();

	if($sUser->data->type == 0 && isset($_POST['uid'])){
		$uid = $_POST['uid'];
	} else {
		$uid = $sUser->data->id;
	}

	$user->load($uid);

	$response['data'] 	= $user->delete();
	$response['status'] = 0;

	send($response);

	if($sUser->data->id == $user->data->id){
		session_destroy();
	}

?>
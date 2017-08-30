<?php

	$user = new user();

	if($muid == 1 && isset($_POST['uid'])){
		$uid = $_POST['uid'];
	} else {
		$uid = $muid;
	}

	$user->load($uid);

	$response['data'] 	= $user->delete();
	$response['status'] = 0;

	send($response);

?>
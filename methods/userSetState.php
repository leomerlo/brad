<?php

	$user = new user();

	if($muid == 1 && isset($_POST['uid'])){
		$uid = $_POST['uid'];
	} else {
		$uid = $muid;
	}

	$user->load($uid);

	$user_data = [];

	$state = $_POST['state'];

	$response['data'] 	= $user->setState($state);
	$response['status'] = 0;

	send($response);

?>
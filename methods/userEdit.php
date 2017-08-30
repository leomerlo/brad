<?php

	$user = new user();

	if($muid == 1 && isset($_POST['uid'])){
		$uid = $_POST['uid'];
	} else {
		$uid = $muid;
	}

	$user->load($uid);

	$user_data = [];

	$user_data['username'] = $_POST['username'];

	$response['data'] 	= $user->edit($user_data);
	$response['status'] = 0;

	if($_FILES['userImg'] != ''){
		$user->uploadAvatar($_FILES['userImg']);
	}

	send($response);

?>
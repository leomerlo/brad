<?php

	if(!isset($_POST['pos'])){
		$pos = ':';
	} else {
		$pos = $_POST['pos'];
		$uid = $muid;
	}

	$user = new user();

	$user->load($uid);

	$response['data']['info'] = $user->updatePos($pos);
	$response['status'] = 0;

	send($response);

?>
<?php

	if(!isset($_POST['tid'])){
		$errors[] = 'Falta el trip';
	} else {
		$tid = $_POST['tid'];
		$uid = $muid;
	}

	checkForErrors($errors);

	$user = new user();

	$user->load($uid);

	$response['data']['info'] = $user->leaveTrip($tid);
	$response['status'] = 0;

	send($response);

?>
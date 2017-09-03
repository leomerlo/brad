<?php

	$user = new user();

	if($sUser->data->type == 0 && isset($_POST['uid'])){
		$uid = $_POST['uid'];
	} else {
		$uid = $sUser->data->id;
	}

	$user->load($uid);

	$user_data = [];

	$user_data['username'] = isset($_POST['username']) ? $_POST['username'] : '';
	$user_data['password'] = isset($_POST['password']) ? $_POST['password'] : '';
	$user_data['nombre'] = isset($_POST['nombre']) ? $_POST['nombre'] : '';
	if($sUser->data->type == 0){
		$user_data['type'] = isset($_POST['type']) ? $_POST['type'] : '';
	}
	$user_data['active'] = isset($_POST['active']) ? $_POST['active'] : '';

	$response['data'] 	= $user->edit($user_data);
	$response['status'] = 0;

	send($response);

?>
<?php

	$newUser = new user();

	if(!isset($_POST['username']) || !isset($_POST['password'])){
		$errors[] = '1';
	}

	if($sUser->data->type != 0){
		$errors[] = '3';	
	}

	checkForErrors($errors);

	$user_data = [];

	$user_data['username'] 		= $_POST['username'];
	$user_data['password'] 		= $_POST['password'];
	$user_data['nombre'] 		= isset($_POST['nombre']) ? $_POST['nombre'] : $_POST['username'];

	$response['data']['info'] 	= $newUser->create($user_data);
	$response['status'] = 0;

	send($response);
?>
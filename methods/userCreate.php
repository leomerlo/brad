<?php

	// TODO, hacer el upload de la imagen

	$newUser = new user();

	if(!isset($_POST['username']) || !isset($_POST['phone'])){
		$errors[] = 'Faltan datos para realizar la creación.';
	}

	checkForErrors($errors);

	$user_data = [];

	$user_data['username'] 		= $_POST['username'];
	$user_data['phone'] 		= $_POST['phone'];

	$response['data']['info'] 	= $newUser->create($user_data);
	$response['status'] = 0;

	if($_FILES['userImg'] != ''){
		$newUser->uploadAvatar($_FILES['userImg']);
	}

	send($response);
?>
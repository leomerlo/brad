<?php

	if(!isset($_POST['phone']) || !isset($_POST['code'])){
		//$errors[] = 'Error en el login';
	}

	$user = new user();

	$phone = $_POST['phone'];
	$code = $_POST['code'];

	if($user->login($phone,$code)){
		$_SESSION['uid'] = $user->user['id'];
	} else {
		$errors[] = 'Error en el login';
	}

	checkForErrors($errors);
	
	$response['data'] = $user->user;
	$response['status'] = 0;

	send($response);
?>
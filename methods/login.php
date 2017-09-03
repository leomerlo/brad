<?php

	if(!isset($_POST['username']) || !isset($_POST['password'])){
		$errors[] = '1';
	}

	$user = new user();

	$username = $_POST['username'];
	$password = $_POST['password'];

	if($user->login($username,$password)){
		$_SESSION['uid'] = $user->data['id'];
	} else {
		$errors[] = '2';
	}

	checkForErrors($errors);
	
	$response['data'] = $user;
	$response['status'] = 0;

	send($response);
?>
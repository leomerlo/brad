<?php

	if(!isset($_POST['tid']) || !isset($_POST['key'])){
		$errors[] = 'Faltan datos para realizar la accion';
	} else {
		$uid = (isset($_GET['uid']) ? $_GET['uid'] : $muid);
		$tid = $_POST['tid'];
		$key = $_POST['key'];
	}

	checkForErrors($errors);

	$user = new user();
	$user->load($uid);

	$trip = new trip();
	$trip->load($tid);

	if(sha1($key) != $trip->trip->key){
		$errors[] = 'La key del Trip es incorrecta';
	}

	checkForErrors($errors);

	$response['data']['info'] = $user->joinTrip($tid);
	$response['status'] = 0;

	send($response);

?>
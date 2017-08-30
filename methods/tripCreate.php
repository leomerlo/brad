<?php

	$o_trip = new StdClass();

	$newTríp = new trip($o_trip);

	if(!isset($_POST['name']) || !isset($_POST['key']) || !isset($_POST['bt_lock'])){
		$errors[] = 'Faltan datos para realizar la creación.';
	}

	checkForErrors($errors);

	$trip_data = [];

	$trip_data['name'] 		= $_POST['name'];
	$trip_data['key'] 		= sha1($_POST['key']);
	$trip_data['bt_lock'] 	= $_POST['bt_lock'];

	$response['data'] = array(
		'info' 	=> $newTríp->create($trip_data,$muid),
		'id'	=> $newTríp->trip->id
	);
	$response['status'] = 0;

	send($response);
?>
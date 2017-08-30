<?php

	if(!isset($_POST['tid'])){
		$errors[] = 'Falta el trip';
	} else {
		$tid = $_POST['tid'];
	}

	checkForErrors($errors);

	$trip = new trip();

	$trip->load($tid);

		$trip_data = [];

		$trip_data['name'] 		= $_POST['name'];
		$trip_data['oldKey'] 	= sha1($_POST['oldKey']);
		$trip_data['newKey'] 	= $_POST['newKey'];
		$trip_data['bt_lock'] 	= $_POST['bt_lock'];
		$trip_data['active'] 	= $_POST['active'];

		if($trip_data['newKey'] != '') {
			if($trip_data['oldKey'] == $trip->trip->key) {
				$trip_data['key'] = sha1($trip_data['newKey']);
			} else {
				$errors[] = 'La Key del Trip no coincide';
			}
		} else {
			$trip_data['key'] = $trip->trip->key;
		}

		if($muid != 1 && $muid != $trip->trip->creator_id){
			$errors[] = 'No tenés permisos para hacer el cambio';
		}

	checkForErrors($errors);

	$response['data'] 	= $trip->edit($trip_data,$tid);
	$response['status'] = 0;

	send($response);

?>
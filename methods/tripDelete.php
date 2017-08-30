<?php

	if(!isset($_GET['tid'])){
		$errors[] = 'Falta el trip';
	} else {
		$tid = $_GET['tid'];
	}

	checkForErrors($errors);

	$trip = new trip();
	$trip->load($tid);

	if($muid != 1 && $muid != $trip->trip->creator_id){
		$errors[] = 'No tenés permisos para hacer esto';
	}

	checkForErrors($errors);

	$response['data'] = $trip->delete();
	$response['status'] = 0;

	send($response);

?>
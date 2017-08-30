<?php

	$tid = (isset($_POST['tid']) ? $_POST['tid'] : 0);

	if(!isset($_POST['key'])){
		$errors[] = 'Falta la key.';
		$key = '';
	} else {
		$key = $_POST['key'];
	}

	$trip = new trip();

	//Cargamos el trip
	$trip->load($tid,$key);

	//Revisamos el pass
	if($trip->trip['key'] != sha1($key)){
		$errors[] = 'La key es incorrecta.';
	}

	checkForErrors($errors);

	// Levantamos los trippers
	$response['data']['info']['positions'] = $trip->getUserPos();
	$response['status'] = 0;

	send($response);

?>
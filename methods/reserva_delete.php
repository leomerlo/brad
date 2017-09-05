<?php

	$reserva = new reserva();

	if(!isset($_POST['rid'])){
		$errors[] = '1';
	} else {
		$rid = $_POST['rid'];
	}

	if($sUser->data->type != 0){
		$errors[] = '3';	
	}

	$reserva->load($rid);

	$response['data'] 	= $reserva->delete();
	$response['status'] = 0;

	send($response);

?>
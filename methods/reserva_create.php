<?php

	$reserva = new reserva();

	if(!isset($_POST['nombre']) || !isset($_POST['apellido']) || !isset($_POST['telefono']) || !isset($_POST['dia']) || !isset($_POST['hora']) || !isset($_POST['pax'])){
		$errors[] = '1';
	}

	if($sUser->data->type != 0){
		$errors[] = '3';
	}

	if(checkBloqueo($_POST['dia'],$_POST['hora'])){
		$errors[] = '4';
	}

	checkForErrors($errors);

	$data = [];

	$data['nombre'] 		= $_POST['nombre'];
	$data['apellido'] 		= $_POST['apellido'];
	$data['telefono'] 		= $_POST['telefono'];
	$data['hora'] 			= $_POST['hora'];
	$data['dia'] 			= $_POST['dia'];
	$data['pax'] 			= $_POST['pax'];
	$data['observaciones'] 	= isset($_POST['observaciones']) ? $_POST['observaciones'] : '';
	$data['usuario'] 		= $sUser->data->id;
	if(isset($_POST['mesa'])){
		$data['mesa'] 		= explode(',',$_POST['mesa']);	
	}

	$response['data']['info'] 	= $reserva->create($data);
	$response['status'] = 0;

	send($response);
?>
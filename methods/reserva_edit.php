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

	$data = [];

	$data['nombre'] 		= isset($_POST['nombre']) ? $_POST['nombre'] : '';
	$data['apellido'] 		= isset($_POST['apellido']) ? $_POST['apellido'] : '';
	$data['telefono'] 		= isset($_POST['telefono']) ? $_POST['telefono'] : '';
	$data['hora'] 			= isset($_POST['hora']) ? $_POST['hora'] : '';
	$data['pax'] 			= isset($_POST['pax']) ? $_POST['pax'] : '';
	$data['observaciones'] 	= isset($_POST['observaciones']) ? $_POST['observaciones'] : '';
	$data['mesa'] 			= isset($_POST['mesa']) ? explode(',',$_POST['mesa']) : '';
	$data['active'] 		= isset($_POST['active']) ? $_POST['active'] : '';

	$response['data'] 	= $reserva->edit($data);
	$response['status'] = 0;

	send($response);

?>
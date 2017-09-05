<?php

	$mesa = new mesa();

	if(!isset($_POST['numero']) || !isset($_POST['pax'])){
		$errors[] = '1';
	}

	if($sUser->data->type != 0){
		$errors[] = '3';	
	}

	checkForErrors($errors);

	$data = [];

	$data['numero'] 		= $_POST['numero'];
	$data['pax'] 			= $_POST['pax'];
	$data['tipo'] 			= isset($_POST['tipo']) ? $_POST['tipo'] : '1';

	$response['data']['info'] 	= $mesa->create($data);
	$response['status'] = 0;

	send($response);
?>
<?php

	$mesa = new mesa();

	if(!isset($_POST['numero']) || !isset($_POST['tipo'])){
		$errors[] = '1';
	}

	if($sUser->data->type != 0){
		$errors[] = '3';	
	}

	checkForErrors($errors);

	$data = [];

	$data['numero'] 		= $_POST['numero'];
	$data['tipo'] 			= $_POST['tipo'];

	$response['data']['info'] 	= $mesa->create($data);
	$response['status'] = 0;

	send($response);
?>
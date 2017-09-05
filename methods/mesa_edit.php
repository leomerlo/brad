<?php

	$mesa = new mesa();

	if(!isset($_POST['mid'])){
		$errors[] = '1';
	} else {
		$mid = $_POST['mid'];
	}

	if($sUser->data->type != 0){
		$errors[] = '3';	
	}

	$mesa->load($mid);

	$data = [];

	$data['numero'] 		= isset($_POST['numero']) ? $_POST['numero'] : '';
	$data['pax'] 			= isset($_POST['pax']) ? $_POST['pax'] : '';
	$data['tipo'] 			= isset($_POST['tipo']) ? $_POST['tipo'] : '';

	$response['data'] 	= $mesa->edit($data);
	$response['status'] = 0;

	send($response);

?>
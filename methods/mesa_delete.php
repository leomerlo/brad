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

	$response['data'] 	= $mesa->delete();
	$response['status'] = 0;

	send($response);

?>
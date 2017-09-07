<?php

	$bloqueo = new bloqueo();

	if(($action == 'bloqueo' && !isset($_POST['dia'])) || $action == 'desbloqueo' && !isset($_POST['bid'])){
		$errors[] = '1';
	}

	if($sUser->data->type != 0){
		$errors[] = '3';	
	}

	checkForErrors($errors);

	$data = [];

	if($action == 'bloqueo'){
		$data['hora'] 				= isset($_POST['hora']) ? $_POST['hora'] : '*';
		$data['dia'] 				= $_POST['dia'];
		$response['data']['info'] 	= $bloqueo->create($data);
	}

	if($action == 'desbloqueo'){
		$data['bid'] 				= $_POST['bid'];
		$response['data']['info'] 	= $bloqueo->delete($data);
	}

	if($action == 'get'){
		if(isset($_POST['bid'])){
			$data['bid'] 			= $_POST['bid'];
		}

		if(isset($_POST['dia'])){
			$data['dia'] 			= $_POST['dia'];
			$data['hora'] 			= isset($_POST['hora']) ? $_POST['hora'] : '*';
		}

		$response['data']['info'] 	= $bloqueo->getAll($data);
	}

	$response['status'] = 0;

	send($response);
?>
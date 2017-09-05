<?php

	$reserva = new reserva();

	$data = [];

	if(isset($_POST['dia'])){
		$data['dia'] = $_POST['dia'];
	}

	$response['data']['info'] 	= $reserva->getAll($data);
	$response['status'] = 0;

	send($response);

?>
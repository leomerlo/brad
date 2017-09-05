<?php

	//RedBeans
	require('libs/rb.php');
	R::setup('mysql:host=localhost;dbname=brad','root','');

	include_once('classes/user.php');
	include_once('classes/mesa.php');
	include_once('classes/reserva.php');

	session_start();

	$response = [];
	$errors = [];

	if(isset($_SESSION['uid'])){
		$sUser = new user();
		$sUser->load($_SESSION['uid']);
	} else {
		if(isset($_GET['q']) && $_GET['q'] != 'login'){
			$errors[] = 'Tenés que iniciar sesión';
		}
	}

	checkForErrors($errors,2);

	function send($response) { echo json_encode($response); }

	function checkForErrors($errors,$error = 1){
		if(count($errors) != 0){
			$response['data']['error'] 	= $errors;
			$response['status'] = $error;

			send($response);

			die();		
		}
	}

	$q = (isset($_GET['q']) ? $_GET['q'] : 'help');

	switch ($q) {

		// USER
			// CHECKED
		case 'user_create':
			$include = 'user_create';
			break;
			// CHECKED
		case 'user_delete':
			$include = 'user_delete';
			break;
			// CHECKED
		case 'user_edit':
			$include = 'user_edit';
			break;

		// MESAS
			// CHECKED
		case 'mesa_create':
			$include = 'mesa_create';
			break;
			// CHECKED
		case 'mesa_delete':
			$include = 'mesa_delete';
			break;
			// CHECKED
		case 'mesa_edit':
			$include = 'mesa_edit';
			break;

		// RESERVA
			// CHECKED
		case 'reserva_create':
			$include = 'reserva_create';
			break;
			// CHECKED
		case 'reserva_delete':
			$include = 'reserva_delete';
			break;
			// CHECKED
		case 'reserva_edit':
			$include = 'reserva_edit';
			break;
			// CHECKED
		case 'reservas':
			$include = 'reserva';
			break;

		// BLOQUEO
		case 'bloqueo_dia':
			$include = 'bloqueo_dia';
			break;

		case 'desbloqueo_dia':
			$include = 'desbloqueo_dia';
			break;

		case 'bloqueo_hora':
			$include = 'bloqueo_hora';
			break;

		case 'desbloqueo_hora':
			$include = 'desbloqueo_hora';
			break;
		
		// AUTH
			// CHECKED
		case 'login':
			$include = 'login';
			break;
			// CHECKED
		case 'logout':
			$include = 'logout';
			break;

		case 'man':
			$include = 'apiHelp';
			break;

		// HELP
		default:
			$include = 'debug';
			break;
	}

	include_once('methods/'.$include.'.php');
	
?>
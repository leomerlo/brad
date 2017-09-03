<?php

	//RedBeans
	require('libs/rb.php');
	R::setup('mysql:host=localhost;dbname=brad','root','');

	include_once('classes/user.php');

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

		
		// AUTH
			// CHECKED
		case 'login':
			$include = 'login';
			break;
			// CHECKED
		case 'logout':
			$include = 'logout';
			break;

		// HELP
		default:
			$include = 'apiHelp';
			break;
	}

	include_once('methods/'.$include.'.php');
	
?>
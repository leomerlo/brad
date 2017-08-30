	<?php

	session_start();

	$response = [];
	$errors = [];

	if(isset($_SESSION['uid'])){
		$muid = $_SESSION['uid'];
	} else {
		if(isset($_GET['q']) && $_GET['q'] != 'login'){
			$errors[] = 'Tenés que iniciar sesión';
		}
	}

	checkForErrors($errors,2);

	//RedBeans
	require('libs/rb.php');
	R::setup('mysql:host=localhost;dbname=trip','root','');

	include_once('classes/trip.php');
	include_once('classes/user.php');
	include_once('classes/marker.php');

	function send($response) { echo json_encode($response); }

	function checkForErrors($errors,$error = 1){
		if(count($errors) != 0){
			$response['data'] 	= $errors;
			$response['status'] = $error;

			send($response);

			die();		
		}
	}

	$q = (isset($_GET['q']) ? $_GET['q'] : 'help');

	switch ($q) {

		// TRIP

		case 'createTrip':
			$include = 'tripCreate';
			break;
		
		case 'getTrip':
			$include = 'tripGet';
			break;

			case 'getTrippersPos':
				$include = 'tripGetTrippersPos';
				break;

		case 'editTrip':
			$include = 'tripEdit';
			break;

		case 'deleteTrip':
			$include = 'tripDelete';
			break;

		// PUNTOS

		case 'addMarker':
			$include = 'markerAdd';
			break;

		case 'deleteMarker':
			$include = 'markerDelete';
			break;

		case 'cleanMarker':
			$include = 'markerClean';
			break;

		// USER

		case 'createUser':
			$include = 'userCreate';
			break;

		case 'editUser':
			$include = 'userEdit';
			break;

		case 'deleteUser':
			$include = 'userDelete';
			break;

		case 'joinTrip':
			$include = 'userJoinTrip';
			break;

		case 'leaveTrip':
			$include = 'userLeaveTrip';
			break;

		case 'myTrips':
			$include = 'userMyTrips';
			break;

		case 'viewUser':
			$include = 'userView';
			break;

		case 'updatePos':
			$include = 'userUpdatePos';
			break;

		case 'setUserState':
			$include = 'userSetState';
			break;

		// AUTH

		case 'login':
			$include = 'login';
			break;

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
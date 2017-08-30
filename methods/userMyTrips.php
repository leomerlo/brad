<?php

	checkForErrors($errors);

	$user = new user();

	$user->load($muid);

	$response['data']['info'] = $user->myTrips();
	$response['status'] = 0;

	send($response);

?>
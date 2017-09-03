<?php

	$response = [];

	$response['Login']['Q'] = 'login';
	$response['Login']['Params'] = 'username *, password *';

	$response['Logout']['Q'] = 'logout';

	$response['Usuario']['Crear']['Q'] = 'user_create';
	$response['Usuario']['Crear']['Params'] = 'username *, password *, nombre, type, active';
	$response['Usuario']['Editar']['Q'] = 'user_edit';
	$response['Usuario']['Editar']['Params'] = 'uid, username, password, nombre, type, active';
	$response['Usuario']['Eliminar']['Q'] = 'user_delete';
	$response['Usuario']['Eliminar']['Params'] = 'uid';

	send($response);

?>
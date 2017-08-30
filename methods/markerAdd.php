<?php

  if(!isset($_POST['tid']) || !isset($_POST['markers'])){
    $errors[] = 'Faltan datos para realizar la accion';
  } else {
    $tid = $_POST['tid'];
  }

  checkForErrors($errors);

  $trip = new trip();
  $trip->load($tid);

  if($trip->trip->creator_id != $muid){
    $errors[] = 'No tenes permisos para realizar la operacion';
  }

  $markers = json_decode($_POST['markers']);

  $o_marker = new marker();

  $o_marker->place($tid,$markers);

?>
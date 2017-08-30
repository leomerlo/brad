<?php

  if(!isset($_POST['mid'])){
    $errors[] = 'Faltan datos para realizar la accion';
  } else {
    $mid = $_POST['mid'];
  }

  checkForErrors($errors);

  $marker = new marker();

  $marker->remove($mid);

?>
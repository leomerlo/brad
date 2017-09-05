<?php

	class bloqueo {

		function create($data){

			$bloqueo = R::dispense('bloqueo');

			$bloqueo->hora 	= $data['numero'];
			$bloqueo->dia 	= $data['pax'];

			$bloqueo->id = R::store($bloqueo);

			return $bloqueo->id;

		}

		function delete(){
			$this->data->active = 0;

			R::store($this->data);

			return true;
		}

	}
?>
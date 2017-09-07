<?php

	class bloqueo {

		function create($data){

			$bloqueo = R::dispense('bloqueo');

			$bloqueo->hora 		= $data['hora'];
			$bloqueo->dia 		= $data['dia'];
			$bloqueo->active 	= 1;

			$bloqueo->id = R::store($bloqueo);

			return $bloqueo->id;
		}

		function delete(){
			$this->data->active = 0;

			R::store($this->data);

			return true;
		}

		function getAll($data){

			$bloqueos = [];

			// GET POR ID
			if(isset($data['bid'])){
				$bid = R::getAll( 'SELECT * FROM bloqueo WHERE active = 1 AND id = "'.$data['bid'].'"' );
			}

			// GET POR DIA Y HORA
			else if(isset($data['dia'])){
				
				if($data['hora'] != '*'){
					$hora = ' AND hora = "'.$data['hora'].'"';
				} else {
					$hora = '';
				}

				$bid = R::getAll( 'SELECT * FROM bloqueo WHERE active = 1 AND dia = "'.$data['dia'].'"'.$hora );
			}

			// GET TODAS
			else {
				$bid = R::findAll( 'bloqueo' );
			}

			$bid = R::convertToBeans( 'bloqueo', $bid );

			foreach ($bid as $bloqueo) {
				$temp = [];
				$temp['id'] 			= $bloqueo->id;
				$temp['dia'] 			= $bloqueo->dia;
				$temp['hora'] 			= $bloqueo->hora;
				$temp['active'] 		= $bloqueo->active;

				$bloqueos[] = $temp;
			}

			return $bloqueos;
		}

	}
?>
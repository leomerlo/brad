<?php

	class reserva {

		function create($data){

			$reserva = R::dispense('reserva');

			$reserva->nombre 			= $data['nombre'];
			$reserva->apellido 			= $data['apellido'];
			$reserva->telefono 			= $data['telefono'];
			$reserva->dia 				= $data['dia'];
			$reserva->hora 				= $data['hora'];
			$reserva->pax 				= $data['pax'];
			$reserva->observaciones 	= $data['observaciones'];
			$reserva->sharedMesaList   	= [];
			$reserva->active 			= 1;
			$reserva->tomaReserva 		= $data['usuario'];
			
			if(isset($data['mesa'])){
				foreach ($data['mesa'] as $mid) {
					$mesa = new mesa();
					$mesa->load($mid);
					$reserva->sharedMesaList[] = $mesa;
				}
			}

			$reserva->id = R::store($reserva);

			return $reserva->id;
		}

		function load($id){

			$this->data = R::load('reserva', $id);
		}

		function edit($data){
			if(isset($data['nombre']) && $data['nombre'] != '') {
				$this->data->nombre = $data['nombre'];
			}

			if(isset($data['apellido']) && $data['apellido'] != '') {
				$this->data->apellido = $data['apellido'];
			}

			if(isset($data['telefono']) && $data['telefono'] != '') {
				$this->data->telefono = $data['telefono'];
			}
			
			if(isset($data['hora']) && $data['hora'] != '') {
				$this->data->hora = $data['hora'];
			}

			if(isset($data['pax']) && $data['pax'] != '') {
				$this->data->pax = $data['pax'];
			}
			
			if(isset($data['observaciones']) && $data['observaciones'] != '') {
				$this->data->observaciones = $data['observaciones'];
			}

			if(isset($data['active']) && $data['active'] != '') {
				$this->data->active = $data['active'];
			}

			if(isset($data['mesa']) && $data['mesa'] != ''){
				foreach ($data['mesa'] as $mid) {
					$mesa 	= R::findOne( 'mesa', ' id = ? ', array($mid) );
					$this->data->sharedMesaList[] = $mesa;
				}
			} else {
				$this->data->sharedMesa = [];
			}

			R::store($this->data);

			return true;
		}

		function delete(){
			$this->data->active = 0;

			R::store($this->data);

			return true;
		}

		function getAll($data){

			$reservas = [];

			if(isset($data['dia'])){
				$rid = R::getAll( 'SELECT * FROM reserva WHERE dia = "'.$data['dia'].'" AND active = 1 AND id IN ( SELECT reserva_id FROM mesa_reserva )');
				$rid = R::convertToBeans( 'reserva', $rid );

				foreach ($rid as $reserva) {
					$temp = [];
					$temp['id'] 			= $reserva->id;
					$temp['nombre'] 		= $reserva->nombre;
					$temp['apellido'] 		= $reserva->apellido;
					$temp['dia'] 			= $reserva->dia;
					$temp['hora'] 			= $reserva->hora;
					$temp['telefono'] 		= $reserva->telefono;
					$temp['observaciones'] 	= $reserva->hora;
					$temp['mesa'] 			= [];
					foreach ($reserva->sharedMesa as $mesa) {
						$temp['mesa'][] = $mesa->numero;
					}

					$reservas['dia'] = $temp;
				}
			}

			$pid = R::getAll( 'SELECT * FROM reserva WHERE active = 1 AND id NOT IN ( SELECT reserva_id FROM mesa_reserva )' );
			$pid = R::convertToBeans( 'reserva', $pid );

			foreach ($pid as $reserva) {
				$temp = [];
				$temp['id'] 			= $reserva->id;
				$temp['nombre'] 		= $reserva->nombre;
				$temp['apellido'] 		= $reserva->apellido;
				$temp['dia'] 			= $reserva->dia;
				$temp['hora'] 			= $reserva->hora;
				$temp['telefono'] 		= $reserva->telefono;
				$temp['observaciones'] 	= $reserva->hora;

				$reservas['pendientes'] = $temp;
			}

			return $reservas;
		}

	}
?>
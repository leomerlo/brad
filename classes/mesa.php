<?php

	class mesa {

		function create($data){

			$mesa = R::dispense('mesa');

			$mesa->numero 	= $data['numero'];
			$mesa->pax 		= $data['pax'];
			$mesa->tipo 	= $data['tipo'];
			$mesa->active 	= 1;

			$mesa->id = R::store($mesa);

			return $mesa->id;

		}

		function load($id){

			$this->data = R::load('mesa', $id);

		}

		function edit($data){
			if(isset($data['numero']) && $data['numero'] != '') {
				$this->data->numero = $data['numero'];
			}

			if(isset($data['pax']) && $data['pax'] != '') {
				$this->data->pax = $data['pax'];
			}
			
			if(isset($data['tipo']) && $data['tipo'] != '') {
				$this->data->tipo = $data['tipo'];
			}

			R::store($this->data);

			return true;
		}

		function delete(){
			$this->data->active = 0;

			R::store($this->data);

			return true;
		}

	}
?>
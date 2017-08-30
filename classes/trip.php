<?php
	class trip {
		var $tripPoints = array();
		var $trip = '';

		function create($trip_data,$uid){
			$this->trip = R::dispense('trip');
			$this->trip->name 		= $trip_data['name'];
			$this->trip->key 		= $trip_data['key'];
			$this->trip->creator_id	= $uid;
			$this->trip->bt_lock 	= $trip_data['bt_lock'];
			$this->trip->active 	= 1;

			$user = R::load('user',$uid);

			$user_attrs = array(
				"user_id"		=>$uid,
				"user_pos"		=>'0;0',
				"user_admin"	=> 1
			);

			$this->trip->link('trip_tripper',$user_attrs)->user = $user;

			R::store($this->trip);

			return 'Se creó el Trip';
		}

		function load($tid){
			$this->trip = R::load('trip', $tid);
		}

		function edit($trip_data){
			
			$this->trip->name 		= $trip_data['name'];
			$this->trip->key 		= $trip_data['key'];
			$this->trip->bt_lock 	= $trip_data['bt_lock'];
			$this->trip->active 	= $trip_data['active'];

			R::store($this->trip);

			return 'Se editó correctamente';
		}

		function delete(){

			$this->trip->active = 0;

			R::store($this->trip);

			return 'Se desactivo el Trip '.$this->trip->id;
		}

		function get_list(){

			global $muid;

			if($muid == 0){
				$trips = R::getAll('SELECT * FROM trip WHERE activo = 1');
				return $trips;
			}
		}

		function get_trippers($info = array('username','phone','state')){
			$rawTrippers = $this->trip->via('trip_tripper')->sharedUser;
			$trippers = [];

			foreach($rawTrippers as $tripper){
				$rawUser = new user();
				$rawUser->load($tripper->id);

				if($rawUser->user->active == 1){
					$trippers[] = $rawUser->getMyInfo($info);
				}
			}

			return $trippers;
		}

		function getMarks(){
			
			$markers_id = $this->trip->with(' ORDER BY m_order ASC ')->ownMarker;

			$markers = [];

			foreach($markers_id as $key => $value){
				$marker_o = new marker();
				$marker_o->load($key);

				$marker = [];

				foreach ($marker_o->marker as $key => $value) {
					$marker[$key] = $value;
				}

				$markers[] = $marker;

			}

			return $markers;

		}

		function getUserPos(){
			
			$users_pos = $this->get_trippers(array('id','username','pos'));

			return $users_pos;

		}
	}

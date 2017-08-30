<?php

	// TODO: Generar la clave de usuario

	class user {
		var $user;

		function create($user_data){

			$this->user = R::dispense('user');

			$this->user->username 	= $user_data['username'];
			$this->user->phone 		= $user_data['phone'];
			//$this->user->userimg 	= $user_data['user_img'];
			$this->user->active 	= '1';
			// Clave de usuario
			$this->user->code 		= '12634';

			$this->user->id = R::store($this->user);

			return 'Usuario Creado con extio!';

		}

		function login($phone,$code){

			$this->user = R::getRow('SELECT id,username FROM user WHERE phone = ? AND code = ? limit 1',array($phone,$code));

			return $this->user;

		}

		function load($uid){

			$this->user = R::load('user', $uid);

		}

		function edit($user_data){
			$this->user->username = $user_data['username'];

			R::store($this->user);

			return 'Usuario editado';
		}

		function delete(){
			$this->user->active = 0;

			R::store($this->user);

			return 'Usuario desactivado';
		}

		function getMyInfo($whatInfo = []){

			$user_info = [];

			foreach($this->user as $key => $value) {
				if(count($whatInfo) > 0){
					if(in_array($key, $whatInfo)){
						$user_info[$key] = $value;
					}
				} else {
					$user_info[$key] = $value;
				}
	    	}
			
			return $user_info;

		}

		function uploadAvatar($file){

			move_uploaded_file($file["tmp_name"],"images/temp/".$file['name']);
			
			$output = "images/user/user_".$this->user->id.".jpg";
			$output_th = "images/user/thumbs/user_".$this->user->id.".jpg";

			$th_width = 50;
			$th_height = 50;

			$width = 200;
			$height = 200;

			$url = "images/temp/".$file['name'];

			$this->thumbGen($url,$file['type'],$output_th,$th_width,$th_height,60);
			$this->thumbGen($url,$file['type'],$output,$width,$height);

			unlink("images/temp/".$file['name']);

			R::store($this->user);

		}

		function thumbGen($url,$type,$output,$width,$height,$q = 100){

			$original = '';

			if ($type == 'image/png' || $type == 'png') {
				$original = imagecreatefrompng($url);
			}

			if ($type == 'image/jpeg' || $type == 'jpg' || $type == 'jpeg') {
				$original = imagecreatefromjpeg($url);
			}

			if ($type == 'image/gif' || $type == 'gif') {
				$original = imagecreatefromgif($url);
			}

			list($width_orig, $height_orig) = getimagesize($url);

			$ratio_orig = $width_orig/$height_orig;

			if ($width/$height < $ratio_orig) {
			   $width = $height*$ratio_orig;
			} else {
			   $height = $width/$ratio_orig;
			}

			$image = imagecreatetruecolor($width, $height);

			imagecopyresampled($image, $original, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

			imagejpeg($image, $output, 100);

		}

		function joinTrip($tid){

			$trip = R::load('trip', $tid);

			$user_attrs = array(
				"user_id"		=>$this->user->id,
				"user_admin"	=> 0
			);

			$trip->link('trip_tripper',$user_attrs)->user = $this->user;

			R::store($trip);

			return 'Se agregó al usuario '.$this->user->username.' al trip "'.$trip->name.'"';
		}

		function leaveTrip($tid){

			$trip 		= R::load('trip', $tid);
			$users 		= $trip->via('trip_tripper')->sharedUser;

			$user_pos = '';

			foreach($users as $key => $user){
				if($this->user->id == $user->id){
					$user_pos = $key;
				}
			}

			if($user_pos == '') {
				
				return 'El usuario no se encuenta en este Trip';

			} else {

				unset($trip->via('trip_tripper')->sharedUser[$user_pos]); 

				R::store($trip);

				return 'Se eliminó al usuario '.$this->user->username.' del trip "'.$trip->name.'"';

			}

		}

		function myTrips(){

			$rawTrips = $this->user->via('trip_tripper')->sharedTrip;
			$myTrips = [];

			foreach($rawTrips as $trip){
				$rawTrip = new trip();
				$rawTrip->load($trip->id);

				//if($rawTrip->trip->active == 1){
					$trip = array(
						'name' => $rawTrip->trip->name,
						'active' => $rawTrip->trip->active
					);
				//}

				$myTrips[] = $trip;
			}

			return $myTrips;

		}

		function setState($state){

			$this->user->state = $state;

			R::store($this->user);

			return 'Estado actualizado';

		}

		function updatePos($pos){
			
			$this->user->pos = $pos;

			R::store($this->user);

			return 'Posición actualizada';

		}
	}
?>
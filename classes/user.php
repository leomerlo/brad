<?php

	class user {

		function create($user_data){

			$user = R::dispense('user');

			$user->username 	= $user_data['username'];
			$user->password 	= sha1($user_data['password']);
			$user->nombre 		= $user_data['nombre'];
			$user->type 		= 1;
			$user->active 		= 1;

			$user->id = R::store($user);

			return $user->id;

		}

		function login($username,$password){

			$this->data = R::getRow('SELECT id FROM user WHERE username = ? AND password = ? AND active = 1 limit 1',array($username,sha1($password)));

			return $this->data;

		}

		function load($uid){

			$this->data = R::load('user', $uid);

		}

		function edit($user_data){
			if(isset($user_data['username']) && $user_data['username'] != '') {
				$this->data->username = $user_data['username'];
			}
			
			if(isset($user_data['password']) && $user_data['password'] != '') {
				$this->data->password = $user_data['password'];
			}

			if(isset($user_data['nombre']) && $user_data['nombre'] != '') {
				$this->data->nombre = $user_data['nombre'];
			}

			if(isset($user_data['type']) && $user_data['type'] != '') {
				$this->data->type = $user_data['type'];
			}

			if(isset($user_data['active']) && $user_data['active'] != '') {
				$this->data->active = $user_data['active'];
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
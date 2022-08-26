<?php

	class User {
		
		public function checkIfExists($email) {
			$connect = DB::getConnection();
			$where = '`user_email` = '."'".$email."'";
			$query = (new Select('users'))
						->where($where)
						->build();
			$res = mysqli_query($connect, $query);
			//echo $query;
			if (mysqli_num_rows($res) == 1) {
				return true;
			} else {
				return false;
			}
		}
		
		public function register($email, $login, $password, $token, $name, $surname) {
			$connect = DB::getConnection();
			$set = array('user_login', 'user_name', 'user_surname', 'user_email', 'user_password');
			$what = array($login, $name, $surname, $email, $password);
			$query = (new Insert('users')) 
						->set($set)
						->what($what)
						->build();
			mysqli_query($connect, $query);
			$userId = mysqli_insert_id($connect);
			
			$set = array('connect_token', 'connect_user_id');
			$what = array($token, $userId);
			$query = (new Insert('connects')) 
						->set($set)
						->what($what)
						->build();
			mysqli_query($connect, $query);
			return $userId;
		}
		
		
		public function auth($email, $hashedPassword, $token) {
			$connect = DB::getConnection();
			$query = (new Select('users'))
						->what(array('user_id'))
						->where("`user_email` = '$email' AND `user_password` = '$hashedPassword'")
						->build();
			$res = mysqli_query($connect, $query);
			if (mysqli_num_rows($res)) {
				$userId = mysqli_fetch_assoc($res)['user_id'];
				$set = array('connect_token', 'connect_user_id');
				$what = array($token, $userId);
				$query = (new Insert('connects')) 
							->set($set)
							->what($what)
							->build();
				mysqli_query($connect, $query);
			} else { $userId = 0; }
			return $userId;
		}
		
		public function isAuthorized() {
			if(isset($_COOKIE['user_id'])) {
				return true;
			} else { return false; }
		}
		
		public function logout($user_id) {
			$connect = DB::getConnection();
			/*$query = "
				DELETE FROM `connects`
				WHERE `connect_user_id` = $user_id;
			";*/
			$where = '`connect_user_id` = '.$user_id;
			$query = (new Delete('connects'))
						->where($where)
						->build();
			mysqli_query($connect, $query);
		}

		
		public function generateToken($size = 32) {
			$symbols = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l'];
		
			$length = count($symbols) - 1;
			$token = '';
			for ($i = 0; $i < $size; $i++) {
				$token .= $symbols[rand(0, $length)];
			}
			return $token;
		}
		
		public function getName($user_id){
			$connect = DB::getConnection();
			$query = "
				SELECT `user_name` FROM `users`
				WHERE `user_id` =".$user_id;
			$res = mysqli_query($connect, $query);
			$name = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $name;
		}
}
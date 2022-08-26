<?php

	class DB {
		
		private static $instance = null;
		
		public function __construct() {
			//include_once('./config/db.php');
			
			//временно
			
			$db =  array(
				"host" => "localhost:3308",
				"user" => "root",
				"password" => '',
				"database" => "marvel",
				"charset" => "utf8"
			);

			$connection = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);
			mysqli_set_charset($connection, $db['charset']);
			self::$instance = $connection;
			return;
		}
		
		public static function getConnection() {
			if(!self::$instance) {
				new DB();
			}
			return self::$instance;
		}
	}
<?php

	class ProducersProxyController {
		
		protected $producersController;
		protected $isAuthorized;
		
		public function __construct() {
			$this->producersController = new ProducersController();
			$userModel = new User();
			$this->isAuthorized = $userModel->isAuthorized();
		}
		
		public function dlt($id) {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$this->producersController->dlt($id);
			} else {
				echo '<script>
				window.location.assign("../list");
				alert("У вас нет прав на выполнение данного действия!");
				</script>';
			}
		}
		
		public function add() {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$this->producersController->add();
			} else {
				echo '<script>
				window.location.assign("list");
				alert("У вас нет прав на выполнение данного действия!");
				</script>';
			}
		}
	
	}
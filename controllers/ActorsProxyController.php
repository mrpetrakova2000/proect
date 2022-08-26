<?php

	class ActorsProxyController {
		
		protected $actorsController;
		protected $isAuthorized;
		
		public function __construct() {
			$this->actorsController = new ActorsController();
			$userModel = new User();
			$this->isAuthorized = $userModel->isAuthorized();
		}
		
		
		public function add() {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$this->actorsController->add();
			} else {
				echo '<script>
				window.location.assign("list");
				alert("У вас нет прав на выполнение данного действия!");
				</script>';
			}
		}
		
		public function dlt($id) {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$this->actorsController->dlt($id);
			} else {
				echo '<script>
				window.location.assign("../list");
				alert("У вас нет прав на выполнение данного действия!");
				</script>';
			}
		}
	
	}
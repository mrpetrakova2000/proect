<?php

	class PersonsProxyController {
		
		protected $personsController;
		protected $isAuthorized;
		
		public function __construct() {
			$this->personsController = new PersonsController();
			$userModel = new User();
			$this->isAuthorized = $userModel->isAuthorized();
		}
		
		public function edit($id) {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$this->personsController->edit($id);
			} else {
				echo '<script>
				window.location.assign("../list");
				alert("У вас нет прав на выполнение данного действия!");
				</script>';
			}
		}
		
		public function dlt($id) {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$this->personsController->dlt($id);
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
				$this->personsController->add();
			} else {
				echo '<script>
				window.location.assign("list");
				alert("У вас нет прав на выполнение данного действия!");
				</script>';
			}
		}
	
	}
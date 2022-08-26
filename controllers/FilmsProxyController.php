<?php

	class FilmsProxyController {
		
		protected $filmsController;
		protected $isAuthorized;
		
		public function __construct() {
			$this->filmsController = new FilmsController();
			$userModel = new User();
			$this->isAuthorized = $userModel->isAuthorized();
		}
		
		public function edit($id) {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$this->filmsController->edit($id);
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
				$this->filmsController->dlt($id);
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
				$this->filmsController->add();
			} else {
				echo '<script>
				window.location.assign("list");
				alert("У вас нет прав на выполнение данного действия!");
				</script>';
			}
		}
	
	}
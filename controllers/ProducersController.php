<?php
	
	class ProducersController {
		public function index() {
			$title = 'Режиссеры';
			$producersModel = new Producer();
			$producersCount = $producersModel->calculateCount();
			$currentPage = $this->getCurrentPage() ?? 1;
			$section = $this->getCurrentSection();
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			$limit = 12;
			$index = 'page=';
			$pagination = new Pagination($producersCount, $currentPage, $limit, $index); 
			$offset = ($currentPage - 1) * $limit;
			$producersList = $producersModel->getList($limit, $offset);
			include_once('./views/producers/index.php');
			return;
			
		}
		
		public function view($id) {
			$producersModel = new Producer();
			$producers = $producersModel->getProducerById($id);
			$title = $producers['producer'];
			$section = $this->getCurrentSection();
			$producerFilms = explode(', ', $producers['producer_films']);
			$filmIds = explode(', ', $producers['film_ids']);
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			include_once('./views/producers/view.php');
		}
		
		public function add() {
			$title = 'Добавить режиссера';
			$section = $this->getCurrentSection();
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			if (isset($_POST['producer_name'])) {
				$producer_name = htmlentities($_POST['producer_name']);
				$producer_surname = htmlentities($_POST['producer_surname']);
				
				$data = compact('producer_name', 'producer_surname');
				$producersModel = new Producer();
				
				$producersModel->addProducer($data);
				header('Location: ./list');
			}
			include_once('./views/producers/add.php');
		}
		
		public function dlt($id) {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			$producersModel = new Producer();
			$producersModel->deleteProducer($id);
			header('Location: ../list');
		}
		
		public function getCurrentPage() {
			$requestUri = $_SERVER['REQUEST_URI'];
			$uriParted = explode('/', $requestUri);
			$pageString = $uriParted[count($uriParted) - 1];
			$pageParted = explode('=', $pageString);
			$pageNumber = $pageParted[1] ?? 1;
			return $pageNumber;
		}
		
		public function getCurrentSection() {
			$requestUri = $_SERVER['REQUEST_URI'];
			$uriParted = explode('/', $requestUri);
			$section = $uriParted[count($uriParted) - 2];
			if (count($uriParted) > 5) {
				$section = $uriParted[count($uriParted) - 3];
			}
			return $section;
		}
	}
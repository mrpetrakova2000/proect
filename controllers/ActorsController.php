<?php
	
	class ActorsController {
		public function index() {
			$title = 'Актеры';
			$actorsModel = new Actor();
			$actorsCount = $actorsModel->calculateCount();
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
			$pagination = new Pagination($actorsCount, $currentPage, $limit, $index); 
			$offset = ($currentPage - 1) * $limit;
			$actorsList = $actorsModel->getList($limit, $offset);
			include_once('./views/actors/index.php');
			return;
			
		}
		
		public function view($id) {
			$actorsModel = new Actor();
			$section = $this->getCurrentSection();
			$actors = $actorsModel->getActorById($id);
			$title = $actors['actor'];
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			$actorFilms = explode(', ', $actors['actor_films']);
			$filmIds = explode(', ', $actors['film_ids']);
			include_once('./views/actors/view.php');
		}
		
		public function add() {
			$title = 'Добавить актера';
			$section = $this->getCurrentSection();
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			if (isset($_POST['actor_name'])) {
				$actor_name = htmlentities($_POST['actor_name']);
				$actor_surname = htmlentities($_POST['actor_surname']);
				$data = compact('actor_name', 'actor_surname');
				$actorsModel = new Actor();
				$actorsModel->addActor($data);
				
				header('Location: ./list');
			}
			include_once('./views/actors/add.php');
		}
		
		public function dlt($id) {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			$actorsModel = new Actor();
			$actorsModel->deleteActor($id);
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
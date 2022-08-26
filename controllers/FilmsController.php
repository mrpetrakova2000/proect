<?php

	class FilmsController {
		
		public function index() {
			$title = 'Фильмы';
			$filmsModel = new Film();
			$filmsCount = $filmsModel->calculateCount();
			$currentPage = $this->getCurrentPage() ?? 1;
			$section = $this->getCurrentSection();
			$limit = 12;
			$index = 'page=';
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			$pagination = new Pagination($filmsCount, $currentPage, $limit, $index); 
			$offset = ($currentPage - 1) * $limit;
			$filmsList = $filmsModel->getList($limit, $offset);
			include_once('./views/films/index.php');
			return;
		}
		
		public function edit($id) {
			$title = 'Редактировать фильм';
			$filmsModel = new Film();
			$film = $filmsModel->getFilmById($id);
			$producers = $filmsModel->getProducers();
			$section = $this->getCurrentSection();
			$actors = $filmsModel->getActors();
			$cast = $filmsModel->getCast($id);
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			$film_actor = explode(',', $cast['film_actors']);
			
			if (isset($_POST['film_name'])) {
				$film_name = htmlentities($_POST['film_name']);
				$film_producer_id = $_POST['film_producer_id'];
				$film_production_year = htmlentities($_POST['film_production_year']);
				$film_story = htmlentities($_POST['film_story']);

				$films = compact('film_name', 'film_producer_id', 'film_production_year', 'id', 'film_story');
				$actors = $_POST['actor'];
				$filmsModel->editFilm($films, $actors);
				header('Location: ../list');
			}
			include_once('./views/films/edit.php');
		}
		
		public function view($id) {
			$section = $this->getCurrentSection();
			$filmsModel = new Film();
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
				$isFavorite = $filmsModel->isFavorite($id, $user_id);
			}
			$films = $filmsModel->getFilmById($id);
			$title = $films['film_name'];
			$filmActor = explode(', ', $films['actor_initials']);
			$filmActorId = explode(', ', $films['actor_ids']);
			$filmMark = $filmsModel->getMark($id)['avg'];
			$mark = round($filmMark,1,PHP_ROUND_HALF_DOWN);
			$other = 5-$mark;
			
			include_once('./views/films/view.php');
		}
		
		public function add() {
			$title = 'Добавить фильм';
			$filmsModel = new Film();
			$producers = $filmsModel->getProducers();
			$actors = $filmsModel->getActors();
			$section = $this->getCurrentSection();
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			if (isset($_POST['film_name'])) {
				$film_name = htmlentities($_POST['film_name']);
				$film_producer_id = $_POST['film_producer_id'];
				$film_production_year = htmlentities($_POST['film_production_year']);
				$film_story = htmlentities($_POST['film_story']);

				$data = compact('film_name', 'film_producer_id', 'film_production_year', 'film_story');
				$actors = $_POST['actor'];
				$filmsModel->addFilm($data, $actors);
				
				header('Location: ./list');
			}
			include_once('./views/films/add.php');
		}
		
		public function dlt($id) {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			$filmsModel = new Film();
			$filmsModel->deleteFilm($id);
			header('Location: ../list');
		}
		
		public function actors($id) {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			$filmsModel = new Film();
			$info = $filmsModel->actorsInfo($id)[0];
			$title = $info['film_name'];
			$year = $info['film_production_year'];
			$filmActor = explode(', ', $info['actor_initials']);
			$filmActorId = explode(', ', $info['actor_ids']);
			$filmActorRoles = explode(', ', $info['actor_roles']);
			include_once('./views/films/actors.php');
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
<?php

	class PersonsController {
		
		public function index() {
			$title = 'Персонажи';
			$personsModel = new Person();
			$personsCount = $personsModel->calculateCount();
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			$currentPage = $this->getCurrentPage() ?? 1;
			$section = $this->getCurrentSection();
			$limit = 6;
			$index = 'page=';
			$pagination = new Pagination($personsCount, $currentPage, $limit, $index); 
			$offset = ($currentPage - 1) * $limit;
			$personsList = $personsModel->getList($limit, $offset);
			include_once('./views/persons/index.php');
			return;
			
		}
		
		public function edit($id) {
			$title = 'Редактировать персонажа';
			$personsModel = new Person();
			$persons = $personsModel->getPersonById($id);
			$actors = $personsModel->getActors();
			$section = $this->getCurrentSection();
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			
			if (isset($_POST['person_name'])) {
				$person_name = htmlentities($_POST['person_name']);
				$person_pseudo = htmlentities($_POST['person_pseudo']);
				$person_biography = htmlentities($_POST['person_biography']);
				$person_actor_id = $_POST['person_actor_id'];
				
				$persons = compact('person_name', 'person_pseudo', 'person_biography', 'person_actor_id', 'id');
				$personsModel->editPerson($persons);
				header('Location: ../list');
			}
			include_once('./views/persons/edit.php');
		}
		
		public function view($id) {
			$personsModel = new Person();
			$section = $this->getCurrentSection();
			$persons = $personsModel->getPersonById($id);
			$title = $persons['person_pseudo'];
			$personFilms = explode(', ', $persons['person_films']);
			$filmIds = explode(', ', $persons['film_ids']);
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			include_once('./views/persons/view.php');
		}
		
		public function add() {
			$title = 'Добавить персонажа';
			$personsModel = new Person();
			$actors = $personsModel->getActors();
			$section = $this->getCurrentSection();
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			if (isset($_POST['person_pseudo'])) {
				$person_name = htmlentities($_POST['person_name']);
				$person_pseudo = htmlentities($_POST['person_pseudo']);
				$person_biography = htmlentities($_POST['person_biography']);
				$person_actor_id = $_POST['person_actor_id'];
				
				$data = compact('person_name', 'person_pseudo', 'person_biography', 'person_actor_id');
				$personsModel->addPerson($data);
				
				header('Location: ./list');
			}
			include_once('./views/persons/add.php');
			
		}
		
		public function dlt($id) {
			$userModel = new User();
			$isAuthorized = $userModel->isAuthorized();
			if ($isAuthorized) {
				$user_id = $_COOKIE['user_id'];
				$user_name = $userModel->getName($user_id)[0]['user_name'];
			}
			$personsModel = new Person();
			$personsModel->deletePerson($id);
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
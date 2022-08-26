<?php

class FavoritesController {
	public function index() {
		$title = 'Избранное';
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
		$filmsList = $filmsModel->getFavList($limit, $offset, $user_id);
		
		include_once('./views/favorites/index.php');
	}
	
	public function fav($id) {
		$userModel = new User();
		$isAuthorized = $userModel->isAuthorized();
		if ($isAuthorized) {
			$user_id = $_COOKIE['user_id'];
			$user_name = $userModel->getName($user_id)[0]['user_name'];
		}
		$filmsModel = new Film();
		$filmsModel->addFavorite($id, $user_id);
		echo '<script>
				window.location.assign("../list");
				alert("Фильм успешно добавлен в избранное!");
			</script>';
	}
	
	public function notFav($id) {
		$userModel = new User();
		$isAuthorized = $userModel->isAuthorized();
		if ($isAuthorized) {
			$user_id = $_COOKIE['user_id'];
			$user_name = $userModel->getName($user_id)[0]['user_name'];
		}
		$filmsModel = new Film();
		$filmsModel->dltFavorite($id, $user_id);
		echo '<script>
				window.location.assign("../index.php");
				alert("Фильм успешно удален из избранного!");
			</script>';
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
?>
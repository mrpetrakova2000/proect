<?php

	class Film {
		
		public function getList($limit, $offset) {
			$connect = DB::getConnection();
			$what = array('film_id', 'film_name', 'film_producer'=>"GROUP_CONCAT(`producer_name`, ' ', `producer_surname` SEPARATOR ', ')", 'film_production_year', 'producer_id');
			$from = 'films';
			$joins = array('LEFT', 'producers', 'producer_id', 'film_producer_id');
			$where = '`film_is_deleted` = 0';
			$group = 'film_id';
			
			$query = (new Select($from))
						->what($what)
						->joins($joins)
						->where($where)
						->group($group)
						->limit($limit, $offset)
						->build();
			$res = mysqli_query($connect, $query);
			$filmsList = mysqli_fetch_all($res, MYSQLI_ASSOC);
			
			return $filmsList;
		}
		
		public function getActors() {
			$connect = DB::getConnection();
			
			$query = (new Select('actors'))
						->build();
			$res = mysqli_query($connect, $query);
			$actors = mysqli_fetch_all($res, MYSQLI_ASSOC);
			
			return $actors;
		}
		
		public function getCast($id) {
			$connect = DB::getConnection();
			$what = array('film_actors'=>"GROUP_CONCAT(`actor_id` SEPARATOR ', ')", 'count'=>"count(`actor_id`)");
			$from = 'cast';
			$joins = array('LEFT', 'actors', 'actor_id', 'cast_actor_id');
			$where = '`cast_film_id` = '.$id;
			$group = 'cast_film_id';
			$query = (new Select($from))
						->what($what)
						->joins($joins)
						->where($where)
						->group($group)
						->build();
			$res = mysqli_query($connect, $query);
			$cast = mysqli_fetch_assoc($res);
			
			return $cast;
		}
		
		public function getProducers() {
			$connect = DB::getConnection();
			
			$query = (new Select('producers'))
						->build();
			$res = mysqli_query($connect, $query);
			$producers = mysqli_fetch_all($res, MYSQLI_ASSOC);
			
			return $producers;
		}
		
		public function getFilmById($id) {
			$connect = DB::getConnection();
			
			$what = array('film_id', 'film_producer_id', 'film_name', 'film_story', 'film_producer'=>"CONCAT(`producer_name`, ' ', `producer_surname`)", 'film_production_year', 'actor_initials'=>"GROUP_CONCAT(`actor_name`, ' ', `actor_surname` SEPARATOR ', ')", 'actor_ids'=>"GROUP_CONCAT(`actor_id` SEPARATOR ', ')", 'producer_id');
			$from = 'films';
			$joins = array('LEFT', 'producers', 'producer_id', 'film_producer_id', 'LEFT', 'cast', 'film_id', 'cast_film_id', 'LEFT', 'actors', 'cast_actor_id', 'actor_id');
			$where = '`film_id` = '.$id;
			$group = 'film_id';
			
			$query = (new Select($from))
						->what($what)
						->joins($joins)
						->where($where)
						->build();
			$res = mysqli_query($connect, $query);
			$film = mysqli_fetch_assoc($res);
			
			return $film;
		}
		
		public function addFilm($data = [], $actors = []) {
			$connect = DB::getConnection();
			$into = 'films';
			$set = array('film_name', 'film_producer_id', 'film_production_year', 'film_story');
			$what = array($data['film_name'], $data['film_producer_id'], $data['film_production_year'], $data['film_story']);
			$query = (new Insert($into))
						->set($set)
						->what($what)
						->build();
			//echo $query;
			mysqli_query($connect, $query);
			
			$id = mysqli_insert_id($connect);
		//echo $id;
			
			for ($i = 0; $i < count($actors); $i++) {
				$into = 'cast';
				$set = array('cast_film_id', 'cast_actor_id');
				$what = array($id, $actors[$i]);
				$query = (new Insert($into))
							->set($set)
							->what($what)
							->build();
				echo $query;
				mysqli_query($connect, $query);
			}
			return;
		}
		
		public function editFilm($films = [], $actors = []) {
			$connect = DB::getConnection();
			$values = "`film_name` = '$films[film_name]',`film_producer_id` = '$films[film_producer_id]', `film_production_year` = '$films[film_production_year]',`film_story` = '$films[film_story]'";
			$where = '`film_id` = '.$films['id'];
			$query = (new Update('films'))
						->values($values)
						->where($where)
						->build();
						//echo $query;
			mysqli_query($connect, $query);
			
			
			$where = '`cast_film_id` = '.$films['id'];
			$query = (new Delete('cast'))
						->where($where)
						->build();
			//echo $query;
			mysqli_query($connect, $query);
			
			for ($i = 0; $i < count($actors); $i++) {
				$set = array('cast_film_id', 'cast_actor_id');
				$what = array($films['id'], $actors[$i]);
				
				$query = (new Insert('cast'))
							->set($set)
							->what($what)
							->build();
							
				mysqli_query($connect, $query);
			}			
			return;
		}
		
		public function deleteFilm($id) {
			$connect = DB::getConnection();
			
			$into = 'films';
			$set = 'film_is_deleted';
			$what = 1;
			$where = '`film_id` = '.$id;
			$query = (new Update($into))
						->values('`film_is_deleted` = 1')
						->where($where)
						->build();
			mysqli_query($connect, $query); 
		}
		
		public function calculateCount() {
			$connect = DB::getConnection();
			$what = array('count'=>'count(*)');
			$where = '`film_is_deleted` = 0';
			$query = (new Select('films'))
						->what($what)
						->where($where)
						->build();
			$res = mysqli_query($connect, $query);
			$count = mysqli_fetch_assoc($res)['count'];
			
			return $count;
		}
		
		public function isFavorite($film_id, $user_id) {
			$connect = DB::getConnection();
			/*$query = (new Select('favorites'))
						->what(array('favorites_id'))
						->where("`favorites_film_id` = $film_id AND `favorites_user_id` = $user_id")
						->build();*/
			$query = "SELECT COUNT(*) FROM `favorites` 
			WHERE `favorites_film_id` = $film_id AND `favorites_user_id` = $user_id";
			
			$res = mysqli_query($connect, $query)->fetch_array();
			$res = intval($res[0]);
			if ($res != 0) return true;
			else return false;
		}
		
		public function getFavList($limit, $offset, $user_id) {
			$connect = DB::getConnection();
			$what = array('film_id', 'film_name', 'film_producer'=>"GROUP_CONCAT(`producer_name`, ' ', `producer_surname` SEPARATOR ', ')", 'film_production_year', 'producer_id');
			$from = 'films';
			$joins = array('LEFT', 'producers', 'producer_id', 'film_producer_id', 'LEFT', 'favorites', 'favorites_film_id', 'film_id');
			$where = "`favorites_user_id` = ".$user_id;
			$group = 'film_id';
			
			$query = (new Select($from))
						->what($what)
						->joins($joins)
						->where($where)
						->group($group)
						->limit($limit, $offset)
						->build();
			$res = mysqli_query($connect, $query);
			$filmsList = mysqli_fetch_all($res, MYSQLI_ASSOC);
			
			return $filmsList;
		}
		
		public function addFavorite($film_id, $user_id) {
			$connect = DB::getConnection();
			$into = 'favorites';
			$set = array('favorites_film_id', 'favorites_user_id');
			$what = array($film_id, $user_id);
			$query = (new Insert($into))
						->set($set)
						->what($what)
						->build();
			mysqli_query($connect, $query);
		}
		
		public function dltFavorite($film_id, $user_id) {
			$connect = DB::getConnection();
			$query = "
					DELETE FROM `favorites`
					WHERE `favorites_film_id`=$film_id AND 
					`favorites_user_id`=$user_id";
			mysqli_query($connect, $query);
		}
		
		public function getMark($film_id) {
			$connect = DB::getConnection();
			$query = "SELECT AVG(`mark_value`) as avg FROM `marks` 
			WHERE `mark_film_id` = $film_id";
			
			$res = mysqli_query($connect, $query);
			$mark = mysqli_fetch_assoc($res);
			
			return $mark;
		}
		
		public function actorsInfo($id) {
			$connect = DB::getConnection();
			$what = array('film_id', 'film_name', 'film_production_year', 'actor_initials'=>"GROUP_CONCAT(`actor_name`, ' ', `actor_surname` SEPARATOR ', ')", 'actor_ids'=>"GROUP_CONCAT(`actor_id` SEPARATOR ', ')", 'actor_roles'=>"GROUP_CONCAT(`actor_person` SEPARATOR ', ')");
			$from = 'films';
			$joins = array('LEFT', 'cast', 'film_id', 'cast_film_id', 'LEFT', 'actors', 'cast_actor_id', 'actor_id');
			$where = '`film_id` = '.$id;
			
			$query = (new Select($from))
						->what($what)
						->joins($joins)
						->where($where)
						->build();
			$res = mysqli_query($connect, $query);
			$actorsInfo = mysqli_fetch_all($res, MYSQLI_ASSOC);
			
			return $actorsInfo;
		}
	}
<?php

	class Actor {
		
		public function getList($limit, $offset) {
			$connect = DB::getConnection();
			$what = array('actor_id', "actor"=>"CONCAT(`actor_name`, ' ', `actor_surname`)");
			$query = (new Select('actors'))
						->what($what)
						->where('`actor_is_deleted` = 0')
						->group('actor_id')
						->limit($limit, $offset)
						->build();
			$res = mysqli_query($connect, $query);
			$actorsList = mysqli_fetch_all($res, MYSQLI_ASSOC);
			
			return $actorsList;
		}
		
		
		public function getActorById($id) {
			$connect = DB::getConnection();
			
			$what = array('actor_id', 'actor'=>"CONCAT(`actor_name`, ' ', `actor_surname`)", 'actor_films'=>"GROUP_CONCAT(`film_name` SEPARATOR ', ')", 'film_ids'=>"GROUP_CONCAT(`film_id` SEPARATOR ', ')");
			$from = 'actors';
			$joins = array('LEFT', 'cast', 'actor_id', 'cast_actor_id', 'LEFT', 'films', 'film_id', 'cast_film_id');
			$where = '`actor_id` = '.$id;
			$group = 'actor_id';
			
			$query = (new Select($from))
						->what($what)
						->joins($joins)
						->where($where)
						->group($group)
						->build();
			
			//echo $query;
			$res = mysqli_query($connect, $query);
			$actor = mysqli_fetch_assoc($res);
			
			return $actor;
		}
		
		public function addActor($data = []) {
			$connect = DB::getConnection();
			$into = 'actors';
			$set = array('actor_name', 'actor_surname');
			$what = array($data['actor_name'], $data['actor_surname']);
			
			$query = (new Insert($into))
						->set($set)
						->what($what)
						->build();
						
			mysqli_query($connect, $query);
			
			return;
		}
		
		public function deleteActor($id) {
			$connect = DB::getConnection();
			
			$into = 'actors';
			$set = 'actor_is_deleted';
			$what = 1;
			$where = '`actor_id` = '.$id;
			$query = (new Update($into))
						->values('`actor_is_deleted` = 1')
						->where($where)
						->build();
			mysqli_query($connect, $query); 
		}
		
		public function calculateCount() {
			$connect = DB::getConnection();
			
			$what = array('count'=>'count(*)');
			$from = 'actors';
			
			$query = (new Select($from))
						->what($what)
						->build();
			$res = mysqli_query($connect, $query);
			$count = mysqli_fetch_assoc($res)['count'];
			
			return $count;
		}
	}
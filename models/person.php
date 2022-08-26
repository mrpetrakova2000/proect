<?php

	class Person {
		
		public function getList($limit, $offset) {
			$connect = DB::getConnection();
			
			$what = array('person_id', 'person_name', 'person_pseudo', 'person_biography');
			$from = 'persons';
			$where = '`person_is_deleted` = 0';

			$query = (new Select($from))
						->what($what)
						->where($where)
						->limit($limit, $offset)
						->build();
			$res = mysqli_query($connect, $query);
			$personsList = mysqli_fetch_all($res, MYSQLI_ASSOC);
			
			return $personsList;
		}
		
		public function getActors() {
			$connect = DB::getConnection();
			
			$query = (new Select('actors'))
						->build();
			$res = mysqli_query($connect, $query);
			$actors = mysqli_fetch_all($res, MYSQLI_ASSOC);
			
			return $actors;
		}
		
		public function getPersonById($id) {
			$connect = DB::getConnection();
			
			$what = array('person_id', 'person_actor_id', 'person_pseudo', 'person_name', 'person_biography', 'person_actor'=>"CONCAT(`actor_name`, ' ', `actor_surname`)", 'person_films'=>"GROUP_CONCAT(`film_name`, ' ', '(', `film_production_year`, ')' SEPARATOR ', ')", 'film_ids'=>"GROUP_CONCAT(`film_id` SEPARATOR ', ')");
			$from = 'persons';
			$joins = array('LEFT', 'actors', 'person_actor_id', 'actor_id', 'LEFT', 'cast', 'actor_id', 'cast_actor_id', 'LEFT', 'films', 'cast_film_id', 'film_id');
			$where = '`person_id` = '.$id;
			
			$query = (new Select($from))
						->what($what)
						->joins($joins)
						->where($where)
						->build();
			$res = mysqli_query($connect, $query);
			$person = mysqli_fetch_assoc($res);
			
			return $person;
		}
		
		public function addPerson($data = []) {
			$connect = DB::getConnection();
			
			$into = 'persons';
			$set = array('person_pseudo', 'person_name', 'person_biography', 'person_actor_id');
			$what = array($data['person_pseudo'], $data['person_name'], $data['person_biography'], $data['person_actor_id']);
			
			$query = (new Insert($into))
						->set($set)
						->what($what)
						->build();
			mysqli_query($connect, $query);
			
			return;
		}
		
		public function editPerson($persons = []) {
			$connect = DB::getConnection();
			$where = '`person_id` = '.$persons['id'];
			$values = "`person_name` = '$persons[person_name]', `person_pseudo` = '$persons[person_pseudo]',`person_biography` = '$persons[person_biography]',`person_actor_id` = $persons[person_actor_id]";
			$query = (new Update('persons'))
						->values($values)
						->where($where)
						->build();
			mysqli_query($connect, $query);
			
			return;
		}
		
		public function deletePerson($id) {
			$connect = DB::getConnection();
			
			$into = 'persons';
			$set = 'person_is_deleted';
			$what = 1;
			$where = '`person_id` = '.$id;
			$query = (new Update($into))
						->values('`person_is_deleted` = 1')
						->where($where)
						->build();
			mysqli_query($connect, $query); 
		}
		
		
		public function calculateCount() {
			$connect = DB::getConnection();
			
			$what = array('count'=>'count(*)');
			$from = 'persons';
			
			$query = (new Select($from))
						->what($what)
						->build();
			$res = mysqli_query($connect, $query);
			$count = mysqli_fetch_assoc($res)['count'];
			
			return $count;
		}
	}
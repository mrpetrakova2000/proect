<?php

	class Producer {
		
		public function getList($limit, $offset) {
			$connect = DB::getConnection();
			$what = array('producer_id', "producer"=>"CONCAT(`producer_name`, ' ', `producer_surname`)");
			$query = (new Select('producers'))
						->what($what)
						->where('`producer_is_deleted` = 0')
						->group('producer_id')
						->limit($limit, $offset)
						->build();
			$res = mysqli_query($connect, $query);
			$producersList = mysqli_fetch_all($res, MYSQLI_ASSOC);
			
			return $producersList;
		}
		
		
		public function getProducerById($id) {
			$connect = DB::getConnection();
			
			$what = array('producer_id', 'producer'=>"CONCAT(`producer_name`, ' ', `producer_surname`)", 'producer_films'=>"GROUP_CONCAT(`film_name` SEPARATOR ', ')", 'film_ids'=>"GROUP_CONCAT(`film_id` SEPARATOR ', ')");
			$from = 'producers';
			$joins = array('LEFT', 'films', 'producer_id', 'film_producer_id');
			$where = '`producer_id` = '.$id;
			$group = 'producer_id';
			
			$query = (new Select($from))
						->what($what)
						->joins($joins)
						->where($where)
						->group($group)
						->build();
						
			$res = mysqli_query($connect, $query);
			$producer = mysqli_fetch_assoc($res);
			
			return $producer;
		}
		
		public function addProducer($data = []) {
			$connect = DB::getConnection();
			
			$into = 'producers';
			$set = array('producer_name', 'producer_surname');
			$what = array($data['producer_name'], $data['producer_surname']);
			
			$query = (new Insert($into))
						->set($set)
						->what($what)
						->build();
			mysqli_query($connect, $query);
			return;
		}
		
		public function deleteProducer($id) {
			$connect = DB::getConnection();
			
			$into = 'producers';
			$set = 'producer_is_deleted';
			$what = 1;
			$where = '`producer_id` = '.$id;
			$query = (new Update($into))
						->values('`producer_is_deleted` = 1')
						->where($where)
						->build();
			mysqli_query($connect, $query);
		}
		
		public function calculateCount() {
			$connect = DB::getConnection();
			
			$what = array('count'=>'count(*)');
			$from = 'producers';
			
			$query = (new Select($from))
						->what($what)
						->build();
					
			$res = mysqli_query($connect, $query);
			$count = mysqli_fetch_assoc($res)['count'];
			
			return $count;
		}
	}
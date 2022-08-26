<?php


	class Select {

		private $from;
		private $what = '*';
		private $joins; 
		private $where;
		private $having;
		private $group;
		private $limit = "";
		private $sort; 

		public function __construct($from) {
			$this->from = $from; 
			return $this;
		}

		public function what($data = []) {

			$what = '';
			if (!empty($data)) {
				foreach ($data as $key => $value) {
					if (is_string($key)) {
						$what .= " $value AS `$key`, ";
					} else {
						$what .= " `$value`, ";
					}
				}
			}
			$what = rtrim($what, ', ');
			$this->what = $what;
			return $this;
		}

		public function limit($limit, $offset = 0) {
			$this->limit = "LIMIT $offset, $limit";
			return $this;
		}

		
		public function joins($data = []) {
			$joins = '';
			$a = 0;
			$b = 1;
			$c = 2;
			$d = 3;
			while ($a<count($data)){
				$joins .= "$data[$a] JOIN `$data[$b]` ON `$data[$c]` = `$data[$d]`";
				$a = $a + 4;
				$b = $b + 4;
				$c = $c + 4;
				$d = $d + 4;
			}
			$this->joins = $joins;
			return $this;
		}
		
		public function group($group) {
			$this->group = "GROUP BY `$group`";
			return $this;
		}
		
		public function where($condition) {
			$where = '';
			$where .= 'WHERE 1 AND ';
			$where .= $condition;
			$this->where = $where;
			return $this;
		}
		
		public function build() {
			return "
				SELECT $this->what
				FROM `$this->from`
				$this->joins
				$this->where
				$this->group
				$this->limit;
			";
		}
	}
<?php
	class Update {
		private $into;
		private $set;
		private $what;
		private $where;
		private $values;
		
		
		public function __construct($into) {
			$this->into = $into;
			return $this;
		}
		
		public function set($data = []) {
			$set = [];
			foreach ($data as $key) {
				$set[] = $key;
			}
			$this->set = $set;
			return $this;
		}
		
		public function what($data = []) {
			$what = [];
			foreach ($data as $key) {
				$what[] = $key;
			}
			$this->what = $what;
			return $this;
		}
		
		public function values($condition) {
			$values = '';
			$values .= $condition;
			$this->values = $values;
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
				UPDATE `$this->into` 
				SET $this->values
				$this->where;
			";
		}
	}
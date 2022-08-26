<?php

	class Delete {
		private $from;
		private $where;
		
		public function __construct($from) {
			$this->from = $from;
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
				DELETE 
				FROM `$this->from` 
				$this->where;
			";
		}
	}
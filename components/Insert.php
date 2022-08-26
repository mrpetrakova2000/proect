<?php
	class Insert {
		private $into;
		private $set;
		private $what;
		
		public function __construct($into) {
			$this->into = $into;
			return $this;
		}
		
		public function set($data = []) {
			$set = '';
			foreach ($data as $key) {
				$set .= '`' . $key . '`' . ', ';
			}
			$set = rtrim($set, ', ');
			$this->set = $set;
			return $this;
		}
		
		public function what($data = []) {
			$what = '';
			foreach ($data as $key) {
				$what .= "'" . $key . "'" . ', ';
			}
			$what = rtrim($what, ', ');
			$this->what = $what;
			return $this;
		}
		
		public function build() {
			return "
				INSERT INTO `$this->into` 
				($this->set) VALUES ($this->what);
			";
		}
	}
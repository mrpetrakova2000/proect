<?php
	
	class Router {
		private $routes;
		
		public function __construct() {
			include_once('./config/routes.php');
			$this->routes = $routes;
		}
		
		public function run() {
			$userUrl = $_SERVER['REQUEST_URI'];
			//echo $userUrl;
			foreach ($this->routes as $controller => $patterns) {
				foreach ($patterns as $pattern => $action) {
					$pattern = ROOT . $pattern;
					if (preg_match("~$pattern~", $userUrl, $matches)) {
						//echo $userUrl;
						$id = isset($matches[1]) ? $matches[1] : '';
						$controllerObj = new $controller();
						if ($id) {
							$controllerObj->$action($id);
						} else {
							$controllerObj->$action();
						}
						exit();
					}
				}
			}
			echo '404 - Page not found!';
			exit();
		}
	}
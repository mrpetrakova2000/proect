<?php

	spl_autoload_register(function($className) {
		$dirs = array('components', 'controllers', 'models');
		foreach ($dirs as $dir) {
			$filePath = "./$dir/$className.php";
			if (file_exists($filePath)) {
				include_once($filePath);
				break;
			}
		}
	});

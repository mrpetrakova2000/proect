<?php

	$routes = array(
		"FilmsController" => array (
			"films/list" => "index",
			"films/view/([0-9]+)" => "view",
			"films/actors/([0-9]+)" => "actors",
		),
		
		"FilmsProxyController" => array (
			"films/add" => "add",
			"films/edit/([0-9]+)" => "edit",
			"films/dlt/([0-9]+)" => "dlt"
		), 
		
		"ProducersController" => array (
			"producers/list" => "index",
			"producers/view/([0-9]+)" => "view"
		),
		
		"ProducersProxyController" => array (
			"producers/add" => "add",
			"producers/edit/([0-9]+)" => "edit",
			"producers/dlt/([0-9]+)" => "dlt"
		), 
		
		"ActorsController" => array (
			"actors/list" => "index",
			"actors/view/([0-9]+)" => "view"
		),
		
		"ActorsProxyController" => array (
			"actors/add" => "add",
			"actors/edit/([0-9]+)" => "edit",
			"actors/dlt/([0-9]+)" => "dlt"
		), 
		
		"PersonsController" => array (
			"persons/list" => "index",
			"persons/view/([0-9]+)" => "view"
		),
		
		"PersonsProxyController" => array (
			"persons/add" => "add",
			"persons/edit/([0-9]+)" => "edit",
			"persons/dlt/([0-9]+)" => "dlt"
		), 
		
		"UsersController" => array (
			"users/register" => "register", 
			"users/auth" => "auth",
			"users/logout" => "logout"
		),
		
		"FavoritesController" => array (
			"favorites/index" => "index",
			"films/fav/([0-9]+)" => "fav",
			"favorites/notFav/([0-9]+)" => "notFav"
		)			
	);
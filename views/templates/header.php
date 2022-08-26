<!DOCTYPE HTML>
<html>
	<head>
		<meta charset='utf-8'>
		<link rel="SHORTCUT ICON" href="<?= IMG; ?>favicon.ico" type="image/gif">
		<link rel='stylesheet' href='<?= LIBS; ?>bootstrap/js/jquery.min.js'>
		<link rel='stylesheet' href='<?= LIBS; ?>bootstrap/css/bootstrap.css'>
		<link rel='stylesheet' href='<?= LIBS; ?>bootstrap/js/bootstrap.js'>
		<link rel='stylesheet' href='<?= CSS; ?>styles.css'>
		<title> <?= $title ?> </title>
	</head>
	
	<body>
		<nav class="navbar navbar-expand-lg">
		  <img src='<?= IMG; ?>head.jpg'>
		  <?php if ($isAuthorized): ?>
		  
		  <span class="nav navbar-nav ml-auto nav-item dropdown" style="margin-right:100px;">
			<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><?= $user_name; ?></a>
			<span class="dropdown-menu" >
			  <a class="dropdown-item <?= ($section == 'favorites') ? 'active': '';?>" href="<?= ROOT;?>favorites/index">Избранное</a>
			  <a class="dropdown-item" href="#">Мой профиль</a>
			</span>
		  </span>
		  <?php endif; ?>
		  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
			  <a class="nav-item nav-link no-padding <?= ($section == 'films') ? 'active': '';?>" href="<?= ROOT;?>films/list"> Фильмы </a>
			  <a class="nav-item nav-link no-padding <?= ($section == 'producers') ? 'active': '';?> " href="<?= ROOT;?>producers/list"> Режиссёры </a>
			  <a class="nav-item nav-link no-padding <?= ($section == 'actors') ? 'active': '';?>" href="<?= ROOT;?>actors/list"> Актёры </a>
			  <a class="nav-item nav-link no-padding <?= ($section == 'persons') ? 'active': '';?>" href="<?= ROOT;?>persons/list"> Персонажи </a>
			  <?php if (!($isAuthorized)): ?>
				<a class="nav-item nav-link no-padding <?= ($section == 'auth') ? 'active': '';?>" href="<?= ROOT;?>users/auth"> Авторизация </a>
				<a class="nav-item nav-link no-padding <?= ($section == 'register') ? 'active': '';?>" href="<?= ROOT;?>users/register"> Регистрация </a>
			  <?php else: ?>
				<a class="nav-item nav-link no-padding" href="<?= ROOT;?>users/logout"> Выход </a>
			  <?php endif; ?>
			  
			</div> 
		  </div>
		</nav>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

	<div class='container'>
	
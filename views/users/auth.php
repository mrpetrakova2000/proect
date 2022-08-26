<?php include_once('./views/templates/header.php'); ?>

	<h1> Авторизация </h1>
	<form method = "POST">
		<form>
		  <div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" name='email' >
		  </div>
		  <div class="form-group">
			<label>Пароль</label>
			<input type="password" name='password' class="form-control">
		  </div>
		  <button type="submit" class="btn btn-primary">Войти</button>
		</form>
		
	</form>
	
<?php include_once('./views/templates/footer.php'); ?>
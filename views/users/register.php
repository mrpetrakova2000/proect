<?php include_once('./views/templates/header.php'); ?>

	<h1> Регистрация </h1>
	<form method = "POST">
		<form>
		  <div class="form-group">
			<label>Имя</label>
			<input type="text" name='name' class="form-control">
		  </div>
		  <div class="form-group">
			<label>Фамилия</label>
			<input type="text" name='surname' class="form-control">
		  </div>
		  <div class="form-group">
			<label>Login</label>
			<input type="text" name='login' class="form-control">
		  </div>
		  <div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" name='email' >
		  </div>
		  <div class="form-group">
			<label>Пароль</label>
			<input type="password" name='password' class="form-control">
		  </div>
		  <div class="form-group">
			<label>Повторите пароль</label>
			<input type="password" name='repeatPassword' class="form-control">
		  </div>
		  <button type="submit" class="btn btn-primary">Сохранить</button>
		</form>
		
	</form>
	
<?php include_once('./views/templates/footer.php'); ?>
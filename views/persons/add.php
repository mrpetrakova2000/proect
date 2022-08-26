<?php include_once('./views/templates/header.php'); ?>
	<h1> Добавить персонажа: </h1>
	<form method = "POST">
		<form>
		  <div class="form-group">
			<label>Супергеройское имя, псевдоним (если есть)</label>
			<input type="text" name='person_pseudo' class="form-control">
		  </div>
		  <div class="form-group">
			<label>Полное имя (если есть)</label>
			<input type="text" name='person_name' class="form-control">
		  </div>
		  <div class="form-group">
			<label>Исполнитель роли в КВМ</label>
			<select class="custom-select" size="10" name='person_actor_id'>
				<?php foreach ($actors as $actor): ?>
					<option value="<?= $actor['actor_id'] ?>"> 
					<?=$actor['actor_name'] . ' ' . $actor['actor_surname']?></option>
				<?php endforeach; ?>
			</select> <br>
		  </div>
		  <div class="form-group">
			<label for="exampleFormControlTextarea1">Биография</label>
			<textarea class="form-control" name='person_biography'> </textarea>
		  </div>
		  <button type="submit" class="btn btn-primary">Отправить</button>
		</form>
	</form>
<?php include_once('./views/templates/footer.php'); ?>
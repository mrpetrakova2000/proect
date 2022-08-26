<?php include_once('./views/templates/header.php'); ?>

	<h1> Редактировать персонажа: </h1>
	
	<form method = "POST">
		
		<form>
		  <div class="form-group">
			<label>Супергеройское имя, псевдоним (если есть)</label>
			<input type="text" value='<?= $persons['person_pseudo'];?>' name='person_pseudo' class="form-control">
		  </div>
		  <div class="form-group">
			<label>Полное имя (если есть)</label>
			<input type="text" value='<?= $persons['person_name'];?>' name='person_name' class="form-control">
		  </div>
		  <div class="form-group">
			<label>Исполнитель роли в КВМ</label>
			<select class="custom-select" size="10" name='person_actor_id'>
				<?php foreach ($actors as $actor): ?>
					<option value="<?= $actor['actor_id'] ?>" <?= ($persons['person_actor_id'] == $actor['actor_id']) ? 'selected' : ''?>>
				<?= $actor['actor_name'] . ' ' . $actor['actor_surname']?></option>
				<?php endforeach; ?>
			</select> 
			
		  </div>
		  <div class="form-group">
			<label for="exampleFormControlTextarea1">Биография</label>
			<textarea class="form-control" style='min-height:250px;' name='person_biography'> <?= $persons['person_biography'];?></textarea>
		  </div>
		  <button type="submit" class="btn btn-primary">Сохранить</button>
		  <button class="btn btn-primary"><a href='<?=ROOT?>persons/view/<?=$id?>'>Отмена</a></button>
		</form>
		
	</form>
	
	
<?php include_once('./views/templates/footer.php'); ?>
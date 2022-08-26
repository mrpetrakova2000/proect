<?php include_once('./views/templates/header.php'); ?>

	<h1> Редактировать фильм: </h1>
	
	<form method = "POST">
		
		<form>
		  <div class="form-group">
			<label>Название</label>
			<input type="text" value='<?= $film['film_name'];?>' name='film_name' class="form-control">
		  </div>
		  <div class="form-group">
			<label>Режиссер</label>
			<select class="custom-select" size="10" name='film_producer_id'>
			<?php foreach ($producers as $producer) : ?>
				<option value="<?= $producer['producer_id'] ?>" <?= ($film['film_producer_id'] == $producer['producer_id']) ? 'selected' : ''?>>
				<?= $producer['producer_name'] . ' ' . $producer['producer_surname']?></option>
			<?php endforeach; ?>
			</select> <br>
		  </div>
		  
		  <div class="form-group">
			<label>Год создания</label>
			<input type="text" name='film_production_year' value='<?= $film['film_production_year'];?>' class="form-control">
		  </div>
		  
		  <div class="form-group">
			<label>Актерский состав</label>
		    <select class="custom-select" multiple size='10' name='actor[]'>
					<?php foreach ($actors as $actor): ?>
						<option value="<?=$actor['actor_id']?>" <?= in_array($actor['actor_id'], $film_actor) ? 'selected' : ''?> >
							<?=$actor['actor_name'] . ' ' . $actor['actor_surname']?>
						</option>
					<?php endforeach; ?>
			</select>
		  </div>
		  <div class="form-group">
			<label for="exampleFormControlTextarea1">Сюжет</label>
			<textarea class="form-control" style='min-height: 250px;' id="exampleFormControlTextarea1" rows="3" name='film_story' ><?= $film['film_story']?></textarea>
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Сохранить</button>
		  <button class="btn btn-primary"><a href='<?=ROOT?>films/view/<?=$id?>'>Отмена</a></button>
		</form>
		
	</form>
	
	
<?php include_once('./views/templates/footer.php'); ?>
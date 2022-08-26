<?php include_once('./views/templates/header.php'); ?>

	<h1> Фильмы: </h1>
	<?php if ($isAuthorized): ?>
		<div class='row' >
			<a class = 'btn btn-primary' style="margin:30px; padding:15px; background-color:red; border:1px solid red; font-size:20px;" href='<?=ROOT;?>films/add'>Добавить</a>
		</div>
	<?php endif;?>
	<div class='row'>
	<?php foreach ($filmsList as $film): ?>

		<div class='col-xs-12 col-md-6 col-lg-4'>
			
			<div class="card mb-3" style="max-width: 550px;">
			  <div class="row no-gutters">
				<div>
				  <img src="<?= IMG; ?>films/f.<?= $film['film_id'];?>.jpg" class="card-img" style='object-fit: cover; width: 250px; height: 360px;'>
				</div>
				<div>
				  <div class="card-body">
					<h5 class="card-title"><?= $film['film_name'];?>
					<?php if ($isAuthorized): ?>
						<?php if (!($filmsModel->isFavorite($film['film_id'], $user_id))): ?>
							<a href='<?=ROOT;?>films/fav/<?= $film['film_id'];?>' class='btn btn-link'> <img src='<?= IMG; ?>heart_empty.png' class="like"> </a></h5> 
						<?php else: ?>
							<a href='<?=ROOT;?>favorites/notFav/<?= $film['film_id'];?>' class='btn btn-link'> <img src='<?= IMG; ?>heart_filled.png' class="like"> </a></h5> 
						<?php endif;?>
					<?php endif; ?>
					<h6><a class="card-subtitle text-muted" href='<?=ROOT;?>producers/view/<?= $film['producer_id'];?>'><?= $film['film_producer'];?></h5>
					<a href='<?=ROOT;?>films/view/<?= $film['film_id'];?>' class='btn btn-link'> Подробнее... </a>
					<?php if ($isAuthorized): ?>
						<a href='<?=ROOT;?>films/edit/<?= $film['film_id'];?>' class='btn btn-link'> Редактировать </a>
						<button type="button" class="btn btn-link" onclick='dlt_item(event)' data-id='<?= $film['film_id'] ?>'> Удалить </button>
						
					<?php endif; ?>
				  </div>
				</div>
			  </div>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
	<div class='row'>
		<?= $pagination->get();?>
	</div>
<?php include_once('./views/templates/footer.php'); ?>

<script>
	function dlt_item(e) {
		if (confirm('Вы действительно хотите удалить данные?')) {
			var film_id = e.target.dataset.id;
			window.location = '<?php echo ROOT; ?>films/dlt/' + film_id;
		} else {
			return false;
		}
	}
	
</script>
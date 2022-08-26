<?php include_once('./views/templates/header.php'); ?>

<h1>Избранное</h1>
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
					<h5 class="card-title"><?= $film['film_name'];?></h5>
					<h6><a class="card-subtitle text-muted" href='<?=ROOT;?>producers/view/<?= $film['producer_id'];?>'><?= $film['film_producer'];?></h5>
					<a href='<?=ROOT;?>films/view/<?= $film['film_id'];?>' class='btn btn-link'> Подробнее... </a>
					<button type="button" class="btn btn-link" data-id='<?= $film['film_id'] ?>'> Удалить из избранного </button>
				  </div>
				</div>
			  </div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
	
<?php include_once('./views/templates/footer.php'); ?>
<?php include_once('./views/templates/header.php'); ?>

	<h1> <?= $title?> (<?= $year;?>) </h1>
	
	
	<p class="card-text"><b>Актеры:</b></p>
	<?php for ($i=0;$i<count($filmActor);$i++): ?>
	<div class='card mb-2'>
		<div class="row">
			<div class="col-md-2">
				<img style='object-fit: cover; width: 150px; height: 150px; margin: 20px;' src="<?= IMG; ?>actors/a.<?= $filmActorId[$i];?>.jpg">
			</div>
			<div class="card-body" style="margin-top:20px;">
				<a class='btn-link' href='<?=ROOT;?>actors/view/<?= $filmActorId[$i];?>' ><?= $filmActor[$i]?></a>
				<p><i><?= $filmActorRoles[$i]; ?> </i></p>
			</div>
		</div>
	</div>
	<?php endfor; ?>
	
	
	
<?php include_once('./views/templates/footer.php'); ?>

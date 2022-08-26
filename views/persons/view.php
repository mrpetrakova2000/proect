<?php include_once('./views/templates/header.php'); ?>

	<h1> <?= $persons['person_pseudo'];?> </h1>
	
	<div class="card mb-10">
		 <div class="row no-gutters">
			<div class="col-md-3">
				<img class="class-img-top" src="<?= IMG; ?>persons/p.<?= $persons['person_id'];?>.jpg">
			</div>
			<div class='col-md-7'>
				<div class="card-body">
					<h6> Полное имя: </h6>
					<p class="card-text"><?= $persons['person_name'];?></p>
					<h6> Исполнитель роли: </h6>
					<p class="card-text"><a class='btn-link' href='<?=ROOT;?>actors/view/<?= $persons['person_actor_id']?>'><?= $persons['person_actor'];?></a></p>
					<h6> Биография: </h6>
					<p class="card-text"><?= $persons['person_biography'];?></p>
					<h6> Фильмография героя: </h6>
					<ul style='padding-left:10px'>
					<?php for ($i=0;$i<count($personFilms);$i++): ?>
						<li style='list-style-type:circle'><a class='btn-link' href='<?=ROOT;?>films/view/<?= $filmIds[$i]?>'> <?= $personFilms[$i]?> </a></li>
					<?php endfor; ?> 
					
				</div>
			</div>
			<?php if ($isAuthorized): ?>
			<a href='<?=ROOT;?>persons/edit/<?= $persons['person_id'];?>' class='btn btn-link'> Редактировать </a>
			<?php endif;?>
		</div>
	</div>
	
<?php include_once('./views/templates/footer.php'); ?>
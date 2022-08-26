<?php include_once('./views/templates/header.php'); ?>

	<h1> <?= $producers['producer'];?> </h1>
	
	<div class="card mb-3">
		 <div class="row no-gutters">
			<div class="col-md-4">
				<img class="class-img-top" style='object-fit: cover; width: 250px; height: 250px;' src="<?= IMG; ?>producers/p.<?= $producers['producer_id'];?>.jpg">
			</div>
			<div>
				<div class="card-body">
					<h5 class="card-title">Режиссер</h5>
					<h6> Фильмография: </h6>
					<ul style='padding-left:10px'>
					<?php for ($i=0;$i<count($producerFilms);$i++): ?>
						<li style='list-style-type:circle'><a class='btn-link' href='<?=ROOT;?>films/view/<?= $filmIds[$i]?>'> <?= $producerFilms[$i]?> </a></li>
					<?php endfor; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
<?php include_once('./views/templates/footer.php'); ?>
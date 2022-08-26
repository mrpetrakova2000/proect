<?php include_once('./views/templates/header.php'); ?>

	<h1> <?= $films['film_name']?> (<?= $films['film_production_year'];?>) 
		<?php if ($isAuthorized): ?>
			<a href='<?=ROOT;?>films/edit/<?= $films['film_id'];?>' class='btn btn-link' style="float:right"> Редактировать </a>
			<?php if (!($isFavorite)): ?>
				<a href='<?=ROOT;?>films/fav/<?= $films['film_id'];?>' class='btn btn-link'> <img src='<?= IMG; ?>heart_empty.png'> </a>
			<?php else: ?>
				<a href='<?=ROOT;?>favorites/notFav/<?= $films['film_id'];?>' class='btn btn-link'> <img src='<?= IMG; ?>heart_filled.png' class="like"> </a>
			<?php endif;?>
		<?php endif;?>		
	</h1>
	
	<div class="card mb-7">
		 <div class="row no-gutters">
			<div class="col-md-3">
				<img class="class-img-top" src="<?= IMG; ?>films/f.<?= $films['film_id'];?>.jpg" style='width: 250px; height: 360px;'>
			</div>
			<div class='col-md-9'>
				<div class="card-body">
					<p class="card-text"><b>Режиссер: </b><a class='btn-link' href='<?=ROOT;?>producers/view/<?= $films['producer_id'];?>'> <?= $films['film_producer'];?></a></p>
					<div style="float:right; margin-left:40px;">
						<p class="card-text"><b>Актеры:</b></p>
						<ul style='padding-left:10px'>
						<?php for ($i=0;$i<count($filmActor) and $i<5;$i++): ?>
							<li style='list-style-type:circle'><a class='btn-link' href='<?=ROOT;?>actors/view/<?= $filmActorId[$i];?>' ><?= $filmActor[$i]?></a></li>
						<?php endfor; ?>
						</ul>
						<a href='<?=ROOT;?>films/actors/<?= $films['film_id'];?>' class='btn btn-link'> Смотреть всех актеров </a>
					</div>
					
					<p class="card-text"><?= $films['film_story'] ?></p>
					<!--<p class="card-text"><b>Оценка: </b><?=$mark; ?> 
						<?php for ($i=1;$i<=$mark;$i++) : ?>
							<img src='<?= IMG; ?>star_yellow.png' style="margin:2px;">
						<?php endfor; ?>
						<?php if ($mark < 5): ?>
							<?php if ($mark - intval($mark) >= 0.5): ?>
								<img src='<?= IMG; ?>star_half.png' style="margin:2px;">
							<?php endif; ?>
							<?php if (2*$mark - intval($mark) < 5): ?>
								<?php for ($i=0;$i<$other-0.5;$i++): ?>
									<img src='<?= IMG; ?>star.png' style="margin:2px;">
								<?php endfor; ?>
							<?php endif; ?>
						<?php endif; ?>
					</p>-->
					<!--<?php if ($isAuthorized): ?>
						<a href='#' class='btn btn-link'> Оставить оценку </a>
					<?php endif; ?>-->
				</div>
			</div>
		</div>
	</div>
	
<?php include_once('./views/templates/footer.php'); ?>

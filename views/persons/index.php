<?php include_once('./views/templates/header.php'); ?>

	<h1> Персонажи: </h1>
	<?php if ($isAuthorized): ?>
		<div class='row'>
			<a class = 'btn btn-primary' style="margin:30px; padding:15px; background-color:red; border:1px solid red; font-size:20px;" href='<?=ROOT;?>persons/add'>Добавить</a>
		</div>
	<?php endif;?>
	<div class='row'>
	<?php foreach ($personsList as $person): ?>
	
		<div class='col-xs-12 col-md-6 col-lg-4'>
			
			<div class="card mb-3" style="max-width: 540px;">
			  <div class="row no-gutters">
				<div>
					<img class="class-img-top" src="<?= IMG; ?>persons/p.<?= $person['person_id'];?>.jpg">
				</div>
				<div>
				  <div class="card-body">
					<h5 class="card-title"><?= $person['person_pseudo'];?></h5>
					<h6 class="card-subtitle text-muted"><?= $person['person_name'];?></h5>
					<a href='<?=ROOT;?>persons/view/<?= $person['person_id'];?>' class='btn btn-link'> Подробнее... </a>
					<?php if ($isAuthorized): ?>
						<a href='<?=ROOT;?>persons/edit/<?= $person['person_id'];?>' class='btn btn-link'> Редактировать </a>
						<button type="button" class="btn btn-link" onclick='dlt_item(event)' data-id='<?= $person['person_id'] ?>'> Удалить </button>
					<?php endif;?>
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
			var person_id = e.target.dataset.id;
			window.location = '<?php echo ROOT; ?>persons/dlt/' + person_id;
		} else {
			return false;
		}
	}
</script>
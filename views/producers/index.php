<?php include_once('./views/templates/header.php'); ?>

	<h1> Режиссеры: </h1>
	<?php if ($isAuthorized): ?>
		<div class='row'>
			<a class = 'btn btn-primary' style="margin:30px; padding:15px; background-color:red; border:1px solid red; font-size:20px;" href='<?=ROOT;?>producers/add'>Добавить</a>
		</div>
	<?php endif;?>
	<div class='row'>
	<?php foreach ($producersList as $producer): ?>
	

		<div class='col-xs-12 col-md-6 col-lg-4'>
			
			<div class="card mb-3" style="max-width: 540px;">
			  <div class="row no-gutters">
				<div>
					<img class="class-img-top" style='object-fit: cover; width: 250px; height: 250px;' src="<?= IMG; ?>producers/p.<?= $producer['producer_id'];?>.jpg">
				</div>
				<div>
				  <div class="card-body">
					<h5 class="card-title"><?= $producer['producer'];?></h5>
					<a href='<?=ROOT;?>producers/view/<?= $producer['producer_id'];?>' class='btn btn-link'> Подробнее... </a>
					<?php if ($isAuthorized): ?>
						<button type="button" class="btn btn-link" onclick='dlt_item(event)' data-id='<?= $producer['producer_id'] ?>'> Удалить </button>
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
			var producer_id = e.target.dataset.id;
			window.location = '<?php echo ROOT; ?>producers/dlt/' + producer_id;
		} else {
			return false;
		}
	}
</script>


<?php if ($ide_ta) { ?>
	<div style="height: 30rem; overflow: auto">
		<?php foreach ($ide_ta->result() as $u) {	?>

			<h6 class="card-title"> <i class="fas fa-book fa-xs"></i> <?php echo $u->JudulIde;?></h6>
			<h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-calendar-alt fa-xs"></i> <?php echo $u->TanggalIde;?></h6>

			<p class="card-text text-justify"><?php echo $u->DeskripsiIde;?></p>
			<hr>

		<?php } ?>
	</div> 
<?php } else { ?>
	<div class='row align-items-center'>
		<div class='col-md'>
			<h2>Belum Mengajukan Ide Tugas Akhir</h2> 
		</div>
	</div>
<?php } ?>


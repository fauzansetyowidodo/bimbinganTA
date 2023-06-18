<?php foreach ($users->result() as $d): ?>
	<div class="card mb-1">
		<?php if ($d->Foto !== null) {
			$image = base_url('assets/images/users/'.$d->Foto); 
		} elseif ($d->Foto == null) {
			$image = base_url('assets/web/user.png');	
		} 
		?>
		<div class="card-body">
			<img id='' class="card-img-top mb-2" src="<?= $image;?>" alt="">
				<div class="row">
					<div class="col-md">
						<div class="card-text small mt-2">	
							<span class='' data-id='<?= $d->ID;?>'> 	<i class='fa fa-user-circle'></i>  <?= $d->Nama;?> </span> 
						</div>
						<div class="card-text small mt-2">	
							<span class='' data-id='<?= $d->ID;?>'> 	<i class='fa fa-id-badge'></i>  <?= $d->ID;?> </span> 
						</div>
						<div class="card-text small mt-2">	
							<span class='' data-id='<?= $d->ID;?>'> 	<i class='fas fa-envelope'></i>  <?= $d->Email;?> </span> 
						</div> 
						<div class="card-text small mt-2"> 
							<span class='' data-id='<?= $d->ID;?>'> <i class='fas fa-phone'></i>  <?= $d->NoHP === null ? 'klik to add phone number' : $d->NoHP ;?> </span> 
						</div>
									 
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>
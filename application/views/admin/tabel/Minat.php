<head>
	<script type="text/javascript" src="<?php echo base_url('assets/js/myscript.js');?>">
	</script>
</head>
<?php if ($minat) { ?>
	<div>
		<table class="table w-auto">
			<thead style="background-color: #007BFF;">
				<th>ID</th>
				<th>Bidang Minat</th>
				<th>Ketua Bidang Minat</th>
			</thead>
			<?php foreach ($minat->result() as $k) { ?>
				<tbody>
					<tr>
						<td scope="row"> <?php echo $k->IDMinat;?></td>
						<td> <?php echo $k->Minat;?> </td>
						<td> <?php if (empty($k->Nama)) { ?>
							<?php if ($users) { ?>
								<form class='mb-2' method="POST" action="<?php echo base_url('Admin/submitKabm/'.$k->IDMinat);?>" id="kabm<?=$k->IDMinat;?>">
									<div class="form-row">
										<div class="col">
											<select name="kabm" class="custom-select form-control-sm small">
												<option selected>Pilih Ketua bidang minat <?php echo $k->Minat;?></option>
												<?php foreach ($users->result() as $j) { ?>
												<?php if ($j->IDMinatUser === $k->IDMinat) { ?>
													<option value="<?php echo $j->ID;?>"><?php echo $j->Nama;?></option>
												<?php } ?>
												<?php } ?>
											</select>
										</div>
										<div class="col-auto">
											<button type="submit" class="btn btn-sm btn-primary"> <i class='fas fa-paper-plane'></i> </button>
										</div>
									<?php } else {
										echo "mohon masukan data dosen untuk bidang minat ini";
									} ?>
								</div>
							</form>
							<?php 
						} else { ?>
							<a id='kabm' class='btn_view' href="<?php echo base_url('Admin/formKabm/').$k->IDMinatUser; ?>"><?php echo $k->Nama ?> </a>
						<?php } ?>
					</td>
				</tr>		
			</tbody>
		<?php } ?>
	</table>
	<div class="SHkabm" style="overflow: hidden;" style="display: none">
		<div id="SHkabm">

		</div>
	</div>	

</div>
<?php } else { ?>
	<div class="col-md-auto text-center">
		<div class='container-fluid mt-5'>
			<div class='row align-items-center'>
				<div class='col-md'>
					<h2>Bidang Minat untuk Prodi ini tidak ditemukan.</h2>
					Silahkan tambahkan Bidang Minat pada Prodi ini . 
				</div>
				<div class='col-md-3'>
					
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
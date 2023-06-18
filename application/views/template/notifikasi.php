
<div id="Notifikasi">
	<?php if (!$Notifikasi) { ?>
	<div class="card">
		<div class='row align-items-center m-4'>
			<div class='col-md'>
				<?php if ($_SESSION['Status'] === 'Dosen') { ?>
				<h2>Selamat Datang Bapak/Ibu Dosen,
					<?= $_SESSION['Nama']?>.</h2>
				Belum ada pemberitahuan terbaru.
				<?php } elseif ($_SESSION['Status'] === 'Mahasiswa') { ?>
				<h2>Selamat Datang,
					<?= $_SESSION['Nama']?>. Mahasiswa Vokasi UB.</h2>
				Semoga Bimbingan Tugas Akhir kamu lancar.
				<?php } ?>
			</div>
			<div class='col-md-3'>
				<img class="card-img-top" src="<?= base_url('assets/web/senyum.png')?>">
			</div>
		</div>
	</div>
	<?php } else { ?>
	<div class='card container' style="height: 30rem; overflow: auto">
		<?php foreach ($Notifikasi->result() as $p) {
			?>
		<div class="tabel<?php echo $p->IDNotifikasi;?>" id="container">
			<div>
				<div class="card-body">
					<div class="form-row">
						<div class="form-group mr-1" style="height: 5rem; width: 7rem">
							<?php if (file_exists('assets/web/notiff.png')) {
									$base_url = base_url('assets/web/notiff.png'); 
								} else {
									$base_url = base_url('assets/web/notiff.png');
								} 
								?>
							<img class="card-img-top" src="<?= $base_url;?>" alt="Card image">
						</div>
						<div class="form-group col">
							<h5 class="card-title">
								<?php echo $p->Notifikasi ?>
								<?php if ($p->StatusNotifikasi === 'Diterima') { ?>
								<span class="badge badge-success"> Diterima </span>
								<?php } elseif ($p->StatusNotifikasi === 'Ditolak') { ?>
								<span class="badge badge-danger"> Ditolak </span>
								<?php } else { ?>
								<span class="badge badge-info"> Informasi </span>
								<?php }	?>
								<h6 class="card-title"> </h6>

								<div class="form-group">
									<h6 class="card-subtitle text-muted"> <i class="fas fa-calendar fa-sm"></i>
										<?php echo longdate_indo($p->TanggalNotifikasi);?> <i class="fas fa-users fa-sm"></i>
										<?php echo $p->Nama;?>
									</h6>
								</div>
								<div>

									<i class='fas fa-sticky-note'></i>
									<?php echo $p->Catatan;?>
								</div>
						</div>

						<div class="form-group col-md-auto">
							<ul class="nav flex-column">

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php } } ?>
	</div>

</div>

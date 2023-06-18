	<script type="text/javascript" src="<?= base_url('assets/js/myscript.js');?>"></script>

	<?php if (!$prodi) {?>
		<div class='container-fluid'>
			<div class="row align-items-center">
				<div class="col-md">
					<h2>Selamat datang admin !</h2> 
				</div>

			</div>
			</div>
	<?php } else { ?>
		<div id="container" class="row">
			<div class="table-responsive mr-3 col-md-3 col">
				<table class="table">
					<thead>
						<tr style="background-color: #007BFF;">
							<th scope="col" >ID Program Studi</th>
							<th scope="col" >Program Studi</th>
							<th><i class="fas fa-spinner fa-pulse loading" style="display: none"> </i> 
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($prodi->result() as $j) {
							?>
							<tr class="tabel<?= $j->IDProdi?>">
								<th scope="row"> <?= $j->IDProdi;?></th>
								<td> <a id="prodi" class="btn_view" href="<?= base_url('Admin/tabelMinatAdmin/').$j->IDProdi;?>"> <?= $j->Prodi?> </a> </td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="SHprodi col-md-auto" style="display: none">
				<div id="SHprodi"></div>
			</div>
		</div>
		<?php } ?>


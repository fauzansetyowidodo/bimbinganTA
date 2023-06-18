
<?php if ($users) {?>
<div id="tabelUser">
	<table class="table table-bordered">
		<thead>
			<tr class="text-center">
				<th>Nama / NIM</th>
				<th>Judul TA</th>
				<th >Pembimbing</th>
				<th>Proposal</th>
				<th>Tugas Akhir</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users->result() as $u) { ?>
				<tr>
					<td style="vertical-align : middle;text-align:center;" >
						<?= anchor('Dosen/detailMahasiswa/'.$u->IDMahasiswaTa, $u->Nama.' / '.$u->ID);?>
					</td>

					<td>
						<?= anchor('Dosen/detailMahasiswa/' . $u->ID, $u->JudulTa); ?>
					</td>

					<?php foreach ($pembimbing->result() as $p) { ?>
					<?php if ($p->IDTaPmb === $u->IDTa) { ?>
					<td>
						<?= anchor('Dosen/detailDosen/' . $p->IDDosenPmb, $p->Nama); ?>
					</td>


					<td class="text-center">
						<?php if ($p->StatusProposal) {  echo "<i class='fas fa-check-square'></i>"; } else { echo "<i class='fas fa-square'></i>"; }?>
					</td>

					<td class="text-center">
						<?php if ($p->StatusTa) {   echo "<i class='fas fa-check-square'></i>"; } else { echo "<i class='fas fa-square'></i>"; }?>
					</td>
				</tr>
				<?php }}?>

			<?php }?>
		</tbody>
	</table>
</div>

<?php echo $this->ajax_pagination->create_links(); ?>
<?php } else {?>

	<div class="row align-items-center m-1">
		<div class="col-md mb-5">
			<?php if ($_SESSION['Kabm']) {?>
			<h2>Tidak ada Mahasiswa Program Studi</h2>
			Saat ini tidak ada mahasiswa yang sedang melakukan bimbingan Tugas Akhir
			<?php } else {?>
			<h2> Mahasiswa yang Dibimbing Tidak Ditemukan </h2>
			Saat ini belum ada mahasiswa yang harus dibimbing silahkan tunggu ketua bidang minat menentukan anda sebagai dosen pembimbing.
			<?php }?>
		</div>
		<div class="col-md-3">
			<img src="<?=base_url('assets/web/sad.jpg')?>">
		</div>
	</div>
<?php }?>

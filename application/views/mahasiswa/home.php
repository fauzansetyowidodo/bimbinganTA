<head>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#tabelideTa').load('<?php echo base_url('Mahasiswa/ideTa');?>');
			$('#form_ide').load('<?php echo base_url('Mahasiswa/form_ide');?>');
			$('#navTa').click(function() {
				$('#tabelMyTa').load('<?php echo base_url('Mahasiswa/myTa');?>');
			});
			$('#navProfile').click(function() {
				$('#myprofile').load('<?php echo base_url('controllerGlobal/myProfile');?>');
			});
			
			$('#Pemberitahuan').load('<?php echo base_url('controllerGlobal/notifikasi');?>');
			$('#sidebar').load("<?php echo base_url('controllerGlobal/sidebar') ;?>")
			
			$(".btn-menu").click(function() {
				$("#mhs_profil").toggle('slow');
			});
		});
	</script>
</head>
<body>
	<div class="container-fluid">
		<div>
			<div class="col-md">
				<div class="row">
					<div class="col-md">
						<div class="nav nav-pills mb-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				
							<a class="nav-item nav-link " id="navProfile" data-toggle="tab" href="#v-pills-profil" role="tab" aria-controls="v-pills-profil" aria-selected="true"><i class="fas fa-user fa-sm"></i> Profile
							</a>

							<a class="nav-item nav-link active" id="v-pills-home-tab" data-toggle="tab" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-envelope fa-sm"></i> Pemberitahuan 
							</a>
							<?php if (!$tugasakhir) { ?>
								<a class="nav-item nav-link <?= $_SESSION['Status'] == 'Mahasiswa' ? '' : 'disabled'?>" id="navIdeTa" data-toggle="tab" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"> <i class="fas fa-file-alt fa-sm" ></i> Ide Tugas Akhir
								</a>
							<?php } else { 
								?>
								<a class="nav-item nav-link" id="navTa" data-toggle="tab" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false" ><i class="fas fa-pencil-alt"></i> Tugas Akhir </a>
							<?php } ?>
						</div>
					</div>
					<div class="col-md-auto">
						<span class="text-right"> 
							<?php $status = $_SESSION['Kabm'] === 1 ? 'Kabm' : $_SESSION['Status'];
							echo $status.' '.$users->row()->Prodi.' '.$_SESSION['Minat'] ?>
							<h5>
								<?= $_SESSION['Nama'] ?> 
							</h5>
						</span>
					</div>
				</div>
			</div>
			<hr>

			<div class="row m-2">
				<div class="mb-3 col-md-2" id="sidebar">
					
				</div>


				<div class="col-md mb-3">
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade" id="v-pills-profil" role="tabpanel" aria-labelledby="v-pills-profil-tab">
							<div id="myprofile"></div>
						</div>		


						<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
							<div id="Pemberitahuan"></div>
						</div>
						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
							<div class="card border-primary">
								<div class="card-body">
									<div class="row">
										<div class="col-md-5 mb-1" id="form_ide">
										</div>

										<div id="tabelideTa" class="col-md">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
							<div class="mb-3 card container" id="tabelMyTa">
							</div>
						</div>		
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
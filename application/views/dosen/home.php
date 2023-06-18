<head>
	<script type="text/javascript">
		$(function () {

			$("#navIdeTa").click(function () {
				$('#ideta').load("<?php echo base_url('kabm/ideTa');?>");
			});;

			$("#navTa").click(function () {
				$('#tabelTa').load("<?php echo base_url('Dosen/tabelTa');?>");
			});

			$('#navProfile').click(function() {
				$('#myprofile').load('<?php echo base_url('controllerGlobal/myProfile');?>');
			});
			;

			$("#dosen_button").on('click', function () {
				$("#data_dosen").toggle('fast');
				$("#form_dosen").toggle('slow');
			});

			$('#pemberitahuan').load("<?php echo base_url('controllerGlobal/notifikasi') ;?>")
			$('#sidebar').load("<?php echo base_url('controllerGlobal/sidebar') ;?>")

			$("#myprofil").on('click', function () {
				$("#profil").toggle('slow');
			});
		});

		function searchmhs(page_num) {
			page_num = page_num ? page_num : 0;
			var keywords = $('#keywords').val();
			var search = $('#search').val();
			$.ajax({
				type: 'POST',
				url: '<?= base_url(); ?>Dosen/tabelTa/' + page_num,
				data: 'page=' + page_num + '&keywords=' + keywords + '&search=' + search,
				beforeSend: function () {
					$('.loading').show();
				},
				success: function (html) {
					console.log(html)
					$('#tabelTa').html(html);
					$('.loading').fadeOut("slow");
				}
			});
		}
		

	</script>
</head>

<body>
	<div class="container-fluid mb-2">
		<div class="row">
			<div class="col-md">
				<div class="row">
					<div class="col-md">
						<div class="nav nav-pills mb-2 flex-column flex-sm-row" id="list-tab" role="tablist">
							
							<a class="nav-item nav-link " id="navProfile" data-toggle="tab" href="#v-pills-profil" role="tab" aria-controls="v-pills-profil" aria-selected="true"><i class="fas fa-user fa-sm"></i> Profile
							</a>

							<a class="nav-item nav-link active" id="navPemberitahuan" data-toggle="list" href="#Notifikasi" role="tab"
							 aria-controls="settings"> <i class="fas fa-envelope"></i> Pemberitahuan</a>

							<?php if ($_SESSION['Kabm']) { ?>
							<a class="nav-item nav-link" id="navIdeTa" data-toggle="list" href="#list-home" role="tab" aria-controls="home">
								<i class="fas fa-lightbulb"></i> Ide Tugas Akhir </a>
							<?php } ?>

							<a class="nav-item nav-link" id="navTa" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">
								<i class="fas fa-book"></i> Tugas Akhir </a>


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
				<hr>
				
				<div class="row m-2">
					<div class="mb-3 col-md-2" id="sidebar">
						
					</div>

					<div class="col-md bm-3">
						<div class="tab-content" id="v-pills-tabContent">
							
								<div class="tab-pane fade " id="v-pills-profil" role="tabpanel" aria-labelledby="v-pills-profil-tab">
									<div id="myprofile"></div>
								</div>

								<div class="tab-pane fade show active" id="Notifikasi" role="tabpanel" aria-labelledby="list-settings-list">
									<div>
										<div id="pemberitahuan"></div>
									</div>
								</div>

								<div class="tab-pane fade show" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
									<div id='ideta'>
									</div>
								</div>

								<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
									<div id="container" class="container">
										<div class="form-row">
											<div class="form-group col-md">
												<input type="text" name="" id="keywords" class="form-control" onkeyup="searchmhs()">
											</div>
											<div class="form-group col-md-2">
												<select class="form-control" id="search" onchange="searchmhs()">
													<option value="IDMahasiswaTa"> NIM </option>
													<option value="Nama"> Nama </option>
												</select>
											</div>
											<div class="form-group col-1 m-1 loading" style="display: none">
												<i class="fas fa-spinner fa-pulse"></i>
											</div>
										</div>
										<div id="tabelTa"></div>

									</div>
								</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

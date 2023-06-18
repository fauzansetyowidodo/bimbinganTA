<head>
	<script type="text/javascript">
			$(document).on('click', '.edit', function(e) {
				var idbutton = $(this).attr("data-id");
				
				$(this).parents('td').siblings('td').remove()

				$(this).parents('tr').siblings('tr#formtabel'+idbutton).show('fast');
				$(this).parents('td').remove()
			});

			$(document).on('click', '.save', function(e) {

				const idbutton = $(this).attr("data-id");
				
				$(this).parents('tr').hide()
				const vlue = $(this).parents('td').siblings('td').children()
				
				for (let i = 0; i < vlue.length; i++) {
					if (vlue[i] === vlue[2]) {
						
						let idprodi = vlue[i].value.split(";")
						$(this).parents('tr').siblings('tr#tabel'+idbutton).show().append(`<td>${idprodi[1]}</td>`);

					} else if (vlue[i] === vlue[3]) {

						let idminat = vlue[i].value.split(";")
						$(this).parents('tr').siblings('tr#tabel'+idbutton).show().append(`<td>${idminat[1]}</td>`);

					} else {
						$(this).parents('tr').siblings('tr#tabel'+idbutton).show().append(`<td>${vlue[i].value}</td>`);
					}
				}

				$(this).parents('tr').siblings('tr#tabel'+idbutton).append("<td><button class='btn btn-success btn-sm edit' data-id="+vlue[0].value+"><i class='fas fa-edit'></i></button></td>")

				const id = vlue[0].value
				const name = vlue[1].value
				const prodi = vlue[2].value.split(";")[0]
				const minat = vlue[3].value
				const email = vlue[4].value
				const nohp = vlue[5].value

				$.ajax({
					url: '<?= base_url('Admin/updateUser'); ?>',
					type: 'post',
					dataType: 'json',
					data: {id, name, prodi, minat, email, nohp, idlama: idbutton},
				})
				.done(function() {
					console.log("success");
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			});
		$(document).ready(function() {

			$("#tabelProdiAdmin").load('<?= base_url('admin/tabelProdiAdmin'); ?>');
			$("#nav_mhs").load('<?= base_url('admin/navigasiUsers/Mahasiswa'); ?>');
			
			$("#v-pills-dosen-tab").on('click', function() {
				$("#nav_dsn").load('<?php echo base_url('admin/navigasiUsers/Dosen'); ?>');
			});
			
			$("#pengaturan").load('<?php echo base_url('admin/navigasiUsers/Settings'); ?>');	

			$("#form_prodi").load('<?php echo base_url('admin/formProdi'); ?>');
			$("#form_minat").load('<?php echo base_url('admin/formMinat'); ?>');

			$(".btn-menu").click(function() {
				$('.menu').toggle('slow');
			})
		});	

	</script>
</head>
<div class="container-fluid" >
	<div class="row" >
		<div class="col-xl-2 menu" >
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-university"></i> Beranda </a> 
				<a class="nav-link <?= $minat ? '' : 'disabled' ?>" id="pills-mahasiswa" data-toggle="pill" href="#pills-tabel-mahasiswa" role="tab" aria-controls="pills-tabel-mahasiswa" aria-selected="false"><i class="fas fa-graduation-cap"></i> Mahasiswa</a>
				<a class="nav-link <?= $minat ? '' : 'disabled' ?>" id="v-pills-dosen-tab" data-toggle="pill" href="#v-pills-dosen" role="tab" aria-controls="v-pills-dosen" aria-selected="false"><i class="fas fa-briefcase"></i> Dosen </a>
				<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-wrench"></i> Pengaturan</a>
			</div>
		</div>
		
		<div class="col-md">
			<div class="tab-content" id="v-pills-tabContent">
				
				<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" >
					<div class="row" >
						<div class="col-md-auto col-auto">
							<a class="btn-menu" href="#"><i class="fas fa-bars"></i></a>	
						</div>
						<div class="col-md col text-right">
							<h5> BERANDA </h5>
						</div>
					</div>
					<hr>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="form-row">
								<div class="form-group col-md">
									<h1 class=""> <i class="fas fa-user-plus"></i> Program Studi </h1>								
								</div>
							</div>
							<div class="form-row">
								<div id="form_prodi" class="col-md-9">
									
								</div>
							</div>

							<div class="form-row mt-3">
								<div class="form-group col-md">
									<h1 class=""> <i class="fas fa-user-plus"></i> Bidang Minat </h1>
								</div>								
							</div>
							<div class="form-row">
								<div class="col-md-9" id="form_minat">

								</div>									
							</div>
						</div>
						<div id="tabelProdiAdmin">

						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
					<div class="row">
						<div class="col-md-auto col-auto">
							<a class="btn-menu" href="#"><i class="fas fa-bars"></i></a>	
						</div>
						<div class="col col-md">
							<h5 class="text-right nav-link"> PENGATURAN </h5>
						</div>
					</div>
					<hr>
					<div id="pengaturan">		
					</div>
				</div>
				
				<div class="tab-pane fade" id="pills-tabel-mahasiswa" role="tabpanel" aria-labelledby="pills-mahasiswa">
					<div class="row">

						<div class="col-md-auto col-auto">
							<a class="btn-menu" href="#"><i class="fas fa-bars"></i></a>	
						</div>
						<div class="col-md col text-right">
							<h5> MAHASISWA </h5>
						</div>
						
					</div>
					<hr>
					<div id="nav_mhs">

					</div> 
				</div>

				<div class="tab-pane fade" id="v-pills-dosen" role="tabpanel" aria-labelledby="v-pills-dosen-tab">
					<div class="row">

						<div class="col-md-auto col-auto">
							<a class="btn-menu" href="#"><i class="fas fa-bars"></i></a>	
						</div>
						<div class="col-md col text-right">
							<h5> DOSEN </h5>
						</div>
						
					</div>
					<hr>
					<div id='nav_dsn'></div>
				</div>
			</div>
		</div>
	</div>
</div>
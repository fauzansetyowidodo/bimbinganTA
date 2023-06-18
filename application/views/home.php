
<head>
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets/web/logovokasi.png');?>" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title> Sistem Bimbingan TA</title>
	
	<script src="<?=base_url('assets/js/fontawesome-all.js');?>">
	</script>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/utilities.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/sign-in.css');?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/edit-profile.css');?>">
	
	<script type="text/javascript" src="<?=base_url('assets/js/jquery.js');?>">
	</script>
	
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js');?>">
	</script>
	
	<script type="text/javascript" src="<?=base_url('assets/js/sweetalert.min.js');?>">
	</script>

	<script type="text/javascript" src="<?=base_url('assets/js/jquery.validate.min.js');?>">
	</script>

	<script type="text/javascript">
		$(document).ready(function () {

			$("#btn-login").click(function () {
				var formAction = $("#form-login").attr('action');
				var datalogin = {
					nim: $("#nim").val(),
					password: $("#password").val()
				};

				if (!$("#nim").val() || !$("#password").val()) {
					swal({text: 'Username atau password tidak boleh kosong', button: false})
					return false;
				} else {
					$.ajax({
						type: "POST",
						url: formAction,
						data: datalogin,
						beforeSend: function () {
							$('#loading').fadeIn();
						},
						success: function (result) {
							$('#loading').fadeOut('slow');
							if (result <= 4) {
								swal({title: 'Login Berhasil !',text: 'Anda akan diahlihkan ke dashboard', button: false});
							} else {
								swal({title: 'Login Gagal !',text: 'Username atau password salah !', button: false, icon: 'error', timer: 2000})
							}
							var user;
							switch (result) {
								case '1':
									user = 'Dosen';
									break;
								case '2':
									user = 'Mahasiswa';
									break;
								case '3':
									user = 'Kabm';
									break;
								case '4':
									user = 'Admin';
									break;
								default:
									return false;
							}
							setTimeout(function () {
								window.location = "<?=base_url();?>" + user
							}, 1000);

						}
					});
					return false;
				}
			});

		});

	</script>
</head>

<section class="sign-in mx-auto">
        <div class="row">
            <div class="col-xxl-5 col-lg-6 my-auto py-lg-0 pt-lg-50 pb-lg-50 pt-30 pb-47 px-0">
                <form id="form-login" action="<?=base_url('Home/session');?>" method="POST">
                    <div class="container mx-auto">
                        <div class="pb-50">
                            <a class="navbar-brand">
								<img src="assets/web/logoub.png" width="60" alt="">
								<img src="assets/web/logovokasi.png" width="90" alt="">
                            </a>
                        </div>
                        <h2 class="text-4xl fw-bold color-palette-1 mb-10">Log In</h2>
                        <p class="text-lg color-palette-1 m-0">Masuk untuk melakukan bimbingan Tugas Akhir</p>
                        <div class="pt-50">
                            <label for="email" class="form-label text-lg fw-medium color-palette-1 mb-10">ID Pengguna</label>
                            <input name="nim" id="nim" type="text" class="form-control rounded-pill text-lg" 
                               placeholder="Username">
                        </div>
                        <div class="pt-30">
                            <label for="password"
                                class="form-label text-lg fw-medium color-palette-1 mb-10">Password</label>
                            <input name="password" id="password" type="password" class="form-control rounded-pill text-lg" 
                                 placeholder="Password">
                        </div>
                        <div class="button-group d-flex flex-column mx-auto pt-50">
                            <a class="btn btn-sign-in fw-medium text-lg text-white rounded-pill mb-16" id='btn-login' type="submit"
                             role="button">Log In</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xxl-7 col-lg-6 bg-blue text-center pt-lg-145 pb-lg-145 d-lg-block d-none">
                <img src="assets/web/cover.svg" width="502" height="391.21" class="img-fluid pb-50" alt="">
                <h2 class="text-4xl fw-bold text-white mb-30 mt-2">Fakultas Vokasi<br>
                    Universitas Brawijaya</h2>
            </div>
        </div>
    </section>



<div id="loading" class="modal" style="display:none; background-color:rgba(0, 0, 0, 0.5);">
	<div class="modal-dialog modal-dialog-centered ">
		<div class="alert alert-info alert-white rounded modal-content">
			<strong> <i class="fas fa-spinner fa-pulse"> </i> Sedang Memproses </strong>
		</div>
	</div>
</div>

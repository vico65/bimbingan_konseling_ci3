<!DOCTYPE html>
<html lang="en">

<head>
	<title>Bimbingan konseling smk pariwisata triatmajaya</title>
	<link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/logotj.png">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_login/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_login/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_login/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_login/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_login/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_login/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets_login/css/main.css">
	<!--===============================================================================================-->
</head>
<style type="text/css">
	#pageloader {
		background: rgba(255, 255, 255, 0.8);
		display: none;
		height: 100%;
		position: fixed;
		width: 100%;
		z-index: 9999;
	}

	#pageloader img {
		left: 51%;
		margin-left: -70px;
		margin-top: -100px;
		position: absolute;
		top: 50%;
	}
</style>

<body>
	<div id="pageloader">
		<img src="<?= base_url() ?>assets/img/pageloader2.gif" alt="processing..." />
	</div>

	<div class="limiter">
		<div class="container-login100 position-relative">
			<div class="wrap-login100 p-t-50 p-b-90">
				<div class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-51">
						<p><img src="<?= base_url() ?>assets/img/logotj.png" width='120px;'></p>
						Bimbingan Konseling
						<p><b>SMK Negeri 5 Palembang</b></p>
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Username is required">
						<input class="input100" type="text" id="username" name="username" placeholder="Username"">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
						<input class="input100" type="password" id="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-24">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" type="button" onclick="GOlogin()">
							Login
						</button>
					</div>

				</div>
			</div>

			<div class="fixed-bottom bg-warning border-3 p-3 border-dark z-3 login-cheat">
				<button id="loginBK" type="button" class="btn btn-success">Pak Rapli(BK)</button>
				<button id="loginGuru" type="button" class="btn btn-danger">Ibu Weli(Guru)</button>
				<button id="loginKepsek" type="button" class="btn btn-danger">Ibu Vira(Kepsek)</button>
				<button id="loginSiswaA" type="button" class="btn btn-danger">Siswa A</button>
				<button id="loginWaliA" type="button" class="btn btn-danger">Wali Siswa A</button>
				<button id="loginSiswaB" type="button" class="btn btn-danger">Siswa B</button>
				<button id="loginWaliB" type="button" class="btn btn-danger">Wali Siswa B</button>
				<button id="loginSiswaC" type="button" class="btn btn-danger">Siswa C</button>
				<button id="loginWaliC" type="button" class="btn btn-danger">Wali Siswa C</button>
				<button id="loginSiswaD" type="button" class="btn btn-danger">Siswa D</button>
				<button id="loginWaliD" type="button" class="btn btn-danger">Wali Siswa D</button>
				<button id="loginSiswaE" type="button" class="btn btn-danger">Siswa E</button>
				<button id="loginWaliE" type="button" class="btn btn-danger">Wali Siswa E</button>
			</div>
		</div>
	</div>
	</div>


	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets_login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets_login/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets_login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url() ?>assets_login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets_login/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets_login/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url() ?>assets_login/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets_login/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="<?= base_url() ?>assets_login/js/main.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



	<script type="text/javascript">
		$(document).ready(function() {
			$('#username,.atribut').show();
			$('#password,.atribut').show();
			$('#pageloader').hide();
		});

		//cheat

		const dataLogin = [
			{
				'username' : '2025100',
				'password' : '2025100'
			},
			{
				'username' : '2025200',
				'password' : '2025200'
			},
			{
				'username' : '2025400',
				'password' : '2025400'
			},
			{
				'username' : '111222',
				'password' : '111222'
			},
			{
				'username' : '111222',
				'password' : 'wali111222'
			},
			{
				'username' : '333444',
				'password' : '333444'
			},
			{
				'username' : '333444',
				'password' : 'wali333444'
			},
			{
				'username' : '111223',
				'password' : '111223'
			},
			{
				'username' : '111223',
				'password' : 'wali111223'
			},{
				'username' : '111224',
				'password' : '111224'
			},
			{
				'username' : '111224',
				'password' : 'wali111224'
			},{
				'username' : '111225',
				'password' : '111225'
			},
			{
				'username' : '111225',
				'password' : 'wali111225'
			},
			

		]
	
		
		const loginCheat = $('.login-cheat');
		loginCheat.children().each(function(i, e) {
			e.addEventListener('click', function() {
				$('#username').val(dataLogin[i].username) ;
				$('#password').val(dataLogin[i].password) ;
			})
		})

		//login ajax
		function GOlogin() {
			if ($('#username').val() == '') {
				swal("Informasi", "Username tidak boleh kosong!", "error");
			} else if ($('#password').val() == '') {
				swal("Informasi", "Password tidak boleh kosong!", "error");
			} else {
				$("#pageloader").fadeIn();
				var datasend = new FormData();
				datasend.append('username', $('#username').val());
				datasend.append('password', $('#password').val());

				$.ajax({
					url: '<?= base_url() ?>Web/AksiLogin',
					method: 'POST',
					contentType: false,
					processData: false,
					data: datasend,
					dataType: 'json',
					cache: true,
					success: function(data) {
						console.log(data);
						if (data.status == 'valid') {
							window.location = data.value;
						} else {
							$("#pageloader").hide();
							swal("Informasi", data.pesan, "error");
						}
					},
					error: function(data) {
						console.log(data);
						$("#pageloader").hide();
						swal("Informasi", "Gagal Terhubung Ke Server", "error");
					}
				});
			}
		}


		//parsing tipe login
		// function ShowForm(){
		// 	if ($("#type_akses").val()=='') {
		// 		$('#username,.atribut').hide();
		// 		$('#password,.atribut').hide();
		// 	} else {
		// 		$('#username,.atribut').show();
		// 		$('#password,.atribut').show();
		// 	}
		// }
	</script>

</body>

</html>
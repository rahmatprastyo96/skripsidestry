<?php
include "config.php";
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Penilaian Kinerja Metode SMART</title>
	<link href="css/metro.css" rel="stylesheet">
	<link href="css/metro-icons.css" rel="stylesheet">
	<link href="css/metro-schemes.css" rel="stylesheet">
	<link href="css/metro-responsive.css" rel="stylesheet">
	<script src="js/jquery.js"></script>
	<script src="js/metro.js"></script>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>

<body onload="runPB1()">
	<!-- <div class="app-bar" >
		<a class="app-bar-element" href="login.php">Penilaian Kinerja Metode SMART</a>
		<a class="app-bar-element place-right">About</a>
	</div> -->
	<div class="card-body login-card-body">

		<!--<a href="index2.html"><b>IMAYA</b> Dental Clinic</a>-->
		<center>
			<img style="text-align:center; margin:100px auto 0 auto;" src="image/logo.jpg" width="360px"></img>
		</center>
		<h2 style="text-align:center;">Login</h2>
		<div style="margin:15px auto;width:320px;background:#eee;border:1px solid #ddd;padding:20px;">
			<?php
			if (isset($_POST['username']) && isset($_POST['password'])) {
				$user = $_POST['username'];
				$pass = md5($_POST['password']);
				$line1 = mysqli_query($db1, "select * from user where username = '$user' and password = '$pass';");
				if ($line2 = mysqli_fetch_array($line1)) {
					session_start();
					$_SESSION['id'] = $line2['id_user'];
					$_SESSION['nama'] = $line2['nama_user'];
					$_SESSION['username'] = $line2['username'];
					$_SESSION['level'] = $line2['level'];
			?>
					<div class="progress ani large" id="pb1" data-animate="500" data-color="ribbed-amber" data-role="progress"></div>
					<script>
						var interval1;

						function runPB1() {
							clearInterval(interval1);
							var pb = $("#pb1").data('progress');
							var val = 0;
							interval1 = setInterval(function() {
								val += 10;
								pb.set(val);
								if (val >= 100) {
									location.href = 'home.php';
									val = 0;
									clearInterval(interval1);
								}
							}, 100);
						}
					</script>
					<script>
						$.Notify({
							caption: 'Sukses',
							content: 'Anda berhasil Login!',
							type: 'success'
						});
					</script>
				<?php
				} else {
				?>
					<script>
						$.Notify({
							caption: 'Maaf',
							content: 'Anda mungkin salah memasukkan username dan password, silahkan coba lagi!',
							type: 'alert'
						});
					</script>
			<?php
				}
			}
			?>
			<div class="card">
				<div class="card-body login-card-body">
					<form method="post">

						<div class="input-group mb-3">
							<input type="text" class="form-control" name="username" placeholder="Username">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="mif-user prepend-icon"></span>
								</div>
							</div>
						</div>
						<div class="input-group mb-3">
							<input type="password" class="form-control" name="password" placeholder="Password">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="mif-key prepend-icon"></span>
								</div>
							</div>
						</div>
						<div class="row">

							<!-- /.col -->
							<div class="col-12">
								<button type="submit" class="btn btn-warning btn-block">Sign In</button>
							</div>
							<!-- /.col -->
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

</body>

</html>
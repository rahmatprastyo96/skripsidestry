<?php
include "config.php";
session_start();
if (!isset($_SESSION['username'])) {
?>
	<script>
		window.location.assign("login.php")
	</script>
<?php
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Penilaian Kinerja Metode SMART</title>
	<link href="css/metro.css" rel="stylesheet">
	<link href="css/metro-icons.css" rel="stylesheet">
	<link href="css/metro-schemes.css" rel="stylesheet">
	<link href="css/metro-responsive.css" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>

<body>
	<div class="app-bar">
		<!-- <a class="app-bar-element" href="home.php" style="text-decoration:none">Klinik Dental Care Imaya</a>
		<span class="app-bar-divider"></span> -->
		<ul class="app-bar-menu">

			<?php if ($_SESSION['level'] == 'admin') { ?>
				<li class="nav-item">
					<a href="home.php" class="nav-link">Home</a>
				</li>
				<li class="nav-item">
					<a href="pegawai.php" class="nav-link">Data Pegawai</a>
				</li>
				
				<li class="nav-item">
					<a target="_blank" href="laporan.php" class="nav-link">Laporan</a>
				</li>
				<li class="nav-item">
					<a href="operator.php" class="nav-link">Pengguna</a>
				</li>
			<?php
			}
			?>
			<?php if ($_SESSION['level'] == 'penilai') { ?>
				<li class="nav-item">
					<a href="home.php" class="nav-link">Home</a>
				</li>
				<li class="nav-item">
					<a href="kriteria.php" class="nav-link">Kriteria</a>
				</li>
				<li class="nav-item">
					<a href="perangkingan.php" class="nav-link">Penilaian</a>
				</li class="nav-item">
				<li class="nav-item">
					<a target="_blank" href="laporan.php" class="nav-link">Laporan</a>
				</li>	
				<!-- <p><?php echo $_SESSION['nama']?> - <?php echo $_SESSION['level']?> </p> -->
			<?php
			}
			?>
			
		</ul>
		<a href="logout.php" class="app-bar-element place-right" style="text-decoration:none">Logout</a>
	</div>

	<div style="padding:50px 20px;">
		<div class="grid">
			<div class="row cells5">
			<!-- <div class="cell">
				
				 <ul class="v-menu" style="border:1px solid blue">
					<li class="menu-title">Dashboard</li>
					<li><a href="index.php"><span class="mif-home icon"></span> Beranda</a></li>
					<li class="divider"></li>
					<li class="menu-title">Menu</li>
					<li><a href="kriteria.php"><span class="mif-florist icon"></span> Kriteria</a></li>
					<li><a href="subkriteria.php"><span class="mif-layers icon"></span> Sub Kriteria</a></li>
					<li><a href="alternatif.php"><span class="mif-stack icon"></span> Alternatif Karyawan</a></li>
					<li><a href="perangkingan.php"><span class="mif-books icon"></span> Perangkingan</a></li>
					<li><a target="_blank" href="laporan.php"><span class="mif-file-pdf icon"></span> Laporan</a></li>
					<li class="divider"></li>
					<li class="menu-title">Pengguna</li>
					<li><a href="operator.php"><span class="mif-user icon"></span> Operator</a></li>
					<li><a href="ubahpassword.php"><span class="mif-key icon"></span> Ubah Password</a></li>
					<li><a href="logout.php"><span class="mif-cross icon"></span> Logout</a></li>
				</ul> 
			
			</div> -->

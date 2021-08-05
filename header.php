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
		<a class="app-bar-element" href="home.php">Klinik Dental Care Imaya</a>
		<span class="app-bar-divider"></span>
		<ul class="app-bar-menu">
			<?php if ($_SESSION['username'] != 'admin') { ?>
				<li><a href="kriteria.php">Kriteria</a></li>
			<?php
			}
			?>
			<?php if ($_SESSION['username'] != 'admin') { ?>

			<?php
			}
			?>
			<!-- <li><a href="subkriteria.php">Sub Kriteria</a></li> -->
			<li><a href="alternatif.php">Data Karyawan</a></li>
			<li><a href="perangkingan.php">Perangkingan</a></li>
			<li><a target="_blank" href="laporan.php">Laporan</a></li>
			<!--<li>
				<a href="" class="dropdown-toggle">Laporan</a>
				<ul class="d-menu" data-role="dropdown">
					<li><a href="">Direct</a></li>
					<li><a href="">FPDF</a></li>
					<li><a href="">phpToPDF</a></li>
					<li><a href="">TCPDF</a></li>
					<li><a href="">Dompdf</a></li>
					<li><a href="">Zend_Pdf</a></li>
					<li><a href="">PDFlib</a></li>
					<li><a href="">mPDF</a></li>
				</ul>
			</li>-->
		</ul>
		<a href="logout.php" class="app-bar-element place-right">Logout</a>
	</div>

	<div style="padding:5px 20px;">
		<div class="grid">
			<div class="row cells5">
				<!-- <div class="cell">

					<ul class="v-menu">
						<li class="menu-title">Dashboard</li>
						<li><a href="index.php"><span class="mif-home icon"></span> Beranda</a></li>
						<li class="divider"></li>
						<li class="menu-title">Menu</li>
						<li><a href="kriteria.php"><span class="mif-florist icon"></span> Kriteria</a></li>
						<?php if ($_SESSION['username'] != 'penilai') { ?>
							<li><a href="alternatif.php"><span class="mif-stack icon"></span> Data Karyawan</a></li>
						<?php
						}
						?>

						<?php if ($_SESSION['username'] != 'admin') { ?>
							<li><a href="perangkingan.php"><span class="mif-books icon"></span> Perangkingan</a></li>
						<?php
						}
						?>

						<li><a target="_blank" href="laporan.php"><span class="mif-file-pdf icon"></span> Laporan</a></li>
						<?php if ($_SESSION['username'] != 'penilai') { ?>
							<li class="divider"></li>
							<li class="menu-title">Pengguna</li>
							<li><a href="operator.php"><span class="mif-user icon"></span> Operator</a></li>
							<li><a href="ubahpassword.php"><span class="mif-key icon"></span> Ubah Password</a></li>
							<li><a href="logout.php"><span class="mif-cross icon"></span> Logout</a></li>
						<?php
						}
						?>

					</ul>

				</div> -->
				<div class="cell colspan4">

					<div class="card card-primary card-outline" style="center">
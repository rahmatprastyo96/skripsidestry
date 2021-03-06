<?php
include "header.php";
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<div class="card card-primary card-outline">
	<div class="card-body">
		<div class="row cells4">
			<div class="cell colspan2">
				<h3>Penilaian</h3>
			</div>
			<?php
			if ($page == 'form') {
			?>
				<div class="cell colspan2 align-right">
					<a href="perangkingan.php" role="button" style="color: white;" class="btn btn-info">Kembali</a>
				</div>
		</div>
		<p></p>
		<?php
				if (isset($_POST['simpan'])) {
					$alt = $_POST['alt'];
					$stmtx4 = $db->prepare("select * from smart_kriteria");
					$stmtx4->execute();
					while ($rowx4 = $stmtx4->fetch()) {
						if ($rowx4['id_kriteria'] == true) {
							$idkri = $rowx4['id_kriteria'];
							$kri = $_POST['kri'][$idkri];
							$altkri = $_POST['altkri'][$idkri];
							$altkriutil = $_POST['altkri'][$idkri]-20;
							$hasilutil = $altkriutil/80;
							$stmt2 = $db->prepare("insert into penilaian(id_pegawai,id_kriteria,nilai_kriteria,nilai_alternatif_kriteria) values(?,?,?,?)");
							$stmt2->bindParam(1, $alt);
							$stmt2->bindParam(2, $kri);
							$stmt2->bindParam(3, $altkri);
							$stmt2->bindParam(4, $hasilutil);
							$stmt2->execute();
						}
					}

					?>
				<script type="text/javascript">
					location.href = 'perangkingan.php'
				</script>
			<?php

				}
				if (isset($_POST['update'])) {
					$alt = $_POST['alt'];
					$stmtx4 = $db->prepare("select * from smart_kriteria");
					$stmtx4->execute();
					while ($rowx4 = $stmtx4->fetch()) {
						if ($rowx4['id_kriteria'] == true) {
							$idkri = $rowx4['id_kriteria'];
							$kri = $_POST['kri'][$idkri];
							$altkri = $_POST['altkri'][$idkri];
							$stmt2 = $db->prepare("update penilaian set nilai_alternatif_kriteria=? where id_pegawai=? and id_kriteria=?");
							$stmt2->bindParam(1, $altkri);
							$stmt2->bindParam(2, $alt);
							$stmt2->bindParam(3, $kri);
							$stmt2->execute();
						}
					}
				}
		?>

		<form method="post">
			<label>Nama</label>
			<div class="input-control select full-size">
				<select name="alt">
					<option disabled selected hidden value="<?php echo isset($_GET['alt']) ? $_GET['alt'] : ''; ?>"><?php echo isset($_GET['alt']) ? $_GET['alt'] : ''; ?>Select Karyawan :</option>
					<?php
					$stmt3 = $db->prepare("SELECT u.id_pegawai, u.nama_pegawai FROM `pegawai` AS u LEFT JOIN `penilaian` AS i ON u.id_pegawai = i.id_pegawai WHERE i.id_kriteria IS NULL");
					$stmt3->execute();
					while ($row3 = $stmt3->fetch()) {
					?>
						<option value="<?php echo $row3['id_pegawai'] ?>"><?php echo $row3['nama_pegawai'] ?></option>
					<?php
					}
					?>
				</select>
			</div><br /><br /><b>
				<div class="row cells3">
					<div class="cell">ID Kriteria</div>
					<div class="cell colspan2">Nilai Kriteria</div>
				</div>
			</b><br />
			<?php
				$stmt4 = $db->prepare("select * from smart_kriteria");
				$stmt4->execute();
				$no = 1;
				while ($row4 = $stmt4->fetch()) {
			?>
				<div class="row cells3">
					<div class="cell"><input type="hidden" name="kri[<?php echo $row4['id_kriteria'] ?>]" value="<?php echo $row4['id_kriteria'] ?>"><?php echo $no++ ?>.
						<?php echo $row4['nama_kriteria'] ?></div>
					<div class="cell colspan2">
						<div class="input-control text full-size">
							
							
							<input type="number" name="altkri[<?php echo $row4['id_kriteria'] ?>]" placeholder="Input Nilai" value="<?php echo isset($_GET['altkri']) ? $_GET['altkri'] : ''; ?>">

						</div>
					</div>
				</div>
			<?php
				}
			?>
			<?php
				if (isset($_GET['id'])) {
			?>
				<button type="submit" name="update" class="button warning">Update</button>
			<?php
				} else {
			?>
				<button type="submit" name="simpan" class="button primary">Simpan</button>
			<?php
				}
			?>
		</form>

		<?php
			} else if ($page == 'hapus') {
		?>
			<div class="cell colspan2 align-right">
			</div>
			</div>
			<?php
				if (isset($_GET['alt'])) {
					$stmt = $db->prepare("delete from penilaian where id_pegawai='" . $_GET['alt'] . "'");
					if ($stmt->execute()) {
			?>
					<?php
						if (isset($_GET['alt'])) {
							$stmt2 = $db->prepare("update pegawai set hasil_alternatif = 0 where id_pegawai='" . $_GET['alt'] . "'");
							if ($stmt2->execute()) {
					?>
							<script type="text/javascript">
								location.href = 'perangkingan.php'
							</script>
			<?php
							}
						}
					}
				}
			} else {
			?>
			<div class="cell colspan2 align-right">
				<a href="perangkingan-utility.php" role="button" style="color: white;" class="btn btn-success">Proses</a>
				<a href="?page=form" role="button" style="color: white;" class="btn btn-info">Tambah</a>
			</div>
			</div>
			<table class="table striped hovered cell-hovered border bordered dataTable" data-role="datatable" data-searching="true">
				<thead>
					<tr>
						<th width="50">No</th>
						<th>Nama</th>
						<?php
						$stmt2 = $db->prepare("select * from smart_kriteria");
						$stmt2->execute();
						while ($row2 = $stmt2->fetch()) {
						?>
							<th><?php echo $row2['nama_kriteria'] ?></th>
						<?php
						}
						?>
						<th width="260">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$stmt = $db->prepare("select * from pegawai");
					$nox = 1;
					$stmt->execute();
					while ($row = $stmt->fetch()) {
					?>
						<tr>
							<td><?php echo $nox++ ?></td>
							<td><?php echo $row['nama_pegawai'] ?></td>
							<?php
							$stmt3 = $db->prepare("select * from smart_kriteria");
							$stmt3->execute();
							while ($row3 = $stmt3->fetch()) {
							?>
								<td>
									<?php
									$stmt4 = $db->prepare("select * from penilaian where id_kriteria='" . $row3['id_kriteria'] . "' and id_pegawai='" . $row['id_pegawai'] . "'");
									$stmt4->execute();
									while ($row4 = $stmt4->fetch()) {
										echo $row4['nilai_kriteria'];
									?>
										<!--<a href="?page=form&alt=<?php echo $row['id_pegawai'] ?>&kri=<?php echo $row3['id_kriteria'] ?>&nilai=<?php echo $row4['nilai_kriteria'] ?>" style="color:orange"><span class="mif-pencil icon"></span></a>-->
									<?php
									}
									?>
								</td>
							<?php
							}
							?>
							<td class="align-center">
								<a href="?page=hapus&alt=<?php echo $row['id_pegawai'] ?>" role="button" style="color: white;" class="btn btn-danger"><span class="mif-cancel icon"></span> Hapus</a>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			<p><br /></p>
		</div>
</div>
<?php
	}
	include "footer.php";
?>
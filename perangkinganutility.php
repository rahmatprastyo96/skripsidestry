<?php
include "header.php";
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<div class="row cells4">
	<div class="cell colspan2">
		<h3>Penilaian</h3>
	</div>
	<?php
	if ($page == 'form') {
	?>
		<div class="cell colspan2 align-right">
			<a href="perangkingan.php" class="button info">Kembali</a>
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
					$altkri = $_POST['altkri'];
					$altkriutil = $_POST['altkri']-20;
					$hasilutil = $altkriutil/80;
					$stmt2 = $db->prepare("insert into smart_alternatif_kriteria(id_alternatif,id_kriteria,nilai_kriteria,nilai_alternatif_kriteria) values(?,?,?,?)");
					$stmt2->bindParam(1, $alt);
					$stmt2->bindParam(2, $kri);
					$stmt2->bindParam(3, $altkri);
					$stmt2->bindParam(4, $hasilutil);
					$stmt2->execute();
				}
			}
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
					$stmt2 = $db->prepare("update smart_alternatif_kriteria set nilai_alternatif_kriteria=? where id_alternatif=? and id_kriteria=?");
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
			$stmt3 = $db->prepare("SELECT u.id_alternatif, u.nama_alternatif FROM `smart_alternatif` AS u LEFT JOIN `smart_alternatif_kriteria` AS i ON u.id_alternatif = i.id_alternatif WHERE i.id_kriteria IS NULL");
			$stmt3->execute();
			while ($row3 = $stmt3->fetch()) {
			?>
				<option value="<?php echo $row3['id_alternatif'] ?>"><?php echo $row3['nama_alternatif'] ?></option>
			<?php
			}
			?>
		</select>
	</div><br /><br /><b>
		<div class="row cells3">
			<div class="cell">ID Kriteria</div>
			<div class="cell colspan2">Nilai/Sub Kriteria</div>
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
					
					
					<input type="text" name="altkri" placeholder="Input Nilai" value="<?php echo isset($_GET['altkri']) ? $_GET['altkri'] : ''; ?>">

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
			$stmt = $db->prepare("delete from smart_alternatif_kriteria where id_alternatif='" . $_GET['alt'] . "'");
			if ($stmt->execute()) {
	?>
			<?php
				if (isset($_GET['alt'])) {
					$stmt2 = $db->prepare("update smart_alternatif set hasil_alternatif = 0 where id_alternatif='" . $_GET['alt'] . "'");
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
		<a href="execute-rangking.php" class="button success">Eksekusi Perangkingan</a>
		<a href="perangkingan.php" class="button primary">Kembali</a>
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
					<th><?php echo $row2['kode_kriteria'] ?></th>
				<?php
				}
				?>
				<!-- <th width="260">Aksi</th> -->
			</tr>
		</thead>
		<tbody>
			<?php
			$stmt = $db->prepare("select * from smart_alternatif");
			$nox = 1;
			$stmt->execute();
			while ($row = $stmt->fetch()) {
			?>
				<tr>
					<td><?php echo $nox++ ?></td>
					<td><?php echo $row['nama_alternatif'] ?></td>
					<?php
					$stmt3 = $db->prepare("select * from smart_kriteria");
					$stmt3->execute();
					while ($row3 = $stmt3->fetch()) {
					?>
						<td>
							<?php
							$stmt4 = $db->prepare("select * from smart_alternatif_kriteria where id_kriteria='" . $row3['id_kriteria'] . "' and id_alternatif='" . $row['id_alternatif'] . "'");
							$stmt4->execute();
							while ($row4 = $stmt4->fetch()) {
								echo $row4['nilai_alternatif_kriteria'];
							?>
								<!--<a href="?page=form&alt=<?php echo $row['id_alternatif'] ?>&kri=<?php echo $row3['id_kriteria'] ?>&nilai=<?php echo $row4['nilai_alternatif_kriteria'] ?>" style="color:orange"><span class="mif-pencil icon"></span></a>-->
							<?php
							}
							?>
						</td>
					<?php
					}
					?>
					<!-- <td class="align-center">
						<a href="?page=hapus&alt=<?php echo $row['id_alternatif'] ?>" class="button danger"><span class="mif-cancel icon"></span> Hapus</a>
					</td> -->
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	<p><br /></p>
<?php
	}
	include "footer.php";
?>
<?php
include "header.php";
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<div class="card card-primary card-outline">
	<div class="card-body">
		<div class="row cells4">
			<div class="cell colspan2">
				<h3>Nilai Utility</h3>
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
							$stmt2 = $db->prepare("insert into penilaian(id_pegawai,id_kriteria,nilai_kriteria,nilai_alternatif_kriteria) values(?,?,?,?)");
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
							$stmt2 = $db->prepare("update penilaian set nilai_alternatif_kriteria=? where id_pegawai=? and id_kriteria=?");
							$stmt2->bindParam(1, $altkri);
							$stmt2->bindParam(2, $alt);
							$stmt2->bindParam(3, $kri);
							$stmt2->execute();
						}
					}
				}
		?>
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
				<a href="hasil-utility-bobot.php" role="button" style="color: white;" class="btn btn-success">Proses</a>
				<a href="perangkingan.php" role="button" style="color: white;" class="btn btn-info">Kembali</a>
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
										echo $row4['nilai_alternatif_kriteria'];
									?>
										<!--<a href="?page=form&alt=<?php echo $row['id_pegawai'] ?>&kri=<?php echo $row3['id_kriteria'] ?>&nilai=<?php echo $row4['nilai_alternatif_kriteria'] ?>" style="color:orange"><span class="mif-pencil icon"></span></a>-->
									<?php
									}
									?>
								</td>
							<?php
							}
							?>
							
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
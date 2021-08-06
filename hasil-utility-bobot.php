<?php
include "header.php";
$page = isset($_GET['page']) ? $_GET['page'] : "";
header('Refresh; url=execute-rangking.php');
?>
<div class="card card-primary card-outline">
	<div class="card-body">
		<div class="row cells4">
			<div class="cell colspan2">
				<h3>Nilai Utility X Bobot</h3>
			</div>
			<div class="cell colspan2 align-right">
				<a href="execute-rangking.php" role="button" style="color: white;" class="btn btn-success">Hasil</a>
				<a href="perangkingan-utility.php" role="button" style="color: white;" class="btn btn-info">Kembali</a>
			</div>
		</div>
		<div class="table-container">
			<table class="table striped hovered cell-hovered border bordered dataTable" data-role="datatable" data-searching="true">
				<thead>
					<tr>
						<th width="50">No</th>
						<th>Nama</th>
						<?php
						$stmt2x = $db->prepare("select * from smart_kriteria");
						$stmt2x->execute();
						while ($row2x = $stmt2x->fetch()) {
						?>
							<th><?php echo $row2x['nama_kriteria'] ?></th>
						<?php
						}
						?>
						<th>Hasil</th>
						
					</tr>
					<tr>
						<td>-</td>
						<td>Bobot</td>
						<?php
						$stmt2x1 = $db->prepare("select * from smart_kriteria");
						$stmt2x1->execute();
						while ($row2x1 = $stmt2x1->fetch()) {
						?>
							<td><?php echo $row2x1['bobot_kriteria'] ?></td>
						<?php
						}
						?>
						<td>-</td>
		
					</tr>
				</thead>
				<tbody>
					<?php
					$stmtx = $db->prepare("select * from pegawai ");
					$noxx = 1;
					// $ranking = 1;
					$stmtx->execute();
					while ($rowx = $stmtx->fetch()) {
					?>
						<tr>
							<td><?php echo $noxx++ ?></td>
							<td><?php echo $rowx['nama_pegawai'] ?></td>
							<?php
							$stmt3x = $db->prepare("select * from smart_kriteria");
							$stmt3x->execute();
							while ($row3x = $stmt3x->fetch()) {
							?>
								<td>
									<?php
									$stmt4x = $db->prepare("select * from penilaian where id_kriteria='" . $row3x['id_kriteria'] . "' and id_pegawai='" . $rowx['id_pegawai'] . "'");
									$stmt4x->execute();
									while ($row4x = $stmt4x->fetch()) {
										$ida = $row4x['id_pegawai'];
										$idk = $row4x['id_kriteria'];
										echo $kal = $row4x['nilai_alternatif_kriteria'] * $row3x['bobot_kriteria'];
										$stmt2x3 = $db->prepare("update penilaian set bobot_alternatif_kriteria=? where id_pegawai=? and id_kriteria=?");
										$stmt2x3->bindParam(1, $kal);
										$stmt2x3->bindParam(2, $ida);
										$stmt2x3->bindParam(3, $idk);
										$stmt2x3->execute();
									}
									?>
								</td>
							<?php
							}
							?>
							<td>
								<?php
								$stmt3x2 = $db->prepare("select sum(bobot_alternatif_kriteria) as bak from penilaian where id_pegawai='" . $rowx['id_pegawai'] . "'");
								$stmt3x2->execute();
								$row3x2 = $stmt3x2->fetch();
								$ideas = $rowx['id_pegawai'];
								echo $hsl = $row3x2['bak'];
								$stmt2x3y = $db->prepare("update pegawai set hasil_alternatif=? where id_pegawai=?");
								$stmt2x3y->bindParam(1, $hsl);
								$stmt2x3y->bindParam(2, $ideas);
								$stmt2x3y->execute();
								?>
							</td>

						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>

		<p><br /></p>
	</div>
</div>
<?php
include "footer.php";
?>
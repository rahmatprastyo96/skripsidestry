<?php
include "header.php";
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<div class="card card-primary card-outline">
	<div class="card-body">
		<div class="row cells4">
			<div class="cell colspan2">
				<h3>Kriteria</h3>
			</div>
			<?php
			if ($page == 'form') {
			?>
				<div class="cell colspan2 align-right">
					<a href="kriteria.php" role="button" style="color: white;" class="btn btn-info">Kembali</a>
				</div>
		</div>
		<p></p>
		<?php
				if (isset($_POST['simpan'])) {
					$stmt = $db->prepare("select sum(bobot_kriteria) as bbtk from smart_kriteria");
					$stmt->execute();
					$row = $stmt->fetch();
					if ($_POST['bobot'] <= 100) {
						$bbt = $_POST['bobot'] / 100;
						$bbtk = $bbt + $row['bbtk'];
						if ($bbtk <= 1) {
							$nama = $_POST['nama'];
							$kode = $_POST['kode'];
							$bobot = $_POST['bobot'] / 100;
							$stmt2 = $db->prepare("insert into smart_kriteria values('',?,?,?)");
							$stmt2->bindParam(1, $kode);
							$stmt2->bindParam(2, $nama);
							$stmt2->bindParam(3, $bobot);
							if ($stmt2->execute()) {
		?>
						<script type="text/javascript">
							location.href = 'kriteria.php'
						</script>
					<?php
							} else {
					?>
						<script type="text/javascript">
							alert('Gagal menyimpan data')
						</script>
					<?php
							}
						} else {
					?>
					<script type="text/javascript">
						alert('Bobot haruslah 100% jika dijumlahkan semua kriteria')
					</script>
				<?php
						}
					} else {
				?>
				<script type="text/javascript">
					alert('Maaf nilai bobot maksimal 100')
				</script>
				<?php
					}
				}
				if (isset($_POST['update'])) {
					$stmt = $db->prepare("select sum(bobot_kriteria) as bbtk from smart_kriteria");
					$stmt->execute();
					$row = $stmt->fetch();
					if ($_POST['bobot'] <= 100) {
						$bbt = $_GET['bobot'];
						$bbt2 = $_POST['bobot'] / 100;
						$bbtk = $row['bbtk'] - $bbt;
						$bbtk2 = $bbtk + $bbt2;
						if ($bbtk2 <= 1) {
							$id = $_POST['id'];
							$kode = $_POST['kode'];
							$nama = $_POST['nama'];
							$bobot = $_POST['bobot'] / 100;
							$stmt2 = $db->prepare("update smart_kriteria set kode_kriteria=?, nama_kriteria=?, bobot_kriteria=? where id_kriteria=?");
							$stmt2->bindParam(1, $kode);
							$stmt2->bindParam(2, $nama);
							$stmt2->bindParam(3, $bobot);
							$stmt2->bindParam(4, $id);
							if ($stmt2->execute()) {
				?>
						<script type="text/javascript">
							location.href = 'kriteria.php'
						</script>
					<?php
							} else {
					?>
						<script type="text/javascript">
							alert('Gagal mengubah data')
						</script>
					<?php
							}
						} else {
					?>
					<script type="text/javascript">
						alert('Bobot haruslah 100% jika dijumlahkan semua kriteria')
					</script>
				<?php
						}
					} else {
				?>
				<script type="text/javascript">
					alert('Maaf nilai bobot maksimal 100')
				</script>
		<?php
					}
				}
		?>
		<form method="post">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
			<label>Kode Kriteria</label>
			<div class="input-control text full-size">
				<input type="text" name="kode" placeholder="Kode Kriteria" value="<?php echo isset($_GET['kode']) ? $_GET['kode'] : ''; ?>">
			</div>
			<label>Nama Kriteria</label>
			<div class="input-control text full-size">
				<input type="text" name="nama" onkeypress="return event.charCode < 48 || event.charCode  >57" placeholder="Nama Kriteria" value="<?php echo isset($_GET['nama']) ? $_GET['nama'] : ''; ?>">
			</div>
			<label>Bobot</label>
			<div class="input-control text full-size">
				<input type="number" name="bobot" placeholder="Bobot %" value="<?php echo isset($_GET['bobot']) ? $_GET['bobot'] * 100 : ''; ?>">
			</div>
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
				if (isset($_GET['id'])) {
					$stmt = $db->prepare("delete from smart_kriteria where id_kriteria='" . $_GET['id'] . "'");
					if ($stmt->execute()) {
	?>
			<script type="text/javascript">
				location.href = 'kriteria.php'
			</script>
	<?php
					}
				}
			} else {
	?>
	<div class="cell colspan2 align-right">
		<a href="?page=form" role="button" style="color: white;" class="btn btn-success">Tambah</a>
	</div>
		</div>
		<table class="table table-bordered table-striped" data-role="datatable" data-searching="true">
			<thead>
				<tr>
					<th width="50">ID</th>
					<th>Kode</th>
					<th>Kriteria</th>
					<th width="50">Bobot</th>
					<th width="280">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
						$stmt = $db->prepare("select * from smart_kriteria");
						$stmt->execute();
						$no = 1;
						while ($row = $stmt->fetch()) {
				?>
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $row['kode_kriteria'] ?></td>
						<td><?php echo $row['nama_kriteria'] ?></td>
						<td><?php echo $row['bobot_kriteria'] ?></td>
						<td class="align-center">
							<a href="?page=form&id=<?php echo $row['id_kriteria'] ?>&kode=<?php echo $row['kode_kriteria'] ?>&nama=<?php echo $row['nama_kriteria'] ?>&bobot=<?php echo $row['bobot_kriteria'] ?>" role="button" style="color: white;" class="btn btn-warning"><span class="mif-pencil icon"></span> Edit</a>
							<a href="?page=hapus&id=<?php echo $row['id_kriteria'] ?>" role="button" style="color: white;" class="btn btn-danger"><span class="mif-cancel icon"></span> Hapus</a>
						</td>
					</tr>
				<?php
						}
				?>
			</tbody>
		</table>
		<p><br /></p>
	</div>
</div><!-- /.card -->
<?php
			}
			include "footer.php";
?>
<?php
include "header.php";
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<div class="row cells4">
	<div class="cell colspan2">
		<h3>Alternatif Karyawan</h3>
	</div>
	<?php
	if ($page == 'form') {
	?>
		<div class="cell colspan2 align-right">
			<a href="alternatif.php" class="button info">Kembali</a>
		</div>
</div>
<p></p>
<?php
		if (isset($_POST['simpan'])) {
			$tagpegawai = $_POST['tag_pegawai'];
			$nama = $_POST['nama'];
			$jabatan = $_POST['jabatan'];
			$bagian = $_POST['bagian'];
			$stmt2 = $db->prepare("insert into smart_alternatif(id_alternatif,tag_pegawai,nama_alternatif,jabatan,bagian) values('',?,?,?,?)");
			$stmt2->bindParam(1, $tagpegawai);
			$stmt2->bindParam(2, $nama);
			$stmt2->bindParam(3, $jabatan);
			$stmt2->bindParam(4, $bagian);
			if ($stmt2->execute()) {
?>
		<script type="text/javascript">
			location.href = 'alternatif.php'
		</script>
	<?php
			} else {
	?>
		<script type="text/javascript">
			alert('Gagal menyimpan data')
		</script>
	<?php
			}
		}
		if (isset($_POST['update'])) {
			$id = $_POST['id'];
			$nama = $_POST['nama'];
			$stmt2 = $db->prepare("update smart_alternatif set nama_alternatif=? where id_alternatif=?");
			$stmt2->bindParam(1, $nama);
			$stmt2->bindParam(2, $id);
			if ($stmt2->execute()) {
	?>
		<script type="text/javascript">
			location.href = 'alternatif.php'
		</script>
	<?php
			} else {
	?>
		<script type="text/javascript">
			alert('Gagal mengubah data')
		</script>
<?php
			}
		}
?>
<form class="form-horizontal" method="post">
	<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
	<div class="form-group row">
		<label>Kode Pegawai</label>
		<div class="input-control text full-size">
			<input type="text" name="tag_pegawai" placeholder="Kode Pegawai" value="<?php echo isset($_GET['tag_pegawai']) ? $_GET['tag_pegawai'] : ''; ?>">
		</div>
	</div>
	<div class="form-group row">
		<label>Nama Pegawai</label>
		<div class="input-control text full-size">
			<input type="text" name="nama" placeholder="Nama Pegawai" value="<?php echo isset($_GET['nama']) ? $_GET['nama'] : ''; ?>">
		</div>
	</div>
	<div class="form-group row">
		<label>Jabatan</label>
		<div class="input-control text full-size">
			<input type="text" name="jabatan" placeholder="Jabatan Pegawai" value="<?php echo isset($_GET['jabatan']) ? $_GET['jabatan'] : ''; ?>">
		</div>
	</div>
	<div class="form-group row">
		<label>Bagian</label>
		<div class="input-control text full-size">
			<input type="text" name="bagian" placeholder="Bagian Pegawai" value="<?php echo isset($_GET['bagian']) ? $_GET['bagian'] : ''; ?>">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
		<div class="col-sm-2">
			<select class="form-control  select2" style="width: 100%;" name="jenis_kelamin" id="jenis_kelamin">
				<option value="laki-laki">Laki-Laki</option>
				<option value="perempuan">Perempuan</option>
			</select>
		</div>
		
	</div>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label">Status</label>
		<div class="col-sm-2">
			<select class="form-control  select2" style="width: 100%;" name="status" id="status">
				<option value="AKTIF">Aktif</option>
				<option value="TIDAK AKTIF">Tidak Aktif</option>
			</select>
		</div>
	
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
			$stmt = $db->prepare("delete from smart_alternatif where id_alternatif='" . $_GET['id'] . "'");
			if ($stmt->execute()) {
	?>
			<script type="text/javascript">
				location.href = 'alternatif.php'
			</script>
	<?php
			}
		}
	} else {
	?>
	<div class="cell colspan2 align-right">
		<a href="?page=form" class="button primary">Tambah</a>
	</div>
	</div>
	<table class="table striped hovered cell-hovered border bordered dataTable" data-role="datatable" data-searching="true">
		<thead>
			<tr>
				<th width="50">ID</th>
				<th>Nama</th>
				<th width="240">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$stmt = $db->prepare("select * from smart_alternatif");
			$stmt->execute();
			$no = 1;
			while ($row = $stmt->fetch()) {
			?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $row['nama_alternatif'] ?></td>
					<td class="align-center">
						<a href="?page=form&id=<?php echo $row['id_alternatif'] ?>&nama=<?php echo $row['nama_alternatif'] ?>" class="button warning"><span class="mif-pencil icon"></span> Edit</a>
						<a href="?page=hapus&id=<?php echo $row['id_alternatif'] ?>" class="button danger"><span class="mif-cancel icon"></span> Hapus</a>
					</td>
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
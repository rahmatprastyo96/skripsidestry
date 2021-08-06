<?php
include "header.php";
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<div class="row cells4">
	<div class="cell colspan2">
		<h3>Data Pegawai</h3>
	</div>
	<?php
	if ($page == 'form') {
	?>
		<div class="cell colspan2 align-right">
			<a href="pegawai.php" role="button" class="btn btn-info">Kembali</a>
		</div>
</div>
<p></p>
<?php
		if (isset($_POST['simpan'])) {
			$tagpegawai = $_POST['tag_pegawai'];
			$nama = $_POST['nama'];
			$jabatan = $_POST['jabatan'];
			$bagian = $_POST['bagian'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$stmt2 = $db->prepare("insert into pegawai(id_pegawai,tag_pegawai,nama_pegawai,jabatan,bagian,jenis_kelamin) values('',?,?,?,?,?)");
			$stmt2->bindParam(1, $tagpegawai);
			$stmt2->bindParam(2, $nama);
			$stmt2->bindParam(3, $jabatan);
			$stmt2->bindParam(4, $bagian);
			$stmt2->bindParam(5, $jenis_kelamin);
			if ($stmt2->execute()) {
?>
		<script type="text/javascript">
			location.href = 'pegawai.php'
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
			$tagpegawai = $_POST['tag_pegawai'];
			$nama = $_POST['nama'];
			$jabatan = $_POST['jabatan'];
			$bagian = $_POST['bagian'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$stmt2 = $db->prepare("update pegawai set tag_pegawai=?, nama_pegawai=?, jabatan=?, bagian=?, jenis_kelamin=? where id_pegawai=?");
			$stmt2->bindParam(1, $tagpegawai);
			$stmt2->bindParam(2, $nama);
			$stmt2->bindParam(3, $jabatan);
			$stmt2->bindParam(4, $bagian);
			$stmt2->bindParam(5, $jenis_kelamin);
			$stmt2->bindParam(6, $id);
			if ($stmt2->execute()) {
	?>
		<script type="text/javascript">
			location.href = 'pegawai.php'
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
	<div style="padding:10px 15px;" >
		<h4><u>Input Pegawai</u></h4></br>
	</div>
	<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
	<div class="form-group row">
		<label>Kode Pegawai</label>
		<div class="input-control text full-size">
			<input type="number" name="tag_pegawai" placeholder="Kode Pegawai" value="<?php echo isset($_GET['tag_pegawai']) ? $_GET['tag_pegawai'] : ''; ?>">
		</div>
	</div>
	<div class="form-group row">
		<label>Nama Pegawai</label>
		<div class="input-control text full-size">
			<input type="text" name="nama" onkeypress="return event.charCode < 48 || event.charCode  >57" placeholder="Nama Pegawai" value="<?php echo isset($_GET['nama']) ? $_GET['nama'] : ''; ?>">
		</div>
	</div>
	<div class="form-group row">
		<label>Jabatan</label>
		<div class="input-control text full-size">
			<input type="text" name="jabatan" onkeypress="return event.charCode < 48 || event.charCode  >57" placeholder="Jabatan Pegawai" value="<?php echo isset($_GET['jabatan']) ? $_GET['jabatan'] : ''; ?>">
		</div>
	</div>
	<div class="form-group row">
		<label>Bagian</label>
		<div class="input-control text full-size">
			<input type="text" name="bagian" onkeypress="return event.charCode < 48 || event.charCode  >57" placeholder="Bagian Pegawai" value="<?php echo isset($_GET['bagian']) ? $_GET['bagian'] : ''; ?>">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
		<div class="col-sm-2">
			<select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
				<option value="laki-laki">Laki-Laki</option>
				<option value="perempuan">Perempuan</option>
			</select>
		</div>
		<script>
			var cek = <?php echo json_encode($_GET['jenis_kelamin']); ?>;
			document.getElementById("jenis_kelamin").value = cek;
		</script>
	</div>
	
	<?php
		if (isset($_GET['id'])) {

	?>
		<button type="submit" name="update" class="button warning">Update</button>
	<?php
		} else {
	?>
		<button type="submit" name="simpan" class="btn btn-primary mb-3">Simpan</button>
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
			$stmt = $db->prepare("delete from pegawai where id_pegawai='" . $_GET['id'] . "'");
			if ($stmt->execute()) {
	?>
			<script type="text/javascript">
				location.href = 'pegawai.php'
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
	<table class="table striped hovered cell-hovered border bordered dataTable" data-role="datatable" data-searching="true">
		<thead>
			<tr>
				<th style="width: 5%;">No</th>
				<th>ID Pegawai</th>
				<th>Nama Pegawai</th>
				<th>Jabatan</th>
				<th>Bagian</th>
				<th>Jenis Kelamin</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$stmt = $db->prepare("select * from pegawai");
			$stmt->execute();
			$no = 1;
			while ($row = $stmt->fetch()) {
			?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $row['tag_pegawai'] ?></td>
					<td><?php echo $row['nama_pegawai'] ?></td>
					<td><?php echo $row['jabatan'] ?></td>
					<td><?php echo $row['bagian'] ?></td>
					<td><?php echo $row['jenis_kelamin'] ?></td>
					<td class="align-center">
						<a role="button" style="color: white;" class="btn btn-warning" href="?page=form&id=<?php echo $row['id_pegawai'] ?>
									&tag_pegawai=<?php echo $row['tag_pegawai'] ?>
									&nama=<?php echo $row['nama_pegawai'] ?>
									&jabatan=<?php echo $row['jabatan'] ?>
									&bagian=<?php echo $row['bagian'] ?>
									&jenis_kelamin=<?php echo $row['jenis_kelamin'] ?>" ><span class="mif-pencil icon"></span> Edit</a>
						<a role="button" style="color: white;" class="btn btn-danger" href="?page=hapus&id=<?php echo $row['id_pegawai'] ?>" class="button danger"><span class="mif-cancel icon"></span> Hapus</a>
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
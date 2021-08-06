<?php
include "header.php";
$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<div class="card card-primary card-outline">
	<div class="card-body">
		<div class="row cells4">
			<div class="cell colspan2">
				<h3>Data Pengguna</h3>
			</div>
			<?php
			if ($page == 'form') {
			?>
				<div class="cell colspan2 align-right">
					<a href="operator.php" style="color: white;" class="btn btn-info">Kembali</a>
				</div>
		</div>
		<p></p>
		<?php
				if (isset($_POST['simpan'])) {
					$nama = $_POST['nama'];
					$user = $_POST['user'];
					$level = $_POST['level'];
					$pass = md5($_POST['pass']);
					$stmt2 = $db->prepare("insert into user values('',?,?,?,?)");
					$stmt2->bindParam(1, $nama);
					$stmt2->bindParam(2, $user);
					$stmt2->bindParam(3, $pass);
					$stmt2->bindParam(4, $level);
					if ($stmt2->execute()) {
		?>
				<script type="text/javascript">
					location.href = 'operator.php'
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
					$user = $_POST['user'];
					$level = $_POST['level'];
					$pass = md5($_POST['pass']);
					$stmt2 = $db->prepare("update user set nama_user=?, username=?, password=?, level=?where id_user=?");
					$stmt2->bindParam(1, $nama);
					$stmt2->bindParam(2, $user);
					$stmt2->bindParam(3, $pass);
					$stmt2->bindParam(4, $level);
					$stmt2->bindParam(5, $id);
					if ($stmt2->execute()) {
			?>
				<script type="text/javascript">
					location.href = 'operator.php'
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
		<form method="post">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
			<label>Nama Lengkap</label>
			<div class="input-control text full-size">
				<input type="text" name="nama" onkeypress="return event.charCode < 48 || event.charCode  >57" placeholder="Nama Lengkap" value="<?php echo isset($_GET['nama']) ? $_GET['nama'] : ''; ?>">
			</div>
			<label>Username</label>
			<div class="input-control text full-size">
				<input type="text" name="user" placeholder="Nama Pengguna" value="<?php echo isset($_GET['username']) ? $_GET['username'] : ''; ?>">
			</div>
			<label class="col-sm-2 col-form-label">Level Pengguna</label>
				<div class="col-sm-2">
					<select class="form-select" name="level" id="level">
						<option value="admin">Admin</option>
						<option value="penilai">Penilai</option>
					</select>
				</div>
				<script>
					var cek = <?php echo json_encode($_GET['level']); ?>;
					document.getElementById("level").value = cek;
				</script>
			<label>Password</label>
			<div class="input-control text full-size">
				<input type="password" name="pass" placeholder="Kata Sandi">
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
					$stmt = $db->prepare("delete from user where id_user='" . $_GET['id'] . "'");
					if ($stmt->execute()) {
			?>
					<script type="text/javascript">
						location.href = 'operator.php'
					</script>
			<?php
					}
				}
			} else {
			?>
			<div class="cell colspan2 align-right">
				<a href="?page=form" style="color: white;" class="btn btn-success">Tambah</a>
			</div>
			</div>
			<table class="table striped hovered cell-hovered border bordered dataTable" data-role="datatable" data-searching="true">
				<thead>
					<tr>
						<th width="50">ID</th>
						<th>Nama</th>
						<th>Username</th>
						<th width="300">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$stmt = $db->prepare("select * from user");
					$stmt->execute();
					while ($row = $stmt->fetch()) {
					?>
						<tr>
							<td><?php echo $row['id_user'] ?></td>
							<td><?php echo $row['nama_user'] ?></td>
							<td><?php echo $row['username'] ?></td>
							<td class="align-center">
								<a href="?page=form&id=<?php echo $row['id_user'] ?>&nama=<?php echo $row['nama_user'] ?>&username=<?php echo $row['username'] ?>&level=<?php echo $row['level'] ?>" style="color: white;" class="btn btn-warning"><span class="mif-pencil icon"></span> Edit</a>
								<a href="?page=hapus&id=<?php echo $row['id_user'] ?>" style="color: white;" class="btn btn-danger"><span class="mif-cancel icon"></span> Hapus</a>
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
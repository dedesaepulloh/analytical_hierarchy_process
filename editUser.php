<?php
	include('config.php');
	include('fungsi.php');

	// mendapatkan data edit
	if(isset($_GET['jenis']) && isset($_GET['id_user'])) {
		$id 	= $_GET['id_user'];
		$jenis	= $_GET['jenis'];

		// hapus record
		$query 	= "SELECT nama, username, password FROM $jenis WHERE id_user=$id";
		$result	= mysqli_query($koneksi, $query);
		
		while ($row = mysqli_fetch_array($result)) {
			$nama = $row['nama'];
			$username = $row['username'];
			$password = $row['password'];
		}
	}

	if (isset($_POST['update'])) {
		$id 	= $_POST['id_user'];
		$jenis	= $_POST['jenis'];
		$nama 	= $_POST['nama'];
		$username 	= $_POST['username'];
		$password 	= $_POST['password'];

		$md5 = md5($password);

		$query 	= "UPDATE $jenis SET nama='$nama', username='$username', password='$md5' WHERE id_user=$id";
		$result	= mysqli_query($koneksi, $query);

		if (!$result) {
			echo "Update gagal";
			exit();
		} else {
			header('Location: '.$jenis.'.php');
			exit();
		}
	}

	include('header.php');
	session_start();
    if(empty($_SESSION['username']) AND empty($_SESSION['password'])){
        echo "<script>alert('Anda Harus Login Dulu !'); window.location = 'login.php'</script>";
    }else{
?>

<section class="content">
<div class="ui breadcrumb">
		<a class="section">Data <?php echo $jenis?></a>
		<div class="divider"> / </div>
		<div class="active section">Edit <?php echo $jenis?></div>
	</div>
	<h2>Edit <?php echo $jenis?></h2>

	<form class="ui form" method="post" action="editUser.php">
		<div class="required field">
			<label>Nama <?php echo $jenis ?></label>
			<input type="text" name="nama" value="<?php echo $nama?>" required>
			<input type="hidden" name="id_user" value="<?php echo $id?>">
			<input type="hidden" name="jenis" value="<?php echo $jenis?>">
		</div>
		<div class="required field">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username ?>" required>
		</div>
		<div class="required field">
			<label>Password</label>
			<input type="password" name="password"	 required>
		</div>
		<br>
		<input class="ui primary button" type="submit" name="update" value="UPDATE">
	</form>
</section>

<?php include('footer.php'); ?>
	<?php } ?>
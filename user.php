<?php 
	include('config.php');
	include('fungsi.php');

	// menjalankan perintah edit
	if(isset($_POST['edit'])) {
		$id = $_POST['id_user'];

		header('Location: editUser.php?jenis=user&id_user='.$id);
		exit();
	}

	// menjalankan perintah delete
	if(isset($_POST['delete'])) {
		$id = $_POST['id_user'];
		deleteUser($id);
	}

	// menjalankan perintah tambah
	if(isset($_POST['tambah'])) {
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		tambahUser('user',$nama, $username, $password);
	}

	include('header.php');
	session_start();
    if(empty($_SESSION['username']) AND empty($_SESSION['password'])){
        echo "<script>alert('Anda Harus Login Dulu !'); window.location = 'login.php'</script>";
    }else{
?>

<section class="content">
	<div class="ui breadcrumb">
		<a class="section">Data Pengguna</a>
		<div class="divider"> / </div>
		<div class="active section">Pengguna</div>
	</div>
	<h2 class="ui header">Data Pengguna - Penilaian Kinerja Guru Terbaik</h2>
	<hr><br>
		<a href="tambahUser.php?jenis=user">
			<div class="ui right floated small violet labeled icon button">
				<i class="plus icon"></i>TAMBAH
			</div>
		</a>
		<br>
	<br>
	<table class="ui celled padded table">
		<thead>
			<tr>
				<th class="collapsing">No</th>
				<th>Nama</th>
				<th colspan="2">Username</th>
			</tr>
		</thead>
		<tbody>

		<?php
			// Menampilkan list user
			$query = "SELECT id_user,nama,username FROM user ORDER BY id_user";
			$result	= mysqli_query($koneksi, $query);

			$i = 0;
			while ($row = mysqli_fetch_array($result)) {
				$i++;
		?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $row['nama'] ?></td>
				<td><?php echo $row['username'] ?></td>
				<td class="right aligned collapsing">
					<form method="post" action="user.php">
						<input type="hidden" name="id_user" value="<?php echo $row['id_user'] ?>">
						<button type="submit" name="edit" class="small ui green button">EDIT</button>
						<button type="submit" name="delete" class="small ui red button">DELETE</button>
					</form>
				</td>
			</tr>
		

	<?php } ?>


		</tbody>

	</table>

	<br>

</section>

<?php include('footer.php'); ?>
			<?php } ?>
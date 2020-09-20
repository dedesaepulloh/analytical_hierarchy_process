<?php 
	include('config.php');
	include('fungsi.php');

	// menjalankan perintah edit
	if(isset($_POST['edit'])) {
		$id = $_POST['id'];

		header('Location: edit.php?jenis=alternatif&id='.$id);
		exit();
	}

	// menjalankan perintah delete
	if(isset($_POST['delete'])) {
		$id = $_POST['id'];
		deleteAlternatif($id);
	}

	// menjalankan perintah tambah
	if(isset($_POST['tambah'])) {
		$nama = $_POST['nama'];
		tambahData('alternatif',$nama);
	}

	include('header.php');
	session_start();
    if(empty($_SESSION['username']) AND empty($_SESSION['password'])){
        echo "<script>alert('Anda Harus Login Dulu !'); window.location = 'login.php'</script>";
    }else{

?>


<section class="content">
	<div class="ui breadcrumb">
		<a class="section">Data Alternatif</a>
		<div class="divider"> / </div>
		<div class="active section">Alternatif</div>
	</div>

	<h2 class="ui header">Data Alternatif - Penilaian Kinerja Guru Terbaik</h2>
	<hr><br>
	<a href="tambah.php?jenis=alternatif">
						<div class="ui right floated small violet labeled icon button">
						<i class="plus icon"></i>TAMBAH
						</div>
					</a>
					<br><br>
	<table class="ui celled padded table">
		<thead>
			<tr>
				<th class="collapsing">No</th>
				<th colspan="2">Nama Alternatif</th>
			</tr>
		</thead>
		<tbody>

		<?php
			// Menampilkan list alternatif
			$query = "SELECT id,nama FROM alternatif ORDER BY id";
			$result	= mysqli_query($koneksi, $query);

			$i = 0;
			while ($row = mysqli_fetch_array($result)) {
				$i++;
		?>
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $row['nama'] ?></td>
				<td class="right aligned collapsing">
					<form method="post" action="alternatif.php">
						<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
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
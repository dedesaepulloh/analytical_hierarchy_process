<?php
	include('config.php');
	include('fungsi.php');

	// mendapatkan data edit
	if(isset($_GET['jenis'])) {
		$jenis	= $_GET['jenis'];
	}

	if (isset($_POST['tambah'])) {
		$jenis	= $_POST['jenis'];
		$nama 	= $_POST['nama'];

		tambahData($jenis,$nama);

		header('Location: '.$jenis.'.php');
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
		<div class="active section">Tambah <?php echo $jenis?></div>
	</div>

	<h2>Tambah <?php echo $jenis?></h2>

	<form class="ui form" method="post" action="tambah.php">
		<div class="required field">
			<label>Nama <?php echo $jenis ?></label>
			<input type="text" name="nama" placeholder="Masukan <?php echo $jenis?> baru" required>
			<input type="hidden" name="jenis" value="<?php echo $jenis?>">
		</div>
		
		<br>
		<input class="ui primary button" type="submit" name="tambah" value="SIMPAN">
	</form>
</section>

<?php include('footer.php'); ?>
	<?php } ?>
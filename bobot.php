<?php
	include('config.php');
	include('fungsi.php');

	$jenis = $_GET['c'];

	include('header.php');
	session_start();
    if(empty($_SESSION['username']) AND empty($_SESSION['password'])){
        echo "<script>alert('Anda Harus Login Dulu !'); window.location = 'login.php'</script>";
    }else{
?>
<section class="content">
	<div class="ui breadcrumb">
		<a class="section">Perbandingan Alternatif</a>
		<div class="divider"> / </div>
		<div class="active section">Penentuan Bobot Alternatif - <?php echo getKriteriaNama($jenis-1) ?></div>
	</div>
	<h2 class="ui header">Perbandingan Alternatif &rarr; <?php echo getKriteriaNama($jenis-1) ?></h2>
	<?php showTabelPerbandingan($jenis,'alternatif'); ?>
</section>

<?php include('footer.php'); ?>
	<?php } ?>
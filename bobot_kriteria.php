<?php
	include('config.php');
	include('fungsi.php');

	include('header.php');
	session_start();
    if(empty($_SESSION['username']) AND empty($_SESSION['password'])){
        echo "<script>alert('Anda Harus Login Dulu !'); window.location = 'login.php'</script>";
    }else{
?>
<section class="content">
	<div class="ui breadcrumb">
		<a class="section">Perbandingan Kriteria</a>
		<div class="divider"> / </div>
		<div class="active section">Penentuan Bobot Kriteria</div>
	</div>
	<h2 class="ui header">Penentuan Bobot Kriteria</h2>
	<?php showTabelPerbandingan('kriteria','kriteria'); ?>
</section>

<?php include('footer.php'); ?>
	<?php } ?>
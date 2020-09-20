<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Sistem Pendukung Keputusan metode AHP</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
</head>

<body>
<!-- <up>
</up> -->
<header>
	<img src="muhammadiyah.png" width="140px" alt="">
	<h2>SMK Muhammadiyah Kawali</h2>
	<h3>Sistem Pendukung Keputusan Penilaian Kinerja Guru Terbaik dengan Metode AHP</h3>
	<hr>
</header>

<div class="wrapper card">
<section class="content aligned center">
	<h1>LOGIN USER</h1>
	<form class="ui large form" method="POST" action="cek_login.php">
		<div class="field">
			<label>Userame</label>
			<input type="text" name="username" placeholder="Username">
		</div>
		<div class="field">
			<label>Password</label>
			<input type="password" name="password" placeholder="Password">
		</div>
		<button class="ui button" type="submit">Submit</button>
	</form>
</section>
</div> <!-- /wrapper -->

<footer>
	<p>Copyright &copy; SMK Muhammadiyah Kawali - <?php echo date("Y"); ?></p>
</footer>

<script src="js/jquery-3.2.1.js"></script>
<script src="semantic/dist/semantic.min.js"></script>
<script type="text/javascript">
	$('.ui.radio.checkbox')
		.checkbox()
	;
</script>
<script type="text/javascript">
	$('.message .close')
	  .on('click', function() {
	    $(this)
	      .closest('.message')
	      .transition('fade')
	    ;
	  })
	;
</script>
</body>
</html>

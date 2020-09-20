<?php
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
		<div class="active section">Hasil Perbandingan Alternatif - <?php echo getKriteriaNama($jenis-1) ?></div>
	</div>
	<h3 class="ui header">Tabel Perbandingan Berpasangan</h3>
	<table class="ui celled padded table">
		<thead>
			<tr>
				<th>Alternatif</th>
<?php
	for ($i=0; $i <= ($n-1); $i++) {
		echo "<th>".getAlternatifNama($i)."</th>";
	}
?>
			</tr>
		</thead>
		<tbody>
<?php
	for ($x=0; $x <= ($n-1); $x++) {
		echo "<tr>";
		echo "<td>".getAlternatifNama($x)."</td>";
			for ($y=0; $y <= ($n-1); $y++) {
				echo "<td>".round($matrik[$x][$y],4)."</td>";
			}

		echo "</tr>";
	}
?>
		</tbody>
		<tfoot>
			<tr>
				<th>Jumlah</th>
<?php
		for ($i=0; $i <= ($n-1); $i++) {
			echo "<th>".round($jmlmpb[$i],4)."</th>";
		}
?>
			</tr>
		</tfoot>
	</table>


	<br>

	<h3 class="ui header">Tabel Nilai Alternatif</h3>
	<table class="ui celled padded table">
		<thead>
			<tr>
				<th>Alternatif</th>
<?php
	for ($i=0; $i <= ($n-1); $i++) {
		echo "<th>".getAlternatifNama($i)."</th>";
	}
?>
				<th>Jumlah</th>
				<th>Rata - Rata</th>
			</tr>
		</thead>
		<tbody>
<?php
	for ($x=0; $x <= ($n-1); $x++) {
		echo "<tr>";
		echo "<td>".getAlternatifNama($x)."</td>";
			for ($y=0; $y <= ($n-1); $y++) {
				echo "<td>".round($matrikb[$x][$y],4)."</td>";
			}

		echo "<td>".round($jmlmnk[$x],4)."</td>";
		echo "<td>".round($pv[$x],4)."</td>";

		echo "</tr>";
	}
?>

		</tbody>
		<tfoot>
			<tr>
				<th colspan="<?php echo ($n+2)?>">Principe Eigen Vector (λ maks)</th>
				<th><?php echo (round($eigenvektor,4))?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($n+2)?>">Consistency Index (CI)</th>
				<th><?php echo (round($consIndex,4))?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($n+2)?>">Consistency Ratio (CR)</th>
				<th><?php echo (round($consRatio,4))?></th>
			</tr>
		</tfoot>
	</table>



<?php

	if ($consRatio > 0.1) {
?>
		<div class="ui icon blue message">
			<i class="close icon"></i>
			<i class="warning circle icon"></i>
			<div class="content">
				<div class="header">
					Nilai Consistency Ratio Tidak Konsisten
				</div>
				<p>Silahkan input kembali pada tabel penentuan bobot.</p>
			</div>
		</div>

		<br>

		<a href='javascript:history.back()'>
			<button class="ui left labeled primary icon button">
				<i class="left arrow icon"></i>
				Kembali
			</button>
		</a>

<?php

	} else {
		if ($jenis == getJumlahKriteria()) {
?>

<br>

<form action="hasil.php">
	<button class="ui right labeled icon primary button" style="float: right;">
		<i class="right arrow icon"></i>
		Lanjut
	</button>
</form>


<?php

		} else {

?>
<br>
	<a href="<?php echo "bobot.php?c=".($jenis + 1)?>">
	<button class="ui right labeled icon primary button" style="float: right;">
		<i class="right arrow icon"></i>
		Lanjut
	</button>
	</a>

<?php

		}
	}

	echo "</section>";
	include('footer.php');

?>
<?php } ?>
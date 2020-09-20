<?php

include('config.php');
include('fungsi.php');


// menghitung perangkingan
$jmlKriteria 	= getJumlahKriteria();
$jmlAlternatif	= getJumlahAlternatif();
$nilai			= array();

// mendapatkan nilai tiap alternatif
for ($x=0; $x <= ($jmlAlternatif-1); $x++) {
	// inisialisasi
	$nilai[$x] = 0;

	for ($y=0; $y <= ($jmlKriteria-1); $y++) {
		$id_alternatif 	= getAlternatifID($x);
		$id_kriteria	= getKriteriaID($y);

		$pv_alternatif	= getAlternatifPV($id_alternatif,$id_kriteria);
		$pv_kriteria	= getKriteriaPV($id_kriteria);

		$nilai[$x]	 	+= ($pv_alternatif * $pv_kriteria);
	}
}

// update nilai ranking
for ($i=0; $i <= ($jmlAlternatif-1); $i++) { 
	$id_alternatif = getAlternatifID($i);
	$query = "INSERT INTO ranking VALUES ($id_alternatif,$nilai[$i]) ON DUPLICATE KEY UPDATE nilai=$nilai[$i]";
	$result = mysqli_query($koneksi,$query);
	if (!$result) {
		echo "Gagal mengupdate ranking";
		exit();
	}
}

session_start();
if(empty($_SESSION['username']) AND empty($_SESSION['password'])){
	echo "<script>alert('Anda Harus Login Dulu !'); window.location = 'login.php'</script>";
}else{

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Laporan Akhir</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
	    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
    </head>
        <body onload="print()">
            <center>
            <hr>
            <img src="muhammadiyah.png" width="120px" />
                <h2>SMK MUHAMMADIYAH KAWALI</h2>
                <h4>Alamat : Jl. Poronggol Raya No.18, Kawalimukti, Kawali, Kabupaten Ciamis, Jawa Barat 46253 </h4> 
            <hr>
            </center>
            
            <section>
            <h2 class="ui header">Hasil Akhir Perhitungan</h2>
	<table class="ui celled padded table">
		<thead>
		<tr>
			<th>Overall Composite Height</th>
			<th>Rata - Rata</th>
			<?php
			for ($i=0; $i <= (getJumlahAlternatif()-1); $i++) { 
				echo "<th>".getAlternatifNama($i)."</th>\n";
			}
			?>
		</tr>
		</thead>
		<tbody>

		<?php
			for ($x=0; $x <= (getJumlahKriteria()-1) ; $x++) { 
				echo "<tr>";
				echo "<td>".getKriteriaNama($x)."</td>";
				echo "<td>".round(getKriteriaPV(getKriteriaID($x)),4)."</td>";

				for ($y=0; $y <= (getJumlahAlternatif()-1); $y++) { 
					echo "<td>".round(getAlternatifPV(getAlternatifID($y),getKriteriaID($x)),4)."</td>";
				}


				echo "</tr>";
			}
		?>
		</tbody>

		<tfoot>
		<tr>
			<th colspan="2">Total</th>
			<?php
			for ($i=0; $i <= ($jmlAlternatif-1); $i++) { 
				echo "<th>".round($nilai[$i],4)."</th>";
			}
			?>
		</tr>
		</tfoot>

	</table>


	<h2 class="ui header">Perangkingan</h2>
	<table class="ui celled padded table">
		<thead>
			<tr>
				<th>Peringkat</th>
				<th>Alternatif</th>
				<th>Nilai</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$query  = "SELECT id,nama,id_alternatif,nilai FROM alternatif,ranking WHERE alternatif.id = ranking.id_alternatif ORDER BY nilai DESC";
				$result = mysqli_query($koneksi, $query);

				$i = 0;
				while ($row = mysqli_fetch_array($result)) {
					$i++;
				?>
				<tr>
					<?php if ($i == 1) {
						echo "<td><div class=\"ui ribbon label\">Pertama</div></td>";
					} else {
						echo "<td width='100px'>".$i."</td>";
					}

					?>

					<td><?php echo $row['nama'] ?></td>
					<td><?php echo round($row['nilai'],4) ?></td>
				</tr>

				<?php	
				}


			?>
		</tbody>
	</table>
<br>
    <table align="right">
        <tr>
            <td>
                <p>Ditetapkan di : Kawali</p> 
                <p>Pada tanggal : <?php echo date("d M Y") ?></p>
                <p>Kepala Sekolah</p>
                <br><br><br><br>
                <p>Depi Kharismawan, S.Kom.</p>
                <p>NBM. 1.278.416</p>
            </td>        
        </tr>
    </table>


            </section>
            <section>
            <hr>
            <center>
            <p> Sistem Pendukung Keputusan Penilaian Kinerja Guru Terbaik dengan Metode AHP </p>
            <script>
                    $date=new Date();
                    document.write($date);
                </script>
            </center>
            <hr>

            <h3><a href="hasil.php"> Kembali </a></h3>
            </section>
            
        </body>
                    <script>
                        function print(){
                        window.print();
                    }
                        <script>

</html>
<?php } ?>
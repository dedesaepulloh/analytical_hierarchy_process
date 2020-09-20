<?php
	// connection
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$database = 'muhaka-ahp';

	$koneksi = mysqli_connect($host,$user,$password);

	if (!$koneksi)
	{
		echo "Tidak dapat terkoneksi dengan server";
		exit();
	}

	if(!mysqli_select_db($koneksi, $database))
	{
		echo "Tidak dapat menemukan database";
		exit();
	}
?>
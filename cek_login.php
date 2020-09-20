<?php 
    session_start();
    include "config.php";
    $password = md5 ($_POST['password']);
    $tampil = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$_POST[username]' AND password='$password'");
    $data = mysqli_fetch_array($tampil);

    if (!empty($data['username'])){
        $_SESSION['usename'] = $data['username'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['nama'] = $data['nama'];
        header('location: index.php');
    }else{
        echo "<script>alert('Login Gagal Username & Password Tidak Cocok'); window.location = 'login.php'</script>";
    }
//Dede Saepulloh
?>
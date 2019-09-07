<?php
	session_start();
	include'../confiq/koneksi.php';
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$sql = mysqli_query($kon, "select * from bazzar_user where username = '$user' && password = '$pass'");
	$n = mysqli_num_rows($sql);
	$f = mysqli_fetch_array($sql);
	if($n==1){
		$_SESSION['nama'] = $f['nama'];
		$_SESSION['foto'] = $f['foto'];
		header("location: utama.php?halaman=dashboard");
	}else{
		header("location: login.php");
	}

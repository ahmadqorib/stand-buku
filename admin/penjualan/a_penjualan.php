<?php
	if(isset($_GET['hapus_penjualan'])){
		include'../../confiq/koneksi.php';
		$id = $_GET['id'];
		$hapus = mysqli_query($kon, "delete from bazzar_penjualan where id_penjualan = '$id'");
		if($hapus){
			mysqli_query($kon, "delete from bazzar_detail_penjualan where id_penjualan = '$id'");
			header("location: ../utama.php?halaman=penjualan");
		}else{
			header("location: ../utama.php?halaman=penjualan");
		}
	}
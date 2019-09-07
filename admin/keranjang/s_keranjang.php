<?php
	session_start();
	include'../../confiq/koneksi.php';
	if(isset($_POST["simpanK"])){  
	   	$tgl = date("Y-m-d");
	   	$wkt = date("H:i:s");
	   	$simpan = "insert into bazzar_penjualan (tgl, waktu) values ('$tgl', '$wkt')";
	   	$order_id = "";  

	   	if(mysqli_query($kon, $simpan))  {  
	        $id_penjualan = mysqli_insert_id($kon);  
	  	}  

	   	$_SESSION["id_penjualan"] = $id_penjualan;  
	   	$order_details = "";
	   	$cek = 0;

	   	foreach($_SESSION["shopping_cart"] as $keys => $values){    
			$simpan_detail = "INSERT INTO bazzar_detail_penjualan (id_penjualan, id_buku, qty, harga, diskon) 
				VALUES ('".$id_penjualan."', '".$values["product_id"]."', '".$values["product_quantity"]."',
						 '".$values["product_hdiskon"]."', '".$values["product_diskon"]."')";
			$simpanB = mysqli_query($kon, $simpan_detail);
			if($simpanB){
				$stok = $values['product_quantity'];
				$idne = $values['product_id'];
				$st = mysqli_query($kon, "select * from bazzar_buku where id_buku='$idne'");
				$c = mysqli_fetch_array($st);
				$jstok = $c['jumlah'] - $stok;
				mysqli_query($kon, "update bazzar_buku set jumlah = '$jstok' where id_buku='$idne'");
				$cek++;
			}
	   	}   

	   	if($cek > 0){
	   		unset($_SESSION["shopping_cart"]);  
	   		echo"<script> alert('Data pembelian berhasil disimpan :) ');
	   			document.location.href='../utama.php?halaman=keranjang-belanja'</script>";
	   	}else{
	   		echo"<script> alert('Terdapat data yang tidak tersimpan :( ');
	   			document.location.href='../utama.php?halaman=keranjang-belanja'</script>";
	   	} 
	} 
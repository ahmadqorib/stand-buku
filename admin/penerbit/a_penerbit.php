<?php
	include'../confiq/koneksi.php';
	if(isset($_POST['simpan'])){
		$penerbit = $_POST['penerbit'];
		$diskon = $_POST['diskon'];

		$simpan = mysqli_query($kon, "insert into penerbit (penerbit, diskon) values ('$penerbit', '$diskon')");
		if($simpan){
			echo"<script>document.location.href='utama.php?halaman=penerbit'</script>";
		}
	}

	if(isset($_POST['edit'])){
		$id = $_GET['id'];
		$penerbit = $_POST['penerbit'];
		$diskon = $_POST['diskon'];

		$edit = mysqli_query($kon, "update penerbit set penerbit='$penerbit', diskon='$diskon' where id_penerbit='$id'");
		if($edit){
			echo"<script>document.location.href='utama.php?halaman=penerbit'</script>";
		}
	}

	if(isset($_GET['hapus_penerbit'])){
		include'../../confiq/koneksi.php';
		$id = $_GET['id'];
		$hapus = mysqli_query($kon, "delete from penerbit where id_penerbit = '$id'");
		if($hapus){
			header("location: ../utama.php?halaman=penerbit");
		}else{
			header("location: ../utama.php?halaman=penerbit");
		}
	}
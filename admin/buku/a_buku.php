<?php
	if(isset($_POST['simpan'])){
		$judul = $_POST['judul_buku'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$thn = $_POST['thn'];
		$diskon = $_POST['diskon'];
		$harga = $_POST['harga'];
		$jumlah = $_POST['jumlah'];

		$foto = $_FILES['foto']['name'];
		$file_tmp = $_FILES['foto']['tmp_name'];
		move_uploaded_file($file_tmp, 'images/buku/'.$foto);

		$simpan = mysqli_query($kon, "insert into buku (judul_buku,pengarang,penerbit,thn_terbit, diskon, harga, jumlah, foto) 
			values ('$judul', '$pengarang', '$penerbit','$thn', '$diskon', '$harga', '$jumlah', '$foto')");
		if($simpan){
			echo"<script>document.location.href='utama.php?halaman=buku'</script>";
		}
	}

	if(isset($_POST['edit'])){
		$judul = $_POST['judul_buku'];
		$pengarang = $_POST['pengarang'];
		$penerbit = $_POST['penerbit'];
		$thn = $_POST['thn'];
		$diskon = $_POST['diskon'];
		$harga = $_POST['harga'];
		$jumlah = $_POST['jumlah'];
		$foto = $_FILES['foto']['name'];
		$f = $_POST['hiddenf'];

		if(empty($foto)){
			$foto = $f;
		}else{
			$file_tmp = $_FILES['foto']['tmp_name'];
			move_uploaded_file($file_tmp, 'images/buku/'.$foto);
		}

		$edit = mysqli_query($kon, "update buku set judul_buku='$judul', pengarang='$pengarang', penerbit='$penerbit', thn_terbit='$thn', diskon='$diskon', harga='$harga', jumlah='$jumlah', foto='$foto' where id_buku='$id'");
		if($edit){
			echo"<script>document.location.href='utama.php?halaman=buku'</script>";
		}
	}

	if(isset($_GET['hapus_buku'])){
		include'../../confiq/koneksi.php';
		$id = $_GET['id'];
		$hapus = mysqli_query($kon, "delete from buku where id_buku = '$id'");
		if($hapus){
			header("location: ../utama.php?halaman=buku");
		}else{
			header("location: ../utama.php?halaman=buku");
		}
	}
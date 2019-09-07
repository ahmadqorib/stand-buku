<?php
	include'../confiq/koneksi.php';
	if(isset($_POST['simpan'])){
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$nama = $_POST['nama'];

		$foto = $_FILES['foto']['name'];
		$file_tmp = $_FILES['foto']['tmp_name'];
		move_uploaded_file($file_tmp, 'images/user/'.$foto);

		$simpan = mysqli_query($kon, "insert into bazzar_user (username,password,nama,foto) values ('$user', '$pass', '$nama','$foto')");
		if($simpan){
			echo"<script>document.location.href='utama.php?halaman=pengguna'</script>";
		}
	}

	if(isset($_POST['edit'])){
		$id = $_GET['id'];
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$nama = $_POST['nama'];
		$foto = $_FILES['foto']['name'];
		$f = $_POST['hiddenf'];

		if(empty($foto)){
			$foto = $f;
		}else{
			$file_tmp = $_FILES['foto']['tmp_name'];
			move_uploaded_file($file_tmp, 'images/user/'.$foto);
		}

		$simpan = mysqli_query($kon, "update bazzar_user set username='$user', password='$pass', nama='$nama', foto='$foto' where id_user='$id'");
		if($simpan){
			echo"<script>document.location.href='utama.php?halaman=pengguna'</script>";
		}
	}

	if(isset($_GET['hapus_pengguna'])){
		include'../../confiq/koneksi.php';
		$id = $_GET['id'];
		$hapus = mysqli_query($kon, "delete from bazzar_user where id_user = '$id'");
		if($hapus){
			header("location: ../utama.php?halaman=pengguna");
		}else{
			header("location: ../utama.php?halaman=pengguna");
		}
	}
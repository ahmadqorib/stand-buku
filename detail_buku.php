<!DOCTYPE html>
<html>
<head>
	<title>Detail Buku <?php echo $_GET['id_buku']; ?></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<style type="text/css">
		.navbar {
		  background-color: #991f00;
		  border: none;
		  border-radius: 0px;
		}

		.navbar .navbar-header a{
			color: #FFF;
		}

	</style>
</head>
<body>
	<?php 
		include 'confiq/koneksi.php';
		$id = $_GET['id_buku'];
		$sql = mysqli_query($kon, "select * from bazzar_buku where id_buku = '$id'");
		$r = mysqli_fetch_array($sql);
		$sql2 = mysqli_query($kon, "select * from bazzar_penerbit where id_penerbit = '$r[penerbit]'");
		$row = mysqli_fetch_array($sql2);
		$hargat = $r['harga'] - ($r['diskon']/100*$r['harga']);
	?>
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a href="" class="navbar-brand">BAZZAR BUKU HMJ TI STMIK AKAKOM YOGYAKARTA</a>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="alert alert-info">
			Detail Buku
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2">
						<div class="thumbnail">
							<img src="admin/images/buku/<?=$r['foto'];?>" class="img-responsive">
						</div>
					</div>
					<div class="col-md-10">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table">
									<tr>
										<td>Judul Buku</td>
										<td>:</td>
										<td><?php echo $r['judul_buku']; ?></td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>Pengarang</td>
										<td>:</td>
										<td><?php echo $r['pengarang']; ?></td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>Penerbit</td>
										<td>:</td>
										<td><?php echo $row['penerbit']; ?></td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>Stok</td>
										<td>:</td>
										<td><?php echo $r['jumlah']; ?></td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>Diskon</td>
										<td>:</td>
										<td><?php echo $r['diskon']; ?> %</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>Harga</td>
										<td>:</td>
										<td>Rp <?php echo number_format($hargat,0,",","."); ?></td>
										<td>&nbsp;</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
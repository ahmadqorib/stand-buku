<?php
$buku=mysqli_query($kon,"select buku.id_buku, buku.foto, buku.judul_buku, buku.harga, buku.jumlah, buku.diskon, penerbit.penerbit from buku, penerbit where id_buku='$_GET[id]' and buku.penerbit=penerbit.id_penerbit")or die(mysqli_error($kon));
$data=mysqli_fetch_array($buku);
$isi=$data['penerbit'];
?>
<div class="container">
<div class="row-clearfix">
<div class="col-md-12 column">
<p>
<div class="col-md-4">
<div class="panel-body">
<?php if($data['foto']!="")?>
<img src="admin/images/buku/<?=$data['foto'];?>" class="img-responsive" width="100%" >
</div>
</div>
</p>
<div class="col-md-8">
<p>
<h4><span class="glyphicon glyphicon-th-list"></span> Detail Buku</h4>
<div class="panel panel-primary">
<div class="panel-heading">
<h2 class="panel-title"><?=$data['judul_buku'];?></h2>
</div>
<div class="panel-body">
<p><?= $isi; ?></p>
</div>
</div>

<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Harga</th>
					<th>Diskon</th>
					<th>Total Harga</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo strstr("harga Rp.","Rp.");
					?><?= $data['harga']?></td>
					<td><?= $data['diskon']?> <?php
					echo strstr("diskion %","%");
					?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
</p>
</div>
</div>
</div>
</div>

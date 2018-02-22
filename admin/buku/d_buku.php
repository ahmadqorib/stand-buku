<link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.css">
<div class="panel panel-info">
	<div class="panel-heading">Data Buku 
		<a href="?halaman=tambah_buku" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
	</div>
	<div class="panel-body">
		<table class="table table-striped table-bordered table-responsive product-form" id="dataTables-example" width="100%">
			<thead class="tabele">
				<tr style="padding: 10px">
					<td width="2%">No.</td>
					<td width="20%">Judul Buku</td>
					<td>Pengarang</td>
					<td>Penerbit</td>
					<td>Tahun Terbit</td>
					<td>Diskon</td>
					<td>Harga</td>
					<td>Stok</td>
					<td>Foto</td>
					<td width="7%">Aksi</td>
				</tr>
			</thead>
			<tbody>
				<?php
					include'../confiq/koneksi.php';
					$no = 0;

					$sql = mysqli_query($kon, "select * from buku order by judul_buku asc");
					while($r=mysqli_fetch_array($sql)){
						$pen = mysqli_query($kon, "select * from penerbit where id_penerbit='$r[penerbit]'");
						$p = mysqli_fetch_array($pen);
						$diskon = $p['diskon'];

						$hjual = $r['harga'] - ($r['harga'] * $r['diskon'] / 100);
						$no++;
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $r['judul_buku'];?></td>
					<td><?php echo $r['pengarang'];?></td>
					<td><?php echo $p['penerbit'];?></td>
					<td><?php echo $r['thn_terbit']; ?></td>
					<td><?php echo $r['diskon']; ?>%</td>
					<td>
						<b>Asli-></b> Rp <?php echo number_format($r['harga'],0,",","."); ?>
						<!-- <br><b>Diskon penerbit-></b> Rp <?php //echo number_format($hit,0,",","."); ?> -->
						<br><b>Jual-></b> Rp <?php echo number_format($hjual,0,",","."); ?>
					</td>
					<td><?php echo $r['jumlah']; ?></td>
					<td>
						<input name="product_code" type="hidden" value="<?php echo $r["id_buku"]; ?>">
						<input type="hidden" name="quantity" id="qty<?php echo $r["id_buku"]; ?>" value="1" />  
						<input type="hidden" name="quantity" id="jml<?php echo $r["id_buku"]; ?>" value="<?php echo $r['jumlah']; ?>" />
                    	<input type="hidden" name="hidden_name" id="judul<?php echo $r["id_buku"]; ?>" value="<?php echo $r["judul_buku"]; ?>" />  
                    	<input type="hidden" name="hidden_price" id="harga<?php echo $r["id_buku"]; ?>" value="<?php echo $r["harga"]; ?>" />
						<input type="hidden" name="diskon" id="diskon<?php echo $r["id_buku"]; ?>" value="<?php echo $r['diskon']; ?>">
						<input type="hidden" name="hdiskon" id="hdiskon<?php echo $r["id_buku"]; ?>" value="<?php echo $hjual; ?>">
                    	<input type="hidden" name="hidden_foto" id="foto<?php echo $r["id_buku"]; ?>" value="<?php echo $r["foto"]; ?>" />
						<img src="images/buku/<?php echo $r['foto'];?>" class="img-responsive" width="125px">
					</td>
					<td style="padding: 4px">
						<button type="button" name="add_to_cart" id="<?php echo $r["id_buku"]; ?>" style="margin-bottom:5px;" 
							class="btn btn-xs btn-success add_to_cart"/><span class="glyphicon glyphicon-shopping-cart"></span> beli</button>
						<a href="?halaman=edit_buku&id=<?php echo $r['id_buku']; ?>" class="btn btn-xs btn-warning" style="margin-bottom: 5px">
							<span class="glyphicon glyphicon-edit"></span> edit</a>
						<a data-href="buku/a_buku.php?hapus_buku&id=<?php echo $r['id_buku']; ?>" class="btn btn-xs btn-danger"  style="margin-bottom: 5px"
							data-toggle="modal" data-target="#conhapus"><span class="glyphicon glyphicon-remove"></span> hapus</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<?php include'buku/a_buku.php'; ?>
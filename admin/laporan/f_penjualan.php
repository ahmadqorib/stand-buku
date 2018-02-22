<div class="panel panel-info">
	<div class="panel-heading">LAPORAN PENJUALAN BUKU</div>
	<div class="panel-body">
		<div class="thumbnail" style="padding: 10px">
			<h5>Laporan Penjualan Keseluruhan</h5>	
			<a href="laporan/l_penjualan.php" class="btn btn-danger" target="_blank">
				<span class="glyphicon glyphicon-print"></span> Cetak Laporan</a>
		</div>
		<div class="thumbnail" style="padding: 10px">
			<h5>Laporan Penjualan Tiap Penerbit</h5>
			<div class="row">
				<form method="post" target="_blank" action="laporan/l_penjualan_penerbit.php">
					<div class="col-md-4">
						<select name="pen" class="form-control">
							<option value="">Seluruh Penerbit</option>
							<?php 
								$sqlp = mysqli_query($kon, "select * from penerbit");
								while ($p = mysqli_fetch_array($sqlp)) {
							?>
							<option value="<?php echo $p['penerbit']; ?>"><?php echo $p['penerbit']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-md-4">
						<button type="submit" class="btn btn-danger">
							<span class="glyphicon glyphicon-print"></span> Cetak Laporan</a>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

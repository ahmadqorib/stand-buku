<div class="panel panel-info">
	<div class="panel-heading">Data Penjualan</div>
	<div class="panel-body">
		<form class="form-inline" method="post" style="padding: 10px 0;" class="kanggoCari">
			<div class="form-group">
				<label>Tanggal :</label>
				<select name="tgl" class="form-control">
					<option value="">Pilih Tanggal</option>
					<?php
						for($i=1;$i<=31;$i++){
							echo "<option value='$i'>$i</option>";
						}
					?>
				</select>
			</div>
			<div class="form-group" style="padding-left: 10px;">
				<label>Bulan :</label>
				<select name="bln" class="form-control">
					<option value="">Pilih Bulan</option>
					<?php
						for($i=1;$i<=12;$i++){
							echo "<option value='$i'>$i</option>";
						}
					?>
				</select>
			</div>
			<div class="form-group" style="padding-left: 10px;">
				<label>Tahun :</label>
				<input type="text" name="thn" class="form-control">
			</div>
			<div class="form-group" style="padding-left: 10px;">				
				<input type="submit" name="tampil" class="btn btn-primary" value="Tampilkan">
				<input type="submit" name="refresh" class="btn btn-default" value="Refresh">
			</div>
		</form>
		<table class="table table-striped table-bordered table-responsive product-form">
			<thead class="tabele">
				<tr style="padding: 10px">
					<td width="5%">No.</td>
					<td>Id Penjualan</td>
					<td>Tanggal</td>
					<td>Waktu</td>
					<td>Status</td>
					<td>Aksi</td>
				</tr>
			</thead>
			<tbody>
				<?php
					include'../confiq/koneksi.php';
					$no = 0;
					$sql = mysqli_query($kon, "select * from penjualan order by tgl desc");
					if(isset($_POST['tampil'])){
						$tgl = $_POST['tgl'];
						$bln = $_POST['bln'];
						$thn = $_POST['thn'];
						if(!empty($tgl) and empty($bln) and empty($thn)){
							$sql = mysqli_query($kon, "select * from penjualan where day(tgl) = '$tgl'");
						}else if(empty($tgl) and !empty($bln) and empty($thn)){
							$sql = mysqli_query($kon, "select * from penjualan where month(tgl) = '$bln'");
						}else if(empty($tgl) and empty($bln) and !empty($thn)){
							$sql = mysqli_query($kon, "select * from penjualan where year(tgl) = '$thn'");
						}else if(!empty($tgl) and !empty($bln) and !empty($thn)){
							$ahay = $thn."-".$bln."-".$tgl;
							$sql = mysqli_query($kon, "select * from penjualan where tgl = '$ahay'");
						}
					}else{
						$sql = mysqli_query($kon, "select * from penjualan order by tgl desc");
					}
					while($r=mysqli_fetch_array($sql)){
						$no++;
						$bulanind = array("Januari", "February", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
						$tahun = substr($r['tgl'], 0, 4);
						$bulan = substr($r['tgl'], 5, 2);
						$hari = substr($r['tgl'], 8, 2);
						$hasiltgl = $hari." ".$bulanind[(int)$bulan-1]." ".$tahun;
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $r['id_penjualan'];?></td>
					<td><?php echo $hasiltgl; ?></td>
					<td><?php echo $r['waktu'];?></td>
					<td><span class="label label-success">Sudah Bayar</span></td>
					<td>
						<button data-toggle="collapse" data-target="<?php echo "#".$r['id_penjualan']; ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-list"></span> Detail</button>
						<a data-href="penjualan/a_penjualan.php?hapus_penjualan&id=<?php echo $r['id_penjualan']; ?>" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#conhapus">
							<span class="glyphicon glyphicon-remove"></span> hapus</a>
					</td>
				</tr>
				<tr id="<?php echo $r['id_penjualan']; ?>" class="collapse">
					<td>&nbsp;</td>
					<td colspan="5">
						<table class="table table-bordered">
							<thead>
								<tr>
									<td width="40%">Judul Buku</td>
									<td width="16%">Qty</td>
									<td width="22%">Harga</td>
									<td width="22%">Harga Total </td>
								</tr>
							</thead>
							<tbody>
								<?php
									$det = mysqli_query($kon, "select id_penjualan, judul_buku, qty, dp.harga, (qty * dp.harga) as total from detail_penjualan dp, buku b where dp.id_buku=b.id_buku and dp.id_penjualan='$r[id_penjualan]'");
										$totale = 0;
									while($oi = mysqli_fetch_array($det)){
										$totale = $totale + $oi['total'];
								?>
							<tr>
								<td><?php echo $oi['judul_buku']; ?></td>
								<td><?php echo $oi['qty']; ?></td>
								<td>Rp <?php echo number_format($oi['harga'], 0, ',', '.'); ?></td>
								<td>Rp <?php echo number_format($oi['total'], 0, ',', '.'); ?></td>
							</tr>
								<?php } ?>
							<tr>
								<td><b>Total Harga</b></td>
								<td></td>
								<td></td>
								<td>Rp <?php echo number_format($totale, 0, ',', '.'); ?></td>
							</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php include'buku/a_buku.php'; ?>
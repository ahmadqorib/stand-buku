<div class="col-md-4">
	<div class="ngarep">
		<table class="table table-responsive" style="padding-top: 0px;">
			<tr class="thead">
				<th colspan="2">TOTAL BUKU TERJUAL</th>
			</tr>
			<?php
				// $ckck = mysqli_query($kon, "select penerbit, sum(qty) as jumlah from data_penjualan_penerbit group by penerbit");
				$sum = 0;
			$ckck = mysqli_query($kon, "SELECT * FROM bazzar_penerbit ORDER BY penerbit");
				while($ck = mysqli_fetch_array($ckck)){
					$detail = mysqli_query($kon, "SELECT sum(qty) as juml FROM bazzar_detail_penjualan d, bazzar_buku b 
						WHERE d.id_buku = b.id_buku AND b.penerbit = $ck[id_penerbit] ");
					$ho = mysqli_fetch_array($detail);
					$sum = $sum + $ho['juml'];
			?>
			<tr>
				<td><label class="label label-info"><?php echo $ck['penerbit']; ?></label></td>
				<td>
					<label class="label label-danger">
						<?php 
							if(empty($ho['juml'])){
								echo "0";
							}else{
								echo $ho['juml']; 
							}
						?>
					</label>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td><label class="label label-success">Total Buku Terjual</label></td>
				<td><label class="label label-primary"><?php echo $sum; ?></label></td>
			</tr>
		</table>
	</div>
</div>
<div class="col-md-8">
	
</div>


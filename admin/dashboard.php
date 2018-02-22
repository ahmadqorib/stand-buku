<div class="col-md-4">
	<div class="ngarep">
		<table class="table table-responsive" style="padding-top: 0px;">
			<tr class="thead">
				<th colspan="2">TOTAL BUKU TERJUAL</th>
			</tr>
			<?php
				$ckck = mysqli_query($kon, "select penerbit, sum(qty) as jumlah from data_penjualan_penerbit group by penerbit");
				$sum = 0;
				while($ck = mysqli_fetch_array($ckck)){
					$sum = $sum + $ck['jumlah'];
			?>
			<tr>
				<td><label class="label label-info"><?php echo $ck['penerbit']; ?></label></td>
				<td><label class="label label-danger"><?php echo $ck['jumlah']; ?></label></td>
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


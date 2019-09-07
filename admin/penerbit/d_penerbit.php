<div class="col-md-8">
	<div class="panel panel-info">
		<div class="panel-heading panel-data">Data Penerbit
			<a href="?halaman=tambah_penerbit" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
		</div>
		<div class="panel-body">
			<table class="table table-striped table-bordered table-responsive">
				<thead class="tabele">
					<tr>
						<td width="10px">No.</td>
						<td>Penerbit</td>
						<td>Diskon</td>
						<td>Aksi</td>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 0;
						$sql = mysqli_query($kon, "select * from bazzar_penerbit");
						while($r=mysqli_fetch_array($sql)){
							$no++;
					?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $r['penerbit'];?></td>
						<td><?php echo $r['diskon'];?> %</td>
						<td>
							<a href="?halaman=edit_penerbit&id=<?php echo $r['id_penerbit']; ?>" class="btn btn-xs btn-warning">
									<span class="glyphicon glyphicon-edit"></span> edit</a>
							<a data-href="penerbit/a_penerbit.php?hapus_penerbit&id=<?php echo $r['id_penerbit']; ?>" class="btn btn-xs btn-danger" 
								data-toggle="modal" data-target="#conhapus">
									<span class="glyphicon glyphicon-remove"></span> hapus</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include'penerbit/a_penerbit.php'; ?>
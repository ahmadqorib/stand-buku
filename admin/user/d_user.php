<div class="panel panel-info">
	<div class="panel-heading panel-data">Data Pengguna 
		<a href="?halaman=tambah_pengguna" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
	</div>
	<div class="panel-body">
		<table class="table table-striped table-bordered table-responsive">
			<thead class="tabele">
				<tr>
					<td width="10px">No.</td>
					<td>Username</td>
					<td>Password</td>
					<td>Nama Lengkap</td>
					<td>Foto</td>
					<td>Aksi</td>
				</tr>
			</thead>
			<tbody>
				<?php
					include'../confiq/koneksi.php';
					$no = 0;
					$sql = mysqli_query($kon, "select * from bazzar_user order by nama asc");
					while($r=mysqli_fetch_array($sql)){
						$no++;
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $r['username'];?></td>
					<td><?php echo $r['password'];?></td>
					<td><?php echo $r['nama'];?></td>
					<td>
					<?php if(!empty($r['foto'])){ ?>
						<img src="images/user/<?php echo $r['foto'];?>" class="img-responsive" width="125px"></td>
					<?php }else{ ?>
						<img src="images/default-user.png" class="img-responsive" width="125px"></td>
					<?php } ?>
					<td>
						<a href="?halaman=edit_pengguna&id=<?php echo $r['id_user']; ?>" class="btn btn-xs btn-warning">
								<span class="glyphicon glyphicon-edit"></span> edit</a>
						<a data-href="user/a_user.php?hapus_pengguna&id=<?php echo $r['id_user']; ?>" class="btn btn-xs btn-danger" 
							data-toggle="modal" data-target="#conhapus">
								<span class="glyphicon glyphicon-remove"></span> hapus</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<?php include'user/a_user.php'; ?>
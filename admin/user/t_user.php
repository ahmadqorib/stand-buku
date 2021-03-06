<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<div class="panel panel-info">
	<div class="panel-heading">Tambah Data Pengguna</div>
	<div class="panel-body">
		<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
				<label class="control-label col-md-2">Username :</label>
				<div class="col-md-4">
					<input type="text" name="username" class="form-control input-sm" placeholder="masukkan username...">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Password :</label>
				<div class="col-md-4">
					<input type="password" name="password" class="form-control input-sm" placeholder="masukkan password...">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Nama Lengkap :</label>
				<div class="col-md-4">
					<input type="text" name="nama" class="form-control input-sm" placeholder="masukkan nama anda...">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Foto :</label>
				<div class="col-md-4">
					<input type="file" name="foto" class="form-control input-sm">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<div class="col-md-10 col-md-offset-2">
					<a href="?halaman=pengguna" class="btn btn-warning btn-sm">Kembali</a>
					<input type="submit" class="btn btn-primary btn-sm" name="simpan" value="Simpan">
					<input type="reset" class="btn btn-danger btn-sm" value="Reset">
				</div>
			</div>
			<?php include'user/a_user.php'; ?>
		</form>
	</div>
</div>

<script type="text/javascript">  
  $('form').validate({
        rules: {
            username:{
              required:true
            },
            password:{
              required:true
            },
            nama:{
              required:true
            },
        },
         messages: {
            username:{
              	required: "<span class='pering'>Username tidak boleh kosong !!</span>",
            },
            password:{
              	required: "<span class='pering'>Password tidak boleh kosong !!</span>",
            },
            nama:{
              	required: "<span class='pering'>Nama tidak boleh kosong !!</span>",
            }
         }
    });
</script>
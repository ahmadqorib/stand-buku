<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<div class="panel panel-info">
	<div class="panel-heading">Tambah Data Penerbit</div>
	<div class="panel-body">
		<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
				<label class="control-label col-md-2">Penerbit :</label>
				<div class="col-md-4">
					<input type="text" name="penerbit" class="form-control input-sm" placeholder="masukkan penerbit...">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Diskon Penerbit :</label>
				<div class="col-md-4">
					<input type="text" name="diskon" class="form-control input-sm" placeholder="masukkan diskon %...">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<div class="col-md-10 col-md-offset-2">
					<a href="?halaman=penerbit" class="btn btn-warning btn-sm">Kembali</a>
					<input type="submit" class="btn btn-primary btn-sm" name="simpan" value="Simpan">
					<input type="reset" class="btn btn-danger btn-sm" value="Reset">
				</div>
			</div>
			<?php include'penerbit/a_penerbit.php'; ?>
		</form>
	</div>
</div>

<script type="text/javascript">  
  $('form').validate({
        rules: {
            penerbit:{
              required:true
            },
            diskon:{
              required:true,
              digits:true
            },
        },
         messages: {
            penerbit:{
              	required: "<span class='pering'>Nama Penerbit tidak boleh kosong !!</span>",
            },
            diskon:{
              	required: "<span class='pering'>Diskon tidak boleh kosong !!</span>",
              	digits: "<span class='pering'>Tolong masukkan diskon dengan angka !!</span>"
            }
         }
    });
</script>
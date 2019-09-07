<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<div class="panel panel-info">
	<div class="panel-heading">Tambah Data Buku</div>
	<div class="panel-body">
		<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
				<label class="control-label col-md-2">Judul Buku :</label>
				<div class="col-md-4">
					<input type="text" name="judul_buku" class="form-control input-sm" placeholder="masukkan judul buku...">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Pengarang :</label>
				<div class="col-md-4">
					<input type="text" name="pengarang" class="form-control input-sm" placeholder="masukkan pengarang...">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Penerbit :</label>
				<div class="col-md-4">
					<select name="penerbit" class="form-control input-sm" onchange="changeValue(this.value)">
						<option value="">Pilih Penerbit</option>
						<?php 
							$jsArray = "var dtDiskon = new Array();"; 
							$sql = mysqli_query($kon, "select * from bazzar_penerbit order by penerbit");
							while($r=mysqli_fetch_array($sql)){
						?>
							<option value="<?php echo $r['id_penerbit']; ?>"><?php echo $r['penerbit']; ?></option>
						<?php 
							$jsArray .= "dtDiskon['" . $r['id_penerbit'] . "'] = 
								{diskon:'Maksimal diskon yang diberikan : " . addslashes($r['diskon']) . " %'};\n";
							} 
						?>
					</select>
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Tahun Terbit :</label>
				<div class="col-md-4">
					<input type="text" name="thn" class="form-control input-sm" placeholder="masukkan tahun terbit...">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Diskon :</label>
				<div class="col-md-4">
					<input type="text" name="diskon" class="form-control input-sm" placeholder="masukkan diskon...">
				</div>
				<div class="col-md-3">
					<input type="text" disabled="" id="dsk" class="form-control input-sm" value="Maksimal diskon yang diberikan : 0 %"> 
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Harga :</label>
				<div class="col-md-4">
					<input type="text" name="harga" class="form-control input-sm" placeholder="masukkan harga...">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">jumlah :</label>
				<div class="col-md-4">
					<input type="text" name="jumlah" class="form-control input-sm" placeholder="masukkan jumlah...">
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
					<a href="?halaman=buku" class="btn btn-warning btn-sm">Kembali</a>
					<input type="submit" class="btn btn-primary btn-sm" name="simpan" value="Simpan">
					<input type="reset" class="btn btn-danger btn-sm" value="Reset">
				</div>
			</div>
			<?php include'buku/a_buku.php'; ?>
		</form>
	</div>
</div>

<script type="text/javascript">    
    <?php echo $jsArray; ?>  
    function changeValue(penerbit){  
    	document.getElementById('dsk').value = dtDiskon[penerbit].diskon;   
    };  
</script> 
<script type="text/javascript">  
  $('form').validate({
        rules: {
            judul_buku:{
              	required:true
            },
            pengarang:{
              	required:true
            },
            penerbit:{
              	required:true
            },
            diskon:{
            	digits:true,
            	required:true
            },
            harga:{
            	digits:true,
              	required:true
            },
            jumlah:{
            	digits:true,
              	required:true
            },
            foto:{
              	required:true
            },
        },
         messages: {
            judul_buku:{
              	required: "<span class='pering'>Judul buku tidak boleh kosong !!</span>",
            },
            pengarang:{
              	required: "<span class='pering'>Pengarang tidak boleh kosong !!</span>",
            },
            penerbit:{
              	required: "<span class='pering'>Penerbit tidak boleh kosong !!</span>",
            },
            diskon:{
              	required: "<span class='pering'>Diskon tidak boleh kosong !!</span>",
              	digits: "<span class='pering'>Tolong masukkan diskon dengan angka !!"
            },
            harga:{
              	required: "<span class='pering'>Harga tidak boleh kosong !!</span>",
              	digits: "<span class='pering'>Tolong masukkan harga dengan angka !!"
            },
            jumlah:{
              	required: "<span class='pering'>Jumlah tidak boleh kosong !!</span>",
              	digits: "<span class='pering'>Tolong masukkan jumlah dengan angka !!"
            },
            foto:{
              	required: "<span class='pering'>Foto tidak boleh kosong !!</span>",
            }
         }
    });
</script>
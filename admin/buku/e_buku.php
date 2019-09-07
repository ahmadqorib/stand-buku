<?php
	$id = $_GET['id'];
	$sql = mysqli_query($kon, "select * from bazzar_buku where id_buku='$id'");
	$r = mysqli_fetch_assoc($sql);
	$pen = mysqli_query($kon, "select * from bazzar_penerbit where id_penerbit='$r[penerbit]'");
	$p = mysqli_fetch_array($pen);
?>
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<div class="panel panel-info">
	<div class="panel-heading">Edit Data Buku</div>
	<div class="panel-body">
		<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
				<label class="control-label col-md-2">Judul Buku :</label>
				<div class="col-md-4">
					<input type="text" name="judul_buku" class="form-control input-sm" placeholder="masukkan judul buku..." value="<?php echo $r['judul_buku']; ?>">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Pengarang :</label>
				<div class="col-md-4">
					<input type="text" name="pengarang" class="form-control input-sm" placeholder="masukkan pengarang..." value="<?php echo $r['pengarang']; ?>">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Penerbit :</label>
				<div class="col-md-4">
					<select name="penerbit" class="form-control input-sm" onchange="changeValue(this.value)">
						<option value="<?php echo $r['penerbit']; ?>"><?php echo $p['penerbit']; ?></option>
						<option value="">Pilih Penerbit Lain</option>
						<?php 
							$jsArray = "var dtDiskon = new Array();"; 
							$cek = $r['penerbit'];
							$sq = mysqli_query($kon, "select * from bazzar_penerbit order by penerbit");
							while($ro=mysqli_fetch_array($sq)){
						?>
							<option value="<?php echo $ro['id_penerbit']; ?>"><?php echo $ro['penerbit']; ?></option>
						<?php 
							$jsArray .= "dtDiskon['" . $ro['id_penerbit'] . "'] = 
								{diskon:'Maksimal diskon yang diberikan : " . addslashes($ro['diskon']) . " %'};\n";
							} 
						?>
					</select>
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Tahun Terbit :</label>
				<div class="col-md-4">
					<input type="text" name="thn" class="form-control input-sm" placeholder="masukkan tahun terbit..." value="<?php echo $r['thn_terbit']; ?>">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Diskon :</label>
				<div class="col-md-4">
					<input type="text" name="diskon" class="form-control input-sm" placeholder="masukkan diskon..." value="<?php echo $r['diskon']; ?>">
				</div>
				<div class="col-md-3">
					<input type="text" disabled="" id="dsk" class="form-control input-sm" value="Maksimal diskon yang diberikan : <?php echo $p['diskon']; ?> %"> 
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Harga :</label>
				<div class="col-md-4">
					<input type="text" name="harga" class="form-control input-sm" placeholder="masukkan harga..." value="<?php echo $r['harga']; ?>">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">jumlah :</label>
				<div class="col-md-4">
					<input type="text" name="jumlah" class="form-control input-sm" placeholder="masukkan jumlah..." value="<?php echo $r['jumlah']; ?>">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-2">Foto :</label>
				<div class="col-md-4">
					<input type="file" name="foto" class="form-control input-sm">
					<input type="text" name="hiddenf" hidden="" value="<?php echo $r['foto']; ?>">
					<img src="images/buku/<?php echo $r['foto']; ?>" class="img-responsive img-rounded" style="padding: 1px;">
				</div>
				<div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<div class="col-md-10 col-md-offset-2">
					<a href="?halaman=buku" class="btn btn-warning btn-sm">Kembali</a>
					<input type="submit" class="btn btn-primary btn-sm" name="edit" value="Edit">
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
            }
         }
    });
</script>
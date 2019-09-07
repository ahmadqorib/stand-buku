<?php
$buku=mysqli_query($kon,"select distinct id_buku, judul_buku, foto, pengarang from buku order by id_buku")or die(mysqli_error($koneksi));
$hasil=array();
while($data=mysqli_fetch_array($buku, MYSQL_ASSOC)){
$hasil[]=$data;

$a=json_encode(array('hasil'=>$hasil));
$b=json_decode($a,TRUE);
}
?>
	<div class="container">
	<div class="row-clearfix">
	<div class="col-md-12 column">
	<div class="carousel-inner" role="listbox">

	<div class="item">
	<img alt="" src="admin/images/buku/<?=$nilai['foto'];?>" href="?tampil=isi_detail&id=<?=$nilai['id_buku'];?>">
	<div class="carousel-caption">
<h4><?=$nilai['judul_buku'];?></h4>
<p><?=$isi?></p>
</div>
</div>

</div>
</div>
</div>
</div>
<?php include("isi_home.php"); ?>

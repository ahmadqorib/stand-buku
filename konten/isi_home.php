<?php
$hal=isset($_GET['hal'])?$_GET['hal']:"";
$batas=4;
if(empty($hal)){
$posisi=0;
$hal=1;
}
else{
$posisi=($hal-1)*$batas;
}
$buku=mysqli_query($kon,"select * from buku order by id_buku")or die(mysqli_error($kon));
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
<div class="row">
<?php
foreach( $b['hasil'] as $kunci => $nilai){
?>

<div class="col-md-3" style="position: inherit;">
<div class="thumbnail" style="height:350px;">
	<?php if($nilai['foto']!="")
{
	?>
<img height="100" src="admin/images/buku/<?=$nilai['foto'];?>" class="img-responsive" width="300" >
<?php
}
?>
<div class="caption">
<h4><?= $nilai['judul_buku']?></h4>
<h5><?php echo strstr("harga Rp.","Rp.");
?><?= $nilai['harga']?></h5>
<p><?= $nilai['diskon']?> <?php
echo strstr("diskion %","%");
?></p>
<p>
<a class="btn btn-primary" href="?tampil=isi_detail&id=<?=$nilai['id_buku'];?>"><span class="glyphicon glyphicon-eye-open">
</span></a>
</p>
</div>
</div>
</div>
<?php
}
?>
</div>
</div>
</div>
</div>

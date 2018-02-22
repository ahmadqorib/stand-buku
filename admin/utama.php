<?php
	session_start();
	if(empty($_SESSION['nama'])){
		header("location: login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Stand Buku</title>
	<link rel="icon" href="images/logo_hmjti.png">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<style type="text/css">
		#konten .isi{
			padding: 0px 7px;
		}

		#konten .isi .tabele{
			background-color: #fff;
			font-weight: bold;
			color: #333;
			box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
		}
	</style>
</head>
<body>
	<div>
		<div id="sidebar">
			<div class="profile">
				<?php if(empty($_SESSION['foto'])) { ?>
					<img src="images/default-user.png" class="bulat img-responsive">
				<?php }else{ ?>
				<img src="images/user/<?php echo $_SESSION['foto']; ?>" class="bulat img-responsive">
				<?php } ?>
			</div>
			<div class="profile">
				<h5><?php echo $_SESSION['nama']; ?></h5>
			</div>
			<ul class="list-unstyled">
				<li><a href="?halaman=dashboard">
						<span class="glyphicon glyphicon-th-large"></span>
						<span>Dashboard</span>
					</a>
				</li>
				<li>
					<a href="#pageData" data-toggle="collapse" aria-expanded="false">
						<span class="glyphicon glyphicon-th-list"></span>
						<span>Data</span>
					</a>
                        <ul class="collapse list-unstyled" id="pageData">
                            <li><a href="?halaman=pengguna">
                            		<span class="glyphicon glyphicon-user"></span>
									<span> Pengguna</span>
                            	</a>
                            </li>
                            <li><a href="?halaman=penerbit">
                            		<span class="glyphicon glyphicon-user"></span>
									<span> Penerbit</span>
                            	</a>
                            </li>
                           <li><a href="?halaman=buku">
                            		<span class="glyphicon glyphicon-book"></span>
									<span> Buku</span>
                            	</a>
                            </li>
                            <li><a href="?halaman=penjualan">
                            		<span class="glyphicon glyphicon-tag"></span>
									<span> Penjualan</span>
                            	</a>
                            </li>
                        </ul>
				</li>
				<li>
					<a href="#pageLaporan" data-toggle="collapse" aria-expanded="false">
						<span class="glyphicon glyphicon-list-alt"></span>
						<span>Laporan</span>
					</a>
                        <ul class="collapse list-unstyled" id="pageLaporan">
                            <li><a href="?halaman=laporan_penjualan">
                            		<span class="glyphicon glyphicon-tags"></span>
									<span> Penjualan</span>
                            	</a>
                            </li>
                            <li><a href="laporan/l_keuntungan.php" target="_blank">
                            		<span class="glyphicon glyphicon-tags"></span>
									<span> Keuntungan</span>
                           	 	</a>	
                            </li>
                        </ul>
				</li>
			</ul>
		</div>

		<div id="konten">
			<div class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button class="btn btn-info navbar-btn" id="btnCollapse">
							<span class="glyphicon glyphicon-menu-hamburger"></span>
						</button>
					</div>
					<ul class="nav navbar-nav navbar-right menu">
						<li>
							<a href="?halaman=keranjang-belanja">
								<span class="glyphicon glyphicon-shopping-cart ijo"></span>
								<span class="text-success">Keranjang <span class="badge badgene">
									<?php if(isset($_SESSION["shopping_cart"])) { echo count($_SESSION["shopping_cart"]); } else { echo '0';}?>
								</span></span>
							</a>
						</li>
						<li>
							<a href="logout.php">
								<span class="glyphicon glyphicon-log-out text-danger"></span>
								<span class="text-danger">Keluar</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="isi">
				<?php
					include'../confiq/koneksi.php';
					if($_GET['halaman']=="dashboard"){
						include'dashboard.php';
					}elseif($_GET['halaman']=="pengguna"){
						include'user/d_user.php';
					}elseif($_GET['halaman']=="tambah_pengguna"){
						include'user/t_user.php';
					}elseif($_GET['halaman']=="edit_pengguna"){
						include'user/e_user.php';
					}elseif($_GET['halaman']=="penerbit"){
						include'penerbit/d_penerbit.php';
					}elseif($_GET['halaman']=="tambah_penerbit"){
						include'penerbit/t_penerbit.php';
					}elseif($_GET['halaman']=="edit_penerbit"){
						include'penerbit/e_penerbit.php';
					}elseif($_GET['halaman']=="buku"){
						include'buku/d_buku.php';
					}elseif($_GET['halaman']=="tambah_buku"){
						include'buku/t_buku.php';
					}elseif($_GET['halaman']=="edit_buku"){
						include'buku/e_buku.php';
					}elseif($_GET['halaman']=="keranjang-belanja"){
						include'keranjang/d_keranjang.php';
					}elseif($_GET['halaman']=="penjualan"){
						include'penjualan/d_penjualan.php';
					}elseif($_GET['halaman']=="laporan_penjualan"){
						include'laporan/f_penjualan.php';
					}else{
						echo "<h4>SELAMAT DATANG</h4>";
					}
				?>
			</div>
		</div>
	</div>

	<!-- Konfirmasi hapus -->
	<div class="modal fade" id="conhapus">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="text-danger">PERHATIAN!!!</h4>
				</div>
				<div class="modal-body">
					Apakah anda yakin akan menghapus data ini ?
				</div>
				<div class="modal-footer">
					<a class="btn btn-danger btn-ok btn-sm">Hapus</a>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Konfirmasi stok habis -->
	<div class="modal fade" id="KetStok">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="text-danger">PERHATIAN!!!</h4>
				</div>
				<div class="modal-body">
					Stok tidak mencukupi ?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Konfirmasi add keranjang -->
	<div class="modal fade" id="KetAdd">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="text-danger">HOREEEEE ;)</h4>
				</div>
				<div class="modal-body">
					Buku berhasil dimasukkan ke keranjang
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

<!-- end konfirmasi hapus -->

    <script src="../js/jquery-1.12.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.nicescroll.min.js"></script>

    <script src="../js/jquery.dataTables.js"></script>
	<script src="../js/dataTables.bootstrap.js"></script>

	<script>
	    $(document).ready(function () {
	        $('#dataTables-example').dataTable();
	    });
	</script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").niceScroll({
                cursorcolor: '#53619d',
                cursorwidth: 4,
                cursorborder: 'none'
            });

            $('#btnCollapse').on('click', function () {
                $('#sidebar, #konten').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
    <script type="text/javascript">
	    $(document).ready(function() {
	        $('#conhapus').on('show.bs.modal', function(e) {
	            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	        });
	    });
  </script>

  <!-- Ajax kanggo keranjang belanja-->
  <script>  
 	$(document).ready(function(data){  
      	$('.add_to_cart').click(function(){  
           var product_id = $(this).attr("id");  
           var product_name = $('#judul'+product_id).val();  
           var product_price = $('#harga'+product_id).val(); 
           var product_diskon = $('#diskon'+product_id).val();
           var product_hdiskon = $('#hdiskon'+product_id).val();
           var product_quantity = $('#qty'+product_id).val();  
           var jml = $('#jml'+product_id).val(); 
           var product_foto = $('#foto'+product_id).val();
           var action = "add";  

           if(jml > 0)  
           {  
                $.ajax({  
                     url:"keranjang/a_keranjang.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{  
                          product_id:product_id,   
                          product_name:product_name,   
                          product_price:product_price, 
                          product_diskon:product_diskon,
                          product_hdiskon:product_hdiskon,
                          product_quantity:product_quantity,   
                          product_foto:product_foto,
                          action:action  
                     },  
                     success:function(data)  
                     {  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                          $('#KetAdd').modal('show');  
                     }  
                });  
           }  
           else  
           {  
                $('#KetStok').modal('show')
           }  
      	}); 

	
      $(document).on('click', '.delete', function(){  
           var product_id = $(this).attr("id");  
           var action = "remove";  
           if(confirm("Apakah anda akan menghapus data ini ?"))  
           {  
                $.ajax({  
                     url:"keranjang/a_keranjang.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                     }  
                });  
           }  
           else  
           {  
                return false;  
           }  
      });  
      
      $(document).on('keyup', '.quantity', function(){  
           var product_id = $(this).data("product_id");  
           var quantity = $(this).val();  
           var action = "quantity_change";  
           if(quantity != '')  
           {  
                $.ajax({  
                     url :"keranjang/a_keranjang.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, quantity:quantity, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                     }  
                });  
           }  
      });  
 });  
 </script>

  <!-- akhir keranjang belanja -->
</body>
</html>
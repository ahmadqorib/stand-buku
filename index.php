<!DOCTYPE html>
<html>
<head>
	<meta name=”viewport” content=”width=device-width; initial-scale=1.0; maximum-scale=1.0;”>
	<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
	<title>Bazzar Buku</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/front.css">
	<link rel="stylesheet" type="text/css" href="fontawesome/css/font-awesome.min.css">
	<!-- <script src="js/jquery-1.12.0.min.js"></script> -->
	<script src="js/bootstrap.min.js"></script>

	<script src="js/jquery-2.1.3.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#search").autocomplete({
                source: "dataCari.php",
                minLength: 2
            });
        });
    </script>
	
</head>
<body>
	<div class="headerr" id="home">
		<div class="background-text">
			<div>
				<img src="admin/images/logo_hmjti.png" style="height: 100px;">
			</div>
			<span class="judul">
				BAZZAR BUKU
			</span>
			<hr class="hur">
			<button type="button" class="btn btn-default">HMJTI STMIK AKAKOM YOGYAKARTA</button>
		</div>
	</div>

	<nav class="navbar navbar-inverse" id="navbar">
	  <div class="container-fluid bo">
	    <div class="navbar-header">
		     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		       <span class="icon-bar"></span>
		       <span class="icon-bar"></span>
		       <span class="icon-bar"></span>
		    </button>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="navbar-right breadcrumb">
	      	<li><a href="#home">HOME</a></li>
	        <li><a href="#katalog">KATALOG BUKU</a></li>
	        <!-- <li><a href="#">BERI SARAN</a></li> -->
	      </ul>
	    </div>
	  </div>
  		<div>
			<div class="container">
				<form method="post">
					<div class="col-md-12">
						<div class="input-group">
						   <input type="text" id="search" class="form-control inp" name="search" placeholder="Temukan bukumu . . ."/>
						   <div class="input-group-btn">
						        <button class="btn btn-danger inpB" type="submit" name="cari">
						        	<span class="glyphicon glyphicon-search"></span>
						        </button>
						   </div>
						</div>
		        	</div>
				</form>
			</div>
		</div>
	</nav>

<div class="content" id="katalog">
	<div class="container">
		    <?php
		    include('Pagination.php');
		    include("confiq/koneksi.php"); 
		    
		    $limit = 18;

		    $queryNum = $kon->query("SELECT COUNT(*) as postNum FROM bazzar_buku");
		    $resultNum = $queryNum->fetch_assoc();
		    $rowCount = $resultNum['postNum'];
		    
		    $pagConfig = array('baseURL'=>'getData.php', 'totalRows'=>$rowCount, 'perPage'=>$limit, 'contentDiv'=>'posts_content');
		    $pagination =  new Pagination($pagConfig);
		    
		    if(isset($_POST['cari'])){
		    	$cari = $_POST['search'];
		    	$query = $kon->query("SELECT * FROM bazzar_buku where judul_buku LIKE '%$cari%' ORDER BY judul_buku DESC LIMIT $limit");
		    }else{
		   	 	$query = $kon->query("SELECT * FROM bazzar_buku ORDER BY judul_buku DESC LIMIT $limit");
		    }
		    
		    if($query->num_rows > 0){ ?>
		    	<div class="row">
		    		<div id="posts_content">
			        <?php
			            while($row = $query->fetch_assoc()){ 
			                $postID = $row['id_buku'];
			                $hargat = $row['harga'] - ($row['diskon']/100*$row['harga']);

			                $totalS = strlen($row['judul_buku']);
			                if($totalS >= 43){
				                $num_char = 43;
								$judul = substr($row['judul_buku'], 0, $num_char) . '...';
							}else{
								$judul = $row['judul_buku'];
							}

			        ?>
			            <div class="col-md-2 col-sm-6" style="position: inherit; ">
							<div class="thumbnail">
								<div class="data">
									<?php if($row['foto']!=""){ ?>
										<img src="admin/images/buku/<?=$row['foto'];?>" class="img-responsive">
									<?php } ?>
								</div>
								<div class="caption">
									<h4><a href="detail_buku.php?id_buku=<?php echo $row['id_buku']; ?>" target="_blank"><?= $judul; ?></a></h4>
									<div class="ui-group-buttons">
									<?php if($row['diskon']>0){ ?>
			                			<button type="button" class="btn btn-danger btn-xs"><?= $row['diskon']?>%</button>
			                		<?php } ?>
			                			<div class="or or-xs"></div>
			                			<button type="button" class="btn btn-success btn-xs">Rp <?php echo number_format($hargat,0,",","."); ?></button>
			            			</div>
								</div>
							</div>
						</div>
		        	<?php } ?>
		        		<div style="text-align: center;">
		        			<?php echo $pagination->createLinks(); ?>	
		        		</div>
		        	</div>
				</div>
					
		    <?php } ?>
	</div>
</div>


	<div class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="logo">
						<img src="admin/images/logo_hmjti.png">
					</div>
				</div>
	    		<div class="col-md-4 footere">
					<h3>Contact Us</h3>
					<ul>
						<li><a href="mailto:hmjti.stmikakakom@gmail.com" class="linkkaki" target="_blank"><i class="fa fa-envelope"></i> hmjti.stmikakakom@gmail.com</a></li>
						<li><a class="linkkaki"><i class="fa fa-phone"></i> +62895-1255-0000</a></li>
					</ul>
					<h4>Alamat</h4>
					<a class="linkkaki"><i class="fa fa-map-marker"></i> Jl.Raya Janti No 143 Karang Jambe, Yogyakarta</a>
				</div>
	    		<div class="col-md-4 footere">
	    			<h3>Find Us on Social Media</h3>
	    			<ul>
	    				<li><a href="http://www.facebook.com/hmjtiakakom" class="linkkaki" target="_blank"k><i class="fa fa-facebook-square"></i> Facebook</a></li>
	    				<li><a href="http://www.twitter.com/hmjti_akakom" class="linkkaki" target="_blank"><i class="fa fa-twitter-square"></i> Twitter</a></li>
	    				<li><a href="http://www.instagram.com/hmjti_akakom" class="linkkaki" target="_blank""><i class="fa fa-instagram"></i> Instagram</a></li>
	    				<li><a href="http://hmjti.akakom.ac.id" class="linkkaki" target="_blank"><i class="fa fa-globe"></i> www.hmjti.akakom.ac.id</a></li>
	    			</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="scroll-top-wrapper ">
  		<span class="scroll-top-inner">
    		<i class="fa fa-2x fa-arrow-circle-up"></i>
  		</span>
	</div>
	<div>
		<div class="footerr">
			<div class="container-fluid">
				<h4>Copyright © 2018 HMJTI STMIK AKAKOM YOGYAKARTA</h4>
			</div>
		</div>
	</div>
</body>

<script type="text/javascript">
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>

<!-- buat scroll e -->
<script type="text/javascript">
	$(document).ready(function(){

	$(function(){
	 
	    $(document).on( 'scroll', function(){
	 
	    	if ($(window).scrollTop() > 100) {
				$('.scroll-top-wrapper').addClass('show');
			} else {
				$('.scroll-top-wrapper').removeClass('show');
			}
		});
	 
		$('.scroll-top-wrapper').on('click', scrollToTop);
	});
	 
	function scrollToTop() {
		verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
		element = $('body');
		offset = element.offset();
		offsetTop = offset.top;
		$('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
	}

	});
</script>



</html>

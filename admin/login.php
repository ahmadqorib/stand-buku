<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="icon" href="images/logo_hmjti.png">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<style type="text/css">
		html, body{
			background: url(images/81RTZEw.png);
			background-attachment: fixed;
			background-size: 100% 100%;
			font-family: sans-serif;
		}

		.forme{
			margin: 20px auto;
			background-color: #fff;
			padding: 10px;
			border-radius: 5px;
			opacity: 0.9;
    		filter: alpha(opacity=50);
    		margin-top: 2px;
		}

		.form-group{
			padding: 0;
			margin: 3px;
		}

		.group-but{
			margin-top: 5px;
		}

		.colorgraph {
			height: 5px;
			border-top: 0;
			background: #c4e17f;
			border-radius: 5px;
			background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
			background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
			background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
			background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
		}

		.gambar{
			width: 150px;
			margin:0px auto;
		}		

		h3{
			margin: 10px auto 10px;
			color: #FFF;
		}
	</style>
</head>
<body>
	<div class="container">
    	<div class="row">
    		<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
    			<h3 align="center">LOGIN!!!</h3>
    			<form class="forme" action="a_login.php" method="post">
    				<img src="images/default-user.png" class="img-responsive gambar">
    				<hr class="colorgraph">
    				<div class="form-group">
    					<div class="input-group">
	    					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	    					<input type="text" class="form-control" name="username" placeholder="Masukkan Username ... ">
  						</div>
    				</div>
    				<div class="form-group">
    					<div class="input-group">
	    					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	    					<input type="password" class="form-control" name="password" placeholder="Masukkan Password ... ">
  						</div>
    				</div>
    				<div class="form-group group-but">
    					<input type="submit" name="" class="btn btn-primary btn-block" value="Login">
    				</div>
    			</form>
    		</div>
    	</div>
	</div>
</body>
</html>
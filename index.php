<!DOCTYPE html>
<html>
<head>
	<meta name="referrer" content="strict-origin" />
	<title>Projek UAS IR</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.min.css">
</head>
<style type="text/css">
	  .col-example {
	      padding: 1rem;
	      background-color: #33b5e5;
	      border: 2px solid #fff;
	      color: #fff;
	      text-align: center;
	    }
	    .search_form input{
	    	padding: 25px;
	    	border-top-left-radius: 2em;
	    	border-bottom-left-radius: 2em;
	    	border: 1px solid #eaeaea !important;
	    }
	    .search_form input:focus{
	    	border:0px !important;
	    	outline: none !important;
	    	box-shadow: none !important;
	    	border: 1px solid #eaeaea !important;
	    }
	    .search_form button{
	    	padding: 0 30px !important;
	    	border-bottom-right-radius: 2em;
	    	border-top-right-radius: 2em;
	    	border: 1px solid #eaeaea !important;
	    }
	    .action {
	    	font-size: 11px;
	    	margin-left: 25px;
	    	color:#b7b7b7;
	    }
</style>
<body>
	<div class="container">
		<div class="d-flex align-items-center justify-content-center" style="height: 500px">
			<div class="col-6">
				<form method="GET" action="proses_cari.php">
					<div class="text-center" style="margin-bottom: 50px">
						<h1>GuluGulu</h1>
						<small>Cari Resep Masakan!</small>
					</div>
					<div class="input-group mb-3 search_form">
					  <input type="text" class="form-control" placeholder="Mau nyari Resep apa?" name="search" autocomplete="off">
					  <div class="input-group-append">
					    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
					  </div>
					</div>
				</form>
				<div class="action ">
					Punya artikel resep masakan keren?, yuk <a href="submit-artikel.php" class="submit_artikel"><b>Submit Artikel</b></a> mu sekarang juga!
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript" src="assets/jquery/dist/jquery.min.js"></script>
</body>
</html>
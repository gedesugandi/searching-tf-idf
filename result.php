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
	    .result-list .list-group-item{
	    	border:0px !important;
	    	margin-bottom: 20px;
	    }
</style>
<body>
	<?php 
	$get_keyword_user = $_GET['search'];
	// echo 2*log(3/2);
	include 'fungsi.php';
	buatindex();
	hitungbobot(); 
	panjangvektor(); 

	// addKeyword($get_keyword_user);

	hitungBobotKeyword();
	WdWdi();
	rankingDoC();
	 ?>
	<div class="container">
		<div class="row">
			<div class="col-12" style="border-bottom: 1px solid #f7f7f7;">
				<div class="row">
					<div class="col-2 d-flex align-items-center justify-content-center">
						<a href="index.php"><h3>GuluGulu</h3></a>
					</div>
					<div class="col-6 ">
						<form method="GET" action="proses_cari.php" class="" style="padding: 20px 0 0 0;">
							<div class="input-group mb-3 search_form">
							  <input type="text" class="form-control" placeholder="Mau nyari apa?" name="search" value="<?= $get_keyword_user;  ?>">
							  <div class="input-group-append">
							    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
							  </div>
							</div>
						</form>
					</div>
					<div class="col-4 text-right">
						<div style="padding: 20px 0 0 0;">
							<button class="btn btn-info btn-sm btn-outline" data-toggle="modal" data-target=".bd-vector" >Panjang Vector</button>
							<button class="btn btn-warning btn-sm btn-outline" data-toggle="modal" data-target=".bd-bobot" >Perhitungan Bobot</button>
						</div>
					</div>
				</div>
			</div>
			<?php 
			include "koneksi.php";
			$query = mysqli_query($konek,"SELECT simpan_hasil.DocId,simpan_hasil.Hasil_Bobot_Akhir,tbberita.Id,tbberita.Judul,tbberita.Berita,tbberita.url FROM simpan_hasil INNER JOIN tbberita ON simpan_hasil.DocId = tbberita.Id ORDER BY Hasil_Bobot_Akhir DESC");
			$total_hasil_result = mysqli_num_rows($query);
			 ?>
			<div class="col-12" style="margin-top: 25px;">
				<div class="col-12">
					<div style="font-size: 13px;color: grey;margin-left: 19px;"><i>Menampilkan <b><?= $total_hasil_result ?></b> Hasil</i></div>
					<div class="row">
						<div class="col-8">
							<div class="list-group result-list">
								<?php 
									
									while ($row = mysqli_fetch_array($query)) {
										if($row['Hasil_Bobot_Akhir'] == 0){
											continue;
										}
										?>
							  <a href="<?= $row['url'] ?>" class="list-group-item list-group-item-action flex-column align-items-start">
							    <small><?= 
								// $url = 'https://www.duniailkom.com/tutorial-form-html-fungsi-dan-cara-penggunaan-tag-button-html/';
								// $parse = parse_url($url);
								// echo $parse['host'];
							    substr_replace($row['url'],"...",40) ?></small>
							    <div class="d-flex w-100 justify-content-between">
							      <h5 class="mb-1"><?= $row['Judul'] ?></h5>
							    </div>
							    <p class="mb-1"><?= substr_replace($row['Berita'],"...",170) ?></p>
							    <small class="badge badge-info"><b>Bobot : <?= $row['Hasil_Bobot_Akhir'] ?></b></small>
							  </a>
										<?php

									}
								 ?>
							</div>
						</div>
						<div class="col-4"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade bd-vector" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Hasil Perhitungan Vector</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="text-center"><h2>Panjang Vector Dokumen</h2></div>
					<table class="table">
					  <thead class="thead-dark">
					    <tr>
					      <th scope="col">DocId</th>
					      <th scope="col">Panjang</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 
					  		include 'koneksi.php';
							$result = mysqli_query($konek," SELECT * FROM `tbvektor` ");
							while($row = mysqli_fetch_array($result)) {
								echo '<tr>';
							    echo '<td>'.$row['DocId'].'</td>';
							    echo '<td>'.$row['Panjang'].'</td>';
								echo '</tr>';
							}
					  	?>
					  </tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade bd-bobot" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Hasil Perhitungan Bobot</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="text-center"><h2>Bobot Keyword</h2></div>
					<table class="table">
					  <thead class="thead-dark">
					    <tr>
					      <th scope="col">ID</th>
					      <th scope="col">Term</th>
					      <th scope="col">Count</th>
					      <th scope="col">Bobot</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 
					  		include 'koneksi.php';
							$result = mysqli_query($konek," SELECT * FROM `tbkeyword` ");
							while($row = mysqli_fetch_array($result)) {
								echo '<tr>';
						    	echo '<td>'.$row['Id'].'</td>';
							    echo '<td>'.$row['Term'].'</td>';
							    echo '<td>'.$row['Count'].'</td>';
							    echo '<td>'.$row['Bobot'].'</td>';
								echo '</tr>';
							}
					  	?>
					  </tbody>
					</table>
					<div class="text-center"><h2>Bobot Dokumen</h2></div>
					<table class="table">
					  <thead class="thead-dark">
					    <tr>
					      <th scope="col">ID</th>
					      <th scope="col">Term</th>
					      <th scope="col">Doc-Id</th>
					      <th scope="col">Count</th>
					      <th scope="col">Bobot</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 
					  		include 'koneksi.php';
							$result = mysqli_query($konek," SELECT * FROM `tbindex` ");
							while($row = mysqli_fetch_array($result)) {
								echo '<tr>';
						    	echo '<td>'.$row['Id'].'</td>';
							    echo '<td>'.$row['Term'].'</td>';
							    echo '<td>'.$row['DocId'].'</td>';
							    echo '<td>'.$row['Count'].'</td>';
							    echo '<td>'.$row['Bobot'].'</td>';
								echo '</tr>';
							}
					  	?>
					  </tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript" src="assets/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
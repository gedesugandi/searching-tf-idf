<!DOCTYPE html>
<html>
<head>
	<meta name="referrer" content="strict-origin" />
	<title>Projek UAS IR</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.min.css">
</head>

<body>
	<div class="container">
		<div class="row" style="margin-top: 30px;">
			<div class="col-4">
				<h2 class="text-center">Submit Artikel</h2>
				<form method="POST" action="simpan-submit-url.php">
				  <div class="form-group">
				    <label for="formGroupExampleInput">URL</label>
				    <input type="text" class="form-control" name="url" required="true" placeholder="Masukkan Alamat URL">
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-10">
				      <button type="submit" name="simpan" class="btn btn-primary">Submit</button>
				      <a href="index.php" class="btn ">Kembali</a>
				    </div>
				  </div>

				</form>
			</div>
			<div class="col-8">
				<h2 class="text-center">Daftar Artikel</h2>
				<table class="table table-striped">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Judul</th>
				      <th scope="col">Isi</th>
				      <th scope="col">Aksi</th>
				    </tr>
				  </thead>
				  <tbody>
				    <?php
				    	include 'koneksi.php';
						$result = mysqli_query($konek,"SELECT * FROM tbberita ORDER BY Id");
						$no = 1;
							while($row = mysqli_fetch_array($result)) {
								echo '<tr>';
						    	echo '<td>'.$no.'</td>';
							    echo '<td>'.$row['Judul'].'</td>';
							    echo '<td>'.substr_replace($row['Berita'],"...",100).'</td>';
							    ?>
							    <td><a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Ingin Hapus?')" href="hapus.php?idDock=<?= $row['Id'] ?>">Hapus</a>
							    <?php
							    // echo '';
							    echo '<td><a target="_blank" class="btn targey btn-warning btn-sm" href="'.$row['url'].'">Lihat Detail</a>';
								echo '</tr>';
								$no++;
							}
							
						?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>

<script type="text/javascript" src="assets/jquery/dist/jquery.min.js"></script>
</body>
</html>
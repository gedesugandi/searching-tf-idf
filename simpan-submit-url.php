<?php 


if(isset($_POST['simpan'])){
	include 'koneksi.php';
	require_once 'Readability/Readability.php';
	header('Content-Type: text/plain; charset=utf-8');

	
	$get_url = $_POST['url'];

	$url = $get_url;
	$html = file_get_contents($url);

	if (function_exists('tidy_parse_string')) {
		$tidy = tidy_parse_string($html, array(), 'UTF8');
		$tidy->cleanRepair();
		$html = $tidy->value;
	}

	$readability = new Readability($html, $url);
	$readability->debug = false;
	$readability->convertLinksToFootnotes = true;
	$result = $readability->init();

	if ($result) {
		$judul_artikel =  $readability->getTitle()->textContent;

		$content = $readability->getContent()->innerHTML;
		if (function_exists('tidy_parse_string')) {
			$tidy = tidy_parse_string($content, array('indent'=>true, 'show-body-only' => true), 'UTF8');
			$tidy->cleanRepair();
			$content = $tidy->value;
		}
		$isi_artikel = strip_tags($content);
	} else {
		echo 'Looks like we couldn\'t find the content. :(';
	}

	$judul= $judul_artikel;
	$isi = substr_replace($isi_artikel," ",300);
	$urls = $get_url;
	$last = mysqli_query($konek,"ALTER TABLE tbberita AUTO_INCREMENT = 1");
	$input=mysqli_query($konek,"INSERT INTO tbberita  VALUES('$id','$judul','$isi','$url')") or die (mysqli_error($konek));
	if($input){
		header('Location:submit-artikel.php');		
	}

}








?>
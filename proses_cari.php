<?php 

function preproses($teks) {

	include "koneksi.php";
  	//bersihkan tanda baca, ganti dengan space
	$teks = str_replace("'", " ", $teks);
	$teks = str_replace("-", " ", $teks);
	$teks = str_replace(")", " ", $teks);
	$teks = str_replace("(", " ", $teks);
	$teks = str_replace("\"", " ", $teks);
	$teks = str_replace("/", " ", $teks);
	$teks = str_replace("=", " ", $teks);
	$teks = str_replace(".", " ", $teks);
	$teks = str_replace(",", " ", $teks);
	$teks = str_replace(":", " ", $teks);
	$teks = str_replace(";", " ", $teks);
	$teks = str_replace("!", " ", $teks);
	$teks = str_replace("?", " ", $teks);

	//ubah ke huruf kecil
	$teks = strtolower(trim($teks));

	//terapkan stop word removal
	$astoplist = array ("yang", "juga", "dari", "dia", "kami", "kamu", "ini", "itu",
				 "atau", "dan", "tersebut", "pada", "dengan", "adalah", "yaitu", "ke");
	foreach ($astoplist as $i => $value) {
   	$teks = str_replace($astoplist[$i], "", $teks);
	}

	//terapkan stemming
	//buka tabel tbstem dan bandingkan dengan berita
	$restem = mysqli_query($konek,"SELECT * FROM tbstem ORDER BY Id");

	while($rowstem = mysqli_fetch_array($restem)) {
  		$teks = str_replace($rowstem['Term'], $rowstem['Stem'], $teks);
  	}

	//kembalikan teks yang telah dipreproses
	$teks = strtolower(trim($teks));
	return $teks;
} //end function preproses

include "koneksi.php";
$keyword_user = $_GET['search'];

mysqli_query($konek,"DELETE FROM tbkeyword");
//hapus index sebelumnya
mysqli_query($konek,"TRUNCATE TABLE tbindex");
//$berita = //ini didapat dari value keyword yang dimasukan user!
$berita = $keyword_user;
$berita = preproses($berita);
//simpan ke inverted index (tbindex)
	$aberita = explode(" ", trim($berita));

$words = str_word_count($berita, 1);
$words = array_count_values($words);
// var_dump($words);
$count_keyword = count($words);
if($count_keyword > 0){
	foreach ($words as $xxx => $val) {
		mysqli_query($konek,"INSERT INTO tbkeyword (Term, Count) VALUES ('$xxx', $val)");
	}
	header('location:result.php?search='.$keyword_user);
}




 ?>
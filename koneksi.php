<?php 
$konek = mysqli_connect("localhost","root","") or die (mysql_error());
$conn = mysqli_select_db($konek,"db_uasIr") or die (mysql_error());
 ?>
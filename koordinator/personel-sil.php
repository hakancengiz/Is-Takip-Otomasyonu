<?php 
@$id=$_GET["id"];
@include("../baglanti.php");
mysql_query("DELETE FROM tbl_personel WHERE id=$id") or die("Veriler silinemedi.".mysql_error());
header("Location:personel-listele.php");
?>
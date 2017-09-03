<?php
@include("../baglanti.php");
session_start();
if(!($_SESSION['koordinatoroturum']))
{
	header("Location:../index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="menu">
<div class="menu-baslik">
<?php
$eposta = $_SESSION['koordinatoroturum'];

$uye_list=mysql_query("select kurum from tbl_kurum where id = (select kurum from tbl_mudur where id = (select sorumlu_mudur from tbl_koordinator where eposta='$eposta'))");
while($yaz=mysql_fetch_array($uye_list))
{
	echo "<font color='#ffc760'>" . $yaz['kurum'] . "</font> → ";
}

$uye_list=mysql_query("Select sorumlu_mudur from tbl_koordinator where eposta='$eposta'");
while($yaz=mysql_fetch_array($uye_list))
{
	$sorumlu_mudur_id = $yaz['sorumlu_mudur']; 
}

$uye_list=mysql_query("Select * from tbl_mudur where id=$sorumlu_mudur_id");
while($yaz=mysql_fetch_array($uye_list))
{
	echo "<font color='#ffc760'>" . $yaz['ad_soyad'] . "</font> → ";
}

$uye_list=mysql_query("Select * from tbl_koordinator where eposta='$eposta'");
while($yaz=mysql_fetch_array($uye_list))
{
	echo "<font color='#ffc760'>" . $ad = $yaz['ad_soyad'] . "</font>"; 
}
?> 
<br /><br />Lütfen bir İşlem Seçin
</div>
<a href="personele-is-ver.php"><div class="kutu">Personele İş Ver</div></a>
<a href="personel-listele.php"><div class="kutu">Personel Düzenle</div></a>
<a href="personel-ekle.php"><div class="kutu">Personel Ekle</div></a>
<a href="is-listele.php"><div class="kutu">İşleri Görüntüle</div></a>
<a href="profil.php"><div class="kutu">Profilim</div></a>
<a href="../cikis.php"><div class="kutu">Çıkış Yap</div></a>
</div>

</body>
</html>
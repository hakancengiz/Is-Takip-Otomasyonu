<?php
@include("../baglanti.php");
session_start();
if(!($_SESSION['muduroturum']))
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
<div class="menu-baslik">Sizin Emrinizdeki Koordinatörler <br />
→<a style="color: #CC3;" href="index.php"> İşlem Ekranına Dön </a>←</div>
<?php
$eposta = $_SESSION['muduroturum'];
$uye_list=mysql_query("Select id from tbl_mudur where eposta='$eposta'");
while($yaz=mysql_fetch_array($uye_list))
{
	$id = $yaz['id']; 
}
?>
<table cellpadding='5' class='listele_table'>
<tr>
<td align="center">Fotoğraf</td>
<td align="center">Ad Soyad</td>
<td align="center">Maaş</td>
<td align="center">E-Posta</td>
<td></td><td></td>
</tr>
<tr>
<td colspan="6"><hr /></td>
</tr>
<?php
$uye_list=mysql_query("Select * from tbl_koordinator where sorumlu_mudur=$id");
while($yaz=mysql_fetch_array($uye_list))
{
?>
	<tr>
	<td><img src='<?php echo $yaz['fotograf']; ?>' width='80' height='100' style="box-shadow:0 0 5px 0 #000000" /></td>
    <td align="center"><?php echo $yaz['ad_soyad']; ?></td>
    <td align="center"><?php echo $yaz['maas'] . " TL"; ?></td>
    <td align="center"><?php echo $yaz['eposta']; ?></td>
    <td align="center"><a href='koordinator-duzenle.php?id=<?php echo $yaz['id']; ?>'>DÜZENLE</a></td>
    <td align="center"><a href='koordinator-sil.php?id=<?php echo $yaz['id']; ?>'>SİL</a></td>
    </tr>
    <tr>
    <td colspan="6"><hr /></td>
    </tr>
<?php
}
?>
</table>
</div>

</body>
</html>
<?php
@include("../baglanti.php");
session_start();
if(!($_SESSION['muduroturum']))
{
	header("Location:../index.php");
}
@$koordinator_id = $_GET["id"];
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
<?php
$uye_list=mysql_query("Select * from tbl_koordinator where id=$koordinator_id");
while($yaz=mysql_fetch_array($uye_list))
{
?>
<div class="menu-baslik"><?php echo $yaz['ad_soyad']; ?>'ın Profili<br />
→<a style="color: #CC3;" href="index.php"> İşlem Ekranına Dön </a>←<br /><br />
<font size="-1" color="#CC3">Not: Çalışanınız sadece maaş bilgisini güncellemeye yetkiniz var.</font></div>
<font color="#FFFFFF">
<form name="frm" action="" method="post">
<table cellpadding="10">
<tr>
<td>Fotoğraf:</td>
<td>
<img src="<?php echo $yaz['fotograf']; ?>" width="80" height="100" style="box-shadow:0 0 5px 0 #000000" />
</td>
</tr>
<tr>
<td>Ad Soyad:</td><td><input type="text" name="adsoyad" class="textbox" value="<?php echo $yaz['ad_soyad']; ?>" disabled /></td>
</tr>
<tr>
<td>Maaş:</td><td><input type="text" name="maas" class="textbox"  value="<?php echo $yaz['maas']; ?>" /> TL</td>
</tr>
<tr>
<td>E-Posta:</td><td><input type="text" name="eposta" class="textbox"  value="<?php echo $yaz['eposta']; ?>" disabled /></td>
</tr>
<tr>
<td></td><td><input type="submit" value="Güncelle" class="buton" name="btn" /></td>
</tr>
</table>
</form>
</font>
<?php 
}
@$btn=$_POST['btn'];
if($btn)
{
	$yenimaas= $_POST['maas'];
	if(!(empty($yenimaas)))
	{
		mysql_query("update tbl_koordinator set maas=$yenimaas where id=$koordinator_id")
		or 
		die("Veriler güncellenemedi.".mysql_error());
	
		echo "<font color='#FFF'>Güncelleme işlemi başarıyla gerçekleştirildi. <br/ >5 saniye sonra koordinatör düzenleme alanına yönlendirileceksiniz.</font>";
		header("refresh:5;url=koordinator-listele.php");
	}
	else
	{
		echo "<font color='#FFF'>Maaş alanını boş bırakamazsınız.</font>";
	}
}
?>
</div>

</body>
</html>
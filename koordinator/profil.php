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
<?php
$koordinator_eposta = $_SESSION['koordinatoroturum'];

$uye_list=mysql_query("Select * from tbl_koordinator where eposta='$koordinator_eposta'");
while($yaz=mysql_fetch_array($uye_list))
{
?>
<div class="menu-baslik"><?php echo $yaz['ad_soyad']; ?>'ın Profili<br />
→<a style="color: #CC3;" href="index.php"> İşlem Ekranına Dön </a>←<br /><br />
<font size="-1" color="#CC3">Not: Maaşınızı ve bağlı olduğunuz müdürü değiştirme yetkiniz yok.</font></div>
<font color="#FFFFFF">
<form name="frm" action="profil.php" method="post" enctype="multipart/form-data">
<table cellpadding="10">
<tr>
<td>Fotoğraf:</td>
<td>
<img src="<?php echo $yaz['fotograf']; ?>" width="80" height="100" style="box-shadow:0 0 5px 0 #000000" /> <br />
<input type="file" name="resim" />
</td>
</tr>
<tr>
<td>Ad Soyad:</td><td><input type="text" name="adsoyad" class="textbox" value="<?php echo $yaz['ad_soyad']; ?>" /></td>
</tr>
<tr>
<td>Maaş:</td><td><input type="text" name="maas" class="textbox"  value="<?php echo $yaz['maas']; ?>" disabled /> TL</td>
</tr>
<tr>
<td>E-Posta:</td><td><input type="text" name="eposta" class="textbox"  value="<?php echo $yaz['eposta']; ?>" /></td>
</tr>
<tr>
<td>Parola:</td><td><input type="password" name="parola" class="textbox" /></td>
</tr>
<tr>
<td>Müdür ID:</td><td><input type="text" name="mudur" class="textbox"  value="<?php echo $yaz['sorumlu_mudur']; ?>" disabled /></td>
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
	$fotograf=$_FILES["resim"]['tmp_name'];
	$hedef="../resimler/koordinator/".$_FILES["resim"]['name'];
	if(is_uploaded_file($fotograf))
	{
		$adsoyad= $_POST['adsoyad'];
		$eposta= $_POST['eposta'];
		$parola= $_POST['parola'];
		if(!(empty($adsoyad)) && !(empty($eposta)) && !(empty($parola)))
		{
			$parola=sha1($parola);
			move_uploaded_file($fotograf,$hedef);
			
			mysql_query("update tbl_koordinator set ad_soyad='$adsoyad', fotograf='$hedef', eposta='$eposta', sifre='$parola' where eposta='$koordinator_eposta'")
			or 
			die("Veriler güncellenemedi.".mysql_error());
	
			echo "<font color='#FFF'>Güncelleme işlemi başarıyla gerçekleştirildi. <br/ >5 saniye sonra işlem alanına yönlendirileceksiniz.</font>";
			header("refresh:5;url=index.php");
		}
		else
		{
			echo "<font color='#FFF'>- Boş alan bırakamazsınız.</font>";
		}
	}
	else
	{
		echo "- Bir fotoğraf seçin.";
	}
}
?>
</div>

</body>
</html>
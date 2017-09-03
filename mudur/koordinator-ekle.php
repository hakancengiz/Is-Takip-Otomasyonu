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

<div class="menu-baslik">Yeni Koordinatör Ekleme Formu<br />
→<a style="color: #CC3;" href="index.php"> İşlem Ekranına Dön </a>←<br /><br />
</div>
<font color="#FFFFFF">
<form name="frm" action="koordinator-ekle.php" method="post" enctype="multipart/form-data">
<table cellpadding="10">
<tr>
<td>Fotoğraf:</td><td><input type="file" name="resim" /></td>
</tr>
<tr>
<td>Ad Soyad:</td><td><input type="text" name="adsoyad" class="textbox" /></td>
</tr>
<tr>
<td>Maaş:</td><td><input type="text" name="maas" class="textbox" /> TL</td>
</tr>
<tr>
<td>E-Posta:</td><td><input type="text" name="eposta" class="textbox" /></td>
</tr>
<tr>
<td>Şifre:</td><td><input type="password" name="parola" class="textbox" /></td>
</tr>
<?php
$eposta = $_SESSION['muduroturum'];
$uye_list=mysql_query("Select id from tbl_mudur where eposta='$eposta'");
while($yaz=mysql_fetch_array($uye_list))
{
	$id = $yaz['id']; 
}
?>
<tr>
<td>Sorumlu ID:</td><td><input type="text" name="sorumlu" class="textbox" value="<?php echo $id; ?>" disabled /></td>
</tr>
<tr>
<td></td><td><input type="submit" value="Kaydet" class="buton" name="btn" /></td>
</tr>
</table>
</form>
<?php 
@$btn=$_POST['btn'];
if($btn)
{
	$fotograf=$_FILES["resim"]['tmp_name'];
	$hedef="../resimler/koordinator/".$id.$_FILES["resim"]['name'];
	if(is_uploaded_file($fotograf))
	{
		$adsoyad=$_POST['adsoyad'];
		$maas=$_POST['maas'];
		$eposta=$_POST['eposta'];
		$parola=$_POST['parola'];
		$sorumlu_mudur=$id;
		if(empty($adsoyad)||empty($maas)||empty($eposta)||empty($parola))
		{
			die("- Boş alan bırakmayınız.");
		}
		else
		{
			move_uploaded_file($fotograf,$hedef);
			
			$parola=sha1($parola);
			
			mysql_query("insert into tbl_koordinator (ad_soyad,maas,fotograf,eposta,sifre,sorumlu_mudur) values ('$adsoyad','$maas','$hedef','$eposta','$parola','$sorumlu_mudur')") or die("- Koordinatör eklenemedi.".mysql_error());
			
			echo "- Yeni koordinatör başarıyla eklendi.";
		}
	}
	else
	{
		echo "- Bir fotoğraf seçin.";
	}
}
?>
</font>
</div>

</body>
</html>

<?php
@include("../baglanti.php");
session_start();
if(!($_SESSION['personeloturum']))
{
	header("Location:../index.php");
}
@$is_id = $_GET["id"];
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
$uye_list=mysql_query("Select * from tbl_is where id=$is_id");
while($yaz=mysql_fetch_array($uye_list))
{
?>
<div class="menu-baslik"><?php echo $yaz['isin_adi']; ?><br />
→<a style="color: #CC3;" href="index.php"> İşlem Ekranına Dön </a>←<br /><br />
<font size="-1" color="#CC3">Not: Sadece işin durumunu değiştirme yetkiniz var.</font></div>
<font color="#FFFFFF">
<form name="frm" action="" method="post">
<table cellpadding="10">
<tr>
<td>İşin Adı:</td><td><input type="text" name="isinadi" class="textbox" value="<?php echo $yaz['isin_adi']; ?>" disabled /></td>
</tr>
<tr>
<td>Durumu:</td>
<td>
<select name="durum" class="dropdown">
  <option value="Yapım Aşamasında">Yapım Aşamasında</option>
  <option value="Tamamlandı">Tamamlandı</option>
</select>
</td>
</tr>
<tr>
<td>Sorumlu Personel:</td><td><input type="text" name="sorumlupersonel" class="textbox"  value="<?php echo $yaz['sorumlu_personel']; ?>" disabled /></td>
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
		$durum = $_POST['durum'];	

		mysql_query("update tbl_is set durum='$durum' where id=$is_id")
		or 
		die("Veriler güncellenemedi.".mysql_error());
	
		echo "<font color='#FFF'>Güncelleme işlemi başarıyla gerçekleştirildi. <br/ >5 saniye sonra iş listeleme alanına yönlendirileceksiniz.</font>";
		header("refresh:5;url=is-listele.php");
}
?>
</div>

</body>
</html>
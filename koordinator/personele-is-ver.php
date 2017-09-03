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
<?php
$eposta = $_SESSION['koordinatoroturum'];
$uye_list=mysql_query("Select id from tbl_koordinator where eposta='$eposta'");
while($yaz=mysql_fetch_array($uye_list))
{
	$id = $yaz['id']; 
}
?>
<div class="menu">

<div class="menu-baslik">Personele Yeni İş Verme Formu<br />
→<a style="color: #CC3;" href="index.php"> İşlem Ekranına Dön </a>←<br /><br />
</div>
<font color="#FFFFFF">
<form name="frm" action="personele-is-ver.php" method="post" enctype="multipart/form-data">
<table cellpadding="10">
<tr>
<td>İşin Adı:</td><td><input type="text" name="adsoyad" class="textbox" /></td>
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
<td>Sorumlu Personel:</td>
<td>
<select name="sorumlupersonel" class="dropdown">
<?php
$uye_list=mysql_query("Select ad_soyad from tbl_personel where sorumlu_koordinator=$id");
while($yaz=mysql_fetch_array($uye_list))
{
	echo "<option value='" . $yaz['ad_soyad'] . "'>" . $yaz['ad_soyad'] . "</option>";
}
?>
</select>
</td>
</tr>
<tr>
<td>Sorumlu Kor. ID:</td><td><input type="text" name="sorumlu" class="textbox" value="<?php echo $id; ?>" disabled /></td>
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
		$adsoyad=$_POST['adsoyad'];
		$durum=$_POST['durum'];
		$sorumlupersonel=$_POST['sorumlupersonel'];
		$sorumlu_koordinator=$id;
		if(empty($adsoyad))
		{
			die("- Boş alan bırakmayınız.");
		}
		else
		{
			
			$uye_list=mysql_query("select id from tbl_personel where ad_soyad = '$sorumlupersonel'");
			while($yaz=mysql_fetch_array($uye_list))
			{
				$s_personel = $yaz["id"];
			}
			
			mysql_query("insert into tbl_is (isin_adi,durum,sorumlu_personel) values ('$adsoyad','$durum',$s_personel)") or die("- İş, personele verilemedi.".mysql_error());
			
			echo "- Yeni personel-iş kaydı başarıyla gerçekleşti.";
		}
}
?>
</font>
</div>


</body>
</html>
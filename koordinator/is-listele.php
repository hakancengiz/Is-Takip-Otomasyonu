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
<div class="menu-baslik">Yapılan İşler <br />
→<a style="color: #CC3;" href="index.php"> İşlem Ekranına Dön </a>←<br /><br />
<font size="-1" color="#CC3">Not: Sadece kendi personelinizin iş kaydını silebilirsiniz.</font></div>
<?php
$eposta = $_SESSION['koordinatoroturum'];
$uye_list=mysql_query("Select id from tbl_koordinator where eposta='$eposta'");
while($yaz=mysql_fetch_array($uye_list))
{
	$id = $yaz['id']; 
}
?>
<table cellpadding='5' class='listele_table'>
<tr>
<td align="center">İşin Adı</td>
<td align="center">Durumu</td>
<td align="center">Sorumlu Personel</td>
<td></td>
</tr>
<tr>
<td colspan="6"><hr /></td>
</tr>
<?php
$uye_list=mysql_query("Select * from tbl_is");
while($yaz=mysql_fetch_array($uye_list))
{
?>
	<tr>
	<td align="center"><?php echo $yaz['isin_adi']; ?></td>
    <td align="center"><?php echo $yaz['durum']; ?></td>
    <?php
		$bul = $yaz['sorumlu_personel'];
		$sorgu=mysql_query("Select ad_soyad from tbl_personel where id=$bul");
		while($bak=mysql_fetch_array($sorgu))
		{
			$ad_soyad = $bak['ad_soyad']; 
		}
	?>
    <td align="center"><?php echo $ad_soyad ?></td>
    <td align="center">
    <?php
		$bul = $yaz['sorumlu_personel'];
		$sorgu=mysql_query("Select sorumlu_koordinator from tbl_personel where id=$bul");
		while($incele=mysql_fetch_array($sorgu))
		{
			$isin_sorumlu_koordinatoru = $incele['sorumlu_koordinator']; 
		}
		if($isin_sorumlu_koordinatoru == $id)
		{
	?>
    <a href='is-sil.php?id=<?php echo $yaz['id']; ?>'>SİL</a>
    <?php
		}
	?>
    </td>
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
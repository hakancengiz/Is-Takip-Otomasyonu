<?php

function tarih_yazdir()
{
	date_default_timezone_set("Asia/Istanbul"); 	

	$gunler = array("Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi");
	$aylar = array("Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");
	$veri_cek = getdate();
	
	$ay = $veri_cek['mon'];
	$gun = $veri_cek['wday'];
	
	echo  $veri_cek['mday'] . " " . $aylar[$ay-1] . " "  . $veri_cek['year'] . ", " . $gunler[$gun] . "<br><br>" ;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="baslik">İş Takip Yönetim Paneli</div>

<div class="giris-kapsul">
<?php
tarih_yazdir();
?>
<form name="frm" action="index.php" method="post">

<table style="margin:0px auto 0px auto;">
<tr>
<td align="center">Düzey:</td>
<td>
<select name="yetki" class="dropdown">
  <option value="Müdür">Müdür</option>
  <option value="Koordinatör">Koordinatör</option>
  <option value="Personel">Personel</option>
</select>
</td>
</tr>
<tr>
<td align="center">E-Posta:</td><td><input type="text" name="eposta" class="textbox"></td>
</tr>
<tr>
<td align="center">Parola:</td><td><input type="password" name="parola" class="textbox" /></td>
</tr>
<tr>
<td></td><td align="right"><input type="submit" value="Giriş Yap" name="btn" class="buton" /></td>
</tr>
</table>

</form>

<?php 
$sayac=0;
@$btn= $_POST['btn'];
if($btn)
{
	@include("baglanti.php");
	$eposta=$_POST['eposta'];
	$parola=$_POST['parola'];
	$yetki=$_POST['yetki']; 
		if(!(empty($eposta)))
		{
			if(!(empty($parola)))
			{
				$parola=sha1($parola);
				
				if($yetki=="Müdür")
				{
					$uye_list=mysql_query("Select * from tbl_mudur");
					while($yaz=mysql_fetch_array($uye_list))
					{
						if($eposta ==  $yaz['eposta'] && $parola ==  $yaz['sifre'])
						{
							session_start();
							$_SESSION['muduroturum']= $eposta;
							header("Location:mudur/index.php");
						}
					}
					echo "- Böyle bir kişi yok.";
				}
				else if($yetki=="Koordinatör")
				{
					$uye_list=mysql_query("Select * from tbl_koordinator");
					while($yaz=mysql_fetch_array($uye_list))
					{
						if($eposta ==  $yaz['eposta'] && $parola ==  $yaz['sifre'])
						{
							session_start();
							$_SESSION['koordinatoroturum']= $eposta;
							header("Location:koordinator/index.php");
						}
					}
					echo "- Böyle bir kişi yok.";
				}
				else
				{
					$uye_list=mysql_query("Select * from tbl_personel");
					while($yaz=mysql_fetch_array($uye_list))
					{
						if($eposta ==  $yaz['eposta'] && $parola ==  $yaz['sifre'])
						{
							session_start();
							$_SESSION['personeloturum']= $eposta;
							header("Location:personel/index.php");
						}
					}
					echo "- Böyle bir kişi yok.";
				}
			}
			else 
			{
				echo "<center><font color='#fff'>- Parola alanını boş bırakamazsınız.</font></center>";
			}
		}
	else 
	{
		echo "<center><font color='#fff'>- Eposta alanını boş bırakamazsınız.</font></center>";
	}
}
?>

</div>

</body>
</html>
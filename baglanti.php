<?php 
mysql_connect("127.0.0.1","root") or die("Bağlanamadı".mysql_error());
mysql_select_db("istakipodev") or die("Veritabanını bulamadı".mysql_error());
mysql_query("set names utf8");
?>
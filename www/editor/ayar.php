
<?php

$host = "localhost";
$dbname = "blogsitesi";
$sifre = "3291akar";
$kadi= "root";


try {
	$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8","$kadi","$sifre");
	
}catch (PDOException $mesaj){
	
	
	echo $mesaj->getmessage();
	

}








?>
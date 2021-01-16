<?php !defined("index") ? die("hacking ?") : null;?>

<!DOCTYPE HTML>




<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Vize Blog Sitesi</title>
	<link rel="stylesheet" href="css/styles.css" />
	<link rel="stylesheet" href="css/reset.css" />
</head>
<?php 
 $id = $_GET["id"];
 $konu = $db->prepare("select * from konular inner join kategoriler on 

kategoriler.kategori_id = konular.konu_kategori where konu_id=? and konu_durum=?");
 $konu->execute(array($id,1));
$x =  $konu->fetchALL(PDO::FETCH_ASSOC);

// konu hit bolumu
if(!@$_COOKIE["hit".$id]){
 $hit = $db->prepare("update konular set konu_hit = konu_hit +1 where konu_id=?");
 $hit->execute(array($id));

 setcookie("hit".$id,"_",time ()+9673663664646646464);
}
 
foreach($x as $m){
	
	$yorum = $db->prepare("select * from yorumlar where yorum_konu_id=? and yorum_onay=?");
	$yorum->execute(array($m["konu_id"],1));
	$yorum->fetchALL(PDO::FETCH_ASSOC);
	$x = $yorum->rowCount();
	
	?>
	<div class="sol2"> 
	<h2><?php echo $m["konu_baslik"]; ?></h2>
	<div class="bilgi" style="font-size:18px;">Kategori :<span style="font-weight:bold"> <?php echo $m["kategori_adi"]; ?></span> Yazan : <span style="font-weight:bold; color:red"> <?php  echo $m["konu_yazan"];?></span> Okunma : <span style="font-weight:bold"> <?php echo $m["konu_hit"]; ?></span> Yorum : <?php echo $x; ?>
	<span style="float:right;">Tarih : <?php echo $m["konu_tarih"]; ?></span></div>
	
	<p> 
	<img style="width:300px;margin-left:175px; padding:5px; display:block;" src="<?php echo $m["konu_resim"]; ?>" />
		<?php echo nl2br($m["konu_aciklama"]); ?>...
	</p>
	
	
	<div style="clear:both;"></div>
	</div>
	<?php
	
}


 $yorum = $db->prepare("select * from yorumlar where yorum_konu_id=? and yorum_onay=?");
 $yorum->execute(array($id,1));
 $b = $yorum->fetchALL(PDO::FETCH_ASSOC);
 $x = $yorum->rowCount();
 
 
   if($x){
	   
     foreach($b as $m){
		 
		 ?>
		<div class="yorumlar" style="border :1px solid #ddd;
  min-height:100px;
  margin-bottom:10px;
  background: white;">
			<h2 style="border : 1px solid #ddd;
	padding: 7px;
	font-size: 18px;"
	 class="alert alert-success">Yorumcu : <span style="font-size:20px" class="text-danger"><?php echo $m["yorum_ekleyen"]; ?></span>
			<span style="float:right;">Tarih : <?php echo $m["yorum_tarihi"]; ?></span></h2>
			<p> <?php echo $m["yorum_mesaj"]; ?>
			</div>
		 <?php
		 
		 
		 
	 }	  
	  
	   
   }else {
	   
	   echo '<div style="border:1px solid #ddd; margin:2px; padding:5px; background:#eee;
font-size:18px; background:lightblue;	"> Henüz Yorum Yok</div>';
	   
   }



if($_POST){
	
	$isim  = trim($_POST["isim"]);
	$mail  = trim($_POST["mail"]);
	$mesaj = $_POST["mesaj"];
	
	if(!$mesaj || !$mail || !$isim){
		
		echo '<div style="border:1px solid #ddd; padding:10px; font-size:25px; background:red;"> Lütfen Alanları Doldurun!!! </div>';
		
	}else {
		
		$yorum = $db->prepare("insert into yorumlar set 
		
		          yorum_ekleyen=?,
				  yorum_eposta=?,
				  yorum_mesaj=?,
				  yorum_konu_id=?
		
		");
		
		$ekle = $yorum->execute(array($isim,$mail,$mesaj,$id));
		
		if($ekle){
			
			
			echo '<div style="border:1px solid #ddd; padding:10px; font-size:25px; background:lightgreen;"> Mesaj Eklendi Lütfen bekleyin...</div>';
			
			$url = $_SERVER["HTTP_REFERER"];
			
			header("refresh: 2; url=$url");
			
			
		}else {
			
			echo '<div style="border:1px solid #ddd; padding:10px; font-size:25px; background:red;">HATA OLUSTU</div>';
			
		}
	}
	
	
}else {
	
	if($_SESSION){
		
		?>
<div class="sol2">
	<div style="font-size:19px; padding:10px;" class="alert alert-primary">Mesaj Gönder</div>

   <form action="" method="post">
	<ul> 
	
	<li><p>Adınız : <span class="text-primary"><?php echo $_SESSION["uye"]; ?></span> </p> <input type="hidden" value="<?php echo $_SESSION["uye"]; ?>" name="isim"/></li>
	
	<li><p>E-Posta : <span class="text-primary"><?php echo $_SESSION["eposta"];?></span> </p><input type="hidden"  value="<?php echo $_SESSION["eposta"];?>" name="mail" /></li>

	<li>Mesajınız</li>
	<li><textarea name="mesaj" id="" cols="50" rows="10"></textarea></li>
	<li><button type="submit">Gönder</button></li>
	</ul>
	</form>
	</div>
	<?php
		
		
	}else {
		
		?>
	<div style="font-size:19px; padding:10px;" class="alert alert-primary">Mesaj Gönder</div>
<div class="sol2">
   <form action="" method="post">
	<ul> 
	<li><p><span class="text-primary">Adınız :</span></li>
	<li><input type="text" name="isim" /></li>
	<li><p><span class="text-primary">E-Posta :</span></li>
	<li><input type="text" name="mail" /></li>
	<li>Mesajınız</li>
	
	<li><textarea name="mesaj" id="" cols="50" rows="10"></textarea></li>
	
	<li><button type="submit">Gönder</button></li>
	</ul>
	</form>
	</div>
	<?php
		
		
	}
	
	
	
}

?>

</html>


	
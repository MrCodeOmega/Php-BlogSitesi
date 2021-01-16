<?php session_start();?>
<?php include("ayar.php");?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
<meta charset="UTF-8">
<title>Blog Sitesi Editör Sayfa</title>

<link rel="stylesheet" href="styles.css" />
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="admin.css" />	
</head>

<body>

<?php
if($_SESSION){
	if($_SESSION["rutbe"]==2){
		?>
		
		<div class="admin-genel"> 
		<div class="admin-header" style ="border:1px solid #ddd;
	height:160px;
	background:skyblue;">
		<h2 style="margin:50px 0px 30px;font-size:30px;"><a href="/editor/">Editör  <span style="color:blue;">Yönetim Paneli</span></a>
		<span style="float:right"><a href="/index.php">Siteye AnaSayfa</a></span></h2>
		<div style="font-size:25px; margin:20px; color:red; ">Kullanıcı : <?php echo $_SESSION["uye"];?></div>
		</div>
		<div class="admin-icerik">
		<div class="admin-menu" style="border:1px solid #ddd; width:300px; min-height:600px; background:white; float:left;">
		<div class="liste" style="border:1px solid #ddd; padding:10px; font-size: 20px">
		<ul>
		<li><a href="/editor/?do=anasayfa">Anasayfa</a></li>
		<li><a href="/editor/?do=konular">Konular</a></li>
		<li><a href="/editor/?do=uyeler">Uyeler</a></li>
		<li><a href="/editor/?do=yorumlar">Yorumlar</a></li>
		<li><a href="/editor/?do=kategoriler">Kategoriler</a></li>
		<li style="margin-top:15px;"><button href="" type="button" class="btn btn-outline-danger">
		Çıkış <span class="badge badge-light">X</span>
		<span class="sr-only">unread messages</span>
		</button></li>
		</ul>
		</div>
		</div>
		<?php 
			$do = @$_GET["do"];
			if(file_exists("{$do}.php")){
				
				include("{$do}.php");
			}else{
				
				include("anasayfa.php");
				
			}
		
		?>
		</div>
		</div>
		
		
		
		<?php
		
	}else{
		echo '<div class="alert alert-secondary" role="alert">Admin Yetkiniz Bulunmamakta... </div>';
		
	}
	
	
}else{
	
	echo '<div class="alert alert-secondary" role="alert">Admin Panelini Sadece Yönetici Görebilir... </div>';
	
}

?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>


</html>
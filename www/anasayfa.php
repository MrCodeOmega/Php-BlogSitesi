<?php !defined("index")? die("saldırı ?"): null; ?>
<?php 

 $sayfa = intval(@$_GET["sayfa"]);
  
  if(!$sayfa){
	  
	  $sayfa =1;
	  
  }
  $v = $db->prepare("select * from konular");
  $v->execute(array(1));
  $v->fetchALL(PDO::FETCH_ASSOC);
  $toplam = $v->rowCount();
  $limit = 3;
  $goster = $sayfa*$limit-$limit; 
  $sayfa_sayisi =  ceil($toplam/$limit);
  $forlimit = 2;
  
  
  
 $konu = $db->prepare("select * from konular inner join kategoriler on 
 
 kategoriler.kategori_id = konular.konu_kategori order by konu_id desc limit $goster,$limit");
 $konu->execute(array());
$x =  $konu->fetchALL(PDO::FETCH_ASSOC);

foreach($x as $m){
		$yorum = $db->prepare("select * from yorumlar where yorum_konu_id=? and yorum_onay=?");
		$yorum->execute(array($m["konu_id"],1));
		$yorum->fetchALL(PDO::FETCH_ASSOC);
		$x= $yorum->rowCount();
		?>
		<div class="sol2"> 
	<h2><?php echo $m["konu_baslik"]; ?></h2>
	<div class="bilgi" style="font-size:15px;">Kategori :<span style="font-weight:bold"> 
	<?php echo $m["kategori_adi"]; ?></span> Yazan : <span style="font-weight:bold; color:red"> 
	<?php  echo $m["konu_yazan"];?></span> Okunma : <span style="font-weight:bold"> 
	<?php echo $m["konu_hit"]; ?></span> Yorum : <?php echo $x; ?>
	<span style="float:right;">Tarih : <?php echo $m["konu_tarih"]; ?></span></div>
	<div class="resim"> 
	<img src="<?php echo $m["konu_resim"]; ?>" alt="" />
	</div>
	<p> 
		<?php echo substr ($m["konu_aciklama"],0,150); ?>
	</p>
	
	
	
	<a href="?do=devam&id=<?php echo $m["konu_id"];?>"
	style="float:right; padding:20px">
	<button class="btn btn-primary">Devam</button>
	
	</a>
	
	
	</div>
	
		
		<?php


}

echo '<div style="border:1px solid #ddd;
	margin-bottom:20px;
	padding:10px;
	font-size:20px;
	
	width:679px;">';

for($i=$sayfa-$forlimit; $i<$sayfa+$forlimit+1; $i++)
{
	if($i>0 && $i<=$sayfa_sayisi){
		if($i==$sayfa){
			
			echo '<button class="btn btn-secondary">'.$i.'       </button>  '; 
			
			
		}else{
			
			echo '<a href="?sayfa='.$i.'" style="color:white"><button class="btn btn-primary">'.$i.'      </button></a>  ';
			
			
		}
		
	}
	
	
}
if($sayfa!=$sayfa_sayisi){
	
	echo '<a style="color:white" href="?sayfa='.$sayfa_sayisi.'"><button class="btn btn-primary" style="float:right;">Son Sayfa</button></a>';
}

?>


	
	<div style="clear:both;"></div>
	</div>


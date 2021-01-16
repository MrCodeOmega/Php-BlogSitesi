<?php
$id= $_GET["id"];
$v = $db->prepare("select * from kategoriler where kategori_id=?");
$v->execute(array($id));

$m=$v->fetch(PDO::FETCH_ASSOC);
?>

<div class="admin-icerik-sag" style="float:left; margin-left:20px; border:1px
		solid #ddd; width:75%; min-height:200px; background:white;">
		<h2 style="border:1px solid #ddd; padding:10px; margin:2px; font-size:20px; background:#eee;">Kategori Düzenle</h2>
		
		<?php
		
		if($_POST){
			$adi= trim(strip_tags($_POST["adi"]));
			$aciklama= $_POST["aciklama"];
			
			
			if(!$adi ||!$aciklama){
				
				echo '<div class="alert alert-warning">Tüm Alanları Giriniz...<div>';
			}else{
				
				$guncelle = $db->prepare("update kategoriler set
				kategori_adi =?,
				kategori_aciklama =?
				where kategori_id =?
				");
				
				$update =$guncelle-> execute(array($adi,$aciklama,$id));
				
				if($update){
					
					echo '<div class="alert alert-success">Kategori Güncellendi.  Bekleyiniz...</div>';
					header ("refresh: 2; url=/editor/?do=kategoriler");
				}else{
					
					echo '<div class="alert alert-danger">Kategori Düzenlemede Bir Hata Oluştu..</div>';
					
					
				}
				
			}
			
		}else{
			?>
			
			<div class="konular">
			<form action="" method="post">
			<ul style="list-style-type:none ">
			<li><b>Kategori Adı</b></li>
			<li><input type="text" name ="adi" value="<?php echo $m["kategori_adi"]; ?>"></li>
			<li><b>Açıklama</b></li>
			<li><textarea name="aciklama" id="" cols="70" rows="10"><?php echo $m["kategori_aciklama"]; ?></textarea></li>
			<li><span><button class="btn btn-success" type="submit">Kategoriyi Düzenle</button></span> </li>
			
			</ul>
			</form>
			</div>
			
			
			<?php
			
		}
		
		?>
		
		
		</div>
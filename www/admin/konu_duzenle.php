<?php
$id= $_GET["id"];
$v = $db->prepare("select * from konular where konu_id=?");
$v->execute(array($id));

$m=$v->fetch(PDO::FETCH_ASSOC);
?>

<div class="admin-icerik-sag" style="float:left; margin-left:20px; border:1px
		solid #ddd; width:75%; min-height:200px; background:white;">
		<h2 style="border:1px solid #ddd; padding:10px; margin:2px; font-size:20px; background:#eee;">Konu Düzenle</h2>
		
		<?php
		
		if($_POST){
			$baslik= $_POST["baslik"];
			$resim= $_POST["resim"];
			$kategori= $_POST["kategori"];
			$aciklama= $_POST["aciklama"];
			$onay= $_POST["onay"];
			$ekleyen = $m["konu_yazan"];
			
			if(!$baslik || !$resim || !$aciklama){
				
				echo '<div class="alert alert-warning">Tüm Alanları Giriniz...<div>';
			}else{
				
				$guncelle = $db->prepare("update konular set
				konu_baslik =?,
				konu_resim =?,
				konu_kategori=?,
				konu_aciklama=?,
				konu_durum=?,
				konu_yazan=? where konu_id =?
				");
				
				$update =$guncelle-> execute(array($baslik,$resim,$kategori,$aciklama,$onay,$ekleyen,$id));
				
				if($update){
					
					echo '<div class="alert alert-success">Konu Güncellendi.  Bekleyiniz...</div>';
					header ("refresh: 2; url=/admin/?do=konular");
				}else{
					
					echo '<div class="alert alert-danger">Konu Düzenlemede Bir Hata Oluştu..</div>';
					
					
				}
				
			}
			
		}else{
			?>
			
			<div class="konular">
			<form action="" method="post">
			<ul style="list-style-type:none ">
			<li><b>Konu Başlığı</b></li>
			<li><input type="text" name ="baslik" value="<?php echo $m["konu_baslik"]; ?>"></li>
			<li><b>Resim Kaynağı</b></li>
			<li><input type="text" name ="resim" value="<?php echo $m["konu_resim"]; ?>"> <span style="margin-left:100px"><b>Resim :  </b><?php echo '<img src="'.$m["konu_resim"].'" width="300" height="100" />'?></span></li>
			<li><b>Kategori</b></li>
			<li><select name="kategori" id="">
			<?php
			$b = $db->prepare("select * from kategoriler order by kategori_id desc");
			$b->execute(array());
			$c =$b->fetchALL(PDO::FETCH_ASSOC);
			foreach($c as $z){
				echo '<option value="'.$z["kategori_id"].'"';
				
			echo $m["konu_kategori"]==$z["kategori_id"] ? 'selected': null;
			echo'>'.$z["kategori_adi"].'</option>';
				
			}
			
			?>
			</select></li>
			<li><b>Açıklama</b></li>
			<li><textarea name="aciklama" id="" cols="70" rows="10"><?php echo $m["konu_aciklama"]; ?></textarea></li>
			<li><select name="onay" id="">
			<option value="1"<?php echo $m["konu_durum"] ==1 ? 'selected' : null; ?>>Onaylı</option>
			<option value="0"<?php echo $m["konu_durum"] ==0 ? 'selected' : null; ?>>Onaylı Değil</option>
			</select> <span style="margin-left:500px"><button class="btn btn-success" type="submit">Konuyu Düzenle</button></span> </li>
			
			</ul>
			</form>
			</div>
			
			
			<?php
			
		}
		
		?>
		
		
		</div>
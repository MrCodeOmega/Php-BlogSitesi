

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
			
			
			if(!$baslik || !$resim || !$aciklama){
				
				echo '<div class="alert alert-warning">Tüm Alanları Giriniz...<div>';
			}else{
				
				$guncelle = $db->prepare("insert into konular set
				konu_baslik =?,
				konu_resim =?,
				konu_kategori=?,
				konu_aciklama=?,
				konu_durum=?,
				konu_yazan=? 
				");
				
			$update =$guncelle-> execute(array($baslik,$resim,$kategori,$aciklama,$onay,$_SESSION["uye"]));
				
				if($update){
					
					echo '<div class="alert alert-success">Konu Eklendi Bekleyiniz...</div>';
					header ("refresh: 2; url=/editor/?do=konular");
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
			<li><input type="text" name ="baslik"></li>
			<li><b>Resim Kaynağı</b></li>
			<li><input type="text" name ="resim"> </li>
			<li><b>Kategori</b></li>
			<li><select name="kategori" id="">
			<?php
			$b = $db->prepare("select * from kategoriler order by kategori_id desc");
			$b->execute(array());
			$c =$b->fetchALL(PDO::FETCH_ASSOC);
			foreach($c as $z){
				echo '<option value="'.$z["kategori_id"].'">'.$z["kategori_adi"].'</option>';
				
			}
			
			?>
			</select></li>
			<li><b>Açıklama</b></li>
			<li><textarea name="aciklama" id="" cols="70" rows="10"></textarea></li>
			<li><select name="onay" id="">
			<option value="1">Onaylı</option>
			<option value="0">Onaylı Değil</option>
			</select> <span style="margin-left:500px"><button class="btn btn-success" type="submit">Konu Ekle</button></span> </li>
			
			</ul>
			</form>
			</div>
			
			
			<?php
			
		}
		
		?>
		
		
		</div>
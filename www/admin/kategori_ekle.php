

<div class="admin-icerik-sag" style="float:left; margin-left:20px; border:1px
		solid #ddd; width:75%; min-height:200px; background:white;">
		<h2 style="border:1px solid #ddd; padding:10px; margin:2px; font-size:20px; background:#eee;">Kategori Ekle</h2>
		
		<?php
		
		if($_POST){
			$adi= $_POST["adi"];
			$aciklama= $_POST["aciklama"];
			
			
			
			if(!$adi || !$aciklama){
				
				echo '<div class="alert alert-warning">Tüm Alanları Giriniz...<div>';
				
			}else{
			
				$kontrol = $db->prepare("select * from kategoriler where kategori_adi=?");
					$kontrol->execute(array($adi));
					$listele = $kontrol->fetch(PDO::FETCH_ASSOC);
					$x = $kontrol->rowCount();
					
					if($x){
					
					   echo '<div class="alert alert-danger"><span style="color:red;">'.$adi.'</span> İsminde Kategori Zaten Var...</div>';

					
					
				}else{
				$guncelle = $db->prepare("insert into kategoriler set
				kategori_adi=?,
				kategori_aciklama =?
				");
			
				
			$update =$guncelle-> execute(array($adi,$aciklama));
				
				if($update){
					
					echo '<div class="alert alert-success">Kategori Eklendi Bekleyiniz...</div>';
					header ("refresh: 2; url=/admin/?do=kategoriler");
				}else{
					
					echo '<div class="alert alert-danger">Kategori Eklemede Bir Hata Oluştu..</div>';
					
					
				}
				
				}
				
				
				
			}
			
		}else{
			?>
			
			<div class="konular">
			<form action="" method="post">
			<ul style="list-style-type:none ">
			<li><b>Kategori Adı</b></li>
			<li><input type="text" name ="adi"></li>
			<li><b>Açıklama</b></li>
			<li><textarea name="aciklama" id="" cols="70" rows="10"></textarea></li>
			<span style=""><button class="btn btn-success" type="submit">Kategori Ekle</button></span> </li>
			
			</ul>
			</form>
			</div>
			
			
			<?php
			
		}
		
		?>
		
		
		</div>
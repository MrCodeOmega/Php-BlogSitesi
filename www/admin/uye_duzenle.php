<?php
$id= $_GET["id"];
$v = $db->prepare("select * from uyeler where uye_id=?");
$v->execute(array($id));

$m=$v->fetch(PDO::FETCH_ASSOC);
?>

<div class="admin-icerik-sag" style="float:left; margin-left:20px; border:1px
		solid #ddd; width:75%; min-height:200px; background:white;">
		<h2 style="border:1px solid #ddd; padding:10px; margin:2px; font-size:20px; background:#eee;">Üye Düzenle</h2>
		
		<?php
		
		if($_POST){
			$adi= $_POST["adi"];
			$sifre= $_POST["sifre"];
			$rutbe= $_POST["rutbe"];
			$eposta= $_POST["eposta"];
			$onay= $_POST["onay"];
			$hakkimda = $_POST["hakkimda"];
			
			if(!$adi || !$eposta){
				
				echo '<div class="alert alert-warning">Tüm Alanları Giriniz...<div>';
			}elseif(!filter_var($eposta,FILTER_VALIDATE_EMAIL)){
		
		echo '<div>Geçerli Bir "Email" Adresi girin.. </div>';
		
	}
	
			
			
			else{
				
				if($sifre){
					
					
					$sifre=md5($sifre);
					
				}else{
					
					$sifre = $m["uye_sifre"];
					
					
				}
				
				
				
				$guncelle = $db->prepare("update uyeler set
				uye_adi =?,
				uye_sifre =?,
				uye_rutbe=?,
				uye_eposta=?,
				uye_onay=?,
				uye_hakkimda=? where uye_id =?
				");
				
				$update =$guncelle-> execute(array($adi,$sifre,$rutbe,$eposta,$onay,$hakkimda,$id));
				
				if($update){
					
					echo '<div class="alert alert-success">Üye Güncellendi.  Bekleyiniz...</div>';
					header ("refresh: 2; url=/admin/?do=uyeler");
				}else{
					
					echo '<div class="alert alert-danger">Üye Düzenlemede Bir Hata Oluştu..</div>';
					
					
				}
				
			}
			
			
			
		}else{
			?>
			
			<div class="konular">
			<form action="" method="post">
			<ul style="list-style-type:none ">
			<li><b>Üye Adı</b></li>
			<li><input type="text" name ="adi" value="<?php echo $m["uye_adi"]; ?>"></li>
			<li><b>E-Posta</b></li>
			<li><input type="text" name ="eposta" value="<?php echo $m["uye_eposta"]; ?>"></li>
			<li><b>Şifresi</b></li>
			<li><input type="text" name ="sifre" value="" placeholder="Yeni Şifre Giriniz."> <span style="margin-left:50px" class="alert alert-warning"><b>Şifresini Unutması Halinde Değiştirme isteği varsa Giriniz..   </b></span></li>
			<li><b>Rütbe</b></li>
			<li>
			<select name="rutbe" id="">
			<option value="0" <?php echo $m["uye_rutbe"]==0 ? 'selected' : null; ?>>Üye</option>
			<option value="1" <?php echo $m["uye_rutbe"]==1 ? 'selected' : null; ?>>Yönetici</option>
			<option value="2" <?php echo $m["uye_rutbe"]==2 ? 'selected' : null; ?>>Editör</option>
			</select>
			</li>
			<li><b>Üye Hakkında</b></li>
			<li><textarea name="aciklama" id="" cols="70" rows="10"><?php echo $m["uye_hakkimda"]; ?></textarea></li>
			<li><select name="onay" id="">
			<option value="1"<?php echo $m["uye_onay"] ==1 ? 'selected' : null; ?>>Onaylı</option>
			<option value="0"<?php echo $m["uye_onay"] ==0 ? 'selected' : null; ?>>Onaylı Değil</option>
			</select> <span style="margin-left:500px"><button class="btn btn-success" type="submit">Üyeyi Düzenle</button></span> </li>
			
			</ul>
			</form>
			</div>
			
			
			<?php
			
		}
		
		?>
		
		
		</div>
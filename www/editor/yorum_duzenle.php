<?php
$id= $_GET["id"];
$v = $db->prepare("select * from yorumlar where yorum_id=?");
$v->execute(array($id));

$m=$v->fetch(PDO::FETCH_ASSOC);
?>

<div class="admin-icerik-sag" style="float:left; margin-left:20px; border:1px
		solid #ddd; width:75%; min-height:200px; background:white;">
		<h2 style="border:1px solid #ddd; padding:10px; margin:2px; font-size:20px; background:#eee;">Yorum Düzenle</h2>
		
		<?php
		
		if($_POST){
			$mesaj= $_POST["mesaj"];
			$onay= $_POST["onay"];
			
			
			if(!$mesaj){
				
				echo '<div class="alert alert-warning">Yorum Boş Bırakılmamalı -Silme işlemi yapınız-...<div>';
			}else{
				
				$guncelle = $db->prepare("update yorumlar set
				yorum_mesaj =?,
				yorum_onay =?
				 where yorum_id =?
				");
				
				$update =$guncelle-> execute(array($mesaj,$onay,$id));
				
				if($update){
					
					echo '<div class="alert alert-success">Yorum Güncellendi.  Bekleyiniz...</div>';
					header ("refresh: 2; url=/editor/?do=yorumlar");
				}else{
					
					echo '<div class="alert alert-danger">Yorum Düzenlemede Bir Hata Oluştu..</div>';
					
					
				}
				
			}
			
		}else{
			?>
			
			<div class="konular">
			<form action="" method="post">
			<ul style="list-style-type:none ">
			<li><b>Yorum</b></li>
			<li><textarea name="mesaj" id="" cols="70" rows="10"><?php echo $m["yorum_mesaj"]; ?></textarea></li>
			<li><b>Yorum Yapan</b></li>
			<li><input type="text" style="color:darkgreen" disabled name ="yorumcu" value="<?php echo $m["yorum_ekleyen"]; ?>"></li>
			</br>
				
			<li><select name="onay" id="">
			<option value="1"<?php echo $m["yorum_onay"] ==1 ? 'selected' : null; ?>>Onaylı</option>
			<option value="0"<?php echo $m["yorum_onay"] ==0 ? 'selected' : null; ?>>Onaylı Değil</option>
			</select> <span style="margin-left:500px"><button class="btn btn-success" type="submit">Yorumu Düzenle</button></span> </li>
			
			</ul>
			</form>
			</div>
			
			
			<?php
			
		}
		
		?>
		
		
		</div>
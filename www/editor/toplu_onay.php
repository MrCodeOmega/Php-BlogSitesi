<div class="admin-icerik-sag" style="float:left; margin-left:20px; border:1px
		solid #ddd; width:75%; min-height:200px; background:white;">
		<h2 style="border:1px solid #ddd; padding:10px; margin:2px; font-size:20px; background:#eee;">Editör AnaSayfa</h2>
		<?php
		
		$onayla = $_POST["onayla"];
		$a = implode(",",$onayla);
		$toplu =$db->query("update yorumlar set yorum_onay=1 where yorum_id in ($a)");
		
		if($toplu){
			
			echo '<div class="alert alert-success">Yorumlar Onaylandı Lütfen Bekleyin ..</div>';
			header("refresh:1; url=/editor/?do=yorumlar");
		}else{
			
			echo '<div class="alert alert-danger">Hata Oluştu...</div>';
			
		}
		
		?>
		
		
		
		</div>
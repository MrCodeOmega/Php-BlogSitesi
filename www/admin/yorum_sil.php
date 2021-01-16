<?php

$id =$_GET["id"];


?>



<div class="admin-icerik-sag" style="float:left; margin-left:20px; border:1px
		solid #ddd; width:75%; min-height:200px; background:white;">
		<h2 style="border:1px solid #ddd; padding:10px; margin:2px; font-size:20px; background:#eee;">
		Yorum Silme Sayfası</h2>
		<div class="konular">
		<?php
		
		$v = $db->prepare("delete from yorumlar where yorum_id=?");
		$sil = $v->execute(array($id));
		if($sil){
			
			echo '<div class="alert alert-success">Yorum Silindi..</div>';
			header("refresh:1; url=/admin/?do=yorumlar");
			
		}else{
			
			echo '<div class="alert alert-warning">Hata Oluştu..</div>';
			
		}
		?>
		
		</div>
		
		</div>
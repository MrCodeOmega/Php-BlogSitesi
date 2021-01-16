<?php 
$v = $db->prepare("select * from yorumlar order by yorum_id desc");

$v->execute(array());
$k = $v->fetchALL(PDO::FETCH_ASSOC);
$x = $v->rowCount();

?>


<div class="admin-icerik-sag" style="float:left; margin-left:20px; border:1px
		solid #ddd; width:75%; min-height:200px; background:white;">
		<h2 style="border:1px solid #ddd; padding:10px; margin:2px; font-size:20px; background:#eee;">
		Yorumlar <span style="float:right"></h2>
		<div class="konular" style="margin:5x;" >
		<table cellspacing="0" cellpadding="3">
		<thead>
		<tr style="border:1px solid #ddd; padding:10px;">
		<th width="600">Yorumlar</th><th width="300">Yorum Yapan</th>
		<th width="200">Yorum Onayları</th><th width="600">Tarih</th>
		<th width="600"><span style="margin-left:60px;">İşlemler</span></th>
		</tr>
		</thead>
		<?php
		 if($x){
			 
			 foreach($k as $m){
				 
				 ?>
				 <tbody>
				 <tr>
				 <td style="border: 1px solid #ddd; padding:10px; "><?php echo mb_substr($m["yorum_mesaj"],0,40); ?></td> <td style="border: 1px solid #ddd; padding:10px; "><?php echo $m["yorum_ekleyen"]; ?></td> 
				 <td style="border: 1px solid #ddd; padding:10px; ">
				 <?php
					if($m["yorum_onay"]==1){
						
						echo '<div class="progress">
  <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 100% " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Onaylı</div>
</div>';
						
			 }else{
				 
				 
				 echo '<div class="progress">
  <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Onaysız</div>
</div>';
			 }

				 ?>
				      </td>
				 <td style="border: 1px solid #ddd; padding:10px;"><?php echo $m["yorum_tarihi"];?></td>
				 <td style="border: 1px solid #ddd;  padding:10px;">
				 <form action="/admin/?do=toplu_onay" method="post">
				 <input type="checkbox" name="onayla[]" value="<?php echo $m["yorum_id"]; ?>" />
				 
				 <span style="margin-left:30px;"><a type="button" class="btn btn-warning" href="/admin/?do=yorum_duzenle&id=<?php echo $m["yorum_id"]; ?>">Düzenle</a></span>  <span><a type="button" class="btn btn-danger" href="/admin/?do=yorum_sil&id=<?php echo $m["yorum_id"]; ?>">Sil</a></span></td>
				 </tr>
				 
				 </tbody>
				 
				 
				 <?php
			 }
			 
			 
			 
		 }else{
			 
			 echo '<tr><td colspan="5p"><div class="alert alert-secondary" role="alert">Hiç Yorum Yok..</div></td></tr>';
		 }
		
		?>
		</table>
		<button type="submit" class="btn btn-primary" style="float:right; margin-right:82px">Seçili Yorumları Onayla</button>
		</form>
		</div>
		
		</div>
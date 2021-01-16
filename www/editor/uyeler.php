<?php 
$v = $db->prepare("select * from uyeler order by uye_id desc");

$v->execute(array());
$k = $v->fetchALL(PDO::FETCH_ASSOC);
$x = $v->rowCount();

?>


<div class="admin-icerik-sag" style="float:left; margin-left:20px; border:1px
		solid #ddd; width:75%; min-height:200px; background:white;">
		<h2 style="border:1px solid #ddd; padding:10px; margin:2px; font-size:25px; background:#eee;">
		Üye Listesi <span style="float:right"></h2>
		<div class="konular" style="margin:5x;" >
		<table cellspacing="0" cellpadding="3">
		<thead>
		<tr style="border:1px solid #ddd; padding:10px;">
		<th width="600">Üye Adı</th><th width="300">Üye E-mail</th>
		<th width="200">Üye Onayı</th><th width="200">Rütbesi</th><th width="600">Katılma Tarih</th>
		<th width="600"><span style="margin-left:60px;">İşlemler</span></th>
		</tr>
		</thead>
		<?php
		 if($x){
			 
			 foreach($k as $m){
				 
				 ?>
				 <tbody>
				 <tr>
				 <td style="border: 1px solid #ddd; padding:10px; "><?php echo $m["uye_adi"]; ?></td> <td style="border: 1px solid #ddd; padding:10px; "><?php echo $m["uye_eposta"]; ?></td> 
				 <td style="border: 1px solid #ddd; padding:10px; ">
				 <?php
					if($m["uye_onay"]==1){
						
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
					   <td style="border: 1px solid #ddd; padding:10px;">
					   <?php
					   if($m["uye_rutbe"]==0){
						   echo '<b>Üye</b>';
						   
			 }if($m["uye_rutbe"]==1){
				 echo '<b>Yönetici</b>';
				 
			 }if($m["uye_rutbe"]==2){
				 echo '<b>Editör</b>';
				 
			 }
			 
					   ?>
					   </td>
				 <td style="border: 1px solid #ddd; padding:10px;"><?php echo $m["uye_tarih"];?></td>
				 <td style="border: 1px solid #ddd;  padding:10px;"><span style="margin-left:30px;"><a type="button" class="btn btn-warning" href="/editor/?do=uye_duzenle&id=<?php echo $m["uye_id"]; ?>">Düzenle</a></span> </td>
				 </tr>
				 
				 </tbody>
				 
				 
				 <?php
			 }
			 
			 
			 
		 }else{
			 
			 echo '<tr><td colspan="5p"><div class="alert alert-secondary" role="alert">Hiç Üye Yok..</div></td></tr>';
		 }
		
		?>
		</table>
		</div>
		</div>
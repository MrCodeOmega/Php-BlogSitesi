<?php 
$v = $db->prepare("select * from konular inner join kategoriler on kategoriler.kategori_id= 
konular.konu_kategori order by konu_id desc");

$v->execute(array());
$k = $v->fetchALL(PDO::FETCH_ASSOC);
$x = $v->rowCount();

?>


<div class="admin-icerik-sag" style="float:left; margin-left:20px; border:1px
		solid #ddd; width:75%; min-height:200px; background:white;">
		<h2 style="border:1px solid #ddd; padding:10px; margin:2px; font-size:20px; background:#eee;">
		Konular <span style="float:right"><a href="/admin/?do=konu_ekle"><b>Konu Ekle</b></a></span></h2>
		<div class="konular" style="margin:5x;" >
		<table cellspacing="0" cellpadding="3">
		<thead>
		<tr style="border:1px solid #ddd; padding:10px;">
		<th width="600">Konu Başlıkları</th><th width="300">Kategoriler</th>
		<th width="200">Konu Olayı</th><th width="600">Tarih</th>
		<th width="600"><span style="margin-left:60px;">İşlemler</span></th>
		</tr>
		</thead>
		<?php
		 if($x){
			 
			 foreach($k as $m){
				 
				 ?>
				 <tbody>
				 <tr>
				 <td style="border: 1px solid #ddd; padding:10px; "><?php echo $m["konu_baslik"]; ?></td> <td style="border: 1px solid #ddd; padding:10px; "><?php echo $m["kategori_adi"]; ?></td> 
				 <td style="border: 1px solid #ddd; padding:10px; ">
				 <?php
					if($m["konu_durum"]==1){
						
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
				 <td style="border: 1px solid #ddd; padding:10px;"><?php echo $m["konu_tarih"];?></td>
				 <td style="border: 1px solid #ddd;  padding:10px;"><span style="margin-left:30px;"><a type="button" class="btn btn-warning" href="/admin/?do=konu_duzenle&id=<?php echo $m["konu_id"]; ?>">Düzenle</a></span>  <span><a type="button" class="btn btn-danger" href="/admin/?do=konu_sil&id=<?php echo $m["konu_id"]; ?>">Sil</a></span></td>
				 </tr>
				 
				 </tbody>
				 
				 
				 <?php
			 }
			 
			 
			 
		 }else{
			 
			 echo '<tr><td colspan="5p"><div class="alert alert-secondary" role="alert">Hiç Konu Yok..</div></td></tr>';
		 }
		
		?>
		</table>
		</div>
		</div>
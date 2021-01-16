<?php 
$v = $db->prepare("select * from kategoriler order by kategori_id desc");

$v->execute(array());
$k = $v->fetchALL(PDO::FETCH_ASSOC);
$x = $v->rowCount();

?>


<div class="admin-icerik-sag" style="float:left; margin-left:20px; border:1px
		solid #ddd; width:75%; min-height:200px; background:white;">
		<h2 style="border:1px solid #ddd; padding:10px; margin:2px; font-size:20px; background:#eee;">
		<b>Kategoriler</b></h2>
		<div class="konular" style="margin:5x;" >
		<table cellspacing="0" cellpadding="3">
		<thead>
		<tr style="border:1px solid #ddd; padding:10px;">
		<th width="400">Kategori Adı</th><th width="600">Kategori Açıklama</th>
		<th width="600"><span style="margin-left:60px;">İşlemler</span></th>
		</tr>
		</thead>
		<?php
		 if($x){
			 
			 foreach($k as $m){
				 
				 ?>
				 <tbody>
				 <tr>
				 <td style="border: 1px solid #ddd; padding:10px; "><?php echo $m["kategori_adi"]; ?></td> 
				 <td style="border: 1px solid #ddd; padding:10px; "><?php echo $m["kategori_aciklama"]; ?></td> 
				
				 <td style="border: 1px solid #ddd;  padding:10px;"><span style="margin-left:30px;">
				 <a type="button" class="btn btn-warning" href="/editor/?do=kategori_duzenle&id=<?php echo $m["kategori_id"]; ?>">
				 Düzenle</a></span>
				 </td>
				 </tr>
				 
				 </tbody>
				 
				 
				 <?php
			 }
			 
			 
			 
		 }else{
			 
			 echo '<tr><td colspan="5p"><div class="alert alert-secondary" role="alert">Hiç Kategori Yok..</div></td></tr>';
		 }
		
		?>
		</table>
		</div>
		</div>
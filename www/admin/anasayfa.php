<?php

$konular=$db->prepare("select * from konular inner join kategoriler on kategoriler.kategori_id
= konular.konu_kategori");
$konular->execute(array());
$konular->fetchALL(PDO::FETCH_ASSOC);
$konu = $konular->rowCount();

$ko=$db->prepare("select * from konular inner join kategoriler on kategoriler.kategori_id
= konular.konu_kategori where konu_durum=?");
$ko->execute(array(0));
$ko->fetchALL(PDO::FETCH_ASSOC);
$konuOnay = $ko->rowCount();


$uyeler=$db->prepare("select * from uyeler");
$uyeler->execute(array());
$uyeler->fetchALL(PDO::FETCH_ASSOC);
$uye = $uyeler->rowCount();

$uyeonay=$db->prepare("select * from uyeler where uye_onay=?");
$uyeonay->execute(array(0));
$uyeonay->fetchALL(PDO::FETCH_ASSOC);
$uyeO = $uyeonay->rowCount();



$yorumlar=$db->prepare("select * from yorumlar");
$yorumlar->execute(array());
$yorumlar->fetchALL(PDO::FETCH_ASSOC);
$yorum = $yorumlar->rowCount();

$yorumonay=$db->prepare("select * from yorumlar where yorum_onay=?");
$yorumonay->execute(array(0));
$yorumonay->fetchALL(PDO::FETCH_ASSOC);
$yorumO = $yorumonay->rowCount();


$kategoriler=$db->prepare("select * from kategoriler");
$kategoriler->execute(array());
$kategoriler->fetchALL(PDO::FETCH_ASSOC);
$kategori = $kategoriler->rowCount();





?>


<div class="admin-icerik-sag" style="float:left; margin-left:20px; border:1px
		solid #ddd; width:75%; min-height:200px; background:white;">
		<h2 style="border:1px solid #ddd; padding:10px; margin:2px; font-size:20px; background:#eee;">Admin AnaSayfa</h2>
		
		
		
		<div class="anasayfa" style="float:left; border:1px solid #ddd; width:200px; padding:5px; margin:5px; height:100px; background: skyblue;">
		<h3 style="border:1px sloid #ddd; padding:5px; background:#eee; font-size:17px">Konular</h3>
		<p style="padding:2px;"><b>Toplam Konu :</b> <span class="badge badge-primary text-wrap" style="font-size:17px"><?php echo $konu; ?></span>
		</br>
		<b>Onay Bekleyenler :</b> <a href="/admin/?do=konular" ><span class="badge badge-warning text-wrap" style="font-size:17px"><?php echo $konuOnay; ?></span></a>
		</p>
		
		</div>
		<div class="anasayfa" style="float:left; border:1px solid #ddd; width:200px; padding:5px; margin:5px; height:100px; background: skyblue;">
		<h3 style="border:1px sloid #ddd; padding:5px; background:#eee; font-size:17px">Üyeler</h3>
		<p style="padding:2px;"><b>Toplam Üye :</b> <span class="badge badge-primary text-wrap" style="font-size:17px"><?php echo $uye; ?></span>
		</br>
		<b>Onay Bekleyenler :</b><a href="/admin/?do=uyeler" > <span class="badge badge-warning text-wrap" style="font-size:17px"><?php echo $uyeO; ?></span></a>
		</p>
		
		</div>
		<div class="anasayfa" style="float:left; border:1px solid #ddd; width:200px; padding:5px; margin:5px; height:100px; background: skyblue;">
		<h3 style="border:1px sloid #ddd; padding:5px; background:#eee; font-size:17px">Yorumlar</h3>
		<p style="padding:2px;"><b>Toplam Yorum :</b> <span class="badge badge-primary text-wrap" style="font-size:17px"><?php echo $yorum; ?></span>
		</br>
		<b>Onay Bekleyenler :</b> <a href="/admin/?do=yorumlar" ><span class="badge badge-warning text-wrap" style="font-size:17px"><?php echo $yorumO; ?></span></a>
		</p>
		
		
		</div>
		
		<div class="anasayfa" style="float:left; border:1px solid #ddd; width:200px; padding:5px; margin:5px; height:100px; background: skyblue;">
		<h3 style="border:1px sloid #ddd; padding:5px; background:#eee; font-size:17px">Kategoriler</h3>
			<p style="padding:2px;"><b>Toplam Kategori :</b> <span class="badge badge-primary text-wrap" style="font-size:17px"><?php echo $kategori; ?></span>
		</br>
		
		</p>
		
		
		</div>
		
		</div>
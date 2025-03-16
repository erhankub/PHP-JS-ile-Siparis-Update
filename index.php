<!DOCTYPE html>
<html lang="tr">
<head>
    <meta http-equiv="Pragma" content="no-cache"> 
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <meta http-equiv="refresh" content="" />
    <title>JS ile Satır Toplama</title>
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="https://static.milliyet.com.tr/favicon/favicon-16x16.png"> -->
    <style>
		input[type=number]::-webkit-inner-spin-button,
		input[type=number]::-webkit-outer-spin-button {
		  -webkit-appearance: none;
		  margin: 0;
		}

		input[type=number] {
		  -moz-appearance: textfield;
		}
		input{
			width: 100px;
			text-align: right;
		}
    </style>

</head>
<body>

<?php
 
 $sipSeri = '';
 $sipSira = '11530';
 // $sipSira = '9462';

 $server = ".";
 $kullaniciadi = "ek";
 $sifre = "123456";
 $database = 'MikroDB_V16_KURTARAN2023';
 $baglan = new PDO("sqlsrv:Server=$server;Database=$database", $kullaniciadi, $sifre);
 $data = $baglan->query("
 SELECT 
         sip_Guid
	    ,convert(varchar, sip_tarih,104) as sip_tarih
	    ,sip_teslim_tarih
	    ,sip_tip
	    ,sip_cins
	    ,sip_evrakno_seri
	    ,sip_evrakno_sira
	    ,sip_satirno
	    ,sip_belgeno
	    ,sip_belge_tarih
	    ,sip_satici_kod
	    ,sip_musteri_kod
	    ,sip_stok_kod
	    ,FORMAT(sip_b_fiyat, 'N2', 'tr-TR') as sip_b_fiyat
	    ,FORMAT(sip_miktar, 'N2', 'tr-TR') as sip_miktar
	    ,sip_birim_pntr
	    ,sip_teslim_miktar
	    ,sip_tutar
	    ,FORMAT(sip_iskonto_1, 'N2', 'tr-TR') as sip_iskonto_1
	    ,sip_vergi_pntr
	    ,sip_vergi
	    ,sip_opno
	    ,sip_aciklama
	    ,sip_aciklama2
	    ,sip_OnaylayanKulNo
	    ,sip_vergisiz_fl
	    ,sip_kapat_fl
	    ,sip_cari_grupno
	    ,sip_doviz_cinsi
	    ,sip_doviz_kuru
	    ,sip_alt_doviz_kuru
	    ,sip_adresno
	    ,sip_teslimturu
	    ,sip_durumu
	    ,sip_teklif_uid
	    ,sip_parti_kodu
	    ,sip_lot_no
	    ,sip_projekodu
	    ,sip_harekettipi
	    ,sip_yetkili_uid
	    ,sip_gecerlilik_tarihi
	    ,sip_Tevkifat_turu
	    ,sip_tevkifat_sifirlandi_fl
	FROM SIPARISLER
 	WHERE sip_evrakno_seri = '$sipSeri' AND sip_evrakno_sira = '$sipSira'
 	ORDER BY sip_satirno
 	");
 $tt=0;
 while($row = $data->fetch(PDO::FETCH_ASSOC)) {
		$sip['Guid'][$tt]     = $row['sip_Guid'];
		$sip['musteri_kod'][$tt]     = $row['sip_musteri_kod'];
		$sip['tarih'][$tt]    = $row['sip_tarih'];
		$sip['miktar'][$tt]   = $row['sip_miktar'];
		$sip['b_fiyat'][$tt]  = $row['sip_b_fiyat'];
		$sip['satirno'][$tt]  = $row['sip_satirno'];
		$sip['stok_kod'][$tt]  = $row['sip_stok_kod'];
		$sip['iskonto'][$tt]  = $row['sip_iskonto_1'];
		$sip['evrakno_seri'][$tt]  = $row['sip_evrakno_seri'];
		$sip['evrakno_sira'][$tt]  = $row['sip_evrakno_sira'];
 $tt++;
 }
 ?>	
<form action="guncelle.php" target="_blank" method="GET">
<table>
<tr><th>Tarih:</th><td><input          name='tarih' type="text" value="<?=$sip['tarih'][0];?>" style='width: 210px;'></td></tr>
<tr><th>Cari Kodu:</th><td><input      name='cariKod' type="text" value="<?=$sip['musteri_kod'][0];?>" style='width: 210px;'></td></tr>
<tr><th>Seri Sıra Kodu:</th><td><input name='seri' type="text" value="<?=$sip['evrakno_seri'][0];?>" style='width: 100px;'><input name='sira' type="text" value="<?=$sip['evrakno_sira'][0];?>" style='width: 100px;'></td></tr>
</table>	</table>	
<table border="1">
	<thead>
		<tr>
			<th>SIRA</th>
			<th>STOK KOD</th>
			<th>ADET</th>
			<th>FİYAT</th>
			<th>İSKONTO</th>
			<th>TUTAR</th>
		</tr>
	</thead>	
	<tbody>	
	<? for ($i=0; $i < $tt; $i++) { ?>
		<tr>
			<td><?=$sip['satirno'][$i];?></td>
			<td><?=$sip['stok_kod'][$i];?></td>
			    <input hidden                                name="Guid[]"  type="text" value="<?=$sip['Guid'][$i];?>">
			<td><input onchange="topla1()" data-type='adet'  name="adet[]"  type="text" value="<?=$sip['miktar'][$i];?>"></td>
			<td><input onchange="topla1()" data-type='fiyat' name="fiyat[]" type="text" value="<?=$sip['b_fiyat'][$i];?>"></td>
			<td><input onchange="topla1()" data-type='iskon' name="iskon[]" type="text" value="<?=$sip['iskonto'][$i];?>"></td>
			<td><input                     data-type='tutar' name="tutar[]" type="text" value=""></td>
		</tr>
	<? } ?>
		<tr>
			<td><?=($i);?></td>
			<td><input type="date"></td>
			<td><input onchange="topla1()" data-type='adet'  name="adet[]" type="text" value="0"></td>
			<td><input onchange="topla1()" data-type='fiyat' name="fiyat[]" type="text" value="0"></td>
			<td><input onchange="topla1()" data-type='iskon' name="iskon[]" type="text" value="0"></td>
			<td><input                     data-type='tutar' name="tutar[]" type="text" value="0"></td>
		</tr>
	</tbody>	

	<tfoot>
		<tr>
			<td colspan='5' style="text-align: right;">TOPLAM</td>
			<td id="GenelToplam" style="text-align: right;"></td>
		</tr>
	</tfoot>	
</table>
	<input type="submit" value="Değişiklikleri Kaydet" style="width: 160px;">
	</form> 
    <script>
    var GenelToplam = document.getElementById('GenelToplam');	
    topla1();	
	function topla1(){
		var genTop = 0;
		var adetAll  = document.querySelectorAll("[data-type='adet']");
		var fiyatAll = document.querySelectorAll("[data-type='fiyat']");
		var iskonAll = document.querySelectorAll("[data-type='iskon']");
		var tutarAll = document.querySelectorAll("[data-type='tutar']");
		for (let i = 0; i < <?=($tt+1);?>; i++) {
			genTop += (strToFlo(adetAll[i].value) * strToFlo(fiyatAll[i].value) - strToFlo(iskonAll[i].value));
			tutarAll[i].value = paraFormat((strToFlo(adetAll[i].value) * strToFlo(fiyatAll[i].value)) - strToFlo(iskonAll[i].value));
            adetAll[i].value  = paraFormat(strToFlo(adetAll[i].value));
            fiyatAll[i].value = paraFormat(strToFlo(fiyatAll[i].value));
		}	
		GenelToplam.innerHTML = paraFormat(genTop);
	}
	
	function paraFormat(para){
		return para.toLocaleString('tr-TR', {style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2});	
	}

	function strToFlo(sayiString) {
	  let temizlenmisString = sayiString.replace(/\./g, '').replace(',', '.');
	  let floatSayi = parseFloat(temizlenmisString);
	  return floatSayi;
	}


</script>
</body>
</html>
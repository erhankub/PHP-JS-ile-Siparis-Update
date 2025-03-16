<?php 
	$cariKod = $_GET['cariKod'];
	$Guid = $_GET['Guid'];

	$adet = $_GET['adet'];
	$fiyat = $_GET['fiyat'];
	$tutar = $_GET['tutar'];
	$iskon = $_GET['iskon'];

	

	
 $server = ".";
 $kullaniciadi = "ek";
 $sifre = "123456";
 $database = 'MikroDB_V16_KURTARAN2023';
 $baglan = new PDO("sqlsrv:Server=$server;Database=$database", $kullaniciadi, $sifre);


	echo "cariKod ".$cariKod.'<br>';
	echo "<br>";
	for ($i=0; $i < count($Guid); $i++) { 
	//	echo "Guid ".$Guid[$i]." ".$fiyat[$i].'<br>';
		$sql = "UPDATE SIPARISLER SET 
			sip_b_fiyat = '".strToFlo($fiyat[$i])."', 
			sip_miktar = '".strToFlo($adet[$i])."', 
			sip_tutar = '".strToFlo($tutar[$i])."',
			sip_iskonto_1 = '".strToFlo($iskon[$i])."',
		    sip_vergi = '".vergiHesapla($adet[$i], $tutar[$i])."' WHERE sip_Guid = '".$Guid[$i]."'";
		echo $sql;
		$data = $baglan->query($sql);
	}


function strToFlo($sayiString) {
    $temizlenmisString = str_replace('.', '', $sayiString);
    $temizlenmisString = str_replace(',', '.', $temizlenmisString);
    $floatSayi = floatval($temizlenmisString);
    return $floatSayi;
}

function vergiHesapla($miktar, $tutar){
	return (strToFlo($miktar) * strToFlo($tutar) / 5);
}


 ?>
 

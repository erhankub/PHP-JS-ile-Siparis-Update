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
<table border="1">
	<thead>
		<tr>
			<th>SIRA</th>
			<th>TARİH</th>
			<th>ADET</th>
			<th>FİYAT</th>
			<th>TUTAR</th>
		</tr>
	</thead>	
	<tbody>		
		<tr>
			<td>1</td>
			<td>13.03.2025</td>
			<td><input onchange="topla1()" name="adet"  type="text" value="11"></td>
			<td><input onchange="topla1()" name="fiyat" type="text" value="251222,11"></td>
			<td><input                     name="tutar" type="text" value=""></td>
		</tr>
		<tr>
			<td>1</td>
			<td>13.03.2025</td>
			<td><input onchange="topla1()" name="adet"  type="text" value="11"></td>
			<td><input onchange="topla1()" name="fiyat" type="text" value="25444333,00"></td>
			<td><input                     name="tutar" type="text" value=""></td>
		</tr>
		<tr>
			<td>1</td>
			<td>13.03.2025</td>
			<td><input onchange="topla1()" name="adet"  type="text" value="11"></td>
			<td><input onchange="topla1()" name="fiyat" type="text" value="252525,22"></td>
			<td><input                     name="tutar" type="text" value=""></td>
		</tr>
	</tbody>	
	<tfoot>
		<tr>
			<td colspan='4' style="text-align: right;">TOPLAM</td>
			<td id="GenelToplam" style="text-align: right;"></td>
		</tr>
	</tfoot>	
</table>
    <script>
    var GenelToplam = document.getElementById('GenelToplam');	
    topla1();	
	function topla1(){
		var genTop = 0;
		var adetAll  = document.getElementsByName('adet');
		var fiyatAll = document.getElementsByName('fiyat');
		var tutarAll = document.getElementsByName('tutar');
		for (let i = 0; i < adetAll.length; i++) {
			genTop += strToFlo(adetAll[i].value) * strToFlo(fiyatAll[i].value);
			tutarAll[i].value = paraFormat(strToFlo(adetAll[i].value) * strToFlo(fiyatAll[i].value));
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
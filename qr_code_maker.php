<?php
/*
QRコードを作成するURIを構成する
*/
function make_uri($url){

	//URI用のパラメータ
	$parts = array(
		'data' => $url,
		'size' => '100x100',
		'format' => 'png'
	);

	$uri = "https://api.qrserver.com/v1/create-qr-code/?";
	$query = "";
	foreach($parts as $key => $val){
		if($query != ""){
			$query .= '&';
		}
		$query .= "$key=$val";
	}
	
	$uri .= $query;
	return $uri;
}


$urls = array();
$urls['giants'] =  rawurlencode("http://www.giants.jp/top.html");
$urls['keyaki'] = rawurlencode("https://www.amazon.co.jp/dp/B01BHPEC9G");
$urls['at_cosme'] = rawurlencode("http://www.cosme.net/product/product_id/10023860/top");

//現在日時をファイル名に使用する
$date = date("YmdHis");

foreach($urls as $key => $url){
	//作成するQRコード画像のファイル名
	$file_name = $key . "_" . $date . ".png";

	//作成するQRコードの値(url)
	$enc_url = rawurlencode($url);
	
	//QRコード作成URIを構成
	$qrcode = make_uri($url);
	
	//QRコード画像をファイルにしてダウンロード
	$qrcode = file_get_contents($qrcode);
	file_put_contents('downloads/'.$file_name,$qrcode);
}


?>

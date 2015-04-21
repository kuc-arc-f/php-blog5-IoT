<?php
//important ,timesoze=Tokyo
ini_set('date.timezone', 'Asia/Tokyo');

function httpNoCurl($url, $method, $apKey, $rKey, $postfields = null) {
	$headers = array(
	'X-Parse-Application-Id: ' . $apKey,
	'X-Parse-REST-API-Key: '   . $rKey,
	'Content-Type: application/json',
	'Content-Length: '.strlen($postfields),
	);
	$options = array('http' => array(
	    'method' => $method,
	    'content' => $postfields,
	    'header' => implode("\r\n", $headers),
	));
	$contents = file_get_contents($url, false, stream_context_create($options));
var_dump($contents);
	return $contents;
}

//------------------------------------
// @calling
// @purpose : Transfer API to Parse.com
// @date 
// @argment
// @return
//------------------------------------

$URL = 'https://api.parse.com/1/classes/SenObject1';

$nDate = date("YmjHis");
$fDate = floatval($nDate);
// var_dump($fDate) ;

if(isset($_GET["mc_id"])){
	if(isset($_GET["rkey"])){
		$nMc =intval($_GET["mc_id"]);
		$ns1 =intval($_GET["snum_1"]);
		$ns2 =intval($_GET["snum_2"]);
		$ns3 =intval($_GET["snum_3"]);
		$ns4 =intval($_GET["snum_4"]);
		
		$data= array();
		$data["mc_id"] =$nMc;
		$rKey = $_GET["rkey"];
		$apKey=$_GET["apkey"];
		$data["snum1"] = $ns1;
		$data["snum2"] = $ns2;
		$data["snum3"] = $ns3;
		$data["snum4"] = $ns4;
		$data["dtnum"] = $fDate;
// var_dump(json_encode($data));
		httpNoCurl($URL , "POST", $apKey, $rKey , json_encode($data));
	}
}else{
	echo "Argument, Error";
}
		

?>
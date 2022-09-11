<?php 
function curlurl($apiurl,$fieldsarray){
	 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$apiurl);
	curl_setopt($ch, CURLOPT_POST, 1);
	$str = http_build_query($fieldsarray);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$str);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec($ch);
	curl_close ($ch);
	return $server_output;
}
?>
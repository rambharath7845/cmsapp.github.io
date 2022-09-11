<?php 
session_start();
include "../../configure.php";
include '../../includes/session_data.php';
include 'helpers/curl.php';

$optionval=$_POST["optionval_post"];
$articleid=$_POST["articleid_post"];
$articlecmtid=$_POST["articlecmtid_post"];
$loginid=$_POST["loginid_post"];


$fieldsarray=array("optionval"=>$optionval,"articleid"=>$articleid,"articlecmtid"=>$articlecmtid,"loginid"=>$loginid);
$url=$apiurl."article.php?action=changestatus";
$article_fetch=curlurl($url,$fieldsarray);
$article_resp = json_decode($article_fetch,true);
echo json_encode($article_resp['resp']);
?>

<?php
ob_start();
session_start();
define('BASE_URL', 'http://localhost/cms/');
define('API_URL', 'http://localhost/cms_api/');
$mybase=constant("BASE_URL");
$apiurl=constant("API_URL");
date_default_timezone_set("Asia/Kolkata");
$filename = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
$today=date("Y-m-d");
$timenow=date("Y-m-d H:i:s");
// $loginid='CLT001';
// $isclient='0';
<?php
ob_start();
session_start();
include("configure.php");
if(session_destroy() AND setcookie("login_userid", "userid", time() - 360,'/') AND setcookie("login_user", "username", time() - 360,'/') AND setcookie("isclient", "0", time() - 360,'/'))
{
header("location:$mybase".''."index.php"); 
}
?>
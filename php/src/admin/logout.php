<?php
ob_start();
session_start();
include("autoload.php");
$db     =   new MySql();
$db->connect(); 
$ac="Admin Logged Out";
$inputs=array('activity'=>$ac);
$lg=new Log();
$lg->addlog($inputs);

session_destroy();
header("Location:index.php");
exit;

?>
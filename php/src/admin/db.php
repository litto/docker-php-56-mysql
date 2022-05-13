<?php
ob_start();
session_start();
include("autoload.php");
$db     =   new MySql();
$db->connect(); 
include("session.php");

?>
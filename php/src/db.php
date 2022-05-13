<?php
error_reporting(E_ALL);
ob_start();
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

include("autoload.php");

$db     =   new MySql();
$db->connect(); 

?>
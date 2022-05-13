<?php
include("db.php");
date_default_timezone_set("Asia/Dubai");
?>
<?php

$albumid=$_GET['albumid'];
$adddate=date("Y/m/d H:i:s");
$ip=$_SERVER["REMOTE_ADDR"];
$gal=new Image();

$ds          = DIRECTORY_SEPARATOR;  //1
 
$storeFolder = '../uploads';   
 
if (!empty($_FILES)) {
$ext='';
  $photonam=$_FILES['file']['name'];
  $phot=explode('.',$photonam);
  $photoname=$phot[0];
$string=$photonam;
  $parts  = explode(".",$string);
       $ext   = strtolower($parts[count($parts)-1]);
       $savename="gal".substr(md5(rand(1111,9999)),0,8).".".$ext;
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
     
    $targetFile =  $targetPath. $savename;  //5
 
    move_uploaded_file($tempFile,$targetFile); //6
$gal->addphoto($albumid,$photoname,$savename);


     
}


?>     

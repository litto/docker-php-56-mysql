<?php
ob_start();
session_start();
include("autoload.php");
if(isset($_POST["submitLogin"])){

	$txtUsername	=	trim($_POST["txtUsername"])	;		//username
	$txtPassword	=	trim($_POST["txtPassword"]);		//password
	$chkRemember	=	trim($_POST["chkRemember"]);		//store login
	
	if(empty($txtUsername) || empty($txtPassword)){
		$error	=	1;
	}else{
			if($chkRemember==1){
				/*
				 * Store login info on cookie
				*/
				$key		=	rand(1,9999).rand(111,9999);
				$crypt	= new Crypt; 
				$crypt->crypt_key($key); 										// Get encryption key
				$username = $crypt->encrypt($txtUsername);	// encrypt username
				$password = $crypt->encrypt($txtPassword);	// encrypt Password	
				setcookie("saveLogin","1");
				setcookie("loginKey",$key);
				setcookie("username",$username);
				setcookie("password",$password);			
			}else{
				setcookie("saveLogin","0");
				setcookie("loginKey","");
				setcookie("username","");
				setcookie("password","");
			}
			
			/*
			 * Login Verification 
			 * Use Auth Library for login check
			*/
			$db	=	new MySql();
			$db->connect();
			$auth	=	new Auth();
			if($auth->login(array("username"=>$txtUsername,"password"=>$txtPassword))){
				$auth->updatedate();
				$user	=	$auth->getLoggedInfo();	
				$ac="Admin Logged in";
				 $inputs=array('activity'=>$ac);
$lg=new Log();
$lg->addlog($inputs);

				$_SESSION["loggedUser"]	=	$user[0]["auth_id"];
				$_SESSION["loggedName"]	=	$user[0]["name"];
$email_from="info@uaedebtcollection.com";
$email_to='marifs@gmail.com';
$logindate=date("Y/m/d H:i:s");
$ip=$_SERVER["REMOTE_ADDR"];
$email_subject = "Admin Accessed";
$msg='Admin Logged in on '.$logindate.'  from Ip  '.$ip;

$headers = 'From: '.$email_from."\r\n".'Reply-To: '.$email_from."\r\n" .'X-Mailer: PHP/' . phpversion();

mail($email_to, $email_subject, $msg, $headers); 

				header("Location:home.php?rand=".md5(rand(0,5000)));
				exit;
			}else{
				$error=2;
			}				
	}
	header("Location:index.php?error=$error");
	exit;
	
}





?>
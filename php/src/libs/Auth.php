<?php

class Auth extends MySql{
	private $authId;
	private $username;
	private $password;
	private $passKey;
	private $email;
	private $name;
	private $dateCreated;
	/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
	/*
	 * Admin Panel authetiction Check
	*/
	function login($array){
		$this->username	=	$array["username"];
		$this->password	=	$array["password"];
		echo $query	=	"SELECT * FROM `cms_auth` WHERE `username`='".$this->addFilter($this->username)."' ";
		$rec		=	$this->fetchAll($query);
		if(count($rec)>0){
			$this->passKey	=	$rec[0]["pass_key"];
			$crypt	=	new Crypt();
			$crypt->crypt_key($this->passKey);
			$password	=	$crypt->encrypt($this->password);
			if($password==$rec[0]["password"]){
				$this->authId	=	$rec[0]["auth_id"];
				$this->email	=	$rec[0]["email"];
				$this->name		=	$rec[0]["name"];
				$this->dateCreated		=	$rec[0]["date_create"];				
				return true;
			}	
		}		
		return false;
	}
	function loginuser($array){
		$this->username	=	$array["username"];
		$this->password	=	$array["password"];
		echo $query	=	"SELECT * FROM `cms_user` WHERE `email`='".$this->addFilter($this->username)."' ";
		$rec		=	$this->fetchAll($query);


		if(count($rec)>0){
			echo "hai";

			echo $password	= $this->password;
 
$password1=base64_encode($password);
			if($password1==$rec[0]["password"]){
session_start();
				echo $_SESSION["loggedUser"]	=	$rec[0]["user_id"];
				echo $_SESSION["loggedName"]	=	$rec[0]["name"];	
		$_SESSION["email"]	=	$rec[0]["email"];
$_SESSION["password"]	=	$password;
				return true;
			}	
		}
		
		return false;
	}
function loginuserman($array){
		$this->username	=	$array["username"];
		$this->password	=	$array["password"];
		echo $query	=	"SELECT * FROM `cms_user` WHERE `email`='".$this->addFilter($this->username)."' ";
		$rec		=	$this->fetchAll($query)or die(mysql_error());
		print_r($rec);
echo "hai me";
		if(count($rec)>0){
			echo "hai";

			echo $password	= $this->password;
 
$password1=base64_encode($password);
			if($password1==$rec[0]["password"]){
echo $k=$rec[0]["user_id"];

session_start();
				echo $_SESSION["loggedUser"]	=	$rec[0]["user_id"];
				echo $_SESSION["loggedName"]	=	$rec[0]["name"];	
		echo $_SESSION["email"]	=	$rec[0]["email"];
echo $_SESSION["password"]	=	$password;
				return true;
			}	
		}
		
		return false;
	}


	       function geoCheckIP($ip)
       {
               //check, if the provided ip is valid
               if(!filter_var($ip, FILTER_VALIDATE_IP))
               {
                       throw new InvalidArgumentException("IP is not valid");
               }

               //contact ip-server
               $response=@file_get_contents('http://www.netip.de/search?query='.$ip);
               if (empty($response))
               {
                       throw new InvalidArgumentException("Error contacting Geo-IP-Server");
               }

               //Array containing all regex-patterns necessary to extract ip-geoinfo from page
               $patterns=array();
               $patterns["domain"] = '#Domain: (.*?)&nbsp;#i';
               $patterns["country"] = '#Country: (.*?)&nbsp;#i';
               $patterns["state"] = '#State/Region: (.*?)<br#i';
               $patterns["town"] = '#City: (.*?)<br#i';

               //Array where results will be stored
               $ipInfo=array();

               //check response from ipserver for above patterns
               foreach ($patterns as $key => $pattern)
               {
                       //store the result in array
                       $ipInfo[$key] = preg_match($pattern,$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
               }

               return $ipInfo;
       }


	/*
	 * Get logged admin details
	*/
	function getLoggedInfo(){
		$query	=	"SELECT * FROM  `cms_auth` LIMIT 0,1";
		return $this->fetchAll($query);
	}
	
	/*
	 * Update Account and Login information
	*/
	function updateAccount($inputs){
		$insert	=	array(	'username'=>$this->addFilter($inputs['username']),
											'password'=>$inputs['password'],
											'pass_key'=>$inputs['key'],
											'email'=>$this->addFilter($inputs['email']),
											'name'=>$this->addFilter($inputs['name']),
											'date_create'=>date("Y-m-d H:i:s"),											
											);
		$this->update($insert,"cms_auth",'');		
		return true;
	}
	
	function addlogo($image){
		$id=1;
		$insert	=	array('logo'=>$image);
		$this->update($insert,"cms_auth",'`auth_id`='.$id);		
		return true;
	}
	function updatedate(){
$regdate=date("Y/m/d H:i:s");
$logip=$_SERVER['REMOTE_ADDR'];
				$agent=$_SERVER['HTTP_USER_AGENT'];
		$id=1;
		$insert	=	array('date_create'=>$regdate,'ip'=>$logip,'browser'=>$agent);
		$this->update($insert,"cms_auth",'`auth_id`='.$id);		
		return true;
	}
	
	
	
}


?>
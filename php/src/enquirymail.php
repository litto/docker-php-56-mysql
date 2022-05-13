<?php
include("db.php");
if(isset($_POST['submit']))

{
    session_start();
    $text=$_SESSION["vercode"] ;
unset($_SESSION["vercode"]);
 $captcha        =  $_POST['txtCode'];

  if($captcha==$text)
{

$email_to1 = "info@uaedebtcollection.com";
  	
$email_to = "info@uaedebtcollection.com";
	// $email_to = "litto@proxymedia.ae";
$email_from = $_POST['user_mail'];

$subject = "Enquiry Form:UAE Debt collection.com";

$name=$_POST['user_name'];
//$obj    =   new Auth();

    $ip=$_SERVER["REMOTE_ADDR"];

//$dt=$obj->geoCheckIP($ip);
$country='';
$phone=$_POST['user_cell'];

$message=$_POST['user_message'];

$msg="Name:" .$name."\r\n"."E-mail:" .$email_from."\r\n"."Message:" .$message."\r\n"."Phone:" .$phone."\r\n"."Ip:" .$ip."\r\n"."Country:" .$country;
 $emailcontent='<table style="width: 572px; height: 199px;" border="0" cellspacing="3" cellpadding="3">
<tbody>
<tr>
<td>Dear Admin,<strong><br /></strong></td>
</tr>
<tr>
<td>Good day to You!!!</td>
</tr>
<tr>
<td>
<p>A new Enquiry has been submitted from the website.please check the information below:-</p>
</td>
</tr>
<tr>
<td><strong> Summary </strong></td>
</tr>
<tr>
<td>
<table style="width: 100%;" border="0" cellspacing="3" cellpadding="2">
<tbody>
<tr>
<td width="19%">Name</td>
<td width="2%">:</td>
<td width="79%">{name}</td>
</tr>
<tr>
<td>IP</td>
<td>:</td>
<td>{ip}</td>
</tr>
<tr>
<td>Email</td>
<td>:</td>
<td>{email}</td>
</tr>
<tr>
<td>Phone</td>
<td>:</td>
<td>{phone}</td>
</tr>
<tr>
<td>Country</td>
<td>:</td>
<td>{country}</td>
</tr>
<tr>
<td>Message</td>
<td>:</td>
<td>{message}</td>
</tr>
</tbody>
</table>
<p>With Regards,<br /><strong>Admin</strong></p>
</td>
</tr>
</tbody>
</table>';


  $finds      = array('{name}','{email}','{phone}','{ip}','{message}','{country}');
  $replace  = array($name,$email_from,$phone,$ip,$message,$country);
   $msg   = str_replace($finds,$replace,$emailcontent);  
//$headers = 'From: '.$email_from."\r\n".'Reply-To: '.$email_from."\r\n" .'X-Mailer: PHP/' . phpversion();

//mail($email_to,$email_subject,$msg,$headers); 
//mail($email_to1,$email_subject,$msg,$headers); 

//$headers = 'From: '.$email_to."\r\n".'Reply-To: '.$email_to."\r\n" .'X-Mailer: PHP/' . phpversion();

//$g=mail($email_from, $email_subject, $msg, $headers); 
	  
	  
	date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = "mail.uaedebtcollection.com";
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 465;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
$mail->SMTPSecure = true;
//Username to use for SMTP authentication
$mail->Username = "contact@uaedebtcollection.com";
//Password to use for SMTP authentication
$mail->Password = "~E!Rp?TW7,JV";
//Set who the message is to be sent from
$mail->setFrom('contact@uaedebtcollection.com', 'uaedebtcollection.com');
//Set an alternative reply-to address
$mail->addReplyTo('contact@uaedebtcollection.com', 'uaedebtcollection.com');
 $mail->CharSet = 'UTF-8';
//Set who the message is to be sent to
//Set the subject line
$mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($msg);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
$mail->addAddress($email_to, 'UAEDebtCollection:MARN');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

	header("Location:contactus.php?msg=Successfully Send");

}
else {

	header("Location:contactus.php?msg=Values mismatch");
}
}

?>
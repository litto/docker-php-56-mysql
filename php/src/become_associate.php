<?php
include("db.php");
$cont=new Contacts();
$contact=$cont->getSettings();
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]--><head>
	<!-- Basic Meta Tags -->
<meta charset="utf-8">
	  
   <?php
$cont=new Content();
$id=31;
$about=$cont->getPage($id);

?>  
  <meta charset="utf-8">
<title><?php echo $about[0]['seo_title']; ?></title>
    <meta name="title" content="<?php echo $about[0]['seo_title']; ?>">
   <meta name="description" content="<?php echo $about[0]['seo_description']; ?>">
  <meta name="keywords" content="<?php echo $about[0]['seo_keywords']; ?>">

  <meta property="og:title" content="Become an Associate - Global Debt Collection And Recovery. Corporate, Civil, Family Litigation and Legal Help.
mail us at:- info@uaedebtcollection.com">
<meta property="og:description" content="Become an Associate - Global Debt Collection And Recovery. Corporate, Civil, Family Litigation and Legal Help.
mail us at:- info@uaedebtcollection.com">
	
  <?php include("headerscript.php"); ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KDGJJBF');</script>
<!-- End Google Tag Manager -->

</head>
<?php
$current="becomepartner";
 ?>      
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KDGJJBF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  <!-- Header -->
  <header> 

 <?php include("topheader.php");  ?>

<?php include("topmenu.php"); ?>
    <!-- Nav End -->
    
  </header>
  <!-- Header End -->
<?php
if(isset($_POST['submit']))

{


    session_start();
    $text=$_SESSION["vercode"] ;
unset($_SESSION["vercode"]);
 $captcha        =  $_POST['txtCode'];

  if($captcha==$text)
{

$name=$_POST['name'];
$mail=$_POST['mail'];
$cell=$_POST['cell'];
$comments=$_POST['comments'];

if($name==''|| $mail==''){
header("Location:become_associate.php?msg=Enter mandatory Fields");
}else{


              $absDirName =   dirname(__FILE__).'/uploads';
              $relDirName =   '../uploads';
              $uploader   =   new Uploader($absDirName.'/');
              $uploader->setExtensions(array('pdf','xls','doc','docx','xlsx'));
             $uploader->setSequence('associate');
             $uploader->setMaxSize(5);

            if($uploader->uploadFile("txtFile")){
      
                $image      =   $uploader->getUploadName(); 
      
            }else{

              $image='';
            }

$par=new Partners();
$insert=array('name'=>$name,'email'=>$mail,'mobile'=>$cell,'comment'=>$comments,'doc'=>$image,'type'=>'0','status'=>'0');
$par->addrecord($insert);



    $ip=$_SERVER["REMOTE_ADDR"];

$email_to = "info@uaedebtcollection.com";
 //$email_to="litto@proxymedia.ae";   
$email_from = $mail;

$subject = "Become an Associate: UAE Debt Collection";



$emailcontent='<table style="width: 572px; height: 199px;" border="0" cellspacing="3" cellpadding="3">
<tbody>
<tr>
<td>Dear Admin,<strong><br /></strong></td>
</tr>
<tr>
<td>Welcome!!!</td>
</tr>
<tr>
<td>
<p>An Associate Request has been submitted in Uaedebtcollection.com with below details. Please Check:-</p>
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
<td>Email</td>
<td>:</td>
<td>{mail}</td>
</tr>
<tr>
<td>Cell</td>
<td>:</td>
<td>{cell}</td>
</tr>
<tr>
<td>Comments</td>
<td>:</td>
<td>{comments}</td>
</tr>
</tbody>
</table>
<p>With Regards,<br /><strong>UaeDebtcollection</strong></p>
</td>
</tr>
</tbody>
</table>';

  $finds      = array('{name}','{mail}','{cell}','{comments}');
  $replace  = array($name,$mail,$cell,$comments);
    $msg   = str_replace($finds,$replace,$emailcontent);   





//$headers = 'From: '.$email_from."\r\n".'Reply-To: '.$email_from."\r\n" .'X-Mailer: PHP/' . phpversion();

//mail($email_to, $email_subject, $msg, $headers);

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
//Set who the message is to be sent to
//Set the subject line
$mail->Subject = $subject;
	$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($msg);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
$mail->addAddress($email_to, 'Uaedebtcollection:MARN');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
	
	
	
//$headers = 'From: '.$email_to."\r\n".'Reply-To: '.$email_to."\r\n" .'X-Mailer: PHP/' . phpversion();

//mail($email_from, $email_subject, $msg, $headers); 

header("Location:become_associate.php?msg=Successfuly registered for a Associate!!");
exit;
}

}
else {

    header("Location:become_associate.php?msg=Values mismatch");
    exit;
}
}

    ?>               
  <!-- Content -->    
  <div class="breadcrumb-container">
    <div class="container">  
      <div class="row">  
        <div class="col-md-12">
          <h1>Become an Associate</h1>
          <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">Become an Associate</li>
          </ol>
        </div>  
      </div> 
    </div> 
  </div>

  <div class="space20"></div>
  
  <div class="container">
    <div class="row">
 <div class="row">
                    <div class="col-md-12">

<span style="color:red;"><?php
if(isset($_GET['msg'])){
    echo $_GET['msg'];
}

?></span>
                    </div></div>

                <div class="row">
                    <div class="col-md-12">
                                      <form class="form-light mt-20" role="form" action="become_associate.php" method="post" enctype="multipart/form-data">
                                      <h4>Become an Associate and become a business  partner</h4>
                                      <p> If you want to be a associate with us, here is the opportunity you can grasp asap.  Join today and our respresentatives will contact you.   </p>
   <div class="row"> <div class="col-md-4">
                            <div class="form-group">
                                <label>Name<span style="color:red">*</span></label>
                                <input type="text" class="form-control" placeholder="Your name" name="name" value="<?php echo $_POST['name']; ?>">
                            </div>
</div>

 <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email<span style="color:red">*</span></label>
                                        <input type="email" class="form-control" placeholder="Email address" name="mail" value="<?php echo $_POST['mail']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="number" class="form-control" placeholder="Phone number" name="cell" value="<?php echo $_POST['cell']; ?>">
                                    </div>
                                </div>


                             </div>


                           



                   
                            <div class="form-group">
                                <label>Other Comments</label>
                                <textarea class="form-control" placeholder="Write you comments here..." style="height:100px;"  name="comments" value="<?php echo $_POST['comments']; ?>"></textarea>
                            </div>

                            <div class="row">

                              <div class="col-md-4"><label>Upload Doc</label> <input type="file" class="browse" id="files" name="txtFile" /></div>                             
<div class="col-md-1">
      <label>Captcha</label>
                                 <img src="captcha.php" alt="captcha" title="captcha" class="captcha">

</div>

<div class="col-md-3">
 <div class="form-group">
         <label>Enter Code</label>
                                <input type="text" class="form-control" placeholder="Enter Code" name="txtCode">
                                    </div>

</div>

   </div></br>

    <div class="row">
<div class="col-md-3">
 <button type="submit"  name="submit" class="btn btn-two">Submit</button>
</div>

    </div>
             
                           
                        </form>
                    </div>
                  
    </div>
  </div>       
  

  
  <div class="space20"></div></div>
  


           
  <?php include("footer.php");  ?>
  <a href="#" class="back-to-top"><span></span></a> 

<?php include("footerscripts.php"); ?>
       
</body>
</html>
         
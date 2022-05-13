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
$id=29;
$about=$cont->getPage($id);

?>  
  <meta charset="utf-8">
<title><?php echo $about[0]['seo_title']; ?></title>
    <meta name="title" content="<?php echo $about[0]['seo_title']; ?>">
   <meta name="description" content="<?php echo $about[0]['seo_description']; ?>">
  <meta name="keywords" content="<?php echo $about[0]['seo_keywords']; ?>">
	
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
$current="claim-submission";
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
$designation=$_POST['designation'];
$nationality=$_POST['nationality'];
$organization=$_POST['organization'];
$mail=$_POST['mail'];
$cell=$_POST['cell'];
$location=$_POST['location'];
$postaladdress=$_POST['postaladdress'];
$fax=$_POST['fax'];
$phone=$_POST['phone'];
$service_type=$_POST['service_type'];
$additional_info=$_POST['additional_info'];
$debtor_name=$_POST['debtor_name'];
$debtor_designation=$_POST['debtor_designation'];
$debtor_nationality=$_POST['debtor_nationality'];
$debtor_organization=$_POST['debtor_organization'];
$debtor_mail=$_POST['debtor_mail'];
$debtor_cell=$_POST['debtor_cell'];
$debtor_location=$_POST['debtor_location'];
$debtor_postaladdress=$_POST['debtor_postaladdress'];
$debtor_fax=$_POST['debtor_fax'];
$debtor_phone=$_POST['debtor_phone'];
$debtor_dueamount=$_POST['debtor_dueamount'];
$debtor_currrency=$_POST['debtor_currrency'];
if(isset($_POST['checkreturn'])){
$checkreturn=$_POST['checkreturn'];
}else{
   $checkreturn=0; 
}

if(isset($_POST['inability'])){
$inability=$_POST['inability'];
}else{
   $inability=0; 
}
if(isset($_POST['mailreturn'])){
$mailreturn=$_POST['mailreturn'];
}else{
   $mailreturn=0; 
}

if(isset($_POST['phonedisconnect'])){
$phonedisconnect=$_POST['phonedisconnect'];
}else{
   $phonedisconnect=0; 
}

if(isset($_POST['others'])){
$others=$_POST['others'];
}else{
   $others=0; 
}

$other_reason=$_POST['other_reason'];
$debtor_date_indebt=$_POST['debtor_date_indebt'];
$comments=$_POST['comments'];

if($name==''|| $mail==''  || $debtor_name==''){
header("Location:claim-submission.php?msg=Enter mandatory Fields");
}else{
    $ip=$_SERVER["REMOTE_ADDR"];


$insert=array('name'=>$name,'designation'=>$designation,'nationality'=>$nationality,'organization'=>$organization,'mail'=>$mail,'cell'=>$cell,'location'=>$location,'postaladdress'=>$postaladdress,'fax'=>$fax,'phone'=>$phone,'service_type'=>$service_type,'additional_info'=>$additional_info,'debtor_name'=>$debtor_name,'debtor_designation'=>$debtor_designation,'debtor_nationality'=>$debtor_nationality,'debtor_organization'=>$debtor_organization,'debtor_mail'=>$debtor_mail,'debtor_cell'=>$debtor_cell,'debtor_location'=>$debtor_location,'debtor_postaladdress'=>$debtor_postaladdress,'debtor_fax'=>$debtor_fax,'debtor_phone'=>$debtor_phone,'debtor_dueamount'=>$debtor_dueamount,'debtor_currrency'=>$debtor_currrency,'checkreturn'=>$checkreturn,'inability'=>$inability,'mailreturn'=>$mailreturn,'phonedisconnect'=>$phonedisconnect,'others'=>$others,'other_reason'=>$other_reason,'debtor_date_indebt'=>$debtor_date_indebt,'comments'=>$comments,'ip'=>$ip);

$dt=new Debt();
$dt->addrecord($insert);
$lastid=$dt->lastInsertId();


        $absDirName =   dirname(__FILE__).'/uploads';
              $relDirName =   '../uploads';
              $uploader   =   new Uploader($absDirName.'/');
              $uploader->setExtensions(array('jpg','jpeg','png','gif','swf','pdf','xls','doc','docx','xlsx'));
             $uploader->setSequence('debtdoc');
             $uploader->setMaxSize(5);
 for($i=0;$i<count($_FILES['files']);$i++){
$name=$_FILES['files']['name'][$i];
 $size=$_FILES['files']['size'][$i];
$tmpname=$_FILES['files']['tmp_name'][$i];
if($uploader->uploadmultiFile($name,$size,$tmpname)){
 
$image      =   $uploader->getUploadName(); 
$nm="Imagename";
$dt->addimage($lastid,$image);
 }


}
$name=$_POST['name'];
$email_to = "info@uaedebtcollection.com";
 //$email_to="litto@proxymedia.ae";   
$email_from = $mail;

$subject = "Claim Submission Form";

$msg="Name:" .$name."\r\n"."Designation:" .$designation."\r\n"."Nationality:" .$nationality."\r\n"."Organization:" .$organization."\r\n"."Email:" .$mail."\r\n"."Cell:" .$cell."\r\n";
$msg.="Location:" .$location."\r\n"."Postaladdress:" .$postaladdress."\r\n"."Fax:" .$fax."\r\n"."Phone:" .$phone."\r\n"."Service Type:" .$service_type."\r\n"."Additional info:" .$additional_info."\r\n";
$msg.="Debtor_name:" .$debtor_name."\r\n"."Debtor designation:" .$debtor_designation."\r\n"."Debtor nationality:" .$debtor_nationality."\r\n"."Debtor Organization:" .$debtor_organization."\r\n"."Debtor mail:" .$debtor_mail."\r\n"."Debtor cell:" .$debtor_cell."\r\n";
$msg.="Debtor Location:" .$debtor_location."\r\n"."Debtorpostaladdress:" .$debtor_postaladdress."\r\n"."Debtor fax:" .$debtor_fax."\r\n"."Debtor phone:" .$debtor_phone."\r\n"."Debtor dueamount:" .$debtor_dueamount."\r\n"."Debtor currrency:" .$debtor_currrency."\r\n";
$msg.="Debtor date indebt:" .$debtor_date_indebt."\r\n"."Comments:" .$comments."\r\n";


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
<p>A Claim has been submitted in Uaedebtcollection.com with below details. Please Check:-</p>
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
<td>Designation</td>
<td>:</td>
<td>{designation}</td>
</tr>
<tr>
<td>Nationality</td>
<td>:</td>
<td>{nationality}</td>
</tr>
<tr>
<td>Organization</td>
<td>:</td>
<td>{organization}</td>
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
<td>Location</td>
<td>:</td>
<td>{location}</td>
</tr>
<tr>
<td>Postaladdress</td>
<td>:</td>
<td>{postaladdress}</td>
</tr>
<tr>
<td>Fax</td>
<td>:</td>
<td>{fax}</td>
</tr>
<tr>
<td>Service Type</td>
<td>:</td>
<td>{service_type}</td>
</tr>
<tr>
<td>Phone</td>
<td>:</td>
<td>{phone}</td>
</tr>
<tr>
<td>Additional Info</td>
<td>:</td>
<td>{additional_info}</td>
</tr>

<tr>
<td>Debtor name</td>
<td>:</td>
<td>{debtor_name}</td>
</tr>
<tr>
<td>Debtor designation</td>
<td>:</td>
<td>{debtor_designation}</td>
</tr>
<tr>
<td>Debtor_nationality</td>
<td>:</td>
<td>{debtor_nationality}</td>
</tr>
<tr>
<td>Debtor_organization</td>
<td>:</td>
<td>{debtor_organization}</td>
</tr>
<tr>
<td>Debtor Mail</td>
<td>:</td>
<td>{debtor_mail}</td>
</tr>
<tr>
<td>Debtor Cell</td>
<td>:</td>
<td>{debtor_cell}</td>
</tr>
<tr>
<td>Debtor_location</td>
<td>:</td>
<td>{debtor_location}</td>
</tr>
<tr>
<td>Debtor_postaladdress</td>
<td>:</td>
<td>{debtor_postaladdress}</td>
</tr>
<tr>
<td>Debtor_fax</td>
<td>:</td>
<td>{debtor_fax}</td>
</tr>
<tr>
<td>Debtor_phone</td>
<td>:</td>
<td>{debtor_phone}</td>
</tr>
<tr>
<td>Debtor_dueamount</td>
<td>:</td>
<td>{debtor_dueamount} {debtor_currrency}</td>
</tr>
<tr>
<td>Debtor_date_indebt</td>
<td>:</td>
<td>{debtor_date_indebt}</td>
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

  $finds      = array('{name}','{designation}','{nationality}','{organization}','{mail}','{cell}','{location}','{postaladdress}','{fax}','{phone}','{service_type}','{additional_info}','{debtor_name}','{debtor_designation}','{debtor_nationality}','{debtor_organization}','{debtor_mail}','{debtor_cell}','{debtor_location}','{debtor_postaladdress}','{debtor_fax}','{debtor_phone}','{debtor_dueamount}','{debtor_currrency}','{debtor_date_indebt}','{comments}');
  $replace  = array($name,$designation,$nationality,$organization,$mail,$cell,$location,$postaladdress,$fax,$phone,$service_type,$additional_info,$debtor_name,$debtor_designation,$debtor_nationality,$debtor_organization,$debtor_mail,$debtor_cell,$debtor_location,$debtor_postaladdress,$debtor_fax,$debtor_phone,$debtor_dueamount,$debtor_currrency,$debtor_date_indebt,$comments);
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

header("Location:claim-submission.php?msg=Details Posted Successfully");
}

}
else {

    header("Location:claim-submission.php?msg=Values mismatch");
}
}

    ?>               
  <!-- Content -->    
  <div class="breadcrumb-container">
    <div class="container">  
      <div class="row">  
        <div class="col-md-12">
          <h1>Submit Your Claim</h1>
          <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">Submit Your Claim</li>
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
                                      <form class="form-light mt-20" role="form" action="claim-submission.php" method="post" enctype="multipart/form-data">
                                      <h4>Information about Yourself</h4>
   <div class="row"> <div class="col-md-4">
                            <div class="form-group">
                                <label>Name<span style="color:red">*</span></label>
                                <input type="text" class="form-control" placeholder="Your name" name="name" value="<?php echo $_POST['name']; ?>">
                            </div>
</div>

<div class="col-md-4">
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" placeholder="Your Designation" name="designation" value="<?php echo $_POST['designation']; ?>">
                            </div>
</div>

<div class="col-md-4">
                            <div class="form-group">
                                <label>Nationality</label>

                                <select class="form-control" name="nationality">
                                 <option value="" >Select Country</option>

    <option value="Afghanistan" title="Afghanistan">Afghanistan</option>
    <option value="Åland Islands" title="Åland Islands">Åland Islands</option>
    <option value="Albania" title="Albania">Albania</option>
    <option value="Algeria" title="Algeria">Algeria</option>
    <option value="American Samoa" title="American Samoa">American Samoa</option>
    <option value="Andorra" title="Andorra">Andorra</option>
    <option value="Angola" title="Angola">Angola</option>
    <option value="Anguilla" title="Anguilla">Anguilla</option>
    <option value="Antarctica" title="Antarctica">Antarctica</option>
    <option value="Antigua and Barbuda" title="Antigua and Barbuda">Antigua and Barbuda</option>
    <option value="Argentina" title="Argentina">Argentina</option>
    <option value="Armenia" title="Armenia">Armenia</option>
    <option value="Aruba" title="Aruba">Aruba</option>
    <option value="Australia" title="Australia">Australia</option>
    <option value="Austria" title="Austria">Austria</option>
    <option value="Azerbaijan" title="Azerbaijan">Azerbaijan</option>
    <option value="Bahamas" title="Bahamas">Bahamas</option>
    <option value="Bahrain" title="Bahrain">Bahrain</option>
    <option value="Bangladesh" title="Bangladesh">Bangladesh</option>
    <option value="Barbados" title="Barbados">Barbados</option>
    <option value="Belarus" title="Belarus">Belarus</option>
    <option value="Belgium" title="Belgium">Belgium</option>
    <option value="Belize" title="Belize">Belize</option>
    <option value="Benin" title="Benin">Benin</option>
    <option value="Bermuda" title="Bermuda">Bermuda</option>
    <option value="Bhutan" title="Bhutan">Bhutan</option>
    <option value="Bolivia, Plurinational State of" title="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
    <option value="Bonaire, Sint Eustatius and Saba" title="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
    <option value="Bosnia and Herzegovina" title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
    <option value="Botswana" title="Botswana">Botswana</option>
    <option value="Bouvet Island" title="Bouvet Island">Bouvet Island</option>
    <option value="Brazil" title="Brazil">Brazil</option>
    <option value="British Indian Ocean Territory" title="British Indian Ocean Territory">British Indian Ocean Territory</option>
    <option value="Brunei Darussalam" title="Brunei Darussalam">Brunei Darussalam</option>
    <option value="Bulgaria" title="Bulgaria">Bulgaria</option>
    <option value="Burkina Faso" title="Burkina Faso">Burkina Faso</option>
    <option value="Burundi" title="Burundi">Burundi</option>
    <option value="Cambodia" title="Cambodia">Cambodia</option>
    <option value="Cameroon" title="Cameroon">Cameroon</option>
    <option value="Canada" title="Canada">Canada</option>
    <option value="Cape Verde" title="Cape Verde">Cape Verde</option>
    <option value="Cayman Islands" title="Cayman Islands">Cayman Islands</option>
    <option value="Central African Republic" title="Central African Republic">Central African Republic</option>
    <option value="Chad" title="Chad">Chad</option>
    <option value="Chile" title="Chile">Chile</option>
    <option value="China" title="China">China</option>
    <option value="Christmas Island" title="Christmas Island">Christmas Island</option>
    <option value="Cocos (Keeling) Islands" title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
    <option value="Colombia" title="Colombia">Colombia</option>
    <option value="Comoros" title="Comoros">Comoros</option>
    <option value="Congo" title="Congo">Congo</option>
    <option value="Congo, the Democratic Republic of the" title="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
    <option value="Cook Islands" title="Cook Islands">Cook Islands</option>
    <option value="Costa Rica" title="Costa Rica">Costa Rica</option>
    <option value="Côte d'Ivoire" title="Côte d'Ivoire">Côte d'Ivoire</option>
    <option value="Croatia" title="Croatia">Croatia</option>
    <option value="Cuba" title="Cuba">Cuba</option>
    <option value="Curaçao" title="Curaçao">Curaçao</option>
    <option value="Cyprus" title="Cyprus">Cyprus</option>
    <option value="Czech Republic" title="Czech Republic">Czech Republic</option>
    <option value="Denmark" title="Denmark">Denmark</option>
    <option value="Djibouti" title="Djibouti">Djibouti</option>
    <option value="Dominica" title="Dominica">Dominica</option>
    <option value="Dominican Republic" title="Dominican Republic">Dominican Republic</option>
    <option value="Ecuador" title="Ecuador">Ecuador</option>
    <option value="Egypt" title="Egypt">Egypt</option>
    <option value="El Salvador" title="El Salvador">El Salvador</option>
    <option value="Equatorial Guinea" title="Equatorial Guinea">Equatorial Guinea</option>
    <option value="Eritrea" title="Eritrea">Eritrea</option>
    <option value="Estonia" title="Estonia">Estonia</option>
    <option value="Ethiopia" title="Ethiopia">Ethiopia</option>
    <option value="Falkland Islands (Malvinas)" title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
    <option value="Faroe Islands" title="Faroe Islands">Faroe Islands</option>
    <option value="Fiji" title="Fiji">Fiji</option>
    <option value="Finland" title="Finland">Finland</option>
    <option value="France" title="France">France</option>
    <option value="French Guiana" title="French Guiana">French Guiana</option>
    <option value="French Polynesia" title="French Polynesia">French Polynesia</option>
    <option value="French Southern Territories" title="French Southern Territories">French Southern Territories</option>
    <option value="Gabon" title="Gabon">Gabon</option>
    <option value="Gambia" title="Gambia">Gambia</option>
    <option value="Georgia" title="Georgia">Georgia</option>
    <option value="Germany" title="Germany">Germany</option>
    <option value="Ghana" title="Ghana">Ghana</option>
    <option value="Gibraltar" title="Gibraltar">Gibraltar</option>
    <option value="Greece" title="Greece">Greece</option>
    <option value="Greenland" title="Greenland">Greenland</option>
    <option value="Grenada" title="Grenada">Grenada</option>
    <option value="Guadeloupe" title="Guadeloupe">Guadeloupe</option>
    <option value="Guam" title="Guam">Guam</option>
    <option value="Guatemala" title="Guatemala">Guatemala</option>
    <option value="Guernsey" title="Guernsey">Guernsey</option>
    <option value="Guinea" title="Guinea">Guinea</option>
    <option value="Guinea-Bissau" title="Guinea-Bissau">Guinea-Bissau</option>
    <option value="Guyana" title="Guyana">Guyana</option>
    <option value="Haiti" title="Haiti">Haiti</option>
    <option value="Heard Island and McDonald Islands" title="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
    <option value="Holy See (Vatican City State)" title="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
    <option value="Honduras" title="Honduras">Honduras</option>
    <option value="Hong Kong" title="Hong Kong">Hong Kong</option>
    <option value="Hungary" title="Hungary">Hungary</option>
    <option value="Iceland" title="Iceland">Iceland</option>
    <option value="India" title="India">India</option>
    <option value="Indonesia" title="Indonesia">Indonesia</option>
    <option value="Iran, Islamic Republic of" title="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
    <option value="Iraq" title="Iraq">Iraq</option>
    <option value="Ireland" title="Ireland">Ireland</option>
    <option value="Isle of Man" title="Isle of Man">Isle of Man</option>
    <option value="Israel" title="Israel">Israel</option>
    <option value="Italy" title="Italy">Italy</option>
    <option value="Jamaica" title="Jamaica">Jamaica</option>
    <option value="Japan" title="Japan">Japan</option>
    <option value="Jersey" title="Jersey">Jersey</option>
    <option value="Jordan" title="Jordan">Jordan</option>
    <option value="Kazakhstan" title="Kazakhstan">Kazakhstan</option>
    <option value="Kenya" title="Kenya">Kenya</option>
    <option value="Kiribati" title="Kiribati">Kiribati</option>
    <option value="Korea, Democratic People's Republic of" title="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
    <option value="Korea, Republic of" title="Korea, Republic of">Korea, Republic of</option>
    <option value="Kuwait" title="Kuwait">Kuwait</option>
    <option value="Kyrgyzstan" title="Kyrgyzstan">Kyrgyzstan</option>
    <option value="Lao People's Democratic Republic" title="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
    <option value="Latvia" title="Latvia">Latvia</option>
    <option value="Lebanon" title="Lebanon">Lebanon</option>
    <option value="Lesotho" title="Lesotho">Lesotho</option>
    <option value="Liberia" title="Liberia">Liberia</option>
    <option value="Libya" title="Libya">Libya</option>
    <option value="Liechtenstein" title="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania" title="Lithuania">Lithuania</option>
    <option value="Luxembourg" title="Luxembourg">Luxembourg</option>
    <option value="Macao" title="Macao">Macao</option>
    <option value="Macedonia, the former Yugoslav Republic of" title="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
    <option value="Madagascar" title="Madagascar">Madagascar</option>
    <option value="Malawi" title="Malawi">Malawi</option>
    <option value="Malaysia" title="Malaysia">Malaysia</option>
    <option value="Maldives" title="Maldives">Maldives</option>
    <option value="Mali" title="Mali">Mali</option>
    <option value="Malta" title="Malta">Malta</option>
    <option value="Marshall Islands" title="Marshall Islands">Marshall Islands</option>
    <option value="Martinique" title="Martinique">Martinique</option>
    <option value="Mauritania" title="Mauritania">Mauritania</option>
    <option value="Mauritius" title="Mauritius">Mauritius</option>
    <option value="Mayotte" title="Mayotte">Mayotte</option>
    <option value="Mexico" title="Mexico">Mexico</option>
    <option value="Micronesia, Federated States of" title="Micronesia, Federated States of">Micronesia, Federated States of</option>
    <option value="Moldova, Republic of" title="Moldova, Republic of">Moldova, Republic of</option>
    <option value="Monaco" title="Monaco">Monaco</option>
    <option value="Mongolia" title="Mongolia">Mongolia</option>
    <option value="Montenegro" title="Montenegro">Montenegro</option>
    <option value="Montserrat" title="Montserrat">Montserrat</option>
    <option value="Morocco" title="Morocco">Morocco</option>
    <option value="Mozambique" title="Mozambique">Mozambique</option>
    <option value="Myanmar" title="Myanmar">Myanmar</option>
    <option value="Namibia" title="Namibia">Namibia</option>
    <option value="Nauru" title="Nauru">Nauru</option>
    <option value="Nepal" title="Nepal">Nepal</option>
    <option value="Netherlands" title="Netherlands">Netherlands</option>
    <option value="New Caledonia" title="New Caledonia">New Caledonia</option>
    <option value="New Zealand" title="New Zealand">New Zealand</option>
    <option value="Nicaragua" title="Nicaragua">Nicaragua</option>
    <option value="Niger" title="Niger">Niger</option>
    <option value="Nigeria" title="Nigeria">Nigeria</option>
    <option value="Niue" title="Niue">Niue</option>
    <option value="Norfolk Island" title="Norfolk Island">Norfolk Island</option>
    <option value="Northern Mariana Islands" title="Northern Mariana Islands">Northern Mariana Islands</option>
    <option value="Norway" title="Norway">Norway</option>
    <option value="Oman" title="Oman">Oman</option>
    <option value="Pakistan" title="Pakistan">Pakistan</option>
    <option value="Palau" title="Palau">Palau</option>
    <option value="Palestinian Territory, Occupied" title="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
    <option value="Panama" title="Panama">Panama</option>
    <option value="Papua New Guinea" title="Papua New Guinea">Papua New Guinea</option>
    <option value="Paraguay" title="Paraguay">Paraguay</option>
    <option value="Peru" title="Peru">Peru</option>
    <option value="Philippines" title="Philippines">Philippines</option>
    <option value="Pitcairn" title="Pitcairn">Pitcairn</option>
    <option value="Poland" title="Poland">Poland</option>
    <option value="Portugal" title="Portugal">Portugal</option>
    <option value="Puerto Rico" title="Puerto Rico">Puerto Rico</option>
    <option value="Qatar" title="Qatar">Qatar</option>
    <option value="Réunion" title="Réunion">Réunion</option>
    <option value="Romania" title="Romania">Romania</option>
    <option value="Russian Federation" title="Russian Federation">Russian Federation</option>
    <option value="Rwanda" title="Rwanda">Rwanda</option>
    <option value="Saint Barthélemy" title="Saint Barthélemy">Saint Barthélemy</option>
    <option value="Saint Helena, Ascension and Tristan da Cunha" title="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
    <option value="Saint Kitts and Nevis" title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
    <option value="Saint Lucia" title="Saint Lucia">Saint Lucia</option>
    <option value="Saint Martin (French part)" title="Saint Martin (French part)">Saint Martin (French part)</option>
    <option value="Saint Pierre and Miquelon" title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
    <option value="Saint Vincent and the Grenadines" title="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
    <option value="Samoa" title="Samoa">Samoa</option>
    <option value="San Marino" title="San Marino">San Marino</option>
    <option value="Sao Tome and Principe" title="Sao Tome and Principe">Sao Tome and Principe</option>
    <option value="Saudi Arabia" title="Saudi Arabia">Saudi Arabia</option>
    <option value="Senegal" title="Senegal">Senegal</option>
    <option value="Serbia" title="Serbia">Serbia</option>
    <option value="Seychelles" title="Seychelles">Seychelles</option>
    <option value="Sierra Leone" title="Sierra Leone">Sierra Leone</option>
    <option value="Singapore" title="Singapore">Singapore</option>
    <option value="Sint Maarten (Dutch part)" title="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
    <option value="Slovakia" title="Slovakia">Slovakia</option>
    <option value="Slovenia" title="Slovenia">Slovenia</option>
    <option value="Solomon Islands" title="Solomon Islands">Solomon Islands</option>
    <option value="Somalia" title="Somalia">Somalia</option>
    <option value="South Africa" title="South Africa">South Africa</option>
    <option value="South Georgia and the South Sandwich Islands" title="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
    <option value="South Sudan" title="South Sudan">South Sudan</option>
    <option value="Spain" title="Spain">Spain</option>
    <option value="Sri Lanka" title="Sri Lanka">Sri Lanka</option>
    <option value="Sudan" title="Sudan">Sudan</option>
    <option value="Suriname" title="Suriname">Suriname</option>
    <option value="Svalbard and Jan Mayen" title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
    <option value="Swaziland" title="Swaziland">Swaziland</option>
    <option value="Sweden" title="Sweden">Sweden</option>
    <option value="Switzerland" title="Switzerland">Switzerland</option>
    <option value="Syrian Arab Republic" title="Syrian Arab Republic">Syrian Arab Republic</option>
    <option value="Taiwan, Province of China" title="Taiwan, Province of China">Taiwan, Province of China</option>
    <option value="Tajikistan" title="Tajikistan">Tajikistan</option>
    <option value="Tanzania, United Republic of" title="Tanzania, United Republic of">Tanzania, United Republic of</option>
    <option value="Thailand" title="Thailand">Thailand</option>
    <option value="Timor-Leste" title="Timor-Leste">Timor-Leste</option>
    <option value="Togo" title="Togo">Togo</option>
    <option value="Tokelau" title="Tokelau">Tokelau</option>
    <option value="Tonga" title="Tonga">Tonga</option>
    <option value="Trinidad and Tobago" title="Trinidad and Tobago">Trinidad and Tobago</option>
    <option value="Tunisia" title="Tunisia">Tunisia</option>
    <option value="Turkey" title="Turkey">Turkey</option>
    <option value="Turkmenistan" title="Turkmenistan">Turkmenistan</option>
    <option value="Turks and Caicos Islands" title="Turks and Caicos Islands">Turks and Caicos Islands</option>
    <option value="Tuvalu" title="Tuvalu">Tuvalu</option>
    <option value="Uganda" title="Uganda">Uganda</option>
    <option value="Ukraine" title="Ukraine">Ukraine</option>
    <option value="United Arab Emirates" title="United Arab Emirates">United Arab Emirates</option>
    <option value="United Kingdom" title="United Kingdom">United Kingdom</option>
    <option value="United States" title="United States">United States</option>
    <option value="United States Minor Outlying Islands" title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
    <option value="Uruguay" title="Uruguay">Uruguay</option>
    <option value="Uzbekistan" title="Uzbekistan">Uzbekistan</option>
    <option value="Vanuatu" title="Vanuatu">Vanuatu</option>
    <option value="Venezuela, Bolivarian Republic of" title="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
    <option value="Viet Nam" title="Viet Nam">Viet Nam</option>
    <option value="Virgin Islands, British" title="Virgin Islands, British">Virgin Islands, British</option>
    <option value="Virgin Islands, U.S." title="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
    <option value="Wallis and Futuna" title="Wallis and Futuna">Wallis and Futuna</option>
    <option value="Western Sahara" title="Western Sahara">Western Sahara</option>
    <option value="Yemen" title="Yemen">Yemen</option>
    <option value="Zambia" title="Zambia">Zambia</option>
    <option value="Zimbabwe" title="Zimbabwe">Zimbabwe</option>
</select>

                            </div>
</div>

                             </div>


                            <div class="row">
                            <div class="col-md-4">
                            <div class="form-group">
                                <label>Organization</label>
                                <input type="text" class="form-control" placeholder="Your Organization" name="organization" value="<?php echo $_POST['organization']; ?>">
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

                            <div class="row">
                            <div class="col-md-4">
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" class="form-control" placeholder="Your Location" name="location" value="<?php echo $_POST['location']; ?>">
                            </div>
</div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Postal Address</label>
                                        <input type="text" class="form-control" placeholder="Postal address" name="postaladdress" value="<?php echo $_POST['postaladdress']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fax</label>
                                        <input type="text" class="form-control" placeholder="Fax" name="fax" value="<?php echo $_POST['fax']; ?>">
                                    </div>
                                </div>
                            </div>


                                                        <div class="row">
                            <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="number" class="form-control" placeholder="Your Phone" name="phone" value="<?php echo $_POST['phone']; ?>">
                            </div>
</div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Type of service</label>
                                       <textarea class="form-control" placeholder="Type of service" style="height:100px;"  name="service_type" value="<?php echo $_POST['service_type']; ?>"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Additional Informtion</label>
                                       <textarea class="form-control" placeholder="Additional Information" style="height:100px;"  name="additional_info" value="<?php echo $_POST['additional_info']; ?>"></textarea>
                                    </div>
                                </div>
                            </div>



                               <h4>Information about Your Debtor</h4>
   <div class="row"> <div class="col-md-4">
                            <div class="form-group">
                                <label>Debtor Name<span style="color:red">*</span></label>
                                <input type="text" class="form-control" placeholder="Debtors name" name="debtor_name" value="<?php echo $_POST['debtor_name']; ?>">
                            </div>
</div>

<div class="col-md-4">
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" placeholder="Debtors Designation" name="debtor_designation" value="<?php echo $_POST['debtor_designation']; ?>">
                            </div>
</div>

<div class="col-md-4">
                            <div class="form-group">
                                <label>Nationality</label>
                                <select class="form-control" name="debtor_nationality">
                                    <option value="" >Select Country</option>

    <option value="Afghanistan" title="Afghanistan">Afghanistan</option>
    <option value="Åland Islands" title="Åland Islands">Åland Islands</option>
    <option value="Albania" title="Albania">Albania</option>
    <option value="Algeria" title="Algeria">Algeria</option>
    <option value="American Samoa" title="American Samoa">American Samoa</option>
    <option value="Andorra" title="Andorra">Andorra</option>
    <option value="Angola" title="Angola">Angola</option>
    <option value="Anguilla" title="Anguilla">Anguilla</option>
    <option value="Antarctica" title="Antarctica">Antarctica</option>
    <option value="Antigua and Barbuda" title="Antigua and Barbuda">Antigua and Barbuda</option>
    <option value="Argentina" title="Argentina">Argentina</option>
    <option value="Armenia" title="Armenia">Armenia</option>
    <option value="Aruba" title="Aruba">Aruba</option>
    <option value="Australia" title="Australia">Australia</option>
    <option value="Austria" title="Austria">Austria</option>
    <option value="Azerbaijan" title="Azerbaijan">Azerbaijan</option>
    <option value="Bahamas" title="Bahamas">Bahamas</option>
    <option value="Bahrain" title="Bahrain">Bahrain</option>
    <option value="Bangladesh" title="Bangladesh">Bangladesh</option>
    <option value="Barbados" title="Barbados">Barbados</option>
    <option value="Belarus" title="Belarus">Belarus</option>
    <option value="Belgium" title="Belgium">Belgium</option>
    <option value="Belize" title="Belize">Belize</option>
    <option value="Benin" title="Benin">Benin</option>
    <option value="Bermuda" title="Bermuda">Bermuda</option>
    <option value="Bhutan" title="Bhutan">Bhutan</option>
    <option value="Bolivia, Plurinational State of" title="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
    <option value="Bonaire, Sint Eustatius and Saba" title="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
    <option value="Bosnia and Herzegovina" title="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
    <option value="Botswana" title="Botswana">Botswana</option>
    <option value="Bouvet Island" title="Bouvet Island">Bouvet Island</option>
    <option value="Brazil" title="Brazil">Brazil</option>
    <option value="British Indian Ocean Territory" title="British Indian Ocean Territory">British Indian Ocean Territory</option>
    <option value="Brunei Darussalam" title="Brunei Darussalam">Brunei Darussalam</option>
    <option value="Bulgaria" title="Bulgaria">Bulgaria</option>
    <option value="Burkina Faso" title="Burkina Faso">Burkina Faso</option>
    <option value="Burundi" title="Burundi">Burundi</option>
    <option value="Cambodia" title="Cambodia">Cambodia</option>
    <option value="Cameroon" title="Cameroon">Cameroon</option>
    <option value="Canada" title="Canada">Canada</option>
    <option value="Cape Verde" title="Cape Verde">Cape Verde</option>
    <option value="Cayman Islands" title="Cayman Islands">Cayman Islands</option>
    <option value="Central African Republic" title="Central African Republic">Central African Republic</option>
    <option value="Chad" title="Chad">Chad</option>
    <option value="Chile" title="Chile">Chile</option>
    <option value="China" title="China">China</option>
    <option value="Christmas Island" title="Christmas Island">Christmas Island</option>
    <option value="Cocos (Keeling) Islands" title="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
    <option value="Colombia" title="Colombia">Colombia</option>
    <option value="Comoros" title="Comoros">Comoros</option>
    <option value="Congo" title="Congo">Congo</option>
    <option value="Congo, the Democratic Republic of the" title="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
    <option value="Cook Islands" title="Cook Islands">Cook Islands</option>
    <option value="Costa Rica" title="Costa Rica">Costa Rica</option>
    <option value="Côte d'Ivoire" title="Côte d'Ivoire">Côte d'Ivoire</option>
    <option value="Croatia" title="Croatia">Croatia</option>
    <option value="Cuba" title="Cuba">Cuba</option>
    <option value="Curaçao" title="Curaçao">Curaçao</option>
    <option value="Cyprus" title="Cyprus">Cyprus</option>
    <option value="Czech Republic" title="Czech Republic">Czech Republic</option>
    <option value="Denmark" title="Denmark">Denmark</option>
    <option value="Djibouti" title="Djibouti">Djibouti</option>
    <option value="Dominica" title="Dominica">Dominica</option>
    <option value="Dominican Republic" title="Dominican Republic">Dominican Republic</option>
    <option value="Ecuador" title="Ecuador">Ecuador</option>
    <option value="Egypt" title="Egypt">Egypt</option>
    <option value="El Salvador" title="El Salvador">El Salvador</option>
    <option value="Equatorial Guinea" title="Equatorial Guinea">Equatorial Guinea</option>
    <option value="Eritrea" title="Eritrea">Eritrea</option>
    <option value="Estonia" title="Estonia">Estonia</option>
    <option value="Ethiopia" title="Ethiopia">Ethiopia</option>
    <option value="Falkland Islands (Malvinas)" title="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
    <option value="Faroe Islands" title="Faroe Islands">Faroe Islands</option>
    <option value="Fiji" title="Fiji">Fiji</option>
    <option value="Finland" title="Finland">Finland</option>
    <option value="France" title="France">France</option>
    <option value="French Guiana" title="French Guiana">French Guiana</option>
    <option value="French Polynesia" title="French Polynesia">French Polynesia</option>
    <option value="French Southern Territories" title="French Southern Territories">French Southern Territories</option>
    <option value="Gabon" title="Gabon">Gabon</option>
    <option value="Gambia" title="Gambia">Gambia</option>
    <option value="Georgia" title="Georgia">Georgia</option>
    <option value="Germany" title="Germany">Germany</option>
    <option value="Ghana" title="Ghana">Ghana</option>
    <option value="Gibraltar" title="Gibraltar">Gibraltar</option>
    <option value="Greece" title="Greece">Greece</option>
    <option value="Greenland" title="Greenland">Greenland</option>
    <option value="Grenada" title="Grenada">Grenada</option>
    <option value="Guadeloupe" title="Guadeloupe">Guadeloupe</option>
    <option value="Guam" title="Guam">Guam</option>
    <option value="Guatemala" title="Guatemala">Guatemala</option>
    <option value="Guernsey" title="Guernsey">Guernsey</option>
    <option value="Guinea" title="Guinea">Guinea</option>
    <option value="Guinea-Bissau" title="Guinea-Bissau">Guinea-Bissau</option>
    <option value="Guyana" title="Guyana">Guyana</option>
    <option value="Haiti" title="Haiti">Haiti</option>
    <option value="Heard Island and McDonald Islands" title="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
    <option value="Holy See (Vatican City State)" title="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
    <option value="Honduras" title="Honduras">Honduras</option>
    <option value="Hong Kong" title="Hong Kong">Hong Kong</option>
    <option value="Hungary" title="Hungary">Hungary</option>
    <option value="Iceland" title="Iceland">Iceland</option>
    <option value="India" title="India">India</option>
    <option value="Indonesia" title="Indonesia">Indonesia</option>
    <option value="Iran, Islamic Republic of" title="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
    <option value="Iraq" title="Iraq">Iraq</option>
    <option value="Ireland" title="Ireland">Ireland</option>
    <option value="Isle of Man" title="Isle of Man">Isle of Man</option>
    <option value="Israel" title="Israel">Israel</option>
    <option value="Italy" title="Italy">Italy</option>
    <option value="Jamaica" title="Jamaica">Jamaica</option>
    <option value="Japan" title="Japan">Japan</option>
    <option value="Jersey" title="Jersey">Jersey</option>
    <option value="Jordan" title="Jordan">Jordan</option>
    <option value="Kazakhstan" title="Kazakhstan">Kazakhstan</option>
    <option value="Kenya" title="Kenya">Kenya</option>
    <option value="Kiribati" title="Kiribati">Kiribati</option>
    <option value="Korea, Democratic People's Republic of" title="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
    <option value="Korea, Republic of" title="Korea, Republic of">Korea, Republic of</option>
    <option value="Kuwait" title="Kuwait">Kuwait</option>
    <option value="Kyrgyzstan" title="Kyrgyzstan">Kyrgyzstan</option>
    <option value="Lao People's Democratic Republic" title="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
    <option value="Latvia" title="Latvia">Latvia</option>
    <option value="Lebanon" title="Lebanon">Lebanon</option>
    <option value="Lesotho" title="Lesotho">Lesotho</option>
    <option value="Liberia" title="Liberia">Liberia</option>
    <option value="Libya" title="Libya">Libya</option>
    <option value="Liechtenstein" title="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania" title="Lithuania">Lithuania</option>
    <option value="Luxembourg" title="Luxembourg">Luxembourg</option>
    <option value="Macao" title="Macao">Macao</option>
    <option value="Macedonia, the former Yugoslav Republic of" title="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
    <option value="Madagascar" title="Madagascar">Madagascar</option>
    <option value="Malawi" title="Malawi">Malawi</option>
    <option value="Malaysia" title="Malaysia">Malaysia</option>
    <option value="Maldives" title="Maldives">Maldives</option>
    <option value="Mali" title="Mali">Mali</option>
    <option value="Malta" title="Malta">Malta</option>
    <option value="Marshall Islands" title="Marshall Islands">Marshall Islands</option>
    <option value="Martinique" title="Martinique">Martinique</option>
    <option value="Mauritania" title="Mauritania">Mauritania</option>
    <option value="Mauritius" title="Mauritius">Mauritius</option>
    <option value="Mayotte" title="Mayotte">Mayotte</option>
    <option value="Mexico" title="Mexico">Mexico</option>
    <option value="Micronesia, Federated States of" title="Micronesia, Federated States of">Micronesia, Federated States of</option>
    <option value="Moldova, Republic of" title="Moldova, Republic of">Moldova, Republic of</option>
    <option value="Monaco" title="Monaco">Monaco</option>
    <option value="Mongolia" title="Mongolia">Mongolia</option>
    <option value="Montenegro" title="Montenegro">Montenegro</option>
    <option value="Montserrat" title="Montserrat">Montserrat</option>
    <option value="Morocco" title="Morocco">Morocco</option>
    <option value="Mozambique" title="Mozambique">Mozambique</option>
    <option value="Myanmar" title="Myanmar">Myanmar</option>
    <option value="Namibia" title="Namibia">Namibia</option>
    <option value="Nauru" title="Nauru">Nauru</option>
    <option value="Nepal" title="Nepal">Nepal</option>
    <option value="Netherlands" title="Netherlands">Netherlands</option>
    <option value="New Caledonia" title="New Caledonia">New Caledonia</option>
    <option value="New Zealand" title="New Zealand">New Zealand</option>
    <option value="Nicaragua" title="Nicaragua">Nicaragua</option>
    <option value="Niger" title="Niger">Niger</option>
    <option value="Nigeria" title="Nigeria">Nigeria</option>
    <option value="Niue" title="Niue">Niue</option>
    <option value="Norfolk Island" title="Norfolk Island">Norfolk Island</option>
    <option value="Northern Mariana Islands" title="Northern Mariana Islands">Northern Mariana Islands</option>
    <option value="Norway" title="Norway">Norway</option>
    <option value="Oman" title="Oman">Oman</option>
    <option value="Pakistan" title="Pakistan">Pakistan</option>
    <option value="Palau" title="Palau">Palau</option>
    <option value="Palestinian Territory, Occupied" title="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
    <option value="Panama" title="Panama">Panama</option>
    <option value="Papua New Guinea" title="Papua New Guinea">Papua New Guinea</option>
    <option value="Paraguay" title="Paraguay">Paraguay</option>
    <option value="Peru" title="Peru">Peru</option>
    <option value="Philippines" title="Philippines">Philippines</option>
    <option value="Pitcairn" title="Pitcairn">Pitcairn</option>
    <option value="Poland" title="Poland">Poland</option>
    <option value="Portugal" title="Portugal">Portugal</option>
    <option value="Puerto Rico" title="Puerto Rico">Puerto Rico</option>
    <option value="Qatar" title="Qatar">Qatar</option>
    <option value="Réunion" title="Réunion">Réunion</option>
    <option value="Romania" title="Romania">Romania</option>
    <option value="Russian Federation" title="Russian Federation">Russian Federation</option>
    <option value="Rwanda" title="Rwanda">Rwanda</option>
    <option value="Saint Barthélemy" title="Saint Barthélemy">Saint Barthélemy</option>
    <option value="Saint Helena, Ascension and Tristan da Cunha" title="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
    <option value="Saint Kitts and Nevis" title="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
    <option value="Saint Lucia" title="Saint Lucia">Saint Lucia</option>
    <option value="Saint Martin (French part)" title="Saint Martin (French part)">Saint Martin (French part)</option>
    <option value="Saint Pierre and Miquelon" title="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
    <option value="Saint Vincent and the Grenadines" title="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
    <option value="Samoa" title="Samoa">Samoa</option>
    <option value="San Marino" title="San Marino">San Marino</option>
    <option value="Sao Tome and Principe" title="Sao Tome and Principe">Sao Tome and Principe</option>
    <option value="Saudi Arabia" title="Saudi Arabia">Saudi Arabia</option>
    <option value="Senegal" title="Senegal">Senegal</option>
    <option value="Serbia" title="Serbia">Serbia</option>
    <option value="Seychelles" title="Seychelles">Seychelles</option>
    <option value="Sierra Leone" title="Sierra Leone">Sierra Leone</option>
    <option value="Singapore" title="Singapore">Singapore</option>
    <option value="Sint Maarten (Dutch part)" title="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
    <option value="Slovakia" title="Slovakia">Slovakia</option>
    <option value="Slovenia" title="Slovenia">Slovenia</option>
    <option value="Solomon Islands" title="Solomon Islands">Solomon Islands</option>
    <option value="Somalia" title="Somalia">Somalia</option>
    <option value="South Africa" title="South Africa">South Africa</option>
    <option value="South Georgia and the South Sandwich Islands" title="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
    <option value="South Sudan" title="South Sudan">South Sudan</option>
    <option value="Spain" title="Spain">Spain</option>
    <option value="Sri Lanka" title="Sri Lanka">Sri Lanka</option>
    <option value="Sudan" title="Sudan">Sudan</option>
    <option value="Suriname" title="Suriname">Suriname</option>
    <option value="Svalbard and Jan Mayen" title="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
    <option value="Swaziland" title="Swaziland">Swaziland</option>
    <option value="Sweden" title="Sweden">Sweden</option>
    <option value="Switzerland" title="Switzerland">Switzerland</option>
    <option value="Syrian Arab Republic" title="Syrian Arab Republic">Syrian Arab Republic</option>
    <option value="Taiwan, Province of China" title="Taiwan, Province of China">Taiwan, Province of China</option>
    <option value="Tajikistan" title="Tajikistan">Tajikistan</option>
    <option value="Tanzania, United Republic of" title="Tanzania, United Republic of">Tanzania, United Republic of</option>
    <option value="Thailand" title="Thailand">Thailand</option>
    <option value="Timor-Leste" title="Timor-Leste">Timor-Leste</option>
    <option value="Togo" title="Togo">Togo</option>
    <option value="Tokelau" title="Tokelau">Tokelau</option>
    <option value="Tonga" title="Tonga">Tonga</option>
    <option value="Trinidad and Tobago" title="Trinidad and Tobago">Trinidad and Tobago</option>
    <option value="Tunisia" title="Tunisia">Tunisia</option>
    <option value="Turkey" title="Turkey">Turkey</option>
    <option value="Turkmenistan" title="Turkmenistan">Turkmenistan</option>
    <option value="Turks and Caicos Islands" title="Turks and Caicos Islands">Turks and Caicos Islands</option>
    <option value="Tuvalu" title="Tuvalu">Tuvalu</option>
    <option value="Uganda" title="Uganda">Uganda</option>
    <option value="Ukraine" title="Ukraine">Ukraine</option>
    <option value="United Arab Emirates" title="United Arab Emirates">United Arab Emirates</option>
    <option value="United Kingdom" title="United Kingdom">United Kingdom</option>
    <option value="United States" title="United States">United States</option>
    <option value="United States Minor Outlying Islands" title="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
    <option value="Uruguay" title="Uruguay">Uruguay</option>
    <option value="Uzbekistan" title="Uzbekistan">Uzbekistan</option>
    <option value="Vanuatu" title="Vanuatu">Vanuatu</option>
    <option value="Venezuela, Bolivarian Republic of" title="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
    <option value="Viet Nam" title="Viet Nam">Viet Nam</option>
    <option value="Virgin Islands, British" title="Virgin Islands, British">Virgin Islands, British</option>
    <option value="Virgin Islands, U.S." title="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
    <option value="Wallis and Futuna" title="Wallis and Futuna">Wallis and Futuna</option>
    <option value="Western Sahara" title="Western Sahara">Western Sahara</option>
    <option value="Yemen" title="Yemen">Yemen</option>
    <option value="Zambia" title="Zambia">Zambia</option>
    <option value="Zimbabwe" title="Zimbabwe">Zimbabwe</option>
</select>

                            </div>
</div>

                             </div>


                            <div class="row">
                            <div class="col-md-4">
                            <div class="form-group">
                                <label>Organization</label>
                                <input type="text" class="form-control" placeholder="Debtors Organization" name="debtor_organization" value="<?php echo $_POST['debtor_organization']; ?>">
                            </div>
</div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Debtors Email address" name="debtor_mail" value="<?php echo $_POST['debtor_mail']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="number" class="form-control" placeholder=" Debtors Phone number" name="debtor_cell" value="<?php echo $_POST['debtor_cell']; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                            <div class="col-md-4">
                            <div class="form-group">
                                <label>Location</label>
                    <input type="text" class="form-control" placeholder="Debtors Location" name="debtor_location" value="<?php echo $_POST['debtor_location']; ?>">
                            </div>
</div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Postal Address</label>
                                        <input type="text" class="form-control" placeholder="Debtors Postal address" name="debtor_postaladdress" value="<?php echo $_POST['debtor_postaladdress']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fax</label>
                                        <input type="text" class="form-control" placeholder="Debtors Fax" name="debtor_fax" value="<?php echo $_POST['debtor_fax']; ?>">
                                    </div>
                                </div>
                            </div>



                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Amount due</label>
                                        <input type="text" class="form-control" placeholder="Due Amount" name="debtor_dueamount" value="<?php echo $_POST['debtor_dueamount']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Currency</label>
                                        <input type="text" class="form-control" placeholder="Currency" name="debtor_currrency" value="<?php echo $_POST['debtor_currrency']; ?>">
                                    </div>
                                </div>
                            </div>
                                                           <h6>Debt History</h6>


<div class="row">
 <div class="col-md-2">
 Check Returned&nbsp;<input type="checkbox" name="checkreturn" value="1"></div> <div class="col-md-2">
Disputed&nbsp;<input type="checkbox" name="disputed" value="1"></div>
<div class="col-md-2">
Claims Inability to pay&nbsp;<input type="checkbox" name="inability" value="1"></div>
<div class="col-md-2">
Mail Returned&nbsp;<input type="checkbox" name="mailreturn" value="1"></div>
<div class="col-md-2">
Phone Disconnected&nbsp;<input type="checkbox" name="phonedisconnect" value="1"></div>
<div class="col-md-2">
No Response &nbsp;<input type="checkbox" name="noresponse" value="1"></div>

</div>
<div class="row">
<div class="col-md-6">

Others(Please specify) &nbsp;<input type="checkbox" name="others" value="1">&nbsp;&nbsp;
      <textarea class="form-control" placeholder="Write you message here..." style="height:100px;"  name="other_reason" value="<?php echo $_POST['other_reason']; ?>"></textarea>

</div>

<div class="col-md-6">
 <div class="form-group">
                                        <label>Date of Indebtedness :</label>
                                <input type="text" class="form-control" placeholder="Date" name="debtor_date_indebt" value="<?php echo $_POST['debtor_date_indebt']; ?>">
                                    </div>

</div>


   </div>
<div class="row">
<div class="col-md-5">Documents(You can select multiple documents): </div>  <div class="col-md-4"><input type="file" class="browse" id="files" name="files[]" multiple />
</div>                             


</div>

   </div>
<div class="row">
<output id="list"></output>
     </div>   





                            </div>
                   
                            <div class="form-group">
                                <label>Other Comments</label>
                                <textarea class="form-control" placeholder="Write you comments here..." style="height:100px;"  name="comments" value="<?php echo $_POST['comments']; ?>"></textarea>
                            </div>

                            <div class="row">
<div class="col-md-1">
      <label>Captcha</label>
                                 <img src="captcha.php" alt="captcha" title="captcha" class="captcha" width="100px" height="50px">

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
  

  
  <div class="space20"></div>
  


           
  <?php include("footer.php");  ?>
  <a href="#" class="back-to-top"><span></span></a> 
<?php include("footerscripts.php"); ?>
       
</body>
</html>
         
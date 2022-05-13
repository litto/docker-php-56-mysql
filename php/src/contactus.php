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
$id=32;
$about=$cont->getPage($id);

?>

   <title><?php echo $about[0]['seo_title']; ?></title>
    <meta name="title" content="<?php echo $about[0]['seo_title']; ?>">
   <meta name="description" content="<?php echo $about[0]['seo_description']; ?>">
  <meta name="keywords" content="<?php echo $about[0]['seo_keywords']; ?>">

 <?php include("headerscript.php"); ?>
<script src='https://www.google.com/recaptcha/api.js'></script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KDGJJBF');</script>
<!-- End Google Tag Manager -->
</head>  
<?php
$current="contact";
 ?>   
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KDGJJBF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  <!-- Header -->
  <header> 
 <?php include("topheader.php");  ?>

    <!-- Nav -->
  <?php include("topmenu.php"); ?>
    <!-- Nav End -->
    
  </header>
  <!-- Header End -->
                      
  <!-- Content -->    
  
  <!-- Map -->
<div style="width: 100%"><iframe width="100%" height="400" src="https://maps.google.com/maps?width=100%&amp;height=400&amp;hl=en&amp;coord=25.2644178,55.3197133&amp;q=Al%20Rigga%20street%2C%20Dubai%2CUAE+(UAE%20Debt%20Collection)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/map-my-route/">Plot a route map</a></iframe></div><br />

  <div class="space40"></div>

  <div class="container">
    <div class="row"> 
      <div class="col-md-12">
        <h1>Get In Touch!</h1>
      </div>
    </div>    
  </div>    
  
  <div class="space20"></div>  
  
  <div class="container">
    <div class="row"> 
      <div class="col-md-6">  
      
        <div class="row contact-data">
          <div class="col-md-6">
            <h4>Address</h4>
            <?php echo $contact[0]['company'];  ?><br>
            <?php // echo $contact[0]['zipcode'];  ?><?php echo $contact[0]['state'];  ?><br>
        <?php echo $contact[0]['country'];  ?>
            <div class="space40"></div>
          </div>  
          <div class="col-md-6">
            <h4>Office Hours</h4>  
            <strong>Sunday - Thursday:</strong> 09:00 - 17:00<br>
            <strong>Saturday:</strong> 09:00 - 14:30<br>
            <strong>Friday:</strong> Closed<br>
            <div class="space40"></div>
          </div>  
          <div class="col-md-6">
            <h4>Contact Info</h4>  
             <i class="fa fa-phone"></i> <a href="https://api.whatsapp.com/send?phone=<?php echo $contact[0]['telephone'];  ?>&text=Hi Uaedebtcollection, I have a query?" target="_blank"><?php echo $contact[0]['telephone'];  ?></a><br>
           <i class="fa fa-envelope"></i> <a href="mailto:<?php echo $contact[0]['email'];  ?>"><?php echo $contact[0]['email'];  ?></a><br>
    
            <div class="space40"></div>
          </div>  
          <div class="col-md-6 social-4">
            <h4>Socials Media</h4>
           <a href="http://ae.linkedin.com/in/uaedebtcollection" target="_blank"><i class="fa fa-linkedin"></i></a>
            <a href="https://twitter.com/idebtcollection" target="_blank"><i class="fa fa-twitter"></i></a>
<!--             <a href="https://plus.google.com/108812438233732771247" target="_blank"><i class="fa fa-google-plus"></i></a> -->
            <a href="https://www.facebook.com/pages/Uaedebtcollection/1554161714869503" target="_blank"><i class="fa fa-facebook"></i></a>
       <!--      <a href="https://www.pinterest.com/uaedebtcollect/" target="_blank"><i class="fa fa-pinterest"></i></a> -->

</div>  
          <div class="space40"></div>
        </div>
      
      </div> 
      <div class="col-md-6">  
        
        <h4>Contact Form</h4>    
        <!-- Form -->
        <form  action="enquirymail.php"  method="post" class="contact-form">
         <div class="row">
                    <div class="col-md-12">

<span style="color:red;"><?php
if(isset($_GET['msg'])){
    echo $_GET['msg'];
}

?></span>
                    </div></div>
          <div class="row">            
            <div class="form-group col-sm-6">
              <label for="name2">Name</label>
              <input class="form-control"   name="user_name"  type="text" placeholder="Name">
            </div>
            <div class="form-group col-sm-6">
              <label for="email2">E-mail</label>
              <input  class="form-control"  name="user_mail"  type="email"   placeholder="abc@gmail.com">
            </div>
          </div> 
          <div class="row">            
            <div class="form-group col-sm-6">
              <label for="name2">Phone</label>
              <input class="form-control"  name="user_cell" type="text" placeholder="Phone">
            
            </div>
            <div class="form-group col-sm-6">
           
            </div>
          </div> 

          <div class="row">            
            <div class="form-group col-md-12">
              <label for="message2">Message</label>
              <textarea class="form-control"  name="user_message" >Message</textarea>
            </div>
          </div> 

          <div class="row">            
            <div class="form-group col-sm-2">

               <!-- <div class="g-recaptcha" data-sitekey="6LduyAkUAAAAAAhcgVRbGWfTl5WEn42KK_PWvHZT"></div>-->
           <img src="captcha.php" alt="captcha" title="captcha" class="captcha" width="100px" height="50px">
			  </div>
          <div class="form-group col-sm-6">
              <label for="email2">Enter Code</label>
              <input  class="form-control"  name="txtCode"  type="text"  value="Captcha">
            </div>
            
          </div> 
			<div class="row">
			   <div class="form-group col-sm-4">
               <input type="submit" class="btn btn-primary"  name="submit" value="Submit">
               </div>	
				
			</div>

          <div class="row spacer30"></div>
          <div class="row">            
            <div class="col-md-12 text-center">
              <div id="ajaxsuccess">E-mail was successfully sent.</div>
              <div class="error" id="err-form">There was a problem validating the form please check!</div>
              <div class="error" id="err-timedout">The connection to the server timed out!</div>
              <div class="error" id="err-state"></div>                 
           
            </div>
          </div>
        </form>   
        <!-- Form End -->
          
      </div>    

    </div> 
  </div> 

 
           
  <!-- Footer -->  
   <?php include("footer.php");  ?>
  <!-- Footer End --> 
  
  <a href="#" class="back-to-top"><span></span></a> 

<?php include("footerscripts.php"); ?>
  
</body>
</html>
         
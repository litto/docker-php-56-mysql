<?php
include("db.php");
$cont=new Contacts();
$contact=$cont->getSettings();
$obj    =   new Auth();
$base   =   $obj->getLoggedInfo();

?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]--><head>
  <meta name="google-site-verification" content="BbwzyMnSh8Uv0IVuSzj_5isAJJoxuWiUUosUVy9c9IQ" />
  <meta property="og:image" content="https://uaedebtcollection.com/uaedebt.png">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="360">
<meta property="og:image:height" content="360">

<?php
$cont=new Content();
$about=$cont->getPage(1);

?>
  <!-- Basic Meta Tags -->
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
<link rel="canonical" href="https://www.uaedebtcollection.com/index.php" />

</head> 
<?php
$current="home";
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

<?php include("slider.php"); ?>
    <!-- LayerSlider End -->

  </header>
  <!-- Header End -->

               <?php
$pg=new Content();
$home=$pg->get_home();

?>               
  <!-- Content -->    
  <div class="container">
    <div class="row"> 
      <div class="col-md-12">
      </br>
        <h1><strong><?php echo $home[0]['page_title']  ?></strong></h1>
           <p><?php echo $home[0]['content']  ?></p>
      </div>
      <div class="col-md-4">

    </div>  
<div class="col-md-4">
	
	
	
<center>
<a href="claim-submission.php" target="_blank" class="btn btn-primary"><h5>SUBMIT CLAIM</h5></a></div>
</center>
	  </br>


</div>
  </br>

<div class="col-md-4">

    </div>    
  </div>    
  
  <div class="space20"></div>  
                      <?php
                    $id=2;
$about=$pg->getPage($id);
$id=3;
$facility=$pg->getPage($id);

$id=4;
$work=$pg->getPage($id);

$id=5;
$expert=$pg->getPage($id);

?>
  <!-- Service --> 
  <div class="container">
    <div class="row">

      <div class="col-md-4">
        <div class="service">  
          <h4><a href="about-us.php"><?php echo $about[0]['page_title']; ?></a></h4>
          <p><?php echo substr($about[0]['content'],0,240); ?>...</p>
          <span class="typcn typcn-stopwatch"></span> 
        </div>
           
      </div> 
      
      <div class="col-md-4">
        <div class="service">  
          <h4><a href="our-services.php"> <?php echo $facility[0]['page_title']; ?></a></h4>
          <p><?php echo substr($facility[0]['content'],0,256); ?>...</p>
          <span class="typcn typcn-weather-stormy"></span> 
        </div>  
         
      </div>

      <div class="col-md-4">
        <div class="service">  
          <h4> <a href="how-to-minimize-debt.php"><?php echo $work[0]['page_title']; ?></a></h4>
          <p><?php echo substr($work[0]['content'],0,210); ?>...</p>
          <span class="typcn typcn-weather-stormy"></span> 
        </div>  
    
      </div>

        
 
      
    </div>
  </div> 
  <!-- Service End --> 





  <div class="space40"></div>


  <!-- Content End -->
           
  <!-- Footer -->  
<?php include("footer.php");  ?>
  <!-- Footer End --> 
  
  <a href="#" class="back-to-top"><span></span></a> 

<?php include("footerscripts.php"); ?>
                         
</body>
</html>
         
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
              <?php
$cont=new Content();
$id=10;
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
$current="sector";
 ?>      
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KDGJJBF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  <!-- Header -->
  <header> 
  <title>DEBT RECOVERY SERVICES | DEBT COLLECTION SERVICES</title>
 <?php include("topheader.php");  ?>

<?php include("topmenu.php"); ?>
    <!-- Nav End -->
    
  </header>
  <!-- Header End -->
          <?php
$cont=new Content();
$id=10;
$about=$cont->getPage($id);

?>                
  <!-- Content -->    
  <div class="breadcrumb-container">
    <div class="container">  
      <div class="row">  
        <div class="col-md-12">
          <h1><?php echo $about[0]['page_title']; ?></h1>
          <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active"><?php echo $about[0]['page_title']; ?></li>
          </ol>
        </div>  
      </div> 
    </div> 
  </div>

  <div class="space20"></div>
  
  <div class="container">
    <div class="row">
  
      <div class="col-md-8">
       

        <p>
 <?php echo $about[0]['content']; ?>
        </p>                   
        <div class="space40"></div>
        
      </div>
      
             <div class="col-md-4">
<p> <img src="uploads/<?php echo $about[0]['banner']; ?>" alt="<?php echo $about[0]['title']; ?>" title="<?php echo $about[0]['title']; ?>" /></p>
        
      </div> 
    </div>
  </div>       
  

  
  <div class="space20"></div>
  


           
  <?php include("footer.php");  ?>
  <a href="#" class="back-to-top"><span></span></a> 

<?php include("footerscripts.php"); ?>
       
</body>
</html>
         
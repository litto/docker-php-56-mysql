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
$id=6;
$about=$cont->getPage($id);

?> 
  <title><?php echo $about[0]['seo_title']; ?></title>
    <meta name="title" content="<?php echo $about[0]['seo_title']; ?>">
   <meta name="description" content="<?php echo $about[0]['seo_description']; ?>">
  <meta name="keywords" content="<?php echo $about[0]['seo_keywords']; ?>">

 <?php include("headerscript.php"); ?>
</head>
<?php 
$current="disclaimer";
 ?>      
<body>

  <!-- Header -->
  <header> 

 <?php include("topheader.php");  ?>

<?php include("topmenu.php"); ?>
    <!-- Nav End -->
    
  </header>
  <!-- Header End -->
              
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
  
      <div class="col-md-12">
       

        <p>
 <?php echo $about[0]['content']; ?>
        </p>                   
        <div class="space40"></div>
        
      </div>     
    </div>
  </div>       
  

  
  <div class="space20"></div>
  


           
  <?php include("footer.php");  ?>
  <a href="#" class="back-to-top"><span></span></a> 

<?php include("footerscripts.php"); ?>
       
</body>
</html>
         
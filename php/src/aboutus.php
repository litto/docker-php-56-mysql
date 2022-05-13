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
  
    <title>UAE Debt Collection-About Us |Debt Collection & Debt Recovery in Allover UAE | Debt Collection in Emirates- Dubai, Sharjah, Abudhabi,Ras Al Khaimah, Al Ain, Fujairah|  Middle East Debt Recovery from KSA , Qatar , Bahrain , Oman, Kuwait</title>
    
 <meta name="title" content="UAE Debt Collection-About Us |Debt Collection & Debt Recovery in Allover UAE | Debt Collection in Emirates- Dubai, Sharjah, Abudhabi,Ras Al Khaimah, Al Ain, Fujairah|  Middle East Debt Recovery from KSA , Qatar , Bahrain , Oman, Kuwait">
 
   <meta name="description" content="UAE Debt collection is one of the top global debt collection agents operating in UAE.Our intercessors follow the authorized debt collection guidelines and act in accordance with the consumer protection laws, and their usage of fair debt collection services provides us with legal fringe in above 200 countries all belonging to different structure.We cover our network mainly in Middleeast, Africa, Asia, America and Europe.">
   
  <meta name="keywords" content="Uae Debt collection, About UAE Debt collection, About Debt Recovery Pocedure, Debt Recovery in Middleeast, Africa, USA(America), Europe.Debt Recovery in Middle East- UAE, Bahrain,Oman, Qatar, KSA,Iran,Iraq. Debt Recovery in Emirates- Dubai, Abdu Dhabi, Al Ain, Fujairah, Ras Al Khaimah. Debt Recovery in Europe-UK(England), Spain,Italy,Portugal,Germany,Dubai Debt Collection,Debt Collection Agency  UAE,UAE Debt Collector,Debt Collection Services in UAE,Lawyers in Dubai,Debt Collection in Middleeast,Legal services in Middleeast,Debt Recovery Services in UAE,Legal Services in UAE,Filing criminal case in uae,Recovering Debts in UAE,Best Debt collection company in UAE,Best Debt recovery company in UAE,Top Debt Collection Agency in UAE,Payment Recovery Companies in UAE,Debt Settlement companies in uae,Best Debt collection company in middleeast,Top Debt collection agency in middle east">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="https://uaedebtcollection.com/uaedebt.png">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="360">
<meta property="og:image:height" content="360">
  <!--[if (gte IE 9)|!(IE)]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <![endif]--> 

  <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/png"><!-- LayerSlider stylesheet -->

  <!-- Bootstrap -->
  <link href="css/bootstrap.css" rel="stylesheet">
  
  <!-- Styles -->
  <link href="css/styles.css" rel="stylesheet" id="color-style"> 

  <!-- LayerSlider Styles -->
  <link href="layerslider/css/layerslider.css" rel="stylesheet">
               
  <!-- Magnific Popup -->
  <link href="css/magnific-popup.css" rel="stylesheet"> 

  <!-- Animate -->    
  <link href="css/animate.css" rel="stylesheet">

  <!-- Font Awesome Style -->
  <link href="css/font-awesome.min.css" rel="stylesheet">
  
  <!-- Entypo Icons -->    
  <link href="css/entypo.css" rel="stylesheet">

  <!-- Typicons Style -->
  <link href="css/typicons.min.css" rel="stylesheet">
 
  <!-- Revolution CSS -->
  <link href="rs-plugin/css/settings.css" rel="stylesheet" media="screen">

  <!-- Base MasterSlider style sheet -->
  <link href="masterslider/style/masterslider.css" rel="stylesheet">
   
  <!-- MasterSlider default skin -->
  <link href="masterslider/skins/default/style.css" rel="stylesheet">
  
  <!-- Flexslider CSS -->
  <link href="css/flexslider.css" rel="stylesheet">

  <!-- Refine Slider -->
  <link href="css/refineslide.css" rel="stylesheet">     

  <!-- Web Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,700,300,800' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>


<meta name="google-translate-customization" content="d850ecd4ca7db6df-5f30391b57580dab-g7375ecdf5299b5ac-16"></meta>
</head> 
<?php
$current="about";
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
          <h1>About Us</h1>
          <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">About Us</li>
          </ol>
        </div>  
      </div> 
    </div> 
  </div>
      <?php
$id=2;
$cont=new Content();
$about=$cont->getPage($id);

?>
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
<p> <img src="uploads/<?php echo $about[0]['banner']; ?>" alt="About Us" title="About Us" /></p>
        
      </div>  
    </div>
  </div>       
  

  
  <div class="space20"></div>
  


           
  <?php include("footer.php");  ?>
  <a href="#" class="back-to-top"><span></span></a> 

  <!-- JavaScripts -->
  <script type="text/javascript" src="js/jquery-1.10.2.js"></script>                                                       
  <script type="text/javascript" src="js/bootstrap.js"></script>  
  <script type="text/javascript" src="js/jquery.easing.js"></script>  
  <script type="text/javascript" src="js/jquery.sticky.js"></script>
  <script type="text/javascript" src="js/tinynav.min.js"></script>      
  <script type="text/javascript" src="js/animate.js"></script>
  <script type="text/javascript" src="js/jquery.fitvids.js"></script> 
  <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
  <script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
  <script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script> 
  <script type="text/javascript" src="js/retina.js"></script> 
  <script type="text/javascript" src="js/respond.min.js"></script> 
  <script type="text/javascript" src="js/scale.fix.js"></script>
  <script type="text/javascript" src="js/jquery.countdown.js"></script> 
  <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
  <script type="text/javascript" src="js/jquery.refineslide.js"></script>
  <script type="text/javascript" src="layerslider/js/greensock.js"></script>
  <script type="text/javascript" src="layerslider/js/layerslider.transitions.js"></script>
  <script type="text/javascript" src="layerslider/js/layerslider.kreaturamedia.jquery.js"></script>
  <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
  <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script type="text/javascript" src="masterslider/masterslider.js"></script>  
  <script type="text/javascript" src="js/functions.js"></script> 
       
</body>
</html>
         
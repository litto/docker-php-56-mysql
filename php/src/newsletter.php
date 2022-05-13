<?php include("header.php"); 
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
                <?php

if($_POST['submit']){

  $email=$_POST['email'];
  $inputs=array('email'=>$email);

  $k=new Newsletter();
  $k->addsubscribe($inputs);
  header("Location:index.php");
}

                ?>      
  <!-- Content -->    
  <div class="breadcrumb-container">
    <div class="container">  
      <div class="row">  
        <div class="col-md-12">
          <h1>Newsletter</h1>
          <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">Newsletter</li>
          </ol>
        </div>  
      </div> 
    </div> 
  </div>
      <?php
$id=6;
$cont=new Content();
$about=$cont->getPage($id);

?>
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
         
 <?php
$cont=new Content();
$pages=$cont->getSubmenuList(10);

$services=$cont->getSubmenuList(3);

$aboutpages=$cont->getSubmenuList(2);
 ?>

    <!-- Nav -->
    <nav class="navbar" role="navigation">
      <div class="navbar-inner">
        <div class="container">     
          <!-- Menu -->
          <ul class="nav navbar-nav" id="nav">
      <li <?php if($current=='home') {  ?> class="selected" <?php } ?>><a href="index.php">Home</a></li>
                    <!--<li <?php if($current=='about') {  ?> class="selected" <?php } ?> ><a href="about-us.php">About us</a></li>-->
                    
                        <li <?php if($current=='about') {  ?> class="selected" <?php } ?> >  <a href="about-us.php">About Us</a>
<ul>
 <li><a href="how-to-minimize-debt.php">How to Minimize Debt?</a></li>
  <?php for($i=0;$i<count($aboutpages);$i++){  
      $tit= strtolower(str_replace(' ', '-', $aboutpages[$i]['title']));
$tit= strtolower(str_replace('&', 'and', $tit));
$tit= strtolower(str_replace('.', '-', $tit));
$tit= strtolower(str_replace('(', '-', $tit));
$tit= strtolower(str_replace(')', '-', $tit));
$tit= strtolower(str_replace(',', '-', $tit));

    ?>
          <li  ><a href="page-<?php echo $aboutpages[$i]['page_id']; ?>-<?php echo $tit; ?>.php"><?php echo $aboutpages[$i]['title']; ?></a></li>
               <?php } ?> 
</ul>
  </li> 
  
  
                    
                    <!--<li <?php if($current=='service') {  ?> class="selected" <?php } ?>><a href="our-services.php">Our Services</a></li>-->
    
    <li <?php if($current=='service') {  ?> class="selected" <?php } ?> >  <a href="our-services.php">Our Services</a>
<ul>

  <?php for($i=0;$i<count($services);$i++){  
      $tit= strtolower(str_replace(' ', '_', $services[$i]['title']));
$tit= strtolower(str_replace('&', 'and', $tit));
$tit= strtolower(str_replace('.', '-', $tit));
$tit= strtolower(str_replace('(', '-', $tit));
$tit= strtolower(str_replace(')', '-', $tit));
$tit= strtolower(str_replace(',', '-', $tit));

    ?>
          <li  ><a href="service-<?php echo $services[$i]['page_id']; ?>-<?php echo $tit; ?>.php"><?php echo $services[$i]['title']; ?></a></li>
               <?php } ?> 
</ul>
  </li>                
                    
                    
                    
                    
                    
                       <!--<li <?php if($current=='how-to-minimize-debt') {  ?> class="selected" <?php } ?>><a href="how-to-minimize-debt.php">How to Minimize Debt?</a></li>-->
                       
                       
<li <?php if($current=='sector') {  ?> class="selected" <?php } ?> >  <a href="practice-sectors.php">Practice Sectors</a>
<ul>

  <?php for($i=0;$i<count($pages);$i++){  
      $tit= strtolower(str_replace(' ', '-', $pages[$i]['title']));
$tit= strtolower(str_replace('&', 'and', $tit));
$tit= strtolower(str_replace('.', '-', $tit));
$tit= strtolower(str_replace('(', '-', $tit));
$tit= strtolower(str_replace(')', '-', $tit));
$tit= strtolower(str_replace(',', '-', $tit));

    ?>
          <li  ><a href="sector-<?php echo $pages[$i]['page_id']; ?>-<?php echo $tit; ?>.php"><?php echo $pages[$i]['title']; ?></a></li>
               <?php } ?> 
</ul>
  </li>



              <li <?php if($current=='claim-submission') {  ?> class="selected" <?php } ?>><a href="claim-submission.php">Claim Submission</a></li>
               <!--    <li <?php if($current=='disclaimer') {  ?> class="selected" <?php } ?>><a href="disclaimer.php">Disclaimer</a></li> -->
               
    
                            <li <?php if($current=='becomepartner') {  ?> class="selected" <?php } ?> >  <a href="#">Partner with Us</a>
<ul>
 <li><a href="become_referrer.php">Become a Referrer</a></li>
  <li><a href="become_associate.php">Become an Associate</a></li>

</ul>
  </li> 
                    
                    
                    <li <?php if($current=='contact') {  ?> class="selected" <?php } ?>><a href="contactus.php">Contact Us</a></li>






          </ul>
          <!-- Menu End -->     
           
          <!-- Social Top --> 
          <div class="social-top social-6">

            <a href="http://ae.linkedin.com/in/uaedebtcollection" target="_blank"><i class="fa fa-linkedin"></i></a>
            <a href="https://twitter.com/idebtcollection" target="_blank"><i class="fa fa-twitter"></i></a>
            <!--<a href="https://plus.google.com/108812438233732771247" target="_blank"><i class="fa fa-google-plus"></i></a>-->
            <a href="https://www.facebook.com/pages/Uaedebtcollection/1554161714869503" target="_blank"><i class="fa fa-facebook"></i></a>
            <!--<a href="https://www.pinterest.com/uaedebtcollect/" target="_blank"><i class="fa fa-pinterest"></i></a>-->


          </div>  
          <!-- Social Top End -->  
          
        </div> 
      </div>  
    </nav>
    <!-- Nav End -->
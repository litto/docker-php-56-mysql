<?php

$obj    =   new Auth();
$base   =   $obj->getLoggedInfo();
?> <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="top-container">
            <!-- Logo -->                       
      			<a href="index.php" class="logo" title="UAE DEBT COLLECTION"><img src="uploads/<?php echo $base[0]['logo'];  ?> " alt=""></a>                     
  
            <!-- Top Items --> 
            <ul class="top-items">
              <li><i class="fa fa-lightbulb-o"></i>Phone No:<a href="https://api.whatsapp.com/send?phone=<?php echo $contact[0]['telephone'];  ?>&text=Hi Uaedebtcollection, I have a query?" target="_blank"><?php echo $contact[0]['telephone'];  ?></a></li>
              <li class="red"><i class="fa fa-envelope-o"></i><a href="mailto:<?php echo $contact[0]['email'];  ?>" class="red"><?php echo $contact[0]['email'];  ?></a></li>
        
            </ul>
            <!-- Top Items End --> 
          </div>
        </div> 
      </div> 
    </div> 
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54ed534152d8c29b" async="async"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-146401213-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-146401213-1');
</script>



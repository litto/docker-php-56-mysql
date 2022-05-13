  <footer class="footer">

<?php
$id=2;
$cont=new Content();
$about=$cont->getPage($id);

?>

    <div class="footer-info" style="margin-top:0px;">
      <div class="container">
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <h6>ABOUT US</h6>         
           <?php echo substr($about[0]['content'],0,250);  ?>..<br>
            <br>
      
          </div>
          <div class="col-md-3 col-sm-6">
            <h6>Quick links</h6>      
            <ul class="list-5">
      <li ><a href="index.php">Home</a></li>
                    <li ><a href="about-us.php">About us</a></li>
                    <li><a href="disclaimer.php">Disclaimer</a></li>
         
                    <li><a href="contactus.php">Contact Us</a></li>
                    <li><a target="_blank" href="https://blog.uaedebtcollection.com/">Blog</a></li>
            </ul>
           
          </div>
          <div class="col-md-3 col-sm-6">
            <h6>CONTACT INFO</h6>
           <?php echo $contact[0]['company'];  ?><br>
             <?php echo $contact[0]['city'];  ?>,<?php echo $contact[0]['state'];  ?>,<?php echo $contact[0]['country'];  ?><br>
            <br>
         
           <div class="item-icon">
              <i class="fa fa-phone"></i>
            <a href="https://api.whatsapp.com/send?phone=<?php echo $contact[0]['telephone'];  ?>&text=Hi Uaedebtcollection, I have a query?" target="_blank"> <?php echo $contact[0]['telephone'];  ?></a><br>
            </div> 
            <div class="item-icon">
              <i class="fa fa-envelope"></i>
              <a href="mailto:<?php echo $contact[0]['email'];  ?>"><?php echo $contact[0]['email'];  ?></a><br>
            </div>
            <!-- <div class="item-icon">
              <i class="fa fa-fax"></i>
            <?php echo $contact[0]['fax'];  ?><br>
            </div> -->
          
          </div>
          <div class="col-md-3 col-sm-6">
            <h6>Newsletter</h6>
  <form role="form"   action="newsletter.php" method="post" class="contact-form">
 <div class="row"> 
    <div class="form-group col-sm-12">
              <label for="name2"></label>
            <input  class="form-control"  name="email"  type="text"   placeholder="E-mail">
              
            </div>

 </div>
<div class="row">
             <div class="form-group col-sm-12">
  <input type="submit" class="btn btn-primary" id="send" name="submit" value="Submit">
                </div>
 </div>

</form>


          </div>
        </div>
      </div>
    </div>

    <div class="copyright"> 
      <div class="container">  
        <div class="row">
          <div class="col-md-4 col-sm-4">
            <div  class="logo-footer">  
   
            </div>     
          </div>  
          <div class="col-md-8 col-sm-8">
            <div class="copyright-info">
                       <?php echo $contact[0]['footer'];  ?> 
            </div>
          </div>  
        </div> 
      </div>  
    </div>
    
  </footer>  
<!-- WhatsHelp.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "+971505186836", // WhatsApp number
            call_to_action: "Chat with us?", // Call to action
            position: "left", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /WhatsHelp.io widget -->
  <script type="text/javascript">stLight.options({publisher: "28402ac8-2eb4-451f-9028-2107ae14408b", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script>
var options={ "publisher": "28402ac8-2eb4-451f-9028-2107ae14408b", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "linkedin", "pinterest", "email", "sharethis"]}};
var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var $_Tawk_API={},$_Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/54e9f7fbb37d8bc7b154d219/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
// <script>(function(v,p){
// var s=document.createElement('script');
// s.src='https://app.toky.co/resources/widgets/toky-widget.min.js?v='+v;
// s.onload=function(){Toky.load(p);};
// document.head.appendChild(s);
// })('6b50f388f', {"$username":"UAEDebt","$bubble":false,"$position":"left","$text":"Call us for free!"})
// </script>
<!--End of Tawk.to Script-->
  <!-- Internet Explorer condition - HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <script type="text/javascript">var switchTo5x=true;</script>
  <!-- <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
  <script type="text/javascript" src="http://s.sharethis.com/loader.js"></script> -->
  <script src="js/modernizr.js"></script>
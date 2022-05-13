   <?php
$bn=new Bannerpage();
$banners=$bn-> getl();
$cont=new Contacts();
$record=$cont->getbanSettings();


   ?>    <!-- LayerSlider -->    
    <div id="layerslider-container">
					<img src="uploads/<?php echo $banners[0]['image']; ?>" class="ls-bg" alt="">					

		</div>
		
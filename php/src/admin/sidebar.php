			<div class="sidebar" id="sidebar">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-small btn-success">
							<i class="icon-signal"></i>
						</button>

						<button class="btn btn-small btn-info">
							<i class="icon-pencil"></i>
						</button>

						<button class="btn btn-small btn-warning">
							<i class="icon-group"></i>
						</button>

						<button class="btn btn-small btn-danger">
							<i class="icon-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- #sidebar-shortcuts -->
				<?php


function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

}

$currentpage=curPageName();

				?>

				<ul class="nav nav-list">
					<li <?php if($currentpage=='home.php'){  ?>class="active" <?php } ?>>
						<a href="home.php">
							<i class="icon-home"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
					</li>

<li <?php if($currentpage=='page-content.php' || $currentpage=='page-create.php' || $currentpage=='page-update.php'){  ?>class="active" <?php } ?>>
						<a href="page-content.php">
							<i class="icon-gift"></i>
							<span class="menu-text"> CMS Pages </span>
						</a>
					</li>

	<li <?php if($currentpage=='productlist.php' || $currentpage=='addproduct.php' || $currentpage=='editproduct.php'){  ?>class="active" <?php } ?>>
						<a href="productlist.php">
							<i class="icon-gift"></i>
							<span class="menu-text"> Products </span>
						</a>
					</li>

	<li <?php if($currentpage=='debtlist.php' ||  $currentpage=='viewdebt.php'){  ?>class="active" <?php } ?>>
						<a href="debtlist.php">
							<i class="icon-gift"></i>
							<span class="menu-text"> Debt Enquirys </span>
						</a>
					</li>
	<li <?php if($currentpage=='partnerlist.php'){  ?>class="active" <?php } ?>>
						<a href="partnerlist.php">
							<i class="icon-gift"></i>
							<span class="menu-text"> Partners</span>
						</a>
					</li>
	<li <?php if($currentpage=='albumlisting.php' || $currentpage=='addalbum.php' || $currentpage=='editalbum.php' || $currentpage=='imagelisting.php' || $currentpage=='addphoto.php' || $currentpage=='editphoto.php'){  ?> class="active" <?php } ?>>
						<a href="albumlisting.php">
							<i class="icon-camera"></i>
							<span class="menu-text">Albums </span>
														<b class="arrow icon-angle-down"></b>

						</a>
<ul class="submenu">
							<li <?php if($currentpage=='addalbum.php'){  ?> class="active" <?php } ?>>
								<a href="addalbum.php">
									<i class="icon-double-angle-right"></i>
Add Album								</a>
							</li>
</ul>


					</li>

					<li <?php if($currentpage=='bannerlisting.php'){  ?> class="active" <?php } ?>>
						<a href="bannerlisting.php">
							<i class="icon-camera"></i>
							<span class="menu-text"> Banners </span>
						</a>
					</li>
<li <?php if($currentpage=='bannersettings.php'){  ?> class="active" <?php } ?>>
						<a href="bannersettings.php">
							<i class="icon-globe"></i>
							<span class="menu-text">Banner Settings</span>
						</a>
					</li>	

<li <?php if($currentpage=='contact.php'){  ?> class="active" <?php } ?>>
						<a href="contact.php">
							<i class="icon-globe"></i>
							<span class="menu-text"> Contact Us </span>
						</a>
					</li>		

<li <?php if($currentpage=='seo.php'){  ?> class="active" <?php } ?>>
						<a href="seo.php">
							<i class="icon-globe"></i>
							<span class="menu-text"> SEO & Footer </span>
						</a>
					</li>		


				<li <?php if($currentpage=='account.php'){  ?>class="active" <?php } ?>>
						<a href="account.php">
							<i class="icon-key"></i>
							<span class="menu-text"> Settings </span>
						</a>
					</li>		
<li <?php if($currentpage=='loglist.php'){  ?>class="active" <?php } ?>>
						<a href="loglist.php">
							<i class="icon-key"></i>
							<span class="menu-text"> Log </span>
						</a>
					</li>	
						

					<li <?php if($currentpage=='logout.php'){  ?>class="active" <?php } ?>>
						<a href="logout.php">
							<i class="icon-off"></i>
							<span class="menu-text"> Logout </span>
						</a>
					</li>

			

				


	
				</ul><!-- /.nav-list -->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>
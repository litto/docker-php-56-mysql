<?php

include("db.php");



?><!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="utf-8" />

		<title>Dashboard - Admin Panel</title>



		<meta name="description" content="overview &amp; stats" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />



<?php include("script.php");  ?>

	</head>



	<body>

<?php include("topheader.php");  ?>



		<div class="main-container container-fluid">

			<a class="menu-toggler" id="menu-toggler" href="#">

				<span class="menu-text"></span>

			</a>



<?php include("sidebar.php"); ?>



			<div class="main-content">

				<div class="breadcrumbs" id="breadcrumbs">

					<script type="text/javascript">

						try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}

					</script>



					<ul class="breadcrumb">

						<li>

							<i class="icon-home home-icon"></i>

							<a href="home.php">Home</a>



							<span class="divider">

								<i class="icon-angle-right arrow-icon"></i>

							</span>

						</li>

						<li class="active">Dashboard</li>

					</ul><!-- .breadcrumb -->



					<div class="nav-search" id="nav-search">

					

					</div><!-- #nav-search -->

				</div>



				<div class="page-content">

					<div class="page-header position-relative">

						<h1>

							Dashboard

						

						</h1>

					</div><!-- /.page-header -->



					<div class="row-fluid">

						<div class="span12">

							<!-- PAGE CONTENT BEGINS -->




<?php
$loggedadmin=$_SESSION['loggedUser'];
$obj    =   new Auth();
$admin  =   $obj->getLoggedInfo();

?>

							<div class="space-6"></div>
<div class="row-fluid">
		

											<div class="space-4"></div>
											<div class="width-80 label label-info label-large arrowed-in arrowed-in-right">
												<div class="inline position-relative">
													<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
														<i class="icon-circle light-green middle"></i>
														&nbsp;
														<span class="white middle bigger-120">Welcome <?php echo strtoupper($admin[0]['name']);  ?></span>
													</a>

										
												</div>
											</div>
															<div class="space-6"></div>

						
																	<div class="profile-user-info profile-user-info-striped">
											<div class="profile-info-row">
												<div class="profile-info-name"> Username </div>

												<div class="profile-info-value">
													<span class="editable" id="username"><?php echo $admin[0]['username']; ?></span>
												</div>
											</div>

							

											<div class="profile-info-row">
												<div class="profile-info-name"> Email </div>

												<div class="profile-info-value">
													<span class="editable" id="age"><?php  echo $admin[0]['email']; ?></span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Last Login </div>

												<div class="profile-info-value">
													<span class="editable" id="signup"><?php echo $admin[0]['date_create'];  ?></span>
												</div>
											</div>

<div class="profile-info-row">
												<div class="profile-info-name"> Login Ip </div>

												<div class="profile-info-value">
													<span class="editable" id="signup"><?php echo $ip=$admin[0]['ip'];  ?></span>
												</div>
											</div>

<?php
$dt=$obj->geoCheckIP($ip);
?>

<div class="profile-info-row">
												<div class="profile-info-name"> Login Country</div>

												<div class="profile-info-value">
													<span class="editable" id="signup"><?php echo $dt['country'];  ?></span>
												</div>
											</div>


<div class="profile-info-row">
												<div class="profile-info-name"> Browser </div>

												<div class="profile-info-value">
													<span class="editable" id="signup"><?php echo $admin[0]['browser'];  ?></span>
												</div>
											</div>

											
										
										</div>
										</div>

										
							<div class="space-6"></div>
                            	<div class="space-6"></div>
							<div class="row-fluid">



								<div class="span9 infobox-container">





									<div class="infobox infobox-red  ">

									<div class="infobox-icon">

											<i class="icon-gift"></i>

										</div>



										<div class="infobox-data">

											<span class="infobox-data-number"></span>

											<div class="infobox-content"><a href="productlist.php">Products</a></div>

										</div>

									</div>



									<div class="infobox infobox-orange2  ">

									<div class="infobox-icon">

											<i class="icon-gift"></i>

										</div>



										<div class="infobox-data">

											<span class="infobox-data-number"></span>

											<div class="infobox-content"><a href="page-content.php">CMS pages</a></div>

										</div>



									

									</div>



									<div class="infobox infobox-blue2  ">

									<div class="infobox-icon">

											<i class="icon-gift"></i>

										</div>



										<div class="infobox-data">

											<span class="infobox-text"></span>



											<div class="infobox-content">

												<span class="bigger-110"></span>

												<a href="bannerlisting.php">Banners</a>

											</div>

										</div>

									</div>

					<div class="infobox infobox-green">

										<div class="infobox-icon">

											<i class="icon-camera"></i>

										</div>



										<div class="infobox-data">

											<span class="infobox-data-number"></span>

											<div class="infobox-content"><a href="albumlisting.php">Albums</a></div>

										</div>

										

									</div>







                                  <div class="infobox infobox-green">

										<div class="infobox-icon">

										<i class="icon-envelope"></i>

										</div>



										<div class="infobox-data">

											<span class="infobox-data-number"></span>

										<div class="infobox-content">

												<span class="bigger-110"></span>

												<a href="debtlist.php">Enquiries</a>

											</div>

										</div>

										

									</div>




		<div class="infobox infobox-red">

									<div class="infobox-icon">

											<i class="icon-envelope"></i>

										</div>



										<div class="infobox-data">

											<span class="infobox-data-number"></span>

												<div class="infobox-content">

												<span class="bigger-110"></span>

												<a href="loglist.php">Log</a>

											</div>

										</div>

									</div>





								</div>



								<div class="vspace"></div>



								<div class="span5">

							

								</div><!-- /span -->

							</div><!-- /row -->





							<div class="row-fluid">





					

							</div><!-- /row -->



							<!-- PAGE CONTENT ENDS -->

						</div><!-- /.span -->

					</div><!-- /.row-fluid -->

				</div><!-- /.page-content -->





			</div><!-- /.main-content -->

		</div><!-- /.main-container -->



		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">

			<i class="icon-double-angle-up icon-only bigger-110"></i>

		</a>



		<!-- basic scripts -->



		<?php include("footerscript.php");  ?>

		<script src="assets/js/ace.min.js"></script>

		<?php include("pagescript.php");  ?>

	</body>

</html>


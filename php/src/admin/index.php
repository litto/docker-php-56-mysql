<?php
ob_start();
session_start();
include("autoload.php");
$db     =   new MySql();
$db->connect();


?>

<?php

//Already logged user, go to home page
if(isset($_SESSION["loggedUser"])){
    header("Location:home.php");
    exit;
}


/*
 * Get cookie values and fillout username/password fields
*/
$msg                =   null;
$saveLogin  =   $_COOKIE["saveLogin"];
$loginKey       =   $_COOKIE["loginKey"];
$cookieUser =   $_COOKIE["adminusername"];
$cookiePass =   $_COOKIE["adminpassword"];

if($saveLogin==1 && !empty($loginKey)){
    $crypt = new Crypt; 
    $crypt->crypt_key($loginKey);                       // Get encryption key
    $username = $crypt->decrypt($cookieUser);   // Get username
    $password = $crypt->decrypt($cookiePass);   // Get Password 
}else{
    $username = ""; // Get username
    $password = ""; // Get Password 
}

/*
 * Get Error messages on login failure
*/
$error  =   $_GET["error"];
if($error==1){
    $msg    =   "Enter all mandatory fields !";
}else if($error==2){
    $msg    =   "Invalid username / password ";
}




?>



<!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="utf-8" />

		<title> Admin-Login</title>



		<meta name="description" content="Admin login page" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />



		<!-- basic styles -->


<?php include("indexscript.php");  ?>



	</head>



	<body class="login-layout">

		<div class="main-container container-fluid">

			<div class="main-content">

				<div class="row-fluid">

					<div class="span12">

						<div class="login-container">

							<div class="row-fluid">

								<div class="center">

									<h1>

										

										<span class="red">Proxy</span>

										<span class="white">Media</span>

									</h1>

									<h4 class="blue">Admin Panel</h4>

								</div>

							</div>



							<div class="space-6"></div>



							<div class="row-fluid">

								<div class="position-relative">

									<div id="login-box" class="login-box visible widget-box no-border">

										<div class="widget-body">

											<div class="widget-main">

												<h4 class="header blue lighter bigger">

													

													Login Here

												</h4>



												<div class="space-6"></div>



											<form name="login" method="post" enctype="multipart/form-data" action="login.php">

													<fieldset>



														

	<label>



															

															<span class="block input-icon input-icon-right">

															



															<?php if(isset($msg)) { ?>

	                                      <div class='alert alert-danger'><?php echo $msg; ?></div>



	                                                     <?php } ?>

															</span>

														</label>





														<label>

                                                      <span class="block input-icon input-icon-right">

																<input type="text" class="span12" placeholder="Username" name="txtUsername" value="<?php echo $user;?>"  />

																<i class="icon-user"></i>

															</span>

														</label>



														<label>

															<span class="block input-icon input-icon-right">

																<input type="password" class="span12" placeholder="Password" name="txtPassword" value="<?php echo $password; ?>"/>

																<i class="icon-lock"></i>

															</span>

														</label>



														<div class="space"></div>



														<div class="clearfix">

															<label class="inline">

																<input type="checkbox" class="ace" name="chkRemember" value="1"   <?php if($saveLogin==1){?> checked="checked"<?php }?>/>

																<span class="lbl"> Remember Me</span>

															</label>



															<input type="submit" name="submitLogin" value="Login"  class="width-35 pull-right btn btn-small btn-primary">

															

														</div>



														<div class="space-4"></div>

													</fieldset>

												</form>



								

											</div><!-- /widget-main -->



											<div class="toolbar clearfix">

												<div>

													<a href="forgetpassword.php"  class="forgot-password-link">

														

														I forgot my password

													</a>

												</div>



												<div>

													
												</div>

											</div>

										</div><!-- /widget-body -->

									</div><!-- /login-box -->



		

				

								</div><!-- /position-relative -->

							</div>

						</div>

					</div><!-- /.span -->

				</div><!-- /.row-fluid -->

			</div>

		</div><!-- /.main-container -->



		<!-- basic scripts -->



		<?php include("footerindexscript.php");  ?>

	</body>

</html>


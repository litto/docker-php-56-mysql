<?php
include("session.php");

?>		<div class="navbar" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-inner">
				<div class="container-fluid"><a href="#" class="brand"><small>Admin Panel</small></a>
												<ul class="nav ace-nav pull-right">
						<li class="grey">
							<a  class="dropdown-toggle" href="#" title="Sign Up">
								<i class="icon-user"></i>
								
							</a>
                      </li>
						

<li class="grey">
							<a  class="dropdown-toggle" href="#" title="Login">
								<i class="icon-key"></i>
								&nbsp;
							</a>
</li>


						<li class="grey">
							<a  class="dropdown-toggle" href="#" title="Site Search">
								<i class="icon-search"></i>
								
							</a></li>

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/avatars/avatar5.png" width="36px" height="36px" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
								<?php  echo $_SESSION['loggedName']; ?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
							

								<li>
									<a href="settings.php" target="_blank">
										<i class="icon-user"></i>
										Settings
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="logout.php">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.container-fluid -->
			</div><!-- /.navbar-inner -->
		</div>
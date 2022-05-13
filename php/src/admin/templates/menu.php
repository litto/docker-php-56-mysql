<!DOCTYPE HTML>
<html lang="en">

<meta charset="utf-8">

<link rel="stylesheet" href="<?php echo _BASE_URL; ?>templates/css/style.css">
<!--[if lte IE 8]>
<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script>
var _BASE_URL = '<?php echo _BASE_URL; ?>';
var current_group_id = <?php echo $group_id; ?>;
</script>
<script src="<?php echo _BASE_URL; ?>templates/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo _BASE_URL; ?>templates/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo _BASE_URL; ?>templates/js/jquery.mjs.nestedSortable.js"></script>
<script src="<?php echo _BASE_URL; ?>templates/js/menu.js"></script>

</head>
<body>
	<div id="wrapper">
		<header>
			<h1><a href="<?php echo site_url(); ?>">Category Manager</a></h1>
		<?php
$id=1;

		?>
		</header>
		<div id="content">
			<div id="main">
				<ul id="menu-group">
				
					<li id="group-<?php echo $id; ?>">
						<a href="<?php echo site_url('menu&amp;group_id=' . $id); ?>">
						Categories
						</a>
					</li>
				
					
				</ul>
				<div class="clear"></div>

				<form method="post" id="form-menu" action="<?php echo site_url('menu.save_position'); ?>">
					<div class="ns-row" id="ns-header">
						<div class="ns-actions">Actions</div>
					
						<div class="ns-title">Title</div>
					</div>
					<?php echo $menu_ul; ?>
					<div id="ns-footer">
						<button type="submit" class="button green small" id="btn-save-menu">Save Menu</button>
					</div>
				</form>
			</div>
			<aside>
		
		

			</aside>
			<div class="clear"></div>
		</div>
		
	</div>
	<div id="loading">
		<img src="<?php echo _BASE_URL; ?>templates/images/ajax-loader.gif" alt="Loading">
		Processing...
	</div>
</body>
</html>
<?php
include("db.php");
$id=$_GET['id'];
$gl=new Image();
$photos=$gl->getalbumimages($id);
$totalRecords=count($photos);

$prd=new Album();
$albumdet=$prd->getalbumdetails($id);
?>
<?php

if(isset($_POST['unpublish'])){

$id=$_POST['id'];
    $cnt    =   $_POST['count'];
  
    $list   =   array();
    for($i=0;$i<$cnt;$i++){
        if(isset($_POST['chkId'.$i])){
            $list[] =   $_POST['chkId'.$i];
        }
    }
    if(count($list)>0){
        $obj    =   new Image();
        $obj->unpublishList($list);
        $message    =   new Message('Selected items were unpublished ','message');
        $message->setMessage(); 
    }else{
            $message    =   new Message('No items selected','error');
            $message->setMessage();     
    }
    header("Location:imagelisting.php?id=$id");
    exit;
}
/*
 * Publish Seleted list of items
*/
if(isset($_POST['publish'])){
	$id=$_POST['id'];
    $cnt    =   $_POST['count'];
    $list   =   array();
    for($i=0;$i<$cnt;$i++){
        if(isset($_POST['chkId'.$i])){
            $list[] =   $_POST['chkId'.$i];
        }
    }
    if(count($list)>0){
        $obj    =   new Image();
        $obj->publishList($list);
        $message    =   new Message('Selected items were published ','message');
        $message->setMessage(); 
    }else{
            $message    =   new Message('No items selected','error');
            $message->setMessage();     
    }
    header("Location:imagelisting.php?id=$id");
    exit;
}

if(isset($_POST['delete'])){
	$id=$_POST['id'];
    $cnt    =   $_POST['count'];
    $list   =   array();
    for($i=0;$i<$cnt;$i++){
        if(isset($_POST['chkId'.$i])){
            $list[] =   $_POST['chkId'.$i];
        }
    }
    if(count($list)>0){
        $obj    =   new Image();
        $obj->deleteList($list);
        $message    =   new Message('Selected items deleted ','message');
        $message->setMessage(); 
    }else{
            $message    =   new Message('No items selected','error');
            $message->setMessage();     
    }
    header("Location:imagelisting.php?id=$id");
    exit;
    
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>WYDEINFO.com| Gallery| Photo Gallery</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

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
							<a href="#">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li>
							<a href="albumlisting.php">Albums</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						
						<li class="active">Photos</li>
					</ul><!-- .breadcrumb -->

					<div class="nav-search" id="nav-search">
					
					</div><!-- #nav-search -->
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
<?php echo $albumdet[0]['album_title'];  ?>							
						</h1>
					</div><!-- /.page-header -->

					<div class="row-fluid">
						<div class="span12">
							<!-- PAGE CONTENT BEGINS -->
	

							<div class="space-6"></div>

 <form name="companysearch" method="post" enctype="multipart/form-data" action="imagelisting.php?id=<?php echo $id; ?>">
 	<input type="hidden" name="id"  value="<?php echo $id;?>" />

							<div class="row-fluid">
<input type="hidden" name="count" id="count" value="<?php echo $totalRecords;?>" />

<div class="span5"> 	<input type="checkbox" onclick="checkAll(this);"/> <b>Select All</b>					<?php

							 $message  =   new Message('','');
                    $message->showMessage();
        ?></div>
								<div class="span5">
									
										<a   href="addphoto.php?albumid=<?php echo $id; ?>" class="btn btn-app btn-primary btn-small" >
										<i class="icon-edit bigger-200"></i>
										Add
										
									</a>
	<button class="btn btn-app btn-success btn-small" type="submit" name="publish">
										<i class="icon-eye-open bigger-200"></i>
										Publish
									</button>

									<button class="btn btn-app btn-pink btn-small" type="submit" name="unpublish">
										<i class=" icon-eye-close bigger-200"></i>
										Unpublish
									</button>
								
								
										<button class="btn btn-app btn-danger btn-small" type="submit" name="delete">
										<i class="icon-trash bigger-200"></i>
										Delete
									</button>


                            	
								</div>
			 </div>

			<div class="row-fluid">

				<?php if(count($photos)>0){   ?>
								<ul class="ace-thumbnails">
									<?php for($i=0;$i<count($photos);$i++){   ?>
									<li style="width:150px; height:150px">
										<input type="checkbox"  name="chkId<?php echo $i;?>" id="chkId<?php echo $i;?>" value="<?php echo $photos[$i]['image_id'];?>" />
										<a href="" title="<?php echo $photos[$i]['image_title']; ?>" >
											<img alt="<?php echo $photos[$i]['image_title']; ?>" src="thumb.php?file=../uploads/<?php echo $photos[$i]['image_loc']; ?>&size=150px" width="150px" height="150px" />
											<div class="tags">
												<span class="label label-info"><?php echo $photos[$i]['image_title']; ?></span>
												<?php if($photos[$i]['status']==0) {?>
											<span class="label label-important">Unpublished</span>
											<?php }else{  ?>
												<span class="label label-success">Published</span>
												<?php } ?>
											
											</div>
										</a>
<input type="hidden" name="id<?php echo $i;?>" value="<?php echo $photos[$i]['image_id'];?>" />
										<div class="tools">
											<a href="../uploads/<?php echo $photos[$i]['image_loc']; ?>" data-rel="colorbox">
												<i class="icon-zoom-in"></i>
											</a>


											<a href="editphoto.php?id=<?php echo $photos[$i]['image_id']; ?>&albumid=<?php echo $id; ?>">
												<i class="icon-pencil"></i>
											</a>

											<a title="Delete" href="#" id="id-btn-dialog<?php echo $photos[$i]['image_id']; ?>">
												<i class="icon-remove red"></i>
											</a>
											
												<a title="Publish" href="#" id="id-btn-publish<?php echo $photos[$i]['image_id']; ?>">
												<i class="icon-eye-open green"></i>
											</a>
														<a title="UnPublish" href="#" id="id-btn-unpublish<?php echo $photos[$i]['image_id']; ?>">
												<i class="icon-eye-close red"></i>
											</a>

										</div>
									</li>

<?php } ?>
								</ul></form>

<?php } else{  ?>


<div class="row-fluid"> 
<div class="span12"> 

<div class="alert alert-block alert-success">

								Sorry...No Photos added yet

							</div>

</div>

</div>



<?php } ?>
		<div id="dialog-confirm" class="hide">
										<div class="alert alert-info bigger-110">
											These item will be permanently deleted and cannot be recovered.
										</div>

										<div class="space-6"></div>

										<p class="bigger-110 bolder center grey">
											<i class="icon-hand-right blue bigger-120"></i>
											Are you sure?
										</p>
									</div><!-- #dialog-confirm -->
										<div id="unpublish-confirm" class="hide">
										<div class="alert alert-info bigger-110">
											These item will be Unpublished.
										</div>

										<div class="space-6"></div>

										<p class="bigger-110 bolder center grey">
											<i class="icon-hand-right blue bigger-120"></i>
											Are you sure?
										</p>
									</div><!-- #dialog-confirm -->


			<div id="publish-confirm" class="hide">
										<div class="alert alert-info bigger-110">
											These item will be Published.
										</div>

										<div class="space-6"></div>

										<p class="bigger-110 bolder center grey">
											<i class="icon-hand-right blue bigger-120"></i>
											Are you sure?
										</p>
									</div><!-- #dialog-confirm -->
							</div><!-- PAGE CONTENT ENDS -->


							<div class="row-fluid">

<div class="article"> </div>
					
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

	<?php  include("footerscript.php");  ?>
<script src="assets/js/ace.min.js"></script>
		<!-- inline scripts related to this page -->
<script src="util.js" type="text/javascript"></script>

		<script type="text/javascript">
			jQuery(function($) {
	var colorbox_params = {
		reposition:true,
		scalePhotos:true,
		scrolling:false,
		previous:'<i class="icon-arrow-left"></i>',
		next:'<i class="icon-arrow-right"></i>',
		close:'&times;',
		current:'{current} of {total}',
		maxWidth:'100%',
		maxHeight:'100%',
		onOpen:function(){
			document.body.style.overflow = 'hidden';
		},
		onClosed:function(){
			document.body.style.overflow = 'auto';
		},
		onComplete:function(){
			$.colorbox.resize();
		}
	};

	$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
	$("#cboxLoadingGraphic").append("<i class='icon-spinner orange'></i>");//let's add a custom loading icon

	/**$(window).on('resize.colorbox', function() {
		try {
			//this function has been changed in recent versions of colorbox, so it won't work
			$.fn.colorbox.load();//to redraw the current frame
		} catch(e){}
	});*/
})
		</script>
		<script type="text/javascript">


		jQuery(function($) {
			
				$( "#datepicker" ).datepicker({
					showOtherMonths: true,
					selectOtherMonths: false,
					//isRTL:true,
			
					/**
					,
					changeMonth: true,
					changeYear: true,
					
					showButtonPanel: true,
					beforeShow: function() {
						//change button colors
						var datepicker = $(this).datepicker( "widget" );
						setTimeout(function(){
							var buttons = datepicker.find('.ui-datepicker-buttonpane')
							.find('button');
							buttons.eq(0).addClass('btn btn-mini');
							buttons.eq(1).addClass('btn btn-mini btn-success');
							buttons.wrapInner('<span class="bigger-110" />');
						}, 0);
					}
					*/
				});
			
			
				//override dialog's title function to allow for HTML titles
				$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
					_title: function(title) {
						var $title = this.options.title || '&nbsp;'
						if( ("title_html" in this.options) && this.options.title_html == true )
							title.html($title);
						else title.text($title);
					}
				}));
			
				$( "#id-btn-dialog1" ).on('click', function(e) {
					e.preventDefault();
			
					var dialog = $( "#dialog-message" ).dialog({
						modal: true,
						title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='icon-ok'></i> jQuery UI Dialog</h4></div>",
						title_html: true,
						buttons: [ 
							{
								text: "Cancel",
								"class" : "btn btn-mini",
								click: function() {
									$( this ).dialog( "close" ); 
								} 
							},
							{
								text: "OK",
								"class" : "btn btn-primary btn-mini",
								click: function() {
									$( this ).dialog( "close" ); 
								} 
							}
						]
					});
			
					/**
					dialog.data( "uiDialog" )._title = function(title) {
						title.html( this.options.title );
					};
					**/
				});
			
			<?php  for($i=0;$i<count($photos);$i++){           ?>
				$( "#id-btn-dialog<?php echo $photos[$i]['image_id']; ?>" ).on('click', function(e) {
					e.preventDefault();
				
					$( "#dialog-confirm" ).dialog({
						resizable: false,
						modal: true,
						title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i>Delete Photo?</h4></div>",
						title_html: true,
						buttons: [
							{
								html: "<i class='icon-trash bigger-110'></i>&nbsp; Delete this item",
								"class" : "btn btn-danger btn-mini",
								click: function() {
									$('.article').load("del_photo.php?id="+<?php echo $photos[$i]['image_id'];  ?>);
									$( this ).dialog( "close" );
								}
							}
							,
							{
								html: "<i class='icon-remove bigger-110'></i>&nbsp; Cancel",
								"class" : "btn btn-mini",
								click: function() {
									$( this ).dialog( "close" );
								}
							}
						]
					});
				});
			
			
				<?php } ?>

										<?php  for($i=0;$i<count($photos);$i++){           ?>
				$( "#id-btn-unpublish<?php echo $photos[$i]['image_id']; ?>" ).on('click', function(e) {
					e.preventDefault();
				
					$( "#unpublish-confirm" ).dialog({
						resizable: false,
						modal: true,
						title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i>UnPublish Photo?</h4></div>",
						title_html: true,
						buttons: [
							{
								html: "<i class='icon-trash bigger-110'></i>&nbsp; UnPublish",
								"class" : "btn btn-danger btn-mini",
								click: function() {
									$('.article').load("unpublish_photo.php?id="+<?php echo $photos[$i]['image_id'];  ?>);
									$( this ).dialog( "close" );
								}
							}
							,
							{
								html: "<i class='icon-remove bigger-110'></i>&nbsp; Cancel",
								"class" : "btn btn-mini",
								click: function() {
									$( this ).dialog( "close" );
								}
							}
						]
					});
				});
			
			
				<?php } ?>

				<?php  for($i=0;$i<count($photos);$i++){           ?>
				$( "#id-btn-publish<?php echo $photos[$i]['image_id']; ?>" ).on('click', function(e) {
					e.preventDefault();
				
					$( "#publish-confirm" ).dialog({
						resizable: false,
						modal: true,
						title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i>Publish Photo?</h4></div>",
						title_html: true,
						buttons: [
							{
								html: "<i class='icon-trash bigger-110'></i>&nbsp; Publish",
								"class" : "btn btn-danger btn-mini",
								click: function() {
									$('.article').load("publish_photo.php?id="+<?php echo $photos[$i]['image_id'];  ?>);
									$( this ).dialog( "close" );
								}
							}
							,
							{
								html: "<i class='icon-remove bigger-110'></i>&nbsp; Cancel",
								"class" : "btn btn-mini",
								click: function() {
									$( this ).dialog( "close" );
								}
							}
						]
					});
				});
			
			
				<?php } ?>

				//autocomplete
				 var availableTags = [
					"ActionScript",
					"AppleScript",
					"Asp",
					"BASIC",
					"C",
					"C++",
					"Clojure",
					"COBOL",
					"ColdFusion",
					"Erlang",
					"Fortran",
					"Groovy",
					"Haskell",
					"Java",
					"JavaScript",
					"Lisp",
					"Perl",
					"PHP",
					"Python",
					"Ruby",
					"Scala",
					"Scheme"
				];
				$( "#tags" ).autocomplete({
					source: availableTags
				});
			
				//custom autocomplete (category selection)
				$.widget( "custom.catcomplete", $.ui.autocomplete, {
					_renderMenu: function( ul, items ) {
						var that = this,
						currentCategory = "";
						$.each( items, function( index, item ) {
							if ( item.category != currentCategory ) {
								ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
								currentCategory = item.category;
							}
							that._renderItemData( ul, item );
						});
					}
				});
				
				 var data = [
					{ label: "anders", category: "" },
					{ label: "andreas", category: "" },
					{ label: "antal", category: "" },
					{ label: "annhhx10", category: "Products" },
					{ label: "annk K12", category: "Products" },
					{ label: "annttop C13", category: "Products" },
					{ label: "anders andersson", category: "People" },
					{ label: "andreas andersson", category: "People" },
					{ label: "andreas johnson", category: "People" }
				];
				$( "#search" ).catcomplete({
					delay: 0,
					source: data
				});
				
				
				//tooltips
				$( "#show-option" ).tooltip({
					show: {
						effect: "slideDown",
						delay: 250
					}
				});
			
				$( "#hide-option" ).tooltip({
					hide: {
						effect: "explode",
						delay: 250
					}
				});
			
				$( "#open-event" ).tooltip({
					show: null,
					position: {
						my: "left top",
						at: "left bottom"
					},
					open: function( event, ui ) {
						ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
					}
				});
			
			
				//Menu
				$( "#menu" ).menu();
			
			
				//spinner
				var spinner = $( "#spinner" ).spinner({
					create: function( event, ui ) {
						//add custom classes and icons
						$(this)
						.next().addClass('btn btn-success').html('<i class="icon-plus"></i>')
						.next().addClass('btn btn-danger').html('<i class="icon-minus"></i>')
						
						//larger buttons on touch devices
						if(ace.click_event == "tap") $(this).closest('.ui-spinner').addClass('ui-spinner-touch');
					}
				});
			
				//slider example
				$( "#slider" ).slider({
					range: true,
					min: 0,
					max: 500,
					values: [ 75, 300 ]
				});
			
			
			
				//jquery accordion
				$( "#accordion" ).accordion({
					collapsible: true ,
					heightStyle: "content",
					animate: 250,
					header: ".accordion-header"
				}).sortable({
					axis: "y",
					handle: ".accordion-header",
					stop: function( event, ui ) {
						// IE doesn't register the blur when sorting
						// so trigger focusout handlers to remove .ui-state-focus
						ui.item.children( ".accordion-header" ).triggerHandler( "focusout" );
					}
				});
				//jquery tabs
				$( "#tabs" ).tabs();
				
				
				//progressbar
				$( "#progressbar" ).progressbar({
					value: 37,
					create: function( event, ui ) {
						$(this).addClass('progress progress-success progress-striped ')
							   .children(0).addClass('bar');
					}
				});
					
			});

</script>
	</body>
</html>

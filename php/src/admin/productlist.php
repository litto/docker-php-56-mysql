<?php

include("db.php");



?><!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="utf-8" />

		<title>Admin |Product Listings</title>



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

<?php

if(isset($_POST['unpublish'])){


    $cnt    =   $_POST['count'];
  
    $list   =   array();
    for($i=0;$i<$cnt;$i++){
        if(isset($_POST['chkId'.$i])){
            $list[] =   $_POST['chkId'.$i];
        }
    }
    if(count($list)>0){
        $obj    =   new Product();
        $obj->unpublishList($list);
        $message    =   new Message('Selected items were unpublished ','message');
        $message->setMessage(); 
    }else{
            $message    =   new Message('No items selected','error');
            $message->setMessage();     
    }
    header("Location:productlist.php?acttab=1");
    exit;
}
/*
 * Publish Seleted list of items
*/
if(isset($_POST['publish'])){
    $cnt    =   $_POST['count'];
    $list   =   array();
    for($i=0;$i<$cnt;$i++){
        if(isset($_POST['chkId'.$i])){
            $list[] =   $_POST['chkId'.$i];
        }
    }
    if(count($list)>0){
        $obj    =   new Product();
        $obj->publishList($list);
        $message    =   new Message('Selected items were published ','message');
        $message->setMessage(); 
    }else{
            $message    =   new Message('No items selected','error');
            $message->setMessage();     
    }
    header("Location:productlist.php?acttab=1");
    exit;
}
if(isset($_POST['publishphoto'])){
    $cnt    =   $_POST['count'];
    $list   =   array();
    for($i=0;$i<$cnt;$i++){
        if(isset($_POST['chkId'.$i])){
            $list[] =   $_POST['chkId'.$i];
        }
    }
    if(count($list)>0){
        $obj    =   new Product();
        $obj->publishphotoList($list);
        $message    =   new Message('Selected items were published ','message');
        $message->setMessage(); 
    }else{
            $message    =   new Message('No items selected','error');
            $message->setMessage();     
    }
    header("Location:productlist.php?acttab=1");
    exit;
}
if(isset($_POST['delete'])){
    $cnt    =   $_POST['count'];
    $list   =   array();
    for($i=0;$i<$cnt;$i++){
        if(isset($_POST['chkId'.$i])){
            $list[] =   $_POST['chkId'.$i];
        }
    }
    if(count($list)>0){
        $obj    =   new Product();
        $obj->deleteadminList($list);
        $message    =   new Message('Selected items deleted ','message');
        $message->setMessage(); 
    }else{
            $message    =   new Message('No items selected','error');
            $message->setMessage();     
    }
    header("Location:productlist.php?acttab=1");
    exit;
    
}

$msg    =   '';

$parent =   '';
$ord    =   '';
$mode   =   '';
$filter =   '';
$keyword='';
$searchcategory='';
$searchproduct='';
$searchemail='';
$searchbrand='';

if(isset($_POST['searchproduct'])){
	$searchproduct=$_POST['searchproduct'];
}else if(isset($_GET['searchproduct'])){
	$searchproduct=$_GET['searchproduct'];
}

if(isset($_POST['searchcategory'])){
	$searchcategory=$_POST['searchcategory'];
}else if(isset($_GET['searchcategory'])){
	$searchcategory=$_GET['searchcategory'];
}


if(isset($_POST['searchemail'])){
	$searchemail=$_POST['searchemail'];
}else if(isset($_GET['searchemail'])){
	$searchemail=$_GET['searchemail'];
}

if(isset($_POST['searchbrand'])){
	$searchbrand=$_POST['searchbrand'];
}else if(isset($_GET['searchbrand'])){
	$searchbrand=$_GET['searchbrand'];
}


if(isset($_GET['ord'])){
    $ord    =   $_GET['ord'];
}
if(isset($_GET['mode'])){
    $mode   =   $_GET['mode'];
}
if(isset($_POST['filter'])){
    $filter =   $_POST['filter'];
}else if(isset($_GET['filter'])){
    $filter =   $_GET['filter'];
}

$start  =   $_GET['start'];
$limit  =   10;
if(empty($start)){
    $start  =   0;
}

/*
 * Get results based on search conditions
*/
	
$values =   array('start'=>$start,'limit'=>$limit,"filter"=>$filter,"keyword"=>$keyword,"ord"=>$ord,"mode"=>$mode,'searchproduct'=>$searchproduct,'searchcategory'=>$searchcategory,'searchemail'=>$searchemail,'searchbrand'=>$searchbrand);

$obj    =   new Product();
$records    =   $obj->listallproducts($values);

 $totalRecords   =   $obj->totalRecords;
$pageRecords    =   $obj->pageRecords;



$cnt    =   $totalRecords/$limit;
$cnt    =   ceil($cnt);
$current    =   ($start/$limit)+1;  
 $count=round($totalRecords/$limit);
$pagenum=$start;
$pg =   new Pages();
$pages  =   $pg->getPages($current,$cnt,$limit);                    
$first  =   $pg->getFirst($cnt,$limit);
$last   =   $pg->getLast($cnt,$limit);
$prev   =   $pg->getPrev($current,$cnt,$limit);
$next   =   $pg->getNext($current,$cnt,$limit);


$filterList =   array('----All----'=>'','Featured'=>'featured','Archived'=>'archived');


?>






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

						<li class="active">Product Listings</li>

					</ul><!-- .breadcrumb -->



					<div class="nav-search" id="nav-search">

					

					</div><!-- #nav-search -->

				</div>



				<div class="page-content">

					<div class="page-header position-relative">

						<h1>

							Product Listings

						

						</h1>

					</div><!-- /.page-header -->



					<div class="row-fluid">

						<div class="span12">

							<!-- PAGE CONTENT BEGINS -->






							<div class="space-6"></div>



							<div class="row-fluid">
						<div class="span12">
							<!-- PAGE CONTENT BEGINS -->

							
				

								<div class="tab-content no-border padding-24">
								
										<div class="row-fluid">

<form name="companysearch" method="post" enctype="multipart/form-data" action="productlist.php">


<div class="span3">
<span class="input-icon">
	<input type="text" name="searchproduct" id="searchproduct" value="<?php echo $_REQUEST['searchproduct'];  ?>" placeholder="Enter product..." />

											
										</span>

</div>
<div class="span3">


</div>
<div class="span3">


</div>
<div class="span3">


</div>
<div class="span1"> <input type="submit" class="btn btn-small btn-info" value="Search" name="submit"></div>
</div>
<div class="row-fluid">
	<div class="span7">&nbsp;</div>
								<div class="span5">
									
										<a href="addproduct.php"  class="btn btn-app btn-primary btn-small">
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
										<div class="space-8"></div>

											<h3 class="header smaller lighter blue"></h3>
								<div class="table-header">
								Product Listings
								</div>
  <input type="hidden" name="count" id="count" value="<?php echo $pageRecords;?>" />
  <?php if($totalRecords > 0){ ?>
								<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th class="center">
												<label>
													<input type="checkbox" class="ace" onclick="checkAll(this);"/>
													<span class="lbl"></span>
												</label>
											</th>
											<th>Product Name</th>
											<th>Image</th>

<th class="hidden-480">Hits</th>
											<th class="hidden-phone">
												<i class="icon-time bigger-110 hidden-phone"></i>
												Status
											</th>
								
											<th class="hidden-480">Action</th>

											
										</tr>
									</thead>

									<tbody>
										 
<?php  for($i=0;$i<count($records);$i++){  ?>

										<tr>
											<td class="center">
												<label>
													<input type="checkbox" class="ace" name="chkId<?php echo $i;?>" id="chkId<?php echo $i;?>" value="<?php echo $records[$i]['id'];?>" />
													<span class="lbl"></span>
												</label>
											</td>
  <input type="hidden" name="id<?php echo $i;?>" value="<?php echo $records[$i]['id'];?>" />
											<td>
											<?php echo $records[$i]['name']; ?>
											</td>
											<td> <a href="../uploads/<?php echo $records[$i]['product_img']; ?>" title="<?php echo $records[$i]['name']; ?>" data-rel="colorbox"><img src="thumb.php?file=../uploads/<?php echo $records[$i]['product_img']; ?>&size=70"/></a></td>
											
<td class="hidden-480"><?php echo $records[$i]['viewcount']; ?></td>
											
											<td class="hidden-480">
												

<?php if($records[$i]['publish']==1){ ?>

<span class="label label-success">Published</span>
<?php }else if($records[$i]['publish']==0) {?>
<span class="label label-important ">Unpublished</span>
<?php } ?>




											</td>
				

											<td>
												<div class="hidden-phone visible-desktop action-buttons">
										
                                                   
													<a class="green" href="editproduct.php?id=<?php echo $records[$i]['id']; ?>" title="Edit" >
														<i class="icon-pencil bigger-130"></i>
													</a>

									
											

													<a class="red" href="#" title="Delete"  id="id-btn-dialog<?php echo $records[$i]['id']; ?>">
														<i class="icon-trash bigger-130"></i>
													</a>
                                            

														<a class="green" href="#" title="Publish" id="id-btn-publish<?php echo $records[$i]['id']; ?>">
														<i class="icon-eye-open bigger-130"></i>
													</a>
															<a class="red" href="#" title="Unpublish" id="id-btn-unpublish<?php echo $records[$i]['id']; ?>">
														<i class="icon-eye-close bigger-130"></i>
													</a>
												
												</div>

												<div class="hidden-desktop visible-phone">
													<div class="inline position-relative">
														<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
															<i class="icon-caret-down icon-only bigger-120"></i>
														</button>

														<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
												
 
															<li>
																<a href="editproduct.php?id=<?php echo $records[$i]['id']; ?>" class="tooltip-success" data-rel="tooltip" title="Edit" >
																	<span class="green">
																		<i class="icon-edit bigger-120"></i>
																	</span>
																</a>
															</li>

															<li>
																<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete" id="id-btn-dialog<?php echo $records[$i]['id']; ?>">
																	<span class="red">
																		<i class="icon-trash bigger-120"></i>
																	</span>
																</a>
															</li>
														
                                                    	<li>
																<a href="#" class="tooltip-success" data-rel="tooltip" title="Publish" id="id-btn-publish<?php echo $records[$i]['id']; ?>">
																	<span class="green">
																		<i class="icon-eye-open bigger-120"></i>
																	</span>
																</a>
															</li>
                                                         	<li>
																<a href="#" class="tooltip-error" data-rel="tooltip" title="Unpublish" id="id-btn-unpublish<?php echo $records[$i]['id']; ?>">
																	<span class="red">
																		<i class="icon-eye-close bigger-120"></i>
																	</span>
																</a>
															</li>
  <?php } ?>
														</ul>
													</div>
												</div>
											</td>
										</tr>

		</form>
									</tbody>
								</table>
															<div class="modal-footer">
								

									<div class="pagination pull-right no-margin">
										<ul>
											<li class="prev disabled">
												<a href="productlist.php?start=<?php echo $first;?>&keyword=<?php echo $keyword;?>&filter=<?php echo $filter;?>&ord=<?php echo $ord;?>&mode=<?php echo $mode;?>&searchcategory=<?php echo $searchcategory; ?>&searchproduct=<?php echo $searchproduct; ?>&searchemail=<?php echo $searchemail; ?>&searchbrand=<?php echo $searchbrand; ?>&acttab=1">
													<i class="icon-double-angle-left"></i>First
												</a>
											</li>
 <?php for($i=0;$i<count($pages);$i++){ 
                        $star   =   ($pages[$i]-1)*$limit;  ?>
											<li <?php if($start==$star){?> class="active" <?php }?>>
												<a href="productlist.php?start=<?php echo $star;?>&keyword=<?php echo $keyword;?>&filter=<?php echo $filter;?>&ord=<?php echo $ord;?>&mode=<?php echo $mode;?>&searchcategory=<?php echo $searchcategory; ?>&searchproduct=<?php echo $searchproduct; ?>&searchemail=<?php echo $searchemail; ?>&searchbrand=<?php echo $searchbrand; ?>&acttab=1"><?php echo $pages[$i];?></a>
											</li>
  <?php }?>
										

											<li class="next">
												<a href="productlist.php?startadd=<?php echo $last;?>&keyword=<?php echo $keyword;?>&filter=<?php echo $filter;?>&ord=<?php echo $ord;?>&mode=<?php echo $mode;?>&searchcategory=<?php echo $searchcategory; ?>&searchproduct=<?php echo $searchproduct; ?>&searchemail=<?php echo $searchemail; ?>&searchbrand=<?php echo $searchbrand; ?>&acttab=1">
													<i class="icon-double-angle-right"></i>Last
												</a>
											</li>
										</ul>
									</div>
								</div>

<?php } else{  
?>
<div class="row-fluid"> 
<div class="span12"> 

<div class="alert alert-block alert-success">

								Sorry...No Products added yet

							</div>

</div>

</div>



<?php } ?>


									</div>



			
							

							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.span -->



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













		

<div class="article"> </div>
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

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">

			<i class="icon-double-angle-up icon-only bigger-110"></i>

		</a>



	
<script src="util.js" type="text/javascript"></script>
		<?php include("footerscript.php");  ?>

		<script src="assets/js/ace.min.js"></script>
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
			
			<?php  for($i=0;$i<count($records);$i++){           ?>
				$( "#id-btn-dialog<?php echo $records[$i]['id']; ?>" ).on('click', function(e) {
					e.preventDefault();
				
					$( "#dialog-confirm" ).dialog({
						resizable: false,
						modal: true,
						title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i>Delete Product?</h4></div>",
						title_html: true,
						buttons: [
							{
								html: "<i class='icon-trash bigger-110'></i>&nbsp; Delete this item",
								"class" : "btn btn-danger btn-mini",
								click: function() {
									$('.article').load("del_product.php?id="+<?php echo $records[$i]['id'];  ?>);
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

						<?php  for($i=0;$i<count($records);$i++){           ?>
				$( "#id-btn-unpublish<?php echo $records[$i]['id']; ?>" ).on('click', function(e) {
					e.preventDefault();
				
					$( "#unpublish-confirm" ).dialog({
						resizable: false,
						modal: true,
						title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i>UnPublish Product?</h4></div>",
						title_html: true,
						buttons: [
							{
								html: "<i class='icon-trash bigger-110'></i>&nbsp; UnPublish",
								"class" : "btn btn-danger btn-mini",
								click: function() {
									$('.article').load("unpublish_product.php?id="+<?php echo $records[$i]['id'];  ?>);
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

				<?php  for($i=0;$i<count($records);$i++){           ?>
				$( "#id-btn-publish<?php echo $records[$i]['id']; ?>" ).on('click', function(e) {
					e.preventDefault();
				
					$( "#publish-confirm" ).dialog({
						resizable: false,
						modal: true,
						title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i>Publish Product?</h4></div>",
						title_html: true,
						buttons: [
							{
								html: "<i class='icon-trash bigger-110'></i>&nbsp; Publish",
								"class" : "btn btn-danger btn-mini",
								click: function() {
									$('.article').load("publish_product.php?id="+<?php echo $records[$i]['id'];  ?>);
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

				

					$( "#searchproduct" ).catcomplete({

					delay: 0,

					source: '../productautosuggestproduct.php'

				});

					$( "#searchcategory" ).catcomplete({

					delay: 0,

					source: '../productautosuggestcategory.php'

				});
									$( "#searchbrand" ).catcomplete({

					delay: 0,

					source: '../productautosuggestbrand.php'

				});	
				
				$( "#searchemail" ).catcomplete({

					delay: 0,

					source: '../productautosuggestemail.php'

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
	<script type="text/javascript">
			jQuery(function($) {
				$('#id-disable-check').on('click', function() {
					var inp = $('#form-input-readonly').get(0);
					if(inp.hasAttribute('disabled')) {
						inp.setAttribute('readonly' , 'true');
						inp.removeAttribute('disabled');
						inp.value="This text field is readonly!";
					}
					else {
						inp.setAttribute('disabled' , 'disabled');
						inp.removeAttribute('readonly');
						inp.value="This text field is disabled!";
					}
				});
			
			
				$(".chosen-select").chosen(); 
				$('#chosen-multiple-style').on('click', function(e){
					var target = $(e.target);
					var which = parseInt($.trim(target.text()));
					if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
					 else $('#form-field-select-4').removeClass('tag-input-style');
				});
			
			
				$('[data-rel=tooltip]').tooltip({container:'body'});
				$('[data-rel=popover]').popover({container:'#modal-form'});
				
				$('textarea[class*=autosize]').autosize({append: "\n"});
				$('textarea.limited').inputlimiter({
					remText: '%n character%s remaining...',
					limitText: 'max allowed : %n.'
				});
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
			
			
				$( "#input-size-slider" ).css('width','200px').slider({
					value:1,
					range: "min",
					min: 1,
					max: 6,
					step: 1,
					slide: function( event, ui ) {
						var sizing = ['', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
						var val = parseInt(ui.value);
						$('#form-field-4').attr('class', sizing[val]).val('.'+sizing[val]);
					}
				});
			
				$( "#input-span-slider" ).slider({
					value:1,
					range: "min",
					min: 1,
					max: 11,
					step: 1,
					slide: function( event, ui ) {
						var val = parseInt(ui.value);
						$('#form-field-5').attr('class', 'span'+val).val('.span'+val).next().attr('class', 'span'+(12-val)).val('.span'+(12-val));
					}
				});
				
				
				$( "#slider-range" ).css('height','200px').slider({
					orientation: "vertical",
					range: true,
					min: 0,
					max: 100,
					values: [ 17, 67 ],
					slide: function( event, ui ) {
						var val = ui.values[$(ui.handle).index()-1]+"";
			
						if(! ui.handle.firstChild ) {
							$(ui.handle).append("<div class='tooltip right in' style='display:none;left:15px;top:-8px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>");
						}
						$(ui.handle.firstChild).show().children().eq(1).text(val);
					}
				}).find('a').on('blur', function(){
					$(this.firstChild).hide();
				});
				
				$( "#slider-range-max" ).slider({
					range: "max",
					min: 1,
					max: 10,
					value: 2
				});
				
				$( "#eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
					// read initial values from markup and remove that
					var value = parseInt( $( this ).text(), 10 );
					$( this ).empty().slider({
						value: value,
						range: "min",
						animate: true
						
					});
				});
			
				
				$('#id-input-file-1 , #id-input-file-2').ace_file_input({
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
				});
				
				$('#id-input-file-3').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'icon-cloud-upload',
					droppable:true,
					thumbnail:'small'
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
			
				//dynamically change allowed formats by changing before_change callback function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var before_change
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Drop images here or click to choose";
						no_icon = "icon-picture";
						before_change = function(files, dropped) {
							var allowed_files = [];
							for(var i = 0 ; i < files.length; i++) {
								var file = files[i];
								if(typeof file === "string") {
									//IE8 and browsers that don't support File Object
									if(! (/\.(jpe?g|png|gif|bmp)$/i).test(file) ) return false;
								}
								else {
									var type = $.trim(file.type);
									if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif|bmp)$/i).test(type) )
											|| ( type.length == 0 && ! (/\.(jpe?g|png|gif|bmp)$/i).test(file.name) )//for android's default browser which gives an empty string for file.type
										) continue;//not an image so don't keep this file
								}
								
								allowed_files.push(file);
							}
							if(allowed_files.length == 0) return false;
			
							return allowed_files;
						}
					}
					else {
						btn_choose = "Drop files here or click to choose";
						no_icon = "icon-cloud-upload";
						before_change = function(files, dropped) {
							return files;
						}
					}
					var file_input = $('#id-input-file-3');
					file_input.ace_file_input('update_settings', {'before_change':before_change, 'btn_choose': btn_choose, 'no_icon':no_icon})
					file_input.ace_file_input('reset_input');
				});
			
	
			
			
				$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.on('change', function(){
					//alert(this.value)
				});
				$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, icon_up:'icon-caret-up', icon_down:'icon-caret-down'});
				$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, icon_up:'icon-plus', icon_down:'icon-minus', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
			
			
				
				$('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				$('#id-date-range-picker-1').daterangepicker().prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
				
				$('#timepicker1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false
				})
				
				$('#colorpicker1').colorpicker();
				$('#simple-colorpicker-1').ace_colorpicker();
			
				
				$(".knob").knob();
				
				
				//we could just set the data-provide="tag" of the element inside HTML, but IE8 fails!
				var tag_input = $('#form-field-tags');
				if(! ( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase())) ) 
				{
					tag_input.tag(
					  {
						placeholder:tag_input.attr('placeholder'),
						//enable typeahead by specifying the source array
						source: ace.variable_US_STATES,//defined in ace.js >> ace.enable_search_ahead
					  }
					);
				}
				else {
					//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
					tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
					//$('#form-field-tags').autosize({append: "\n"});
				}
				
	
				
			
				/////////
				$('#modal-form input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'icon-cloud-upload',
					droppable:true,
					thumbnail:'large'
				})
				
				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-form').on('show', function () {
					$(this).find('.chosen-container').each(function(){
						$(this).find('a:first-child').css('width' , '200px');
						$(this).find('.chosen-drop').css('width' , '210px');
						$(this).find('.chosen-search input').css('width' , '200px');
					});
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/
			
			});
		</script>
		<?php include("pagescript.php");  ?>

	</body>

</html>


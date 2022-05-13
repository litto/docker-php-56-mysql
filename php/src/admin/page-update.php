<?php
include("db.php");
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Admin| Edit Page</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->
<?php include("script.php");  ?>

	</head>
<?php
$id     =   '';
$hash   =   $_GET['hash'];
if(isset($_GET['id'])){
    $id =   $_GET['id'];
}else if(isset($_POST['id'])){
    $id =   $_POST['id'];
}

$msg    =   '';
if(isset($_POST["saveForm"])){  
    /*
     * Process Form Values
    */
    $txtMenu        =   trim($_POST['txtMenuTitle']);
    $txtParent  =   trim($_POST['txtParent']);
    $txtTitle       =   trim($_POST['txtTitle']);
    $txtContent =   trim($_POST['txtContent']);
    $radPublish=    1; 
    $id                 =   trim($_POST['id']);
    $hash               =   trim($_POST['hash']);
        $slug=strip_tags(addslashes($_POST['slug']));
    $seo_title=strip_tags(addslashes($_POST['seo_title']));
    $seo_keywords=strip_tags(addslashes($_POST['seo_keywords']));
    $seo_description=strip_tags(addslashes($_POST['seo_description']));
    $txtPosition    =   '';
    /*
     * Validate form entries
    */  
    if(trim($txtMenu)=='' || trim($txtParent)=='' || trim($txtTitle)=='' || trim($txtContent)=='' || empty($id)){
        $message    =   new Message('Enter mandatory fields','error');
        $message->setMessage();
        
    }else if($txtParent==$id){
        $message    =   new Message('Parent selection cancelled','error');
        $message->setMessage();
    }else{
        /*
         * Update Coontent
         * Get level and Order
        */
        $obj    =   new Content();
        $base   =   $obj->getPage($id);
        
        $options    =   array('title'=>$txtMenu,
                                            'published'=>$radPublish,'pageTitle'=>$txtTitle,
                                            'content'=>$txtContent,'parent'=>$txtParent,'id'=>$id,'position'=>$txtPosition,'slug'=>$slug,'seo_title'=>$seo_title,'seo_keywords'=>$seo_keywords,'seo_description'=>$seo_description);        
                
        if($obj->updateContent($options)){  //successfully added , set messge queue
            //if change from old parent to news, update level and order//           
            if($base[0]["parent"]!=$txtParent){
                $level  =   $obj->getLevl($txtParent);
                $order  =   $obj->getNextOrder($txtParent); 
                $obj->changeOrderLevel($order,$level,$id);
                if($level!=1 && $base[0]["default"]==1){
                    //reset default flasg
                    $obj->resetDefault($id);
                }
                
            }
            /*
             * Upload Banner Image
            */          
            $base   =   $obj->getPage($id);
            $absDirName =   dirname(dirname(__FILE__)).'/uploads';
            $relDirName =   '../uploads';
        
            $uploader   =   new Uploader($absDirName.'/');
            $uploader->setExtensions(array('jpg','jpeg','png','gif'));
            $uploader->setSequence('page');
            $uploader->setMaxSize(1);
            if($uploader->uploadFile("txtFile")){
                /*
                 * File uploader successfully , now store to Db
                */
                $image      =   $uploader->getUploadName(); 
                $obj->updateBanner($id,$image); 
                unlink('../uploads/'.$base[0]['banner']);
            }
            
            $message    =   new Message('Content updated successfully','message');
            $message->setMessage();         
            header("Location:page-content.php");
            exit;           
        }else{  //failed insertion due to db error, set message queue
            $message    =   new Message('Unknown Error','error');
            $message->setMessage();         
        }
    }
    
}

/*
* Cancel Button Clicked 
*/
if(isset($_POST["cancelForm"])){
    $message    =   new Message('Action Cancelled','warning');
    $message->setMessage();
    header("Location:page-content.php");
    exit;
}

/*
 * Create 2 level menu selection for placing new links
 * Get the details from Id
*/
$obj    =   new Content();
$parentList =   $obj->getLevelSelection();
$base   =   $obj->getPage($id);

include('../config.php');
$menuPos    =   $templateMenuPos;

$utl    =   new Utilities();
$baseUrl    =   $utl->getBaseUrl();


?>
<style>
 #editor {overflow:scroll; max-height:300px}
</style>
<script type="text/javascript">

function loadnewbrand(str){
document.getElementById("newbrand").style.display='none';
if(str==1){
document.getElementById("newbrand").style.display='block';
}
}
function loadnewcategory(str){

if(str==1){
document.getElementById("newcategory").style.display='block';
}
}
</script>

<script type="text/javascript">
function reset(){
	document.getElementById("addproduct").reset();
}
</script>
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
						<li class="active">Edit page</li>
					</ul><!-- .breadcrumb -->

					<div class="nav-search" id="nav-search">
					
					</div><!-- #nav-search -->
				</div>

				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							Edit Page
						
						</h1>
					</div><!-- /.page-header -->

					<div class="row-fluid">
						<div class="span12">
							<!-- PAGE CONTENT BEGINS -->
								


							<div class="space-6"></div>
							<div class="row-fluid">
<form class="form-horizontal" id="addproduct" name="addproduct" method="post" enctype="multipart/form-data" action="page-update.php?id=<?php echo $id; ?>">
	 <input type="hidden" name="id"   value="<?php echo $id;?>" />
    <input type="hidden" name="hash" value="<?php echo $hash;?>" /> 
   
								<div class="control-group">
									<label class="control-label" for="form-field-1">Title</label>

									<div class="controls">
										<input type="text" id="searchprod" placeholder="Page Name"  name="txtMenuTitle" value="<?php echo $base[0]["title"];?>"/>
									</div>
								</div>

<div class="control-group">
					<div class="row-fluid">
								<div class="span5">	<label class="control-label" for="form-field-1">Preview</label>

									<div class="controls">

 <?php
                    if($base[0]['banner']!=''){
                        ?>
                        <!--<img src="../uploads/<?php// echo $base[0]['banner'];?>" alt="Banner Image" width="500" />-->
<img src="thumb.php?file=../uploads/<?php echo $base[0]['banner'];?>&size=50px" alt="<?php echo $data[0]['branch_logo'];?>" >
                        <?php
                    }
                    ?>									</div></div>
								</div>
								</div>

							<div class="control-group">
					<div class="row-fluid">
								<div class="span5">	<label class="control-label" for="form-field-1">Image</label>

									<div class="controls">

										<input type="file" id="id-input-file-2" name="txtFile"/>
									</div></div>
								</div>
								</div>

	<!-- 		<div class="control-group">
									<label class="control-label" for="form-field-1">Brands</label>

									<div class="controls">
									<input type="text" name="brands" id="form-field-tags"  placeholder="Enter brands ..." data-items="1" />
										<span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Enter brands. press tab after entering new brand." title="Help">?</span>
										<div id="branderror"> </div>
									</div>
								</div> -->

								<div class="control-group">
									<label class="control-label" for="form-field-1">Parent</label>

									<div class="controls">
									<select  class="chosen-select" id="brands" data-placeholder="Choose Parent" name="txtParent"  >
										 <option value="0" <?php if($base[0]["parent"]==0){?> selected="selected"<?php }?>>-------Top-------</option>
                            <?php
                            foreach($parentList as $ind=>$val){   //loop 1 start
                                $sub    =   $val["items"];
                                ?>
                                <option value="<?php echo $val["id"]?>" <?php if($base[0]["parent"]==$val["id"]){?> selected="selected"<?php }?>><?php echo $val["title"]?>
                                </option>                               
                                <?php
                                if(count($sub)>0){ //if1
            
                                     ?>
                                    <optgroup>
                                        <?php
                                        foreach($sub as $indd=>$vall){ //for 2
                                            $subb   =   $vall["items"];
                                            ?>
                                            <option value="<?php echo $vall["id"]?>" <?php if($base[0]["parent"]==$vall["id"]){?> selected="selected"<?php }?> ><?php echo $vall['title'];?></option>
                                            <?php
                                            if(count($subb)>0)  {
                                                foreach($subb as $inddd=>$valll){
                                                    ?>
                                                     <option value="<?php echo $valll["id"]?>" <?php if($base[0]["parent"]==$valll["id"]){?> selected="selected"<?php }?> > &nbsp;&nbsp;&nbsp;--<?php echo $valll['title'];?></option>
                                                    <?php
                                                }
                                            }
                                            
                                        } //for 2//
                                        ?>
                                    </optgroup>
                                    <?php

                                }//if1

                                
                            }//loop1 exit//
                            ?>
                        </select>
                        <span class="help-button" data-rel="popover" data-trigger="hover" data-placement="left" data-content="Please select a parent for the page" title="Help">?</span>
										<span id="keyerror"> </span>
									</div>
								</div>



<div class="control-group">
									<label class="control-label" for="form-field-1">Page Title</label>

									<div class="controls">
<input type="text" id="companyname" placeholder="Page Title" name="txtTitle"  value="<?php echo $base[0]["page_title"];?>" />
										<span id="companyerror"> </span>

									</div></div>

									<div class="control-group">
									<label class="control-label" for="form-field-1">URL Slug ( The slug will convert in the url. </label>

									<div class="controls">
<input type="text" id="companyname" placeholder="URL Slug" name="slug"  value="<?php echo $base[0]["slug"];?>" />
										<span id="companyerror"> </span>

									</div></div>

									<div class="control-group">
									<label class="control-label" for="form-field-1">SEO Title</label>

									<div class="controls">

							
												<textarea name="seo_title" id="seo_title" rows="5" cols="80"><?php echo $base[0]["seo_title"];?></textarea>


									</div></div>

									<div class="control-group">
									<label class="control-label" for="form-field-1">SEO Keywords (Press enter after adding each keyword)</label>

									<div class="controls">
		<textarea name="seo_keywords" id="form-field-tags" rows="5"   placeholder="SEO Keywords" cols="140"><?php echo $base[0]['seo_keywords'];?></textarea>

									</div></div>

									
					<div class="control-group">
									<label class="control-label" for="form-field-1">SEO Description</label>

									<div class="controls">

								<textarea name="seo_description" id="seo_description" rows="5" cols="80"><?php echo $base[0]["seo_description"];?></textarea>
									
									</div>
								</div>	

						
										
			<div class="control-group">
									<label class="control-label" for="form-field-1">Content</label>

									<div class="controls">

								<textarea name="txtContent" id="description" rows="5" cols="80"><?php echo $base[0]["content"];?></textarea>
									
									</div>
								</div>		
	


								<div class="form-actions">
									<button class="btn btn-info" type="submit" name="saveForm">
										<i class="icon-ok bigger-110"></i>
										Submit
									</button>

									&nbsp; &nbsp; &nbsp;
									<button class="btn" type="submit" name="cancelForm">
										<i class="icon-undo bigger-110"></i>
									Cancel
									</button>
								</div>

								<div class="hr"></div>

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

	<?php include("footerscript.php");  ?>
		<script src="assets/js/ace.min.js"></script>


<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
    // General options
  mode : "exact",
elements : "description",
    theme : "advanced",
    plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

    // Theme options
    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,

    // Skin options
    skin : "o2k7",
    skin_variant : "silver",

    // Example content CSS (should be your site CSS)
    content_css : "css/example.css",

    // Drop lists for link/image/media/template dialogs
    template_external_list_url : "js/template_list.js",
    external_link_list_url : "js/link_list.js",
    external_image_list_url : "js/image_list.js",
    media_external_list_url : "js/media_list.js",

    // Replace values for the template plugin
    template_replace_values : {
        username : "Some User",
        staffid : "991234"
    }
});
</script>

		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			jQuery(function($){
			
			try {
			  $(".dropzone").dropzone({
			    paramName: "file", // The name that will be used to transfer the file
			    maxFilesize: 1, // MB
			    maxFiles: 3,
                addRemoveLinks : true,
				dictDefaultMessage :
				'<span class="bigger-150 bolder"><i class="icon-caret-right red"></i> Drop files</span> to upload \
				<span class="smaller-80 grey">(or click)</span> <br /> \
				<i class="upload-icon icon-cloud-upload blue icon-3x"></i>'
			,
				dictResponseError: 'Error while uploading file!',
				
				//change the previewTemplate to use Bootstrap progress bars
				previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <img data-dz-thumbnail />\n  </div>\n  <div class=\"progress progress-small progress-success progress-striped active\"><span class=\"bar\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-success-mark\"><span></span></div>\n  <div class=\"dz-error-mark\"><span></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>"
			  });
			} catch(e) {
			  alert('Dropzone.js does not support older browsers!');
			}
			
			});


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
			
			
				$( "#id-btn-dialog2" ).on('click', function(e) {
					e.preventDefault();
				
					$( "#dialog-confirm" ).dialog({
						resizable: false,
						modal: true,
						title: "<div class='widget-header'><h4 class='smaller'><i class='icon-warning-sign red'></i> Empty the recycle bin?</h4></div>",
						title_html: true,
						buttons: [
							{
								html: "<i class='icon-trash bigger-110'></i>&nbsp; Delete all items",
								"class" : "btn btn-danger btn-mini",
								click: function() {
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
					source: availableTags,
					maxTags:'1'
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
				
		



		

         
           	   	$( "#searchprod" ).catcomplete({
					delay: 0,
					source: '../productautosuggestproduct.php'
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
				$('[data-rel=popover]').popover({container:'body'});
				
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
					btn_choose:'Drop images here or click to choose',
					btn_change:null,
					no_icon:'icon-picture',
					droppable:true,
					thumbnail:'small'
					//,icon_remove:null//set null, to hide remove/reset button
					,before_change:function(files, dropped) {
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
						//source: ace.variable_US_STATES,//defined in ace.js >> ace.enable_search_ahead
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
		
	</body>
</html>

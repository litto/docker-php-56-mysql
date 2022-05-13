<?php

class Content extends MySql{
	/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
	private $lastId;
	/*
	 * Get the Level of the content
	*/
	function getLevl($id){
		if(empty($id)){
			return 1;
		}else{
			$query	=	"SELECT `level` FROM `cms_pages` WHERE `page_id`='$id'";
			$rec	=	$this->fetchAll($query);
			$level	=	$rec[0]['level'];
			return $level+1;
		}
	}
	
	/*
	 * Get next Order/Sequence in the Parent Levels
	*/
	function getNextOrder($parent){
		$query="SELECT max(`order`) FROM `cms_pages` WHERE `parent`='$parent'";
		$rec=	$this->fetchAll($query);
		if(count($rec)>0){
			return $rec[0]['max(`order`)']+1;
		}else{
			return 1;
		}
	}
	
	/*
	 * Add New Content
	 * input=Array of values
	*/
	function addContent($inputs){

		$insert	=	array(	'order'=>$inputs['order'],
											'level'=>$inputs['level'],
											'parent'=>$inputs['parent'],
											'published'=>$inputs['published'],
											'title'=>$this->addFilter($this->escapeHtml($inputs['title'])),
											'page_title'=>$this->addFilter($this->escapeHtml($inputs['pageTitle'])),
											'content'=>$inputs['content'],
											'date_update'=>date("Y-m-d H:i:s"),
											'position'=>$inputs['position']
											,'slug'=>$inputs['slug'],'seo_title'=>$inputs['seo_title'],'seo_keywords'=>$inputs['seo_keywords'],'seo_description'=>$inputs['seo_description']
											);

		$this->insert($insert,"cms_pages");	
		$this->lastId	=	$this->lastInsertId();	
		return true;
		
	}
	
	function getInsert(){
		return $this->lastId;
	}
	
	/*
	 * Update Content
	*/
	function updateContent($inputs){
		$insert	=	array(	'parent'=>$inputs['parent'],
											'published'=>$inputs['published'],
											'title'=>$this->addFilter($this->escapeHtml($inputs['title'])),
											'page_title'=>$this->addFilter($this->escapeHtml($inputs['pageTitle'])),
											'content'=>$this->addFilter($inputs['content']),
											'date_update'=>date("Y-m-d H:i:s"),
											'position'=>$inputs['position'],
											'slug'=>$inputs['slug'],'seo_title'=>$inputs['seo_title'],'seo_keywords'=>$inputs['seo_keywords'],'seo_description'=>$inputs['seo_description']
											);
		$this->update($insert,"cms_pages",'`page_id`='.$inputs['id']);
		return true;
	}
	
	function updateBanner($id,$image){
		$this->update(array('banner'=>$image),'cms_pages','`page_id`='.$id);
	}
	
	/* 
	 * Change Level and Order
	*/
	
	function changeOrderLevel($order,$level,$id){
		$insert	=	array(	'level'=>$level,
											'order'=>$order									
											);
		$this->update($insert,"cms_pages",'`page_id`='.$id);
	}
	
	/*
	 * Get level selection
	*/
	    /*
		function getLevelSelection(){
		$query	=	"SELECT `page_id`,`title` FROM `cms_pages` WHERE `level`='1'";
		$rec		=	$this->fetchAll($query);
		$list		=	array();
		for($i=0;$i<count($rec);$i++){
			$list[$i]["page_id"]	=	$rec[$i]["page_id"];
			$list[$i]["title"]		=	$rec[$i]["title"];
			
			$query	=	"SELECT `page_id`,`title` FROM `cms_pages` WHERE  `parent`='".$rec[$i]["page_id"]."'";
			$recc		=	$this->fetchAll($query);
			$list[$i]["list"]	=	$recc;
			unset($recc);
		}
		unset($rec);
		return $list;
		
	}
*/

function getLevelSelection(){
		$query	=	"SELECT `page_id`,`title` FROM `cms_pages` WHERE `level`='1'";
		$rec		=	$this->fetchAll($query);
		$list		=	array();
		for($i=0;$i<count($rec);$i++){
			$list[$i]["id"]	=	$rec[$i]['page_id'];
			$list[$i]["title"]	=	$rec[$i]['title'];
        	
			$query="SELECT `page_id`,`title` FROM `cms_pages` WHERE `level`='2' AND `parent`='".$rec[$i]['page_id']."' "  ;
			$recc	=	$this->fetchAll($query);	    
           
			for($j=0;$j<count($recc);$j++){
				
				$list[$i]["items"][$j]['id']=$recc[$j]['page_id'];
				$list[$i]["items"][$j]['title']=$recc[$j]['title'];		
                
				$query="SELECT `page_id`,`title` FROM `cms_pages` WHERE `level`='3' AND `parent`='".$recc[$j]['page_id']."' "  ;
				$reccc	=	$this->fetchAll($query);
				for($k=0;$k<count($reccc);$k++)	{
					$list[$i]["items"][$j]["items"][$k]['id']		=	$reccc[$k]['page_id'];
					$list[$i]["items"][$j]["items"][$k]['title']	=	$reccc[$k]['title'];
				}
				unset($reccc);
				
			}
			unset($recc);
		
		}		
		unset($rec);		
		return $list;
	}
	
	/*
	 *  List Contents
	*/
	
	function listContent($values){
		
		$start		=	$values['start'];
		$limit		=	$values['limit'];
		$mode			=	trim($values['mode']);
		$ord			=	trim($values['ord']);
		$keyword	=	trim($values['keyword']);
		$parent		=	trim($values['parent']);
		
		$qry="";
		$order	=	'';
		
		if(!empty($keyword)){
			$qry.=' AND LOWER(c.`title`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
		}
		if(trim($parent)!=''){
			$qry.=' AND c.`parent`=\''.$parent.'\'';
		}
		if(!empty($mode) && !empty($ord)){
			if($mode=='title'){
				if($ord=='dsc'){
					$order=' ORDER BY c.`title` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`title` ASC';
				}
			}
			if($mode=='order'){
				if($ord=='dsc'){
					$order=' ORDER BY c.`order` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`order` ASC';
				}
			}
		}
		
		$query	=	"SELECT count(c.`page_id`) FROM `cms_pages` c WHERE c.`page_id`!=''";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`page_id`)'];
		
		$query	=	"SELECT c.*,(SELECT title from `cms_pages` WHERE `page_id`=c.`parent`) as position FROM `cms_pages` c WHERE c.`page_id`!=''";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);

	
		return $rec;		
		
		
	}
	
	
	/* 
	 * Iteratively delete the pages if given parent node
	*/
	function deleteSubPages($parent){

		echo $query	=	"SELECT `page_id` FROM `cms_pages` WHERE `parent`='$parent'";

		$rec		=	$this->fetchAll($query);
//print_r($rec);


		if(count($rec)>0){
			for($i=0;$i<count($rec);$i++){
				$this->deleteSubPages($rec[$i]['page_id']);
			}
		}
		$this->delete("cms_pages",'`page_id`='.$parent);
		return true;

	
	}
	
	
	/*
	 * Delete the COntents
	*/	
	function deleteList($list){


		for($i=0;$i<count($list);$i++){								
			$this->deleteSubPages($list[$i]);
		}
	}
	
	/*
	 * Un Publush records
	*/	
	function unpublishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('published'=>'0'),"cms_pages",'`page_id`='.$list[$i]);
		}
	}
	
	
	/*
	 * Publush records
	*/
	
	function publishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('published'=>'1'),"cms_pages",'`page_id`='.$list[$i]);
		}
	}
	
	
	/*
	 * Normalize records
	*/
	
	function setNormalized($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('default'=>'0','featured'=>'0'),"cms_pages",'`page_id`='.$list[$i]);
		}
	}
	
	
	/*
	 * Featured records
	*/
	
	function setFeatured($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('featured'=>'1'),"cms_pages",'`page_id`='.$list[$i]);
		}
	}
	
	

	/*
	 * Set Order for Pages
	*/
		
	function setOrder($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('order'=>$list[$i][1]),"cms_pages",'`page_id`='.$list[$i][0]);
		}
	}
	
	/*
	 * Check Page is top
	*/
	function checkOnTop($id){
		$query="SELECT `page_id` FROM `cms_pages` WHERE `page_id`='".$id."' AND `parent`='0'";		
		$rec	=	$this->fetchAll($query);
		if(count($rec)>0){
			return true;
		}else{
			return false;
		}
	}
	
	
	/*
	 * Set a Default Page
	*/
	
	function setDefault($id){
		$this->update(array('default'=>0),"cms_pages",'');
		$this->update(array('default'=>1),"cms_pages",'`page_id`='.$id);
	}
	
	/*
	 * Reset Default Flag
	*/
	
	function resetDefault($id){		
		$this->update(array('default'=>0),"cms_pages",'`page_id`='.$id);
	}
	
	/*
	 * Get Page Entry	
	*/
	
	function getPage($id){
		$query	=	"SELECT * FROM `cms_pages` WHERE `page_id`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getallsubscribes(){
		$id=1;
		$query	=	"SELECT * FROM `cms_subscribers` WHERE `published`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getimage(){
		$id=1;
		$query	=	"SELECT * FROM `cms_image` WHERE `status`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
	function getnews(){
		$id=1;
		$query	=	"SELECT * FROM `cms_news` WHERE `published`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
	/*
	 * Get All top Level Pages
	*/
	
	function getAllTop(){
		$query	=	"SELECT `page_id`,`title` FROM `cms_pages` WHERE `parent`='0'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
	/*
	 * Get Webpage Title
	*/	
	
	function getWebTitle($id){
		$query	=	"SELECT `page_title` FROM `cms_pages` WHERE `page_id`='$id' AND `published`='1'";
		$rec		=	$this->fetchAll($query);
		return $rec[0]['page_title'];
	}
	
	
	/*
	 * Get Home Page Title
	*/
	function getHomeTitle(){
		$query	=	"SELECT `page_title` FROM `cms_pages` WHERE `default`='1' AND `published`='1'";
		$rec		=	$this->fetchAll($query);
		return $rec[0]['page_title'];
	}
	
	/*
	 * Get Home Item
	*/
	function getHomeItem(){
		$query	=	"SELECT `page_id` FROM `cms_pages` WHERE `default`='1' AND `published`='1'";
		$rec		=	$this->fetchAll($query);
		return $rec[0]['page_id'];
	}
	
	/*
	 * Get Layer1MenuList
	*/
	
	function getParentMenuList($mode){
		$query	=	"SELECT `page_id`,`title` FROM `cms_pages` WHERE `parent`='0' AND `position`='$mode' AND `published`='1' ORDER BY `order` ASC ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
	/*
	 * Check Whether page is contact us
	*/
	
	function checkContactPage($id){
		$query	=	'SELECT `linked_page` FROM `cms_contacts` WHERE `linked_page`=\''.$id.'\'';
		$rec		=	$this->fetchAll($query);
		if(count($rec)>0){
			return true;
		}else{
			return false;
		}
	}
	
	
	/*
	 * Get Parent Node
	*/
	
	function getParentId($id){
		$query	=	'SELECT `parent`,`page_id` FROM `cms_pages` WHERE `page_id`=\''.$id.'\'';
		$rec		=	$this->fetchAll($query);
		$parent	=	$rec[0]['parent'];
		if($parent==0){				
			return $rec[0]['page_id'];
		}else{
			if($parent!=''){
				return $this->getParentId($parent);
			}else{
				return $rec[0]['page_id'];
			}
		}
	}
	
	/*
	 * Get Direct Parent
	*/
	function getDirectParentId($id){
		$query	=	'SELECT `parent`,`page_id` FROM `cms_pages` WHERE `page_id`=\''.$id.'\'';
		$rec		=	$this->fetchAll($query);
		$parent	=	$rec[0]['parent'];
		return $parent;
	}
		
	/*
	 * Get Submenu List
	*/
	
	function getSubmenuList($parent){
		$query	=	"SELECT `page_id`,`title` FROM `cms_pages` WHERE `parent`='$parent' AND  `published`='1' ORDER BY `order` ASC ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
	/*
	 * Get Level
	*/
	function getLevel($id){
		$query	=	"SELECT `level` FROM `cms_pages` WHERE `page_id`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec[0]['level'];
	}
	
	/*
	 * Get Page Title
	*/
	function getPageTitle($id){
		if(empty($id)){
			$query	=	"SELECT `page_title` FROM `cms_pages` WHERE `default`='1' AND `published`='1'";
		}else{
			$query	=	"SELECT `page_title` FROM `cms_pages` WHERE `page_id`='$id'";
		}		
		$rec		=	$this->fetchAll($query);
		return $rec[0]['page_title'];
	}
	
	/*
	 * Get Page Title
	*/
	function getPageContent($id){
		if(empty($id)){
			$query	=	"SELECT `content` FROM `cms_pages` WHERE `default`='1' AND `published`='1' ";
		}else{
			$query	=	"SELECT `content` FROM `cms_pages` WHERE `page_id`='$id'";
		}
		$rec		=	$this->fetchAll($query);
		return $rec[0]['content'];
	}
	
	
	/*
	 * Get ContactUsPage
	*/
	
	function getContactPage(){
		$query	=	"SELECT c.* FROM `cms_pages` c JOIN `cms_contacts` cc WHERE c.`page_id`=cc.`linked_page`";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
	/*
	 * Get Featured Listing
	*/
	
	function getFeaturedList(){		
		$query	=	"SELECT * FROM `cms_pages` WHERE `featured`='1' AND `published`='1' ORDER BY `order` ASC  LIMIT 0,20";
		$rec		=	$this->fetchAll($query);
		return $rec;	
	}
	
	/*
	 * Search Content
	*/
	
	function searchContent($keyword){
		$keyword	=	strtolower($keyword);
		$query	=	'SELECT `page_id`,`title`,`page_title` FROM `cms_pages` WHERE `page_id`!=\'\' AND (LCASE(`title`) LIKE \'%'.addslashes($keyword).'%\' OR LCASE(`page_title`) LIKE \'%'.addslashes($keyword).'%\' OR LCASE(`content`) LIKE \'%'.addslashes($keyword).'%\') ORDER BY `parent` ASC,`order` ASC LIMIT 0,30';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	
	
	/*
	 * Upload Banner Image
	*/
	
	function addBanner($options){
		$insert	=	array('banner'=>$options['image'],'default'=>'0');
		$this->insert($insert,'cms_banner');
	
	}
	
	/*
	 * List Banner
	*/
	
	function listAllBanner(){
		$query	=	'SELECT * FROM `cms_banner` ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	/*
	 * Get Banner
	*/
	
	function getBanner($id){
		$query	=	'SELECT * FROM `cms_banner` WHERE `banner_id`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	
	
	/*
	 * Delete Banner
	*/	
	function deleteBanner($list){
		for($i=0;$i<count($list);$i++){								
			$id	=	$list[$i];
			$ban	=	$this->getBanner($id);
			unlink('../siteimages/banner/'.$ban[0]['banner']);
			$this->delete('cms_banner','`banner_id`='.$id);
		}
	}
	
	/*
	 * Set Defaut Banner
	*/
	
	function setDefaultBanner($id){
		$this->update(array('default'=>'0'),'cms_banner','');
		$this->update(array('default'=>'1'),'cms_banner','`banner_id`='.$id);
	}
	
	
	/*
	 * Get DefaultBanner
	*/
	
	function getDefaultBanner($info){		
		if($info['custom']=='0'){
			$id	=	$info['item'];
			$query	=	'SELECT `banner` FROM `cms_pages` WHERE `page_id`=\''.$id.'\' LIMIT 0,1 ';		
			$rec	=	$this->fetchAll($query);
			if(trim($rec[0]['banner'])!=''){
				return $rec[0]['banner'];
			}else{
				$query	=	'SELECT * FROM `cms_pages` WHERE `default`=\'1\' LIMIT 0,1 ';		
				$rec	=	$this->fetchAll($query);
				return $rec[0]['banner'];
			}	
		}else{
			$type='';
			switch($info['title']){
				case 'newsheadlines':
					$type='news';
					break;
					
				case 'newsview':
					$type='news';
					break;
					
				case 'newsarchives':
					$type='newsarchives';
					break;
					
				case 'newsarchiveslist':
					$type='newsarchives';
					break;
				
				case 'newsarchiveview':
					$type='newsarchives';
					break;
				
				case 'picturegallery':
					$type='picturegallery';
					break;
					
				case 'mediagallery':
					$type='mediagallery';
					break;
					
				case 'contactform':
					$type='contactform';
					break;
				default :
					$type='news';					
			}
			$banner=$this->getCustomBanner($type);
			return $banner[0]['banner'];		
		}
	}
	/*
	 * Get Custom Banner
	*/
	
	function getCustomBanner($type){
		$query	=	'SELECT * FROM `cms_banner` WHERE `type`=\''.$type.'\' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	
	/*
	 * save custom banner
	*/
	function saveCustomBanner($type,$image){
		$this->update(array('banner'=>$image),'cms_banner','`type`=\''.$type.'\'');
	}
	
////////////////////////////////////////////////////////////////	
	
/*
* User content editor
*/	
	
	
	
	/*
	* Get menu		function headerMenu(){
		$query	=	"SELECT `page_id`,`order`,`title` FROM `cms_pages` WHERE `parent`=0 ORDER BY `order`";
		$rec	=	$this->fetchAll($query);
		print_r($rec);
		return $rec;
	
	
	}
	*/
	
	function headerMenu(){
		$query	=	"SELECT `page_id`,`order`,`title` FROM `cms_pages` WHERE `parent`=0 ORDER BY `order`";
		$rec	=	$this->fetchAll($query);
	
		return $rec;
	
	
	}

function get_home(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=0 AND `page_id`=1";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
	function get_mission(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=0 AND `page_id`=5";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
function gettestimony(){
		$query	=	"SELECT * FROM `cms_testimony` WHERE `published`=1";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}

function getvideos(){
		$query	=	"SELECT * FROM `cms_video` WHERE `status`=1";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}

      function checksub($pass){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=$pass";
		$rec	=	$this->fetchAll($query);
		   
		return $rec;
	
	
	}
function get_client(){
		$query	=	"SELECT * FROM `cms_company`";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
	function getclients(){
		$query	=	"SELECT * FROM `cms_clients` WHERE `status`=1";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
	function getport(){
		$query	=	"SELECT * FROM `cms_image` WHERE `status`=1";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}

function getservices(){
		$query	=	"SELECT * FROM `cms_service` WHERE `status`=1";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
function gettrade(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=0 AND `page_id`=3";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
function getfaculty(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=0 AND `page_id`=4";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}	
function getfacility(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=0 AND `page_id`=6";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}	
	function getadmin(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=0 AND `page_id`=7";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
		function getcourse(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=0 AND `page_id`=8";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
function get_aboutus(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=0 AND `page_id`=2";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
	function get_vision(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=0 AND `page_id`=29";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
	function get_chairman(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=0 AND `page_id`=26";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
	
function get_terms(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=0 AND `page_id`=2";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
function get_services(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=0 AND `page_id`=4";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}



function get_careerio(){
		$query	=	"SELECT * FROM `cms_video` WHERE `type`=0 AND `status`=1";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}


function get_contact(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=0 AND `page_id`=3";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
     function getallcontact(){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=3";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}

	function get_brochure(){
		$query	=	"SELECT * FROM `cms_media`";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}

function get_retaildet($id){
		$query	=	"SELECT * FROM `cms_subproduct` WHERE `subprod_id`=$id";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}

function get_media(){
		$query	=	"SELECT * FROM `cms_media`";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
function getMailid(){
				$query	=	"SELECT `contact_email` FROM `cms_contacts`";
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
	/*get enquiry reply
*/
function getthankmsg(){
				$query	=	"SELECT `contact_thanks` FROM `cms_contacts`";
				$rec		=	$this->fetchAll($query);
				return $rec;
			}	
			/*get enquiry reply
*/
function getprivacypolicy(){
				$query	=	"SELECT `privacy_policy` FROM `cms_contacts`";
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
function get_album(){
		$query	=	"SELECT * FROM `cms_album` WHERE `status`=1";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
	function get_albumsubimage($id){
		$query	=	"SELECT * FROM `cms_image` WHERE `album_id`=$id ";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
	function get_subalbumimages($id){
		$query	=	"SELECT * FROM `cms_image` WHERE `album_id`=$id  AND `status`=1";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
	function get_albumname($id){
		$query	=	"SELECT * FROM `cms_album` WHERE `album_id`=$id  AND `status`=1";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
function get_videofull(){
		$query	=	"SELECT * FROM `cms_video` WHERE `status`=1";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}			
function get_videowithid($id){
		$query	=	"SELECT * FROM `cms_video` WHERE `video_id`=$id ";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
function get_companyimage(){
		$query	=	"SELECT * FROM `cms_company` WHERE `status`=1";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}			
function get_brandimagewithid($id){
		$query	=	"SELECT * FROM `cms_company` a, `cms_companytype` b WHERE b.`company_type`=$id AND a.`company_id`= b.`company_id`";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}			
function get_companydetailswithid($id){
		$query	=	"SELECT * FROM `cms_company` WHERE `company_id`=$id";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}
function get_companysubimageswithid($id){
		$query	=	"SELECT * FROM `cms_companyimage` WHERE `company_id`=$id";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}

function get_career(){
		$query	=	"SELECT * FROM `cms_careers` WHERE `status`=1";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}			
	function get_careerwithid($id){
		$query	=	"SELECT * FROM `cms_careers` WHERE `career_id`=$id";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}


function get_news(){
		$query	=	"SELECT * FROM `cms_news` LIMIT 0,20";
		$rec	=	$this->fetchAll($query);
		
		return $rec;
	
	
	}	
					
}


?>
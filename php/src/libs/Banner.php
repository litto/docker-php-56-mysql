<?php
class Banner extends MySql{
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/

/*function updateBanner($id,$image){
		$this->update(array('banner'=>$image),'cms_pages','`page_id`='.$id);
	}*/




function changeOrderLevel($order,$level,$id){
		$insert	=	array(	'level'=>$level,
											'order'=>$order									
											);
		$this->update($insert,"cms_pages",'`page_id`='.$id);
	}
	
/*
	 * Un Publush records
	*/	
	function unpublishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('published'=>'0'),"cms_banner",'`bannerid`='.$list[$i]);
		}
	}
	
	
	/*
	 * Publush records
	*/
	
	function getallbanners()
{
$query="SELECT * FROM `cms_banner` WHERE status='1'";
$rec	=	$this->fetchAll($query);

return $rec;
}


	function publishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('published'=>'1'),"cms_banner",'`bannerid`='.$list[$i]);
		}
	}
	/* 
	 * Iteratively delete the pages if given parent node
	*/
	function deleteSubPages($parent){
		$query	=	"SELECT `bannerid` FROM `cms_banner` WHERE `parent`='$parent'";
		$rec		=	$this->fetchAll($query);
		if(count($rec)>0){
			for($i=0;$i<count($rec);$i++){
				$this->deleteSubPages($rec[$i]['bannerid']);
			}
		}
		$this->delete("cms_banner",'`bannerid`='.$parent);
		return true;	
	}
	
	
function deleteList($list){
					for($i=0;$i<count($list);$i++){
							
							$this->delete('cms_banner','`bannerid`='.$list[$i]);
							
					}
			}
	/*
	 * Normalize records
	*/
	
	function setNormalized($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('default'=>'0','featured'=>'0'),"cms_banner",'`bannerid`='.$list[$i]);
		}
	}
	
	
	/*
	 * Featured records
	*/
	
	function setFeatured($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('featured'=>'1'),"cms_banner",'`bannerid`='.$list[$i]);
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
	
	function addBanner($bantit,$bantype,$image,$banlink){
	
	echo $bantit;
		$insert	=	array('banner_name'=>$bantit,'banner_type'=>$bantype,'banner_url'=>$image,'banner_link'=>$banlink);
		$this->insert($insert,'cms_banner');
	
	}
	
	/*
	 * List Banner
	*/
	
	
	
	

	function listAllBanner($values){
		
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
		
		$query	=	"SELECT count(c.`bannerid`) FROM `cms_banner` c WHERE c.`bannerid`!=''";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`bannerid`)'];
		
		$query	=	"SELECT * FROM `cms_banner`";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
	
				
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	 * Get Banner
	*/
	
	function getBanner($id){
		$query	=	'SELECT * FROM `cms_banner` WHERE `bannerid`='.$id.' ';
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
			$this->delete('cms_banner','`bannerid`='.$id);
		}
	}
	
	/*
	 * Set Defaut Banner
	*/
	
	function setDefaultBanner($id){
		$this->update(array('default'=>'0'),'cms_banner','');
		$this->update(array('default'=>'1'),'cms_banner','`bannerid`='.$id);
	}
	
	
	
	function updateBannerwithimage($bantit,$bantype,$image,$banlink,$id){
	
	
	$this->update(array('banner_name'=>$bantit,'banner_type'=>$bantype,'banner_url'=>$image,'banner_link'=>$banlink),'cms_banner','`bannerid`='.$id);
		}
		
		function updateBanner($bantit,$bantype,$banlink,$id){
	
	
	$this->update(array('banner_name'=>$bantit,'banner_type'=>$bantype,'banner_link'=>$banlink),'cms_banner','`bannerid`='.$id);
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
	
	
	
	
	
	
	








}
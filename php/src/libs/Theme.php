<?php
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
	class Theme extends MySql{
		
			/*
			 * Get next Order/Sequence in the Parent Levels
			*/
			function getNextOrder(){
				$query="SELECT max(`order`) FROM `cms_news`";
				$rec=	$this->fetchAll($query);
				if(count($rec)>0){
					return $rec[0]['max(`order`)']+1;
				}else{
					return 1;
				}
			}
			/*
			 * Add News Content
			*/			
			function addNews($inputs){
					$insert	=	array('title'=>$this->addFilter($this->escapeHtml($inputs['title'])),											
											'folder_name'=>$this->addFilter($this->escapeHtml($inputs['folder'])),
											'default'=>'0',
											'published'=>$inputs['published'],
											'thumbimage'=>$inputs['image']
											);
				$this->insert($insert,"cms_themes");		
				return true;
			}
			
			
			
			function listNews($values){
					$start		=	$values['start'];
					$limit		=	$values['limit'];
					$mode			=	trim($values['mode']);
					$ord			=	trim($values['ord']);
					$keyword	=	trim($values['keyword']);		
					$filter		=	trim($values['filter']);
					
					$qry="";
					$order	=	'';					
					if(!empty($keyword)){
						$qry.=' AND LOWER(c.`title`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
					}		
					if(!empty($filter)){
						if($filter=='featured'){
								$qry.=' AND c.`featured`=\'1\'';
						}
						if($filter=='archived'){
								$qry.=' AND c.`archived`=\'1\'';
						}
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
					
					$query	=	"SELECT count(c.`theme_id`) FROM `cms_themes` c WHERE c.`theme_id`!=''";
					$query.=$qry;
					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`theme_id`)'];
		$query	=	"SELECT c.* FROM `cms_themes` c WHERE c.`theme_id`!=''";
					$query.=$qry;
					$query.=$order;
					$query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);
									
					return $rec;		
		
			}
			
			/*
			 * Get News Content
			*/
			
			function getNews($id){

				$query	=	'SELECT * FROM `cms_themes` WHERE `theme_id`='.$id;
				$rec		=	$this->fetchAll($query);
				
				return $rec;
			}
			function getl(){
$id=1;
				$query	=	'SELECT * FROM `cms_banner` WHERE `status`='.$id;
				$rec		=	$this->fetchAll($query);
				
				return $rec;
			}
			/*
			 * Delete News Items
			*/
				function dltimg($id){

 $query	=	'SELECT * FROM `cms_themes` WHERE `theme_id`='.$id.' ';
		$rec	=	$this->fetchAll($query);

$this->deleteUp($rec[0]['thumbimage']);
$this->deletefol($rec[0]['folder_name']);
return true;
	
	
}
  function deletefol($image){
  	$destinationPath="../themes/";
            unlink($destinationPath.$image);
        }
  function deleteUp($image){
  	$destinationPath="../uploads/";
            unlink($destinationPath.$image);
        }
			function deleteList($list){
					for($i=0;$i<count($list);$i++){
						$this->dltimg($list[$i]);
							$this->delete('cms_themes','`theme_id`='.$list[$i]);
					}
			}
			function setDefault($list,$def){
	
			for($i=0;$i<count($def);$i++){
			
		$this->update(array('default'=>'0'),"cms_themes",'`theme_id`='.$def[$i]);
		}
		for($i=0;$i<count($list);$i++){
			
			$this->update(array('default'=>'1'),"cms_themes",'`theme_id`='.$list[$i]);
		}
		
	}
			/*
			 * Set Order for Pages
			*/
				
			function setOrder($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('order'=>$list[$i][1]),"cms_news",'`news_id`='.$list[$i][0]);
				}
			}
			
			/*
			 * Un Publush records
			*/	
			function unpublishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('published'=>'0'),"cms_themes",'`theme_id`='.$list[$i]);
				}
			}
			
			
			/*
			 * Publush records
			*/
			
			function publishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('published'=>'1'),"cms_themes",'`theme_id`='.$list[$i]);
				}
			}
			
			/*
			 * Featured records
			*/
			
			function setFeatured($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('featured'=>'1','archived'=>'0'),"cms_news",'`news_id`='.$list[$i]);
				}
			}
		
			/*
			 * Set Archived records
			*/
			
			function setArchived($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('archived'=>'1','featured'=>'0'),"cms_news",'`news_id`='.$list[$i]);
				}
			}
			
			
			/*
			 * Set Archived records
			*/
			
			function setNormalized($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('archived'=>'0','featured'=>'0'),"cms_news",'`news_id`='.$list[$i]);
				}
			}
			
			/*
			 * News Listing for FrontEnd
			*/
			function latestNews($values){
					$start		=	$values['start'];
					$limit		=	$values['limit'];
					
					
					$qry=" AND c.`published`='1' AND `archived`='0'";
					
					$order	=	'';					
					if(!empty($keyword)){
						$qry.=' AND LOWER(c.`title`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
					}		
					
					$order	=	' ORDER BY c.`order` ASC ';
					$query	=	"SELECT count(c.`news_id`) FROM `cms_news` c WHERE c.`news_id`!=''";
					$query.=$qry;
					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`news_id`)'];
					
					$query	=	"SELECT c.* FROM `cms_news` c WHERE c.`news_id`!=''";
					$query.=$qry;
					$query.=$order;
					$query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}
			
			
			function getYearList(){
				$query	=	"SELECT DATE_FORMAT(`date_update`,'%Y') as year FROM `cms_news` WHERE `archived`='1' AND `published`='1' GROUP BY DATE_FORMAT(`date_update`,'%Y') ORDER BY DATE_FORMAT(`date_update`,'%Y') DESC ";
				$rec	=	$this->fetchAll($query);
				return $rec;
			}
			
					/*
			 * News Archive List for FrontEnd
			*/
			function archiveNewsListing($values){
					$start		=	$values['start'];
					$limit		=	$values['limit'];
					$month		=	$values['month'];
					$year			=	$values['year'];
					
					$dateFrom	=	$year.'-'.$month.'-01';
					$dateTo		=	$year.'-'.$month.'-31';
					
					$qry=" AND c.`published`='1' AND `archived`='1'";
					$qry.=" AND ( DATE_FORMAT(c.`date_update`,'%Y-%m-%d')>='$dateFrom' AND  DATE_FORMAT(c.`date_update`,'%Y-%m-%d') <='$dateTo')";
					
					$order	=	'';					
					if(!empty($keyword)){
						$qry.=' AND LOWER(c.`title`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
					}		
					
					$order	=	' ORDER BY c.`order` ASC ';
					$query	=	"SELECT count(c.`news_id`) FROM `cms_news` c WHERE c.`news_id`!=''";
					$query.=$qry;
					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`news_id`)'];
					
					$query	=	"SELECT c.* FROM `cms_news` c WHERE c.`news_id`!=''";
					$query.=$qry;
					$query.=$order;
					$query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}
			
	
			
			
			
	}

?>
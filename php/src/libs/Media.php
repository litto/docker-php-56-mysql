<?php

	class Media extends MySql{
		/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
			/*
			 * Get next Order/Sequence in the Parent Levels
			*/
			function getNextOrder(){
				$query="SELECT max(`order`) FROM `cms_media`";
				$rec=	$this->fetchAll($query);
				if(count($rec)>0){
					return $rec[0]['max(`order`)']+1;
				}else{
					return 1;
				}
			}
			/*
			 * Add Media Item
			*/			
			function addFile($inputs){
					$insert	=	array(
											'published'=>$inputs['published'],
											'title'=>$this->addFilter($this->escapeHtml($inputs['title'])),											
											'file'=>$this->addFilter($inputs['file']),
											'date_update'=>date("Y-m-d H:i:s"),
											'order'=>$this->getNextOrder(),
											'filesize'=>$inputs['size'],
											'type'=>$inputs['type'],
											'content'=>$inputs['content']
											);
				$this->insert($insert,"cms_media");		
				return true;
			}
			
			/*
			 * Update Media Details
			*/
			function updateBase($inputs){
					$insert	=	array(
											'published'=>$inputs['published'],
											'title'=>$this->addFilter($this->escapeHtml($inputs['title'])),										
											'date_update'=>date("Y-m-d H:i:s"),
											'content'=>$inputs['content']											
											);
				$this->update($insert,"cms_media",'`media_id`='.$inputs['id']);		
				return true;
			}
			
			/*
			 * Update File
			*/
			function updateFile($inputs){
					$insert	=	array(
											'file'=>$inputs['file'],
											'filesize'=>$inputs['size'],				
											'type'=>$inputs['type'],														
											);
				$this->update($insert,"cms_media",'`media_id`='.$inputs['id']);		
				return true;
			}
			
			/*
			 * List Images
			*/
			
			function listMedia($values){
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
					if(!empty($filter))	{
						if($filter=='doc'){
							$qry.=' AND (c.`type`=\'doc\' OR c.`type`=\'docx\')';
						}
						if($filter=='html'){
							$qry.=' AND (c.`type`=\'html\' OR c.`type`=\'htm\')';
						}
						if($filter=='xls'){
							$qry.=' AND (c.`type`=\'xls\' OR c.`type`=\'xlsx\')';
						}
						if($filter=='txt'){
							$qry.=' AND (c.`type`=\'txt\' OR c.`type`=\'rtf\')';
						}
						if($filter=='pdf'){
							$qry.=' AND (c.`type`=\'pdf\' )';
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
					
					$query	=	"SELECT count(c.`media_id`) FROM `cms_media` c WHERE c.`media_id`!=''";
					$query.=$qry;
					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`media_id`)'];
					
					$query	=	"SELECT c.* FROM `cms_media` c WHERE c.`media_id`!=''";
					$query.=$qry;
					$query.=$order;
					$query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}
			
			
			/*
			 * Get File Entry
			*/			
			function getMedia($id){
				$query	=	'SELECT * FROM `cms_media` WHERE `media_id`='.$id;
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
			
			/*
			 * Delete Media Items
			*/
			
			function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$base	=	$this->getMedia($list[$i]);
							$this->delete('cms_media','`media_id`='.$list[$i]);
							unlink('../media/'.$base[0]['file']);
					}
			}
			
			/*
			 * Set Order for Pages
			*/
				
			function setOrder($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('order'=>$list[$i][1]),"cms_media",'`media_id`='.$list[$i][0]);
				}
			}
			
			/*
			 * Un Publush records
			*/	
			function unpublishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('published'=>'0'),"cms_media",'`media_id`='.$list[$i]);
				}
			}
			
			
			/*
			 * Publush records
			*/
			
			function publishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('published'=>'1'),"cms_media",'`media_id`='.$list[$i]);
				}
			}
			
			/*
			 * normalize records
			*/
			
			function normalize($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('featured'=>'0'),"cms_media",'`media_id`='.$list[$i]);
				}
			}
			
			/*
			 * Featred records
			*/
			
			function feature($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('featured'=>'1'),"cms_media",'`media_id`='.$list[$i]);
				}
			}
			
			/*
			 * List Media Files
			*/
			
			function mediaGallery($values){
					$start		=	$values['start'];
					$limit		=	$values['limit'];
					
					
					$qry=" AND c.`published`='1'";
					$order	=	' ORDER BY c.`order` ASC ';					
					if(!empty($keyword)){
						$qry.=' AND LOWER(c.`title`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
					}		
					
					
					$query	=	"SELECT count(c.`media_id`) FROM `cms_media` c WHERE c.`media_id`!=''";
					$query.=$qry;
					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`media_id`)'];
					
					$query	=	"SELECT c.* FROM `cms_media` c WHERE c.`media_id`!=''";
					$query.=$qry;
					$query.=$order;
					$query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}
			
			
			function listFeatured($values){
										
					
					$qry=" AND c.`published`='1' AND `featured`='1'";
					$order	=	' ORDER BY c.`order` ASC ';					
					if(!empty($keyword)){
						$qry.=' AND LOWER(c.`title`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
					}		
					
					
					$query	=	"SELECT count(c.`media_id`) FROM `cms_media` c WHERE c.`media_id`!=''";
					$query.=$qry;
					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`media_id`)'];
					
					$query	=	"SELECT c.* FROM `cms_media` c WHERE c.`media_id`!=''";
					$query.=$qry;
					$query.=$order;
					$query.=' LIMIT 0,10';
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}
			
			
			
			
	}

?>
<?php
class Propertyimage extends MySql{
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
function unpublishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('status'=>'0'),"cms_image",'`img_id`='.$list[$i]);
		}
	}
	
	
	/*
	 * Publush records
	*/
	
	function publishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('status'=>'1'),"cms_image",'`img_id`='.$list[$i]);
		}
	}


function deleteList($list){
					for($i=0;$i<count($list);$i++){
							
							$this->delete('cms_image','`img_id`='.$list[$i]);
							
					}
			}

function listallimage($values,$passid){
		
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
		
		$query	=	"SELECT count(c.`img_id`) FROM `cms_image` c WHERE c.`album_id`='$passid'";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`img_id`)'];
		
		$query	=	"SELECT * FROM `cms_image` WHERE `album_id`='$passid'";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
	
function addimage($theatreid,$imagename,$imageloc){
					$insert	=	array('album_id'=>$theatreid,
									   'image_title'=>$imagename,
									   'image_loc'=>$imageloc,	
									   'status'=>'1'
											);
				$this->insert($insert,"cms_image");		
				return true;
			}
} ?>

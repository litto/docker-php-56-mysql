<?php
class Album extends MySql{
/*
			 * Add career Content
			*/			
			function addalbum($inputs){
					$insert	=	array(
											
											'album_title'=>$this->addFilter($this->escapeHtml($inputs['album_title']))										
											
											);
				$this->insert($insert,"cms_album");		
				return true;
			}
			function getallalbum(){
		$id=1;
		$query	=	'SELECT * FROM `cms_album` WHERE `status`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}

	function editalbum($inputs){
	
	
	$this->update(array('album_title'=>$inputs['album_title']),'cms_album','`album_id`='.$inputs['id']);
	return true;
		}
		

function dltlist($id){

$query	=	'SELECT * FROM `cms_image` WHERE `album_id`='.$id.' ';
		$rec	=	$this->fetchAll($query);

		for($i=0;$i<count($rec);$i++){
			$this->delete('cms_image','`image_id`='.$rec[$i]['image_id']);
			$image=$rec[$i]['image_loc'];
			$this->deleteUp($image);
		}
	
}
  function deleteUp($image){
  	$destinationPath="../uploads/";
            unlink($destinationPath.$image);
        }
/*
			 * Delete career Items
			*/
			
			function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('cms_album','`album_id`='.$list[$i]);
							$this->dltlist($list[$i]);
					}
			}





/*
			 * Un Publush records
			*/	
			function unpublishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'0'),"cms_album",'`album_id`='.$list[$i]);
				}
			}
			
			
			/*
			 * Publush records
			*/
			
			function publishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'1'),"cms_album",'`album_id`='.$list[$i]);
				}
			}
			
function listalbum($values){
		
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
		
		$query	=	"SELECT count(c.`album_id`) FROM `cms_album` c WHERE c.`album_id`!=''";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`album_id`)'];
		
		$query	=	"SELECT * FROM `cms_album`";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}

	function listuseralbum($values){
		
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
		
		$query	=	"SELECT count(c.`album_id`) FROM `cms_album` c WHERE c.`status`!='0'";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`album_id`)'];
		
		$query	=	"SELECT * FROM `cms_album` c WHERE c.`status`!='0'";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}

	function getalbumdetails($id){
		$query	=	'SELECT * FROM `cms_album` WHERE `album_id`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
function getimage($id){
		$query	=	'SELECT * FROM `cms_image` WHERE `album_id`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
function listimage($values,$id){
		
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
		
		$query	=	"SELECT count(c.`image_id`) FROM `cms_image` c WHERE c.`album_id`=$id";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`image_id`)'];
		
		$query	=	"SELECT * FROM `cms_image`WHERE `album_id`=$id";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}



}
?>
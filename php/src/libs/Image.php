<?php

	class Image extends MySql{
	
	/*
	 * Upload Banner Image
	*/
	function getalbumimages($id){
		$query	=	'SELECT * FROM `cms_image` WHERE `album_id`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	

	function getallimage(){
		$id=1;
		$query	=	'SELECT * FROM `cms_image` WHERE `status`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	function addimage($albumid,$bantit,$image){
	
	
		$insert	=	array('album_id'=>$albumid,'image_title'=>$bantit,'image_loc'=>$image);
		$this->insert($insert,'cms_image');
	
	}

	function addphoto($albumid,$photoname,$savename){
		$insert=array('album_id'=>$albumid,'image_title'=>$photoname,'image_loc'=>$savename,'status'=>'1');
		
				$this->insert($insert,"cms_image");		
				return true;
			}



	function updateimagetitle($id,$name){
				echo $id;
				echo $name;
					$this->update(array('image_title'=>$name),"cms_image",'`image_id`='.$id);
				
			}
	
	/*
			 * Delete career Items
			*/
			
			function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->dltlist($list[$i]);
							$this->delete('cms_image','`image_id`='.$list[$i]);
					}
			}
function dltlist($id){

$query	=	'SELECT * FROM `cms_image` WHERE `image_id`='.$id.' ';
		$rec	=	$this->fetchAll($query);

	
			$image=$rec[0]['image_loc'];
			$this->deleteUp($image);
	
}
  function deleteUp($image){
  	$destinationPath="../uploads/";
            unlink($destinationPath.$image);
        }
/*
			 * Un Publush records
			*/	
			function unpublishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'0'),"cms_image",'`image_id`='.$list[$i]);
				}
			}
			
				function getmax(){

				$query	=	'SELECT MAX(`image_id`) FROM `cms_image` ';
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
			/*
			 * Publush records
			*/
			
			function publishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'1'),"cms_image",'`image_id`='.$list[$i]);
				}
			}
	function listimage($values,$passid){
		
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
		
		$query	=	"SELECT count(c.`image_id`) FROM `cms_image` c WHERE c.`album_id`='$passid'";
		 $query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`image_id`)'];
		
		$query	=	"SELECT * FROM `cms_image` WHERE `album_id`='$passid'";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
	
		return $rec;		
		
		
	}


function editgalleryimage($inputs){
	 $insert=array('image_title'=>$inputs['photoname'],'image_loc'=>$inputs['image'],'status'=>'1');
		
			$this->update($insert,"cms_image",'`image_id`='.$inputs['id']);		
				return true;
			}

	function editgallery($inputs){
	
			$insert=array('image_title'=>$inputs['photoname'],'status'=>'1');
	
			$this->update($insert,"cms_image",'`image_id`='.$inputs['id']);		
				return true;
			}



	function getphotodetails($id){
				 $query	=	"SELECT * FROM `cms_image` WHERE `image_id`='$id'";
				$rec		=	$this->fetchAll($query);
				
				return $rec;

			}


	
	
	}
	?>
	
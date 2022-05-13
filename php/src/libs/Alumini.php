<?php

	class Alumini extends MySql{
	
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/	
	/*
	 * Upload Banner Image
	*/
	
function addimage($imagename,$imageloc){
					$insert	=	array( 'photo'=>$imageloc,
									   'description'=>$imagename,	
									   'status'=>'1'
											);
				$this->insert($insert,"cms_alumini");		
				return true;
			}
	function updateimagetitle($id,$name){
				
					$this->update(array('description'=>$name),"cms_alumini",'`id`='.$id);
				
			}
	
	/*
			 * Delete career Items
			*/
			
			function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->dltlist($list[$i]);
							$this->delete('cms_alumini','`id`='.$list[$i]);
					}
			}
function dltlist($id){

$query	=	'SELECT * FROM `cms_alumini` WHERE `id`='.$id.' ';
		$rec	=	$this->fetchAll($query);

	
			$image=$rec[0]['photo'];
			$this->deleteUp($image);
	
}
  function deleteUp($image){
  	$destinationPath="../uploads/";
            unlink($destinationPath.$image);
        }
		function getall(){
			$id=1;
		$query	=	'SELECT * FROM `cms_alumini` WHERE `status`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
/*
			 * Un Publush records
			*/	
			function unpublishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'0'),"cms_alumini",'`id`='.$list[$i]);
				}
			}
			
				function getmax(){

				$query	=	'SELECT MAX(`id`) FROM `cms_alumini` ';
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
			/*
			 * Publush records
			*/
			
			function publishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'1'),"cms_alumini",'`id`='.$list[$i]);
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
		
		$query	=	"SELECT count(c.`id`) FROM `cms_alumini` c ";
		 $query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`id`)'];
		
		$query	=	"SELECT * FROM `cms_alumini` c ";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
	
		return $rec;		
		
		
	}
	
	
	}
	?>
	
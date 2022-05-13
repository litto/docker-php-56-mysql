<?php
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
	class Video extends MySql{
	
	
	function getvideos($id){
				$query	=	'SELECT * FROM `cms_video` WHERE `video_id`='.$id;
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
			
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$base	=	$this->getvideos($list[$i]);
							$this->delete('cms_video','`video_id`='.$list[$i]);
							unlink('../uploads/'.$base[0]['code_path']);
							unlink('../uploads/'.$base[0]['thumb']);
					}
			}
	function getvideo($passid){
	
	$query	=	"SELECT * FROM `cms_video` WHERE video_id=$passid";
	
				$rec		=	$this->fetchAll($query);
				return $rec;
	}
	
	/*
	 * Upload Banner Image
	*/
	
	function addvideo($bantit,$you,$image,$rad){
	
	
		$insert	=	array('video_title'=>$bantit,'code_path'=>$you,'thumb'=>$image,'type'=>$rad);
		$this->insert($insert,'cms_video');
	
	}
	
	
	/*
	 * Un Publush records
	*/	
	function unpublishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('status'=>'0'),"cms_video",'`video_id`='.$list[$i]);
		}
	}
	
	
	/*
	 * Publush records
	*/
	
	function publishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('status'=>'1'),"cms_video",'`video_id`='.$list[$i]);
		}
	}
	function listAllvideo($values){
		
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
		
		$query	=	"SELECT count(c.`video_id`) FROM `cms_video` c WHERE c.`video_id`!=''";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`video_id`)'];
		
		$query	=	"SELECT * FROM `cms_video`";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
	
	function video_with_thumb($videotit,$codepath,$thumb,$type,$id){
	
	
	$this->update(array('video_title'=>$videotit,'code_path'=>$codepath,'thumb'=>$thumb,'type'=>$type),'cms_video','`video_id`='.$id);
		}
		
		
	
		function no_video_with_thumb($videotit,$thumb,$type,$id){
	
	
	$this->update(array('video_title'=>$videotit,'thumb'=>$thumb,'type'=>$type),'cms_video','`video_id`='.$id);
		}
		
		
		
		function video_only_no_thumb($videotit,$codepath,$type,$id){
	
	
	$this->update(array('video_title'=>$videotit,'code_path'=>$codepath,'type'=>$type),'cms_video','`video_id`='.$id);
		}
		
		
	function no_thum_vid($videotit,$type,$id){
	
	
	$this->update(array('video_title'=>$videotit,'type'=>$type),'cms_video','`video_id`='.$id);
		}
	
	
	
	
	
	
	
	
	
	
	
	
	}
	
	
	
	
	?>
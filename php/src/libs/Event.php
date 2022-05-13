<?php
class Event extends MySql{
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
function unpublishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('status'=>'0'),"cms_event",'`id`='.$list[$i]);
		}
	}
	
	
	/*
	 * Publush records
	*/
	
	function publishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('status'=>'1'),"cms_event",'`id`='.$list[$i]);
		}
	}


function deleteList($list){
					for($i=0;$i<count($list);$i++){
							
							$this->delete('cms_event','`id`='.$list[$i]);
							
					}
			}

function listAllevent($values){
		$eventname="top";
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
		
		$query	=	"SELECT count(c.`id`) FROM `cms_event` c WHERE c.`company`='$eventname'";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`id`)'];
		
		$query	=	"SELECT * FROM `cms_event`WHERE `company`='$eventname'";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		return $rec;		
		
		
	}
	function listAllevent1($values){
		
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
		
		$query	=	"SELECT count(c.`id`) FROM `cms_event`c";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`id`)'];
		
		$query	=	"SELECT * FROM `cms_event`";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		return $rec;		
		
		
	}

function    addevent($txtTitle,$desc,$image,$company,$video,$album){
	echo $txtTitle;
echo $desc;
		$insert	=	array('title'=>$txtTitle,'image'=>$image,'description'=>$desc,'company'=>$company,'video'=>$video,'album'=>$album);
		print_r($insert);
		
		$this->insert($insert,'cms_event');
	return(1);
	}

function updateeventwithimage($txtTitle,$desc,$image,$company,$video,$album,$id){
	
	
	$this->update(array('title'=>$txtTitle,'image'=>$image,'description'=>$desc,'company'=>$company,'video'=>$video,'album'=>$album),'cms_event','`id`='.$id);
return(1);


		}

function updateproperty($txtTitle,$desc,$company,$video,$album,$id){
	
	
	$this->update(array('title'=>$txtTitle,'description'=>$desc,'company'=>$company,'video'=>$video,'album'=>$album),'cms_event','`id`='.$id);
return(1);


		}

function getcompany(){

		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=4";
		$rec	=	$this->fetchAll($query);
		return $rec;
		}
function getcompanyname($id){

		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=4 AND `page_id`=$id";
		$rec	=	$this->fetchAll($query);
		return $rec;
		}
function lastInsertId()
		{
			return mysql_insert_id();
		}

function getevent($id){
		$query	=	'SELECT * FROM `cms_event` WHERE `id`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}

function getname($id){
		$query	=	'SELECT * FROM `cms_album` WHERE `album_id`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
function getteam(){
		$query	=	'SELECT * FROM `cms_pages` WHERE `parent`=20 ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}

function getsub($id){
		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=$id ";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
function gethome($id){
		  $query	=	"SELECT * FROM `cms_pages` WHERE `page_id`=$id ";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
function getcompanypage($id,$pageid){
		  $query	=	"SELECT * FROM `cms_pages` WHERE `parent`=$id  AND `page_id`=$pageid";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
function getprojectdetails($pass){
		  $query	=	"SELECT * FROM `cms_project`WHERE `id`=$pass ";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
function getprojectname($name){
		  $query	=	"SELECT * FROM `cms_pages` WHERE `page_id`=$name ";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	function geteventname($name){
		  $query	=	"SELECT * FROM `cms_pages` WHERE `page_id`=$name ";
		$rec	=	$this->fetchAll($query);

		return $rec;
	}
	function geteventvideo(){
		  $query	=	"SELECT * FROM `cms_event` WHERE `video`!=''";
		$rec	=	$this->fetchAll($query);

		return $rec;
	}
	function getalbumnames(){
		  $query	=	"SELECT * FROM `cms_album`";
		$rec	=	$this->fetchAll($query);

		return $rec;
	}
	function listproject($values,$projectname){
		
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
		
		$query	=	"SELECT count(c.`id`) FROM `cms_project` c WHERE c.`company`='$projectname' AND c.`completed`=0  OR  c.`completed`=1";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`id`)'];
		
		$query	=	"SELECT * FROM `cms_project` WHERE `company`='$projectname' AND `completed`=0  OR  `completed`=1";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
function listAllcompanyevent($values,$eventname){
		echo $eventname;
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
		
		$query	=	"SELECT count(c.`id`) FROM `cms_event` c WHERE c.`company`='$eventname'";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`id`)'];
		
	$query	=	"SELECT * FROM `cms_event` WHERE `company`='$eventname'";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
		function listoverseasproject($values,$projectname){
		
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
		
		$query	=	"SELECT count(c.`id`) FROM `cms_project` c WHERE c.`company`='$projectname' AND c.`completed`=2";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`id`)'];
		
		$query	=	"SELECT * FROM `cms_project` WHERE `company`='$projectname'  AND `completed`=2";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
}
?>
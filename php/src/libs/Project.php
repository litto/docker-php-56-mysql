<?php
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
class Project extends MySql{

function unpublishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('status'=>'0'),"cms_project",'`id`='.$list[$i]);
		}
	}
	
	
	/*
	 * Publush records
	*/
	
	function publishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('status'=>'1'),"cms_project",'`id`='.$list[$i]);
		}
	}


function deleteList($list){
					for($i=0;$i<count($list);$i++){
							
							$this->delete('cms_project','`id`='.$list[$i]);
							
					}
			}

function listAllproject($values){
		
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
		
		$query	=	"SELECT count(c.`id`) FROM `cms_project` c WHERE c.`id`!=''";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`id`)'];
		
		$query	=	"SELECT * FROM `cms_project`";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}

function    addproject($txtTitle,$desc,$image,$company,$sale){
	echo $txtTitle;

		$insert	=	array('title'=>$txtTitle,'image'=>$image,'description'=>$desc,'company'=>$company,'completed'=>$sale);
		$this->insert($insert,'cms_project');
	return(1);
	}

function updateprojectwithimage($txtTitle,$desc,$image,$company,$sale,$id){
	
	
	$this->update(array('title'=>$txtTitle,'image'=>$image,'description'=>$desc,'company'=>$company,'completed'=>$sale),'cms_project','`id`='.$id);
return(1);


		}

function updateproject($txtTitle,$desc,$company,$sale,$id){
	
	
	$this->update(array('title'=>$txtTitle,'description'=>$desc,'company'=>$company,'completed'=>$sale),'cms_project','`id`='.$id);
return(1);


		}

function getcompany(){

		$query	=	"SELECT * FROM `cms_pages` WHERE `parent`=4";
		$rec	=	$this->fetchAll($query);
		return $rec;
		}

function lastInsertId()
		{
			return mysql_insert_id();
		}

function getproject($id){
		$query	=	'SELECT * FROM `cms_project` WHERE `id`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}





}
?>
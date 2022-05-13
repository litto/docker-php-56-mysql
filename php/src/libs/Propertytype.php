<?php
class Propertytype extends MySql{
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
function deleteList($list){
					for($i=0;$i<count($list);$i++){
							
							$this->delete('cms_propertytypes','`type_id`='.$list[$i]);
							
					}
			}

function listAllpropertytypes($values){
		
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
		
		$query	=	"SELECT count(c.`type_id`) FROM `cms_propertytypes` c WHERE c.`type_id`!=''";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`type_id`)'];
		
		$query	=	"SELECT * FROM `cms_propertytypes`";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}

function getpropertytype($id){
		$query	=	"SELECT * FROM `cms_propertytypes` WHERE `type_id`=$id";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}

function updatetypewithimage($txtTitle,$desc,$file,$id){
	
	
	$this->update(array('type_name'=>$txtTitle,'desc'=>$desc,'img'=>$file),'cms_propertytypes','`type_id`='.$id);
return(1);


		}

function updatepropertytype($txtTitle,$desc,$id){
	
	
	$this->update(array('type_name'=>$txtTitle,'desc'=>$desc),'cms_propertytypes','`type_id`='.$id);
return(1);


		}
}
?>
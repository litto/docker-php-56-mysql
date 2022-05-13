<?php

	class Company extends MySql{
		/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
/*
			 * Delete career Items
			*/
			
			function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('cms_company','`company_id`='.$list[$i]);
					}
			}

/*
			 * Un Publush records
			*/	
			function unpublishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'0'),"cms_company",'`company_id`='.$list[$i]);
				}
			}
			
			
			/*
			 * Publush records
			*/
			
			function publishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'1'),"cms_company",'`company_id`='.$list[$i]);
				}
			}
	function listcompany($values){
		//echo "msg";
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
		
		$query	=	"SELECT count(c.`company_id`) FROM `cms_company` c WHERE c.`company_id`!=''";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`company_id`)'];
		
		$query	=	"SELECT * FROM `cms_company`";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
	
	function getsubproduct()
{
$query="SELECT * FROM `cms_subproduct`";
$rec	=	$this->fetchAll($query);

return $rec;
}

function addcompany($txtTitle,$file,$txtdesc,$web){
	

		$insert	=	array('company_name'=>$txtTitle,'company_logo'=>$file,'company_desc'=>$txtdesc,'company_web'=>$web);
		$this->insert($insert,'cms_company');
	return(1);
	}

function getcompany($passid)
{
$query="SELECT * FROM `cms_company` WHERE `company_id`=$passid";
$rec	=	$this->fetchAll($query);

return $rec;
}


function updatecompany_withimage($txtTitle,$file,$txtdesc,$web,$passid){
	
	
	$this->update(array('company_name'=>$txtTitle,'company_logo'=>$file,'company_desc'=>$txtdesc,'company_web'=>$web),'cms_company','`company_id`='.$passid);
		}
		
		
		
		function updatecompany($txtTitle,$txtdesc,$web,$passid){
	
	
	$this->update(array('company_name'=>$txtTitle,'company_desc'=>$txtdesc,'company_web'=>$web),'cms_company','`company_id`='.$passid);
		}
			
	function lastInsertId()
		{
			return mysql_insert_id();
		}
function addimage($file,$id){
	
	
	
		$insert	=	array('company_id'=>$id,'img_path'=>$file);
		$this->insert($insert,'cms_companyimage');
	
	}
function addcompanytype($list,$id){
					for($i=0;$i<count($list);$i++){
$insert	=	array('company_id'=>$id,'company_type'=>$list[$i]);
		$this->insert($insert,'cms_companytype');


							
					}
			}


	function get_type($id,$type){
		$query	=	"SELECT *  FROM `cms_companytype` WHERE `company_id`=$id AND `company_type`=$type ";
		$rec	=	$this->fetchAll($query);
		
		if($rec==NULL)
{
return false;
}
else
{
return true;
}
	
	
	}
function deleteadd($id){
$sql="DELETE FROM `cms_companytype` WHERE `company_id`=$id"; 
mysql_query($sql);
			//$this->delete('cms_companytype','`company_id`='$id);
					
			}	




	function updatecompany_withsecondimage($file1,$passid){
	
	
	$this->update(array('company_banner'=>$file1),'cms_company','`company_id`='.$passid);
		}












	
}
?>
	
	
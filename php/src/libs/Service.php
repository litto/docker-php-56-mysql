<?php
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
	class Service extends MySql{
	
	/*
	 * Upload Banner Image
	*/
	
	function addpartner($bantit,$logodes,$image){
	$st=1;
	
		$insert	=	array('service_name'=>$bantit,'service_image'=>$image,'service_description'=>$logodes,'status'=>$st);
		$this->insert($insert,'cms_service');
	
	}
	
	
		/*
			 * Delete career Items
			*/
			
			function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('cms_service','`service_id`='.$list[$i]);
					}
			}
	
		/*
			 * Un Publush records
			*/	
			function unpublishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'0'),"cms_service",'`service_id`='.$list[$i]);
				}
			}
			
			
			/*
			 * Publush records
			*/
			
			function publishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'1'),"cms_service",'`service_id`='.$list[$i]);
				}
			}
			
	function listpartner($values){
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
					if(!empty($filter)){
						if($filter=='featured'){
								$qry.=' AND c.`featured`=\'1\'';
						}
						if($filter=='archived'){
								$qry.=' AND c.`archived`=\'1\'';
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
					
					$query	=	"SELECT count(c.`service_id`) FROM `cms_service` c WHERE c.`service_id`!=''";
					$query.=$qry;
					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`service_id`)'];
					
					$query	=	"SELECT c.* FROM `cms_service` c WHERE c.`service_id`!=''";
					$query.=$qrys;
					$query.=$order;
					$query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}
	
	/*
	 * Get Banner
	*/
	
	function getPartners($id){
		$query	=	'SELECT * FROM `cms_service` WHERE `service_id`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	function updatepartnerwithimage($bantit,$logodes,$image,$id){
	
	
	$this->update(array('service_name'=>$bantit,'service_image'=>$image,'service_description'=>$logodes),'cms_service','`service_id`='.$id);
		}
		
		function updatepartner($bantit,$logodes,$id){
	
	
	$this->update(array('service_name'=>$bantit,'service_description'=>$logodes),'cms_service','`service_id`='.$id);
		}
	
	
		}
		?>
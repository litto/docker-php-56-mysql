<?php
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
	class Partner extends MySql{
	
	/*
	 * Upload Banner Image
	*/
	
	function addpartner($bantit,$logodes,$image,$url){
	$st=1;
	
		$insert	=	array('client_name'=>$bantit,'client_logo'=>$image,'url'=>$url,'description'=>$logodes,'status'=>$st);
		$this->insert($insert,'cms_clients');
	
	}
	
	
		/*
			 * Delete career Items
			*/
			
			function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('cms_clients','`client_id`='.$list[$i]);
					}
			}
	
		/*
			 * Un Publush records
			*/	
			function unpublishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'0'),"cms_clients",'`client_id`='.$list[$i]);
				}
			}
			
			
			/*
			 * Publush records
			*/
			
			function publishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'1'),"cms_clients",'`client_id`='.$list[$i]);
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
					
					$query	=	"SELECT count(c.`client_id`) FROM `cms_clients` c WHERE c.`client_id`!=''";
					$query.=$qry;
					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`client_id`)'];
					
					$query	=	"SELECT c.* FROM `cms_clients` c WHERE c.`client_id`!=''";
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
		$query	=	'SELECT * FROM `cms_clients` WHERE `client_id`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	function updatepartnerwithimage($bantit,$logodes,$image,$url,$id){
	
	
	$this->update(array('client_name'=>$bantit,'client_logo'=>$image,'url'=>$url,'description'=>$logodes),'cms_clients','`client_id`='.$id);
		}
		
		function updatepartner($bantit,$logodes,$url,$id){
	
	
	$this->update(array('client_name'=>$bantit,'url'=>$url,'description'=>$logodes),'cms_clients','`client_id`='.$id);
		}
	
	
		}
		?>
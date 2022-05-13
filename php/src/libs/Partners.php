<?php
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
	class Partners extends MySql{
		
	

			function addrecord($inputs){
					$insert	=	array('name'=>$this->addFilter($this->escapeHtml($inputs['name'])),											
											'email'=>$this->addFilter($inputs['email']),
											'mobile'=>$inputs['mobile'],
											'comment'=>$inputs['comment'],
											'doc'=>$inputs['doc'],
											'date_add'=>date("Y-m-d H:i:s"),
											'type'=>$inputs['type'],
											'status'=>$inputs['status']
											);
			
				$this->insert($insert,"cms_partners");		
				return true;
			}
			
			/*
			 * Update news Content
			*/			
			function updaterecord($inputs){
					$insert	=	array('name'=>$this->addFilter($this->escapeHtml($inputs['title'])),											
											'email'=>$this->addFilter($inputs['email']),
											'mobile'=>$inputs['mobile'],
											'comment'=>$inputs['comment'],
											'type'=>$inputs['type'],
											'status'=>$inputs['status']
											);

				$this->update($insert,"cms_partners",'`id`='.$inputs['id']);		
				return true;
			}
			function updateNewsimage($inputs){
			$insert	=	array('name'=>$this->addFilter($this->escapeHtml($inputs['title'])),											
											'email'=>$this->addFilter($inputs['email']),
											'mobile'=>$inputs['mobile'],
											'comment'=>$inputs['comment'],
											'document'=>$inputs['document'],
											'type'=>$inputs['type'],
											);
					$this->dltimg($inputs['id']);
				$this->update($insert,"cms_partners",'`id`='.$inputs['id']);		
				return true;
			}
			
			/*
			 * News Listing
			*/
			
			function listNews($values){
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
					
					$query	=	"SELECT count(c.`id`) FROM `cms_partners` c WHERE c.`id`!=''";
					$query.=$qry;
					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`id`)'];
		$query	=	"SELECT c.* FROM `cms_partners` c WHERE c.`id`!=''";
					$query.=$qry;
					$query.=$order;
					$query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);
									
					return $rec;		
		
			}
			function dltimg($id){

 $query	=	'SELECT * FROM `cms_partners` WHERE `id`='.$id.' ';
		$rec	=	$this->fetchAll($query);

$this->deleteUp($rec[0]['doc']);
return true;
	
	
}
  function deleteUp($image){
  	$destinationPath="../uploads/";
            unlink($destinationPath.$image);
        }
			/*
			 * Get News Content
			*/
			
			function getrecord($id){

				$query	=	'SELECT * FROM `cms_partners` WHERE `id`='.$id;
				$rec		=	$this->fetchAll($query);
				
				return $rec;
			}
			function getl(){
$id=1;
				$query	=	'SELECT * FROM `cms_partners` WHERE `status`='.$id;
				$rec		=	$this->fetchAll($query);
				
				return $rec;
			}
			/*
			 * Delete News Items
			*/
			
			function deleteList($list){
					for($i=0;$i<count($list);$i++){
						$this->dltimg($list[$i]);
							$this->delete('cms_partners','`id`='.$list[$i]);
					}
			}
			
			/*
			 * Set Order for Pages
			*/
				
			function setOrder($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('order'=>$list[$i][1]),"cms_partners",'`id`='.$list[$i][0]);
				}
			}
			
			/*
			 * Un Publush records
			*/	
			function unpublishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'0'),"cms_partners",'`id`='.$list[$i]);
				}
			}
			
			
			/*
			 * Publush records
			*/
			
			function publishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'1'),"cms_partners",'`id`='.$list[$i]);
				}
			}

			

	
			
			
			
	}

?>
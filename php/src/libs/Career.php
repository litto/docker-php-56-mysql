<?php

	class Career extends MySql{
	/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
	
	/*
			 * Add career Content
			*/			
			function    addcareer1($name,$job,$mail,$file,$date,$published){

		$insert	=	array('name'=>$name,'job'=>$job,'mail'=>$mail,'resume'=>$file,'date_applied'=>$date,'published'=>$published);
		$this->insert($insert,'cms_vacancy');
	return(1);
	}
function    addcareer($inputs){

		$insert	=	array(
											'career_title'=>$this->addFilter($this->escapeHtml($inputs['career_title'])),											
											'career_desc'=>$this->addFilter($inputs['career_desc'])
											,'exp'=>$inputs['exp'],'location'=>$inputs['location'],'jobdesc'=>$inputs['desc'],'area'=>$inputs['workarea'],'education'=>$inputs['edu'],'joiningtime'=>$inputs['jointime'],
											'date_last'=>$this->addFilter($inputs['date_last']),
											'status'=>$inputs['status']										
											);
		$this->insert($insert,'cms_careers');
	return(1);
	}
		/*
			 * Delete career Items
			*/
			
			function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('cms_careers','`career_id`='.$list[$i]);
					}
			}
	
		/*
			 * News Listing
			*/
			
			function listcareer($values){
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
					
					$query	=	"SELECT count(c.`career_id`) FROM `cms_careers` c WHERE c.`career_id`!=''";
					$query.=$qry;
					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`career_id`)'];
					
					$query	=	"SELECT c.* FROM `cms_careers` c WHERE c.`career_id`!=''";
					$query.=$qry;
					$query.=$order;
					$query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}
			
			/*
			 * Un Publush records
			*/	
			function unpublishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'0'),"cms_careers",'`career_id`='.$list[$i]);
				}
			}
			
			
			/*
			 * Publush records
			*/
			
			function publishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'1'),"cms_careers",'`career_id`='.$list[$i]);
				}
			}
			
	/*
			 * Get News Content
			*/
			
			function getcareer($id){
				$query	=	'SELECT * FROM `cms_careers` WHERE `career_id`='.$id;
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
			
			
			/*
			 * Update news Content
			*/			
			function updatecareer($inputs){
					$insert	=	array(
											'career_title'=>$this->addFilter($this->escapeHtml($inputs['career_title'])),											
											'career_desc'=>$this->addFilter($inputs['career_desc'])
											,'exp'=>$inputs['exp'],'location'=>$inputs['location'],'jobdesc'=>$inputs['desc'],'area'=>$inputs['workarea'],'education'=>$inputs['edu'],'joiningtime'=>$inputs['jointime'],
											'date_last'=>$this->addFilter($inputs['date_last']),
											'status'=>$inputs['status']										
											);
				$this->update($insert,"cms_careers",'`career_id`='.$inputs['id']);		
				return true;
			}
			
		}
		?>
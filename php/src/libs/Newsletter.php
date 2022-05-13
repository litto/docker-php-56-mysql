<?php
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
	class Newsletter extends MySql{
		
			/*
			 * Get next Order/Sequence in the Parent Levels
			*/
			function getNextOrder(){
				$query="SELECT max(`order`) FROM `cms_news`";
				$rec=	$this->fetchAll($query);
				if(count($rec)>0){
					return $rec[0]['max(`order`)']+1;
				}else{
					return 1;
				}
			}
			/*
			 * Add News Content
			*/	
function addsubscribe($inputs){
	    $ip=$_SERVER["REMOTE_ADDR"];

					$insert	=	array('email'=>$inputs['email'],'published'=>'1','subscribe_ip'=>$ip);
				$this->insert($insert,"cms_subscribers");		
				return true;
			}

			function addNews($inputs){
					$insert	=	array('subject'=>$this->addFilter($this->escapeHtml($inputs['title'])),	
						'content'=>$this->addFilter($inputs['content']),'published'=>$inputs['published'],'date_added'=>date("Y-m-d H:i:s"));
				$this->insert($insert,"cms_newsletter");		
				return true;
			}


			function addlist($inputs){
					$insert	=	array('newsletter_id'=>$inputs['newsletter_id'],'email'=>$inputs['email'],'status'=>$inputs['status']);

				$this->insert($insert,"cms_newsletter_sendinglist");		
				return true;
			}

	function lastInsertId()
		{
			return mysql_insert_id();
		}
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
					
					$query	=	"SELECT count(c.`newsletter_id`) FROM `cms_newsletter` c WHERE c.`newsletter_id`!=''";
					$query.=$qry;
					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`newsletter_id`)'];
					
					$query	=	"SELECT c.* FROM `cms_newsletter` c WHERE c.`newsletter_id`!=''";
					$query.=$qry;
					$query.=$order;
					$query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}
			
function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('cms_newsletter','`newsletter_id`='.$list[$i]);
					}
			}
			
			/*
			 * Set Order for Pages
			*/
				
			function setOrder($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('order'=>$list[$i][1]),"cms_newsletter",'`newsletter_id`='.$list[$i][0]);
				}
			}
			
			/*
			 * Un Publush records
			*/	
			function unpublishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('published'=>'0'),"cms_newsletter",'`newsletter_id`='.$list[$i]);
				}
			}
			
			
			/*
			 * Publush records
			*/
			
			function publishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('published'=>'1'),"cms_newsletter",'`newsletter_id`='.$list[$i]);
				}
			}
				function getNews($id){
				$query	=	'SELECT * FROM `cms_newsletter` WHERE `newsletter_id`='.$id;
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
				function getallmails($id){
				$query	=	'SELECT * FROM `cms_newsletter_sendinglist` WHERE `newsletter_id`='.$id;
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
			function getallunmails(){
				$id=0;
				$query	=	'SELECT * FROM `cms_newsletter_sendinglist` WHERE `status`='.$id;
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
			}

			?>
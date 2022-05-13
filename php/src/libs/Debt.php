<?php

	class Debt extends MySql{
		

		function addrecord($inputs){
		$insert=array('name'=>$inputs['name'],'designation'=>$inputs['designation'],'nationality'=>$inputs['nationality'],'organization'=>$inputs['organization'],'mail'=>$inputs['mail'],'cell'=>$inputs['cell'],'location'=>$inputs['location'],'postaladdress'=>$inputs['postaladdress'],'fax'=>$inputs['fax'],'phone'=>$inputs['phone'],'service_type'=>$inputs['service_type'],'additional_info'=>$inputs['additional_info'],'debtor_name'=>$inputs['debtor_name'],'debtor_designation'=>$inputs['debtor_designation'],'debtor_nationality'=>$inputs['debtor_nationality'],'debtor_organization'=>$inputs['debtor_organization'],'debtor_mail'=>$inputs['debtor_mail'],'debtor_cell'=>$inputs['debtor_cell'],'debtor_location'=>$inputs['debtor_location'],'debtor_postaladdress'=>$inputs['debtor_postaladdress'],'debtor_fax'=>$inputs['debtor_fax'],'debtor_phone'=>$inputs['debtor_phone'],'debtor_dueamount'=>$inputs['debtor_dueamount'],'debtor_currrency'=>$inputs['debtor_currrency'],'checkreturn'=>$inputs['checkreturn'],'inability'=>$inputs['inability'],'mailreturn'=>$inputs['mailreturn'],'phonedisconnect'=>$inputs['phonedisconnect'],'others'=>$inputs['others'],'other_reason'=>$inputs['other_reason'],'debtor_date_indebt'=>$inputs['debtor_date_indebt'],'comments'=>$inputs['comments'],'status'=>'0','ip'=>$inputs['ip']);
	
				$this->insert($insert,"cms_debtenquirys");		
				return true;
			}


	function lastInsertId()
		{
			return mysql_insert_id();
		}

function addimage($lastid,$image){
		$insert=array('enquiry_id'=>$lastid,'file'=>$image,'status'=>'1');
		
				$this->insert($insert,"cms_debtdoc");		
				return true;
			}

function listall($values){
					$start		=	$values['start'];
					$limit		=	$values['limit'];
					$mode			=	trim($values['mode']);
					$ord			=	trim($values['ord']);
					$keyword	=	trim($values['keyword']);		
					$filter		=	trim($values['filter']);
				
					$qry="";
					$order	=	'';	

	       $brand=$values['searchbrand'];
				
						
					if(!empty($filter)){
						if($filter=='featured'){
								$qry.=' AND c.`featured`=\'1\'';
						}
						if($filter=='archived'){
								$qry.=' AND c.`archived`=\'1\'';
						}
					}
		
					
					$query	=	"SELECT count(c.`id`) FROM `cms_debtenquirys` c WHERE c.`id`!=''";
					$query.=$qry;

					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`id`)'];
					
					$query	=	"SELECT c.* FROM `cms_debtenquirys` c WHERE c.`id`!=''";
					$query.=$qry;
					$query.=' ORDER BY id ASC';
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
					$this->update(array('status'=>'0'),"cms_debtenquirys",'`id`='.$list[$i]);
				}
			}
			
			
			
			function publishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('status'=>'1'),"cms_debtenquirys",'`id`='.$list[$i]);
				}
			}




		function deleteList($list){
				for($i=0;$i<count($list);$i++){
					$this->delete('cms_debtenquirys','`id`='.$list[$i]);
				}
			}

	function getdetails($id){
				 $query	=	"SELECT * FROM `cms_debtenquirys` WHERE `id`='$id' LIMIT 0,1";
				$rec		=	$this->fetchAll($query);
				
				return $rec;
			}

	function getdocdetails($id){
				 $query	=	"SELECT * FROM `cms_debtdoc` WHERE `enquiry_id`='$id'";
				$rec		=	$this->fetchAll($query);
				
				return $rec;
			}



}
?>
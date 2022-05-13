<?php

class Log extends MySql{


function getdetails($id){
				$query	=	"SELECT * FROM `cms_log` WHERE `id`='$id'";
				$rec		=	$this->fetchAll($query);
				return $rec;
			}


function geteditedcount($user,$id){
				$query	=	"SELECT * FROM `cms_log` WHERE `pid`='$id' AND `userid`='$user'";
				$rec		=	$this->fetchAll($query);
				return $rec;
			}

	function getall(){
		$id=1;
				$query	=	"SELECT * FROM `cms_log` WHERE `status`='$id'";
				$rec		=	$this->fetchAll($query);
				return $rec;
			}


function addlog($inputs){
	$logindate=date("Y/m/d H:i:s");
$ip=$_SERVER["REMOTE_ADDR"];
  $insert=array('activity'=>$inputs['activity'],'ip'=>$ip,'logdate'=>$logindate,'status'=>'1');

	$this->insert($insert,"cms_log");		
				return true;
}

function listall($values){
					$start		=	$values['start'];
					$limit		=	$values['limit'];
					$mode			=	trim($values['mode']);
					$ord			=	trim($values['ord']);
					$keyword	=	trim($values['keyword']);		
					$filter		=	trim($values['filter']);
					$user		=	trim($values['user']);

					$qry="";
					$order	=	'';	

	       		if(!empty($filter)){
						if($filter=='featured'){
								$qry.=' AND c.`featured`=\'1\'';
						}
						if($filter=='archived'){
								$qry.=' AND c.`archived`=\'1\'';
						}
					}
		
					
					$query	=	"SELECT count(c.`id`) FROM `cms_log` c WHERE c.`id`!=''";
					$query.=$qry;

					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`id`)'];
					
					$query	=	"SELECT c.* FROM `cms_log` c WHERE c.`id`!=''";
					$query.=$qry;
					$query.=' ORDER BY id DESC';
				   $query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}



function listalladmin($values){
					$start		=	$values['start'];
					$limit		=	$values['limit'];
					$mode			=	trim($values['mode']);
					$ord			=	trim($values['ord']);
					$keyword	=	trim($values['keyword']);		
					$filter		=	trim($values['filter']);

					$qry="";
					$order	=	'';	

	       		if(!empty($filter)){
						if($filter=='featured'){
								$qry.=' AND c.`featured`=\'1\'';
						}
						if($filter=='archived'){
								$qry.=' AND c.`archived`=\'1\'';
						}
					}
		
					
					$query	=	"SELECT count(c.`id`) FROM `cms_log` c WHERE c.`id`!=''";
					$query.=$qry;

					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`id`)'];
					
					$query	=	"SELECT c.* FROM `cms_log` c WHERE c.`id`!=''";
					$query.=$qry;
					$query.=' ORDER BY id DESC';
				   $query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}


}
?>
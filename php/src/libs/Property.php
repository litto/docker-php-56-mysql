<?php
class Property extends MySql{
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
function unpublishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('status'=>'0'),"cms_property",'`prop_id`='.$list[$i]);
		}
	}
	
	
	/*
	 * Publush records
	*/
	
	function publishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('status'=>'1'),"cms_property",'`prop_id`='.$list[$i]);
		}
	}


function deleteList($list){
					for($i=0;$i<count($list);$i++){
							
							$this->delete('cms_property','`prop_id`='.$list[$i]);
							
					}
			}

function listAllproperty($values){
		
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
		
		$query	=	"SELECT count(c.`prop_id`) FROM `cms_property` c WHERE c.`prop_id`!=''";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`prop_id`)'];
		
		$query	=	"SELECT * FROM `cms_property`";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
function listAllpropertyuser($values,$x){
		
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
		
		$query	=	"SELECT count(c.`prop_id`) FROM `cms_property` c WHERE c.`user_ref`=$x";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`prop_id`)'];
		
		$query	=	"SELECT * FROM `cms_property` WHERE `user_ref`=$x";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
function getpropertytype(){
		$query	=	"SELECT * FROM `cms_propertytypes`";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	
function getlocation(){
		$query	=	"SELECT * FROM `cms_location`";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}

function getuser(){
		$query	=	"SELECT * FROM `cms_user`";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
function lastInsertId()
		{
			return mysql_insert_id();
		}
function    addproperty($txtTitle,$date,$type,$sale,$price,$desc,$file,$area,$location,$latitude,$longitude,$fac,$hot,$user,$ref){
	echo $txtTitle;

		$insert	=	array('title'=>$txtTitle,'date_posted'=>$date,'type'=>$type,'sell_rent'=>$sale,'price'=>$price,'description'=>$desc,'image'=>$file,'area'=>$area,'location_id'=>$location,'latitude'=>$latitude,'longitude'=>$longitude,'facilities'=>$fac,'Hot_property'=>$hot,'user_ref'=>$user,'reference_number'=>$ref);
		$this->insert($insert,'cms_property');
	return(1);
	}
function getproperty($id){
		$query	=	'SELECT * FROM `cms_property` WHERE `prop_id`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	function getusername($id){
		$query	=	'SELECT * FROM `cms_user` WHERE `user_id`='.$id.' ';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}

function updatepropwithimage($txtTitle,$type,$sale,$price,$desc,$file,$area,$location,$latitude,$longitude,$fac,$hot,$user,$id){
	
	
	$this->update(array('title'=>$txtTitle,'type'=>$type,'sell_rent'=>$sale,'price'=>$price,'description'=>$desc,'image'=>$file,'area'=>$area,'location_id'=>$location,'latitude'=>$latitude,'longitude'=>$longitude,'facilities'=>$fac,'Hot_property'=>$hot,'user_ref'=>$user),'cms_property','`prop_id`='.$id);
return(1);


		}

function updateproperty($txtTitle,$type,$sale,$price,$desc,$area,$location,$latitude,$longitude,$fac,$hot,$user,$id){
	
	
	$this->update(array('title'=>$txtTitle,'type'=>$type,'sell_rent'=>$sale,'price'=>$price,'description'=>$desc,'area'=>$area,'location_id'=>$location,'latitude'=>$latitude,'longitude'=>$longitude,'facilities'=>$fac,'Hot_property'=>$hot,'user_ref'=>$user),'cms_property','`prop_id`='.$id);
return(1);


		}
function    addpropertydemo($txtTitle,$date,$type,$sale,$price,$desc,$file,$area,$location,$latitude,$longitude,$fac,$hot,$ref){
	


		$insert1	=	array('title'=>$txtTitle,'date_posted'=>$date,'type'=>$type,'sell_rent'=>$sale,'price'=>$price,'description'=>$desc,'image'=>$file,'area'=>$area,'location_id'=>$location,'latitude'=>$latitude,'longitude'=>$longitude,'facilities'=>$fac,'Hot_property'=>$hot,'referrence_number'=>$ref);

		$this->insert($insert1,"cms_demo");
	return(1);
	}
function getdemodetails($id){

		$query	=	"SELECT * FROM `cms_demo` WHERE `id`=$id";
		$rec	=	$this->fetchAll($query);

		return $rec;
	}
function getpropertyhot(){
$id=0;
		$query	=	"SELECT * FROM `cms_property` WHERE `Hot_property`=$id LIMIT 0,3";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
function getpropertyhotid($id){

		$query	=	"SELECT * FROM `cms_property` WHERE `prop_id`=$id";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
function getimageproperty($id){

		$query	=	"SELECT * FROM `cms_image` WHERE `prop_id`=$id";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
function getpropertyhotfull($values){
		
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
		$id=0;
		$query	=	"SELECT count(c.`prop_id`) FROM `cms_property` c WHERE c.`Hot_property`=$id";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`prop_id`)'];
		
		$query	=	"SELECT * FROM `cms_property`";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		return $rec;		
		
		
	}
function getsearch($keyword,$minprice,$maxprice,$type,$location,$sell,$start,$limit){
	 $location= $location;
		  $start		=	$start;
		$limit		=	$limit;
		$minprice = $minprice;
		$maxprice			= $maxprice;
		$keyword	=	$keyword;
		 $type		=	$type;
		
		$qry="";
		
		
		if(!empty($keyword)){
			$qry.=' AND LOWER(c.`title`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
		}
		if($type!=''){
			$qry.=" AND c.`type`='$type'";
		}
if($sell!=''){
			$qry.=" AND c.`sell_rent`='$sell'";
		}
if($location!=''){
			$qry.=" AND c.`location_id`='$location'";
		}
		if(!empty($minprice)){
	
	$qry.=" AND c.`price`>='$minprice'";
		}
		if(!empty($maxprice)){
		$qry.="AND c.`price`<='$maxprice'";

		}
		$query	=	"SELECT count(c.`prop_id`) FROM `cms_property` c WHERE c.`prop_id`!=''";
		 $query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`prop_id`)'];
		
		$query	=	"SELECT * FROM `cms_property` c WHERE c.`prop_id`!=''";
		  $query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);

		
		return $rec;		
		
		
	}
	function getimages(){

		$query	=	"SELECT * FROM `cms_property` WHERE `Hot_Property`=0";
		$rec	=	$this->fetchAll($query);
		return $rec;
		}
		function    addenquiry($Name,$Mail,$address,$phone,$place,$price,$date1,$userid){

		$insert	=	array('prop_name'=>$place,'date'=>$date1,'name'=>$Name,'address'=>$address,'email'=>$Mail,'phone'=>$phone,'cash'=>$price,'userid'=>$userid);
		$this->insert($insert,'cms_enquiry');
	return(1);
	}
}?>
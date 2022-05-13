<?php

	class Product extends MySql{
		
			/*
			 * Get next Order/Sequence in the Parent Levels
			*/
	function getdetails($id){
				 $query	=	"SELECT * FROM `cms_products` WHERE `id`='$id' LIMIT 0,1";
				$rec		=	$this->fetchAll($query);
				
				return $rec;
			}
			function updatecount($count,$id){
 $d4="UPDATE cms_products set `viewcount`='$count' WHERE id='$id'";
	$s355=mysql_query($d4);	
	return true;

			}
		function getall(){
				$query	=	"SELECT *  FROM `cms_products`";
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
				function getallpublished(){
			    $id=1;
				$query	=	"SELECT *  FROM `cms_products` WHERE `publish`='$id' ORDER BY `id` ASC";
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
				function getallname(){
				$query	=	"SELECT distinct(name)  FROM `cms_products` LIMIT 1,10";
				$rec		=	$this->fetchAll($query);
				return $rec;
			}



	function getnamedetails($name){
				$query	=	"SELECT * FROM `cms_products` WHERE `name`='$name'";
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
				

function getallproducts(){
				$query	=	"SELECT count(id) as cnt FROM `cms_products` WHERE  `publish`!='3'";
					 $fd=mysql_query($query);
				$rec		=	mysql_fetch_assoc($fd);
				
				return $rec;
			}




 function listproduct($values){

					$start		=	$values['start'];
					$limit		=	$values['limit'];
					$mode			=	trim($values['mode']);
					$ord			=	trim($values['ord']);
					$keyword	=	trim($values['keyword']);		
					$filter		=	trim($values['filter']);
					$category=strip_tags($values['category']);
					$brand=strip_tags($values['brand']);
					$product=strip_tags($values['product']);
					
					$qry="";
					$order	=	'';					
					if(!empty($keyword)){
						$qry.=' AND c.`category` LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
					}	
					      if(!empty($brand)){
						$qry.=' AND c.`brand` LIKE \'%'.$this->addFilter($this->escapeHtml($brand)).'%\'';
					}
					if(!empty($product)){
							$qry.=' AND c.`name` LIKE \'%'.$product.'%\'';
					}	
	if(!empty($category)){
						$qry.=' AND c.`category` LIKE \'%'.$this->addFilter($this->escapeHtml($category)).'%\'';
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



					
					$query	=	"SELECT count(c.`id`) FROM `cms_products` c WHERE c.`publish` !='0' AND c.`publish` !='3' AND c.`publish` !='4'";
					$query.=$qry;

					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`id`)'];
					
					$query	=	"SELECT c.* FROM `cms_products` c WHERE c.`publish` !='0' AND c.`publish` !='3' AND c.`publish` !='4' ";
					$query.=$qry;
			
	
	$query.=" ORDER BY c.`id` ASC";

		$query.=' LIMIT '.$start.','.$limit;
				//echo $query;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}






			/*
			 * Un Publush records
			*/	
			function unpublishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('publish'=>'0'),"cms_products",'`id`='.$list[$i]);
				}
			}
			
			
			
			function publishList($list){
				for($i=0;$i<count($list);$i++){
					$this->update(array('publish'=>'1'),"cms_products",'`id`='.$list[$i]);
				}
			}




		function deleteList($list){
				for($i=0;$i<count($list);$i++){
					$this->delete('cms_products','`id`='.$list[$i]);
				}
			}

		
		function addproduct($inputs){
		$insert=array('name'=>$inputs['productname'],'price'=>$inputs['price'],'product_img'=>$inputs['productimage'],'description'=>$inputs['description'],'publish'=>$inputs['publish'],'add_date'=>$inputs['adddate'],'viewcount'=>$inputs['viewcount'],'ip'=>$inputs['ip'],'type'=>$inputs['type'],'order'=>$inputs['order'],'parent'=>$inputs['parent'],'level'=>$inputs['level']);
	
				$this->insert($insert,"cms_products");		
				return true;
			}

function addattributes($attributename,$attributedescription,$lastid){
		$insert=array('productid'=>$lastid,'name'=>$attributename,'description'=>$attributedescription,'status'=>'1');
		
				$this->insert($insert,"cms_productsattributes");		
				return true;
			}

function getallattributes($id){
	$query	=	"SELECT * FROM `cms_productsattributes` WHERE `productid`='$id' AND `status`='1'";
				$rec		=	$this->fetchAll($query);
				return $rec;
}



		function editproductimage($inputs){
		$insert=array('name'=>$inputs['productname'],'price'=>$inputs['price'],'product_img'=>$inputs['productimage'],'description'=>$inputs['description'],'publish'=>$inputs['publish'],'add_date'=>$inputs['edit_date'],'ip'=>$inputs['ip'],'type'=>$inputs['type'],'order'=>$inputs['order'],'parent'=>$inputs['parent'],'level'=>$inputs['level']);
		
			$this->update($insert,"cms_products",'`id`='.$inputs['id']);		
				return true;
			}

	function editproduct($inputs){
		$insert=array('name'=>$inputs['productname'],'price'=>$inputs['price'],'description'=>$inputs['description'],'publish'=>$inputs['publish'],'add_date'=>$inputs['edit_date'],'ip'=>$inputs['ip'],'type'=>$inputs['type'],'order'=>$inputs['order'],'parent'=>$inputs['parent'],'level'=>$inputs['level']);
	
				$this->update($insert,"cms_products",'`id`='.$inputs['id']);	
				return true;
			}


	function lastInsertId()
		{
			return mysql_insert_id();
		}

function listallproducts($values){
					$start		=	$values['start'];
					$limit		=	$values['limit'];
					$mode			=	trim($values['mode']);
					$ord			=	trim($values['ord']);
					$keyword	=	trim($values['keyword']);		
					$filter		=	trim($values['filter']);
					$searchcategory=$values['searchcategory'];
					$email=$values['searchemail'];
					$product=$values['searchproduct'];
					$qry="";
					$order	=	'';	

	       $brand=$values['searchbrand'];
				
						if(!empty($searchcategory)){
						$qry.="  AND c.`category` LIKE '%".$this->addFilter($this->escapeHtml($searchcategory))."%'";
					}	
        
	           if(!empty($product)){
							$qry.=" AND c.`name` LIKE '%".$product."%'";
					}
			
								if(!empty($email)){
						$qry.="  AND c.`product_owner`='$email'";
					}
			    if(!empty($brand)){
							$qry.=" AND c.`brand` LIKE '%".$brand."%'";
					}
			
						
					if(!empty($filter)){
						if($filter=='featured'){
								$qry.=' AND c.`featured`=\'1\'';
						}
						if($filter=='archived'){
								$qry.=' AND c.`archived`=\'1\'';
						}
					}
		
					
					$query	=	"SELECT count(c.`id`) FROM `cms_products` c WHERE c.`publish`!='4'";
					$query.=$qry;

					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`id`)'];
					
					$query	=	"SELECT c.* FROM `cms_products` c WHERE c.`publish`!='4'";
					$query.=$qry;
					$query.=' ORDER BY id ASC';
				   $query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}




function listuserproducts($values){
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
		
					
					$query	=	"SELECT count(c.`id`) FROM `cms_products` c WHERE c.`publish`!='0' AND c.`type`='0'";
					$query.=$qry;

					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`id`)'];
					
					$query	=	"SELECT c.* FROM `cms_products` c WHERE c.`publish`!='0' AND c.`type`='0'";
					$query.=$qry;
					$query.=' ORDER BY c.`order` ASC';
				   $query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}




function listuserservices($values){
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
		
					
					$query	=	"SELECT count(c.`id`) FROM `cms_products` c WHERE c.`publish`!='0' AND c.`type`='1'";
					$query.=$qry;

					$rec	=	$this->fetchAll($query);
					$this->totalRecords	=	$rec[0]['count(c.`id`)'];
					
					$query	=	"SELECT c.* FROM `cms_products` c WHERE c.`publish`!='0' AND c.`type`='1'";
					$query.=$qry;
					$query.=' ORDER BY c.`order` ASC';
				   $query.=' LIMIT '.$start.','.$limit;
					$rec	=	$this->fetchAll($query);
					$this->pageRecords	=	count($rec);					
					return $rec;		
		
			}

		}

		?>
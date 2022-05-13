<?php

	class Productimage extends MySql{
		
			/*
			 * Get next Order/Sequence in the Parent Levels
			*/

	function getall(){
				 $query	=	"SELECT * FROM `cms_productimages` where status='1' ";
				$rec		=	$this->fetchAll($query);
				
				return $rec;

			}
function getproductimages($id){
				 $query	=	"SELECT * FROM `cms_productimages` where product_id='$id' AND status='1'";
				$rec		=	$this->fetchAll($query);
				
				return $rec;

			}

			function getimages($id){
				 $query	=	"SELECT * FROM `cms_productimages` where product_id='$id' AND status!='3' AND status!='4'";
				$rec		=	$this->fetchAll($query);
				
				return $rec;

			}

function addimage($lastid,$nm,$image,$adddate,$ip){
	$insert=array('product_id'=>$lastid,'imagename'=>$nm,'imageloc'=>$image,'status'=>'1','add_date'=>$adddate,'ip'=>$ip);

	$this->insert($insert,"cms_productimages");		
				return true;
}
	



		function deleteList($list){
				for($i=0;$i<count($list);$i++){
					$this->delete('cms_productimages','`id`='.$list[$i]);
				}
			}





}
?>
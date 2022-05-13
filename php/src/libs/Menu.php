<?php
class Menu extends MySql{
/*
 * Date:8-16-2012
 * Login Form , entry to the application
 * Auhthor : Litto chacko
 * Email:littochackomp@gmail.com
*/
	function listall(){
	
	$query="SELECT * FROM `cms_tableindex`";
	$rec	=	$this->fetchAll($query);
	return $rec;
	}
function updateall($list){
	

					for($i=1;$i<=count($list);$i++){
					
						$input=array('status'=>$list[$i]);
						
				$this->update($input,"cms_tableindex",'`id`='.$i);
							
					}
					return 1;
			}
			function listallpublished(){
	
	$query="SELECT * FROM `cms_tableindex` WHERE `status`='1'";
	$rec	=	$this->fetchAll($query);
	return $rec;
	}
}

?>
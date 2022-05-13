<?php

	class Contacts extends MySql{
		
			
			/*
			 * Add Media Item
			*/			
			function updateSettings($inputs){
				$id=1;	
	$this->update(array('company'=>$inputs['company'],'contact_person'=>$inputs['contact_person'],'telephone'=>$inputs['telephone'],'fax'=>$inputs['fax'],'email'=>$inputs['email'],'mobile'=>$inputs['mobile'],'zipcode'=>$inputs['zipcode'],'country'=>$inputs['country'],'state'=>$inputs['state'],'city'=>$inputs['city'],'start_time'=>$inputs['start_time'],'end_time'=>$inputs['end_time']),'cms_contact','`id`='.$id);

				return true;
			}
			function updateseo($inputs){
				$id=1;	
	$this->update(array('seo'=>$inputs['seo'],'footer'=>$inputs['footer']),'cms_contact','`id`='.$id);

				return true;
			}
			
			
			/*
			 * Get Settings
			*/
			
			function getSettings(){
				$query	=	"SELECT * FROM `cms_contact` LIMIT 0,1";
				$rec		=	$this->fetchAll($query);
				return $rec;
			}

						function getbanSettings(){
				$query	=	"SELECT * FROM `cms_bannerset` LIMIT 0,1";
				$rec		=	$this->fetchAll($query);
				return $rec;
			}
			


			function updatebanSettings($inputs){
				$id=1;	
	$this->update(array('banner1_tit1'=>$inputs['banner1_tit1'],'banner1_tit2'=>$inputs['banner1_tit2'],'banner1_tit3'=>$inputs['banner1_tit3'],'banner2_tit1'=>$inputs['banner2_tit1'],'banner2_tit2'=>$inputs['banner2_tit2'],'banner2_tit3'=>$inputs['banner2_tit3']),'cms_bannerset','`id`='.$id);

				return true;
			}













			
	}

?>
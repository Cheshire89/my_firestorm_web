<?php

	class About extends fireSQL
	{
		function About(){
 
		}
		
		function getAbout(){
			$resultHTML = '';
			$data = $this->select('about',array("bannerText","bannerDesc","bannerImg","aboutTitle","aboutPageText"));
			return $data;
		}


		function updateAbout($post, $files){
		      $db = db::instance();
          
			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}

			if($files['bannerImg']["tmp_name"] != ""){
				$image = new upload_image($files['bannerImg'], '../about/', array('jpg', 'png', 'gif', 'jpeg'));
			}
			if($bannerText != "" && $bannerDesc != ""){
				if($image != ""){
				    $this->update('about', array("bannerText", "bannerDesc" ,"bannerImg"), array($bannerText, $bannerDesc, $image), array('aboutID'=>1));
				}else{
					$this->update('about', array("bannerText", "bannerDesc"), array($bannerText, $bannerDesc), array('aboutID'=>1));
				}
			}else if($aboutTitle != "" && $aboutPageText != ""){
				$this->update('about', array("aboutTitle", "aboutPageText"), array($aboutTitle, $aboutPageText), array('aboutID'=>1));
			}else{
				return false;
			}
			return true;
		}

	}

?>
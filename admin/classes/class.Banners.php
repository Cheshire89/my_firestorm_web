<?php 
	class Banners extends fireSQL
	{
		
		function Banners()
		{
			
		}

		function save_banner($post, $files){
			$db = db::instance();

			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}


			if($files['bannerImg']["tmp_name"] != ""){
				$image = new upload_image($files['bannerImg'], '../banners/', array('jpg', 'png', 'gif', 'jpeg'));
			}

		    $insertID = $this->insert('banners', array("pageName", "bnText", "bnImgPath", "bnImgDesc"), array($pageName, $bannerText, $image->uploaded_file, $bannerDes));

		    return $insertID;	
		}
		function update_banner($post, $files){			
			$db = db::instance();

			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);

			}

			if($files['bannerImg']["tmp_name"] != ""){
				$image = new upload_image($files['bannerImg'], '../banners/', array('jpg', 'png', 'gif', 'jpeg'));
			}
		    $insertID = $this->update('banners', array("pageName", "bnText", "bnImgPath", "bnImgDesc"), array($pageName, $bannerText, $image->uploaded_file, $bannerDes), array('bannerID' => $bannerID));
		    return $insertID;
		}

		function get_admin_banner($pageName){
			$db = db::instance();
			$pageName = $db->real_escape_string($pageName);
			$slideData = $this->select('banners', array("*"), array('pageName' => $pageName));
			$slide = $slideData->fetch_assoc();
			return $slide;
		}
	}
?>
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

		function getBanner($pageName){
			$db = db::instance();
			$pageName = $db->real_escape_string($pageName);
			$slideData = $this->select('banners', array("*"), array('pageName' => $pageName));
			$banner = $slideData->fetch_assoc();
			$banner["bnText"] = explode(' ', $banner["bnText"]);
			$textStr = '';
			$count = 1;
			foreach($banner["bnText"] as $chunk){
				
				if ($count == 1) {
				  $textStr .= $chunk;
				}else if($count % 2 == 0){
				  $textStr .= '<strong>'.$chunk.'</strong>';
				}else if($count % 3 == 0){
				  $textStr .= '<i><strong>'.$chunk.'</strong></i>';
				}else{
				  $textStr .= $chunk;
				}
				$count++;
			}
			$banner["bnText"] = $textStr;
			return $banner;
		}
	}
?>
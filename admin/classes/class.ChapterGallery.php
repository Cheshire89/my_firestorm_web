<?php 
	
	class ChapterGallery extends fireSQL{

		private $imagesObj;

		function ChapterGallery($chapterID = null){
			$db = db::instance();
			if($chapterID != null){
				$this->imagesObj = $this->get_gallery_obj($db->real_escape_string($chapterID));
			}
		}

		function get_gallery_obj($chapterID){
			$galleryObj = $this->select('gallery',array("*"),array('chapterID'=>$chapterID));
			return $galleryObj;
		}

		function print_chapter_gallery(){
			 $resultHtml = '';
			 while($row = $this->imagesObj->fetch_assoc()){
			 	$row["imgID"];
			 	$row["chapterID"];
			 	$row["imgAlt"];
			 	$row["imgPath"];
			 	$resultHtml .= '';
			 }
			 return $resultHtml;
		}

		function print_chapter_gallery_admin(){
			 $resultHtml = '';
			 while($row = $this->imagesObj->fetch_assoc()){
			 	$resultHtml .= '<tr>
	                            <td>'.$row["imgID"].'</td>
	                            <td>'.$row["imgAlt"].'</td>
	                            <td><img class="img-responsive center-block" src="'.$row["imgPath"].'" alt="'.$row["imgAlt"].'"></td>
	                            <td class="controls">
	                              <div class="btn-group pull-right">
	                                <button type="button" class="btn btn-sm fs-btn-green edit" data-id="1"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
	                                <button type="button" class="btn btn-sm fs-btn-red delete" data-id="1"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
	                              </div>
	                            </td>
	                          </tr>';
			 }
			 return $resultHtml;
		}

		function save_image($post, $files){
			$db = db::instance();
			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}

			if($files['imgFile']["tmp_name"] != ""){
				$image = new upload_image($files['imgFile'], '../chapter_gallery/', array('jpg', 'png', 'gif', 'jpeg'));
			}

			$articleDate = date('U');

		    $insertID = $this->insert('gallery', array("chapterID", "imgAlt", "imgPath"), array($chapterID, $imgAlt, $image->uploaded_file));

		    return $insertID;			

		}

		function update_image($post, $files){
			$db = db::instance();
			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}

			if($files['imgFile']["tmp_name"] != ""){
				$image = new upload_image($files['imgFile'], '../chapter_gallery/', array('jpg', 'png', 'gif', 'jpeg'));
			}

			if($image != ""){				
				$this->update('gallery', array("chapterID", "imgAlt", "imgPath"), array($chapterID, $imgAlt, $image->uploaded_file), array('imgID'=>$imgID));
			}else{
				$this->update('gallery', array("chapterID", "imgAlt"), array($chapterID, $imgAlt), array('imgID'=>$imgID));
			}

			return true;
		}

		function delete_img($imgID){
			$db = db::instance();
			$img = $db->real_escape_string($imgID);
			$result = $this->delete('gallery',array('imgID' => $img));
			return $result;
		}


	}
?>
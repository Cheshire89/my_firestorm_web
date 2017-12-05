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
			 	$row["imgPath"] = substr($row["imgPath"], 3);
			 	$resultHtml .= '<div class="col-sm-6 col-md-4 col-lg-3 grid-item">
					                <img class="img-responsive" src="'.$row["imgPath"].'" alt="'.$row["imgAlt"].'" img-id="'.$row["imgID"].'"/>
					            </div>';
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
	}
?>
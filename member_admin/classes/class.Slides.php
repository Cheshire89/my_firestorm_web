<?php

	class Slides extends fireSQL
	{
		function Slides(){

		}
		
		function getSlides(){
			$resultHTML = '';
			$data = $this->select('sliders',array("slideText","slideDesc","slideImg","slideID"));
			while($data){
				$resultHTML .= '';
			}
			return $resultHTML;
		}

		function getAdminSlides(){
			$data = db::instance();
			$resultHTML = '';
			$data = $this->select('sliders',array("slideText","slideDesc","slideImg","slideID"));
			while($row = $data->fetch_assoc()){
				$resultHTML .= '<tr>
		                            <td>'.$row["slideID"].'</td>
		                            <td>'.$row["slideText"].'</td>
		                            <td>'.$row["slideDesc"].'</td>
		                            <td>'.$row["slideImg"].'</td>
		                            <td class="text-center"><img class="img-responsive center-block" src="'.$row["slideImg"].'" alt=""></td>
		                            <td class="controls">
		                              <div class="btn-group block pull-right">
		                                <button type="button" class="btn btn-sm fs-btn-green edit" data-id="'.$row["slideID"].'">Edit</button>
		                                <button type="button" class="btn btn-sm fs-btn-red delete" data-id="'.$row["slideID"].'">Delete</button>
		                              </div>
		                            </td>
                                </tr>';
			}

			return $resultHTML;
		}

		function saveSlide($post, $files){
			$db = db::instance();

			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}

			if($files['slideImg']["tmp_name"] != ""){
				$image = new upload_image($files['slideImg'], '../sliders/', array('jpg', 'png', 'gif', 'jpeg'));
			}

		 $insertID = $this->insert('sliders', array("slideText", "slideDesc" ,"slideImg"), array($slideText, $slideDesc, $image->uploaded_file));

		    return $insertID;
		}

		function updateSlide($post, $files){
			$db = db::instance();

			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}


			if($files['slideImg']["tmp_name"] != ""){
				$image = new upload_image($files['slideImg'], '../sliders/', array('jpg', 'png', 'gif', 'jpeg'));
			}

			if($image != ""){
			    $this->update('sliders', array("slideText", "slideDesc" ,"slideImg"), array($slideText, $slideDesc, $image->uploaded_file), array('slideID'=>$slideId));
			}else{
				$this->update('sliders', array("slideText", "slideDesc"), array($slideText, $slideDesc), array('slideID'=>$slideId));
			}
  
			return true;
		}

		function deleteSlide($slideId){
			$db = db::instance();
			$slideId = $db->real_escape_string($slideId);
			$deleted = $this->delete('sliders',array('slideID' => $slideId));
			return $deleted;
		}
	}

?>
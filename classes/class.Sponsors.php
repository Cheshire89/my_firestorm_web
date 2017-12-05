<?php 
	
	class Sponsors extends fireSQL{

		private $imagesObj;

        function __construct($eventID = null) {
            $this->Sponsors($eventID);
        }

		function Sponsors($eventID = null){
			$db = db::instance();
			if($eventID != null){
				$this->imagesObj = $this->get_gallery_obj($db->real_escape_string($eventID));
			}
		}

		function get_gallery_obj($eventID){
			$galleryObj = $this->select('sponsors',array("*"),array('eventID'=>$eventID));
			return $galleryObj;
		}

		function print_sponsors(){
			 $resultHtml = '';
			 while($row = $this->imagesObj->fetch_assoc()){
			 	$resultHtml .= '<a class="btn btn-default fs-ico-btn" href="'.$row["sponsorLink"].'" target="_blank" title="'.$row["sponsorName"].'"><img src="'.$row["sponsorImg"].'" class="img-responsive" alt="'.$row["sponsorName"].' Image"/></a>';
			 }
			 return $resultHtml;
		}

		function print_sponsor_gallery_admin(){
			 $resultHtml = '';
			 while($row = $this->imagesObj->fetch_assoc()){
			 	$resultHtml .= '<tr>
	                            <td><img class="img-responsive center-block" src="'.$row["sponsorImg"].'" alt="'.$row["sponsorName"].'"></td>
	                            <td class="title">'.$row["sponsorName"].'</td>
	                            <td>'.$row["sponsorLink"].'</td>
	                            
	                            <td>
	                              <div class="btn-group pull-right">
	                                <button type="button" class="btn btn-sm fs-btn-green edit" data-id="'.$row["imgID"].'"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
	                                <button type="button" class="btn btn-sm fs-btn-red delete" data-id="'.$row["imgID"].'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
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

			if($files['sponsorImg']["tmp_name"] != ""){
				$image = new upload_image($files['sponsorImg'], '../sponsor_gallery/', array('jpg', 'png', 'gif', 'jpeg'));
			}

		    $insertID = $this->insert('sponsors', array("eventID", "sponsorName", "sponsorImg", "sponsorLink"), array($eventID, $sponsorName, $image->uploaded_file, $sponsorLink));

		    return $insertID;			
		}

		function update_image($post, $files){
			$db = db::instance();
			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}

			if($files['sponsorImg']["tmp_name"] != ""){
				$image = new upload_image($files['sponsorImg'], '../sponsor_gallery/', array('jpg', 'png', 'gif', 'jpeg'));
			}

			if($image != ""){				
				$this->update('sponsors', array("eventID", "sponsorName", "sponsorImg", "sponsorLink"), array($eventID, $sponsorName, $image->uploaded_file, $sponsorLink), array('imgID'=>$imgID));
			}else{
				$this->update('sponsors', array("eventID", "sponsorName", "sponsorLink"), array($eventID, $sponsorName, $sponsorLink), array('imgID'=>$imgID));
			}

			return true;
		}

		function delete_img($imgID){
			$db = db::instance();
			$img = $db->real_escape_string($imgID);
			$result = $this->delete('sponsors',array('imgID' => $img));
			return $result;
		}


	}
?>
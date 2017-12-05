<?php

	class General extends fireSQL
	{
		function General(){

		}
		
		function getGeneral(){
			$resultHTML = '';
			$data = $this->select('general',array("fsLink","fsEmail","fsPass","facebookV","facebookH","twLink","twEmail","twPas","twitterV","twitterH","liLink","liEmail","liPas","linkedInV","linkedInH","ytLink","ytEmail","ytPas","youTubeV","youTubeH","inLink","inEmail","inPas","instagramV","instagramH"));
			return $data;
		}

		function updateGeneral($post){
			foreach($post as $key => $var) {
				${$key} = $this->db->real_escape_string($var);
			}

		    $insertID = $this->	update('general', array("fsLink","fsEmail","fsPass","facebookV","facebookH","twLink","twEmail","twPas","twitterV","twitterH","liLink","liEmail","liPas","linkedInV","linkedInH","ytLink","ytEmail","ytPas","youTubeV","youTubeH","inLink","inEmail","inPas","instagramV","instagramH"), array($fsLink,$fsEmail,$fsPass,$facebookV,$facebookH,$twLink,$twEmail,$twPas,$twitterV,$twitterH,$liLink,$liEmail,$liPas,$linkedInV,$linkedInH,$ytLink,$ytEmail,$ytPas,$youTubeV,$youTubeH,$inLink,$inEmail,$inPas,$instagramV,$instagramH),array('generalID' => 1));
		    return true;
		}
	}

?>
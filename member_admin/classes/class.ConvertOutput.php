<?php 
class ConvertOutput
{
	 function ConvertOutput(){

	}

	// Function take comma delimited string and returns and array
	function tagsToArray($tagString){
		$resultArray = array();	
		$tagString = explode(',', $tagString);
		foreach($tagString as $fragment){
			$fragment = str_replace(' ','', $fragment);
			$fragment = str_replace(',','', $fragment);
			$fragment = '&#35'.$fragment;
			array_push($resultArray, $fragment);
		}
		return $resultArray;
	}
}
?>  
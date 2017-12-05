<?php 
	class Industry extends fireSQL
	{
		
		function Industry(){
			
		}

		function get_all(){
			return $this->select('industry', array("*"));
		}

		function html_options_list($active = null){
			$db = db::instance();
			$resultHtml = '';
			$data = $this->get_all();
			if(!$active){
				while($row = $data->fetch_assoc()){
					$resultHtml .= '<option value="'.$row["inID"].'">'.$row["industryName"].'</option>';
				}
			}else{
				while($row = $data->fetch_assoc()){
					if($active == $row["inID"]){
						$resultHtml .= '<option value="'.$row["inID"].'" selected="selected">'.$row["industryName"].'</option>';
					}else{
						$resultHtml .= '<option value="'.$row["inID"].'">'.$row["industryName"].'</option>';
					}
				}
			}
			return $resultHtml;
		}	
	}
?>
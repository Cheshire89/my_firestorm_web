<?php

    class Slides extends fireSQL {
        
		function __construct(){

		}
		
		function getSlides(){
			$resultHTML = '';
			$data = $this->select('sliders',array("slideText","slideDesc","slideImg","slideID"));
            $count = 0;
			while($row = $data->fetch_assoc()){
			     
                 $slideText = $row['slideText'];
                 $slideDesc = $row['slideDesc'];
                 $slideImg = substr($row['slideImg'], 1);
                 $count++;
                
                 
				 $resultHTML .= '<div class="row slide">
                                    <img class="img-responsive center-block" src="'.$slideImg.'" style="width:100%; ">
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                                                <h1 class="text-center">'.$slideText.'</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
			}
            
			return $resultHTML;
		}
    }
?>
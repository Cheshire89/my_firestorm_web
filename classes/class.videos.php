<?php

class videos {
    
    function videos() {
        
    }
    
    function getAllVideos() {
        $db = db::instance();
        $getAll = $db->query("SELECT * FROM videos WHERE `videoCategory` != 'Testimonial' ORDER BY vID DESC");
        return $this->print_videos($getAll);
    }

    function getTestimonials(){
      $db = db::instance();
      $getAll = $db->query("SELECT * FROM videos WHERE `videoCategory` = 'Testimonial' ORDER BY vID DESC");
      return $this->print_videos($getAll);
    }

    function print_videos($data){
       while($row = $data->fetch_assoc()) {
            
            $videoTitle = $row['videoTitle'];
            $videoLink = $row['videoLink'];
            $videoCategory = $row['videoCategory'];
                if($row['videoCategory'] != 'Testimonial'){
                   $class = 'col-xs-6 col-sm-4 col-md-4';
                }else{
                   $class = 'col-xs-6 col-sm-4 col-md-12';
                }
            $videoID = $row['videoId'];
            $videoAdded = date("m/d/Y", strtotime($row['videoAdded']));
            
            $results .= '<div class="'.$class.' video-container">
                          <div class="thumbnail">
                              <img class="img-responsive" src="" alt="">
                              <i class="fa fa-play-circle" aria-hidden="true" data-toggle="modal" data-target=".modal"></i>
                            <div class="caption">
                              <h5 class="fs-header">'.$videoTitle.'</h5>
                            </div>
                          </div>
                          <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="'.$videoLink.'" allowfullscreen></iframe>
                          </div>
                        </div>';
            
        }
        
        return $results;
    }
}


?>
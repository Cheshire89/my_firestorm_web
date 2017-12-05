<?php

require_once("classes/config.php");
if(isset($_POST['videoTitle']) && $_POST['videoTitle'] != "" || isset($_POST['videoCategory']) && $_POST['videoCategory'] != "") {
  
    $db = db::instance();
    
    $videoTitle = $db->real_escape_string($_POST['videoTitle']);
    $videoCategory = $db->real_escape_string($_POST['videoCategory']);
    
    if($videoTitle != "" && $videoCategory != "") {
        $search = $db->query("SELECT * FROM `videos` WHERE `videoTitle` LIKE '%$videoTitle%' || videoCategory LIKE '%$videoCategory%' ORDER BY videoAdded DESC");
    } else if($videoTitle == "" && $videoCategory != "") {
        $search = $db->query("SELECT * FROM `videos` WHERE `videoCategory` LIKE '%$videoCategory%' ORDER BY videoAdded DESC");
        
    } else if($videoTitle != "" && $videoCategory == "") {
        $search = $db->query("SELECT * FROM `videos` WHERE `videoTitle` LIKE '%$videoTitle%' ORDER BY videoAdded DESC");
    }else{
    }
    
    while($row = $search->fetch_assoc()) {
        $videoTitle = $row['videoTitle'];
        $videoLink = $row['videoLink'];
        
        $results .= '<div class="col-md-3 col-sm-4 col-xs-6 video-container">
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
    
    print($results);
    
} else {
    print("error");
}
?>
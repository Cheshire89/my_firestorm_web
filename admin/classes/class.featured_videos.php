<?php

class featured_videos {
    
    public $videos;
    
    function featured_videos() {
        
        $db = db::instance();
        
        $results = "";
        $getFeatured = $db->query("SELECT * FROM featured_video ORDER BY fvID ASC");
        while($row = $getFeatured->fetch_assoc()) {
            
            $fvID = $row['fvID'];
            $featVidLink = $row['featVidLink'];
            $scheduleFeatVideo = $row['scheduleFeatVideo'];
            $featVideoStart = $row['featVideoStart'];
            $featVideoEnd = $row['featVideoEnd'];
            $scheduleFeatVideo = $row["scheduleFeatVideo"];
            
            if($featVideoStart != "") {
                $featVideoStart = date("m-d-Y", $featVideoStart);
            }
            
            if($featVideoEnd != "") {
                $featVideoEnd = date("m-d-Y", $featVideoEnd);
            }
            
            $results .= '<tr class="video-each">
                            <td class="link">'.$featVidLink.'</td>
                            <td>'.$scheduleFeatVideo.'</td>
                            <td class="dateStart">'.$featVideoStart.'</td>
                            <td class="dateEnd">'.$featVideoEnd.'</td>
                            <td>
                               <div class="btn-group block">
                                
                                <button type="button" class="btn btn-sm fs-btn-red deleteFeatVideo" data-id="'.$fvID.'">Delete</button>
                              </div>
                            </td>
                         </tr>';
        }
        
        $this->videos = $results;
    }
    
}

?>
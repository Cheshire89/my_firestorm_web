<?php

class videos {
    
    function __constructor() {
        
    }
    
    function getAllVideos() {
        $db = db::instance();
        
        $getAll = $db->query("SELECT * FROM videos ORDER BY vID DESC");
        while($row = $getAll->fetch_assoc()) {
            
            $videoTitle = $row['videoTitle'];
            $videoLink = $row['videoLink'];
            $videoCategory = $row['videoCategory'];
            $videoID = $row['vID'];
            $videoAdded = date("m/d/Y", strtotime($row['videoAdded']));
            
            $results .= '<tr class="editable-row">
                            <td class="title">'.$videoTitle.'</td>
                            <td>'.$videoLink.'</td>
                            <td>'.$videoCategory.'</td>
                            <td class="date">'.$videoAdded.'</td>
                            <td>
                              <div class="checkbox">
                                  <input type="checkbox" id="videoId'.$videoID.'" value="'.$videoID.'" name="videos">
                                <label for="videoId'.$videoID.'">
                                </label>
                              </div>
                            </td>
                          </tr>';
            
        }
        
        return $results;
    }
    
}


?>
<?php

require_once("classes/config.php");

if(isset($_POST['videoTitle']) && $_POST['videoTitle'] != "" || isset($_POST['videoCategory']) && $_POST['videoCategory'] != "") {
    
    $db = db::instance();
    
    $videoTitle = $db->real_escape_string($_POST['videoTitle']);
    $videoCategory = $db->real_escape_string($_POST['videoCategory']);
    
    if($videoTitle != "" && $videoCategory != "") {
        $search = $db->query("SELECT * FROM videos WHERE videoTitle LIKE '%$videoTitle%' || videoCategory LIKE '%$videoCategory%' ORDER BY videoAdded DESC");
    } else if($videoTitle == "" && $videoCategory != "") {
        $search = $db->query("SELECT * FROM videos WHERE videoCategory LIKE '%$videoCategory%' ORDER BY videoAdded DESC");
    } else if($videoTitle != "" && $videoCategory == "") {
        $search = $db->query("SELECT * FROM videos WHERE videoTitle LIKE '%$videoTitle%' ORDER BY videoAdded DESC");
    }
    
    while($row = $search->fetch_assoc()) {
        $videoTitle = $row['videoTitle'];
        $videoLink = $row['videoLink'];
        $videoCategory = $row['videoCategory'];
        $videoID = $row['videoId'];
        $videoAdded = date("m/d/Y", strtotime($row['videoAdded']));
        
        $results .= '<tr class="editable-row">
                        <td><img class="img-responsive center-block" alt="img-title" src="img/event-placeholder.jpg"/> </td>
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
    
    print($results);
    
} else {
    print("error");
}
?>
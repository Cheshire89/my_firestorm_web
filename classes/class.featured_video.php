<?php

class featured_video {
    
    public $video;
    
    function __construct() {
        $this->featured_video();
    }
    
    function featured_video() {
        
        $db = db::instance();
        $featureLink = "";
        
        $today = mktime(0,0,0,date("m"),date("d"),date("Y"));
        //print("SELECT * FROM featured_video WHERE scheduleFeatVideo = 'yes' && featVideoStart <= '$today' && featVideoEnd >= '$today' LIMIT 1");
        
        $getCurrentVideo = $db->query("SELECT * FROM featured_video WHERE scheduleFeatVideo = 'yes' && featVideoStart <= '$today' && featVideoEnd >= '$today' LIMIT 1");
        while($row = $getCurrentVideo->fetch_assoc()) {
            $featureLink = $row['featVidLink'];
        }
        
        if($featureLink == "") {
            $getCurrentVideo = $db->query("SELECT * FROM featured_video WHERE scheduleFeatVideo = 'no' LIMIT 1");
            while($row = $getCurrentVideo->fetch_assoc()) {
                $featureLink = $row['featVidLink'];
            }
        }
        
        $this->video = $featureLink;
    }
    
}

?>
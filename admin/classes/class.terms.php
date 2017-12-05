<?php

class terms {
    
    public $header;
    public $content;
    
    function __constructor() {
        $this->terms();
    }
    
    function terms() {
        
        $db = db::instance();
        
        $getPrivacy = $db->query("SELECT * FROM terms WHERE tID = '1'");
        while($row = $getPrivacy->fetch_assoc()) {
            $header = $row['header'];
            $content = $row['content'];
        }
        
        $this->header = $header;
        $this->content = $content;
        
    }
    
}

?>s
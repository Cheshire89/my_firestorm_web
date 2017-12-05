<?php

class terms {
    
    public $header;
    public $content;
    public $title; 
    
    function terms() {
        
        $db = db::instance();
        
        $getPrivacy = $db->query("SELECT * FROM terms WHERE tID = '1'");
        while($row = $getPrivacy->fetch_assoc()) {
            $header = $row['header'];
            $content = $row['content'];
        }
        
        $this->header = $header;
        $this->content = $content;
        
        $title = $header;
        $lastW = '<strong>'.substr($title, strrpos($title, ' ')).'</strong>';
        $title = substr($title, 0, strrpos($title, ' '));
        $this->title = $title.' '.$lastW;
        
    }
    
}

?>
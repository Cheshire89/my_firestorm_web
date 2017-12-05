<?php

class privacy {
    
    public $header;
    public $content;
    
    function privacy() {
        
        $db = db::instance();
        
        $getPrivacy = $db->query("SELECT * FROM privacy WHERE privacyID = '1'");
        while($row = $getPrivacy->fetch_assoc()) {
            $header = $row['header'];
            $content = $row['content'];
        }
        
        $this->header = $header;
        $this->content = $content;
        
    }
    
}

?>
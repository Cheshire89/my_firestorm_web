<?php

class membership_agreement {
    
    public $header;
    public $content;
    
    function membership_agreement() {
        
        $db = db::instance();
        
        $getPrivacy = $db->query("SELECT * FROM membership_agreement WHERE maID = '1'");
        while($row = $getPrivacy->fetch_assoc()) {
            $header = $row['header'];
            $content = $row['content'];
        }
        
        $this->header = $header;
        $this->content = $content;
        
    }
    
}

?>
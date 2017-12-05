<?php

class about {
    
    public $title;
    public $text;
    
    function about() {
        
        $db = db::instance();
        $getAbout = $db->query("SELECT * FROM about WHERE aboutID = '1' LIMIT 1");
        while($row = $getAbout->fetch_assoc()) {
            $aboutTitle = $row['aboutTitle'];
            $aboutPageText = nl2br(stripslashes($row['aboutPageText']));
        }

        $this->title = $aboutTitle;
        $this->text = $aboutPageText;
        
    }

}

?>
<?php

class featured_member {
    
    public $member;
    
    function __construct() {
        $this->featured_member();
    }
    
    function featured_member() {
        
        $db = db::instance();
        
        $getFeatured = $db->query("SELECT userID, fName,lName,profPic,companyName FROM users WHERE featured = 'yes'");
        while($row = $getFeatured->fetch_assoc()) {
            
            $fName = $row['fName'];
            $lName = $row['lName'];
            $profPic = $row['profPic'];
            $companyName = $row['companyName'];
            $name = $fName.' '.$lName;
            
            $this->member = '<h2 class="fs-header">Featured <span class="fs-strong">Member</span></h2>
                    <div class="row">
                      <a href="profile.php?user='.$row["userID"].'" alt="'.$name.'">
                      <img class="img-responsive img-circle center-block" src="'.$profPic.'" alt="'.$name.'">
                      </a>
                      <h3 class="fs-header h2">'.$fName.' <span class="fs-strong">'.$lName.'</span></h3>
                      <p class="fs-header-black">'.$companyName.'</p>
                    </div>';
            
        }
        
    }
    
}

?>
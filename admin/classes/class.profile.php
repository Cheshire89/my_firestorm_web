<?php

class profile {
    
    function profile() {
        
    }
    
    function getSignedUpEvents($userID) {
        
        $db = db::instance();
        
        $userID = $db->real_escape_string($userID);
        
        $getEvents = $db->query("SELECT e.* FROM eventsEnrolled ev LEFT JOIN events e ON e.eventID = ev.eventID WHERE ev.userID = '$userID'");
        while($row = $getEvents->fetch_assoc()) {
            $addressLine = $row["eventAddress"].' '.$row["eventCity"].', '.$row["eventState"].' '.$row["eventZip"];
			$tags = new ConvertOutput();
			$tagsArr = $tags->tagsToArray($row["eventTags"]);
            
            $resultHTML .= '<div class="col-xs-12 col-sm-6 col-md-4 bg-grey">
					                <div class="thumbnail">
					                    <div class="img-container">
					                        <a href="event.php?eventID='.$row["eventID"].'" title="'.$row["eventTitle"].'"> <img class="img-responsive" src="'.$row["eventImg"].'" alt="'.$row["eventTitle"].'"></a>
					                    </div>
					                    <div class="caption">

					                        <p class="date">'.$row["eventDateStart"].' '.$row["eventTimeStart"].'</p>
					                            <a class="event" href="event.php?eventID='.$row["eventID"].'" title="'.$row["eventTitle"].'">
					                                <h5 class="fs-header-black"><span class="fs-strong">'.$row["eventTitle"].'</span></h5>
					                            </a>
					                        	<a class="location-link" href="../event.php?eventID='.$row["eventID"].'" title="'.$addressLine.'">'.$addressLine.' <i class="fa fa-map-marker pull-right" aria-hidden="true"></i></a>
					                        <div class="row">
					                        <div class="col-xs-12">
					                        <ul class="list-inline tags">';
					                           foreach($tagsArr as $tag){
					                           	  $resultHTML .= '<li class="list-group-item">'.$tag.'</li>';
					                           }
					        $resultHTML .=  '</ul>
					                        </div>
					                        <div class="col-xs-12 share text-right">
					                            <div class="btn-group">
					                                <a class="btn btn-default fs-ico-btn" href="link-to-page" title="Share"><i class="fa fa-share-alt-square" aria-hidden="true"></i></a>
					                                <a class="btn btn-default fs-ico-btn" href="link-to-page" title="Book Mark"><i class="fa fa-bookmark" aria-hidden="true"></i></a>
					                            </div>
					                        </div>
					                        </div>
					                    </div>
					                </div>
					            </div>';
        }
        
        return $resultHTML;
        
    }
    
}

?>
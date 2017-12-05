<?php 
	class Events extends fireSQL{

		public $action;
		public $placholder;
		public $paidTrue;
		public $paidFalse;
		public $oneDayTrue;
		public $oneDayFalse;
		public $paidFirestorm;
		public $paidThridparty;


		function Events(){
			$this->action = 'Create';
			$this->placeholder = 'http://placehold.it/880x320?text=Event+Image';
			
			$this->paidTrue = '';
			$this->paidFalse = 'checked';

			$this->oneDayTrue = 'checked';
			$this->oneDayFalse = '';

			$this->paidFirestorm = '';
			$this->paidThridparty = '';
		}

		function getEvent($eventID = null){
			if($eventID != null){
				$this->action = 'Edit';
				$returnArr = array();
				$db = db::instance();
				
				$eventID = $db->real_escape_string($eventID);
				
				$result = $this->select('events', array("*"), array('eventID' => $eventID));
				
				$row = $result->fetch_assoc();
					
					if($row["paidEvent"]==1){
                        $this->paidTrue  = 'checked';
                        $this->paidFalse  = '';
                    }
                    if($row["oneDayEvent"]==0){
                        $this->oneDayTrue  = '';
                        $this->oneDayFalse  = 'checked';
                    }
                    if($row["eventImg"] != ''){
                    	$this->placeholder = $row["eventImg"];
                    }
                    

                	switch($row["payThrough"]){
                		case 'firestorm':
                			$this->paidFirestorm = 'checked';
                			break;
                		case 'thirdparty':
                			$this->paidThridparty = 'checked';
                			break;
                	}
                	
                   return $row;
			}

		}

		function getEvents(){
			$resultHTML = '';
			$data = $this->select('events',array("eventTitle", "eventDateStart","eventTimeStart", "eventAddress", "eventCity", "eventState", "eventZip","eventImg", "eventTags", "eventID"));
			foreach($data as $row){
				// <p class="date"> Date format Wed, MAR 29 2017 8:00am
				$addressLine = $row["eventAddress"].' '.$row["eventCity"].', '.$row["eventState"].' '.$row["eventZip"];
				$tags = new ConvertOutput();
				$tagsArr = $tags->tagsToArray($row["eventTags"]);

 				$resultHTML .= '<div class="col-xs-12 col-sm-6 col-md-4">
					                <div class="thumbnail">
					                    <div class="img-container">
					                        <a href="event.php?eventID='.$row["eventID"].'" title="'.$row["eventTitle"].'"> <img class="img-responsive" src="'.$row["eventImg"].'" alt="'.$row["eventTitle"].'"></a>
					                    </div>
					                    <div class="caption">

					                        <p class="date">'.$row["eventDateStart"].' '.$row["eventTimeStart"].'</p>
					                            <a class="event" href="event.php?eventID='.$row["eventID"].'" title="'.$row["eventTitle"].'">
					                                <h5 class="fs-header-black"><span class="fs-strong">'.$row["eventTitle"].'</span></h5>
					                            </a>
					                        	<a class="location-link" href="event.php?eventID='.$row["eventID"].'" title="'.$addressLine.'">'.$addressLine.' <i class="fa fa-map-marker pull-right" aria-hidden="true"></i></a>
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

		function getChapterEvents($chapterID){
			$resultHTML = '';
			$data = $this->select("events",array("*"), array("eventBy"=> $chapterID));
			return $this->printAdminEvents($data);
		}
		
		function getAdminEvents(){
			$resultHTML = '';
			$data = $this->select("events",array("eventTitle", "eventDateStart","eventTimeStart", "eventCity", "eventState", "eventZip","eventImg", "eventID"));
			return $this->printAdminEvents($data);			
		}

		function printAdminEvents($data){
			$resultHTML = '';
			while($row = $data->fetch_assoc()){
					if(isset($row["eventImg"]) && $row["eventImg"] == ''){
						$row["eventImg"] = '../img/placeholder-small.png';
					}
					$resultHTML .= '<tr>
		                            <td><a href="createEvent.php?eventID='.$row["eventID"].'"><img class="img-responsive center-block" src="'.$row["eventImg"].'" alt="'.$row["eventTitle"].'"></a></td>
		                            <td class="title">'.$row["eventTitle"].'</td>
		                            <td class="date">'.gmdate("m/d/y", $row["eventDateStart"]).'</td>

		                            <td class="city">'.$row["eventCity"].'</td>
		                            <td class="state">'.$row["eventState"].'</td>
		                            <td class="zip">'.$row["eventZip"].'</td>
		                            <td>
		                              <div class="checkbox">
		                                  <input type="checkbox" id="eventId'.$row["eventID"].'" value="'.$row["eventID"].'" name="events">
		                                <label for="eventId'.$row["eventID"].'">
		                                </label>
		                              </div>
		                            </td>
	                            </tr>';
				}
			return $resultHTML;
		}
		
		function saveEvent($post, $files){
			$db = db::instance();

			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}

			if($files['eventImg']["tmp_name"] != ""){
				$image = new upload_image($files['eventImg'], '../events/', array('jpg', 'png', 'gif', 'jpeg'));
				
	            $covBlur = $image->create_blur_image($image->uploaded_file);
                
			}

			if(isset($eventPrice) && $eventPrice == ''){
				$eventPrice = $fsTicketPrice;
			}

			$eventDateStart = strtotime($eventDateStart);
			$eventDateEnd = strtotime($eventDateEnd);
			
			// $chapterAdmin = $this->select("chapters", array("chapterAdminID"),array("chapterID"=>$eventBy));

			// $chapterAdminRes = $chapterAdmin->fetch_assoc();
			// $userID = $chapterAdminRes["chapterAdminID"];

		    $insertID = $this->insert('events', array("eventTitle", "eventBy", "eventCategory", "eventDateStart", "eventTimeStart", "eventDateEnd", "eventTimeEnd", "oneDayEvent", "eventAddress", "eventAddressCont", "eventCity", "eventState", "eventZip", "paidEvent", "eventTicketsLink", "eventPrice", "eventDesc", "eventTags","eventImg", "payThrough","eventLocation","lng", "lat"), array($eventTitle, $eventBy, $eventCategory, $eventDateStart, $eventTimeStart, $eventDateEnd, $eventTimeEnd, $oneDayEvent, $eventAddress, $eventAddressCont, $eventCity, $eventState, $eventZip, $paidEvent, $eventTicketsLink, $eventPrice, $eventDesc, $eventTags, $image->uploaded_file, $payThrough, $eventLocation, $lng, $lat));


		    return $insertID;
		}
		
		function updateEvent($post, $files){

			$db = db::instance();
			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}


			if($files['eventImg']["name"] != ""){
				$image = new upload_image($files['eventImg'], '../events/', array('jpg', 'jpeg'));
                //print("uploaded".$image->uploaded_file);
                
				$covBlur = $image->create_blur_image($image->uploaded_file);
                //print("blured".$image->uploaded_file);
			}
            
			$chapterAdmin = $this->select("chapterAdmins", array("userID"), array("chID"=>$eventBy));
            
			$eventDateStart = strtotime($eventDateStart);
			//$eventDateEnd = strtotime($eventDateEnd);
            
			$chapterAdminRes = $chapterAdmin->fetch_assoc();
			$userID = $chapterAdminRes["chapterAdminID"];
            
			if($image != ""){
			 
			    $this->update('events', array("eventTitle", "eventBy", "eventCategory", "eventDateStart", "eventTimeStart", "eventDateEnd", "eventTimeEnd", "oneDayEvent", "eventAddress", "eventCity", "eventState", "eventZip", "paidEvent", "eventTicketsLink", "eventPrice", "eventDesc", "eventTags", "eventImg", "userID", "lng", "lat"), array($eventTitle, $eventBy, $eventCategory, $eventDateStart, $eventTimeStart, $eventDateEnd, $eventTimeEnd, $oneDayEvent, $eventAddress, $eventCity, $eventState, $eventZip, $paidEvent, $eventTicketsLink, $eventPrice, $eventDesc, $eventTags, $image->uploaded_file, $userID, $lng, $lat), array('eventID'=>$eventID));
			}else{
			 
				$this->update('events', array("eventTitle", "eventBy", "eventCategory", "eventDateStart", "eventTimeStart", "eventDateEnd", "eventTimeEnd", "oneDayEvent", "eventAddress", "eventCity", "eventState", "eventZip", "paidEvent", "eventTicketsLink", "eventPrice", "eventDesc", "eventTags", "userID", "lng", "lat"), array($eventTitle, $eventBy, $eventCategory, $eventDateStart, $eventTimeStart, $eventDateEnd, $eventTimeEnd, $oneDayEvent, $eventAddress, $eventCity, $eventState, $eventZip, $paidEvent, $eventTicketsLink, $eventPrice, $eventDesc, $eventTags, $userID, $lng, $lat), array('eventID'=>$eventID));
			}
			
			return true;
		}
		
		function deleteEvent($eventId){
			$db = db::instance();
			$eventId = $db->real_escape_string($eventId);
			$this->delete('events',array('eventID' => $eventId));
		}
		

	}
?>
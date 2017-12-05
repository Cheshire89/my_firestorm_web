<?php 
	class Events extends fireSQL{

		public $action;
		public $placholder;
		public $paidTrue;
		public $paidFalse;
		public $oneDayTrue;
		public $oneDayFalse;


		function Events(){
			$this->action = 'Create';
			$this->placeholder = 'http://placehold.it/880x320?text=Event+Image';
			
			$this->paidTrue = '';
			$this->paidFalse = 'checked';

			$this->oneDayTrue = 'checked';
			$this->oneDayFalse = '';
		}

		function getEvent($eventID = null){
			if($eventID != null){
				$this->action = 'Edit';
				$returnArr = array();
				$db = db::instance();
				
				$eventID = $db->real_escape_string($eventID);
				
				$result = $this->select('events', array("eventTitle", "eventBy", "eventCategory", "eventDateStart", "eventTimeStart", "eventDateEnd", "eventTimeEnd", "oneDayEvent", "eventAddress", "eventCity", "eventState", "eventZip", "paidEvent", "eventTicketsLink", "eventPrice", "eventDesc", "eventTags","eventImg","eventID"), array('eventID' => $eventID));
				
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
		
		function getAdminEvents($chaptersData){
		    $resultsData = array();
			if($chaptersData){
				while($row = $chaptersData->fetch_assoc()){
					$chapterID = $row["chapterID"];
					$data = $this->select("events",array("eventTitle", "eventDateStart","eventTimeStart", "eventCity", "eventState", "eventZip","eventImg", "eventID"), array("eventBy"=>$chapterID));
					array_push($resultsData, $data);
				}
			}else{
				print_r('Error - Chapter data came in empty');
			}

			return $this->printAdminEvents($resultsData);	
		}

		function printAdminEvents($mysqlObj){
			$resultHTML = '';
			if(count($mysqlObj) == 1 && !is_array($mysqlObj)){
				while($row = $mysqlObj->fetch_assoc()){
					$resultHTML .= $this->printRow($row);
				}
			}else{
				foreach($mysqlObj as $data){
					while($row = $data->fetch_assoc()){
					$resultHTML .= $this->printRow($row);
					}
				}
			}

			
			return $resultHTML;
		}

		function printRow($row){
			$teplate =  '<tr>
                            <td><a href="createEvent.php?eventID='.$row["eventID"].'"><img class="img-responsive center-block" src="'.$row["eventImg"].'" alt="'.$row["eventTitle"].'"></a></td>
                            <td class="title">'.$row["eventTitle"].'</td>
                            <td class="date">'.gmdate("m/d/y", $row["eventDateStart"]).'</td>

                            <td class="city">'.ucfirst($row["eventCity"]).'</td>
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
			return $teplate;

		}
		
		function saveEvent($post, $files){
			$db = db::instance();

			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}

			if($files['eventImg']["tmp_name"] != ""){
				$image = new upload_image($files['eventImg'], '../events/', array('jpg', 'png', 'gif', 'jpeg'));
			}

			$eventDateStart = strtotime($eventDateStart);
			$eventDateEnd = strtotime($eventDateEnd);
			$eventTimeStart = strtotime($eventTimeStart);
			$eventTimeEnd = strtotime($eventTimeEnd);

			$chapterAdmin = $this->select("chapters", array("chapterAdminID"),array("chapterID"=>$eventBy));
			$chapterAdminRes = $chapterAdmin->fetch_assoc();
			$userID = $chapterAdminRes["chapterAdminID"];

		    $insertID = $this->insert('events', array("eventTitle", "eventBy", "eventCategory", "eventDateStart", "eventTimeStart", "eventDateEnd", "eventTimeEnd", "oneDayEvent", "eventAddress", "eventCity", "eventState", "eventZip", "paidEvent", "eventTicketsLink", "eventPrice", "eventDesc", "eventTags","eventImg","userID"), array($eventTitle, $eventBy, $eventCategory, $eventDateStart, $eventTimeStart, $eventDateEnd, $eventTimeEnd, $oneDayEvent, $eventAddress, $eventCity, $eventState, $eventZip, $paidEvent, $eventTicketsLink, $eventPrice, $eventDesc, $eventTags, $image->uploaded_file, $userID));


		    return $insertID;
		}
		
		function updateEvent($post, $files){
			
			$db = db::instance();
			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}

			if($files['eventImg']["tmp_name"] != ""){
				$image = new upload_image($files['eventImg'], '../events/', array('jpg', 'png', 'gif', 'jpeg'));
			}

			$eventDateStart = strtotime($eventDateStart);
			$eventDateEnd = strtotime($eventDateEnd);
			$eventTimeStart = strtotime($eventTimeStart);
			$eventTimeEnd = strtotime($eventTimeEnd);

			$chapterAdmin = $this->select("chapters", array("chapterAdminID"),array("chapterID"=>$eventBy));
			$chapterAdminRes = $chapterAdmin->fetch_assoc();
			$userID = $chapterAdminRes["chapterAdminID"];

			if($image != ""){
			    $this->update('events', array("eventTitle", "eventBy", "eventCategory", "eventDateStart", "eventTimeStart", "eventDateEnd", "eventTimeEnd", "oneDayEvent", "eventAddress", "eventCity", "eventState", "eventZip", "paidEvent", "eventTicketsLink", "eventPrice", "eventDesc", "eventTags", "eventImg", "userID"), array($eventTitle, $eventBy, $eventCategory, $eventDateStart, $eventTimeStart, $eventDateEnd, $eventTimeEnd, $oneDayEvent, $eventAddress, $eventCity, $eventState, $eventZip, $paidEvent, $eventTicketsLink, $eventPrice, $eventDesc, $eventTags, $image->uploaded_file, $userID), array('eventID'=>$eventID));
			}else{
				$this->update('events', array("eventTitle", "eventBy", "eventCategory", "eventDateStart", "eventTimeStart", "eventDateEnd", "eventTimeEnd", "oneDayEvent", "eventAddress", "eventCity", "eventState", "eventZip", "paidEvent", "eventTicketsLink", "eventPrice", "eventDesc", "eventTags", "userID"), array($eventTitle, $eventBy, $eventCategory, $eventDateStart, $eventTimeStart, $eventDateEnd, $eventTimeEnd, $oneDayEvent, $eventAddress, $eventCity, $eventState, $eventZip, $paidEvent, $eventTicketsLink, $eventPrice, $eventDesc, $eventTags, $userID), array('eventID'=>$eventID));
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
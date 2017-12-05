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

        function __construct() {
            $this->Events();
        }

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
				$db = db::instance();
				$eventID = $db->real_escape_string($eventID);
				$result = $this->select('events', array("*"), array('eventID' => $eventID));
				
				$row = $result->fetch_assoc();
				$row["eventImg"] = substr($row["eventImg"], 1);
				// $row["eventDateStart"] = gmdate('M d Y', $row["eventDateStart"]);
				// $row["eventTimeStart"] = gmdate('g:i a', $row["eventTimeStart"]);
				// $row["eventTimeEnd"] = gmdate('g:i a', $row["eventTimeEnd"]);
				$row["eventTags"] = $this->printableTags($row["eventTags"]);
				$row["addressFull"] = $row["eventAddress"].' '.$row["eventCity"].', '.$row["eventState"].' '.$row["eventZip"];

                return $row;
			}
		}

		function printableTags($tags){
			$resultHtml= '';
			$tags = explode(',', $tags);
			foreach($tags as $tag){
				$tag = trim($tag);
				$resultHtml .= '<li><a href="" title="'.$tag.'"><strong>#'.$tag.'</strong></a></li>';
			}
			return $resultHtml;
		}
        
        function get_next_events($num){
			$resultHTML = '';
			$date = date("U");
			$data = $this->direct_call("SELECT * FROM `events` WHERE `eventDateStart` >= '$date' ORDER BY eventDateStart ASC LIMIT $num");
			return $this->print_events($data);
		}

		function get_next_meetings($num){
			$resultHTML = '';
			$date = date("U");
            $todayDay = date("l");
            $timeNow = strtotime(date("g:ia"));    
            $finalOrders = array();
            //print("SELECT * FROM chapters WHERE meetingDay = '$todayDay' && meetingTime > '$timeNow' ORDER BY meetingTime ASC LIMIT $num");        
			$data = $this->direct_call("SELECT * FROM chapters WHERE meetingDay = '$todayDay' ORDER BY meetingTime ASC");
            while($row = $data->fetch_assoc()) {
                $meetingTime = $row['meetingTime'];
                $chapterID = $row['chapterID'];
                if($meetingTime != "" && $chapterID != "") {
                    $unix = strtotime($meetingTime);
                    //print("Unix: ".$unix. " : Now: ".$timeNow);
                    if($timeNow < $unix) {
                        array_push($finalOrders, $row);
                    }
                }
            }         
            if(sizeof($finalOrders) < 3) {
                $finalOrders = $this->getNextDayMeetings($todayDay,$finalOrders);
            } 
			return $this->print_meeting($finalOrders);
		}
        
        function getNextDayMeetings($todayDay,$finalOrders) {
            switch($todayDay) {
                case "Sunday":
                    $nextDay = "Monday";
                    break;
                case "Monday":
                    $nextDay = "Tuesday";
                    break;
                case "Tuesday":
                    $nextDay = "Wednesday";
                    break;
                case "Wednesday":
                    $nextDay = "Thursday";
                    break;
                case "Thursday":
                    $nextDay = "Friday";
                    break;
                case "Friday":
                    $nextDay = "Saturday";
                    break;
                case "Saturday":
                    $nextDay = "Sunday";
                    break;
            }
            $data = $this->direct_call("SELECT * FROM chapters WHERE meetingDay = '$nextDay' ORDER BY meetingTime ASC");
            while($row = $data->fetch_assoc()) {
                $meetingTime = $row['meetingTime'];
                $chapterID = $row['chapterID'];
                
                if(sizeof($finalOrders) < 3) {
                    if($meetingTime != "" && $chapterID != "") {
                        array_push($finalOrders, $row);
                    }
                }
            }
            if(sizeof($finalOrders) < 3) {
                $finalOrders = $this->getNextDayMeetings($nextDay, $finalOrders);
            }
            return $finalOrders;
        }
		
		function getEvents(){
			$resultHTML = '';
			$data = $this->select('events',array("*"),array("eventCategory"=>"Firestorm Event"));
			return $this->print_events($data);
		}
        
        function getOtherEvents(){
			$resultHTML = '';
			$data = $this->select('events',array("*"),array("eventCategory"=>"Other Event"));
			return $this->print_events($data);
		}
        
        function print_meeting($data){
			$resultHTML = '';

			foreach($data as $row){
				// <p class="date"> Date format Wed, MAR 29 2017 8:00am
				$addressLine = $row["chapterAddress"].' '.$row["chapterCity"].', '.$row["chapterState"].' '.$row["chapterZip"];

				$row["chapterImg"] = substr($row["chapterImg"], 1);
                $containerClass = 'firestorm-event';
				
                $row["eventDay"] = $row['meetingDay'];
				$row["eventDateStart"] = $row["meetingTime"];
				$row["eventTimeStart"] = $row["meetingTimeEnd"];

				if($row["chapterImg"] == ''){
					$row["chapterImg"] = 'img/placeholder-img.jpg';
				}

 				$resultHTML .= '<div class="col-xs-6 col-sm-6 col-md-4 '.$containerClass.' event">
					                <div class="thumbnail">
					                    <div class="img-container">
					                        <a href="chapter.php?chapterID='.$row["chapterID"].'" title="'.$row["chapterName"].'"> <img class="img-responsive" src="'.$row["chapterImg"].'" alt="'.$row["chapterName"].'"></a>
					                    </div>
					                    <div class="caption">

					                        <p class="date">'.$row["eventDay"].'\'s '.strtoupper($row["eventDateStart"]).' - '.strtoupper($row["eventTimeStart"]).'</p>
					                            <a class="event" href="chapter.php?chapterID='.$row["chapterID"].'" title="'.$row["chapterName"].'">
					                            	<div class="event-title">
					                                <h5 class="fs-header-black"><span class="fs-strong">'.$row["chapterName"].'</span></h5>
					                                </div>
					                            </a>
					                            <div class="location">
					                        	<a class="location-link" href="chapter.php?chapterID='.$row["chapterID"].'" title="'.$addressLine.'">'.$addressLine.' <i class="fa fa-map-marker pull-right" aria-hidden="true"></i></a>
					                        	</div>
					                        <div class="row">
					                        <div class="col-xs-12">
					                        <div class="col-xs-12 share text-right">
					                            <div class="btn-group">
                                                    <!--
					                                <a class="btn btn-default fs-ico-btn" href="link-to-page" title="Share"><i class="fa fa-share-alt-square" aria-hidden="true"></i></a>
					                                <a class="btn btn-default fs-ico-btn" href="link-to-page" title="Book Mark"><i class="fa fa-bookmark" aria-hidden="true"></i></a>
                                                    -->
					                            </div>
					                        </div>
					                        </div>
					                    </div>
					                </div>
					            </div>
                                </div>';
			}

			return $resultHTML;
		}                

		function print_events($data){
			$resultHTML = '';

			foreach($data as $row){
				// <p class="date"> Date format Wed, MAR 29 2017 8:00am
				$addressLine = $row["eventAddress"].' '.$row["eventCity"].', '.$row["eventState"].' '.$row["eventZip"];
				$tags = new ConvertOutput();
				$tagsArr = $tags->tagsToArray($row["eventTags"]);

				$row["eventImg"] = substr($row["eventImg"], 1);

				switch ($row["eventCategory"]) {
					case '':
					case 'Other Event':
						$containerClass = 'other-event';
						break;
					case 'Firestorm Event':
						$containerClass = 'firestorm-event';
						break;
				}
					
				$row["eventDateStart"] = gmdate('M d Y', $row["eventDateStart"]);
				$row["eventTimeStart"] = gmdate('g:i a', $row["eventTimeStart"]);

				if($row["eventImg"] == ''){
					$row["eventImg"] = 'img/placeholder-img.jpg';
				}

 				$resultHTML .= '<div class="col-xs-6 col-sm-6 col-md-4 '.$containerClass.' event">
					                <div class="thumbnail">
					                    <div class="img-container">
					                        <a href="event.php?eventID='.$row["eventID"].'" title="'.$row["eventTitle"].'"> <img class="img-responsive" src="'.$row["eventImg"].'" alt="'.$row["eventTitle"].'"></a>
					                    </div>
					                    <div class="caption">

					                        <p class="date">'.$row["eventDateStart"].' '.$row["eventTimeStart"].'</p>
					                            <a class="event" href="event.php?eventID='.$row["eventID"].'" title="'.$row["eventTitle"].'">
					                            	<div class="event-title">
					                                <h5 class="fs-header-black"><span class="fs-strong">'.$row["eventTitle"].'</span></h5>
					                                </div>
					                            </a>
					                            <div class="location">
					                        	<a class="location-link" href="event.php?eventID='.$row["eventID"].'" title="'.$addressLine.'">'.$addressLine.' <i class="fa fa-map-marker pull-right" aria-hidden="true"></i></a>
					                        	</div>
					                        <div class="row">
					                        <div class="col-xs-12">
					                        <ul class="list-inline tags">';
					                           $str = 0;
					                           $MaxTagStrLen = 35;
					                           foreach($tagsArr as $tag){
					                           	  $strLen = strlen($tag);
					                           	  $str += $strLen;
					                           	  if($str < $MaxTagStrLen){
						                           	  $resultHTML .= '<li class="list-group-item">'.$tag.'</li>';
					                           	  }
					                           }
					        $resultHTML .=  '</ul>
					                        </div>
					                        <div class="col-xs-12 share text-right">
					                            <div class="btn-group">
                                                    <!--
					                                <a class="btn btn-default fs-ico-btn" href="link-to-page" title="Share"><i class="fa fa-share-alt-square" aria-hidden="true"></i></a>
					                                <a class="btn btn-default fs-ico-btn" href="link-to-page" title="Book Mark"><i class="fa fa-bookmark" aria-hidden="true"></i></a>
                                                    -->
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
			return $this->print_chapter_events($data);
		}
		
		function getAdminEvents(){
			$resultHTML = '';
			$data = $this->select("events",array("eventTitle", "eventDateStart","eventTimeStart", "eventCity", "eventState", "eventZip","eventImg", "eventID"));
			return $this->printAdminEvents($data);			
		}

		function print_chapter_events($data){
			$resultHtml = '';
			while($row = $data->fetch_assoc()){
				$row["eventDateStart"] = gmdate('d/m/Y', $row["eventDateStart"]);
				$resultHtml .= '<tr class="text-left">
		                        <td><a href="event.php" title="event title">'.$row["eventTitle"].'</a></td>
		                        <td><a href="event.php" title="event title">'.$row["eventDateStart"].'</a></td>
		                        <td><a href="event.php?eventID='.$row["eventID"].'" title="'.$row["eventTitle"].'" class="btn fs-btn-orange btn-sm pull-right">RSVP</a></td>
		                      </tr>';
			}
			return $resultHtml;
		}

		function printAdminEvents($data){
			$resultHTML = '';
			while($row = $data->fetch_assoc()){
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
				print($key.'=>'.$var.'<br>');
			}

			if($files['eventImg']["tmp_name"] != ""){
				$image = new upload_image($files['eventImg'], '../events/', array('jpg', 'png', 'gif', 'jpeg'));
			}

			if(isset($eventPrice) && $eventPrice == ''){
				$eventPrice = $fsTicketPrice;
			}

			print($eventPrice.' EventPrice <br>');

			$eventDateStart = strtotime($eventDateStart);
			$eventDateEnd = strtotime($eventDateEnd);
			$eventTimeStart = strtotime($eventTimeStart);
			$eventTimeEnd = strtotime($eventTimeEnd);

			$chapterAdmin = $this->select("chapters", array("chapterAdminID"),array("chapterID"=>$eventBy));
			$chapterAdminRes = $chapterAdmin->fetch_assoc();
			$userID = $chapterAdminRes["chapterAdminID"];

		    $insertID = $this->insert('events', array("eventTitle", "eventBy", "eventCategory", "eventDateStart", "eventTimeStart", "eventDateEnd", "eventTimeEnd", "oneDayEvent", "eventAddress", "eventCity", "eventState", "eventZip", "paidEvent", "eventTicketsLink", "eventPrice", "eventDesc", "eventTags","eventImg","userID", "payThrough"), array($eventTitle, $eventBy, $eventCategory, $eventDateStart, $eventTimeStart, $eventDateEnd, $eventTimeEnd, $oneDayEvent, $eventAddress, $eventCity, $eventState, $eventZip, $paidEvent, $eventTicketsLink, $eventPrice, $eventDesc, $eventTags, $image->uploaded_file, $userID, $payThrough));


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
		
        function getSignedUp($eventID) {
            $db = db::instance();
            
            //$getSignedUp = $db->query("SELECT FROM event_signups ");
            //tbd
        }

        function register_to_event($userID, $eventID){
        	$db = db::instance();
        	$userID = $db->real_escape_string($userID);
        	$eventID = $db->real_escape_string($eventID);
        	$result = $this->insert('eventsEnrolled', array("userID","eventID"), array($userID, $eventID));
        	return $result;
        }

        function register_to_event_non_user($post){
        	$db = db::instance();
        	foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}
			$result = $this->insert('eventsEnrolled', array("user_level" ,"name" ,"email" ,"compName" ,"phone" ,"eventID"), array('guest', $name, $email, $company, $phone, $evID));
			return $result;
        }
        
        function leave_event($userID, $eventID){
        	$db = db::instance();
        	$userID = $db->real_escape_string($userID);
        	$eventID = $db->real_escape_string($eventID);
        	$result = $this->delete('eventsEnrolled', array("userID"=>$userID,"eventID"=>$eventID));
        	return $result;
        }

        function get_user_signedup_events_ids($userID){
        	$db = db::instance();
        	$events = array();
        	$call = $this->select("eventsEnrolled", array('eventID'),array('userID'=>$userID));
        	if($call){
        		while($row = $call->fetch_assoc()){
        			array_push($events, $row["eventID"]);
        		}
        		return $events;
        	}else{
        		return $call;
        	}
        }

        function is_signedup_for_event($userID, $eventID){
        	$db = db::instance();
        	$userID = $db->real_escape_string($userID);
        	$eventID = $db->real_escape_string($eventID);
        	$events = $this->get_user_signedup_events_ids($userID);
        	$search = in_array($eventID, $events);
        	return $search;
        }

        function searchEvents($post){
        	$db = db::instance();
        	foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
				print($key.' '.$var);
			}


        }
	}
?>
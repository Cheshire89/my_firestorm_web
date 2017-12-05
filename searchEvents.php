<?php 
	require_once("classes/config.php");
	if(isset($_POST["eventTitle"]) && $_POST["eventTitle"] != '' ||
	   isset($_POST["eventCity"]) && $_POST["eventCity"] != '' ||
	   isset($_POST["eventDate"]) && $_POST["eventDate"] != ''){

	   $db = db::instance();
	   $events= new Events();
	   $fields = array();
	   
	   foreach ($_POST as $key => $value) {
	   	  if($value != ''){
	   	  	 if($key != 'eventDate'){
			   	 $fields[$key] = $db->real_escape_string($value);
	   	  	 }else{
	   	  	 	 $fields[$key] = $db->real_escape_string(strtotime($value));
	   	  	 }
	   	  }
	   }

	   $i=1;
	   $fieldsLen = count($fields);
	   $query = "SELECT * FROM `events` WHERE ";

	   foreach ($fields as $key => $value) {
	   	  if($i != $fieldsLen){
		   	 $query .= "`$key` LIKE '%$value%' || ";
	   	  }else{
	   	  	 $query .= "`$key` LIKE '%$value%'";
	   	  }
	   	  $i++;
	   }

		$query .= " ORDER BY 'eventDateStart' DESC;";

		$srchResult = $db->query($query);
		$html = $events->print_events($srchResult);
		
		print($html);
	} else{
		print('error');
	}
?>
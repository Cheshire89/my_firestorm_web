<?php 
	require_once("classes/config.php");
	if(isset($_POST["chapterName"]) && $_POST["chapterName"] != '' ||
	   isset($_POST["chapterCity"]) && $_POST["chapterCity"] != '' ||
	   isset($_POST["chapterState"]) && $_POST["chapterState"] != ''){

	   $db = db::instance();
	   $chapters = new Chapters();
	   $fields = array();
	   
	   foreach ($_POST as $key => $value) {
	   	  if($value != ''){
			  $fields[$key] = $db->real_escape_string($value);
	   	  }
	   }

	   $i=1;
	   $fieldsLen = count($fields);
	   $query = "SELECT * FROM `chapters` WHERE ";

	   foreach ($fields as $key => $value) {
	   	  if($i != $fieldsLen){
		   	 $query .= "`$key` LIKE '%$value%' && ";
	   	  }else{
	   	  	 $query .= "`$key` LIKE '%$value%'";
	   	  }
	   	  $i++;
	   }
		$query .= " ORDER BY chapterName ASC";

		$srchResult = $db->query($query);
		$html = $chapters->print_chapters_search_front($srchResult);

		$result = $db->query($query);
        $count=0;
        $coordinates = array();
        
		while($row = $result->fetch_assoc()) {
                //['Maroubra Beach', -33.950198, 151.259302, 1]
                $lat = $row['lat'];
                $lng = $row['lng'];
                $chapterName = $row['chapterName'];
                    $count++;
                if($lat != "" && $lng != "") {
               		$piece = array($chapterName, $lat, $lng, $count);
               		array_push($coordinates, $piece);
                }
            }

	
		$json = json_encode(array("resultsHtml" => $html, "mapLocs"=> $coordinates));
		print($json);
	} else{
		print('error');
	}
?>
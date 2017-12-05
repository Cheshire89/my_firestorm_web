<?php 
	require_once("classes/config.php");
	if(isset($_POST["articleTitle"]) && $_POST["articleTitle"] != '' ||
	   isset($_POST["articleDate"]) && $_POST["articleDate"] != ''){

	   $db = db::instance();
	   $articles = new Education();
	   $fields = array();
	   
	   foreach ($_POST as $key => $value) {
	   	  if($value != ''){
	   	  	 if($key != 'articleDate'){
			   	 $fields[$key] = $db->real_escape_string($value);
	   	  	 }else{
	   	  	 	 $fields[$key] = $db->real_escape_string(strtotime($value));
	   	  	 }
	   	  }
	   }

	   $i=1;
	   $fieldsLen = count($fields);
	   $query = "SELECT * FROM `articles` WHERE ";

	   foreach ($fields as $key => $value) {
	   	  if($i != $fieldsLen){
		   	 $query .= "`$key` LIKE '%$value%' || ";
	   	  }else{
	   	  	 $query .= "`$key` LIKE '%$value%'";
	   	  }
	   	  $i++;
	   }
	   
		$query .= " ORDER BY 'articleDate' DESC;";
		$srchResult = $db->query($query);
		$html = $articles->print_articles($srchResult);
		
		print($html);
	} else{
		print('error');
	}
?>
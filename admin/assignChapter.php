<?php 
	require_once('classes/config.php');
    if(isset($_POST["userID"]) && $_POST["userID"] != '' && isset($_POST["chapterID"]) && $_POST["chapterID"] != ''){
    	 $db = db::instance();
    	 
    	 $chapter = new Chapters();

    	 $chapterId = $db->real_escape_string($_POST["chapterID"]);
    	 $userId = $db->real_escape_string($_POST["userID"]);

    	 $result = $chapter->assignChapter($userId, $chapterId);
         
         if($result == "Success") {
            $chapters = new Chapters();
            $chaptersEnrolled = $chapters->printUserChapters($userId, 'editable');
    	    print($chaptersEnrolled);
         } else {
            print("Error");
         }
         
    } else {
        print("Error");
    }

?>
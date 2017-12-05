<?php 
	class Education extends fireSQL{
		
		public $action;
		public $placeholder;

		function Education(){
			$this->action ="Create";
			$this->placeholder = 'http://placehold.it/880x320?text=Article+Image';
		}

		function getArticle($articleID = null){
			if($articleID != null){
				$this->action = 'Edit';
				$db = db::instance();
				$articleID = $db->real_escape_string($articleID);
				$result = $this->select('articles', array("articleTitle", "articleBy", "articleCont", "articleTags", "articleDate", "articleImg", "articleID"), array('articleID' => $articleID));

				$row = $result->fetch_assoc();


				if($row["articleImg"] != ''){
                    $this->placeholder = $row["articleImg"];
                }

				return $row;
			}
		}
		
		function getArticles(){
		}
		
		function getAdminArticles(){
			$resultHTML = '';
			$data = $this->select('articles',array("articleTitle", "articleBy", "articleCont", "articleTags", "articleDate", "articleImg", "articleID"));
			while($row = $data->fetch_assoc()){

				$resultHTML .= '<tr>
                            <td><a href="createArticle.php?articleID='.$row["articleID"].'"><img class="img-responsive center-block" src="'.$row["articleImg"].'" alt="'.$row["articleTitle"].'"></a></td>
                            <td class="title">'.$row["articleTitle"].'</td>
                            <td>'.$row["articleBy"].'</td>
                            <td>'.gmdate("m/d/y", $row["articleDate"]).'</td>
                            <td class="tags">'.$row["articleTags"].'</td>
                            <td>
                              <div class="checkbox">
                                <input type="checkbox" id="article'.$row["articleID"].'" value="'.$row["articleID"].'" name="articles">
                                <label for="article'.$row["articleID"].'">
                                </label>
                              </div>
                            </td>
                          </tr>';
			}

			return $resultHTML;
		}
		
		function saveArticle($post, $files){
			$db = db::instance();
			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}

			if($files['articleImg']["tmp_name"] != ""){
				$image = new upload_image($files['articleImg'], '../articles/', array('jpg', 'png', 'gif', 'jpeg'));
			}

			$articleDate = date('U');

		    $insertID = $this->insert('articles', array("articleTitle", "articleBy", "articleCont", "articleTags", "articleDate", "articleImg"), array($articleTitle, $articleBy, $articleCont, $articleTags, $articleDate, $image->uploaded_file));

		    return $insertID;
		}
		
		function updateArticle($post, $files){
			$db = db::instance();
			foreach($post as $key => $var) {
				${$key} = $db->real_escape_string($var);
			}

			if($files['articleImg']["tmp_name"] != ""){
				$image = new upload_image($files['articleImg'], '../articles/', array('jpg', 'png', 'gif', 'jpeg'));
			}

			if($image != ""){
			    $this->update('articles', array("articleTitle", "articleBy", "articleCont", "articleTags", "articleImg"), array($articleTitle, $articleBy, $articleCont, $articleTags, $image->uploaded_file), array('articleID'=>$articleID));
			}else{
				$this->update('articles', array("articleTitle", "articleBy", "articleCont", "articleTags"), array($articleTitle, $articleBy, $articleCont, $articleTags), array('articleID'=>$articleID));
			}

			return true;
		}
		
		function deleteArticle($articleID){
			$db = db::instance();
			$articleID = $db->real_escape_string($articleID);
			$this->delete('articles', array('articleID' => $articleID));		
		}
	}
?>
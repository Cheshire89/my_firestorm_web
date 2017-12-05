<?php

class Education {
    
    function Education() {
        
    }
    
    function getAll() {
        $db = db::instance();
        $data = $db->query("SELECT * FROM articles ORDER BY articleDate DESC");
        return $this->print_articles($data);
    }

    function print_articles($data){
        while($row = $data->fetch_assoc()) {
            $articleTitle = $row['articleTitle'];
            $articleID = $row['articleID'];
            $articleBy = $row['articleBy'];
            $articleCont = $row['articleCont'];
            $articleTags = $row['articleTags'];
            $articleDate = $row['articleDate'];
            $articleImg = $row['articleImg'];
            
            $exTags = explode(",", $articleTags);
            $allTags = "";
            foreach($extTags as $tag) {
                $allTags .= '<li class="list-group-item">'.$tag.'</li>';
            }
            
            if($articleImg != "img/event-placeholder.jpg") {
                $articleImg = substr($articleImg, 1);
            }
            
            $results .= '<div class="col-xs-6 col-sm-6 col-md-4 article">
                <div class="thumbnail">
                    <div class="img-container">
                        <a href="article.php?id='.$articleID.'" title="'.$articleTitle.' | Read Full Article"> <img class="img-responsive" src="'.$articleImg.'" alt="'.$articleTitle.'"></a>
                    </div>
                    <div class="caption">
                        
                            <a class="event-link" href="article.php?id='.$articleID.'" title="'.$articleTitle.' | Read Full Article">
                                <h5 class="fs-header-black"><span class="fs-strong">'.$articleTitle.'</span></h5>
                            </a>
                        
                        <div class="row">
                        <div class="col-xs-12">
                        <ul class="list-inline tags">
                            '.$allTags.'
                        </ul>
                        </div>
                        <div class="col-xs-12 share text-right">
                            <div class="btn-group">
                                <!-- <a class="btn btn-default fs-ico-btn" href="link-to-page" title="Share" data-id="'.$articleID.'"><i class="fa fa-share-alt-square" aria-hidden="true"></i></a> -->
                                <!-- <a class="btn btn-default fs-ico-btn" href="link-to-page" title="Book Mark"><i class="fa fa-bookmark" aria-hidden="true"></i></a> -->
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
        
        return $results;
    }
    
    function getArticle($id) {
        $db = db::instance();
        $id = $db->real_escape_string($id);
        
        $getArticle = $db->query("SELECT * FROM articles WHERE articleID = '$id'");
        $row = $getArticle->fetch_assoc();
        
        $exTags = explode(",", $row['articleTags']);
        $allTags = "";
        foreach($exTags as $tag) {
            $allTags .= '<li><a href="" title=""><strong>'.ucWords($tag).'</strong></a></li>';
        }
        $row['allTags'] = $allTags;
        
        return $row;
    }
}

?>
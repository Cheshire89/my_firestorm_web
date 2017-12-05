<?php 
   require_once('classes/config.php');
   $article = new Education();
   $chapters = new Chapters();
   
   if(isset($_GET["articleID"])){
        $data = $article->getArticle($_GET["articleID"]);
    }

    $chaptersList = $chapters->printChaptersOption($data["articleBy"]);
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/ico/favicon.ico">

    <title>Firestorm Admin <?php print($article->action); ?> Article</title>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/37451d8d48.js"></script>
    <!-- Custom styles -->

    <link href="styles/css/admin.css?v=<?php date('U')?>" rel="stylesheet">
    <link href="../styles/css/log-in.css?v=<?php date('U')?>" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  </head>
  <body>
    
    <?php require_once('php/header.php') ?>
      <div class="container" id="adminContainer">
      <div class="row">
         <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-xs-12">

        
                  <div class="panel panel-default">
                        <div class="panel-heading"><h3><?php print($article->action); ?> Article</h3></div>
                        <div class="panel-body">
                           <form class="form-horizontal fs-form-gen" action="saveArticle.php" name="saveArticleForm" if="saveArticleForm" method="POST" enctype="multipart/form-data">
                            
                               <div class="form-group image-preview">
                                   <div class="col-xs-12">
                                      <img class="img-responsive center-block" alt="article image preview" src="<?php print($article->placeholder); ?>" />
                                   </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-xs-12">
                                    <label>Article General Information</label>
                                  </div>
                                  <div class="col-xs-12">
                                    <div class="input-group">
                                        <label for="articleImg">Choose Article Image</label>
                                        <input type="file" class="form-control" id="articleImg" name="articleImg">
                                        <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                   </div>
                                 </div>
                               </div>
                               <div class="form-group">
                                 <div class="col-md-12">
                                   <div class="input-group">
                                      <input type="text" class="form-control" id="articleTitle" name="articleTitle" placeholder="Article Title"  value="<?php print($data["articleTitle"]) ?>">
                                      <span class="input-group-addon"><strong>T</strong></span>
                                   </div>
                                 </div>
                               </div>

                               <div class="form-group">
                                  <div class="col-md-6">
                                   <div class="input-group">
                                      <select type="text" class="form-control" id="articleBy" name="articleBy" value="<?php print($data["articleBy"]) ?>">
                                        <option value="">Article By</option>
                                        <?php print($chaptersList);?>
                                      </select>
                                      <span class="input-group-addon"><strong>G</strong></span>
                                   </div>
                                 </div>
                               </div>

                              <div class="form-group">
                                <div class="col-xs-12">
                                  <label for="articleCont">Article Content</label>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-xs-12">
                                  <textarea class="form-control" id="articleCont" name="articleCont"><?php print($data["articleCont"]) ?></textarea>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-xs-12">
                                  <div class="input-group">
                                        <input type="text" class="form-control" id="articleTags" name="articleTags" placeholder="Article Tags" value="<?php print($data["articleTags"]) ?>">
                                        <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                                    </div>
                                        <p class="help-block">Tags must be separated ba a comma</p>
                                </div>
                              </div>
                              <div class="form-group hidden">
                                  <input type="hidden" id="articleID" name="articleID" value="<?php print($data["articleID"]); ?>"/>
                              </div>



                                <div class="form-group controls">
                                  <div class="col-xs-12">
                                    <div class="btn-group pull-right">
                                    <a href="education.php" class="fs-btn-blue btn"><i class="fa fa-rotate-left" aria-hidden="true"></i> Back</a>
                                   <button type="button" class="fs-btn-green btn saveArticleBtn"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                   </div>
                                   </div>
                                </div>  
                            
                          </form>
                      </div>
                  </div>


                <!-- Closing Divs -->
                </div>
            </div>
         </div>
      </div>
    
         
       
    </div>
    <?php require_once('php/footer.php') ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="https://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
    <!-- Optional -->
    <!-- jQuery Ui -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="js/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript" src="js/createArticle.js"></script>
    <script type="text/javascript" src="js/init-tynymce.js"></script>
    <link href="styles/css/tinymce-custom.css?v=<?php date('U')?>" rel="stylesheet">
  </body>
  <style type="text/css">
    #articleEnd, #tickets{
      display: none;
    }
  </style>
</html>

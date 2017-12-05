<?php

class upload_image {
    
    public $uploaded_file;
    
    function __constructor($file, $folderPath, $restrictions = null) {
        $this->upload_image($file, $folderPath, $restrictions);
    }

    /**
     *  Uploads Images 
     *  
     *  The file that is passed is uploaded to the specified folderpath. If any restrictions or allowed file types are passed they will be used before allowing the upload.
     *  
     *  @param $_FILES['name'] - $filename with reference to the file being uploaded
     *  @param string $folderPath with the path to upload the file to
     *  @param array $restrictions with an array of strings for the file extensions to allow
     * 
     *  @return filename and path or error message; 
     **  
    */
    function upload_image($file, $folderPath, $restrictions = null) {
        if($restrictions === null) {
            
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0755, true);
            }
            
            $filename = date("U") . "_" . basename($file['name']);
            //print($filename);
            $target_file = $folderPath . $filename;
            $target_filepath = $folderPath . $filename;
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
            $name = $filename;
            $ext = strtolower(end((explode(".", $name))));
            
            if($uploadOk == 1) {
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    //echo "The file ". basename( $_FILES["main_image"]["name"]). " has been uploaded.";
                    $this->uploaded_file = ($target_filepath);
                } else {
                    $this->uploaded_file = "error=moving";
                }
            } else {
                $this->uploaded_file = "error=bad_file";
            }
            
            $this->uploaded_file = ($target_filepath);
            
        } else {

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            $filename = date("U") . "_" . basename($file['name']);
            $target_file = $folderPath . $filename;
            $target_filepath = $folderPath . $filename;
            $uploadOk = 0;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            $name = $filename;
            $ext = strtolower(end((explode(".", $name))));
            foreach($restrictions as $res) {
                if($ext == $res) {
                    $uploadOk = 1;
                }
            }
            
            //print("Attempting: ".$file["name"]);
            
            if($uploadOk == 1) {
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    //echo "The file ". basename( $_FILES["main_image"]["name"]). " has been uploaded.";
                    $return = ($target_filepath);
                } else {
                    $return = "error=moving-".$file["error"];
                }
            } else {
                $return = "error=bad_file";
            }
            $this->uploaded_file = ($return);
        }
    }
    
    function create_blur_image($image) {
        //print($image);
        $explode = explode(".",$image);
        $ext = $explode[sizeof($explode)-1];
        //print($ext);
        //xt = substr($image, strrpos($image, '.'));
        $imgCopy = str_replace('.'.$ext, '_blur.'.$ext, $image);
        //print($imgCopy);
        //exit();
       
        if(!copy($image,$imgCopy)) {
            print "Failed : ".$imgCopy;
        }
        $imageBlur = new Imagick($imgCopy);
        $imageBlur->blurImage(10,10);
        $imageBlur->writeImage($imgCopy);
        $imageBlur->destroy();
        return $imgCopy;
    }
}

?>
<?php
    class media{
        private $bdd;
        private $idUser;
       
        function __construct($bd)
        {
            $this->bdd=$bd;
            $this->maxw = 480;
            $this->maxh = 400; 
        }
        function uploadImag($image, $object)
        {
            $target_dir = "../media/";
            $target_file = $target_dir . basename($image["name"]);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $mesExt = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
            if (in_array($imageFileType, $mesExt)) {
                $lien = 'media/photos/' . date('Y') . '/' . date('m') . '/';
                $dir = "../" . $lien;
                
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                
                $imageName = $image['name'];
                $imageRenamed = $this->renameImg($imageName);
                $imgeToUpload = (string) $imageRenamed[0];                
                move_uploaded_file($image['tmp_name'], $dir . $imgeToUpload);                            
                $value = $this->thumbnail($imgeToUpload, $dir, $lien);
                if ($value == "true") {
                    return $this->insert_media($imageName, $imageFileType, $lien . $imgeToUpload, $object);
                } else {
                    return json_decode(array("errorOperation"=> "erreur thumbnail"));
                }
            } else {
                return json_encode(array("errorOperation"=> "erreur: extension"));
            }
        }
        /* 
            will allow to upload all images [picturef profile or scan document] 
            depend othe case and the source.
        */
        // function uploadImag($img){}
        /**
         * allow to get the link of a document to be display
         * according to need of the user and related to r-the request of the user.
         */
        function insert_media($name,$extension,$link, $object){
            //get sourc information 
            $userid=$object['userid'];
            $topicid=$object['topicid'];
            $topic= $object['topic'];
            $name=$name;
            if(strlen($name)>39){
                $name = md5($name);
            }
            $sql = "INSERT INTO media (name,extension,link,dateupload) VALUE (?,?,?,NOW())";
            if($topic){
                $sql = "INSERT INTO media (name,extension,link,iduser,dateupload) VALUE (?,?,?,?,NOW())";
            }
            try{
                $req = $this->bdd->prepare($sql);
                $req->bindparam(1, $name);
                $req->bindparam(2, $extension);
                $req->bindparam(3, $link);
                if ($topic) {
                    $req->bindparam(4, $userid);
                }
                $req->execute();
                if ($req->execute()) {                    
                    $lastidImg = $this->bdd->lastInsertId();
                    if($topic){
                        try {
                            $updateuser = "UPDATE topic SET imagerefernce=? WHERE idtopic=?";
                            $up = $this->bdd->prepare($updateuser);
                            $up->bindparam(1, $lastidImg);
                            $up->bindparam(2, $topicid);
                            return $up->execute();
                        } catch (Exception $e) {
                            return json_encode(array("errorOperation" => $e->getMessage()));
                        }
                    }else{                    
                        try{
                            $updateuser = "UPDATE users SET idavatar=? WHERE iduser=?";
                            $up = $this->bdd->prepare($updateuser);
                            $up->bindparam(1, $lastidImg);
                            $up->bindparam(2, $userid);
                            return $up->execute();
                        }catch(Exception $e){
                            return json_encode(array("errorOperation"=>$e->getMessage()));
                        }
                    }
                   
                }
            }catch(Exception $ex){
                return json_encode(array("errorOperation"=>$ex->getMessage()));
            }            
        }
        private function renameImg($img)
        {
            $lastid=TIME();
            $boom = explode(".", $img);
            $ext = end($boom);
            $img = date('y') . Md5($lastid) . date('m') . '.' . $ext;
            $store = date('y') . Md5($lastid) . date('m');
            return array($img, $store);
        }
        private function thumbnail($img, $source, $dest)
        {
            $jpg = $source . $img;
            if ($jpg) {
                list($width, $height) = getimagesize($jpg); //$type will return the type of the image
                $source = imagecreatefromjpeg($jpg);

                if ($this->maxw >= $width && $this->maxh >= $height) {
                    $ratio = 1;
                } elseif ($width > $height) {
                    $ratio = $this->maxw / $width;
                } else {
                    $ratio = $this->maxh / $height;
                }

                $thumb_width = round($width * $ratio); //get the smaller value from cal # floor()
                $thumb_height = round($height * $ratio);

                $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
                imagecopyresampled($thumb, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);

                $path = '../' . $dest . $img;
                $image_thumb_path = $path;
                imagejpeg($thumb, $path, 60);
                return "true";
            } else {
                return "false";
            }
            imagedestroy($thumb);
            imagedestroy($source);
        }

    }
?>
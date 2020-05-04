<?php
    include_once "../config/connection.php";
    include_once "../class/media.php";
    session_start();
    //check if the media to upload is a profile picture
    if(isset($_POST['profilePricture'])){    
        $media = new media($connexion);
        switch($_POST['profilePricture']){
            case "UpdatePicture":
                $object = array(
                    "userid" => $_POST['userid'],
                    "topic" => false,
                    "topicid" => false
                );
                $result = $media->uploadImag($_FILES['profilePricture'], $object);
                if($result['errorOperation'] ){
                    $_SESSION['error'] = 123;
                    $_SESSION['errorMessage'] = $result['errorOperation'];
                }else{
                    $_SESSION['success'] = 5; 
                }
                header("location:../views/profil.php");
            break;
            case "topicImage":
                $object = array(
                    "userid" => $_POST['userid'],
                    "topic" => true,
                    "topicid" => $_POST['topicid']
                );
                $result = $media->uploadImag($_FILES['topicImage'], $object);
                header("location:../views/profil.php");
            break;
        }
    }
    
?>
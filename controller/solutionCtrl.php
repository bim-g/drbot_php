<?php
    include_once "../class/training.php";
    include "../config/connection.php";    
    $train=new Training($connexion);
    if(isset($_GET['training']) && $_GET['training']=="detailS"){
        if(isset($_GET['src']) && (int)$_GET['src']){
            $result=$train->getSolutions((int)$_GET['src']);
            if(!isset($result['ErrorExeption']) && count($result)==0){
                $_SESSION['warning']=1;
            }else{
                if(isset($result['ErrorExeption'])){
                    $_SESSION['error']=6;
                    $_SESSION['errorMessage']=$result['ErrorExeption'];
                }
            }  
        }else{
            $_SESSION['warning']=3;
        }
    }else{
        $result=$train->getSolutions(null);
        
        if(!isset($result['ErrorExeption']) && count($result)==0){
            $_SESSION['warning']=1;
        }else{
            if(isset($result['ErrorExeption'])){
                $_SESSION['error']=6;
                $_SESSION['errorMessage']=$result['ErrorExeption'];
            }
        }
    }
?>
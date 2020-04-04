<?php
    header("Access-Control-Allow-Origin: *");
    include '../config/connection.php';
    include_once '../class/training.php';

    $idtopic=null;
    $iduser=null;
    $idsolution=null;
    $titletopic=null;
    $intent=null;
    $questions=null;
    $summary=null;
    $description=null;
    session_start();
    if(isset($_POST['training'])){
        switch($_POST['training']){
            case "addtopic":
                $iduser=$_POST['iduser'];
                $titletopic=$_POST['titletopic'];
                $intent=$_POST['intent'];
                $questions=$_POST['questions'];
                $summary=$_POST['summary'];                
                $train=new Training($connexion);
                $train->init($idtopic,$iduser,$idsolution,$titletopic,$intent,$questions,$summary,$description);
                $result=$train->addTopic();                 
                if($result===true){
                    $_SESSION['success']=1;                    
                }else{                             
                    $_SESSION['error']=3;
                    $_SESSION['errorMessage']=$result['ErrorExeption']; 
                }                
                header("location:../pages/topics.php");
            break;
            case "updatetopic":
                $idtopic=$_POST['idtopic'];
                $iduser=$_POST['iduser'];
                $titletopic=$_POST['titletopic'];
                $intent=$_POST['intent'];
                $questions=$_POST['questions'];
                $summary=$_POST['summary'];                
                $train=new Training($connexion);
                $train->init($idtopic,$iduser,$idsolution,$titletopic,$intent,$questions,$summary,$description);
                $result=$train->updateTopic();
                if($result===true){
                    $_SESSION['success']=2;                    
                }else{                             
                    $_SESSION['error']=4;
                    $_SESSION['errorMessage']=$result['ErrorExeption']; 
                }
                header("location:../pages/topics.php");
            break;
            case "removetopic":
            break;
            case "addsolution":
                $idtopic=$_POST['idtopic'];
                $step=$_POST['step'];
                $description=$_POST['description'];                               
                $train=new Training($connexion);
                $train->init($idtopic,$iduser,$idsolution,$titletopic,$intent,$questions,$summary,$description);
                $result = $train->addSolution($step);
                if($result===true){
                    $_SESSION['success']=2;                    
                }else{                             
                    $_SESSION['error']=4;
                    $_SESSION['errorMessage']=$result['ErrorExeption']; 
                }
                header("location:../pages/solution.php");
            break;
            case "updatesolution":
                $idtopic=$_POST['idtopic'];
                $step=$_POST['step'];
                $description=$_POST['description'];                               
                $train=new Training($connexion);
                $train->init($idtopic,$iduser,$idsolution,$titletopic,$intent,$questions,$summary,$description);
                $result=$train->updateSolution($step);
                if($result===true){
                    $_SESSION['success']=2;                    
                }else{                             
                    $_SESSION['error']=4;
                    $_SESSION['errorMessage']=$result['ErrorExeption']; 
                }
                header("location:../pages/solution.php");
            break;
            case "deleteItem":
                $idtopic=$_POST['idelemnt'];                                               
                $train=new Training($connexion);
                $train->init($idtopic,$iduser,$idsolution,$titletopic,$intent,$questions,$summary,$description);
                $result=$train->removetopic(); 
                var_dump($result);               
                if($result===true){
                    $_SESSION['success']=3;                    
                }else{                             
                    $_SESSION['error']=5;
                    $_SESSION['errorMessage']=$result['ErrorExeption']; 
                }
                die();
                header("location:../pages/topics.php");
            break;
        }
        
    }
    
    if(isset($_GET['training'])){
        switch($_GET['training']){
            case "deleteItem":
                $idtopic=$_GET['idelemnt'];                
                $train=new Training($connexion);
                $train->init($idtopic,$iduser,$idsolution,$titletopic,$intent,$questions,$summary,$description);
                $result=$train->removetopic();
                var_dump($result);               
                if($result===true){
                    $_SESSION['success']=3;                    
                }else{                             
                    $_SESSION['error']=5;
                    $_SESSION['errorMessage']=$result['ErrorExeption']; 
                }
                header("location:../pages/topics.php");
            break;
        }
    }
    
?>
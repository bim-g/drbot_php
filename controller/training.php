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
                $train->addTopic();
                header("location:../pages/training.php");
            break;
            case "updatetopic":
                $iduser=$_POST['idtopic'];
                $iduser=$_POST['iduser'];
                $titletopic=$_POST['titletopic'];
                $intent=$_POST['intent'];
                $questions=$_POST['questions'];
                $summary=$_POST['summary'];                
                $train=new Training($connexion);
                $train->init($idtopic,$iduser,$idsolution,$titletopic,$intent,$questions,$summary,$description);
                $train->updateTopic();
                header("location:../pages/training.php");
            break;
            case "removetopic":
            break;
            case "addsolution":
                $idtopic=$_POST['idtopic'];
                $step=$_POST['step'];
                $description=$_POST['description'];                               
                $train=new Training($connexion);
                $train->init($idtopic,$iduser,$idsolution,$titletopic,$intent,$questions,$summary,$description);
                $train->addSolution($step);
                header("location:../pages/solution.php");
            break;
            case "updatesolution":
                $idtopic=$_POST['idtopic'];
                $step=$_POST['step'];
                $description=$_POST['description'];                               
                $train=new Training($connexion);
                $train->init($idtopic,$iduser,$idsolution,$titletopic,$intent,$questions,$summary,$description);
                $train->updateSolution($step);
                header("location:../pages/solution.php");
            break;
        }
        echo "none";
    }
    
    if(isset($_GET['training'])){
        switch($_GET['training']){
            case "delete":
                $idtopic=$_GET['src'];                
                $train=new Training($connexion);
                $train->init($idtopic,$iduser,$idsolution,$titletopic,$intent,$questions,$summary,$description);
                $train->removetopic();
                header("location:../pages/training.php");
            break;
        }
    }
    
?>
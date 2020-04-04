<?php
    include_once "../class/training.php";
    include "../config/connection.php";
    
    $restopic = null;
    $getdetail=array();
    if (isset($_GET['detailTopic']) && !empty($_GET['detailTopic'])) {    
        if ((int) $_GET['detailTopic']) {
            $idTopics = (int)$_GET['detailTopic'];
            $getdetail=getDetailTopic($connexion,$idTopics);
        } else {
            $_SESSION['error'] = 10;
        }
    }

    function getDetailTopic($connexion,$idTopics){
        $train = new Training($connexion);
        $restopic = $train->getTopics((int)$idTopics);
        if(!isset($restopic['ErrorExeption']) && count($restopic) > 0){
            $titletopic = null;
            $intent = null;
            $summary = null;
            $questions = array();
            foreach ($restopic as $topicitem) {
                $titletopic = $topicitem['titletopic'];
                $intent = $topicitem['intent'];
                $summary = $topicitem['summary'];
                $q = $topicitem['questions'];
            }
            
            array_push($questions,explode(";",$q));
            //get all available solution of the problem
            $resSolution=$train->getSolutions((int)$idTopics);
            //return le topic information a
            return array("detailTopic"=>array(
                            "topic"=>array($idTopics,$titletopic,$summary,$questions,$intent),
                            "solutions"=>$resSolution)
                        );
            
        } else {
            $_SESSION['error'] = 6;
            $_SESSION['errorMessage'] = $restopic['ErrorExeption'];
        }
    }
    
?>
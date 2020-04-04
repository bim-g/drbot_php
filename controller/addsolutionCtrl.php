<?php
    include_once "../class/training.php";
    include "../config/connection.php";
    $iduser = $_SESSION['iduser'];
    $titletopic = null;
    $idsolution = null;
    $topic = null;
    $idtopic = null;
    $position = null;
    $description = null;
    if (isset($_GET['solution']) && (int) $_GET['solution']) {
        $train = new Training($connexion);
        $result = $train->detailSolution((int) $_GET['solution']);
        if (!isset($result['ErrorExeption'])) {
            if (count($result) > 0) {
                foreach ($result as $item) {
                    $topic = $item['titletopic'];
                    $idsolution = $item['idsolution'];
                    $position = $item['step'];
                    $description = $item['description'];
                }
            } else {
                $_SESSION['warning'] = 1;
            }
        } else {
            if (isset($result['ErrorExeption'])) {
                $_SESSION['error'] = 6;
                $_SESSION['errorMessage'] = $result['ErrorExeption'];
            }
        }
    } elseif ((isset($_GET['idtopic']) && !empty($_GET['idtopic'])) && (isset($_GET['topic']) && !empty($_GET['topic']))) {
        $topic = $_GET['topic'];
        $idtopic = $_GET['idtopic'];
    } else {
        header("location:./topicTraining.php");
    }

?>
<?php
    include_once "../class/training.php";
    include "../config/connection.php";
    
    $iduser = $_SESSION['iduser'];
    $titletopic = null;
    $intent = null;
    $summary = null;
    $questions = null;
    //
    $infos = null;
    $idtopic = null;
    $procedure = null;
    $assistence = null;
    $produceM = null;
    $detailTopic=array();
    //detail&src=8
    if (isset($_GET['training']) && !empty($_GET['training'])) {
        if ((int) $_GET['src']) {
            $train = new Training($connexion);
            $result = $train->getTopics((int) $_GET['src']);
            if (!isset($result['ErrorExeption']) && count($result) > 0) {
                foreach ($result as $item) {
                    $idtopic = $item['idtopic'];
                    $titletopic = $item['titletopic'];
                    $intent = $item['intent'];
                    $summary = $item['summary'];
                    $questions = $item['questions'];
                    switch ($item['intent']) {
                        case "infos":
                            $infos = "checked";
                            break;
                        case "procedure":
                            $procedure = "checked";
                            break;
                        case "assistance":
                            $assistence = "checked";
                            break;
                        case "procedure_more":
                            $produceM = "checked";
                            break;
                    }
                }
                $_SESSION['success'] = 4;
            } else {
                $_SESSION['error'] = 6;
                $_SESSION['errorMessage'] = $result['ErrorExeption'];
            }
        }else {
            $_SESSION['error'] = 10;
        }
    }
?>
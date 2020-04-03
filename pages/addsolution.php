<?php
    session_start();
    ob_start();
    
    include_once "../class/training.php";
    include "../config/connection.php";
    include "./sessioncontrol.php";
    $title="Addsolution";
    $iduser=$_SESSION['iduser'];
    $titletopic=null;
    $idsolution=null;
    $topic=null;
    $idtopic=null;
    $position=null;
    $description=null;
    if(isset($_GET['solution']) && (int)$_GET['solution']){
        $train = new Training($connexion);
        $result=$train->detailSolution((int)$_GET['solution']);
        if(!isset($result['ErrorExeption']) ){
            if(count($result)>0){
                foreach($result as $item){
                    $topic=$item['titletopic'];
                    $idsolution=$item['idsolution'];
                    $position=$item['step'];
                    $description=$item['description'];
                }
            }else{
                $_SESSION['warning']=1;
            }
        }else{
            if(isset($result['ErrorExeption'])){
                $_SESSION['error']=6;
                $_SESSION['errorMessage']=$result['ErrorExeption'];
            }
        }
    }
    elseif((isset($_GET['idtopic']) && !empty($_GET['idtopic'])) && (isset($_GET['topic']) && !empty($_GET['topic']))){
        $topic=$_GET['topic'];
        $idtopic=$_GET['idtopic'];
    }else{
        header("location:./topicTraining.php");
    }
    //detail&src=8
    
?>
    <div class="">

        <div class=" w3-container w3-padding " style="width:750px;">
            <?php include "./control.php";?>
            <div class="w3-margin contactUsContent w3-light-gray w3-card w3-round" id="contactUs">
                <form method="POST" class="w3-padding" action="../controller/training.php">                
                    <?php   echo"<input type=\"hidden\" name=\"idtopic\" value=\"$idtopic\">";
                            echo"<input type=\"hidden\" name=\"idsolution\" value=\"$idsolution\">";
                        ?>
                    <div class="w3-row-padding">
                        <div class="w3-col s9 l9 m9">
                        <label class="w3-text-gray w3-small">TRAINING TOPIC</label><br>
                            <div class="" id="nameNewTopic">
                                <?php echo "<input type=\"text\" name=\"titletopic\"  class=\"w3-input w3-border w3-round\" placeholder=\"Topic Title\" value=\"$topic\" disabled>"; ?>
                            </div>
                        </div>
                        <div class="w3-col s3 l3 m3">
                            <label class="w3-text-gray w3-small">STEP POSITION</label><br>
                            <div class="" id="nameNewTopic">
                                <?php echo "<input type=\"text\" name=\"step\"  class=\"w3-input w3-border w3-round\" placeholder=\"Position\" value=\"$position\" required>"; ?>
                            </div>
                        </div>
                    </div>
                    <div class="w3-row-padding">
                        <div class="w3-col s12 l12 m12">
                            <label class="w3-text-gray w3-small">DESCRIPTION</label><br>
                            <textarea name="description" id="questions" cols="10" rows="5" class="w3-input w3-border w3-round w3-margin-bottom" required><?php echo $description?></textarea>
                        </div>
                    </div>
                   
                    <div class="w3-padding">
                        <?php
                            if(isset($_GET['solution']) && !empty($_GET['solution'])){
                                echo "<button type=\"submit\" class=\"w3-button w3-blue\" name=\"training\" value=\"updatesolution\">Update solution <i class=\"fa fa-save\"></i></button>";
                            }else{
                                echo "<button type=\"submit\" class=\"w3-button w3-blue\" name=\"training\" value=\"addsolution\">Save solution <i class=\"fa fa-save\"></i></button>";
                            }
                        ?>
                    </div>
                </form>
            </div>
        </div> 
    </div> 
    <?php

    $contentpages=ob_get_clean();
    include "./template.php";
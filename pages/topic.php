<?php
    session_start();
    ob_start();
    
    include_once "../class/training.php";
    include "../config/connection.php";
    include "./sessioncontrol.php";
    $title="Training Topic";
    $iduser=$_SESSION['iduser'];
    $titletopic=null;
    $intent=null;
    $summary=null;
    $questions=null;
    //
    $infos=null;
    $idtopic=null;
    $procedure=null;
    $assistence=null;
    $produceM=null;
    //detail&src=8
    if(isset($_GET['training']) && !empty($_GET['training'])){
        if((int)$_GET['src']){
            $train=new Training($connexion);
            $rows=$train->getTopics((int)$_GET['src']);
            foreach($rows as $item){
                $idtopic=$item['idtopic'];
                $titletopic=$item['titletopic'];
                $intent=$item['intent'];
                $summary=$item['summary'];
                $questions=$item['questions'];
                switch($item['intent']){
                    case "infos":$infos="checked";
                    break;
                    case "procedure":$procedure="checked";
                    break;
                    case "assistance":$assistence="checked";
                    break;
                    case "procedure_more":$produceM="checked";
                    break;
                }
            }
        }else{
            header("location:./topic.php?error=11");
        }
        
    }else{
        header("location:./topic.php?error=10");
    }
?>
    <div class="w3-light-gray w3-padding">

        <div class=" w3-container w3-padding " style="width:750px;">
            <?php include "./control.php";?>
            <div class="w3-margin contactUsContent w3-light-gray w3-card w3-round" id="contactUs">
                <form method="POST" class="w3-padding" action="../controller/training.php">
                <?php if(isset($_GET['training']) && !empty($_GET['training'])){
                    echo "<a href=\"./solution.php?training=detailS&src=".$_GET['src']."\" class=\"w3-button w3-right  w3-blue\"><i class=\"fa fa-reply-all\"></i></a>";
                    echo"<input type=\"hidden\" name=\"idtopic\" value=\"$idtopic\">";
                 } ?>
                    <h3>Training Topics</h3> 
                    <?php echo"<input type=\"hidden\" name=\"iduser\" value=\"$iduser\">";?>
                    <div class="" id="nameNewTopic">
                        <?php echo "<input type=\"text\" name=\"titletopic\"  class=\"w3-input w3-border w3-round\" placeholder=\"Topic Title\" value=\"$titletopic\">"; ?>
                    </div><br/>                    
                    <div class=" w3-border w3-round"> 
                        <p class="w3-gray w3-padding w3-center">Topic Intent</p>
                        <div class="w3-row w3-padding">                       
                            <div class="w3-col s2 m2 l2 w3-border-right">
                                Infos <input type="radio" name="intent" value="infos" id="intent" class="w3-radio w3-margin-left" <?php echo $infos;?>>
                            </div>
                            <div class="w3-col s3 m3 l3 w3-border-right">
                                Procedure <input type="radio" name="intent" value="procedure" id="intent" class="w3-radio w3-margin-left" <?php echo $procedure;?>>
                            </div>
                            <div class="w3-col s3 m3 l3 w3-border-right">
                                Assistance<input type="radio" name="intent" value="assistance" id="intent" class="w3-radio w3-margin-left" <?php echo $assistence;?>>
                            </div>
                            <div class="w3-col s4 m4 l4">
                                Procedure Assist<input type="radio" name="intent" value="procedure_more" id="intent" class="w3-radio w3-margin-left" <?php echo $produceM;?>>
                            </div>
                        </div>  
                    </div> 
                    <br>
                    <p>Topic Summary</p>
                    <textarea name="summary" id="summary" cols="10" rows="5" class="w3-input w3-border w3-round"><?php echo $summary?></textarea>
                    <br>
                    <p>Topic Questions</p>
                    <textarea name="questions" id="questions" cols="10" rows="5" class="w3-input w3-border w3-round w3-margin-bottom"><?php echo $questions?></textarea>
                    <div class="w3-padding">
                        <?php
                            if(isset($_GET['training']) && !empty($_GET['training'])){
                                echo "<button type=\"submit\" class=\"w3-button w3-blue\" name=\"training\" value=\"updatetopic\">Update Topic <i class=\"fa fa-save\"></i></button>";
                            }else{
                                echo "<button type=\"submit\" class=\"w3-button w3-blue\" name=\"training\" value=\"addtopic\">Save Topic <i class=\"fa fa-save\"></i></button>";
                            }
                        ?>

                    </div>
                </form>
                <div class="w3-padding">
                    <span class="w3-text-blue">*</span><span class="w3-tiny w3-text-gray">for different learning value, you have to separeate with a semi-colom ";" </span>

                </div>
            </div>
        </div> 
    </div> 
    <?php

    $contentpages=ob_get_clean();
    include "./template.php";
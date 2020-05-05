<?php
session_start();
ob_start();
$title = "Training Topic";
include "./sessioncontrol.php";
require '../controller/topicTrainingCtrl.php';
?>
<div class="w3-row">
    <div class=" w3-container w3-padding w3-col s8">
        <?php include "./control.php"; ?>
        <div class="w3-margin contactUsContent w3-light-gray w3-card w3-round" id="contactUs">
            <?php if (isset($_GET['training']) && !empty($_GET['training'])) { ?>
                <div class="w3-padding w3-right w3-margin-top w3-margin-bottom w3-border w3-round" style="width:50%;">
                    <form method="POST" action="../controller/training.php">
                        <?php echo "<input type=\"hidden\" name=\"idtopic\" value=\"$idtopic\">"; ?>
                        <div class="w3-row">
                            <div class="w3-col l4 m4 s4">
                                Publiched<input type="radio" name="state" class="w3-radio" value="1" <?php echo $published; ?>>
                            </div>
                            <div class="w3-col l4 m4 s4">
                                edite<input type="radio" name="state" class="w3-radio" value="0" <?php echo $edited; ?>>
                            </div>
                            <input type="submit" name="training" class="w3-button w3-blue w3-col l4 m4 s4" value="updateState">
                        </div>
                    </form>
                </div>
            <?php } ?>
            <form method="POST" class="w3-padding " action="../controller/training.php">
                <?php if (isset($_GET['training']) && !empty($_GET['training'])) {
                    echo "<button onclick=\"gotopages('solution.php?training=detailS&src=" . $_GET['src'] . "')\" class=\"w3-button w3-right  w3-blue\"><i class=\"fa fa-reply-all\"></i> Solutions</button>";
                    echo "<input type=\"hidden\" name=\"idtopic\" value=\"$idtopic\">";
                } ?>
                <h3>Training Topics</h3>
                <?php echo "<input type=\"hidden\" name=\"iduser\" value=\"$iduser\">"; ?>
                <div class="" id="nameNewTopic">
                    <?php echo "<input type=\"text\" name=\"titletopic\"  class=\"w3-input w3-border w3-round\" placeholder=\"Topic Title\" value=\"$titletopic\">"; ?>
                </div><br />
                <div class=" w3-border w3-round">
                    <p class="w3-gray w3-padding w3-center">Topic Intent</p>
                    <div class="w3-row w3-padding">
                        <div class="w3-col s2 m2 l2 w3-border-right">
                            Infos <input type="radio" name="intent" value="infos" id="intent" class="w3-radio w3-margin-left" <?php echo $infos; ?>>
                        </div>
                        <div class="w3-col s3 m3 l3 w3-border-right">
                            Procedure <input type="radio" name="intent" value="procedure" id="intent" class="w3-radio w3-margin-left" <?php echo $procedure; ?>>
                        </div>
                        <div class="w3-col s3 m3 l3 w3-border-right">
                            Assistance<input type="radio" name="intent" value="assistance" id="intent" class="w3-radio w3-margin-left" <?php echo $assistence; ?>>
                        </div>
                        <div class="w3-col s4 m4 l4">
                            Procedure Assist<input type="radio" name="intent" value="procedure_more" id="intent" class="w3-radio w3-margin-left" <?php echo $produceM; ?>>
                        </div>
                    </div>
                </div>
                <br>
                <p>Topic Summary</p>
                <textarea name="summary" id="summary" cols="10" rows="5" class="w3-input w3-border w3-round"><?php echo $summary ?></textarea>
                <br>
                <p>Topic Questions</p>
                <textarea name="questions" id="questions" cols="10" rows="5" class="w3-input w3-border w3-round w3-margin-bottom"><?php echo $questions ?></textarea>
                <div class="w3-padding">
                    <?php
                    if (isset($_GET['training']) && !empty($_GET['training'])) {
                        echo "<button type=\"submit\" class=\"w3-button w3-blue\" name=\"training\" value=\"updatetopic\">Update Topic <i class=\"fa fa-save\"></i></button>";
                    } else {
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
    <div class="w3-margin w3-white w3-round w3-col s3 w3-center w3-border">
        <div class="w3-display-container " style="min-width:150px;">
            <div class="w3-border-bottom " style="height:180px; overflow:hidden">
                <?php echo "<img src=\"$imgTopic\" alt=\"\" class=\"w3-image  \" style=\"width:100%;\">"; ?>
            </div>
            <form method="POST" action="../controller/mediaCtrl.php" enctype="multipart/form-data">
                <?php echo "<input type=\"hidden\" name=\"topicid\" value=\"$idtopic\">";
                echo "<input type=\"hidden\" name=\"userid\" value=\"$iduser\">"; ?>
                <label class="w3-display-right w3-padding w3-text-blue w3-hover-text-red pointer"><i class="fa fa-camera w3-xxlarge"></i>
                    <?php echo "<input type=\"file\" name=\"profilePricture\" id=\"profilePricture\" value=\"$idtopic\" hidden></label>"; ?>
        </div>
        <div class="w3-padding ">
            <hr class="w3-margin-top">
            <?php if ($iduser == $_SESSION['iduser']) { ?>
                <div class="w3-bar">
                    <input type="submit" name="profilePricture" value="updateImage" class="w3-green w3-button">
                </div>
            <?php } ?>
            </form>
        </div>
    </div>
</div>
<?php

$contentpages = ob_get_clean();
include "./template.php";

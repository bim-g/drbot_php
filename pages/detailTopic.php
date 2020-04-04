<?php
session_start();
ob_start();
include "./sessioncontrol.php";
require "../controller/detailTopicCtrl.php";
$title = "Detail Topic";
$getdetail = $getdetail['detailTopic'];
$topic = $getdetail['topic'];
$solutions = array();
if (count($getdetail['solutions']) > 0) {
    $solutions = $getdetail['solutions'];
}
$questions = $topic[3][0];
?>
<div class="">
    <div class=" w3-container w3-padding ">
        <div class="w3-bar ">
            <div class="w3-bar-item w3-right">
                <button onclick="gotopages('ListTrainingTopic.php')" class="w3-button w3-blue"><i class="fa fa-h-square"></i> Topics</button>
                <button onclick="gotopages('solution.php')" class="w3-button w3-green"><i class="fa fa-medkit"></i> Solutions</button>
            </div>
            <div class="w3-bar-item">
                <?php echo
                    "<button class=\"w3-button w3-green\" onclick=\"gotopages('topicTraining.php')\"><i class=\"fa fa-plus\"></i> Add</button>
                    <button class=\"w3-button w3-blue\" onclick=\"gotopages('topicTraining.php?training=detail&src=" . $topic[0] . "')\"><i class=\" fa fa-edit\"></i> Edit</button>
                <button class=\"w3-button w3-red\" onclick=\"getId(" . $topic[0] . ",'training');w3.show('#deleteQ')\"><i class=\"fa fa-trash\"></i> Del</button>";
                ?>
            </div>
        </div>
        <div class="w3-margin-top w3-white w3-card w3-round" id="topicDetails">
            <div class="w3-padding">
                <h3> Detail Topic</h3>
            </div>
            <div class="w3-row-padding ">
                <div class="w3-col l5 m10 s12 w3-margin">
                    <div class="w3-border w3-round w3-light-gray w3-margin-bottom">
                        <?php
                        echo    "<div class=\" w3-border-bottom\">
                            <h4 class=\"w3-padding \">$topic[1]</h4> 
                        </div>
                        <div class=\" w3-white w3-padding w3-margin-bottom\">$topic[2]</div>";
                        ?>
                    </div>
                    <div class="w3-border w3-round w3-light-gray ">
                        <div class=" w3-border-bottom">
                            <h4 class="w3-padding ">Questions</h4>
                        </div>
                        <p class="w3-padding">
                            <?php
                            foreach ($questions as $q) {
                                echo "<span class=\"w3-blue-grey w3-border w3-hover-text-yellow w3-round\" style=\"padding-left:8px;padding-right:8px;margin-right:2px;\"> $q </span>";
                            }
                            ?></p>
                    </div>
                </div>
                <div class="w3-col l6 m10 s12 w3-border w3-round w3-light-gray w3-margin">
                    <div class=" w3-border-bottom">
                        <h4 class="w3-padding ">Topic Solutions</h4>
                    </div>
                    <div class="w3-row">
                        <?php
                        foreach ($solutions as $item) {
                            echo "<div class=\" w3-col l1 m1 s2\" style=\"padding-left:8px;\">" . $item['step'] . ")</div>
                            <div class=\"w3-border-left w3-col l11 m11 s110 w3-margin-bottom w3-padding w3-white\">" . $item['description'] . "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php

$contentpages = ob_get_clean();
include "./template.php";

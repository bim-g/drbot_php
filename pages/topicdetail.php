<?php
session_start();
ob_start();

include "./sessioncontrol.php";
require '../controller/topicTrainingCtrl.php';
?>
<div class="w3-light-gray w3-padding">
    <div class=" w3-container w3-padding ">
        <div class="w3-bar ">
            <div class="w3-bar-item w3-right">
                <a href="./ListTrainingTopic.php" class="w3-button w3-blue"><i class="fa fa-h-square"></i> Topics</a>
                <a href="./solution.php" class="w3-button w3-green"><i class="fa fa-medkit"></i> Solutions</a>
            </div>
            <div class="w3-bar-item">
                <buttton class="w3-button w3-green"><i class="fa fa-plus"></i> Add</buttton>
                <buttton class="w3-button w3-blue"><i class="fa fa-edit"></i> Edit</buttton>
                <buttton class="w3-button w3-red"><i class="fa fa-trash"></i> Add</buttton>
            </div>
        </div>
        <div class="w3-margin-top w3-white w3-card w3-round" id="topicDetails">
            <div class="w3-padding">
                <h3> Detail Topic</h3>
            </div>
            <div class="w3-row-padding ">
                <div class="w3-col l5 m10 s12 w3-border w3-round w3-light-gray w3-margin">
                    <div class=" w3-border-bottom">
                        <h4 class="w3-padding ">Title</h4>
                    </div>
                    <div class=" w3-white w3-padding w3-margin-bottom">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum minima dolor numquam saepe soluta sapiente! Enim molestias, cum, rerum aut dignissimos libero culpa nihil quae deleniti sed fugit, suscipit repellat?</div>
                </div>
                <div class="w3-col l6 m10 s12 w3-border w3-round w3-light-gray w3-margin">
                    <div class=" w3-border-bottom">
                        <h4 class="w3-padding ">Topic Solutions</h4>
                    </div>
                    <div class="w3-margin-bottom w3-padding w3-white">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum veniam explicabo quos nobis. Quis corporis maiores ab alias nam obcaecati soluta quod voluptatibus eum? Debitis maiores totam maxime quas dolorem?
                    </div>
                    <div class="w3-margin-bottom w3-padding w3-white">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum veniam explicabo quos nobis. Quis corporis maiores ab alias nam obcaecati soluta quod voluptatibus eum? Debitis maiores totam maxime quas dolorem?
                    </div>
                    <div class="w3-margin-bottom w3-padding w3-white">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum veniam explicabo quos nobis. Quis corporis maiores ab alias nam obcaecati soluta quod voluptatibus eum? Debitis maiores totam maxime quas dolorem?
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<?php

$contentpages = ob_get_clean();
include "./template.php";

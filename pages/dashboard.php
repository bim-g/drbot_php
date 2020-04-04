<?php
    session_start();
    ob_start();
    
    $title="dashboard";
    $iduser=$_SESSION['iduser'];
    
?>
    <div class="">
        <button onclick="gotopages('profil.php')" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-yellow dash-control-button" >
            <i class="fa fa-user-md w3-xlarge w3-jumbo center"></i>
            <p class="w3-text-gray w3-small bottom w3-margin-left"> Profil </p>
        </button>
        <button onclick="gotopages('security.php')" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-green dash-control-button" >
            <i class="fa fa-expeditedssl w3-xlarge w3-jumbo center"></i>
            <p class="w3-text-gray w3-small bottom w3-margin-left"> Security </p>
        </a>
        <button href="#" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-deep-orange dash-control-button" >
            <i class="fa fa-line-chart w3-xlarge w3-jumbo center"></i>
            <p class="w3-text-gray w3-small bottom w3-margin-left"> Stattistics </p>
        </button>
        <?php  if ($_SESSION['level']=="admin" || $_SESSION['level']=="trainer" || $_SESSION['level']=="validate"){ ?>
        <button onclick="gotopages('topics.php')" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-blue-gray dash-control-button w3-center" >
            <i class="fa fa-slack w3-xlarge w3-jumbo center"></i>
            <p class="w3-text-gray w3-small bottom w3-margin-left"> List Topics</p>
        </button>
        <button onclick="gotopages('notification.php')" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-purple dash-control-button" >
            <i class="fa fa-heartbeat w3-xlarge w3-jumbo center"></i>
            <p class="w3-text-gray w3-small bottom w3-margin-left"> Notification </p>
        </button>
        <?php
            if ($_SESSION['level']=="admin"){
            ?>
            
        <button onclick="gotopages('users.php')" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-blue dash-control-button w3-center" >
            <i class="fa fa-address-card w3-xlarge w3-jumbo center"></i>
            <p class="w3-text-gray w3-small bottom w3-margin-left"> Users </p>
        </button>
        <button onclick="gotopages('message.php')" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-teal w3-text-teal dash-control-button" >
            <i class="fa fa-envelope w3-xlarge w3-jumbo center"></i>
            <p class="w3-text-gray w3-small bottom w3-margin-left"> message </p>
        </button>
        <?php } } ?>
    </div> 
    <?php

    $contentpages=ob_get_clean();
    include "./template.php";
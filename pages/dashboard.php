<?php
    session_start();
    ob_start();
    
    $title="dashboard";
    $iduser=$_SESSION['iduser'];
    
?>
    <div class="w3-light-gray w3-padding">
        <a href="profil.php" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-yellow dash-control-button" >
            <i class="fa fa-user-md w3-xlarge w3-jumbo center"></i>
        </a>
        <a href="security.php" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-green dash-control-button" >
            <i class="fa fa-expeditedssl w3-xlarge w3-jumbo center"></i>
        </a>
        <a href="#" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-deep-orange dash-control-button" >
            <i class="fa fa-line-chart w3-xlarge w3-jumbo center"></i>
        </a>
        <?php  if ($_SESSION['level']=="admin" || $_SESSION['level']=="trainer" || $_SESSION['level']=="validate"){ ?>
        <a href="training.php" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-blue-gray dash-control-button" >
            <i class="fa fa-slack w3-xlarge w3-jumbo center"></i>
            <p class="w3-text-gray w3-small bottom "> Training</p>
        </a>
        <a href="notification.php" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-purple dash-control-button" >
            <i class="fa fa-heartbeat w3-xlarge w3-jumbo center"></i>
        </a>
        <?php
            if ($_SESSION['level']=="admin"){
            ?>
            
        <a href="users.php" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-blue dash-control-button" >
            <i class="fa fa-address-card w3-xlarge w3-jumbo center"></i>
        </a>
        <a href="message.php" class="w3-btn w3-container w3-round w3-pading w3-margin w3-white w3-text-teal w3-text-teal dash-control-button" >
            <i class="fa fa-envelope w3-xlarge w3-jumbo center"></i>
        </a>
        <?php } } ?>
    </div> 
    <?php

    $contentpages=ob_get_clean();
    include "./template.php";
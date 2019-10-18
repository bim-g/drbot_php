<?php 
    $m_profil=null;
    $m_security=null;
    $m_training=null;
    $m_users=null;
    $m_message=null;
    if(isset($_COOKIE['activemenu'])){
        $m_profil=null;
        $m_security=null;
        $m_training=null;
        $m_users=null;
        $m_message=null;
        switch($_COOKIE['activemenu']){
            case "profil":$m_profil="active";
            break;
            case "security":$m_security="active";
            break;
            case "training":$m_training="active";
            break;
            case "users":$m_users="active";
            break;
            case "message":$m_message="active";
            break;
        }
    } 
?>
<div class="w3-padding">
    <div class="w3-bar-block w3-text-white">
        <div class="w3-bar-block w3-text-white ">
            <a href="profil.php" class="w3-bar-item dasHover w3-round <?php echo $m_profil;?>"><i class="fa fa-user-md w3-xlarge w3-margin-right"></i><span class="w3-center"> Profil</span></a>
            <a href="security.php" class="w3-bar-item dasHover w3-round <?php echo $m_security;?>"><i class="fa fa-expeditedssl w3-xlarge w3-margin-right"></i><span class="w3-center"> security</span></a>
            <a href="#" class="w3-bar-item dasHover w3-round"><i class="fa fa-line-chart w3-xlarge w3-margin-right"></i><span class="w3-center"> Statistics</span></a>
            <?php  if ($_SESSION['level']=="admin" || $_SESSION['level']=="trainer" || $_SESSION['level']=="validate"){ ?>
            <a href="training.php" class="w3-bar-item dasHover w3-round <?php echo $m_training;?>"><i class="fa fa-slack w3-xlarge w3-margin-right"></i><span class="w3-center"> Training</span></a>
            <a href="notification.php" class="w3-bar-item dasHover w3-round"><i class="fa fa-heartbeat w3-xlarge w3-margin-right"></i><span class="w3-center"> Notification</span></a>
            <?php
            if ($_SESSION['level']=="admin"){
            ?>
            
            <a href="users.php" class="w3-bar-item dasHover w3-round <?php echo $m_users;?>"><i class="fa fa-address-card w3-xlarge w3-margin-right"></i><span class="w3-center"> Users</span></a>
            <a href="message.php" class="w3-bar-item dasHover w3-round <?php echo $m_message;?>"><i class="fa fa-envelope w3-xlarge w3-margin-right"></i><span class="w3-center"> Message</span></a>
            <?php } } ?>
        </div>
    </div>
</div>
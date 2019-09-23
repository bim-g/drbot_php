<?php
    if(empty($_SESSION['connexionStatus']) && $_SESSION['connexionStatus']!="ON"){
        header("location:../");
        die();
    }
?>
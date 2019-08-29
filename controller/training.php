<?php
    header("Access-Control-Allow-Origin: *");
    include '../config/connection.php';
    include_once '../class/users.php';

    if(isset($_POST['training'])){
        switch($_POST['training']){
            case "addtopic":
                
            break;
            case "gettopic":
            break;
            case "removetopic":
            break;
        }
    }
?>
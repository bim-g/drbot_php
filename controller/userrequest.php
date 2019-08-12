<?php
header("Access-Control-Allow-Origin: *");
    include '../config/connection.php';
    include_once '../class/users.php';

    $id=NULL;
    $name=NULL;
    $dest=NULL;
    $numpage=NULL;

    if(isset($_POST['user'])){
        switch($_POST['user']){
            case 'adduser':            
            $conf = new user($connexion);
            $conf->adduser();
            break;
            case 'updateuser':
            $id=$_POST['idDepart'];
            $name=$_POST['NameService'];
            $conf = new user($connexion);
            $conf->updateuser();
            break;
            case 'connection':            
            $conf = new user($connexion);
            $conf->connexion();
            break;
        }
    }
    if(isset($_GET['user'])){
        switch($_GET['user']){
            case 'getAllusers':
            $numpage=$_GET['numpages'];
            $conf = new users($connexion);
            $conf->getusers(0,true,$numpage);
            break;
        }   
    }
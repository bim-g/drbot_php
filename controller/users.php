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
            $conf = new users($connexion);
            $conf->adduser();
            break;
            case 'updateuser':
            $id=$_POST['idDepart'];
            $name=$_POST['NameService'];
            $conf = new users($connexion);
            //$conf->updateuser();
            break;
            case 'connection': 
            if(!empty($_POST['loginusername']) && !empty($_POST['loginpassword'])){          
                $conf = new users($connexion);
                $record=$conf->connexion($_POST['loginusername'],$_POST['loginpassword']);
                foreach($record as $item){
                    session_start();
                    $_SESSION['connexionStatus']="ON";
                    $_SESSION['iduser']=$item['iduser'];
                    $_SESSION['fname']=$item['fname'];
                    $_SESSION['lname']=$item['lname'];
                    $_SESSION['level']=$item['designation'];
                    $_SESSION['avatar']=$item['link'];
                }
                header("location:../");
            }else{
                header("location:../index.php?error=1&Type=emptyInput");
            }
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
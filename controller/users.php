<?php

header("Access-Control-Allow-Origin: *");
    include '../config/connection.php';
    include_once '../class/users.php';

    $id=null;
    $fname=null;
    $lname=null;
    $sexe=null;
    $birthday=null;
    $phonenumber=null;   
    $company=null;
    $country=null;
    $city=null;
    $address=null;
    $nationalId=null;
    $grade=null;
    $speciliation=null;
    $levelStudies=null;
    $username=null;
    $email=null;
    $about=null;   
    $password=null;   
    $iddomain=null;   

    if(isset($_POST['user'])){
        switch($_POST['user']){
            case 'adduser': 
                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                $phonenumber=$_POST['phonenumber'];            
                $sexe=$_POST['sexe'];
                $username=$_POST['username'];
                $email=$_POST['email'];         
                $password=$_POST['password'];      
                $conf = new users($connexion);
                $conf->init($id,$fname,$lname,$sexe,$birthday,$phonenumber,$company,$country,$city,$address,$nationalId,$grade,$levelStudies,$username,$email,$about,$iddomain);
                $conf->adduser($password);
                header("location:../");
                break;
            case 'updateuser':           
                $id=$_POST['iduser'];
                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                $phonenumber=$_POST['phonenumber'];
                $company=$_POST['company'];
                $country=$_POST['country'];
                $city=$_POST['city'];
                $address=$_POST['address'];
                if(isset($_POST['nationalId'])){
                    $nationalId=$_POST['nationalId'];
                }
                if(isset($_POST['grade'])){
                    $grade=$_POST['grade'];
                }
                if(isset($_POST['levelstudies'])){
                    $levelStudies=$_POST['levelstudies'];
                }               
                if(isset($_POST['domain'])){
                    $iddomain=$_POST['domain']; 
                }               
                $username=$_POST['username'];
                $email=$_POST['email'];
                $about=$_POST['about'];           
                $conf = new users($connexion);
                $conf->init($id,$fname,$lname,$sexe,$birthday,$phonenumber,$company,$country,$city,$address,$nationalId,$grade,$levelStudies,$username,$email,$about,$iddomain);
                $conf->updateuser();            
                header("location:../pages/profil.php");
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
            case 'contact': 
            if(!empty($_POST['emailsender']) && !empty($_POST['emailsender'])){          
                $conf = new users($connexion);
                $conf->storemessage($_POST['namesender'],$_POST['emailsender'],$_POST['objtmsg'],$_POST['contentmsg']);              
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
            if(is_int($_GET['numpages'])){
                $numpage=$_GET['numpages'];
                $conf = new users($connexion);
                $conf->getusers(0,true,$numpage);
            }else{
                header("location:../pages/users.php");
            }
            break;
            case 'getNotification':
                if(is_int($_GET['idcase'])){
                    $id=$_GET['iduser'];
                    $conf = new users($connexion);
                    $conf->getNotification($id);
                }else{
                    header("location:../pages/notification.php");
                }
            break;
            case 'updatecase':
            if(isset($_GET['case'])){
                $id=(int)$_GET['case'];
                $type=$_GET['type'];
                $conf = new users($connexion);
                $conf->stateCase($id,$type);
                header("location:../pages/notification.php");
            }else{
                header("location:../pages/notification.php?error=123");
            }
            break;
        }   
    }
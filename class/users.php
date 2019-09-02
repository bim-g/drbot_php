<?php
    class users{
        private $bdd;
        private $iduser;
        private $fname;
        private $lname;
        private $sexe;
        private $birthday;
        private $phonenumber;
        private $company;
        private $country;
        private $address;
        private $city;
        private $nationalId;
        private $grade;
        private $levelStudies;
        private $username;
        private $email;
        private $about;
        private $password;
        private $iddomain;

        function __construct($db)
        {
            $this->bdd=$db;
        }
        function setid($id){
            $this->iduser=$id;
        }
        function getID(){
            return $this->iduser;
        }
        function init($id,$fname,$lname,$sexe,$birthday,$phonenumber,$company,$country,$city,$address,$nationalId,$grade,$levelStudies,$username,$email,$about,$iddomain){
            $this->iduser=$id;
            $this->fname=$fname;
            $this->lname=$lname;
            $this->sexe=$sexe;
            $this->birthday=$birthday;
            $this->phonenumber=$phonenumber;
            $this->company=$company;
            $this->country=$country;
            $this->city=$city;
            $this->address=$address;
            $this->nationalId=$nationalId;
            $this->grade=$grade;
            $this->levelStudies=$levelStudies;
            $this->username=$username;
            $this->email=$email;
            $this->about=$about;
            $this->iddomain=$iddomain;
        }
        function connexion($username,$password){
            $this->username=$username;
            $this->password=md5($password);
            $sql="SELECT u.iduser,u.fname,u.lname,l.designation,m.link FROM users u LEFT JOIN userlevel l ON u.iduserlevel=l.iduserlevel LEFT JOIN media m ON u.idavatar=m.idmedia WHERE (username=? OR email=?) AND password=?";
            $req=$this->bdd->prepare($sql);
            $req->bindparam(1,$this->username);
            $req->bindparam(2,$this->username);
            $req->bindparam(3,$this->password);
            try{
                $req->execute();
                return $req->fetchAll();
            }catch(Exception $ex){
                echo "errorConnexion::".$ex->getMessage();
            }
        }
        function adduser($password){
            $this->password=md5($password);
            $sql="INSERT INTO users (fname,lname,language,sexe,phonenumber,username,email,password,idstate,iduserlevel,dateregister) 
            VALUES (?,?,'en_us',?,?,?,?,?,1,2,NOW())";
            $req=$this->bdd->prepare($sql);
            $req->bindparam(1,$this->fname);
            $req->bindparam(2,$this->lname);
            $req->bindparam(3,$this->sexe);
            $req->bindparam(4,$this->phonenumber);
            $req->bindparam(5,$this->username);
            $req->bindparam(6,$this->email);
            $req->bindparam(7,$this->password);
            try{
                $req->execute();
                $iduser=$this->bdd->lastInsertId();
                $sql="INSERT INTO account (iduser,datelastupdate) VALUE (?,NOW())";
                $req=$this->bdd->prepare($sql);
                try{
                    $req->bindparam(1,$iduser);
                    $req->execute();
                    echo "success";
                }catch(Exception $ex){
                    echo $ex->getMessage();
                    die();
                }
                
            }catch(Exception $ex){
                echo $ex->getMessage();
                die();
            }  
        }
        function updateuser(){              
            try{            
                $sql="UPDATE users SET fname=?,lname=?,phonenumber=?,email=?,username=? WHERE iduser=?";
                $req=$this->bdd->prepare($sql);
                $req->bindparam(1,$this->fname);
                $req->bindparam(2,$this->lname);
                $req->bindparam(3,$this->phonenumber);
                $req->bindparam(4,$this->email);
                $req->bindparam(5,$this->username);
                $req->bindparam(6,$this->iduser);
                $req->execute();                 
                $this->updateaccount();
            }catch(Exception $ex){
                echo $ex->getMessage();
                die();
            }          
            
        } 
        
        private function updateaccount(){
            try{
                $sql="UPDATE account SET iddomain=?,company=?,about=?,city=?,country=?,adress=? WHERE iduser=?";
                $req=$this->bdd->prepare($sql);
                $req->bindparam(1,$this->iddomain);
                $req->bindparam(2,$this->company);
                $req->bindparam(3,$this->about);
                $req->bindparam(4,$this->city);
                $req->bindparam(5,$this->country);
                $req->bindparam(6,$this->address);
                $req->bindparam(7,$this->iduser);
                $req->execute();      
            }catch(Exception $ex){
                echo $ex->getMessage();
                die();
            }
        }
        function registerUser(){
            try{
                
            }catch(Exception $ex){
                echo $ex->getMessage();
            }
        }
        //allow to delete a user and if the is no parametres 
        //is going to clean up teh tables users and all
        function deleteUser($id){
            $this->iduser=$id;
            $q="DELETE FROM users WHERE iduser =?";
            
            try{
                $q=$this->bdd->prepare($sql);
                $q->bindparam(1,$this->iduser);
                $q->execute();
            }catch(Exception $ex){
                echo $ex->getMessage();
                die();
            }
            
        }
        
       /**
        *  */
        function getusers($id){
            $sql="SELECT u.iduser,u.fname,u.lname,";
            if($id!=null){
                $this->id=$id;
                $sql.="u.sexe,u.birthday,u.phonenumber,u.email,u.username,a.grade,d.designation,a.company,a.about,a.city,a.country,a.adress,m.link as avatar FROM users u LEFT JOIN account a ON u.iduser=a.iduser LEFT JOIN usersdomaine d ON a.iddomain=d.iddomain LEFT jOIN media m ON u.idavatar=m.idmedia WHERE u.iduser=?";
                $req=$this->bdd->prepare($sql);
                $req->bindparam(1,$this->id);
                $req->execute();
                return $req->fetchAll();
            }
            else{
                $sql=" SELECT u.iduser,u.fname,u.lname,u.patientid as src,a.city,a.country,a.grade,a.company,m.link as avatar,u.dateregister,l.designation as level FROM users u LEFT JOIN account a ON u.iduser=a.iduser LEFT jOIN media m ON u.idavatar=m.idmedia LEFT JOIN userlevel l ON u.iduserlevel=l.iduserlevel ORDER BY u.iduser DESC";
                $req=$this->bdd->query($sql);
                return $req->fetchAll();
            }
        }
        
        // allow to set the credention of a use
        // to define if its a admin, manager or a user
        function setCredential(){}
    }
?>



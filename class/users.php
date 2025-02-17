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
                return $this->exception($ex);
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
                    return true;
                }catch(Exception $ex){
                    echo $ex->getMessage();
                    die();
                }
                
            }catch(Exception $ex){
                return $this->exception($ex);
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
                return $this->exception($ex);
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
                return true;    
            }catch(Exception $ex){
                return $this->exception($ex);
            }
        }
        function registerUser(){
            try{
                
            }catch(Exception $ex){
                return $this->exception($ex);
            }
        }
        //allow to delete a user and if the is no parametres 
        //is going to clean up teh tables users and all
        function deleteUser($id){
            $this->iduser=$id;
            $sql="DELETE FROM users WHERE iduser = ? ";            
            try{
                $q=$this->bdd->prepare($sql);
                $q->bindparam(1,$this->iduser);
                $q->execute();
                return true;
            }catch(Exception $ex){
                return $this->exception($ex);
            }
            
        }
        
        function getNotification($iddoc){
            $sql="SELECT c.idcase,CONCAT(u.fname,\" \",u.lname) as pacient,c.statecase,c.dateassign,c.datelastupdate ";
            $this->iduser=$iddoc;
            if($iddoc==null){
                $sql.=",(SELECT CONCAT( d.fname,\" \",d.lname) as drname FROM users d JOIN cases cd ON d.iduser=cd.iddoctor WHERE cd.iddoctor=c.iddoctor AND cd.idpacient=c.idpacient LIMIT 1) as specialist FROM users u JOIN cases c ON u.iduser=c.idpacient ORDER BY c.idcase DESC";
                $q=$this->bdd->query($sql);
                return $q->fetchAll();
            }else{
                $sql.=" FROM users u JOIN cases c ON u.iduser =c.iddoctor WHERE c.iddoctor=? ORDER BY c.idcase DESC";
                $q=$this->bdd->prepare($sql);
                $q->bindparam(1,$this->iduser);
                $q->execute();
                return $q->fetchAll();                
            }
        }
       /**
        *  */
        function getusers($id){
            $sql="SELECT u.iduser,u.fname,u.lname,";
            if($id!=null){
                $this->id=$id;
                $sql.="u.sexe,u.birthday,u.phonenumber,u.email,u.username,a.grade,d.designation,a.company,a.about,a.city,a.country,a.adress,m.link as avatar,l.designation as level FROM users u LEFT JOIN account a ON u.iduser=a.iduser LEFT JOIN usersdomaine d ON a.iddomain=d.iddomain LEFT jOIN media m ON u.idavatar=m.idmedia JOIN userlevel l ON u.iduserlevel=l.iduserlevel WHERE u.iduser=?";
                $req=$this->bdd->prepare($sql);
                $req->bindparam(1,$this->id);
                $req->execute();
                return $req->fetchAll();
            }
            else{
                $sql= " SELECT u.sexe,u.iduser,u.fname,u.lname,u.patientid as src,a.city,a.country,a.grade,a.company,m.link as avatar,u.dateregister,l.designation as level FROM users u LEFT JOIN account a ON u.iduser=a.iduser LEFT jOIN media m ON u.idavatar=m.idmedia LEFT JOIN userlevel l ON u.iduserlevel=l.iduserlevel ORDER BY u.iduser DESC";
                $req=$this->bdd->query($sql);
                return $req->fetchAll();
            }
        }
        function stateCase($id,$type){
            $state=$this->_case($type);
            $sql="UPDATE cases SET statecase=?,datelastupdate=NOW() WHERE idcase=?";
            $req=$this->bdd->prepare($sql);
            try{
                $req->bindparam(1,$state);
                $req->bindparam(2,$id);
                $req->execute();
                return true;
            }catch(Exception $ex){
                return $this->exception($ex);
            }            
        }
        private function _case($case){
            if($case=="WorkingOn"){
                return 1;
            }
            elseif($case=="Resolved"){
                return 2;
            }
            elseif($case=="Reject"){
                return -1;
            }
        }
        function storemessage($namesender,$emailsender,$objtmsg,$contentmsg){
            $sql="INSERT INTO message(namesender,emailsender,objtmsg,contentmsg,statemsg,dateregister) VALUES (?,?,?,?,0,NOW())";
            try{
                $q=$this->bdd->prepare($sql);
                $q->bindparam(1,$namesender);
                $q->bindparam(2,$emailsender);
                $q->bindparam(3,$objtmsg);
                $q->bindparam(4,$contentmsg);
                $q->execute();
                return true;
            }catch(Exception $ex){
                return $this->exception($ex);
            }
        }
        function getMessages(){
            $sql="SELECT * FROM message";
            try{
                $q=$this->bdd->query($sql);
                $q->execute();
                return $q->fetchAll();
            }catch(Exception $ex){
                return $this->exception($ex);
            }
        }
        function deleteMessage($id){
            $sql="DELETE FROM message WHERE idmessage=?";
            try{
                $q=$this->bdd->prepare($sql);
                $q->bindparam(1,$id);
                $q->execute();
                return true;
            }catch(Exception $ex){
                return $this->exception($ex);
            }
        }

        function updatelevel($level,$id){
            $sql="UPDATE users SET iduserlevel=? WHERE iduser=?";
            $req=$this->bdd->prepare($sql);
            $req->bindparam(1,$level);
            $req->bindparam(2,$id);
            try{
            $req->execute();
            return true;
            }catch(Exception $ex){
                return $this->exception($ex);
            }

        }
        // allow to set the credention of a use
        // to define if its a admin, manager or a user
        function setCredential(){}
        function exception($ex){
           return array("ErrorExeption"=>$ex->getMessage());
        }
    }
?>
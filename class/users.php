<?php
    class users{
        private $bdd;
        private $iduser;
        private $Fnameuser;
        private $Lnameuser;
        private $sexeuser;
        private $birthdayuser;
        private $addresCountryuser;
        private $addressLocaluser;
        private $nationalId;
        private $gradeuser;
        private $speciliationuser;
        private $levelStudiesuser;
        private $username;
        private $email;
        private $passworduser;

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
        function init($id,$Fname,$Lname,$sexe,$birthday,$addresCountry,$addressLocal,$nationalId,$grade,$speciliation,$levelStudies,$username,$email,$password){
        $this->id=$id;
        $this->Fname=$Fname;
        $this->Lname=$Lname;
        $this->sexe=$sexe;
        $this->birthday=$birthday;
        $this->addresCountry=$addresCountry;
        $this->addressLocal=$addressLocal;
        $this->nationalId=$nationalId;
        $this->grade=$grade;
        $this->speciliation=$speciliation;
        $this->levelStudies=$levelStudies;
        $this->username=$username;
        $this->email=$email;
        $this->password=$password;
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
        function adduser(){
            $sql="INSERT INTO users () VALUES ()";
            $req=$this->bdd->prepare($sql);
        }
        function updateuser($id){
            
            $sql="UPDATE users SET WHERE iduser=?";
            $req=$this->bdd->prepare($sql);
        }        
        function registerUser(){}
        //allow to delete a user and if the is no parametres 
        //is going to clean up teh tables users and all
        function deleteUser($id=0){
            $q="DELETE FROM users";
            if($id!=0){
                $this->id_u=$id;
                $q.=" WHERE iduser=?";
            }
        }
        function totalPages(){
            $sql="SELECT id FROM users ";
            $req=$this->bdd->prepare($sql);
            $req->execute();
            $result=$req->fetchAll();
            return array(
                "totalPage"=>count($result)
            );
        }
        /*allow to select information about a user when a paramatre is defened 
        //dotherwise it will display all the users 
        //{{$islimit}} allow to define if there is a limit when display many users
        //{{$npage}} allow to determine the position of the page where we want to get data,
        id workin when {{$islimit}} is set to true, so you have to pass the position of the page.
        */
        function getusers($id=0,$islimit=true,$npage=0){
            $sql="SELECT * FROM users";
            if($id!=0 && $id>0){
                $this->iduser=$id;
                $sql.=" WHERE iduser=?";
            }
            //allow to define the limite of record to display if there is not parameter
            if($islimit==true){
                $sql.=" LIMIT 50";
            }

            if($npage!=0 && $npage>0){
                $sql.=" OFFSET $this->totalPages()";
            }
            $req=$this->bdd->prepare($sql);

        }
        // allow to set the credention of a use
        // to define if its a admin, manager or a user
        function setCredential(){}
    }
?>



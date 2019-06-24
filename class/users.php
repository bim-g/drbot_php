<?php
    class users{
        private $db;
        private $id_u;
        private $Fname_u;
        private $Lname_u;
        private $sexe_u;
        private $birthday_u;
        private $addresCountry_u;
        private $addressLocal_u;
        private $nationalId;
        private $grade_u;
        private $speciliation_u;
        private $levelStudies_u;
        private $username;
        private $email;
        private $password_u;

        function __construct($db)
        {
            $this->db=$db;
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
        function connexion(){
            $sql="SELECT * FROM users WHERE (username='?' OR email='?') AND password='?'";
            $req=$this->bdd->prepare($sql);
            $req->bindParams($this->username);
            $req->bindParams($this->username);
            $req->bindParams($this->password);
            try{
                $req->execute();
                echo json_encode($req->fetchAll());
            }catch(Exception $ex){
                echo json_encode(array("errorConnexion"=>$ex->getMessage()));
            }
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
        function selectUser($id=0,$islimit=true,$npage=0){
            $sql="SELECT * FROM users";
            if($id!=0 && $id>0){
                $this->id_u=$id;
                $sql.=" WHERE iduser=?";
            }
            //allow to define the limite of record to display if there is not parameter
            if($islimit==true){
                $sql.=" LIMIT 30";
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



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
        private $username_u;
        private $password_u;

        function __construct($db)
        {
            $this->db=$db;
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
        /*allow to select information about a user when a paramatre is defened 
        //dotherwise it will display all the users 
        //{{$islimit}} allow to define if there is a limit when display many users
        //{{$npages}} allow to define the position of the page where we want to get data,
        id workin when {{$islimit}} is set to true, so you have to pass the position of the page.
        */
        function selectUser($id=0,$islimit=true,$npages){
            $q="SELECT * FROM users";
            if($id!=0){
                $this->id_u=$id;
                $q.=" WHERE iduser=?";
            }
            //allow to define the limite of record to display if there is not parameter
            if($islimit==true){
                $q.=" LIMIT 30";
            }
        }
        // allow to set the credention of a use
        // to define if its a admin, manager or a user
        function setCredential(){}
    }
?>



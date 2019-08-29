<?php

    class Control{
        private $bdd;
        function __construct($bdd)
        {
            $this->bdd=$bdd;
        }

        function getDomain($id){
            if($id==-1){
                $sql="SELECT * FROM usersdomaine";
                $req=$this->bdd->query($sql);
                return $req->fetchAll();
            }
        }

        function addDomaine(){
            $sql="";
        }
    }
?>
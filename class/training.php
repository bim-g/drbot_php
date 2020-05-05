<?php

    class Training{
        private $bdd;
        private $idtopic ;
        private $iduser ;
        private $idsolution ;
        private $intent ;
        private $stateTopic ;
        private $questions ;
        private $summary;
        private $titletopic ;
        private $description ;
        function __construct($bdd)
        {
            $this->bdd=$bdd;
        }
        function init($idtopic,$iduser,$idsolution,$titletopic,$intent,$questions,$summary,$description){
            $this->idtopic=$idtopic ;
            $this->iduser=$iduser ;
            $this->idsolution=$idsolution ;
            $this->intent=$intent ;
            $this->questions=$questions ;
            $this->summary=$summary;
            $this->titletopic=$titletopic ;
            $this->description=$description ;
        }
        function addTopic(){
            $sql="INSERT INTO topic (titletopic,intent,iduser,statetopic,summary,questions,dateregister) VALUES (?,?,?,0,?,?,NOW())";
            try{                
                $req=$this->bdd->prepare($sql);
                $req->bindparam(1,$this->titletopic);
                $req->bindparam(2,$this->intent);
                $req->bindparam(3,$this->iduser);
                $req->bindparam(4,$this->summary);
                $req->bindparam(5,$this->questions);
                $req->execute();
                return true;
            }catch(Exception $ex){
                return $this->exception($ex);
            }
        }
        function updatestateTopic($state){
            $sql= "UPDATE topic SET statetopic=? WHERE idtopic=?";
            $this->stateTopic=(int)$state;
            try{
                $req=$this->bdd->prepare($sql);
                $req->bindparam(1,$this->stateTopic);
                $req->bindparam(2,$this->idtopic);
                $req->execute();
                return true;
            }catch(Exception $ex){
                return $this->exception($ex);
            }
        }
        function updateTopic(){
            $sql="UPDATE topic SET titletopic=?,intent=?,iduser=?,summary=?,questions=?,dateregister=NOW() WHERE idtopic=?"; 
            try{                
                $req=$this->bdd->prepare($sql);
                $req->bindparam(1,$this->titletopic);
                $req->bindparam(2,$this->intent);
                $req->bindparam(3,$this->iduser);
                $req->bindparam(4,$this->summary);
                $req->bindparam(5,$this->questions);
                $req->bindparam(6,$this->idtopic);
                $req->execute();
                return true;
            }catch(Exception $ex){
                return $this->exception($ex);
            }
        }
        function detailSolution($id){
            $this->idtopic=$id;
            $sql="SELECT s.idsolution,s.step,t.titletopic,s.description FROM `solution` s JOIN topic t ON s.idtopic=t.idtopic WHERE s.idsolution=?";
            $req=$this->bdd->prepare($sql);
            $req->bindparam(1,$this->idtopic);               
            try{
                $req->execute();
                return $req->fetchAll();
            }catch(Exception $ex){
                return $this->exception($ex);
            }
        }
        function getTopics($id=null){
            $req=null;;
            if($id!=null && is_integer($id)){
                $this->idtopic=$id;
                
                $sql= "SELECT t.idtopic,t.titletopic,t.intent,t.statetopic,t.summary,t.questions,t.dateregister,m.link as linkmedia FROM topic t LEFT JOIN media m ON t.imagerefernce=m.idmedia WHERE idtopic=?";
                // $sql="SELECT * FROM topic";
                $req=$this->bdd->prepare($sql);
                $req->bindparam(1,$this->idtopic);               
                try{
                    $req->execute();
                    return $req->fetchAll();
                }catch(Exception $ex){
                    return $this->exception($ex);
                }
            
            }else{
                $sql="SELECT t.idtopic,t.titletopic,t.intent,u.fname as username,t.statetopic,t.summary,t.questions,t.dateregister FROM topic t JOIN users u ON t.iduser=u.iduser ORDER BY t.idtopic DESC";
                try{
                    $req=$this->bdd->query($sql);
                    return $req->fetchAll();
                }catch(Exception $ex){
                    return $this->exception($ex);
                }                
            }
            return false;
        }

        function getSolutions($id){
            $req=null;
            if($id!=null && is_integer($id)){
                $this->idtopic=$id;
                $sql= "SELECT * FROM solution s JOIN topic t ON s.idtopic=t.idtopic WHERE s.idtopic=?";
                $req=$this->bdd->prepare($sql);
                $req->bindparam(1,$this->idtopic);
                try{
                    $req->execute();
                    return $req->fetchAll();
                }catch(Exception $ex){
                    return $this->exception($ex);
                }
            }else{
                $sql="SELECT s.idtopic,t.titletopic,s.idsolution,s.description,s.step,s.datelastupdate FROM solution s JOIN topic t ON s.idtopic=t.idtopic";
                try{
                    $req=$this->bdd->query($sql);                   
                    return $req->fetchAll();
                }catch(Exception $ex){
                    return $this->exception($ex);
                }
            }
            return false;
        }

        function removetopic(){
            $sql="DELETE FROM topic WHERE idtopic=?";
            $req=$this->bdd->prepare($sql);
            $req->bindparam(1,$this->idtopic);
            try{
                $req->execute();
                return true;
            }catch(Exception $ex){
                return $this->exception($ex);
            }
        }
        function addSolution($step){
            $sql="INSERT INTO solution (idtopic,description,step,datelastupdate) VALUES (?,?,?,NOW())";
            $req=$this->bdd->prepare($sql);
            $req->bindparam(1,$this->idtopic);
            $req->bindparam(2,$this->description);
            $req->bindparam(3,$step);
            try{
                $req->execute();
                return true;
            }catch(Exception $ex){
                return $this->exception($ex);
            }
        }
        function updateSolution($step){
            $sql="UPDATE solution SET description=?,step=?,datelastupdate=NOW() WHERE idsolution=?";
            $req=$this->bdd->prepare($sql);
            $req->bindparam(1,$this->description);
            $req->bindparam(2,$step);
            $req->bindparam(3,$this->idsolution);
            try{
                $req->execute();
                return true;
            }catch(Exception $ex){
                return $this->exception($ex);
            }
        }
        function randomtopic(){
            $sql="SELECT t.titletopic,t.summary,m.link  FROM topic t JOIN media m ON t.imagerefernce=m.idmedia ORDER BY RAND() LIMIT 2";
            $req=$this->bdd->query($sql);
            return $req->fetchAll();
        }
        function exception($ex){
            return array("ErrorExeption"=>$ex->getMessage());
         }
    }
?>
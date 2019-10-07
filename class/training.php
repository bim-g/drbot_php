<?php

    class Training{
        private $bdd;
        private $idtopic ;
        private $iduser ;
        private $idsolution ;
        private $intent ;
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
            $sql="INSERT INTO topic (titletopic,intent,iduser,statetopic,summary,questions,dateregister) VALUES (?,?,?,1,?,?,NOW())";
            try{                
                $req=$this->bdd->prepare($sql);
                $req->bindparam(1,$this->titletopic);
                $req->bindparam(2,$this->intent);
                $req->bindparam(3,$this->iduser);
                $req->bindparam(4,$this->summary);
                $req->bindparam(5,$this->questions);
                $req->execute();
            }catch(Exception $ex){
                echo $ex->getMessage();
                die();
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
            }catch(Exception $ex){
                echo $ex->getMessage();
                die();
            }
        }
        function getTopics($id){
            if($id!=null && is_integer($id)){
                $this->idtopic=$id;
                $sql="SELECT * FROM topic WHERE idtopic=?";
                $req=$this->bdd->prepare($sql);
                $req->bindparam(1,$this->idtopic);
                $req->execute();
                return $req->fetchAll();
            // }elseif(is_string($id)){                
            //     $sql="SELECT * FROM topic WHERE titletopic LIKE ?";
            //     $req=$this->bdd->prepare($sql);
            //     $req->bindparam(1,$id);
            //     $req->execute();
            //     return $req->fetchAll();
            }else{
                $sql="SELECT t.idtopic,t.titletopic,t.intent,u.fname as username,t.statetopic,t.summary,t.questions,t.dateregister FROM topic t JOIN users u ON t.iduser=u.iduser ORDER BY t.idtopic DESC";
                $req=$this->bdd->query($sql);
                return $req->fetchAll();
            }
        }

        function getSolutions($id){
            if($id!=null && is_integer($id)){
                $this->idtopic=$id;
                $sql="SELECT t.titletopic,s.idsolution,s.description,s.step,s.datelastupdate FROM solution s JOIN topic t ON s.idtopic=t.idtopic WHERE s.idtopic=?";
                $req=$this->bdd->prepare($sql);
                $req->bindparam(1,$this->idtopic);
                $req->execute();
                return $req->fetchAll();
            // }elseif(is_string(id)){
            //     $sql="SELECT t.titletopic,s.idsolution,s.description,s.step,s.datelastupdate FROM solution s JOIN topic t ON s.idtopic=t.idtopic WHERE s.idtopic=?";
            //     $req=$this->bdd->prepare($sql);
            //     $req->bindparam(1,$this->idtopic);
            //     $req->execute();
            }else{
                $sql="SELECT t.titletopic,s.idsolution,s.description,s.step,s.datelastupdate FROM solution s JOIN topic t ON s.idtopic=t.idtopic";
                $req=$this->bdd->query($sql);
                return $req->fetchAll();
            }
        }

        function removetopic(){
            $sql="DELETE FROM topic WHERE idtopic=?";
            $req=$this->bdd->prepare($sql);
            $req->bindparam(1,$this->idtopic);
            try{
                $req->execute();
            }catch(Exception $ex){
                echo $ex->getMessage();
                die();
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
            }catch(Exception $ex){
                echo $ex->getMessage();
                die();
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
            }catch(Exception $ex){
                echo $ex->getMessage();
                die();
            }
        }
        function randomtopic(){
            $sql="SELECT t.titletopic,t.summary,m.link  FROM topic t JOIN media m ON t.imagerefernce=m.idmedia ORDER BY RAND() LIMIT 2";
            $req=$this->bdd->query($sql);
            return $req->fetchAll();
        }
    }
?>
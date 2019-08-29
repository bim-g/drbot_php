<?php
   include 'config.php';
   //$connexion;
   try{
       $connexion = new PDO("mysql:host=".HOST.";dbname=".DATABASE,USER,PASSWORD);
       $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }catch(Exception $ex){
       echo "Error connection=>".$ex->getMessage();
   }
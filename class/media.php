<?php
    class media{
        private $db;
        private $idUser;
       
        function __construct($bd)
        {
            $this->db=$bd;
        }

        /* 
            will allow to upload all images [picturef profile or scan document] 
            depend othe case and the source.
        */
        function uploadImag($img){}
        /**
         * allow to get the link of a document to be display
         * according to need of the user and related to r-the request of the user.
         */
        function getLink(){}

    }
?>
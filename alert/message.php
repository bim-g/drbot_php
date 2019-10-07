<?php

    function errors($val){
        $message=array();
        switch($val){

            case 1: $message=array('type'=>'Error Input','errorText'=>'there is a field fitch is empty');
            break;
            case 2: $message=array('type'=>'No Information','errorText'=>'your infos is not correct, try again');
            break;
            case 3: $message=array('type'=>'error input','errorText'=>'there is a field fitch is empty');
            break;
            case 4: $message=array('type'=>'error input','errorText'=>'there is a field fitch is empty');
            break;
            case 5: $message=array('type'=>'error input','errorText'=>'there is a field fitch is empty');
            break;
            case 6: $message=array('type'=>'error input','errorText'=>'there is a field fitch is empty');
            break;
            case 10: $message=array('type'=>'error param','errorText'=>'information is not correct');
            break;
            case 11: $message=array('type'=>'error data','errorText'=>'error on datatype');
            break;
        }        
        return $message;
    }

    function success($val){
        $message=null;
        switch($val){

            case 1: $message==array('type'=>'success operation','text'=>'There is no data available');;
            break; 
            case 2: $message==array('type'=>'error input','text'=>'there is a field fitch is empty');;
            break; 
        }
        return $message;        
    }
?>
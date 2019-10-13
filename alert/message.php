<?php

    function errors($type,$value=false){
        $message=array();
        $err_msg=null;
        if($value){
            $err_msg=$value;
        }
        switch($type){
            case 1: $message=array('type'=>'Error Input','errorText'=>'there is a field fitch is empty');
            break;
            case 2: $message=array('type'=>'No Information','errorText'=>'your infos is not correct, try again');
            break;
            case 3: $message=array('type'=>'error input','errorText'=>'error while try to save');
            break;
            case 4: $message=array('type'=>'error input','errorText'=>'error while try to update');
            break;
            case 5: $message=array('type'=>'error input','errorText'=>$err_msg);
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
            case 1: $message==array('type'=>'success operation','text'=>'register with success');;
            break; 
            case 2: $message==array('type'=>'error input','text'=>'update with success');;
            break; 
        }
        return $message;        
    }
?>
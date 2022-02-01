<?php
    require '../broker.php';
    
    $broker=Broker::getBroker();
    $id=$_POST['id'];
    if(!isset($id) || !intval($id)){
       header('Location: ../../update.php&id='.$id.'&greska=Los ID');
    }else{
        $broker->udc('delete from kafa where id='.$id);
        header('Location: ../../index.php');
    }
    
    


?>
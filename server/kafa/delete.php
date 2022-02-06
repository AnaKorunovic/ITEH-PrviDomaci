<?php
    require '../broker.php';
    
    $broker=Broker::getBroker();
    $id=$_POST['id'];
    if(!isset($id) || !intval($id)){
       header('Location: ../../index.php&id='.$id.'&greska=Los ID');
    }else{
        $broker->izvrsiUpit('delete from kafa where id='.$id);
        header('Location: ../../index.php');
    }
    
    


?>
<?php
    require '../broker.php';
    $broker=Broker::getBroker();
    $id=$_POST['id'];


    if(!isset($id) || !intval($id)){
        echo json_encode([
            'status'=>false,
            'error'=>'pogresan ID'
        ]);
    }else{
        echo json_encode($broker->izvrsiUpit('delete from marka where id='.$id));
    }
    
    


?>
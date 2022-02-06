<?php
    require '../broker.php';
    $broker=Broker::getBroker();

    $id=$_POST['id'];
    $naziv=$_POST['naziv'];
    $tezina=$_POST['tezina'];
    $ukus=$_POST['ukus'];
    $marka_id=$_POST['marka_id'];
    $opis=$_POST['opis'];
   
    
    $upit="Update kafa set naziv='".$naziv."', tezina=".$tezina.", marka_id=".$marka_id.", opis='".$opis."',
    ukus='".$ukus."' where id=".$id;
    
    if(!isset($id)){
        header('Location: ../../index.php&id='.$id.'&greska=Nije prosledjen id');
        exit;
    }
   
    $broker->izvrsiUpit( $upit);
    header('Location: ../../index.php');


?>
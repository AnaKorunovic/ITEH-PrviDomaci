<?php

require '../broker.php';
$broker=Broker::getBroker();

$id=$_POST['id'];
$upit="update marka set naziv='".$_POST['naziv']."', where id=".$_POST['id'];

if(!isset($id)){
    header('Location: ../../update.php&id='.$id.'&greska=Nije prosledjen id');
    exit;
}

$broker->izvrsiUpit( $upit);
header('Location: ../../index.php');





?>
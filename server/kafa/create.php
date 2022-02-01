<?php
require '../broker.php';

$broker=Broker::getBroker();



$naziv=$_POST['naziv'];
$tezina=$_POST['tezina'];
$ukus=$_POST['ukus'];
$marka_id=$_POST['marka_id'];
$slika=$_FILES['slika'];
$opis=$_POST['opis'];
$nazivSlike=$slika['name'];
$lokacija = "../../slike/".$nazivSlike;


if(!move_uploaded_file($_FILES['slika']['tmp_name'],$lokacija)){
    $lokacija="";
    header("Location: ../../dodajKafu.php?greska=Prebacivanje slike nije uspelo!");
    exit;
}else{
    
    $lokacija=substr($lokacija,4);
   
}

$rezultat=$broker->izvrsiUpit("insert into kafa(naziv, tezina, ukus, marka_id, opis, lokacija ) values ('".$naziv."',".$tezina.",'".$ukus."', ".$marka_id.",'".$opis."','".$lokacija."') ");
if($rezultat['status']){
    header("Location: ../../dodajKafu.php");
}else{
    header("Location: ../../dodajKafu.php?greska=".$rezultat['error']);
}





?>
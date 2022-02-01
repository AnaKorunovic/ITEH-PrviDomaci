
<?php
    require '../broker.php';
    $broker=Broker::getBroker();
   
    $naziv=$_POST['naziv'];
    
    if(!preg_match('/^[a-zA-Z]*$/',$naziv)){
        header("Location: ../../marke.php?greska=Neispravan naziv");
    }else{
        $rezultat=$broker->izvrsiUpit("insert into marka(naziv) values ('".$naziv."') ");
        if($rezultat['status']){
            header("Location: ../../marke.php");
        }else{
            header("Location: ../../marke.php?greska=".$rezultat['error']);
        }
    }
       


?>
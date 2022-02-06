<?php

require './server/broker.php';
$broker=Broker::getBroker();

$rows=$broker->vratiNazivKafe();



  $i=1;
      if(!empty($rows)){
          foreach($rows as $row){
             
        $a[]=$row['naziv']; 
        }
        }



// deo naziva se uzima iz URL-a
$q = $_REQUEST["q"];

$hint = "";

// trazi se hint iz niza
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $kafa) {
        if (stristr($q, substr($kafa, 0, $len))) {
            if ($hint === "") {
                $hint = $kafa;
            } else {
                $hint .= ", $kafa";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "Nema predloga" : $hint;
?>
<?php
    require '../broker.php';
    $broker=Broker::getBroker();
  
    
    echo json_encode($broker->vratiKolekciju(
        "select k.*, m.naziv as 'naziv_marke' from kafa k inner join marka m on(k.marka_id=m.id)"));

?>
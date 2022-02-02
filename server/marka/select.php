<?php

include '../broker.php';
$broker=Broker::getBroker();


echo json_encode($broker->izvrsiUpit("select * from marka where id=".$_GET['id']));



?> 
<?php

class Broker{
    private $mysqli;
    private static $broker;
  

       
    private function __construct(){
        $this->mysqli = new mysqli("localhost","ana","ana","Kafeterija");
        $this->mysqli->set_charset("utf8");
    }

    public static function getBroker(){
        if(!isset($broker)){
            $broker=new Broker();
        }
        return $broker;
    }



    public function vratiKolekciju($upit){
        $rezultat=$this->mysqli->query($upit);    
        $response=[];   
        if(!$rezultat){
            $response['status']=false;
            $response['error']=$this->mysqli->error;
        }
        else{
            $response['status']=true;
            while($red=$rezultat->fetch_object()){  
                $response['kolekcija'][]=$red;
            }
        }
        return $response;
    }



    public function izvrsiUpit($upit){    
        $rezultat=$this->mysqli->query($upit);
        $response=[];
        $response['status']=(!$rezultat)?false:true;
        if(!$rezultat){//false
            $response['error']=$this->mysqli->error;
        }
        return $response;
    }

    public function vratiNazivKafe(){
        $data=null;
        $upit="select naziv from kafa";
        $rezultat=$this->mysqli->query($upit);   
        if($rezultat){
        while($row=mysqli_fetch_assoc($rezultat)){
        $data[]=$row;
        } 
        }
        return  $data;
        }



}

?>
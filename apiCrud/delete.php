<?php
require_once('config.php');
error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
 include("db.php");

 if($data->id){
     $query = "DELETE FROM products WHERE id=".$data->id;
     $run = mysqli_query($db,$query);
    if($run){
        echo json_encode(["status"=> "success","msg"=>"product id Deleted"]);
    
    }else{
        echo json_encode(["status"=>"product is not Deleted"]);
    }
    
     

 }else{
    echo json_encode(["status"=>"failed","msg"=>"User id is not given"]);
 }

 


?>
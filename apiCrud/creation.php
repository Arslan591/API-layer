<?php
require_once('config.php');

error_reporting(0);
$data = json_decode(file_get_contents("php://input"));

 include("db.php");
 if($data->product_name==""){
    echo json_encode(["status"=>"failed","product_name"=>"is empty"]);
 }elseif($data->product_price==""){
    echo json_encode(["status"=>"failed","product_name"=>"is empty"]);
 }
 elseif($data->stock == ""){
    echo json_encode(["status"=>"failed","product_name"=>"is empty"]);
 }elseif($data->discount ==""){
    echo json_encode(["status"=>"failed","product_name"=>"is empty"]);
 }else{

    $query = "INSERT INTO products(product_name,product_price,stock,discount)Values('$data->product_name','$data->product_price','$data->stock','$data->discount')";
$run = mysqli_query($db,$query);

if($run){
    echo json_encode(["status"=> "success","msg"=>"product Added"]);

}else{
    echo json_encode(["status"=>"failed"]);
}

 }


?>
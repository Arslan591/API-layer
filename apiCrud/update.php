<?php
require_once('config.php'); 

error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
 include("db.php");

 if($data->id){
    $query2 = "SELECT * FROM products WHERE id =".$data->id ;
    $run2 = mysqli_query($db,$query2);
    $product = mysqli_fetch_assoc($run2);

    $product_name = $product['product_name'];
    $product_price = $product['product_price'];
    $stock = $product['stock'];
    $discount = $product['discount'];

    if($data->product_name!=""){
        $product_name = $data->product_name;
     }
     if($data->product_price!=""){
        $product_price = $data->product_price;
        
     }
     
     if($data->stock != ""){
        $stock = $data->stock;
     }
     if($data->discount !=""){
        $discount = $data->discount;
     }

   //   echo $product_name."<br>";
   //   echo $product_price."<br>";
   //   echo $stock."<br>";
   //   echo $discount."<br>";


    
        // $query = "INSERT INTO products(product_name,product_price,stock,discount)Values('$data->product_name','$data->product_price','$data->stock','$data->discount')";
    
        $query = "UPDATE products SET ";
        $query.= "product_name='$product_name',";
        $query.= "product_price='$product_price',";
        $query.= "stock='$stcok',";
        $query.= "discount='$discount' WHERE id=".$data->id;
        $run = mysqli_query($db,$query);
    
    if($run){
        echo json_encode(["status"=> "success","msg"=>"product updated"]);
    
    }else{
        echo json_encode(["status"=>"is not updated"]);
    }
    
     

 }else{
    echo json_encode(["status"=>"failed","msg"=>"User id is not given"]);
 }

 


?>
<?php
require_once('config.php');
include("db.php");

error_reporting(0);
$data = json_decode(file_get_contents("php://input"));


// For Update any data user gives "id" of specific data.

if($data->id){
   $query2 = "SELECT * FROM products WHERE id =".$data->id ;
   $run2 = mysqli_query($db,$query2);
   $product = mysqli_fetch_assoc($run2);

   // print_r($product);die();
   // Check the given "id" is available or not
   if($product =="" ){ 

      echo"given id is not available";
    }else{

   $product_name = $product['product_name'];
   $product_price = $product['product_price'];
   $stock = $product['stock'];
   $discount = $product['discount'];

  
   // These are validation for checking user enter updated value or assing 
   // to it previous values.

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


    $query = "UPDATE products SET product_name='$product_name',product_price='$product_price',stock='$stock',discount='$discount'WHERE id= ".$data->id;

  
  
       $run = mysqli_query($db,$query);
   
   if($run){
       echo json_encode(["status"=> "success","msg"=>"product updated"]);
   
   }else{
       echo json_encode(["status"=>"is not updated"]);
   }}
   
    

}else{

// These are validation for creating a new product which check there is 
// value which are not provided through error.

if($data->product_name==""&& $data->product_price==""&& $data->stock =="" && $data->discount==""){
   echo json_encode(["status"=>"failed some field is missing",]);
}else{

   $query = "INSERT INTO products(product_name,product_price,stock,discount)Values('$data->product_name','$data->product_price','$data->stock','$data->discount')";
$run = mysqli_query($db,$query);

if($run){
   echo json_encode(["status"=> "success","msg"=>"product Added"]);

}else{
   echo json_encode(["status"=>"failed"]);
}

} 
}
?>

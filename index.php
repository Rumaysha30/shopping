

<?php


//start session
session_start();




require_once('createDB.php');
require_once('./component.php');

//create instance of Createdb class
$database = new createDb(dbname: "Productdb", tablename: "Producttb");



if(isset($_POST['add'])){
/// print_r($_POST['product_id']);

if(isset($_SESSION['cart'])){

    $item_array_id =array_column($_SESSION['cart'], "product_id");
    


    if(in_array($_POST['product_id'], $item_array_id)){
        echo "<script>alert('Product is already added in the cart..!')</script>";
        echo "<script>window.location = 'index.php'</script>";
    }else{
       $count=count($_SESSION['cart']);
       $item_array=array(
        'product_id'=>$_POST['product_id']
       );

       $_SESSION['cart'][$count]=$item_array;
       
    }
}else{
    $item_array=array(
        'product_id'=>$_POST['product_id']
    );

    //create new session variable
    $_SESSION['cart'][0]= $item_array;
    print_r($_SESSION['cart']);
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Now</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css"/>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   
</head>
<body>
    <?php
require_once("header.php");
    ?>

<div class="container">
    <div class="row text-center py-5">
       <?php
     $result= $database->getData();
     while($row= mysqli_fetch_assoc($result)){
        component($row['product_name'],$row['product_price'],$row['product_image'],$row['id']);
     }

       ?>

    </div>
</div>












<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
<?php

class Product
{



    public static function product_html($obj)
    {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <!-- <link href="inc/css/productpage.css" rel="stylesheet"> -->
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
     integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
     crossorigin="anonymous">
     
     <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Product Page</title>
<style>
    
.checked {
  color: orange;
}
.container
{
    margin-top: 80px;
}
.product
{
    background: green;
    width: 50px;
    color: white;
    font-size: 12px ;
    font-weight: bold ;
}
.col-md-7
{
    color: #555;
}
.price
{    font-weight: bold ;
    margin-top: 10px;
    color:black ;
    
}
#quantity
{
   color: seagreen;
}
</style>
</head>
<body>
   
<div class="container">

<div class="row">
<div class="col-md-5">
<img src="./res/images/imagenumber2.jpg" class="img-thumbnail" class="rounded float-left" alt="...">
</div>
<div class="col-md-7">
<p class="product text-center">New </p>
<h2 name="name"> Nike Runner 2.0  Men's Shoes </h2><span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<p name="upc">Upc: 123</p>
<p name="merchantid">Merchant code: 34343</p>
<div class="float-right">

    <p name="description">Best performance running shoe features a soft cushioned midsole for comfort, a mesh construction for breathability and a classic lace-up closure for a secure fit.  </p>
</div>

<p name="unitprice" class="price">$2.99kg</p>
<p name="unitavailable"><b>In Stock</b></p>
<div>

    <input  type="text" name="quantity" id="quantity"  class="text-center" placeholder="Quantity">
    <input class="btn btn-primary float-right" type="submit"  value="Add to the cart">
</div>

</div>
</div>
</div>
</body>
</html>
    <?php }
}

?>
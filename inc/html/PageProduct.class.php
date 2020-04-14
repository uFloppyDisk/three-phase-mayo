<?php

class PageProduct
{
    public static $currencyRates = array();
    
    public static function header(){?>
        <!DOCTYPE html>
            <html lang="en">
            <head>
            
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>3PhaseMayo Store</title>
            <!-- Bootstrap core CSS -->
            <link href="inc/html/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

            <!-- Custom styles for this template -->
            <link href="inc/css/shop-homepage.css" rel="stylesheet">
            <style>
    
            .checked {
            color: orange;
            }
            .container
            {
                margin-top: 0px;
                
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
                padding: 40px;
            }
            .col-md-5
            {
                padding: 40px;
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
    <?php }

    public static function product_html($prodId)
    {
        
        $product = new Product();
        $product = ProductMapper::getProductByID($prodId);

        $merchant = new Merchant();
        $merchant = MerchantMapper::getMerchantByID($product->getMerchantId());
        ?>
            <body> 
                 <!-- Navigation -->
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                    <div class="container">
                    <h4><a class="text-white">Three Phase Mayo: Product Details</a></h4>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                        <?php 
                        
                        if(!empty($_SESSION['username'])){?>
                            <li class="nav-item">
                                <a class="nav-link"><?php echo "Hello ".$_SESSION['username'] ?></a>
                            </li>
                            <li class="nav-item">
                                <form method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                    <input type="hidden" id="action" name="action" value="<?php echo ACTION_SIGN_OUT;?>">
                                    <input type="submit" id="signoutbtn" class="btn btn-secondary" value="Sign Out"/>
                                </form>
                            </li>
                            <?php } 
                        else { ?>
                            <li class="nav-item">
                                <form method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                    <input type="hidden" id="action" name="action" value="<?php echo ACTION_SHOW_SIGNIN;?>">
                                    <input type="submit" id="signbtn" class="btn btn-primary" value="Sign in/Register"/>
                                </form>
                            </li>
                        <?php } ?>
                            <li>
                                <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select Currency
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php foreach(self::$currencyRates as $key=>$value){?>
                                    <a class="dropdown-item" href="<?php echo $_SERVER["PHP_SELF"].'?action='.ACTION_SHOW_SELECTED_PRODUCT.'&prodId='.$prodId.'&price='.$key; ?>"><?php echo $key ?></a>
                                    <?php } ?>
                                    <a class="dropdown-item" href="<?php echo $_SERVER["PHP_SELF"].'?action='.ACTION_SHOW_SELECTED_PRODUCT.'&prodId='.$prodId.'&price=CAD'; ?>"> CAD </a>
                                    
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </nav>
                <!-- End of Nav -->
                <div class="container">
                    <div class="row">
                  
                        <div class="col-md-5">
                        <img src="./res/images/<?php echo $prodId;?>/main.jpg" alt="Product #<?php echo $prodId;?>" class="img-thumbnail" class="rounded float-left" >
                        </div>
                        <div class="col-md-7">
                            <p class="product text-center">New </p>
                            <h2 name="name"><?php echo $product->getName(); ?></h2>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>

                            <div class="">
                                <p name="description"><?php echo $product->getDescription(); ?></p>
                            </div>

                            <p name="upc"><?php echo $product->getUPC(); ?> </p>
                            <span>Shipped by: </span><h6><span name="merchantid"><?php echo $merchant->getName(); ?></span></h6>

                            <h4><p name="unitprice clearfix" class="price">
                                <?php 
                                        if(!empty($_GET["price"])){
                                            if($_GET["price"]=="CAD"){                                         
                                                echo 'CAD '.$product->getPrice(); 
                                            }else{
                                                foreach(self::$currencyRates as $key=>$value) {
                                                    if($_GET["price"]==$key){
                                                        echo $key.' '.number_format($product->getPrice()*$value, 2, '.', ',');
                                                    }
                                                } 
                                            }                                           
                                        }else{
                                            echo 'CAD '.$product->getPrice(); 
                                        }                               
                                    ?>
                            </p></h4>
                            <p name="unitavailable"><b>In Stock</b></p>
                            <div>
                                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                    <input  type="text" name="quantity" id="quantity"  class="text-center" placeholder="Quantity" required>
                                    <input type="hidden" id="prodId" name="prodId" value="<?php echo $prodId;?>">
                                    <input type="hidden" id="discount" name="discount" value="<?php echo $product->getDiscount();?>">
                                    
                                    <input class="btn btn-primary float-right" type="submit"  name="action" value="<?php echo ACTION_GOTO_CHECKOUT;?>">
                                    <input class="btn btn-primary float-right" type="submit"  name="action" value="<?php echo ACTION_ADDTO_ORDER;?>">
                                  
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <script src="inc/html/vendor/jquery/jquery.min.js"></script>
                <script src="inc/html/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            </body>
        </html>
    <?php }
}

?>

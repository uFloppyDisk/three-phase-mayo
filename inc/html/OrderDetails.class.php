<?php

class OrderDetails
{

    public static $title = "Please set the Title";
    public static $currencyRates = array();
    public static $errors = [];
 
 
    static function header() { ?>

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
        </head>

        
    <?php }


    //show Main Page with products from database.
    public static function orderdetails_html($OrderedProducts)
    {
        ?>        
     <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
            <h3><a class="text-white">Order Details</a></h3>
            
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
                            <a class="dropdown-item" href="<?php echo $_SERVER["PHP_SELF"].'?action='.ACTION_CHANGE_CURRENCY.'&price='.$key; ?>"><?php echo $key ?></a>
                            <?php } ?>
                            <a class="dropdown-item" href="<?php echo $_SERVER["PHP_SELF"].'?action='.ACTION_CHANGE_CURRENCY.'&price=CAD'; ?>"> CAD </a>
                        </div>
                    </li>
                </ul>
            </div>
            </div>
        </nav>
        <!-- End of Nav -->
        <!-- Page Content -->
        <div class="container">

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <!-- <th>Product Image</th> -->
                        <th>ProductID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $_SESSION['OrderTotal'] = 0; 
                    
                        foreach($OrderedProducts as $key=>$prod){            
                            $product = new Product();
                            $product = ProductMapper::getProductByID($prod['prodId']);
                        ?>
                            <tr>
                                <!-- <td>
                                    <img src="./res/images/<?php //echo $product->getID();?>/main.jpg" alt="Product #<?php //echo $product->getID();?>" class="img-thumbnail" class="rounded float-left" >
                                </td> -->
                                <td><?php echo $product->getID(); ?></td>
                                <td><?php echo $product->getName(); ?></td>
                                <td><?php 
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
                                </td>
                                <td><?php echo $prod['qty']; ?></td>
                                <td><?php 
                                
                                    if(!empty($_GET["price"])){
                                        if($_GET["price"]=="CAD"){                                         
                                            echo 'CAD '.$product->getPrice()*$prod['qty']; 
                                            $_SESSION['OrderTotal'] +=  $product->getPrice()*$prod['qty'];  
                                        }else{
                                            foreach(self::$currencyRates as $key=>$value) {
                                                if($_GET["price"]==$key){
                                                    echo $key.' '.number_format($product->getPrice()*$prod['qty']*$value, 2, '.', ',');
                                                    $_SESSION['OrderTotal'] +=  $product->getPrice()*$prod['qty']*$value; 
                                                }
                                            } 
                                        }                                           
                                    }else{
                                        echo 'CAD '.$product->getPrice()*$prod['qty'];
                                        $_SESSION['OrderTotal'] +=  $product->getPrice()*$prod['qty'];  
                                    } 
                                ?>
  
                            <td><span class="material-icons">
                            <a href="<?php echo $_SERVER['PHP_SELF'].'?action='.ACTION_REMOVE_PRODUCT_FROM_ORDER.'&key='.$key;?>">delete<a>
                            </span></td> 
                            </tr>
                            
                    <?php } ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                    <td></td> 
                    <td></td>
                    <td></td>  
                    <th>TOTAL</th>  
                    <th>$<?php echo number_format($_SESSION['OrderTotal'], 2, '.', ','); ?></th>  
                    <td></td>            
                    </tr>  
                </tfoot>
                </table>
                    <form>
                    <input class="btn btn-danger" type="submit"  name="action" value="<?php echo ACTION_LIST_PRODUCTS;?>">
                    <input class="btn btn-success" type="submit"  name="action" value="<?php echo ACTION_GOTO_CHECKOUT;?>">
                    </form>

                
        </div>
        <!-- /.container -->
            <script src="inc/html/vendor/jquery/jquery.min.js"></script>
            <script src="inc/html/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        </body>
        <?php 
    }



  


}?>
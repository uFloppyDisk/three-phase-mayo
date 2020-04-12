<?php

class Page
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
    public static function html_page($productArray) {?>
        
        <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
            <!-- <a class="navbar-brand" href="#">Country<img src="./res/images/cexchange.png" /></a> -->
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
                <?php } ?>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                
                <li class="nav-item">
                    <form method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <input type="hidden" id="action" name="action" value="<?php echo ACTION_SHOW_SIGNIN;?>">
                        <input type="submit" id="signbtn" class="btn btn-primary" value="Sign in/Register"/>
                    </form>
                </li>
                <li class="nav-item">
                    <form method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <input type="hidden" id="action" name="action" value="<?php echo ACTION_SIGN_OUT;?>">
                        <input type="submit" id="signoutbtn" class="btn btn-secondary" value="Sign Out"/>
                    </form>
                </li>
                </ul>
            </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">

            <div class="row">

            <div class="col-lg-3">

                <h1 class="my-4">Three Phase Mayo</h1>
                <div class="list-group">
                <a href="#" class="list-group-item">Category 1</a>
                <a href="#" class="list-group-item">Category 2</a>
                <a href="#" class="list-group-item">Category 3</a>
                </div>

            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
       
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                    <a href="<?php echo $_SERVER['PHP_SELF'].'?action='.ACTION_SHOW_SELECTED_PRODUCT.'&prodId='.$productArray[0]->getID();?>">
                            <img class="d-block w-100" src="./res/images/imagenumber<?php echo $productArray[0]->getID();?>.jpg" alt="Imagenumber<?php echo $productArray[0]->getID();?>">
                        </a>
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo $productArray[0]->getName(); ?></h5>
                            <p><?php echo '$product->getDescription()'; ?></p>
                        </div>
                    </div>
                    <?php for($i=1; $i<count($productArray); $i++){?>
                        <div class="carousel-item">
                        <a href="<?php echo $_SERVER['PHP_SELF'].'?action='.ACTION_SHOW_SELECTED_PRODUCT.'&prodId='.$productArray[$i]->getID();?>">
                            <img class="d-block w-100" src="./res/images/imagenumber<?php echo $productArray[$i]->getID();?>.jpg" alt="Imagenumber<?php echo $productArray[$i]->getID();?>">
                        </a>
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo $productArray[$i]->getName(); ?></h5>
                            <p><?php echo '$productArray[$i]->getDescription()'; ?></p>
                        </div>
                        </div>
                    <?php } ?>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>

                <div class="row">
                    <?php foreach($productArray as $product){?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                        <a href="<?php echo $_SERVER['PHP_SELF'].'?action='.ACTION_SHOW_SELECTED_PRODUCT.'&prodId='.$product->getID();?>">
                            <img class="card-img-top" src="./res/images/imagenumber<?php echo $product->getID();?>.jpg" alt="Imagenumber<?php echo $product->getID();?>">
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                            <a href="<?php echo $_SERVER['PHP_SELF'].'?action='.ACTION_SHOW_SELECTED_PRODUCT.'&prodId='.$product->getID();?>"><?php echo $product->getName(); ?></a>
                            </h4>
                            <h5><?php echo $product->getPrice(); ?></h5>
                            <p class="card-text"><?php echo '$product->getDescription()'; ?></p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                        </div>
                        </div>
                    </div>
                    <?php } ?>          
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-lg-9 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

        <?php 
    }

    static function footer()    { ?>
        <!-- Footer -->
        <footer class="py-5 bg-dark">
             <div class="container">
             <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
             </div>
             <!-- /.container -->
         </footer>
 
         <!-- Bootstrap core JavaScript -->
         <script src="inc/html/vendor/jquery/jquery.min.js"></script>
         <script src="inc/html/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 
         </body>
 
         </html>
     <?php }


    //Display msg Status
    static function showLastActionStatus($lastActionStatus){ 
        if ($lastActionStatus == LAST_ACTION_OK)  {
        echo '<p class="msgOk">Action performed OK!</p>';
        } else if ($lastActionStatus == LAST_ACTION_NOK) {
        echo '<p class="msgError">ERROR performing last action!</p>';
        foreach(self::$errors as $e) {
            echo '<span class="msgError">'.$e.'<br /></span>';
        }
        }


    }


}?>
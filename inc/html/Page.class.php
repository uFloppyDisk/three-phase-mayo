<?php

class Page
{

    public static $title = "Please set the Title";
    public static $currencyRates = array();
    public static $errors = [];
 
 

    static function showLogin() { ?>


        <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <H1> Please Signed in: </H1>
        <div>

            <div>
            <input  type="TEXT" placeholder="User Name"  name="username">
            </div>

            <div>
            <input type="text" placeholder="Password"  name="password">
            </div>

        </div>
        <input type="submit" value="Log in">
        </form>
 

 <?php }

    //Show orders in the Account
    static function ShowAccountOrderList($orders, $account){


    }

    // Show All Items
    static function  AllProductsList($items){


    }

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

    //Display form  Customer
    static function showEditAccountForm(Account $account, $action){ 
    //This form is used for updating an existing account 
    //  and for creating a new one
        
        
        //setup action title
        if($action == ACTION_EDIT_ACCOUNT) {
            echo '<p><h3>Edit Account - '.$account->getID().'</h3></p>';
        } else {
            echo '<p><h3>Create Account</h3></p>';
        }
?>

        <form name="formAccount" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" >
        <fieldset>
            <table>
            <colgroup>
                <col class="first" />
                <col class="second" />
            </colgroup>
            <tr>
                <td>First Name</td>
                <td><input type="text" name="accFName" id="accFName" size="100" required="required" 
                    value="<?php if($action == ACTION_EDIT_ACCOUNT) { echo $account->getFirstName(); } ?>"></td>
            </tr>	
            <tr>
                <td>Last Name</td>
                <td><input type="text" name="accLName" id="accLName" size="100" required="required" 
                    value="<?php if($action == ACTION_EDIT_ACCOUNT) { echo $account->getLastName(); } ?>"></td>
            </tr>	
            <tr>
                <td>Email</td>
                <td><input type="text" name="accEmail" id="accEmail" size="50" required="required" 
                    value="<?php if($action == ACTION_EDIT_ACCOUNT) { echo $account->getEmail(); } ?>"></td>
            </tr>
            <tr>
                <td>UserName</td>
                <td><input type="text" name="accUserName" id="accUserName" size="50" required="required" 
                    value="<?php if($action == ACTION_EDIT_ACCOUNT) { echo $account->getUsername(); } ?>"></td>
            </tr>	
            <tr>
                <td>Password</td>
                <td><input type="text" name="accPassword" id="accPassword" size="50" required="required" 
                    value="<?php if($action == ACTION_EDIT_ACCOUNT) { echo 'set New Password'; } ?>"></td>
            </tr>		
            <tr>
                <td>Address</td>
                <td><input type="text" name="accAddress" id="accAddress" size="50" required="required" 
                    value="<?php if($action == ACTION_EDIT_ACCOUNT) { echo $account->getAddressing(); } ?>"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Save"  class="btn btn-primary" ></td>
                <td><input type="button" value="Cancel"  class="btn btn-primary" onclick=document.location="<?php echo $_SERVER["PHP_SELF"]."?action=".ACTION_LIST_PRODUCTS; ?>"></td>
            </tr>
            </table>
            <input type="hidden" id="action" name="action" value="<?php 
                    if($action == ACTION_NEW_ACCOUNT) {
                    echo ACTION_INSERT_ACCOUNT; 
                    } else if ($action == ACTION_EDIT_ACCOUNT){
                    echo ACTION_UPDATE_ACCOUNT;
                    } ?>">      
            <input type="hidden" id="accId" name="accId" value="<?php if($action == ACTION_EDIT_ACCOUNT) { echo $account->getID(); } ?>">    
        </fieldset>
        </form>
        </div>

    </div>
    <?php }

static function header() { ?>

    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title><?php echo self::$title; ?></title>
        <!-- <meta http-equiv="refresh" content="3"> -->

    </head>
    <body>
    <div class="container">
        <h1><?php echo self::$title; ?></h1>

       
<?php }


public static function html_page()
{?>
    
    
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
            <li class="nav-item active">
                <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
                <form method="POST" action="#">
                    <input type="hidden" id="action" name="action" value="<?php echo ACTION_SHOW_lOGIN;?>">
                    <input  type="submit" id="signbtn" value="Sign in/Register"/>
                    
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

            <h1 class="my-4">Shop Name</h1>
            <div class="list-group">
            <a href="#" class="list-group-item">Category 1</a>
            <a href="#" class="list-group-item">Category 2</a>
            <a href="#" class="list-group-item">Category 3</a>
            </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                <img class="d-block img-fluid" src="./res/images/imagenumber1.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
    <h5>Macbook Pro 15' '</h5>
    <p>Shop this spring event sale on selected Macbook Pro model's</p>
  </div>
                </div>
                <div class="carousel-item">
                <img class="d-block img-fluid" src="./res/images/nikeshoes.jpg" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
    <h5>Shop Nike Men's Shoes'</h5>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
  </div>
                </div>
                </div>
                <div class="carousel-item">
                <img class="d-block img-fluid" src="./res/images/keyboards.jpg" alt="Third slide">
                </div>
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

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                <a href="#"><img class="card-img-top" src="./res/images/productimages/carrotsP.jpg" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                    <a href="#">Organic Carrots</a>
                    </h4>
                    <h5>$4.99</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                <a href="#"><img class="card-img-top" src="./res/images/productimages/orangesP.jpg" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                    <a href="#">Oranges</a>
                    </h4>
                    <h5>$2.99/kg</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                <a href="#"><img class="card-img-top" src="./res/images/productimages/applesP.jpg" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                    <a href="#">Gala Apples</a>
                    </h4>
                    <h5>$3.99/Kg</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                <a href="#"><img class="card-img-top" src="./res/images/productimages/tablelampP.jpg" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                    <a href="#">Table Lamp</a>
                    </h4>
                    <h5>$24.99</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                <a href="#"><img class="card-img-top" src="./res/images/productimages/toiletpaperP.jpg" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                    <a href="#">One Toilet Paper Roll</a>
                    </h4>
                    <h5>$1299.99</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                <a href="#"><img class="card-img-top" src="./res/images/productimages/bedframeP.jpg" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                    <a href="#">Ikea Bed Frame</a>
                    </h4>
                    <h5>$349.99</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
                </div>
            </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

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
}

?>
<?php

class Checkout
{

public static function billinginfo_html()
{?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        @media (min-width: 979px) {
            body {
                padding-top: 100px;
                }
        }
    </style>
   
  </head>
  <body>
   
    <!-- Navigation --> 
    <div class = "container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
                <h3><a class="text-white">Three Phase Mayo</a></h3>
            
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
                            
                    </ul>
                </div>
            </div>
        </nav>
    </div >
    <!-- End of Nav -->
    <?php 
    
    $Accountinfo = AccountMapper::getAccountByID($_SESSION['userId']);
    
    ?>

        <div class="container">
           <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <div class="row">
                        <div class="col-50">
                            <h3>Billing Address</h3>
                            <label for="fname"><i class="fa fa-user"></i> First Name</label>
                            <input type="text" id="fname" name="firstname" placeholder="<?php echo $Accountinfo->getFirstName();?>">
                            <label for="fname"><i class="fa fa-user"></i> Last Name</label>
                            <input type="text" id="fname" name="firstname" placeholder="<?php echo $Accountinfo->getLastName();?>">
                            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                            <input type="text" id="adr" name="address" placeholder="1123 Robson st">
                            <label for="city"><i class="fa fa-institution"></i> City</label>
                            <input type="text" id="city" name="city" placeholder="Vancouver">

                            <div class="row">
                            <div class="col-50">
                                <label for="state">State</label>
                                <input type="text" id="state" name="state" placeholder="BC">
                            </div>
                            <div class="col-50">
                                <label for="zip">Zip</label>
                                <input type="text" id="zip" name="zip" placeholder="10001">
                            </div>
                            </div>
                        </div>
                        
                        <input type="hidden" id="accId" name="accId" value="<?php echo $Accountinfo->getID();?>">
                        <input  class="btn btn-success" type="submit" name="action" value="<?php echo ACTION_SUBMIT_ORDER;?>">
                        <input class="btn btn-primary" type="submit"  name="action" value="<?php echo ACTION_GOTO_MAIN;?>">

                    </div>
                </div>
            <form>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>





  


<?php }

}
?>
<?php

class AccountSettings
{

public static function accountsettings_html()
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
                        session_start();
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
    
    $AccountToEdit = AccountMapper::getAccountByID($_SESSION['userId']);
    
    ?>

        <div class="container">
           <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="right">
                    <div class="info">
                        <h3>Edit Profile</h3>
                    </div>

                    <div class="data">
                            
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">abc</span>
                            </div>
                            <input type="text" class="form-control" name="FirstName" placeholder="<?php echo $AccountToEdit->getFirstName();?>" aria-label="FirstName"
                            aria-describedby="basic-addon1">
                        </div>  

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">abc </span>
                            </div>
                            <input type="text" class="form-control" name="LastName" placeholder="<?php echo $AccountToEdit->getLastName();?>" aria-label="LastName"
                            aria-describedby="basic-addon1">
                        </div> 

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control"  name="Username" placeholder="<?php echo $AccountToEdit->getUsername();?>" aria-label="Username" aria-describedby="basic-addon1">
                        </div> 

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">|^|</span>
                            </div>
                            <input type="text" class="form-control" name="Address" placeholder="Address" aria-label="Address" aria-describedby="basic-addon1">
                        </div> 

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">***</span>
                            </div>
                            <input type="password" class="form-control" placeholder="New Password" aria-label="Password" aria-describedby="basic-addon1">
                        </div>   
                        <input type="hidden" id="accId" name="accId" value="<?php echo $AccountToEdit->getID();?>">
                        <input  class="btn btn-success" type="submit" name="action" value="<?php echo ACTION_UPDATE_ACCOUNT;?>"">
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
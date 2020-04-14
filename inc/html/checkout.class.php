<?php

class Checkout
{

public static function billinginfo_html()
{?>
    <!doctype html>
<!-- visa icon by font awesome: https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css-->

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





  


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--will use to import icons for  billing form-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Checkout</title>
    <style>
      body {
        font-family: Arial;
        font-size: 17px;
        padding: 8px;
      }
      
      * {
        box-sizing: border-box;
      }
      
      .row {
        display: -ms-flexbox; /* IE10 */
        display: flex;
        -ms-flex-wrap: wrap; /* IE10 */
        flex-wrap: wrap;
        margin: 0 -16px;
      }
      
      .col-25 {
        -ms-flex: 25%; /* IE10 */
        flex: 25%;
      }
         .container {
        background-color: #f2f2f2;
        padding: 5px 20px 15px 20px;
        border: 1px solid lightgrey;
        border-radius: 3px;
      }
      .col-50 {
        -ms-flex: 50%; /* IE10 */
        flex: 50%;
      }
          
      input[type=text] {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
      }
      .col-75 {
        -ms-flex: 75%; /* IE10 */
        flex: 75%;
      }
      
      .col-25,
      .col-50,
      .col-75 {
        padding: 0 16px;
      }
      
   
  
      
      label {
        margin-bottom: 10px;
        display: block;
      }
      
      .icon-container {
        margin-bottom: 20px;
        padding: 7px 0;
        font-size: 24px;
      }
      
      .btn {
        background-color: #4CAF50;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 100%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
      }
      
      .btn:hover {
        background-color: #45a049;
      }
      
      a {
        color: #2196F3;
      }
      
      hr {
        border: 1px solid lightgrey;
      }
      
      span.price {
        float: right;
        color: grey;
      }
      
      /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
      @media (max-width: 800px) {
        .row {
          flex-direction: column-reverse;
        }
        .col-25 {
          margin-bottom: 20px;
        }
      }
      </style>
  </head>
  <body>
    <body class="float-center" class="bg-light">
        <div class="container ">


        <table class="table">
            <h2 >Order Details</h2>
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">AccountID</th>
      <th scope="col">Products Name</th>
      <th scope="col">Status</th>
      <th scope="col">Quatity </th>
      <th scope="col">Edit </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark123</td>
      <td>Nike Shoes</td>
      <td class="text-success">Delivered</td>
        <td>1</td>
       <td><a href="">X</a></td> 
        <!-- <?php  echo '<TD><A HREF="'.$_SERVER["PHP_SELF"].'?action=delete&id='.$customer->getCustomerID().'">Edit</A></TD>';
        echo '</TR>';?> -->
    </tr>

  </tbody>
</table>



<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="/action_page.php">

        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Sam ">
            <label for="fname"><i class="fa fa-user"></i> Last Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Hill">
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

          <div class="col-50">
            <h3>Select Payment Type</h3>
     
            <div class="icon-container">
              <!-- visa icon from ref: https://fontawesome.com/v4.7.0/icon/cc-visa-->
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
       
            </div>
            <label for="cname">Card Name</label>
            <input type="text" id="cname" name="cname" placeholder="Sam">
            <label for="ccnum">Credit Card Number</label>
            <input type="text" id="ccnum" name="cnumber" placeholder="1111-1111-1111-1111">
            <label for="emonth">Card Expire Month</label>
            <input type="text" id="emonth" name="emonth" placeholder="April">

            <div class="row">
              <div class="col-50">
                <label for="eyear">Expire Year</label>
                <input type="text" id="eyear" name="eyear" placeholder="2020">
              </div>
              <div class="col-50">
                <label for="cvv">CVV Number</label>
                <input type="text" id="cvv" name="cvv" placeholder="111 check back of the card">
              </div>
            </div>
          </div>

        </div>
      
        <input type="submit" value="Continue to checkout" class="btn">
      </form>
    </div>
  </div>

</div>
    
 

  
  </body>
</html>
<?php }

}
?>
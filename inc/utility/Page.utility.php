<?php

class Page  {

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

  //Show items only in the Account
  static function AccountProductList($items, $account){


  }

  // Show All Items
  static function  AllProductsList($items){

    
  }
  //Display msg Status
  static function showLastActionStatus($lastActionStatus){ 
    ?>
    <?php
      if ($lastActionStatus == LAST_ACTION_OK)  {
        echo '<p class="msgOk">Action performed OK!</p>';
      } else if ($lastActionStatus == LAST_ACTION_NOK) {
        echo '<p class="msgError">ERROR performing last action!</p>';
        foreach(self::$errors as $e) {
          echo '<span class="msgError">'.$e.'<br /></span>';
        }
      }
    
    ?>
   <?php
  }

} 

?>
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



} 

?>
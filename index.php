<?php

require_once("inc/config.inc.php");

require_once("inc/classes/Account.class.php");
require_once("inc/classes/ISOCode.class.php");
require_once("inc/classes/Merchant.class.php");
require_once("inc/classes/Order.class.php");
require_once("inc/classes/Product.class.php");

require_once("inc/wrappers/Account.wrapper.php");
require_once("inc/wrappers/ISOCode.wrapper.php");
require_once("inc/wrappers/Merchant.wrapper.php");
require_once("inc/wrappers/Order.wrapper.php");
require_once("inc/wrappers/Product.wrapper.php");

require_once("inc/managers/Account.manager.php");
require_once("inc/managers/CurrencyWebService.manager.php");
require_once("inc/managers/VerifySignIn.manager.php");
require_once("inc/managers/PDO.manager.php");
require_once("inc/managers/Product.manager.php");

require_once("inc/html/Page.class.php");
require_once("inc/html/AccountUtility.class.php");
require_once("inc/html/PageProduct.class.php");


require_once("inc/html/Page.class.php");
//Initialize the DAOs, which controls CRUD operations in Database
AccountMapper::initialize();
ISOCodeMapper::initialize();
MerchantMapper::initialize();
OrderMapper::initialize();
ProductMapper::initialize();


//Get data from Currency WebService
Page::$currencyRates = array();
PageProduct::$currencyRates = array();
foreach(CURRENCIES as $curr){
    CurrencyWebService::$currency = $curr;
    //Rates to be used on Page, Will Be store on $currencyRates[] by $curr key.
    Page::$currencyRates[$curr] = CurrencyWebService::getExchangeRate();
    PageProduct::$currencyRates[$curr] = CurrencyWebService::getExchangeRate();
    
}


//If there was an action, write it to $action
//the default action is ACTION_LIST_PRODUCTS
if (isset($_POST["action"])){
    $action = $_POST["action"];
} else if (isset($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = ACTION_LIST_PRODUCTS;
}

//If there was an account Id (user Logged in), write it to $accId
if (isset($_POST["accId"])){
    $accId = $_POST["accId"];
} else if (isset($_GET["accId"])) {
    $accId = $_GET["accId"];
} else {
    $accId = -1;
}


$lastActionStatus = NO_LAST_ACTION;
Page::$errors = []; // array to track the errors

//setup title & exchange rates
Page::$title = "Three Phase Mayo";

switch ($action){
    //do the appropriate function for the respective action
        
    case ACTION_SHOW_SIGNIN;
        showSignInPage();
        
        break;
    case ACTION_DELETE_ACCOUNT;
      
        break;

    case ACTION_EDIT_ACCOUNT;
        
        break;



    case ACTION_UPDATE_ACCOUNT;
      
        break;  



    case ACTION_INSERT_ORDER;
        //Insert new order (Shopping cart List) into the system (dataBase)

        break;    
        
    case ACTION_LIST_ORDERS;
        // List all orders of the current registered Account.
        break;

    case ACTION_DELETE_ORDER;
     
        break;
        
    case ACTION_ADDTO_ORDER;
        
        break; 
        
    case ACTION_SIGIN_ACCOUNT;
  
        if (isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
    
            $authUser = AccountMapper::getAccountByUsername($_POST['username']);
            //Check the DAO returned an object of type user
        
            if ($authUser instanceof Account){ 
                //Check the password
                
                if ($authUser->verifyPassword($_POST['password']))  {
                    //Start the session
                    session_start();
                    //Set the user to logged in
                    $_SESSION['username'] = $authUser->getUsername();
                    //Send the user to the Main Page Or Shopping Page.
                    $lastActionStatus = LAST_ACTION_OK;
                    listAllProducts();
                    
                } else {
                    $lastActionStatus = LAST_ACTION_NOK;
                    Page::showLastActionStatus($lastActionStatus);
                    showSignInPage();
                }
            }  
            else {
                $lastActionStatus = LAST_ACTION_NOK;
                Page::showLastActionStatus($lastActionStatus);
                showSignInPage();
            
            } 
        }
    

        break;
    
    

    case ACTION_SIGN_OUT;
            session_start();
            session_destroy();
            header("Location: index.php");
    break;
        
    case ACTION_SIGNUP_ACCOUNT;
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
            try {
                AccountMapper::makeAccount($_POST['username'], $_POST['email'], $_POST['password']);

                $lastActionStatus = LAST_ACTION_OK;
                //Start the session
                session_start();
                //Set the user to logged in
                $_SESSION['username'] = $_POST["username"];
                //Send the user to the Main Page Or Shopping Page.
                listAllProducts();

            } catch (DatabaseValueException $ex) {
                $lastActionStatus = LAST_ACTION_NOK;
                Page::showLastActionStatus($lastActionStatus);
                showSignInPage();
            }
        }
        break;
    case ACTION_SHOW_SELECTED_PRODUCT;
        // show product page in which item can be added to the order.
        if (isset($_GET['prodId'])) {
            $prodId = $_GET['prodId'];
            session_start();
            PageProduct::header();
            PageProduct::product_html($prodId);
        }
    break;
    case ACTION_LIST_PRODUCTS;
        default: // List All Items on the Main Page.
            session_start();
            listAllProducts();
        break;
    }
    
$lastActionStatus = NO_LAST_ACTION;


?>

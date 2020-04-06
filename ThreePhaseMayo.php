<?php


//include files
require_once("inc/config.inc.php");
require_once("inc/Controller/AccountController.php");


require_once("inc/Utility/Page.class.php");
//Initialize the DAOs, which controls CRUD operations in Database
AccountDAO::initialize();


//Get data from webService
Page::$currencyRates = array();
foreach(CURRENCIES as $curr){
    WebServiceExchangeRates::$currency = $curr;
    Page::$currencyRates[$curr] = WebServiceExchangeRates::getExchangeRate();
}


//If there was an action, write it to $action
//the default action is ACTION_LIST_ITEMS
if (isset($_POST["action"])){
    $action = $_POST["action"];
} else if (isset($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = ACTION_LIST_ITEMS;
}

//If there was an account Id, write it to $cstId
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

//Page header
Page::header();


switch ($action){
    //do the appropriate function for the respective action
        
    case ACTION_DELETE_CUSTOMER;
        //Delete the customer
        if (deleteAccount()){
            $lastActionStatus = LAST_ACTION_OK;
        } else {
            $lastActionStatus = LAST_ACTION_NOK;
            Page::$errors[] = 'Error deleting customer: '.$accId;
            Page::$errors[] = 'You can not delete customers with 1 or more orders.';
        }
        //Show last action status
        Page::showLastActionStatus($lastActionStatus);
        break;

    case ACTION_EDIT_ACCOUNT;
        //Edit the account
        editAccount();
        break;

    case ACTION_INSERT_ACCOUNT;
        //Insert new account
      
        if (empty(Page::$errors)){
            if (insertAccount()){
                $lastActionStatus = LAST_ACTION_OK;
            } else {
                $lastActionStatus = LAST_ACTION_NOK;
                Page::$errors[] = 'Error creating new account';
            }
            //Show last action status
            Page::showLastActionStatus($lastActionStatus);
        } else {
            Page::showFormErros();
        }
        $action = ACTION_LIST_ITEMS;
        
        listItems();
        break;

    case ACTION_UPDATE_ACCOUNT;
        //Update customer
        if (empty(Page::$errors)){
            if (updateAccount()){
                $lastActionStatus = LAST_ACTION_OK;
            } else {
                $lastActionStatus = LAST_ACTION_NOK;
                Page::$errors[] = 'Error updating account: '.$accId;
            }
            //Show last action status
            Page::showLastActionStatus($lastActionStatus);
            $action = ACTION_LIST_ITEMS;
            listItems();
            
        } else {
           
            $action = ACTION_EDIT_ACCOUNT;
            editAccount();
        }
        break;  



    case ACTION_INSERT_ORDER;
        //Insert new order (Shopping cart List) into the system (dataBase)

        break;    
        
    case ACTION_LIST_ORDERS;
        // List all orders of the current registered Account.
        break;

    case ACTION_DELETE_ORDER;
     
        break; 
        
    
    case ACTION_LIST_ITEMS;
        default: // List All Items on the Main Page.
        break;
    }
    
$lastActionStatus = NO_LAST_ACTION;

//Page footer
Page::footer();
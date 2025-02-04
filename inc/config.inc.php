<?PHP

define('DB_HOST','localhost');

define('DB_USER','root');
define('DB_PASS','');

define('DB_NAME','tpm');



/* Set of actions: Used to Know whats the User Selects on the WebApp. 
each action has to be set on a hidden input on any form
when GET or POST methods are used.
Actions also has to be set on the URL when needed
*/

define("ACTION_NEW_ACCOUNT", "NewAccount");
define("ACTION_EDIT_ACCOUNT", "EditAccount");
define("ACTION_DELETE_ACCOUNT", "DeleteAccount");
define("ACTION_INSERT_ACCOUNT", "InsertAccount");
define("ACTION_UPDATE_ACCOUNT", "Update Account");
define("ACTION_SIGIN_ACCOUNT", "SignInAccount");
define("ACTION_SIGNUP_ACCOUNT","SignUpAccount");
define("ACTION_SHOW_SIGNIN", "ShowSignIn");
define("ACTION_SIGN_OUT","SignOut");
define("ACTION_GOTO_MAIN","Go Back to Main");

// these actions will only be used if we set an admin page
// to include new products into the database
define("ACTION_LIST_PRODUCTS", "Products List");
define("ACTION_DELETE_PRODUCT", "DeleteProduct");
define("ACTION_INSERT_PRODUCT", "InsertProduct");
define("ACTION_EDIT_PRODUCT", "EditProduct");
define("ACTION_UPDATE_PRODUCT", "UpdateProduct");
define("ACTION_NEW_PRODUCT", "NewProduct");
define("ACTION_SEARCH_PRODUCT", "SearchProduct");
define("ACTION_SHOW_SELECTED_PRODUCT", "ShowSelectedProduct");


//These Actions are per Shopping Cart, and Per Account
define("ACTION_LIST_ORDERS", "ListOrders");
define("ACTION_INSERT_ORDER", "InsertOrder");
define("ACTION_DELETE_ORDER", "DeleteOrder");
define("ACTION_SEARCH_ORDER", "SearchOrder");
define("ACTION_ADDTO_ORDER","AddToOrder");
define("ACTION_GOTO_CHECKOUT","GoToCheckout");
define("ACTION_REMOVE_PRODUCT_FROM_ORDER", "RemoveFromOrder");
define("ACTION_CHANGE_CURRENCY","ChangeCurrency");
define("ACTION_SUBMIT_ORDER","SubmitOrder");
//Action Status used to Determine If an ACTION was
//Succesfully Performed or not.
define("NO_LAST_ACTION", 0);
define("LAST_ACTION_OK", 1);
define("LAST_ACTION_NOK", -1);

//Currency API URL
define("CURRENCY_API_URL","https://api.exchangeratesapi.io/latest?base=CAD&symbols=");
//Currencys supported by the app. User can add as many currencys as he wish in the array
define("CURRENCIES", array('USD','EUR'));  

//log File in case is needed
define("LOG_FILE", "log/error.log");



?>
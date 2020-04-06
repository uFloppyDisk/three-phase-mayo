<?php

//Set actions
define("ACTION_NEW_ACCOUNT", "NewAccount");
define("ACTION_EDIT_ACCOUNT", "EditAccount");
define("ACTION_DELETE_ACCOUNT", "DeleteAccount");
define("ACTION_INSERT_ACCOUNT", "InsertAccount");
define("ACTION_UPDATE_ACCOUNT", "UpdateAccount");


define("ACTION_LIST_ITEMS", "ListItems");
define("ACTION_DELETE_ITEM", "DeleteItem");
define("ACTION_INSERT_ITEM", "InsertItem");
define("ACTION_EDIT_ITEM", "EditItem");
define("ACTION_UPDATE_ITEM", "UpdateItem");
define("ACTION_NEW_ITEM", "NewItem");
define("ACTION_SEARCH_ITEM", "SearchItem");

define("ACTION_LIST_ORDERS", "ListOrders");
define("ACTION_INSERT_ORDER", "InsertOrder");
define("ACTION_DELETE_ORDER", "DeleteOrder");
define("ACTION_SEARCH_ORDER", "SearchOrder");

define("NO_LAST_ACTION", 0);
define("LAST_ACTION_OK", 1);
define("LAST_ACTION_NOK", -1);

define("WEB_SERVICE_URL","https://api.exchangeratesapi.io/latest?base=CAD&symbols=");
define("CURRENCIES", array('USD','EUR'));  // User can add as many currencys as he wish in the array

define("LOG_FILE", "log/error.log");




?>
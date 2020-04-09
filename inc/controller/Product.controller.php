<?php


function listAllProducts(){
    //Create array of items
    $items = ProductMapper::getProducts();

    //Show form item List
    Page::AllProductList($items);
}

function listAccountProducts(){
    //Create array of items
    $items = ProductMapper::getProducts();

    //Create new instance or Customer class
    $account = new Account();

    //Add data
    if (isset($_POST["accId"])){
        $account = AccountMapper::getAccountByID($_POST["accId"]);
    } else {
        $account = AccountMapper::getAccountByID($_GET["accId"]);
    }

    //Show form item List
    Page::AccountProductList($items, $account);
}


?>
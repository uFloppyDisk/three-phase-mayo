<?php

/*
    This controller will keep the actions: delete, edit, form, insert, list and update for Accounts
*/

//Delete Account
function deleteAccount(){
    //Delete Account
    return AccountDAO::deleteAccount($_GET["accId"]);
}


//Call form - Account
function newAccount(){
    //Create new instance of Account class
    $account = new Account();
    
    //Show New Account form
    Page::showCreateNewAccountForm($account, ACTION_NEW_ACCOUNT);
}


//Insert new Account
function insertAccount(){
    //Create new instance of Account class
    $account = new Account();

    //Add data
    $account->setUsername($_POST["userName"]);
    $account->setEmail($_POST["accEmail"]);
    $account->setPassword($_POST["accPass"]);
    $account->setFirstName($_POST["accFName"]);
    $account->setLastName($_POST["accLName"]);
    $account->setAddressing($_POST["accAddr"]);
  
    $username = $account->getUsername(); 
    $email = $account->getEmail(); 
    $password =  $account->getPassword(); 
    //Insert new Account
    return AccountDAO::makeAccount($username, $email, $password);
}




//Edit Account
function editAccount(){
    //Create new instance or Account class
    $Account = new Account();

    //Add data
    if(isset($_GET["accId"])){
        $account->setUsername($_GET["userName"]);
        $account->setEmail($_GET["accEmail"]);
        $account->setPassword($_GET["accPass"]);
        $account->setFirstName($_GET["accFName"]);
        $account->setLastName($_GET["accLName"]);
        $account->setAddressing($_GET["accAddr"]);
  
    } else {
        $account->setUsername($_POST["userName"]);
        $account->setEmail($_POST["accEmail"]);
        $account->setPassword($_POST["accPass"]);
        $account->setFirstName($_POST["accFName"]);
        $account->setLastName($_POST["accLName"]);
        $account->setAddressing($_POST["accAddr"]);
      
    }

    //Show form - edit account
    Page::showEditAccountForm($account, ACTION_EDIT_ACCOUNT);
}

//Update account
function updateAccount(){
    //Create new instance or Account class
    $account = new Account();

    //Add data
    $account->setUsername($_POST["userName"]);
    $account->setEmail($_POST["accEmail"]);
    $account->setPassword($_POST["accPass"]);
    $account->setFirstName($_POST["accFName"]);
    $account->setLastName($_POST["accLName"]);
    $account->setAddressing($_POST["accAddr"]);
    

    //Update Account
    return AccountDAO::updateAccountInfo($account);
}


?>
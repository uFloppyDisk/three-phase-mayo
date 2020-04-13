<?php

require_once("inc/exceptions.inc.php");

class AccountMapper {

    private static $db;

    static function initialize() {
        self::$db = new PDOManager('Account');
    }

    // Create an Account
    static private function _createAccount(string $username, string $email, string $password) {
        $sql = "INSERT INTO accounts
                    (username, email, password)
                VALUES 
                    (:username, :email, :password);";

        self::$db->query($sql);

        self::$db->bind(":username", $username);
        self::$db->bind(":email", $email);
        self::$db->bind(":password", $password);

        try {
            self::$db->execute();
        } catch (PDOException $ex) {
            if ($ex::errorInfo[0] == "42000") {
                throw DatabaseValueException::valueExceedsBounds($ex::errorInfo[2]);
            }
        }

        return self::$db->getLastInsertedID();
    }

    // Update account username
    static private function _updateField(int $id, string $value, string $field) {
        $sql = "UPDATE accounts
                SET
                    $field = :value
                WHERE
                    id = :id;";
        

        self::$db->query($sql);

        self::$db->bind(":value", $value);
        self::$db->bind(":id", $id);

        try {
            self::$db->execute();
        } catch (PDOException $ex) {
            if ($ex::errorInfo[0] == "42000") {
                throw DatabaseValueException::valueExceedsBounds($ex::errorInfo[2]);
            }
        }

        return self::$db->getRowCount();
    }

    static function makeAccount(string $username, string $email, string $password) {
        if (self::getAccountByUsername($username)) {
            throw DatabaseValueException::valueNotUnique($username);
        }

        if (self::getAccountByEmail($email)) {
            throw DatabaseValueException::valueNotUnique($email);
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $ret = self::_createAccount($username, $email, $hashed_password);

        return true;
    }

    // Get a single account by ID
    static function getAccountByID(int $ID) {
        $sql = "SELECT * FROM 
                    accounts
                WHERE 
                    id = :id;";

        self::$db->query($sql);
        self::$db->bind(":id", $ID);
        self::$db->execute();

        return self::$db->getResult();
    }

    // Get a single account by username
    static function getAccountByUsername(string $username) {
        $sql = "SELECT * FROM 
                    accounts
                WHERE 
                    username = :username;";

        self::$db->query($sql);
        self::$db->bind(":username", $username);
        self::$db->execute();

        return self::$db->getResult();
    }

    // Get a single account by email
    static function getAccountByEmail(string $email) {
        $sql = "SELECT * FROM 
                    accounts
                WHERE 
                    email = :email;";

        self::$db->query($sql);
        self::$db->bind(":email", $email);
        self::$db->execute();

        return self::$db->getResult();
    }

    // Get all accounts
    static function getAccounts() {
        $sql = "SELECT * FROM accounts;";

        self::$db->query($sql);
        self::$db->execute();

        return self::$db->getResults();
    }

    // Update account info that is not associated with login data
    static function updateAccountInfo(Account $account) {
        $sql = "UPDATE accounts
                SET
                    name_first = :name_first,
                    name_last = :name_last,
                    addressing = :addressing,
                    merchant_account = :merchant_account,
                    merchant_id = :merchant_id
                WHERE
                    id = :id;";
        

        self::$db->query($sql);

        self::$db->bind(":name_first", $account->getFirstName());
        self::$db->bind(":name_last", $account->getLastName());
        self::$db->bind(":addressing", $account->getAddressing(NULL));
        self::$db->bind(":merchant_account", $account->getIsMerchantAccount());
        self::$db->bind(":merchant_id", $account->getMerchantID());

        self::$db->bind(":id", $account->getID());

        try {
            self::$db->execute();
        } catch (PDOException $ex) {
            if ($ex::errorInfo[0] == "42000") {
                throw DatabaseValueException::valueExceedsBounds($ex::errorInfo[2]);
            }
        }

        return self::$db->getRowCount();
    }

    // Update account username
    static function changeUsername(int $id, string $username) {
        if (self::getAccountByUsername($username)) {
            throw DatabaseValueException::valueNotUnique($username);
        }

        return self::_updateField($id, $username, "username");
    }

    // Update account email
    static function changeEmail(int $id, string $email) {
        if (self::getAccountByEmail($email)) {
            throw DatabaseValueException::valueNotUnique($email);
        }

        return self::_updateField($id, $email, "email");
    }

    // Update account password
    static function changePassword(int $id, string $password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        return self::_updateField($id, $hashed_password, "password");
    }

    // Delete account by ID
    static function deleteAccount(int $ID) {
        $sql = "DELETE FROM 
                    accounts
                WHERE 
                    id = :id;";

        self::$db->query($sql);

        self::$db->bind(":id", $ID);

        self::$db->execute();

        return self::$db->getRowCount();
    }
}

?>
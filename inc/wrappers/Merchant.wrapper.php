<?php

require_once("inc/exceptions.inc.php");

class MerchantMapper {

    private static $db;

    static function initialize() {
        self::$db = new PDOManager('Merchant');
    }

    // Create an merchant
    static private function _createMerchant(Merchant $merchant) {
        $sql = "INSERT INTO merchants
                    (name, global_discount, shipping_country)
                VALUES 
                    (:name, :discount, :shipping);";

        self::$db->query($sql);

        self::$db->bind(":name", $merchant->getName());
        self::$db->bind(":discount", $merchant->getGlobalDiscount());
        self::$db->bind(":shipping", $merchant->getShippingCountry());

        try {
            self::$db->execute();
        } catch (PDOException $ex) {
            if ($ex::errorInfo[0] == "42000") {
                throw DatabaseValueException::valueExceedsBounds($ex::errorInfo[2]);
            }
        }

        return $db->getLastInsertedID();
    }

    static function makeMerchant($name, $shipping_country, $global_discount=NULL) {
        $merchant = new Merchant();

        $merchant->setName($name);
        $merchant->setShippingCountry($shipping_country);

        self::_createMerchant($merchant);
    }

    // Get a single merchant by ID
    static function getMerchantByID(int $ID) {
        $sql = "SELECT * FROM 
                    merchants
                WHERE 
                    id = :id;";

        self::$db->query($sql);
        self::$db->bind(":id", $ID);
        self::$db->execute();

        return self::$db->getResult();
    }

    // Get all merchants
    static function getMerchants() {
        $sql = "SELECT * FROM merchants;";

        self::$db->query($sql);
        self::$db->execute();

        return self::$db->getResults();
    }

    // Update merchant info
    static function updateMerchantInfo(Merchant $merchant) {
        $sql = "UPDATE merchants
                SET
                    name = :name,
                    global_discount = :discount,
                    shipping_country = :shipping
                WHERE
                    id = :id;";
        

        self::$db->query($sql);

        self::$db->bind(":name", $merchant->getName());
        self::$db->bind(":discount", $merchant->getGlobalDiscount());
        self::$db->bind(":shipping", $merchant->getShippingCountry());

        self::$db->bind(":id", $merchant->getID());

        try {
            self::$db->execute();
        } catch (PDOException $ex) {
            if ($ex::errorInfo[0] == "42000") {
                throw DatabaseValueException::valueExceedsBounds($ex::errorInfo[2]);
            }
        }

        return self::$db->getRowCount();
    }

    // Delete merchant by ID
    static function deleteMerchant(int $ID) {
        $sql = "DELETE FROM 
                    merchants
                WHERE 
                    id = :id;";

        self::$db->query($sql);

        self::$db->bind(":id", $ID);

        self::$db->execute();

        return self::$db->getRowCount();
    }
}

?>

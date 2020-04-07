<?php

require_once("inc/exceptions.inc.php");

class ProductMapper {

    private static $db;

    static function initialize() {
        self::$db = new PDOManager('Product');
    }

    // Create an product
    static private function _createProduct(Product $product) {
        $sql = "INSERT INTO products
                    (upc, merchant_id, name, units_available, unit_weight, 
                    unit_price, unit_discount, shipping_method_highest)
                VALUES 
                    (:upc, :merchant_id, :name, u_available, u_weight,
                    :u_price, :u_discount, :shipping);";

        self::$db->query($sql);

        self::$db->bind(":upc", $product->getUPC());
        self::$db->bind(":merchant_id", $product->getMerchantID());
        self::$db->bind(":name", $product->getName());
        self::$db->bind(":u_available", $product->getUnitsAvailable());
        self::$db->bind(":u_weight", $product->getWeight());
        self::$db->bind(":u_price", $product->getPrice());
        self::$db->bind(":u_discount", $product->getDiscount());
        self::$db->bind(":shipping", $product->getHighestShippingMethod());

        try {
            self::$db->execute();
        } catch (PDOException $ex) {
            if ($ex::errorInfo[0] == "42000") {
                throw DatabaseValueException::valueExceedsBounds($ex::errorInfo[2]);
            }
        }

        return $db->getLastInsertedID();
    }

    static function makeProduct($name, $price, $weight, $merchant_id, $upc=NULL, $units_available=0, $discount=NULL) {
        $product = new Product();
        
        if (!is_null($upc)) {
            if (!self::getProductByUPC($upc)) {
                throw DatabaseValueException::valueNotUnique($upc);
            }

            $product->setUPC($upc);
        }

        $product->setName($name);
        $product->setPrice($price);
        $product->setWeight($weight);
        $product->setMerchantID($merchant_id);
        $product->setUnitsAvailable($units_available);
        $product->setDiscount($discount);

        self::_createProduct($product);
    }

    // Get a single product by ID
    static function getProductByID(int $ID) {
        $sql = "SELECT * FROM 
                    products
                WHERE 
                    id = :id;";

        self::$db->query($sql);
        self::$db->bind(":id", $ID);
        self::$db->execute();

        return self::$db->getResult();
    }

    // Get a single product by UPC
    static function getProductByUPC(int $upc) {
        $sql = "SELECT * FROM 
                    products
                WHERE 
                    upc = :upc;";

        self::$db->query($sql);
        self::$db->bind(":upc", $upc);
        self::$db->execute();

        return self::$db->getResult();
    }

    // Get all products
    static function getProducts() {
        $sql = "SELECT * FROM products;";

        self::$db->query($sql);
        self::$db->execute();

        return self::$db->getResults();
    }

    // Update product info
    static function updateProductInfo(Product $product) {
        $sql = "UPDATE products
                SET
                    name = :name,
                    units_available = :u_available,
                    unit_weight = :u_weight,
                    unit_price = :u_price,
                    unit_discount = :u_discount,
                    shipping_method_highest = :shipping
                WHERE
                    id = :id;";
        

        self::$db->query($sql);

        self::$db->bind(":name", $product->getName());
        self::$db->bind(":u_available", $product->getUnitsAvailable());
        self::$db->bind(":u_weight", $product->getWeight());
        self::$db->bind(":u_price", $product->getPrice());
        self::$db->bind(":u_discount", $product->getDiscount());
        self::$db->bind(":shipping", $product->getHighestShippingMethod());

        self::$db->bind(":id", $product->getID());

        try {
            self::$db->execute();
        } catch (PDOException $ex) {
            if ($ex::errorInfo[0] == "42000") {
                throw DatabaseValueException::valueExceedsBounds($ex::errorInfo[2]);
            }
        }

        return self::$db->rowCount();
    }

    // Delete product by ID
    static function deleteProduct(int $ID) {
        $sql = "DELETE FROM 
                    products
                WHERE 
                    id = :id;";

        self::$db->query($sql);

        self::$db->bind(":id", $ID);

        self::$db->execute();

        return self::$db->rowCount();
    }
}

?>
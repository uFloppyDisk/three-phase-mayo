<?php

require_once("inc/exceptions.inc.php");

class OrderMapper {

    private static $db;

    static function initialize() {
        self::$db = new PDOManager('Order');
    }

    // Create an order
    static private function _createOrder(int $id, JSON $products_ordered, JSON $addressing, string $status) {
        $sql = "INSERT INTO orders
                    (account_id, products_ordered, addressing, status)
                VALUES 
                    (:account_id, :products, :addressing, :status);";

        self::$db->query($sql);

        self::$db->bind(":name", $order->getName());
        self::$db->bind(":products", $order->getGlobalDiscount());
        self::$db->bind(":addressing", $order->getAddressing());
        self::$db->bind(":status", $order->getStatus());

        try {
            self::$db->execute();
        } catch (PDOException $ex) {
            if ($ex::errorInfo[0] == "42000") {
                throw DatabaseValueException::valueExceedsBounds($ex::errorInfo[2]);
            }
        }

        return $db->getLastInsertedID();
    }

    // Update order
    static private function _updateOrder(int $id, JSON $products_ordered, JSON $addressing, string $status) {
        $sql = "UPDATE orders
                SET
                    products_ordered = :products,
                    addressing = :addressing,
                    status = :status
                WHERE
                    id = :id;";
        

        self::$db->query($sql);

        self::$db->bind(":products", $products_ordered);
        self::$db->bind(":addressing", $addressing);
        self::$db->bind(":status", $status);

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

    static function makeOrder(int $account_id, JSON $products_ordered, JSON $addressing, string $status=NULL) {
        if (!AccountMapper::getAccountByID($account_id)) {
            throw DatabaseRecordException::recordNotExists(array("id", $account_id));
        }

        if (!array_key_exists("shipping", $addressing)) {
            throw new IllegalInputException;
        }
        
        if (is_null($status)) {
            $status = "Payment Processing";
        }

        $ret = self::_createOrder($account_id, $products_ordered, $addressing, $status);
        
        return $ret;
    }

    // Update order info if possible
    static function changeOrder(int $id, JSON $products_ordered, JSON $addressing, string $status=NULL) {
        if (!array_key_exists("shipping", $addressing)) {
            throw new IllegalInputException;
        }
        
        if (is_null($status)) {
            $status = "Payment Processing";
        }

        $ret = self::_updateOrder($id, $products_ordered, $addressing, $status);

        return $ret;
    }

    // Get a single order by ID
    static function getOrderByID(int $ID) {
        $sql = "SELECT * FROM 
                    orders
                WHERE 
                    id = :id;";

        self::$db->query($sql);
        self::$db->bind(":id", $ID);
        self::$db->execute();

        return self::$db->getResult();
    }

    // Get orders by Account ID
    static function getOrdersByAccountID(int $account_id) {
        $sql = "SELECT * FROM 
                    orders
                WHERE
                    account_id = :account_id;";

        self::$db->query($sql);
        self::$db->bind(":account_id", $account_id);
        self::$db->execute();

        return self::$db->getResults();
    }

    // Get all orders
    static function getOrders() {
        $sql = "SELECT * FROM orders;";

        self::$db->query($sql);
        self::$db->execute();

        return self::$db->getResults();
    }

    // Delete order by ID
    static function deleteOrder(int $ID) {
        $sql = "DELETE FROM 
                    orders
                WHERE 
                    id = :id;";

        self::$db->query($sql);

        self::$db->bind(":id", $ID);

        self::$db->execute();

        return self::$db->getRowCount();
    }
}

?>

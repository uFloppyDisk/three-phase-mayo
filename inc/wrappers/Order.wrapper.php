<?php

require_once("inc/exceptions.inc.php");

class OrderMapper {

    private static $db;

    static function initialize() {
        self::$db = new PDOManager('Order');
    }

    // Create an order
    static private function _createOrder(Order $order) {
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
    static private function _updateOrder(Order $order, int $id) {
        $sql = "UPDATE orders
                SET
                    products_ordered = :products,
                    addressing = :addressing,
                    status = :status
                WHERE
                    id = :id;";
        

        self::$db->query($sql);

        self::$db->bind(":products", $order->getProductsOrdered());
        self::$db->bind(":addressing", $order->getAddressing());
        self::$db->bind(":status", "Payment Processing");

        self::$db->bind(":id", $id);

        try {
            self::$db->execute();
        } catch (PDOException $ex) {
            if ($ex::errorInfo[0] == "42000") {
                throw DatabaseValueException::valueExceedsBounds($ex::errorInfo[2]);
            }
        }

        return self::$db->rowCount();
    }

    static function makeOrder($account_id, $products_ordered, $addressing) {
        $order = new Order();

        $order->setAccountID($account_id);
        $order->setProductsOrdered($products_ordered);
        $order->setAddressing($addressing);
        $order->setStatus($status);

        self::_createOrder($order);
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

    // Update order info if possible
    static function updateOrder(int $id, JSON $products_ordered, JSON $addressing) {
        $order = new Order();

        $order->setProductsOrdered($products_ordered);
        $order->setAddressing($addressing);
        
        $ret = self::_updateOrder($order, $id);

        return $ret;
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

        return self::$db->rowCount();
    }
}

?>

<?PHP

require_once("inc/exceptions.inc.php");

class Product {
    private $id;
    private $upc;
    private $merchant_id;
    private $name;
    private $units_available;
    private $unit_weight;
    private $unit_price;
    private $unit_discount;
    private $shipping_method_highest;


    // Getters
    function getID() {
        return $this->id;
    }

    function getUPC() {
        return $this->upc;
    }

    function getMerchantID() {
        return $this->merchant_id;
    }

    function getName() {
        return $this->name;
    }

    function getUnitsAvailable() {
        return $this->units_available;
    }

    function getWeight() {
        return $this->unit_weight;
    }

    function getPrice() {
        return $this->unit_price;
    }

    function getDiscount() {
        return $this->unit_discount;
    }

    function getHighestShippingMethod() {
        return $this->shipping_method_highest;
    }

    // Setters
    function setUPC(int $value) {
        $this->upc = $value;
    }

    function setMerchantID(int $value) {
        $this->merchant_id = $value;
    }

    function setName(string $value) {
        $this->name = $value;
    }

    function setUnitsAvailable(int $value) {
        $this->units_available = $value;
    }

    function setWeight(float $value) {
        $this->unit_weight = $value;
    }

    function setPrice(float $value) {
        $this->unit_price = $value;
    }

    function setDiscount(float $value) {
        $this->unit_discount = $value;
    }

    function setHighestShippingMethod(int $value) {
        $this->shipping_method_highest = $value;
    }
}

?>
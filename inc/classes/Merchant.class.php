<?PHP

require_once("inc/exceptions.inc.php");

class Merchant {
    private $id;
    private $name;
    private $global_discount;
    private $shipping_country;


    // Getters
    function getID() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getGlobalDiscount() {
        return $this->global_discount;
    }

    function getShippingCountry() {
        return $this->shipping_country;
    }

    // Setters
    function setName(string $value) {
        $this->name = $value;
    }

    function setGlobalDiscount(float $value) {
        $this->global_discount = $value;
    }

    function setShippingCountry(string $value) {
        $this->shipping_country = $value;
    }
}

?>
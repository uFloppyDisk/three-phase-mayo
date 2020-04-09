<?PHP

require_once("inc/exceptions.inc.php");

class Order {
    private $id;
    private $account_id;
    private $products_ordered;
    private $addressing;
    private $status;


    // Getters
    function getID() {
        return $this->id;
    }

    function getAccountID() {
        return $this->account_id;
    }

    function getProductsOrdered() {
        return $this->products_ordered;
    }

    function getAddressing() {
        return $this->addressing;
    }

    function getStatus() {
        return $this->status;
    }

    // Setters
    function setAccountID(int $value) {
        $this->account_id = $value;
    }

    function setProductsOrdered(JSON $value) {
        $this->products_ordered = $value;
    }

    function setAddressing(JSON $value) {
        $this->addressing = $value;
    }
    
    function setStatus($value) {
        if (is_string($value) || is_int($value)) {    
            $this->status = $value;
            return TRUE;
        }

        return FALSE;
    }
}

?>